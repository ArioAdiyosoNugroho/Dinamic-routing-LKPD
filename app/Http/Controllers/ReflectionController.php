<?php

namespace App\Http\Controllers;

use App\Models\Reflection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReflectionController extends Controller
{
    // Tampilkan semua refleksi (admin) atau refleksi user (murid)
    public function index()
    {
        if (Auth::user()->role === 'admin') {
            $reflections = Reflection::with('user')
                ->latest()
                ->paginate(10);
        } else {
            $reflections = Reflection::byUser(Auth::id())
                ->latest()
                ->paginate(10);
        }

        return view('reflections.index', compact('reflections'));
    }

    // Form create refleksi
    public function create()
    {
        return view('reflections.create');
    }

    // Simpan refleksi baru
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|min:10',
            'mood' => 'nullable|string|max:50',
            'lesson_learned' => 'nullable|string|min:5',
            'improvement_plan' => 'nullable|string|min:5'
        ]);

        Reflection::create([
            'user_id' => Auth::id(),
            'content' => $request->content,
            'mood' => $request->mood,
            'lesson_learned' => $request->lesson_learned,
            'improvement_plan' => $request->improvement_plan
        ]);

        return redirect()->route('reflections.index')
            ->with('success', 'Refleksi berhasil disimpan!');
    }

    // Tampilkan detail refleksi
   public function show(Reflection $reflection)
    {
        if (Auth::user()->role !== 'admin' && $reflection->user_id !== Auth::id()) {
            abort(403);
        }

        // Hitung stats untuk user pemilik refleksi
        $userId = $reflection->user_id;

        $stats = $this->calculateUserReflectionStats($userId);

        // Jika admin, gunakan view admin, jika user gunakan view biasa
        if (Auth::user()->role === 'admin') {
            return view('reflections.admin-show', compact('reflection', 'stats'));
        } else {
            return view('reflections.show', compact('reflection', 'stats'));
        }
    }

    /**
     * Hitung statistik refleksi untuk user tertentu
     */
    private function calculateUserReflectionStats($userId)
    {
        // Total refleksi
        $totalReflections = Reflection::where('user_id', $userId)->count();

        // Refleksi bulan ini
        $monthlyReflections = Reflection::where('user_id', $userId)
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        // Rata-rata mood (mood paling sering muncul)
        $mostCommonMood = Reflection::where('user_id', $userId)
            ->whereNotNull('mood')
            ->select('mood', DB::raw('COUNT(*) as count'))
            ->groupBy('mood')
            ->orderByDesc('count')
            ->first();

        $averageMood = $mostCommonMood ? $mostCommonMood->mood : 'Belum ada data';

        // Stats tambahan
        $weeklyReflections = Reflection::where('user_id', $userId)
            ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->count();

        $reflectionsWithLesson = Reflection::where('user_id', $userId)
            ->whereNotNull('lesson_learned')
            ->count();

        $reflectionsWithPlan = Reflection::where('user_id', $userId)
            ->whereNotNull('improvement_plan')
            ->count();

        // Hitung persentase kelengkapan rata-rata
        $completenessRate = $totalReflections > 0 ?
            (($reflectionsWithLesson + $reflectionsWithPlan) / ($totalReflections * 2)) * 100 : 0;

        return [
            'total_reflections' => $totalReflections,
            'monthly_reflections' => $monthlyReflections,
            'weekly_reflections' => $weeklyReflections,
            'average_mood' => $averageMood,
            'reflections_with_lesson' => $reflectionsWithLesson,
            'reflections_with_plan' => $reflectionsWithPlan,
            'completeness_rate' => round($completenessRate, 1),
            'most_common_mood' => $mostCommonMood ? [
                'mood' => $mostCommonMood->mood,
                'count' => $mostCommonMood->count
            ] : null
        ];
    }

    // Form edit refleksi
    public function edit(Reflection $reflection)
    {
        // Authorization: hanya pemilik yang bisa edit
        if ($reflection->user_id !== Auth::id()) {
            abort(403);
        }

        return view('reflections.edit', compact('reflection'));
    }

    // Update refleksi
    public function update(Request $request, Reflection $reflection)
    {
        // Authorization: hanya pemilik yang bisa update
        if ($reflection->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'content' => 'required|min:10',
            'mood' => 'nullable|string|max:50',
            'lesson_learned' => 'nullable|string|min:5',
            'improvement_plan' => 'nullable|string|min:5'
        ]);

        $reflection->update($request->all());

        return redirect()->route('reflections.index')
            ->with('success', 'Refleksi berhasil diperbarui!');
    }

    // Hapus refleksi
    public function destroy(Reflection $reflection)
    {
        // Authorization: hanya pemilik yang bisa hapus
        if ($reflection->user_id !== Auth::id()) {
            abort(403);
        }

        $reflection->delete();

        return redirect()->route('reflections.index')
            ->with('success', 'Refleksi berhasil dihapus!');
    }
}
