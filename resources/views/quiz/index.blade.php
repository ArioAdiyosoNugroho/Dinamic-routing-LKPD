@extends('layout')

@section('title', 'Pilih Quiz - Belajar Interaktif')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-purple-50 py-4 md:py-8">
    <div class="max-w-7xl mx-auto px-3 sm:px-4 lg:px-8">
        <!-- Header Section -->
        <div class="mb-6 md:mb-8 animate-fade-in">
            <div class="flex flex-col space-y-4 md:space-y-0 md:flex-row md:items-center md:justify-between">
                <div class="flex-1 min-w-0">
                    <div class="flex items-center mb-3">
                        <div class="w-10 h-10 md:w-12 md:h-12 flex items-center justify-center bg-gradient-to-b from-indigo-400 to-purple-500 rounded-xl shadow-md mr-3 md:mr-4">
                            <i class="fas fa-rocket text-white text-lg md:text-2xl"></i>
                        </div>
                        <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Quiz Interaktif</h1>
                    </div>
                    <p class="text-base md:text-lg text-gray-600 max-w-2xl">
                        Tingkatkan pengetahuanmu dengan berbagai quiz menarik. Pilih quiz favoritmu dan mulai tantangan belajar!
                    </p>
                </div>
                <div class="w-full md:w-auto">
                    <div class="relative">
                        <input type="text" id="searchQuiz" placeholder="Cari quiz..."
                               class="w-full md:w-64 pl-10 pr-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-200">
                        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- User Stats -->
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3 mb-6 md:mb-8">
            <div class="dashboard-card rounded-2xl shadow-soft p-4 md:p-6 card-hover animate-slide-up" style="animation-delay: 0.1s">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-blue-100 rounded-xl p-3 md:p-4 stats-icon">
                        <i class="fas fa-trophy text-blue-600 text-xl md:text-2xl"></i>
                    </div>
                    <div class="ml-3 md:ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Quiz Diselesaikan</dt>
                            <dd class="text-xl md:text-2xl font-bold text-gray-900">{{ $userStats['completed_quizzes'] }}</dd>
                        </dl>
                        <div class="mt-1">
                            <span class="text-xs font-medium text-blue-500 bg-blue-50 px-2 py-1 rounded-full">
                                <i class="fas fa-check mr-1"></i> Total selesai
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="dashboard-card rounded-2xl shadow-soft p-4 md:p-6 card-hover animate-slide-up" style="animation-delay: 0.2s">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-green-100 rounded-xl p-3 md:p-4 stats-icon">
                        <i class="fas fa-chart-line text-green-600 text-xl md:text-2xl"></i>
                    </div>
                    <div class="ml-3 md:ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Rata-rata Skor</dt>
                            <dd class="text-xl md:text-2xl font-bold text-gray-900">{{ number_format($userStats['average_score'], 1) }}</dd>
                        </dl>
                        <div class="mt-1">
                            <span class="text-xs font-medium text-green-500 bg-green-50 px-2 py-1 rounded-full">
                                <i class="fas fa-star mr-1"></i> Performa
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="dashboard-card rounded-2xl shadow-soft p-4 md:p-6 card-hover animate-slide-up" style="animation-delay: 0.3s">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-purple-100 rounded-xl p-3 md:p-4 stats-icon">
                        <i class="fas fa-play-circle text-purple-600 text-xl md:text-2xl"></i>
                    </div>
                    <div class="ml-3 md:ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Total Percobaan</dt>
                            <dd class="text-xl md:text-2xl font-bold text-gray-900">{{ $userStats['total_attempts'] }}</dd>
                        </dl>
                        <div class="mt-1">
                            <span class="text-xs font-medium text-purple-500 bg-purple-50 px-2 py-1 rounded-full">
                                <i class="fas fa-bolt mr-1"></i> Semua usaha
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quiz List Section -->
        <div class="bg-white rounded-2xl shadow-large overflow-hidden animate-slide-up" style="animation-delay: 0.4s">
            <!-- Section Header -->
            <div class="px-4 py-4 md:px-6 md:py-5 bg-gradient-to-r from-indigo-500 to-purple-600">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <div class="mb-3 sm:mb-0">
                        <h3 class="text-lg font-medium text-white flex items-center">
                            <i class="fas fa-list-alt mr-2"></i>
                            Quiz Tersedia
                        </h3>
                        <p class="mt-1 text-sm text-indigo-100">
                            Pilih quiz yang ingin kamu kerjakan untuk meningkatkan pemahaman
                        </p>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="text-indigo-100 text-sm">Total: {{ $quizzes->count() }} quiz</span>
                    </div>
                </div>
            </div>

            @if($quizzes->isEmpty())
            <!-- Empty State -->
            <div class="px-4 py-12 sm:px-6 text-center animate-pulse">
                <div class="bg-gray-100 p-6 rounded-full inline-flex mb-4">
                    <i class="fas fa-inbox text-gray-300 text-3xl md:text-4xl"></i>
                </div>
                <h3 class="text-lg md:text-xl font-medium text-gray-900 mb-2">Belum ada quiz tersedia</h3>
                <p class="text-gray-500 mb-6 max-w-md mx-auto text-sm md:text-base">Saat ini belum ada quiz yang aktif. Silakan kembali nanti!</p>
                <div class="animate-pulse flex space-x-4 justify-center">
                    <div class="w-3 h-3 bg-gray-400 rounded-full"></div>
                    <div class="w-3 h-3 bg-gray-400 rounded-full"></div>
                    <div class="w-3 h-3 bg-gray-400 rounded-full"></div>
                </div>
            </div>
            @else
            <!-- Quiz Cards -->
            <div class="p-4 md:p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6" id="quizGrid">
                    @foreach($quizzes as $quiz)
                    @php
                        $previousAttempt = $quiz->user_attempt ?? $quiz->results->where('user_id', auth()->id())->first();
                        $completionRate = $previousAttempt ? round(($previousAttempt->score / $quiz->questions_count) * 100) : 0;
                        $isNew = !$previousAttempt;
                    @endphp

                    <div class="quiz-card bg-white rounded-2xl border border-gray-200 overflow-hidden transition-all duration-300 hover:shadow-xl group cursor-pointer flex flex-col h-full">
                        <!-- Card Header with Status -->
                        <div class="relative bg-gradient-to-r from-indigo-500 to-purple-600 p-4">
                            @if($previousAttempt)
                            <!-- Badge Selesai yang Lebih Elegan -->
                            <div class="absolute top-3 right-3">
                                <span class="bg-gradient-to-r from-emerald-500 to-green-600 text-white px-2 py-1 md:px-3 md:py-2 rounded-full text-xs font-semibold flex items-center shadow-lg shadow-emerald-500/30 transition-all duration-300">
                                    <i class="fas fa-check-circle mr-1 md:mr-1.5 text-xs"></i>
                                    <span class="hidden sm:inline">Selesai</span>
                                    <span class="sm:hidden">Done</span>
                                </span>
                            </div>
                            @else
                            <!-- Badge Baru yang Lebih Elegan -->
                            <div class="absolute top-3 right-3">
                                <span class="bg-gradient-to-r from-amber-500 to-orange-500 text-white px-2 py-1 md:px-3 md:py-2 rounded-full text-xs font-semibold flex items-center shadow-lg shadow-amber-500/30 transition-all duration-300 animate-pulse">
                                    <i class="fas fa-sparkles mr-1 md:mr-1.5 text-xs"></i>
                                    <span class="hidden sm:inline">Baru</span>
                                    <span class="sm:hidden">New</span>
                                </span>
                            </div>
                            @endif

                            <!-- Quiz Icon and Title in Header -->
                            <div class="flex items-center space-x-3">
                                <div class="flex-shrink-0 w-8 h-8 md:w-10 md:h-10 bg-white bg-opacity-20 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-question-circle text-white text-base md:text-lg"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="text-base md:text-lg font-semibold text-white truncate">
                                        {{ $quiz->title }}
                                    </h4>
                                    <p class="text-indigo-100 text-xs md:text-sm mt-1 truncate">
                                        {{ $quiz->description ?: 'Tantang dirimu dengan quiz ini!' }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Card Content -->
                        <div class="p-4 flex-1 flex flex-col">
                            <!-- Quiz Meta Information -->
                            <div class="grid grid-cols-2 gap-2 md:gap-3 mb-3 md:mb-4">
                                <div class="flex items-center text-xs md:text-sm text-gray-600 bg-blue-50 px-2 py-1 md:px-3 md:py-2 rounded-lg">
                                    <i class="fas fa-question-circle mr-1 md:mr-2 text-blue-500 text-xs md:text-sm"></i>
                                    {{ $quiz->questions_count }} Soal
                                </div>
                                <div class="flex items-center text-xs md:text-sm text-gray-600 bg-green-50 px-2 py-1 md:px-3 md:py-2 rounded-lg">
                                    <i class="fas fa-clock mr-1 md:mr-2 text-green-500 text-xs md:text-sm"></i>
                                    {{ $quiz->duration }} Menit
                                </div>
                            </div>

                            <!-- Progress Bar (if attempted) -->
                            @if($previousAttempt)
                            <div class="mb-3 md:mb-4">
                                <div class="flex justify-between text-xs md:text-sm text-gray-600 mb-2">
                                    <span class="flex items-center">
                                        <i class="fas fa-chart-bar mr-1 text-indigo-500 text-xs md:text-sm"></i>
                                        Skor Terakhir
                                    </span>
                                    <span class="font-semibold">{{ $previousAttempt->score }}/{{ $quiz->questions_count }}</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-gradient-to-r from-green-500 to-emerald-600 h-2 rounded-full transition-all duration-1000"
                                         style="width: {{ $completionRate }}%"></div>
                                </div>
                                <div class="text-right text-xs text-gray-500 mt-1">
                                    {{ $completionRate }}% Tercapai
                                </div>
                            </div>
                            @else
                            <!-- Spacer for consistent height when no progress bar -->
                            <div class="flex-1"></div>
                            @endif

                            <!-- Action Button -->
                            <div class="mt-auto pt-3 md:pt-4">
                                @if($previousAttempt)
                                <a href="{{ route('quiz.show', $quiz->id) }}"
                                   class="w-full inline-flex items-center justify-center px-3 py-2 md:px-4 md:py-3 bg-gradient-to-r from-blue-500 to-indigo-600 text-white rounded-xl font-medium hover:shadow-lg transition-all duration-300 transform hover:scale-105 group/btn shadow-sm text-sm md:text-base">
                                    <i class="fas fa-redo mr-2 group-hover/btn:rotate-180 transition-transform duration-500 text-xs md:text-sm"></i>
                                    Coba Lagi
                                </a>
                                @else
                                <a href="{{ route('quiz.show', $quiz->id) }}"
                                   class="w-full inline-flex items-center justify-center px-3 py-2 md:px-4 md:py-3 bg-gradient-to-r from-indigo-500 to-purple-600 text-white rounded-xl font-medium hover:shadow-lg transition-all duration-300 transform hover:scale-105 group/btn shadow-sm text-sm md:text-base">
                                    <i class="fas fa-play mr-2 group-hover/btn:translate-x-1 transition-transform duration-300 text-xs md:text-sm"></i>
                                    Mulai Quiz
                                </a>
                                @endif
                            </div>
                        </div>

                        <!-- Hover Effect Border -->
                        <div class="absolute inset-0 border-2 border-transparent group-hover:border-indigo-500 rounded-2xl transition-all duration-300 pointer-events-none"></div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        <!-- Motivational Section -->
        <div class="mt-6 md:mt-8 bg-gradient-to-r from-indigo-600 to-purple-700 rounded-2xl p-6 md:p-8 text-center text-white animate-slide-up" style="animation-delay: 0.5s">
            <div class="max-w-2xl mx-auto">
                <div class="w-12 h-12 md:w-16 md:h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-graduation-cap text-xl md:text-2xl"></i>
                </div>
                <h3 class="text-xl md:text-2xl font-bold mb-4">Tingkatkan Kemampuanmu Setiap Hari</h3>
                <p class="text-indigo-100 mb-6 text-base md:text-lg">
                    "Belajar bukan hanya tentang mendapatkan nilai, tapi tentang memahami dan berkembang.
                    Setiap quiz adalah langkah menuju versi terbaik dirimu."
                </p>
                <div class="flex flex-wrap justify-center gap-3 md:gap-6 text-xs md:text-sm">
                    <div class="flex items-center bg-white bg-opacity-20 px-3 py-1 md:px-4 md:py-2 rounded-full">
                        <i class="fas fa-bolt mr-1 md:mr-2"></i>
                        <span>Belajar Interaktif</span>
                    </div>
                    <div class="flex items-center bg-white bg-opacity-20 px-3 py-1 md:px-4 md:py-2 rounded-full">
                        <i class="fas fa-chart-line mr-1 md:mr-2"></i>
                        <span>Track Progress</span>
                    </div>
                    <div class="flex items-center bg-white bg-opacity-20 px-3 py-1 md:px-4 md:py-2 rounded-full">
                        <i class="fas fa-trophy mr-1 md:mr-2"></i>
                        <span>Capai Prestasi</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Stats Footer -->
        <div class="mt-6 md:mt-8 text-center">
            <div class="flex flex-col space-y-2 md:flex-row md:items-center md:space-y-0 md:space-x-6 text-xs md:text-sm text-gray-600">
                <span class="flex items-center justify-center">
                    <i class="fas fa-check-circle text-green-500 mr-2"></i>
                    {{ $userStats['completed_quizzes'] }} Quiz Diselesaikan
                </span>
                <span class="flex items-center justify-center">
                    <i class="fas fa-clock text-blue-500 mr-2"></i>
                    {{ $userStats['total_attempts'] }} Total Percobaan
                </span>
                <span class="flex items-center justify-center">
                    <i class="fas fa-star text-yellow-500 mr-2"></i>
                    Rata-rata: {{ number_format($userStats['average_score'], 1) }}
                </span>
            </div>
        </div>
    </div>
</div>

<style>
    .dashboard-card {
        background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
        border: 1px solid rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(10px);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .dashboard-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(102, 126, 234, 0.15);
    }

    .card-hover {
        transition: all 0.3s ease;
    }

    .card-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }

    .quiz-card {
        position: relative;
        transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        min-height: 280px;
    }

    .quiz-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
        transition: left 0.5s;
    }

    .quiz-card:hover::before {
        left: 100%;
    }

    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-in {
        animation: fadeIn 0.6s ease-in-out;
    }

    .animate-slide-up {
        animation: slideUp 0.5s ease-out;
    }

    /* Animation for new quizzes */
    @keyframes pulse-glow {
        0%, 100% {
            box-shadow: 0 0 5px rgba(245, 158, 11, 0.5);
            transform: scale(1);
        }
        50% {
            box-shadow: 0 0 20px rgba(245, 158, 11, 0.8);
            transform: scale(1.02);
        }
    }

    .quiz-card:has(.bg-orange-500) {
        animation: pulse-glow 2s infinite;
    }

    /* Responsive adjustments for mobile */
    @media (max-width: 768px) {
        .stats-icon {
            padding: 0.75rem;
        }

        .quiz-card {
            min-height: 260px;
        }
    }

    @media (max-width: 640px) {
        .quiz-card {
            min-height: 240px;
        }
    }
