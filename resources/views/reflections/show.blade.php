@extends('layout')

@section('title', 'Detail Refleksi - ' . $reflection->user->name . ' - LKPD App')

@section('content')
<div class="max-w-5xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <!-- Header dengan Background Gradient -->
    <div class="relative rounded-2xl overflow-hidden mb-8">
        <div class="absolute inset-0 bg-gradient-to-r from-indigo-500 via-purple-600 to-pink-500"></div>
        <div class="relative px-8 py-12 text-center">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-white/20 rounded-full backdrop-blur-sm mb-4">
                <i class="fas fa-brain text-white text-3xl"></i>
            </div>
            <h1 class="text-4xl font-bold text-white mb-3">Refleksi Pembelajaran</h1>
            <p class="text-indigo-100 text-lg max-w-2xl mx-auto">
                Catatan perjalanan belajar dan perkembangan diri
            </p>

            <!-- Mood & Date Badges -->
            <div class="flex flex-wrap justify-center gap-3 mt-6">
                @if($reflection->mood)
                <div class="bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full text-white flex items-center">
                    <i class="fas fa-smile-beam mr-2"></i>
                    <span class="font-medium">{{ $reflection->mood }}</span>
                </div>
                @endif
                <div class="bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full text-white flex items-center">
                    <i class="fas fa-calendar-alt mr-2"></i>
                    <span class="font-medium">{{ $reflection->created_at->translatedFormat('l, d F Y') }}</span>
                </div>
                <div class="bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full text-white flex items-center">
                    <i class="fas fa-clock mr-2"></i>
                    <span class="font-medium">{{ $reflection->created_at->format('H:i') }} WIB</span>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <!-- Sidebar -->
        <div class="lg:col-span-1 space-y-6">
            <!-- User Profile Card -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-200 p-6">
                <div class="text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-indigo-400 to-purple-500 rounded-full mb-4">
                        <span class="text-white font-bold text-xl">{{ strtoupper(substr($reflection->user->name, 0, 1)) }}</span>
                    </div>
                    <h3 class="font-bold text-gray-900 text-lg">{{ $reflection->user->name }}</h3>
                    <p class="text-gray-600 text-sm mt-1">
                        <i class="fas fa-graduation-cap mr-1"></i>
                        {{ $reflection->user->kelas ?? 'Belum ada kelas' }}
                    </p>
                    <p class="text-gray-500 text-sm">
                        <i class="fas fa-id-card mr-1"></i>
                        {{ $reflection->user->nis ?? 'Belum ada NIS' }}
                    </p>
                </div>

                <!-- Stats -->
                <div class="mt-6 space-y-4">
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600">Total Refleksi</span>
                        <span class="font-semibold text-indigo-600">{{ $stats['total_reflections'] }}</span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600">Refleksi Bulan Ini</span>
                        <span class="font-semibold text-green-600">{{ $stats['monthly_reflections'] }}</span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600">Refleksi Minggu Ini</span>
                        <span class="font-semibold text-blue-600">{{ $stats['weekly_reflections'] }}</span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600">Mood Paling Sering</span>
                        <span class="font-semibold text-yellow-600">
                            @if($stats['most_common_mood'])
                                {{ $stats['average_mood'] }} ({{ $stats['most_common_mood']['count'] }}x)
                            @else
                                😊 Belum ada data
                            @endif
                        </span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600">Dengan Pelajaran</span>
                        <span class="font-semibold text-purple-600">{{ $stats['reflections_with_lesson'] }}</span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600">Dengan Rencana</span>
                        <span class="font-semibold text-pink-600">{{ $stats['reflections_with_plan'] }}</span>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            @if(auth()->user()->role === 'user' && $reflection->user_id === auth()->id())
            <div class="bg-white rounded-2xl shadow-xl border border-gray-200 p-6">
                <h4 class="font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-bolt text-yellow-500 mr-2"></i>
                    Aksi Cepat
                </h4>
                <div class="space-y-3">
                    <a href="{{ route('reflections.edit', $reflection) }}"
                       class="w-full flex items-center justify-center px-4 py-3 bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-xl font-medium hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                        <i class="fas fa-edit mr-2"></i>
                        Edit Refleksi
                    </a>
                    <form action="{{ route('reflections.destroy', $reflection) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                onclick="return confirm('Yakin hapus refleksi ini? Tindakan ini tidak dapat dibatalkan.')"
                                class="w-full flex items-center justify-center px-4 py-3 bg-gradient-to-r from-red-500 to-pink-600 text-white rounded-xl font-medium hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                            <i class="fas fa-trash-alt mr-2"></i>
                            Hapus Refleksi
                        </button>
                    </form>
                </div>
            </div>
            @endif

            <!-- Reflection Insights -->
            <div class="bg-gradient-to-br from-blue-50 to-indigo-100 rounded-2xl border border-blue-200 p-6">
                <h4 class="font-semibold text-blue-900 mb-3 flex items-center">
                    <i class="fas fa-chart-line text-blue-600 mr-2"></i>
                    Insights
                </h4>
                <div class="space-y-3 text-sm text-blue-800">
                    <div class="flex items-center justify-between">
                        <span>Panjang Refleksi</span>
                        <span class="font-semibold">{{ strlen($reflection->content) }} karakter</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span>Kedalaman</span>
                        <span class="font-semibold">
                            @if(strlen($reflection->content) > 500)
                            <i class="fas fa-star text-yellow-500"></i> Mendalam
                            @elseif(strlen($reflection->content) > 200)
                            <i class="fas fa-star-half-alt text-yellow-500"></i> Sedang
                            @else
                            <i class="far fa-star text-yellow-500"></i> Ringkas
                            @endif
                        </span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span>Pelajaran</span>
                        <span class="font-semibold">
                            @if($reflection->lesson_learned)
                            <i class="fas fa-check-circle text-green-500"></i> Ada
                            @else
                            <i class="fas fa-times-circle text-gray-400"></i> Tidak ada
                            @endif
                        </span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span>Rencana Tindak</span>
                        <span class="font-semibold">
                            @if($reflection->improvement_plan)
                            <i class="fas fa-check-circle text-green-500"></i> Ada
                            @else
                            <i class="fas fa-times-circle text-gray-400"></i> Tidak ada
                            @endif
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="lg:col-span-3 space-y-8">
            <!-- Main Reflection Card -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
                <div class="bg-gradient-to-r from-indigo-500 to-purple-600 px-6 py-4">
                    <div class="flex items-center justify-between">
                        <h2 class="text-xl font-semibold text-white flex items-center">
                            <i class="fas fa-pencil-alt mr-3"></i>
                            Refleksi Pembelajaran
                        </h2>
                        <div class="flex items-center space-x-2">
                            <span class="bg-white/20 text-white px-3 py-1 rounded-full text-sm">
                                <i class="fas fa-file-alt mr-1"></i> Utama
                            </span>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <div class="prose prose-lg max-w-none">
                        <p class="text-gray-700 leading-relaxed whitespace-pre-wrap text-lg">
                            {{ $reflection->content }}
                        </p>
                    </div>

                    <!-- Reflection Stats -->
                    <div class="mt-6 flex flex-wrap gap-4 text-sm text-gray-500">
                        <div class="flex items-center">
                            <i class="fas fa-font mr-2"></i>
                            {{ str_word_count($reflection->content) }} kata
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-ruler mr-2"></i>
                            {{ strlen($reflection->content) }} karakter
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-clock mr-2"></i>
                            {{ ceil(str_word_count($reflection->content) / 200) }} menit membaca
                        </div>
                    </div>
                </div>
            </div>

            <!-- Lessons Learned Card -->
            @if($reflection->lesson_learned)
            <div class="bg-white rounded-2xl shadow-xl border border-green-200 overflow-hidden">
                <div class="bg-gradient-to-r from-green-500 to-emerald-600 px-6 py-4">
                    <h2 class="text-xl font-semibold text-white flex items-center">
                        <i class="fas fa-graduation-cap mr-3"></i>
                        Pelajaran yang Didapat
                    </h2>
                </div>
                <div class="p-6">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0 w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-lightbulb text-green-600 text-xl"></i>
                        </div>
                        <div class="prose prose-lg max-w-none flex-1">
                            <p class="text-gray-700 leading-relaxed whitespace-pre-wrap">
                                {{ $reflection->lesson_learned }}
                            </p>
                        </div>
                    </div>

                    <!-- Key Takeaways -->
                    <div class="mt-6 bg-green-50 rounded-xl p-4 border border-green-200">
                        <h4 class="font-semibold text-green-800 mb-3 flex items-center">
                            <i class="fas fa-bullseye mr-2"></i>
                            Poin Penting
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            @php
                                $sentences = preg_split('/(?<=[.?!])\s+/', $reflection->lesson_learned);
                                $keyPoints = array_slice(array_filter($sentences), 0, 4);
                            @endphp
                            @foreach($keyPoints as $point)
                            <div class="flex items-start space-x-2">
                                <i class="fas fa-check text-green-500 mt-1 flex-shrink-0"></i>
                                <span class="text-green-700 text-sm">{{ trim($point) }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Improvement Plan Card -->
            @if($reflection->improvement_plan)
            <div class="bg-white rounded-2xl shadow-xl border border-blue-200 overflow-hidden">
                <div class="bg-gradient-to-r from-blue-500 to-cyan-600 px-6 py-4">
                    <h2 class="text-xl font-semibold text-white flex items-center">
                        <i class="fas fa-chart-line mr-3"></i>
                        Rencana Perbaikan
                    </h2>
                </div>
                <div class="p-6">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0 w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-rocket text-blue-600 text-xl"></i>
                        </div>
                        <div class="prose prose-lg max-w-none flex-1">
                            <p class="text-gray-700 leading-relaxed whitespace-pre-wrap">
                                {{ $reflection->improvement_plan }}
                            </p>
                        </div>
                    </div>

                    <!-- Action Steps -->
                    <div class="mt-6 bg-blue-50 rounded-xl p-4 border border-blue-200">
                        <h4 class="font-semibold text-blue-800 mb-3 flex items-center">
                            <i class="fas fa-list-check mr-2"></i>
                            Langkah Tindakan
                        </h4>
                        <div class="space-y-3">
                            @php
                                $actionSteps = preg_split('/(?<=[.?!])\s+/', $reflection->improvement_plan);
                                $steps = array_slice(array_filter($actionSteps), 0, 6);
                            @endphp
                            @foreach($steps as $index => $step)
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0 w-6 h-6 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-sm font-semibold mt-0.5">
                                    {{ $index + 1 }}
                                </div>
                                <span class="text-blue-700 flex-1">{{ trim($step) }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Timeline & Metadata -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Timeline -->
                <div class="bg-white rounded-2xl shadow-xl border border-gray-200 p-6">
                    <h3 class="font-semibold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-history text-purple-500 mr-2"></i>
                        Linimasa
                    </h3>
                    <div class="space-y-4">
                        <div class="flex items-center space-x-3">
                            <div class="flex-shrink-0 w-3 h-3 bg-green-500 rounded-full"></div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-900">Dibuat</p>
                                <p class="text-xs text-gray-500">{{ $reflection->created_at->format('d M Y, H:i') }}</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="flex-shrink-0 w-3 h-3 bg-blue-500 rounded-full"></div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-900">Terakhir Diperbarui</p>
                                <p class="text-xs text-gray-500">{{ $reflection->updated_at->format('d M Y, H:i') }}</p>
                            </div>
                        </div>
                        @if($reflection->created_at->diffInHours($reflection->updated_at) > 0)
                        <div class="flex items-center space-x-3">
                            <div class="flex-shrink-0 w-3 h-3 bg-yellow-500 rounded-full"></div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-900">Waktu Penyuntingan</p>
                                <p class="text-xs text-gray-500">{{ $reflection->created_at->diffForHumans($reflection->updated_at) }}</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Reflection Impact -->
                <div class="bg-gradient-to-br from-purple-50 to-pink-100 rounded-2xl border border-purple-200 p-6">
                    <h3 class="font-semibold text-purple-900 mb-4 flex items-center">
                        <i class="fas fa-seedling text-purple-600 mr-2"></i>
                        Dampak Refleksi
                    </h3>
                    <div class="space-y-3 text-sm">
                        @php
                            // Hitung panjang konten
                            $contentLength = strlen($reflection->content);

                            // Hitung tingkat kedalaman berdasarkan multiple factors
                            $depthScore = 0;

                            // Factor 1: Panjang konten (maks 40 poin)
                            $lengthScore = min(40, ($contentLength / 20)); // 1 poin per 20 karakter, maks 40

                            // Factor 2: Kepadatan kata kunci pembelajaran (maks 30 poin)
                            $learningKeywords = ['belajar', 'paham', 'memahami', 'mengerti', 'siswa', 'pelajaran', 'materi', 'pengetahuan', 'keterampilan', 'kompetensi'];
                            $keywordCount = 0;
                            $contentLower = strtolower($reflection->content);
                            foreach ($learningKeywords as $keyword) {
                                $keywordCount += substr_count($contentLower, $keyword);
                            }
                            $keywordScore = min(30, $keywordCount * 3); // 3 poin per kata kunci, maks 30

                            // Factor 3: Struktur refleksi (maks 30 poin)
                            $structureScore = 0;
                            if (strlen($reflection->content) > 100) $structureScore += 10;
                            if (strlen($reflection->content) > 300) $structureScore += 10;
                            if (strlen($reflection->content) > 500) $structureScore += 10;

                            // Factor 4: Kelengkapan komponen (maks 20 poin)
                            $completenessBonus = 0;
                            if ($reflection->lesson_learned) $completenessBonus += 10;
                            if ($reflection->improvement_plan) $completenessBonus += 10;

                            // Total depth score
                            $depthScore = min(100, $lengthScore + $keywordScore + $structureScore + $completenessBonus);

                            // Konversi ke skala 1-5 untuk bintang
                            $starRating = ceil(($depthScore / 100) * 5);

                            // Hitung kelengkapan
                            $completeness = 0;
                            if($reflection->content) $completeness += 40;
                            if($reflection->lesson_learned) $completeness += 30;
                            if($reflection->improvement_plan) $completeness += 30;

                            // Hitung nilai pembelajaran (gabungan kedalaman dan kelengkapan)
                            $learningValue = ($depthScore * 0.6) + ($completeness * 0.4); // 60% kedalaman, 40% kelengkapan
                        @endphp

                        <div class="flex items-center justify-between">
                            <span class="text-purple-700">Tingkat Kedalaman</span>
                            <div class="flex items-center">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star {{ $i <= $starRating ? 'text-yellow-500' : 'text-gray-300' }} text-sm"></i>
                                @endfor
                                <span class="text-xs text-gray-500 ml-2">({{ number_format($depthScore, 1) }}/100)</span>
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <span class="text-purple-700">Kelengkapan</span>
                            <span class="font-semibold text-purple-600">
                                {{ $completeness }}%
                            </span>
                        </div>

                        <!-- Progress Bar untuk Kelengkapan -->
                        <div class="w-full bg-gray-200 rounded-full h-1.5">
                            <div class="bg-green-500 h-1.5 rounded-full transition-all duration-500"
                                 style="width: {{ $completeness }}%"></div>
                        </div>

                        <div class="flex items-center justify-between">
                            <span class="text-purple-700">Nilai Pembelajaran</span>
                            <span class="font-semibold text-purple-600">
                                @if($learningValue >= 80)
                                    <i class="fas fa-gem text-purple-500 mr-1"></i> Tinggi ({{ number_format($learningValue, 1) }})
                                @elseif($learningValue >= 60)
                                    <i class="fas fa-star text-purple-500 mr-1"></i> Sedang ({{ number_format($learningValue, 1) }})
                                @elseif($learningValue >= 40)
                                    <i class="fas fa-leaf text-purple-500 mr-1"></i> Dasar ({{ number_format($learningValue, 1) }})
                                @else
                                    <i class="fas fa-seedling text-purple-500 mr-1"></i> Pemula ({{ number_format($learningValue, 1) }})
                                @endif
                            </span>
                        </div>

                        <!-- Progress Bar untuk Nilai Pembelajaran -->
                        <div class="w-full bg-gray-200 rounded-full h-1.5">
                            <div class="bg-purple-500 h-1.5 rounded-full transition-all duration-500"
                                 style="width: {{ $learningValue }}%"></div>
                        </div>

                        <!-- Breakdown Skor (opsional, untuk insight lebih detail) -->
                        <div class="mt-2 p-2 bg-gray-50 rounded-lg text-xs text-gray-600">
                            <div class="grid grid-cols-2 gap-1">
                                <div>Panjang Konten: {{ number_format($lengthScore, 1) }}</div>
                                <div>Kata Kunci: {{ number_format($keywordScore, 1) }}</div>
                                <div>Struktur: {{ number_format($structureScore, 1) }}</div>
                                <div>Kelengkapan: {{ number_format($completenessBonus, 1) }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-200 p-6">
                <div class="flex flex-col sm:flex-row justify-between items-center space-y-4 sm:space-y-0">
                    <a href="{{ route('reflections.index') }}"
                       class="flex items-center px-6 py-3 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-50 transition-all duration-300 transform hover:scale-105">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali ke Daftar
                    </a>

                    <div class="flex items-center space-x-3">
                        {{-- @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.users.show', $reflection->user_id) }}"
                           class="flex items-center px-6 py-3 bg-gradient-to-r from-blue-500 to-cyan-600 text-white rounded-xl hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                            <i class="fas fa-user mr-2"></i>
                            Profil Siswa
                        </a>
                        @endif --}}

                        @if(auth()->user()->role === 'user' && $reflection->user_id === auth()->id())
                        <a href="{{ route('reflections.create') }}"
                           class="flex items-center px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-xl hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                            <i class="fas fa-plus mr-2"></i>
                            Refleksi Baru
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Floating Action Button (Mobile) -->
@if(auth()->user()->role === 'user' && $reflection->user_id === auth()->id())
<div class="fixed bottom-6 right-6 z-50 lg:hidden">
    <div class="flex flex-col space-y-3">
        <a href="{{ route('reflections.edit', $reflection) }}"
           class="w-14 h-14 bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-full flex items-center justify-center shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-110">
            <i class="fas fa-edit text-lg"></i>
        </a>
    </div>
</div>
@endif

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

    /* Smooth scroll behavior */
    html {
        scroll-behavior: smooth;
    }

    /* Custom gradient backgrounds */
    .gradient-bg {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    /* Card hover effects */
    .card-hover:hover {
        transform: translateY(-4px);
        transition: all 0.3s ease;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

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
        document.querySelectorAll('.bg-white.rounded-2xl').forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'all 0.6s ease';
            observer.observe(card);
        });

        // Add confetti effect when mood is positive
        @if(in_array($reflection->mood, ['Senang', 'Bersemangat', 'Termotivasi']))
        setTimeout(() => {
            createConfetti();
        }, 1000);
        @endif
    });

    // Simple confetti effect for positive moods
    function createConfetti() {
        const colors = ['#ff6b6b', '#4ecdc4', '#45b7d1', '#96ceb4', '#feca57', '#ff9ff3', '#54a0ff'];
        const confettiCount = 30;

        for (let i = 0; i < confettiCount; i++) {
            const confetti = document.createElement('div');
            confetti.className = 'confetti';
            confetti.style.cssText = `
                position: fixed;
                width: 12px;
                height: 12px;
                background: ${colors[Math.floor(Math.random() * colors.length)]};
                top: -20px;
                left: ${Math.random() * 100}vw;
                opacity: ${Math.random() + 0.5};
                transform: rotate(${Math.random() * 360}deg);
                pointer-events: none;
                z-index: 9999;
                border-radius: 2px;
            `;

            document.body.appendChild(confetti);

            // Animate confetti
            const animation = confetti.animate([
                { transform: `translateY(0) rotate(0deg)`, opacity: 1 },
                { transform: `translateY(${window.innerHeight}px) rotate(${Math.random() * 360}deg)`, opacity: 0 }
            ], {
                duration: Math.random() * 3000 + 2000,
                easing: 'cubic-bezier(0.1, 0.8, 0.2, 1)'
            });

            animation.onfinish = () => confetti.remove();
        }
    }
</script>
@endsection
