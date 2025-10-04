@extends('layout')

@section('title', 'Hasil Kuis - ' . $quiz->title . ' - LKPD App')

@section('content')
<!-- Main Content -->
<div class="max-w-4xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <!-- Header Section -->
    <div class="text-center mb-8">
        <div class="bg-white shadow-2xl rounded-2xl overflow-hidden border border-gray-200">
            <!-- Result Header -->
            <div class="px-6 py-8 bg-gradient-to-r from-indigo-500 to-purple-600">
                <div class="flex items-center justify-center mb-4">
                    <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center">
                        <i class="fas fa-trophy text-white text-2xl"></i>
                    </div>
                </div>
                <h1 class="text-3xl font-bold text-white mb-2">🎉 Hasil Kuis</h1>
                <p class="text-indigo-100 text-lg">{{ $quiz->title }}</p>
            </div>

            <!-- Score Section -->
            <div class="px-6 py-8">
                <!-- Score Circle -->
                <div class="relative inline-block mb-6">
                    <div class="w-48 h-48 rounded-full flex items-center justify-center relative">
                        <!-- Background Circle -->
                        <svg class="w-full h-full transform -rotate-90" viewBox="0 0 100 100">
                            <!-- Background track -->
                            <circle cx="50" cy="50" r="45" stroke="#e5e7eb" stroke-width="8" fill="none" />
                            <!-- Progress indicator -->
                            <circle cx="50" cy="50" r="45" stroke="url(#gradient)" stroke-width="8" fill="none"
                                    stroke-dasharray="283"
                                    stroke-dashoffset="{{ 283 - (283 * $score / $total) }}"
                                    stroke-linecap="round" />
                        </svg>
                        <defs>
                            <linearGradient id="gradient" x1="0%" y1="0%" x2="100%" y2="0%">
                                <stop offset="0%" stop-color="#667eea" />
                                <stop offset="100%" stop-color="#764ba2" />
                            </linearGradient>
                        </defs>

                        <!-- Score Text -->
                        <div class="absolute inset-0 flex flex-col items-center justify-center">
                            <span class="text-4xl font-bold text-gray-900">{{ $score }}/{{ $total }}</span>
                            <span class="text-lg text-gray-600 mt-1">
                                @php
                                    $percentage = ($score / $total) * 100;
                                @endphp
                                {{ number_format($percentage, 1) }}%
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Performance Message -->
                <div class="text-center mb-8">
                    @if($percentage >= 80)
                    <div class="inline-flex items-center px-6 py-3 bg-green-100 text-green-800 rounded-full text-lg font-semibold">
                        <i class="fas fa-star mr-2 text-yellow-500"></i> Excellent! Performance Luar Biasa
                    </div>
                    @elseif($percentage >= 60)
                    <div class="inline-flex items-center px-6 py-3 bg-blue-100 text-blue-800 rounded-full text-lg font-semibold">
                        <i class="fas fa-thumbs-up mr-2"></i> Good! Hasil Bagus
                    </div>
                    @else
                    <div class="inline-flex items-center px-6 py-3 bg-amber-100 text-amber-800 rounded-full text-lg font-semibold">
                        <i class="fas fa-lightbulb mr-2"></i> Keep Learning! Terus Berlatih
                    </div>
                    @endif
                </div>

                <!-- Stats Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                    <div class="bg-green-50 border border-green-200 rounded-xl p-4 text-center">
                        <div class="text-2xl font-bold text-green-600">{{ $score }}</div>
                        <div class="text-sm text-green-700">Jawaban Benar</div>
                    </div>
                    <div class="bg-red-50 border border-red-200 rounded-xl p-4 text-center">
                        <div class="text-2xl font-bold text-red-600">{{ $total - $score }}</div>
                        <div class="text-sm text-red-700">Jawaban Salah</div>
                    </div>
                    <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 text-center">
                        <div class="text-2xl font-bold text-blue-600">{{ $total }}</div>
                        <div class="text-sm text-blue-700">Total Soal</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Detailed Results -->
    <div class="bg-white shadow-2xl rounded-2xl overflow-hidden border border-gray-200 mb-8">
        <div class="px-6 py-4 bg-gradient-to-r from-indigo-500 to-purple-600">
            <h3 class="text-lg font-medium text-white">
                <i class="fas fa-list-ol mr-2"></i> Detail Hasil Per Soal
            </h3>
        </div>

        <div class="p-6 space-y-6">
            @foreach($quiz->questions as $index => $q)
                @php
                    $userAnswerId = $details[$q->id]['selected'] ?? null;
                    $correctId    = $details[$q->id]['correct'] ?? null;
                    $isCorrect    = $details[$q->id]['is_correct'] ?? false;
                    $userChoice   = $q->choices->firstWhere('id', $userAnswerId);
                    $correctChoice = $q->choices->firstWhere('id', $correctId);
                @endphp

                <div class="question-result bg-gray-50 rounded-xl p-6 border-2 transition-all duration-300
                    {{ $isCorrect ? 'border-green-200 hover:border-green-300' : 'border-red-200 hover:border-red-300' }}">

                    <!-- Question Header -->
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0 w-8 h-8 rounded-full flex items-center justify-center text-sm font-semibold
                                {{ $isCorrect ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                                {{ $index + 1 }}
                            </div>
                            <div class="flex-1">
                                <h4 class="text-lg font-semibold text-gray-900 leading-relaxed">{{ $q->question }}</h4>
                                @if($q->explanation)
                                <p class="mt-2 text-sm text-gray-600 bg-white p-3 rounded-lg border border-gray-200">
                                    <i class="fas fa-info-circle text-blue-500 mr-1"></i>
                                    {{ $q->explanation }}
                                </p>
                                @endif
                            </div>
                        </div>

                        <!-- Status Badge -->
                        <div class="flex-shrink-0 ml-4">
                            @if($isCorrect)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-green-100 text-green-800 border border-green-300">
                                <i class="fas fa-check mr-1"></i> Benar
                            </span>
                            @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-red-100 text-red-800 border border-red-300">
                                <i class="fas fa-times mr-1"></i> Salah
                            </span>
                            @endif
                        </div>
                    </div>

                    <!-- Choices -->
                    <div class="space-y-3 ml-11">
                        @foreach($q->choices as $choice)
                            @php
                                $isUserAnswer = $choice->id == $userAnswerId;
                                $isCorrectAnswer = $choice->id == $correctId;
                                $bgColor = '';
                                $borderColor = '';
                                $textColor = 'text-gray-700';

                                if ($isCorrectAnswer) {
                                    $bgColor = 'bg-green-50';
                                    $borderColor = 'border-green-300';
                                    $textColor = 'text-green-800 font-semibold';
                                } elseif ($isUserAnswer && !$isCorrect) {
                                    $bgColor = 'bg-red-50';
                                    $borderColor = 'border-red-300';
                                    $textColor = 'text-red-800';
                                }
                            @endphp

                            <div class="choice-result p-4 rounded-lg border-2 {{ $borderColor }} {{ $bgColor }} transition-all duration-200">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <!-- Choice Indicator -->
                                        <div class="flex-shrink-0 w-6 h-6 rounded-full border-2 flex items-center justify-center
                                            {{ $isCorrectAnswer ? 'border-green-500 bg-green-500' :
                                               ($isUserAnswer && !$isCorrect ? 'border-red-500 bg-red-500' : 'border-gray-300') }}">
                                            @if($isCorrectAnswer)
                                                <i class="fas fa-check text-white text-xs"></i>
                                            @elseif($isUserAnswer && !$isCorrect)
                                                <i class="fas fa-times text-white text-xs"></i>
                                            @endif
                                        </div>

                                        <!-- Choice Text -->
                                        <span class="{{ $textColor }}">{{ $choice->choice }}</span>
                                    </div>

                                    <!-- Labels -->
                                    <div class="flex items-center space-x-2">
                                        @if($isUserAnswer)
                                        <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-blue-100 text-blue-800">
                                            <i class="fas fa-user mr-1"></i> Jawabanmu
                                        </span>
                                        @endif

                                        @if($isCorrectAnswer)
                                        <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-green-100 text-green-800">
                                            <i class="fas fa-check-circle mr-1"></i> Benar
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Feedback Message -->
                    <div class="mt-4 ml-11">
                        @if($isCorrect)
                        <div class="flex items-center space-x-2 text-green-700 bg-green-50 p-3 rounded-lg border border-green-200">
                            <i class="fas fa-check-circle text-green-500"></i>
                            <span class="font-medium">Bagus! Jawabanmu benar.</span>
                        </div>
                        @else
                        <div class="flex items-start space-x-2 text-red-700 bg-red-50 p-3 rounded-lg border border-red-200">
                            <i class="fas fa-times-circle text-red-500 mt-0.5"></i>
                            <div>
                                <span class="font-medium">Jawabanmu salah. </span>
                                <span>Jawaban yang benar: <strong class="text-red-800">{{ $correctChoice->choice ?? 'Tidak tersedia' }}</strong></span>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="bg-white shadow-2xl rounded-2xl overflow-hidden border border-gray-200">
        <div class="p-6">
            <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-6">
                <a href="{{ route('quiz.index', $quiz->id) }}"
                   class="gradient-bg text-white px-8 py-4 rounded-xl text-lg font-semibold hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-300 transform hover:scale-105 shadow-lg flex items-center justify-center">
                    <i class="fas fa-redo mr-2"></i> Ulangi Kuis
                </a>

                <a href="{{ route('quiz.index') }}"
                   class="px-8 py-4 border border-gray-300 rounded-xl text-lg font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-300 flex items-center justify-center">
                    <i class="fas fa-list mr-2"></i> Kuis Lainnya
                </a>

                <a href="{{ route('dashboard') }}"
                   class="px-8 py-4 bg-gray-600 text-white rounded-xl text-lg font-semibold hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-all duration-300 flex items-center justify-center">
                    <i class="fas fa-home mr-2"></i> Dashboard
                </a>
            </div>
        </div>
    </div>

    <!-- Performance Tips -->
    @if($percentage < 80)
    <div class="mt-8 bg-gradient-to-r from-amber-50 to-orange-50 border border-amber-200 rounded-2xl p-6">
        <div class="flex items-start space-x-4">
            <div class="flex-shrink-0 w-12 h-12 bg-amber-100 rounded-full flex items-center justify-center">
                <i class="fas fa-graduation-cap text-amber-600 text-xl"></i>
            </div>
            <div>
                <h4 class="text-lg font-semibold text-amber-800 mb-2">Tips untuk Meningkatkan</h4>
                <ul class="text-amber-700 space-y-2">
                    <li class="flex items-start space-x-2">
                        <i class="fas fa-book-open text-amber-500 mt-1 text-sm"></i>
                        <span>Pelajari kembali materi yang berkaitan dengan soal-soal yang salah</span>
                    </li>
                    <li class="flex items-start space-x-2">
                        <i class="fas fa-redo text-amber-500 mt-1 text-sm"></i>
                        <span>Ulangi kuis untuk menguji pemahamanmu</span>
                    </li>
                    <li class="flex items-start space-x-2">
                        <i class="fas fa-clock text-amber-500 mt-1 text-sm"></i>
                        <span>Luangkan waktu lebih untuk membaca soal dengan teliti</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    @else
    <div class="mt-8 bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 rounded-2xl p-6">
        <div class="flex items-start space-x-4">
            <div class="flex-shrink-0 w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                <i class="fas fa-star text-green-600 text-xl"></i>
            </div>
            <div>
                <h4 class="text-lg font-semibold text-green-800 mb-2">Performance Luar Biasa!</h4>
                <ul class="text-green-700 space-y-2">
                    <li class="flex items-start space-x-2">
                        <i class="fas fa-rocket text-green-500 mt-1 text-sm"></i>
                        <span>Kamu telah menguasai materi dengan sangat baik</span>
                    </li>
                    <li class="flex items-start space-x-2">
                        <i class="fas fa-share text-green-500 mt-1 text-sm"></i>
                        <span>Bagikan pengetahuanmu dengan teman-teman</span>
                    </li>
                    <li class="flex items-start space-x-2">
                        <i class="fas fa-forward text-green-500 mt-1 text-sm"></i>
                        <span>Lanjutkan ke kuis berikutnya untuk tantangan yang lebih tinggi</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    @endif
</div>

<style>
    .gradient-bg {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    /* Smooth transitions */
    .question-result {
        transition: all 0.3s ease;
    }

    .question-result:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
    }

    .choice-result {
        transition: all 0.2s ease;
    }

    /* Animation for score circle */
    @keyframes progressAnimation {
        from {
            stroke-dashoffset: 283;
        }
        to {
            stroke-dashoffset: {{ 283 - (283 * $score / $total) }};
        }
    }

    circle[stroke-dashoffset] {
        animation: progressAnimation 1.5s ease-in-out forwards;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add subtle animations to question cards
        const questionCards = document.querySelectorAll('.question-result');

        questionCards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';

            setTimeout(() => {
                card.style.transition = 'all 0.5s ease';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 100);
        });

        // Add confetti effect for excellent scores
        @if($percentage >= 80)
        setTimeout(() => {
            createConfetti();
        }, 1000);
        @endif
    });

    // Simple confetti effect
    function createConfetti() {
        const colors = ['#ff0000', '#00ff00', '#0000ff', '#ffff00', '#ff00ff', '#00ffff'];
        const confettiCount = 50;

        for (let i = 0; i < confettiCount; i++) {
            const confetti = document.createElement('div');
            confetti.className = 'confetti';
            confetti.style.cssText = `
                position: fixed;
                width: 10px;
                height: 10px;
                background: ${colors[Math.floor(Math.random() * colors.length)]};
                top: -10px;
                left: ${Math.random() * 100}vw;
                opacity: ${Math.random() + 0.5};
                transform: rotate(${Math.random() * 360}deg);
                pointer-events: none;
                z-index: 1000;
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