</style>

<script>
    // Search functionality
    document.getElementById('searchQuiz').addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const quizCards = document.querySelectorAll('.quiz-card');

        quizCards.forEach(card => {
            const title = card.querySelector('h4').textContent.toLowerCase();
            const description = card.querySelector('p').textContent.toLowerCase();

            if (title.includes(searchTerm) || description.includes(searchTerm)) {
                card.style.display = 'flex';
                setTimeout(() => {
                    card.style.opacity = '1';
                    card.style.transform = 'scale(1)';
                }, 50);
            } else {
                card.style.opacity = '0';
                card.style.transform = 'scale(0.8)';
                setTimeout(() => {
                    card.style.display = 'none';
                }, 300);
            }
        });
    });

    // Add some interactive effects
    document.addEventListener('DOMContentLoaded', function() {
        // Animate cards on load
        const cards = document.querySelectorAll('.quiz-card');
        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';

            setTimeout(() => {
                card.style.transition = 'all 0.6s ease';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 100);
        });

        // Add celebration effect when user has completed many quizzes
        const completedQuizzes = {{ $userStats['completed_quizzes'] }};
        if (completedQuizzes >= 3) {
            setTimeout(createCelebration, 1000);
        }
    });

    // Celebration effect for active users
    function createCelebration() {
        const colors = ['#ff6b6b', '#4ecdc4', '#45b7d1', '#96ceb4', '#feca57', '#ff9ff3', '#54a0ff'];

        for (let i = 0; i < 20; i++) {
            const confetti = document.createElement('div');
            confetti.className = 'confetti';
            confetti.style.cssText = `
                position: fixed;
                width: 8px;
                height: 8px;
                background: ${colors[Math.floor(Math.random() * colors.length)]};
                top: -20px;
                left: ${Math.random() * 100}vw;
                opacity: ${Math.random() + 0.5};
                transform: rotate(${Math.random() * 360}deg);
                pointer-events: none;
                z-index: 40;
                border-radius: 2px;
            `;

            document.body.appendChild(confetti);

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
