@extends('layout')

@section('title', $quiz->title . ' - LKPD App')

@section('content')
<!-- Main Content -->
<div class="max-w-4xl mx-auto py-4 md:py-6 px-3 sm:px-4 lg:px-8">
    <!-- Header Section -->
    <div class="text-center mb-6 md:mb-8">
        <div class="flex items-center justify-center mb-3">
            <div class="w-10 h-10 md:w-12 md:h-12 flex items-center justify-center bg-gradient-to-b from-indigo-400 to-purple-500 rounded-xl shadow-md mr-3">
                <i class="fas fa-question-circle text-white text-lg md:text-xl"></i>
            </div>
            <h1 class="text-2xl md:text-3xl font-bold text-gray-900">{{ $quiz->title }}</h1>
        </div>

        @if($quiz->description)
        <p class="mt-2 text-base md:text-lg text-gray-600 max-w-2xl mx-auto px-2">
            {{ $quiz->description }}
        </p>
        @endif

        <!-- Quiz Info Cards -->
        <div class="mt-4 md:mt-6 grid grid-cols-1 sm:grid-cols-3 gap-3 md:gap-4 max-w-2xl mx-auto">
            @if($quiz->duration)
            <div class="bg-blue-50 border border-blue-200 rounded-xl p-3 md:p-4 text-center">
                <div class="flex items-center justify-center space-x-1 md:space-x-2">
                    <i class="fas fa-clock text-blue-600 text-lg md:text-xl"></i>
                    <span class="text-xs md:text-sm font-medium text-blue-800">Durasi</span>
                </div>
                <p class="mt-1 text-base md:text-lg font-semibold text-blue-900">{{ $quiz->duration }} menit</p>
            </div>
            @endif

            <div class="bg-purple-50 border border-purple-200 rounded-xl p-3 md:p-4 text-center">
                <div class="flex items-center justify-center space-x-1 md:space-x-2">
                    <i class="fas fa-list-ol text-purple-600 text-lg md:text-xl"></i>
                    <span class="text-xs md:text-sm font-medium text-purple-800">Jumlah Soal</span>
                </div>
                <p class="mt-1 text-base md:text-lg font-semibold text-purple-900">{{ count($quiz->questions) }} Soal</p>
            </div>

            <div class="bg-green-50 border border-green-200 rounded-xl p-3 md:p-4 text-center">
                <div class="flex items-center justify-center space-x-1 md:space-x-2">
                    <i class="fas fa-brain text-green-600 text-lg md:text-xl"></i>
                    <span class="text-xs md:text-sm font-medium text-green-800">Kesulitan</span>
                </div>
                <p class="mt-1 text-base md:text-lg font-semibold text-green-900">
                    @php
                        $questionCount = count($quiz->questions);
                        $difficulty = $questionCount <= 5 ? 'Mudah' : ($questionCount <= 10 ? 'Sedang' : 'Sulit');
                    @endphp
                    {{ $difficulty }}
                </p>
            </div>
        </div>

        <!-- Previous Attempt Info -->
        @if($previousAttempt)
        <div class="mt-4 md:mt-6 max-w-2xl mx-auto">
            <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-3 md:p-4">
                <div class="flex items-center justify-center space-x-2 md:space-x-3">
                    <i class="fas fa-history text-yellow-600 text-lg md:text-xl"></i>
                    <div class="text-center">
                        <h4 class="text-base md:text-lg font-semibold text-yellow-800">Attempt Sebelumnya</h4>
                        <p class="text-yellow-700 text-sm md:text-base">
                            Skor: <strong>{{ $previousAttempt->score }}/{{ $quiz->questions->count() }}</strong>
                            ({{ round(($previousAttempt->score / $quiz->questions->count()) * 100) }}%)
                        </p>
                        <p class="text-xs md:text-sm text-yellow-600 mt-1">
                            Dicapai: {{ $previousAttempt->created_at->format('d M Y H:i') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>

    <!-- Quiz Content -->
    <div class="bg-white shadow-xl md:shadow-2xl rounded-xl md:rounded-2xl overflow-hidden border border-gray-200">
        <!-- Quiz Header -->
        <div class="px-4 md:px-6 py-3 md:py-4 bg-gradient-to-r from-indigo-500 to-purple-600">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-2 md:space-y-0">
                <h3 class="text-base md:text-lg font-medium text-white flex items-center justify-center md:justify-start">
                    <i class="fas fa-pencil-alt mr-2"></i> Mulai Quiz
                </h3>
                <div class="flex items-center justify-center space-x-2 md:space-x-4">
                    @if($quiz->duration)
                    <div id="timer" class="bg-white/20 text-white px-2 md:px-3 py-1 rounded-full text-xs md:text-sm font-medium">
                        <i class="fas fa-stopwatch mr-1"></i>
                        <span id="minutes">{{ $quiz->duration }}</span>:<span id="seconds">00</span>
                    </div>
                    @endif
                    <span class="bg-white/20 text-white px-2 md:px-3 py-1 rounded-full text-xs md:text-sm font-medium">
                        <i class="fas fa-question-circle mr-1"></i> {{ count($quiz->questions) }} Soal
                    </span>
                </div>
            </div>
        </div>

        <!-- Quiz Status (if inactive) -->
        @if(!$quiz->is_active)
        <div class="m-4 md:m-6 bg-red-50 border border-red-200 rounded-xl p-4 md:p-6 text-center">
            <div class="flex items-center justify-center space-x-2 md:space-x-3">
                <i class="fas fa-exclamation-triangle text-red-500 text-xl md:text-2xl"></i>
                <div>
                    <h4 class="text-base md:text-lg font-semibold text-red-800">Quiz Tidak Aktif</h4>
                    <p class="text-red-600 mt-1 text-sm md:text-base">Quiz ini sedang tidak dapat diakses. Silakan hubungi administrator.</p>
                </div>
            </div>
        </div>
        @else
        <!-- Progress Bar -->
        <div class="px-4 md:px-6 pt-3 md:pt-4">
            <div class="flex items-center justify-between text-xs md:text-sm text-gray-600 mb-2">
                <span>Progress</span>
                <span id="progress-text">0/{{ count($quiz->questions) }}</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2">
                <div id="progress-bar" class="h-2 rounded-full bg-gradient-to-r from-green-400 to-blue-500 transition-all duration-500 ease-out" style="width: 0%"></div>
            </div>
        </div>

        <!-- Quiz Form -->
        <form method="POST" action="{{ route('quiz.submit', $quiz->id) }}" id="quiz-form" class="p-4 md:p-6">
            @csrf

            <!-- Questions Container -->
            <div class="space-y-6 md:space-y-8" id="questions-container">
                @foreach($quiz->questions as $index => $question)
                <div class="question-card bg-gray-50 rounded-xl p-4 md:p-6 border border-gray-200 transition-all duration-300" data-question-index="{{ $index }}">
                    <!-- Question Header -->
                    <div class="flex items-start justify-between mb-3 md:mb-4">
                        <div class="flex items-start space-x-2 md:space-x-3">
                            <span class="flex-shrink-0 w-7 h-7 md:w-8 md:h-8 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center text-xs md:text-sm font-semibold">
                                {{ $index + 1 }}
                            </span>
                            <div class="flex-1">
                                <h4 class="text-base md:text-lg font-semibold text-gray-900 leading-relaxed">{{ $question->question }}</h4>
                                @if($question->explanation)
                                <p class="mt-1 text-xs md:text-sm text-gray-600">{{ $question->explanation }}</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Choices -->
                    <div class="space-y-2 md:space-y-3 ml-0 md:ml-11">
                        @foreach($question->choices as $choice)
                        <label class="choice-label flex items-center space-x-3 p-3 md:p-4 rounded-lg border-2 border-gray-200 cursor-pointer transition-all duration-200 hover:border-indigo-300 hover:bg-indigo-50 group">
                            <input type="radio"
                                   name="q_{{ $question->id }}"
                                   value="{{ $choice->id }}"
                                   class="hidden choice-input">
                            <div class="flex-shrink-0 w-5 h-5 md:w-6 md:h-6 border-2 border-gray-300 rounded-full flex items-center justify-center transition-all duration-200 group-hover:border-indigo-400">
                                <div class="choice-indicator w-2 h-2 md:w-3 md:h-3 rounded-full bg-transparent transition-all duration-200"></div>
                            </div>
                            <span class="text-sm md:text-base text-gray-700 font-medium flex-1 transition-colors duration-200 group-hover:text-indigo-700">
                                {{ $choice->choice }}
                            </span>
                            @if($choice->is_correct)
                            <i class="fas fa-check text-green-500 text-xs md:text-sm opacity-0 transition-opacity duration-200"></i>
                            @endif
                        </label>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Navigation & Submit -->
            <div class="mt-6 md:mt-8 pt-4 md:pt-6 border-t border-gray-200">
                <div class="flex flex-col space-y-4 md:space-y-0">
                    <!-- Question Navigation -->
                    <div class="flex flex-col items-center space-y-2">
                        <span class="text-xs md:text-sm text-gray-600">Navigasi Soal:</span>
                        <div class="flex flex-wrap justify-center gap-1 md:gap-2 max-w-full">
                            @foreach($quiz->questions as $index => $question)
                            <button type="button"
                                    class="nav-dot w-7 h-7 md:w-8 md:h-8 rounded-full border border-gray-300 text-xs font-medium flex items-center justify-center transition-all duration-200 hover:border-indigo-400 hover:bg-indigo-50"
                                    data-question-index="{{ $index }}">
                                {{ $index + 1 }}
                            </button>
                            @endforeach
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-center">
                        <button type="submit"
                                class="w-full max-w-xs gradient-bg text-white px-6 py-3 md:px-8 md:py-3 rounded-xl text-base md:text-lg font-semibold hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-300 transform hover:scale-105 shadow-lg flex items-center justify-center">
                            <i class="fas fa-paper-plane mr-2"></i> Kumpulkan Quiz
                        </button>
                    </div>
                </div>
            </div>
        </form>
        @endif
    </div>

    <!-- Quiz Tips -->
    <div class="mt-6 md:mt-8 bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-xl md:rounded-2xl p-4 md:p-6">
        <div class="flex items-start space-x-3 md:space-x-4">
            <div class="flex-shrink-0 w-10 h-10 md:w-12 md:h-12 bg-blue-100 rounded-full flex items-center justify-center">
                <i class="fas fa-lightbulb text-blue-600 text-lg md:text-xl"></i>
            </div>
            <div class="flex-1">
                <h4 class="text-base md:text-lg font-semibold text-blue-800 mb-2">Tips Mengerjakan Quiz</h4>
                <ul class="text-blue-700 space-y-2 text-sm md:text-base">
                    <li class="flex items-start space-x-2">
                        <i class="fas fa-check-circle text-blue-500 mt-0.5 md:mt-1 text-xs md:text-sm"></i>
                        <span>Baca setiap pertanyaan dengan teliti sebelum memilih jawaban</span>
                    </li>
                    <li class="flex items-start space-x-2">
                        <i class="fas fa-check-circle text-blue-500 mt-0.5 md:mt-1 text-xs md:text-sm"></i>
                        <span>Gunakan navigasi untuk melompat ke pertanyaan tertentu</span>
                    </li>
                    <li class="flex items-start space-x-2">
                        <i class="fas fa-check-circle text-blue-500 mt-0.5 md:mt-1 text-xs md:text-sm"></i>
                        <span>Pastikan semua pertanyaan telah terjawab sebelum mengumpulkan</span>
                    </li>
                    @if($quiz->duration)
                    <li class="flex items-start space-x-2">
                        <i class="fas fa-check-circle text-blue-500 mt-0.5 md:mt-1 text-xs md:text-sm"></i>
                        <span>Perhatikan waktu yang tersisa dan kelola dengan baik</span>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>

<style>
    .gradient-bg {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    /* Choice selection styles */
    .choice-label.selected {
        border-color: #6366f1;
        background-color: #eef2ff;
    }

    .choice-label.selected .choice-indicator {
        background-color: #6366f1;
    }

    .choice-label.selected span {
        color: #3730a3;
    }

    /* Navigation dot styles */
    .nav-dot.answered {
        background-color: #10b981;
        border-color: #10b981;
        color: white;
    }

    .nav-dot.current {
        background-color: #6366f1;
        border-color: #6366f1;
        color: white;
    }

    /* Smooth transitions */
    .question-card {
        transition: all 0.3s ease;
    }

    .choice-label {
        transition: all 0.2s ease;
    }

    /* Timer warning styles */
    .timer-warning {
        background-color: #ef4444 !important;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.7; }
    }

    /* Mobile-specific optimizations */
    @media (max-width: 640px) {
        .question-card {
            margin-bottom: 1rem;
            padding: 1rem;
        }

        .choice-label {
            padding: 0.75rem;
            margin-bottom: 0.5rem;
        }

        .nav-dot {
            width: 2rem;
            height: 2rem;
            font-size: 0.75rem;
        }

        /* Floating navigation for mobile */
        .floating-nav {
            position: fixed;
            bottom: 1rem;
            right: 1rem;
            z-index: 40;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .floating-nav button {
            width: 3rem;
            height: 3rem;
            background: #6366f1;
            color: white;
            border-radius: 50%;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
            border: none;
        }

        .floating-nav button:hover {
            background: #4f46e5;
            transform: scale(1.05);
        }

        .floating-nav button:disabled {
            background: #9ca3af;
            transform: none;
        }
    }

    /* Prevent horizontal scrolling */
    body {
        overflow-x: hidden;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('quiz-form');
        const questions = document.querySelectorAll('.question-card');
        const choiceInputs = document.querySelectorAll('.choice-input');
        const choiceLabels = document.querySelectorAll('.choice-label');
        const navDots = document.querySelectorAll('.nav-dot');
        const progressBar = document.getElementById('progress-bar');
        const progressText = document.getElementById('progress-text');

        let currentQuestionIndex = 0;
        let answeredQuestions = new Set();

        // Timer functionality
        @if($quiz->duration)
        let duration = {{ $quiz->duration }} * 60; // Convert to seconds
        const timerElement = document.getElementById('timer');
        const minutesElement = document.getElementById('minutes');
        const secondsElement = document.getElementById('seconds');

        function updateTimer() {
            if (duration <= 0) {
                // Time's up - auto submit
                showTimeUpModal();
                return;
            }

            const minutes = Math.floor(duration / 60);
            const seconds = duration % 60;

            minutesElement.textContent = minutes.toString().padStart(2, '0');
            secondsElement.textContent = seconds.toString().padStart(2, '0');

            // Change color when time is running out
            if (duration <= 300) { // 5 minutes
                timerElement.classList.add('timer-warning');

                // Show warning when 1 minute left
                if (duration === 60) {
                    showTimeWarning('Hanya 1 menit lagi!');
                }
            }

            duration--;
        }

        function showTimeUpModal() {
            const modal = document.createElement('div');
            modal.className = 'fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 p-4';
            modal.innerHTML = `
                <div class="bg-white rounded-2xl p-6 max-w-sm w-full text-center">
                    <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-exclamation-triangle text-red-500 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Waktu Habis!</h3>
                    <p class="text-gray-600 mb-6">Waktu pengerjaan quiz telah berakhir. Jawaban Anda akan dikumpulkan secara otomatis.</p>
                    <button type="button" id="auto-submit-btn" class="w-full bg-red-500 text-white py-3 rounded-xl font-semibold hover:bg-red-600 transition-colors">
                        Kumpulkan Sekarang
                    </button>
                </div>
            `;
            document.body.appendChild(modal);

            document.getElementById('auto-submit-btn').addEventListener('click', function() {
                form.submit();
            });

            // Auto submit after 5 seconds if user doesn't click
            setTimeout(() => {
                if (document.body.contains(modal)) {
                    form.submit();
                }
            }, 5000);
        }

        function showTimeWarning(message) {
            const warning = document.createElement('div');
            warning.className = 'fixed top-4 left-1/2 transform -translate-x-1/2 z-50 bg-red-500 text-white px-4 py-3 rounded-xl shadow-lg animate-pulse max-w-xs text-center';
            warning.innerHTML = `
                <div class="flex items-center justify-center space-x-2">
                    <i class="fas fa-exclamation-triangle"></i>
                    <span class="font-semibold text-sm">${message}</span>
                </div>
            `;
            document.body.appendChild(warning);

            setTimeout(() => {
                warning.remove();
            }, 5000);
        }

        const timerInterval = setInterval(updateTimer, 1000);
        updateTimer(); // Initial call
        @endif

        // Choice selection
        choiceLabels.forEach(label => {
            label.addEventListener('click', function() {
                const input = this.querySelector('.choice-input');
                const questionCard = this.closest('.question-card');
                const questionIndex = parseInt(questionCard.dataset.questionIndex);

                // Remove selected class from all choices in this question
                const allChoicesInQuestion = questionCard.querySelectorAll('.choice-label');
                allChoicesInQuestion.forEach(choice => {
                    choice.classList.remove('selected');
                });

                // Add selected class to clicked choice
                this.classList.add('selected');
                input.checked = true;

                // Mark question as answered
                answeredQuestions.add(questionIndex);
                updateProgress();
                updateNavigation();

                // Auto-save progress
                autoSaveProgress();

                // Show subtle feedback instead of auto-scroll
                showSelectionFeedback(questionCard);
            });
        });

        // Show subtle feedback when answer is selected
        function showSelectionFeedback(questionCard) {
            questionCard.style.transform = 'translateY(-2px)';
            questionCard.style.boxShadow = '0 4px 12px rgba(0, 0, 0, 0.1)';

            setTimeout(() => {
                questionCard.style.transform = 'translateY(0)';
                questionCard.style.boxShadow = '';
            }, 300);
        }

        // Navigation dots
        navDots.forEach(dot => {
            dot.addEventListener('click', function() {
                const questionIndex = parseInt(this.dataset.questionIndex);
                scrollToQuestion(questionIndex);
            });
        });

        function scrollToQuestion(index) {
            const questionCard = document.querySelector(`[data-question-index="${index}"]`);
            if (questionCard) {
                // Mobile-optimized scrolling
                const offset = window.innerWidth < 768 ? 80 : 120;
                const elementPosition = questionCard.getBoundingClientRect().top;
                const offsetPosition = elementPosition + window.pageYOffset - offset;

                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });

                // Add highlight effect
                questionCard.style.transform = 'scale(1.02)';
                questionCard.style.boxShadow = '0 4px 12px rgba(0, 0, 0, 0.1)';

                setTimeout(() => {
                    questionCard.style.transform = 'scale(1)';
                    questionCard.style.boxShadow = '';
                }, 600);

                // Update current question for navigation
                currentQuestionIndex = index;
                updateNavigation();
            }
        }

        function updateProgress() {
            const totalQuestions = questions.length;
            const answeredCount = answeredQuestions.size;
            const progressPercentage = (answeredCount / totalQuestions) * 100;

            progressBar.style.width = `${progressPercentage}%`;
            progressText.textContent = `${answeredCount}/${totalQuestions}`;
        }

        function updateNavigation() {
            navDots.forEach(dot => {
                const questionIndex = parseInt(dot.dataset.questionIndex);

                dot.classList.remove('answered', 'current');

                if (answeredQuestions.has(questionIndex)) {
                    dot.classList.add('answered');
                }

                if (questionIndex === currentQuestionIndex) {
                    dot.classList.add('current');
                }
            });
        }

        // Form submission confirmation
        form.addEventListener('submit', function(e) {
            const totalQuestions = questions.length;
            const answeredCount = answeredQuestions.size;

            if (answeredCount < totalQuestions) {
                e.preventDefault();
                showSubmissionModal(answeredCount, totalQuestions);
                return;
            }

            // Show loading state
            showLoadingState();

            @if($quiz->duration)
            clearInterval(timerInterval);
            @endif
        });

        function showSubmissionModal(answered, total) {
            const modal = document.createElement('div');
            modal.className = 'fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 p-4';
            modal.innerHTML = `
                <div class="bg-white rounded-2xl p-6 max-w-sm w-full text-center">
                    <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-exclamation-circle text-yellow-500 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Konfirmasi Pengumpulan</h3>
                    <p class="text-gray-600 mb-4">Anda telah menjawab <strong>${answered} dari ${total}</strong> pertanyaan. Apakah Anda yakin ingin mengumpulkan quiz?</p>
                    <div class="flex space-x-3">
                        <button type="button" id="cancel-submit" class="flex-1 bg-gray-200 text-gray-800 py-3 rounded-xl font-semibold hover:bg-gray-300 transition-colors">
                            Batal
                        </button>
                        <button type="button" id="confirm-submit" class="flex-1 bg-indigo-500 text-white py-3 rounded-xl font-semibold hover:bg-indigo-600 transition-colors">
                            Ya, Kumpulkan
                        </button>
                    </div>
                </div>
            `;
            document.body.appendChild(modal);

            document.getElementById('cancel-submit').addEventListener('click', function() {
                modal.remove();
            });

            document.getElementById('confirm-submit').addEventListener('click', function() {
                modal.remove();
                showLoadingState();
                form.submit();
            });
        }

        function showLoadingState() {
            const submitButton = form.querySelector('button[type="submit"]');
            const originalText = submitButton.innerHTML;
            submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Mengumpulkan...';
            submitButton.disabled = true;

            // Clear saved progress
            localStorage.removeItem('quiz_progress_{{ $quiz->id }}');
        }

        // Auto-save progress
        function autoSaveProgress() {
            const formData = new FormData(form);
            const answers = {};

            formData.forEach((value, key) => {
                if (key.startsWith('q_')) {
                    answers[key] = value;
                }
            });

            localStorage.setItem('quiz_progress_{{ $quiz->id }}', JSON.stringify({
                answers: answers,
                timestamp: new Date().toISOString()
            }));
        }

        // Load saved progress
        function loadSavedProgress() {
            const saved = localStorage.getItem('quiz_progress_{{ $quiz->id }}');
            if (saved) {
                try {
                    const data = JSON.parse(saved);
                    const answers = data.answers;

                    Object.keys(answers).forEach(questionName => {
                        const input = document.querySelector(`input[name="${questionName}"][value="${answers[questionName]}"]`);
                        if (input) {
                            input.checked = true;
                            input.closest('.choice-label').classList.add('selected');

                            const questionCard = input.closest('.question-card');
                            const questionIndex = parseInt(questionCard.dataset.questionIndex);
                            answeredQuestions.add(questionIndex);
                        }
                    });

                    updateProgress();
                    updateNavigation();

                    // Show recovery message
                    const recoveryTime = new Date(data.timestamp).toLocaleString();
                    showRecoveryMessage(`Progress quiz berhasil dipulihkan (disimpan: ${recoveryTime})`);
                } catch (e) {
                    console.error('Error loading saved progress:', e);
                }
            }
        }

        function showRecoveryMessage(message) {
            const messageDiv = document.createElement('div');
            messageDiv.className = 'fixed top-4 left-1/2 transform -translate-x-1/2 z-50 bg-green-500 text-white px-4 py-3 rounded-xl shadow-lg max-w-xs text-center';
            messageDiv.innerHTML = `
                <div class="flex items-center justify-center space-x-2">
                    <i class="fas fa-check-circle"></i>
                    <span class="text-sm">${message}</span>
                </div>
            `;
            document.body.appendChild(messageDiv);

            setTimeout(() => {
                messageDiv.remove();
            }, 5000);
        }

        // Set up auto-save
        choiceInputs.forEach(input => {
            input.addEventListener('change', autoSaveProgress);
        });

        // Auto-save every 30 seconds as backup
        const autoSaveInterval = setInterval(autoSaveProgress, 30000);

        // Load any saved progress
        loadSavedProgress();

        // Initialize progress
        updateProgress();
        updateNavigation();

        // Warn before leaving page if there's progress
        window.addEventListener('beforeunload', function(e) {
            if (answeredQuestions.size > 0) {
                e.preventDefault();
                e.returnValue = 'Progress quiz Anda akan hilang jika Anda meninggalkan halaman ini. Apakah Anda yakin?';
                return e.returnValue;
            }
        });

        // Clean up on successful submit
        form.addEventListener('submit', function() {
            clearInterval(autoSaveInterval);
            localStorage.removeItem('quiz_progress_{{ $quiz->id }}');

            @if($quiz->duration)
            clearInterval(timerInterval);
            @endif
        });

        // Mobile-specific enhancements
        if (window.innerWidth < 768) {
            // Add floating navigation for mobile
            const floatingNav = document.createElement('div');
            floatingNav.className = 'floating-nav';
            floatingNav.innerHTML = `
                <button id="prev-question" class="floating-nav-btn" title="Soal Sebelumnya">
                    <i class="fas fa-chevron-up"></i>
                </button>
                <button id="next-question" class="floating-nav-btn" title="Soal Berikutnya">
                    <i class="fas fa-chevron-down"></i>
                </button>
            `;
            document.body.appendChild(floatingNav);

            // Update button states
            function updateFloatingNav() {
                const prevBtn = document.getElementById('prev-question');
                const nextBtn = document.getElementById('next-question');

                prevBtn.disabled = currentQuestionIndex === 0;
                nextBtn.disabled = currentQuestionIndex === questions.length - 1;

                if (prevBtn.disabled) {
                    prevBtn.style.opacity = '0.5';
                } else {
                    prevBtn.style.opacity = '1';
                }

                if (nextBtn.disabled) {
                    nextBtn.style.opacity = '0.5';
                } else {
                    nextBtn.style.opacity = '1';
                }
            }

            document.getElementById('prev-question').addEventListener('click', function() {
                if (currentQuestionIndex > 0) {
                    scrollToQuestion(currentQuestionIndex - 1);
                }
            });

            document.getElementById('next-question').addEventListener('click', function() {
                if (currentQuestionIndex < questions.length - 1) {
                    scrollToQuestion(currentQuestionIndex + 1);
                }
            });

            // Initialize floating nav state
            updateFloatingNav();

            // Update floating nav when current question changes
            const originalScrollToQuestion = scrollToQuestion;
            scrollToQuestion = function(index) {
                originalScrollToQuestion(index);
                setTimeout(updateFloatingNav, 100);
            };
        }
    });
</script>
@endsection
