<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Choice;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminQuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::with(['questions.choices'])->latest()->get();
        return view('admin.quiz.index', compact('quizzes'));
    }

    public function create()
    {
        return view('admin.quiz.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duration' => 'required|integer|min:1',
            'questions' => 'required|array|min:1',
            'questions.*.question' => 'required|string',
            'questions.*.choices' => 'required|array|min:2',
            'questions.*.choices.*.choice' => 'required|string',
            'questions.*.correct_choice' => 'required|integer|min:0'
        ]);

        DB::beginTransaction();

        try {
            // Create quiz
            $quiz = Quiz::create([
                'title' => $request->title,
                'description' => $request->description,
                'duration' => $request->duration,
                'is_active' => true
            ]);

            // Create questions and choices
            foreach ($request->questions as $questionData) {
                $question = Question::create([
                    'quiz_id' => $quiz->id,
                    'question' => $questionData['question']
                ]);

                foreach ($questionData['choices'] as $index => $choiceData) {
                    Choice::create([
                        'question_id' => $question->id,
                        'choice' => $choiceData['choice'],
                        'is_correct' => $index == $questionData['correct_choice']
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('admin.quiz.index')
                ->with('success', 'Quiz berhasil dibuat!');

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }
  public function preview($id)
{
    try {
        $quiz = Quiz::with(['questions.choices'])->findOrFail($id);

        return view('admin.quiz.preview', compact('quiz'));

    } catch (\Exception $e) {
        Log::error('Quiz preview error: ' . $e->getMessage());
        return redirect()->route('admin.quiz.index')
                       ->with('error', 'Quiz tidak ditemukan atau terjadi kesalahan.');
    }
}

    public function edit($id)
    {
        $quiz = Quiz::with(['questions.choices'])->findOrFail($id);
        return view('admin.quiz.edit', compact('quiz'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duration' => 'required|integer|min:1',
            'questions' => 'required|array|min:1',
            'questions.*.question' => 'required|string',
            'questions.*.choices' => 'required|array|min:2',
            'questions.*.choices.*.choice' => 'required|string',
            'questions.*.correct_choice' => 'required|integer|min:0'
        ]);

        DB::beginTransaction();

        try {
            $quiz = Quiz::findOrFail($id);

            // Update quiz
            $quiz->update([
                'title' => $request->title,
                'description' => $request->description,
                'duration' => $request->duration
            ]);

            // Delete existing questions and choices
            $quiz->questions()->delete();

            // Create new questions and choices
            foreach ($request->questions as $questionData) {
                $question = Question::create([
                    'quiz_id' => $quiz->id,
                    'question' => $questionData['question']
                ]);

                foreach ($questionData['choices'] as $index => $choiceData) {
                    Choice::create([
                        'question_id' => $question->id,
                        'choice' => $choiceData['choice'],
                        'is_correct' => $index == $questionData['correct_choice']
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('admin.quiz.index')
                ->with('success', 'Quiz berhasil diperbarui!');

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $quiz = Quiz::findOrFail($id);
            $quiz->delete();

            DB::commit();

            return redirect()->route('admin.quiz.index')
                ->with('success', 'Quiz berhasil dihapus!');

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function toggleStatus($id)
    {
        try {
            $quiz = Quiz::findOrFail($id);
            $quiz->update([
                'is_active' => !$quiz->is_active
            ]);

            $status = $quiz->is_active ? 'diaktifkan' : 'dinonaktifkan';
            return redirect()->route('admin.quiz.index')
                ->with('success', "Quiz berhasil $status!");

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
