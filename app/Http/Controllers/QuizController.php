<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\QuizResult;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class QuizController extends Controller
{
    public function index()
    {
        try {
            $quizzes = Quiz::where('is_active', true)
                          ->with(['questions.choices'])
                          ->withCount('questions')
                          ->latest()
                          ->get();

            // Untuk setiap quiz, ambil attempt user
            $quizzes->each(function ($quiz) {
                $quiz->user_attempt = QuizResult::where('quiz_id', $quiz->id)
                                              ->where('user_id', Auth::id())
                                              ->latest()
                                              ->first();
            });

            // Stats untuk user
            $userStats = [
                'total_attempts' => QuizResult::where('user_id', Auth::id())->count(),
                'average_score' => QuizResult::where('user_id', Auth::id())->avg('score') ?? 0,
                'completed_quizzes' => QuizResult::where('user_id', Auth::id())
                                               ->distinct('quiz_id')
                                               ->count('quiz_id'),
            ];

            return view('quiz.index', compact('quizzes', 'userStats'));

        } catch (\Exception $e) {
            // Fallback jika ada error
            Log::error('Quiz index error: ' . $e->getMessage());

            $quizzes = Quiz::where('is_active', true)
                          ->with(['questions.choices'])
                          ->withCount('questions')
                          ->latest()
                          ->get();

            $userStats = [
                'total_attempts' => 0,
                'average_score' => 0,
                'completed_quizzes' => 0,
            ];

            return view('quiz.index', compact('quizzes', 'userStats'));
        }
    }

    public function show($id)
    {
        try {
            $quiz = Quiz::with('questions.choices')->findOrFail($id);

            // Cek apakah user sudah mengerjakan quiz ini
            $previousAttempt = QuizResult::where('quiz_id', $id)
                                       ->where('user_id', Auth::id())
                                       ->latest()
                                       ->first();

            return view('quiz.show', compact('quiz', 'previousAttempt'));

        } catch (\Exception $e) {
            Log::error('Quiz show error: ' . $e->getMessage());
            return redirect()->route('quiz.index')->with('error', 'Quiz tidak ditemukan.');
        }
    }

    public function submit(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            $quiz = Quiz::with('questions.choices')->findOrFail($id);

            $answers = $request->except('_token');
            $score = 0;
            $detailed = [];
            $totalQuestions = $quiz->questions->count();

            foreach ($quiz->questions as $q) {
                $selected = $answers["q_".$q->id] ?? null;
                $correct  = $q->choices->firstWhere('is_correct', true);
                $isCorrect = ($selected == $correct?->id);

                if ($isCorrect) {
                    $score++;
                }

                $detailed[$q->id] = [
                    'selected'   => $selected,
                    'correct'    => $correct?->id,
                    'is_correct' => $isCorrect,
                    'question_text' => $q->question,
                    'correct_answer' => $correct?->choice,
                    'user_answer' => $q->choices->firstWhere('id', $selected)?->choice ?? 'Tidak dijawab'
                ];
            }

            // Cek struktur tabel sebelum membuat record
            $tableColumns = DB::getSchemaBuilder()->getColumnListing('quiz_results');

            $quizResultData = [
                'quiz_id' => $quiz->id,
                'user_id' => Auth::id(),
                'score'   => $score,
                'answers' => $detailed
            ];

            // Tambahkan total_questions hanya jika kolom ada
            if (in_array('total_questions', $tableColumns)) {
                $quizResultData['total_questions'] = $totalQuestions;
            }

            QuizResult::create($quizResultData);

            DB::commit();

            return view('quiz.result', [
                'score'   => $score,
                'total'   => $totalQuestions,
                'quiz'    => $quiz,
                'details' => $detailed
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Quiz submit error: ' . $e->getMessage());

            return redirect()->back()
                           ->with('error', 'Terjadi kesalahan saat mengumpulkan quiz: ' . $e->getMessage())
                           ->withInput();
        }
    }
}
