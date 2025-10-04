@extends('layout')

@section('title', 'Detail Refleksi - ' . $reflection->user->name . ' - LKPD App')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <!-- Admin Header -->
    <div class="relative rounded-2xl overflow-hidden mb-8">
        <div class="absolute inset-0 bg-gradient-to-r from-indigo-600 via-blue-700 to-purple-800"></div>
        <div class="relative px-8 py-12">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
                <div class="flex items-center mb-6 md:mb-0">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-white/20 rounded-full backdrop-blur-sm mr-6">
                        <i class="fas fa-user-shield text-white text-3xl"></i>
                    </div>
                    <div>
                        <h1 class="text-4xl font-bold text-white mb-2">Detail Refleksi Siswa</h1>
                        <p class="text-indigo-100 text-lg">
                            Panel administrator - Tinjau refleksi pembelajaran siswa
                        </p>
                    </div>
                </div>
                <div class="bg-white/20 backdrop-blur-sm px-6 py-4 rounded-2xl">
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('reflections.index') }}"
                           class="flex items-center px-4 py-2 bg-white/20 text-white rounded-xl hover:bg-white/30 transition-all duration-300">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Kembali
                        </a>
                        <button onclick="window.print()"
                                class="flex items-center px-4 py-2 bg-white/20 text-white rounded-xl hover:bg-white/30 transition-all duration-300">
                            <i class="fas fa-print mr-2"></i>
                            Cetak
                        </button>
                    </div>
                </div>
            </div>

            <!-- Student Info & Mood Badges -->
            <div class="flex flex-wrap items-center justify-between mt-8">
                <div class="flex items-center space-x-4 mb-4 md:mb-0">
                    <div class="flex items-center space-x-3 bg-white/20 backdrop-blur-sm px-4 py-3 rounded-2xl">
                        <div class="w-12 h-12 bg-gradient-to-r from-green-400 to-blue-500 rounded-full flex items-center justify-center">
                            <span class="text-white font-bold text-lg">{{ strtoupper(substr($reflection->user->name, 0, 1)) }}</span>
                        </div>
                        <div>
                            <h3 class="font-semibold text-white">{{ $reflection->user->name }}</h3>
                            <p class="text-indigo-100 text-sm">
                                {{ $reflection->user->kelas ?? 'Belum ada kelas' }} •
                                {{ $reflection->user->nis ?? 'Belum ada NIS' }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="flex flex-wrap gap-3">
                    @if($reflection->mood)
                    <div class="bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full text-white flex items-center">
                        <i class="fas fa-smile-beam mr-2"></i>
                        <span class="font-medium">{{ $reflection->mood }}</span>
                    </div>
                    @endif
                    <div class="bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full text-white flex items-center">
                        <i class="fas fa-calendar-alt mr-2"></i>
                        <span class="font-medium">{{ $reflection->created_at->translatedFormat('d F Y') }}</span>
                    </div>
                    <div class="bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full text-white flex items-center">
                        <i class="fas fa-clock mr-2"></i>
                        <span class="font-medium">{{ $reflection->created_at->format('H:i') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <!-- Sidebar -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Student Stats Card -->
            <div class="bg-white rounded-2xl shadow-2xl border-0 p-6 transform hover:scale-[1.02] transition-all duration-300">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="font-bold text-gray-900 text-lg flex items-center">
                        <i class="fas fa-chart-bar text-blue-500 mr-2"></i>
                        Statistik Siswa
                    </h3>
                    <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-user-graduate text-blue-600"></i>
                    </div>
                </div>

                <div class="space-y-5">
                    <div class="flex items-center justify-between p-3 bg-blue-50 rounded-xl">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-file-alt text-blue-600"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-600">Total Refleksi</p>
                                <p class="text-2xl font-bold text-blue-600">{{ $stats['total_reflections'] }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-green-50 p-3 rounded-xl">
                            <p class="text-xs text-green-600 font-medium">Bulan Ini</p>
                            <p class="text-lg font-bold text-green-700">{{ $stats['monthly_reflections'] }}</p>
                        </div>
                        <div class="bg-purple-50 p-3 rounded-xl">
                            <p class="text-xs text-purple-600 font-medium">Minggu Ini</p>
                            <p class="text-lg font-bold text-purple-700">{{ $stats['weekly_reflections'] }}</p>
                        </div>
                    </div>

                    <div class="bg-gradient-to-r from-orange-50 to-amber-50 p-4 rounded-xl border border-orange-200">
                        <div class="flex items-center justify-between mb-2">
                            <p class="text-sm font-medium text-orange-800">Mood Terpopuler</p>
                            <i class="fas fa-smile text-orange-500"></i>
                        </div>
                        <p class="text-xl font-bold text-orange-900">
                            @if($stats['most_common_mood'])
                                {{ $stats['average_mood'] }}
                            @else
                                -
                            @endif
                        </p>
                        <p class="text-xs text-orange-600 mt-1">
                            @if($stats['most_common_mood'])
                                {{ $stats['most_common_mood']['count'] }} kali digunakan
                            @else
                                Belum ada data
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            <!-- Reflection Analysis -->
            <div class="bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl p-6 text-white shadow-2xl">
                <h3 class="font-bold text-white text-lg mb-6 flex items-center">
                    <i class="fas fa-analytics mr-2"></i>
                    Analisis Refleksi
                </h3>

                <div class="space-y-5">
                    <!-- Depth Score -->
                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-indigo-100">Tingkat Kedalaman</span>
                            @php
                                $contentLength = strlen($reflection->content);
                                $depthScore = min(100, ($contentLength / 10));
                                $starRating = ceil(($depthScore / 100) * 5);
                            @endphp
                            <div class="flex items-center">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star {{ $i <= $starRating ? 'text-yellow-300' : 'text-indigo-300' }} text-sm"></i>
                                @endfor
                            </div>
                        </div>
                        <div class="w-full bg-indigo-400 rounded-full h-2">
                            <div class="bg-yellow-400 h-2 rounded-full transition-all duration-1000"
                                 style="width: {{ $depthScore }}%"></div>
                        </div>
                    </div>

                    <!-- Completeness -->
                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-indigo-100">Kelengkapan</span>
                            @php
                                $completeness = 0;
                                if($reflection->content) $completeness += 40;
                                if($reflection->lesson_learned) $completeness += 30;
                                if($reflection->improvement_plan) $completeness += 30;
                            @endphp
                            <span class="font-bold text-white">{{ $completeness }}%</span>
                        </div>
                        <div class="w-full bg-indigo-400 rounded-full h-2">
                            <div class="bg-green-400 h-2 rounded-full transition-all duration-1000"
                                 style="width: {{ $completeness }}%"></div>
                        </div>
                    </div>

                    <!-- Content Metrics -->
                    <div class="grid grid-cols-2 gap-4 pt-2">
                        <div class="text-center">
                            <div class="text-2xl font-bold text-white">{{ str_word_count($reflection->content) }}</div>
                            <div class="text-indigo-100 text-xs">Kata</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-white">{{ strlen($reflection->content) }}</div>
                            <div class="text-indigo-100 text-xs">Karakter</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="lg:col-span-3 space-y-8">
            <!-- Main Reflection Card -->
            <div class="bg-white rounded-2xl shadow-2xl border-0 overflow-hidden transform hover:scale-[1.005] transition-all duration-300">
                <div class="bg-gradient-to-r from-indigo-500 to-purple-600 px-8 py-6">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mr-4">
                                <i class="fas fa-pencil-alt text-white text-xl"></i>
                            </div>
                            <div>
                                <h2 class="text-2xl font-bold text-white">Refleksi Pembelajaran</h2>
                                <p class="text-indigo-100">Catatan perjalanan belajar siswa</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="bg-white/20 text-white px-4 py-2 rounded-xl text-sm font-medium">
                                <i class="fas fa-file-alt mr-2"></i>Konten Utama
                            </span>
                        </div>
                    </div>
                </div>
                <div class="p-8">
                    <div class="prose prose-lg max-w-none">
                        <div class="text-gray-700 leading-relaxed whitespace-pre-wrap text-lg bg-gray-50 p-6 rounded-xl border border-gray-200">
                            {{ $reflection->content }}
                        </div>
                    </div>

                    <!-- Reflection Stats -->
                    <div class="flex flex-wrap gap-6 mt-8 pt-6 border-t border-gray-200">
                        <div class="flex items-center text-gray-500">
                            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-font text-blue-600"></i>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-700">{{ str_word_count($reflection->content) }} kata</p>
                                <p class="text-sm">Total kata</p>
                            </div>
                        </div>
                        <div class="flex items-center text-gray-500">
                            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-ruler text-green-600"></i>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-700">{{ strlen($reflection->content) }} karakter</p>
                                <p class="text-sm">Panjang teks</p>
                            </div>
                        </div>
                        <div class="flex items-center text-gray-500">
                            <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-clock text-purple-600"></i>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-700">{{ ceil(str_word_count($reflection->content) / 200) }} menit</p>
                                <p class="text-sm">Waktu baca</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Two Column Layout for Lessons and Plans -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Lessons Learned Card -->
                <div class="bg-white rounded-2xl shadow-2xl border-0 overflow-hidden transform hover:scale-[1.005] transition-all duration-300">
                    <div class="bg-gradient-to-r from-green-500 to-emerald-600 px-6 py-5">
                        <h2 class="text-xl font-bold text-white flex items-center">
                            <i class="fas fa-graduation-cap mr-3"></i>
                            Pelajaran yang Didapat
                        </h2>
                    </div>
                    <div class="p-6">
                        @if($reflection->lesson_learned)
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0 w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                                <i class="fas fa-lightbulb text-green-600 text-xl"></i>
                            </div>
                            <div class="prose prose-lg max-w-none flex-1">
                                <p class="text-gray-700 leading-relaxed whitespace-pre-wrap bg-green-50 p-4 rounded-xl border border-green-200">
                                    {{ $reflection->lesson_learned }}
                                </p>
                            </div>
                        </div>

                        <!-- Key Takeaways -->
                        <div class="mt-6 bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl p-5 border border-green-200">
                            <h4 class="font-semibold text-green-800 mb-4 flex items-center">
                                <i class="fas fa-bullseye mr-2"></i>
                                Poin Penting
                            </h4>
                            <div class="space-y-3">
                                @php
                                    $sentences = preg_split('/(?<=[.?!])\s+/', $reflection->lesson_learned);
                                    $keyPoints = array_slice(array_filter($sentences), 0, 3);
                                @endphp
                                @foreach($keyPoints as $point)
                                <div class="flex items-start space-x-3">
                                    <i class="fas fa-check-circle text-green-500 mt-1 flex-shrink-0"></i>
                                    <span class="text-green-700">{{ trim($point) }}</span>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @else
                        <div class="text-center py-8">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-times text-gray-400 text-xl"></i>
                            </div>
                            <p class="text-gray-500 font-medium">Tidak ada pelajaran yang dicatat</p>
                            <p class="text-gray-400 text-sm mt-1">Siswa belum menuliskan pelajaran yang didapat</p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Improvement Plan Card -->
                <div class="bg-white rounded-2xl shadow-2xl border-0 overflow-hidden transform hover:scale-[1.005] transition-all duration-300">
                    <div class="bg-gradient-to-r from-blue-500 to-cyan-600 px-6 py-5">
                        <h2 class="text-xl font-bold text-white flex items-center">
                            <i class="fas fa-chart-line mr-3"></i>
                            Rencana Perbaikan
                        </h2>
                    </div>
                    <div class="p-6">
                        @if($reflection->improvement_plan)
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0 w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                                <i class="fas fa-rocket text-blue-600 text-xl"></i>
                            </div>
                            <div class="prose prose-lg max-w-none flex-1">
                                <p class="text-gray-700 leading-relaxed whitespace-pre-wrap bg-blue-50 p-4 rounded-xl border border-blue-200">
                                    {{ $reflection->improvement_plan }}
                                </p>
                            </div>
                        </div>

                        <!-- Action Steps -->
                        <div class="mt-6 bg-gradient-to-r from-blue-50 to-cyan-50 rounded-xl p-5 border border-blue-200">
                            <h4 class="font-semibold text-blue-800 mb-4 flex items-center">
                                <i class="fas fa-list-check mr-2"></i>
                                Langkah Tindakan
                            </h4>
                            <div class="space-y-3">
                                @php
                                    $actionSteps = preg_split('/(?<=[.?!])\s+/', $reflection->improvement_plan);
                                    $steps = array_slice(array_filter($actionSteps), 0, 3);
                                @endphp
                                @foreach($steps as $index => $step)
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0 w-6 h-6 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center text-sm font-semibold mt-0.5">
                                        {{ $index + 1 }}
                                    </div>
                                    <span class="text-blue-700 flex-1">{{ trim($step) }}</span>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @else
                        <div class="text-center py-8">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-times text-gray-400 text-xl"></i>
                            </div>
                            <p class="text-gray-500 font-medium">Tidak ada rencana perbaikan</p>
                            <p class="text-gray-400 text-sm mt-1">Siswa belum menuliskan rencana perbaikan</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Metadata & Timeline -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Timeline -->
                <div class="bg-white rounded-2xl shadow-2xl border-0 p-6">
                    <h3 class="font-bold text-gray-900 mb-6 flex items-center">
                        <i class="fas fa-history text-purple-500 mr-2"></i>
                        Linimasa Aktivitas
                    </h3>
                    <div class="space-y-6">
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-plus text-green-600"></i>
                                </div>
                            </div>
                            <div class="flex-1">
                                <p class="font-semibold text-gray-900">Refleksi Dibuat</p>
                                <p class="text-gray-600">{{ $reflection->created_at->format('d F Y, H:i') }}</p>
                                <p class="text-sm text-gray-500 mt-1">{{ $reflection->created_at->diffForHumans() }}</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-edit text-blue-600"></i>
                                </div>
                            </div>
                            <div class="flex-1">
                                <p class="font-semibold text-gray-900">Terakhir Diperbarui</p>
                                <p class="text-gray-600">{{ $reflection->updated_at->format('d F Y, H:i') }}</p>
                                <p class="text-sm text-gray-500 mt-1">{{ $reflection->updated_at->diffForHumans() }}</p>
                            </div>
                        </div>

                        @if($reflection->created_at->diffInHours($reflection->updated_at) > 0)
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-clock text-yellow-600"></i>
                                </div>
                            </div>
                            <div class="flex-1">
                                <p class="font-semibold text-gray-900">Durasi Penyuntingan</p>
                                <p class="text-gray-600">{{ $reflection->created_at->diffForHumans($reflection->updated_at, true) }}</p>
                                <p class="text-sm text-gray-500 mt-1">Waktu antara dibuat dan diperbarui</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Reflection Quality -->
                <div class="bg-gradient-to-br from-purple-500 to-pink-600 rounded-2xl p-6 text-white shadow-2xl">
                    <h3 class="font-bold text-white mb-6 flex items-center">
                        <i class="fas fa-award mr-2"></i>
                        Kualitas Refleksi
                    </h3>
                    <div class="space-y-6">
                        @php
                            // Hitung skor kualitas
                            $qualityScore = 0;

                            // Factor 1: Panjang konten (maks 40)
                            $lengthScore = min(40, (strlen($reflection->content) / 25));

                            // Factor 2: Kelengkapan bagian (maks 30)
                            $completenessScore = 0;
                            if($reflection->content) $completenessScore += 10;
                            if($reflection->lesson_learned) $completenessScore += 10;
                            if($reflection->improvement_plan) $completenessScore += 10;

                            // Factor 3: Struktur (maks 30)
                            $structureScore = 0;
                            $paragraphs = preg_split('/\n\s*\n/', $reflection->content);
                            if(count($paragraphs) > 1) $structureScore += 15;
                            if(strlen($reflection->content) > 300) $structureScore += 15;

                            $qualityScore = min(100, $lengthScore + $completenessScore + $structureScore);

                            // Tentukan grade
                            if($qualityScore >= 80) {
                                $grade = "Sangat Baik";
                                $gradeColor = "from-emerald-400 to-green-500";
                                $icon = "fa-gem";
                            } elseif($qualityScore >= 60) {
                                $grade = "Baik";
                                $gradeColor = "from-blue-400 to-cyan-500";
                                $icon = "fa-star";
                            } elseif($qualityScore >= 40) {
                                $grade = "Cukup";
                                $gradeColor = "from-yellow-400 to-amber-500";
                                $icon = "fa-leaf";
                            } else {
                                $grade = "Perlu Perbaikan";
                                $gradeColor = "from-orange-400 to-red-500";
                                $icon = "fa-seedling";
                            }
                        @endphp

                        <div class="text-center">
                            <div class="inline-flex items-center justify-center w-24 h-24 bg-white/20 rounded-full backdrop-blur-sm mb-4">
                                <div class="text-center">
                                    <div class="text-3xl font-bold text-white">{{ round($qualityScore) }}</div>
                                    <div class="text-white/80 text-sm">Skor</div>
                                </div>
                            </div>
                            <div class="bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full inline-flex items-center">
                                <i class="fas {{ $icon }} mr-2"></i>
                                <span class="font-semibold">{{ $grade }}</span>
                            </div>
                        </div>

                        <div class="space-y-3">
                            <div class="flex justify-between items-center text-sm">
                                <span>Kedalaman Konten</span>
                                <span class="font-semibold">{{ round($lengthScore) }}/40</span>
                            </div>
                            <div class="w-full bg-white/30 rounded-full h-2">
                                <div class="bg-white h-2 rounded-full" style="width: {{ ($lengthScore/40)*100 }}%"></div>
                            </div>

                            <div class="flex justify-between items-center text-sm">
                                <span>Kelengkapan</span>
                                <span class="font-semibold">{{ $completenessScore }}/30</span>
                            </div>
                            <div class="w-full bg-white/30 rounded-full h-2">
                                <div class="bg-white h-2 rounded-full" style="width: {{ ($completenessScore/30)*100 }}%"></div>
                            </div>

                            <div class="flex justify-between items-center text-sm">
                                <span>Struktur</span>
                                <span class="font-semibold">{{ $structureScore }}/30</span>
                            </div>
                            <div class="w-full bg-white/30 rounded-full h-2">
                                <div class="bg-white h-2 rounded-full" style="width: {{ ($structureScore/30)*100 }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .prose {
        max-width: none;
    }

    .prose p {
        margin-bottom: 1em;
        line-height: 1.7;
    }

    .prose p:last-child {
        margin-bottom: 0;
    }

    /* Smooth animations */
    * {
        transition-property: color, background-color, border-color, transform, box-shadow;
        transition-duration: 300ms;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Custom scrollbar */
    ::-webkit-scrollbar {
        width: 6px;
    }

    ::-webkit-scrollbar-track {
        background: #f1f5f9;
    }

    ::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 3px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add animation to cards on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observe all cards for animation
        document.querySelectorAll('.bg-white.rounded-2xl, .bg-gradient-to-br').forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'all 0.6s ease';
            observer.observe(card);
        });

        // Add hover effects to interactive elements
        document.querySelectorAll('a, button').forEach(element => {
            element.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-2px)';
            });
            element.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
    });

    // Print functionality
    function printReflection() {
        window.print();
    }
</script>
@endsection
