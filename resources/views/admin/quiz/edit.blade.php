@extends('layout')

@section('title', 'Edit Quiz - Admin')

@section('content')
<div class="max-w-6xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <!-- Header Section -->
    <div class="mb-8 animate-fade-in">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div class="flex-1 min-w-0">
                <div class="flex items-center mb-4">
                    <a href="{{ route('admin.quiz.index') }}"
                       class="inline-flex items-center text-indigo-600 hover:text-indigo-500 mr-4 transition duration-200 group">
                        <i class="fas fa-arrow-left mr-2 group-hover:-translate-x-1 transition-transform duration-200"></i>
                        Kembali ke Manajemen Quiz
                    </a>
                    <div class="h-6 w-px bg-gray-300 mr-4"></div>
                    <h1 class="text-3xl font-bold text-gray-800 flex items-center">
                        <div class="w-12 h-12 flex items-center justify-center bg-gradient-to-b from-indigo-400 to-purple-500 rounded-xl shadow-md mr-4">
                            <i class="fas fa-edit text-white text-2xl"></i>
                        </div>
                        <span>Edit Quiz</span>
                    </h1>
                </div>
                <p class="text-lg text-gray-600 max-w-2xl">
                    Edit dan perbarui kuis pembelajaran untuk pengalaman belajar yang lebih baik
                </p>
            </div>
            <div class="mt-4 md:mt-0">
                <div class="flex items-center space-x-2 text-sm text-gray-500 bg-gray-100 px-3 py-2 rounded-xl">
                    <i class="fas fa-info-circle text-indigo-500"></i>
                    <span>ID: {{ $quiz->id }} • Dibuat: {{ $quiz->created_at->format('d M Y') }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Notifikasi -->
    <x-notifikasi />

    <!-- Edit Form -->
    <div class="bg-white rounded-2xl shadow-large overflow-hidden animate-slide-up" style="animation-delay: 0.1s">
        <!-- Form Header -->
        <div class="px-6 py-5 bg-gradient-to-r from-indigo-500 to-purple-600">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h3 class="text-lg font-medium text-white">Form Edit Quiz</h3>
                    <p class="mt-1 text-sm text-indigo-100">
                        Perbarui informasi dan konten kuis
                    </p>
                </div>
                <div class="mt-3 sm:mt-0 flex items-center space-x-2">
                    <span class="text-indigo-100 text-sm">Status:
                        <span class="font-semibold {{ $quiz->is_active ? 'text-green-300' : 'text-red-300' }}">
                            {{ $quiz->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </span>
                </div>
            </div>
        </div>

        <form action="{{ route('admin.quiz.update', $quiz->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Basic Information -->
            <div class="p-6 border-b border-gray-200">
                <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <div class="bg-indigo-100 p-2 rounded-lg mr-3">
                        <i class="fas fa-info-circle text-indigo-600"></i>
                    </div>
                    Informasi Dasar Quiz
                </h4>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Judul Quiz -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                            <i class="fas fa-heading text-indigo-500 mr-2 text-sm"></i>
                            Judul Quiz
                        </label>
                        <div class="relative">
                            <input type="text" name="title" id="title" value="{{ old('title', $quiz->title) }}" required
                                class="pl-10 pr-4 py-3 w-full border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-200 bg-white shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-pencil-alt text-gray-400"></i>
                            </div>
                        </div>
                        @error('title')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Durasi -->
                    <div>
                        <label for="duration" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                            <i class="fas fa-clock text-indigo-500 mr-2 text-sm"></i>
                            Durasi (menit)
                        </label>
                        <div class="relative">
                            <input type="number" name="duration" id="duration" min="1" value="{{ old('duration', $quiz->duration) }}" required
                                class="pl-10 pr-4 py-3 w-full border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-200 bg-white shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-hourglass-half text-gray-400"></i>
                            </div>
                        </div>
                        @error('duration')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Deskripsi -->
                    <div class="md:col-span-2">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                            <i class="fas fa-align-left text-indigo-500 mr-2 text-sm"></i>
                            Deskripsi Quiz
                        </label>
                        <div class="relative">
                            <textarea name="description" id="description" rows="3"
                                class="pl-10 pr-4 py-3 w-full border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-200 bg-white shadow-sm">{{ old('description', $quiz->description) }}</textarea>
                            <div class="absolute top-3 left-3 flex items-center pointer-events-none">
                                <i class="fas fa-file-alt text-gray-400"></i>
                            </div>
                        </div>
                        @error('description')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Questions Section -->
            <div class="p-6">
                <div class="flex items-center justify-between mb-6">
                    <h4 class="text-lg font-semibold text-gray-900 flex items-center">
                        <div class="bg-indigo-100 p-2 rounded-lg mr-3">
                            <i class="fas fa-question-circle text-indigo-600"></i>
                        </div>
                        Soal-soal Quiz
                        <span class="ml-3 bg-indigo-100 text-indigo-800 text-sm font-medium px-3 py-1 rounded-full">
                            {{ $quiz->questions->count() }} Soal
                        </span>
                    </h4>
                    <button type="button" onclick="addQuestion()"
                        class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                        <i class="fas fa-plus mr-2"></i>
                        Tambah Soal
                    </button>
                </div>

                <!-- Questions Container -->
                <div id="questionsContainer" class="space-y-6">
                    @foreach($quiz->questions as $qIndex => $question)
                    <div class="question-item bg-gradient-to-br from-white to-gray-50 border-2 border-gray-200 rounded-2xl p-6 transition-all duration-300 hover:border-indigo-300 hover:shadow-md">
                        <div class="flex justify-between items-center mb-6">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg mr-4">
                                    <span class="text-white font-bold text-lg">{{ $qIndex + 1 }}</span>
                                </div>
                                <h5 class="text-lg font-semibold text-gray-900">Soal {{ $qIndex + 1 }}</h5>
                            </div>
                            <button type="button" onclick="removeQuestion(this)"
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-xl text-red-700 bg-red-100 hover:bg-red-200 transition-all duration-200 hover:scale-105">
                                <i class="fas fa-trash mr-2"></i>
                                Hapus Soal
                            </button>
                        </div>

                        <!-- Question Input -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-3 flex items-center">
                                <i class="fas fa-question text-indigo-500 mr-2"></i>
                                Pertanyaan
                            </label>
                            <div class="relative">
                                <input type="text" name="questions[{{ $qIndex }}][question]" value="{{ old("questions.$qIndex.question", $question->question) }}" required
                                    class="pl-10 pr-4 py-3 w-full border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-200 bg-white shadow-sm"
                                    placeholder="Tulis pertanyaan di sini...">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-edit text-gray-400"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Choices -->
                        <div class="choices-container space-y-3 mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-3 flex items-center">
                                <i class="fas fa-list-ol text-indigo-500 mr-2"></i>
                                Pilihan Jawaban
                            </label>

                            @foreach($question->choices as $cIndex => $choice)
                            <div class="choice-item flex items-center space-x-4 p-4 bg-white border border-gray-200 rounded-xl transition-all duration-200 hover:border-indigo-300 hover:shadow-sm">
                                <div class="flex items-center">
                                    <input type="radio" name="questions[{{ $qIndex }}][correct_choice]" value="{{ $cIndex }}"
                                        {{ $choice->is_correct ? 'checked' : '' }} required
                                        class="h-5 w-5 text-indigo-600 border-gray-300 focus:ring-indigo-500">
                                </div>
                                <div class="flex-1">
                                    <input type="text" name="questions[{{ $qIndex }}][choices][{{ $cIndex }}][choice]"
                                        value="{{ old("questions.$qIndex.choices.$cIndex.choice", $choice->choice) }}" required
                                        class="w-full border-0 focus:ring-0 py-2 px-3 bg-transparent text-gray-700 placeholder-gray-400"
                                        placeholder="Tulis pilihan jawaban...">
                                </div>
                                @if($cIndex >= 2)
                                <button type="button" onclick="removeChoice(this)"
                                    class="inline-flex items-center p-2 border border-transparent rounded-xl text-red-600 bg-red-100 hover:bg-red-200 transition-all duration-200 hover:scale-105">
                                    <i class="fas fa-times"></i>
                                </button>
                                @else
                                <span class="w-8"></span>
                                @endif
                            </div>
                            @endforeach
                        </div>

                        <!-- Add Choice Button -->
                        <button type="button" onclick="addChoice(this)"
                            class="inline-flex items-center px-4 py-2 border border-dashed border-gray-300 rounded-xl text-sm font-medium text-gray-600 bg-white hover:bg-gray-50 transition-all duration-200">
                            <i class="fas fa-plus mr-2"></i>
                            Tambah Pilihan Jawaban
                        </button>
                    </div>
                    @endforeach
                </div>

                <!-- Empty State -->
                @if($quiz->questions->isEmpty())
                <div id="emptyState" class="text-center py-12 bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl border-2 border-dashed border-gray-300">
                    <div class="bg-gray-200 p-4 rounded-full inline-flex mb-4">
                        <i class="fas fa-question-circle text-gray-400 text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-medium text-gray-900 mb-2">Belum ada soal</h3>
                    <p class="text-gray-500 mb-6 max-w-md mx-auto">Tambahkan soal pertama untuk membuat quiz ini aktif</p>
                    <button type="button" onclick="addQuestion()"
                        class="px-6 py-3 bg-gradient-to-r from-indigo-500 to-purple-600 text-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 flex items-center justify-center hover:scale-105 mx-auto">
                        <i class="fas fa-plus mr-2"></i>
                        Tambah Soal Pertama
                    </button>
                </div>
                @endif
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-between p-6 bg-gray-50 border-t border-gray-200 rounded-b-2xl">
                <div class="flex items-center text-sm text-gray-500">
                    <i class="fas fa-info-circle text-indigo-500 mr-2"></i>
                    Pastikan semua soal memiliki minimal 2 pilihan dan satu jawaban benar
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('admin.quiz.index') }}"
                        class="inline-flex items-center px-6 py-3 border border-gray-300 shadow-sm text-sm font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50 transition-all duration-200 hover:shadow-md">
                        <i class="fas fa-times mr-2"></i>
                        Batal
                    </a>
                    <button type="submit"
                        class="inline-flex items-center px-6 py-3 border border-transparent text-sm font-medium rounded-xl shadow-sm text-white bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 transition-all duration-200 hover:shadow-lg hover:scale-105">
                        <i class="fas fa-save mr-2"></i>
                        Update Quiz
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Templates -->
<template id="questionTemplate">
    <div class="question-item bg-gradient-to-br from-white to-gray-50 border-2 border-dashed border-gray-300 rounded-2xl p-6 transition-all duration-300 hover:border-indigo-300">
        <div class="flex justify-between items-center mb-6">
            <div class="flex items-center">
                <div class="w-10 h-10 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg mr-4">
                    <span class="text-white font-bold text-lg question-number">1</span>
                </div>
                <h5 class="text-lg font-semibold text-gray-900">Soal Baru</h5>
            </div>
            <button type="button" onclick="removeQuestion(this)"
                class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-xl text-red-700 bg-red-100 hover:bg-red-200 transition-all duration-200 hover:scale-105">
                <i class="fas fa-trash mr-2"></i>
                Hapus Soal
            </button>
        </div>

        <!-- Question Input -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-3 flex items-center">
                <i class="fas fa-question text-indigo-500 mr-2"></i>
                Pertanyaan
            </label>
            <div class="relative">
                <input type="text" name="questions[__index__][question]" required
                    class="pl-10 pr-4 py-3 w-full border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-200 bg-white shadow-sm"
                    placeholder="Tulis pertanyaan di sini...">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-edit text-gray-400"></i>
                </div>
            </div>
        </div>

        <!-- Choices -->
        <div class="choices-container space-y-3 mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-3 flex items-center">
                <i class="fas fa-list-ol text-indigo-500 mr-2"></i>
                Pilihan Jawaban
            </label>

            <div class="choice-item flex items-center space-x-4 p-4 bg-white border border-gray-200 rounded-xl transition-all duration-200 hover:border-indigo-300 hover:shadow-sm">
                <div class="flex items-center">
                    <input type="radio" name="questions[__index__][correct_choice]" value="0" required
                        class="h-5 w-5 text-indigo-600 border-gray-300 focus:ring-indigo-500">
                </div>
                <div class="flex-1">
                    <input type="text" name="questions[__index__][choices][0][choice]" required
                        class="w-full border-0 focus:ring-0 py-2 px-3 bg-transparent text-gray-700 placeholder-gray-400"
                        placeholder="Tulis pilihan jawaban...">
                </div>
                <span class="w-8"></span>
            </div>
            <!-- Additional choices will be added here -->
        </div>

        <!-- Add Choice Button -->
        <button type="button" onclick="addChoice(this)"
            class="inline-flex items-center px-4 py-2 border border-dashed border-gray-300 rounded-xl text-sm font-medium text-gray-600 bg-white hover:bg-gray-50 transition-all duration-200">
            <i class="fas fa-plus mr-2"></i>
            Tambah Pilihan Jawaban
        </button>
    </div>
</template>

<template id="choiceTemplate">
    <div class="choice-item flex items-center space-x-4 p-4 bg-white border border-gray-200 rounded-xl transition-all duration-200 hover:border-indigo-300 hover:shadow-sm">
        <div class="flex items-center">
            <input type="radio" name="questions[__index__][correct_choice]" value="__choiceIndex__" required
                class="h-5 w-5 text-indigo-600 border-gray-300 focus:ring-indigo-500">
        </div>
        <div class="flex-1">
            <input type="text" name="questions[__index__][choices][__choiceIndex__][choice]" required
                class="w-full border-0 focus:ring-0 py-2 px-3 bg-transparent text-gray-700 placeholder-gray-400"
                placeholder="Tulis pilihan jawaban...">
        </div>
        <button type="button" onclick="removeChoice(this)"
            class="inline-flex items-center p-2 border border-transparent rounded-xl text-red-600 bg-red-100 hover:bg-red-200 transition-all duration-200 hover:scale-105">
            <i class="fas fa-times"></i>
        </button>
    </div>
</template>

<style>
    .animate-fade-in {
        animation: fadeIn 0.6s ease-in-out;
    }

    .animate-slide-up {
        animation: slideUp 0.5s ease-out;
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

    .shadow-large {
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.12);
    }

    .question-item {
        transition: all 0.3s ease;
    }

    .question-item:hover {
        transform: translateY(-2px);
    }

    .choice-item {
        transition: all 0.2s ease;
    }
</style>

<script>
    let questionCount = {{ $quiz->questions->count() }};
    let choiceCounters = {};

    // Initialize choice counters for existing questions
    @foreach($quiz->questions as $qIndex => $question)
        choiceCounters[{{ $qIndex }}] = {{ $question->choices->count() }};
    @endforeach

    // Question Management
    function addQuestion() {
        const template = document.getElementById('questionTemplate');
        const container = document.getElementById('questionsContainer');
        const emptyState = document.getElementById('emptyState');

        // Hide empty state if it exists
        if (emptyState) {
            emptyState.style.display = 'none';
        }

        const newQuestion = template.content.cloneNode(true);
        const questionElement = newQuestion.querySelector('.question-item');

        // Update indices
        const questionIndex = questionCount++;
        choiceCounters[questionIndex] = 1;

        // Update all inputs with the new index
        questionElement.querySelectorAll('[name]').forEach(input => {
            input.name = input.name.replace(/__index__/g, questionIndex);
        });

        // Update question number display
        const questionNumber = container.querySelectorAll('.question-item').length + 1;
        questionElement.querySelector('.question-number').textContent = questionNumber;

        container.appendChild(newQuestion);

        // Add animation
        questionElement.style.opacity = '0';
        questionElement.style.transform = 'translateY(20px)';
        setTimeout(() => {
            questionElement.style.transition = 'all 0.3s ease';
            questionElement.style.opacity = '1';
            questionElement.style.transform = 'translateY(0)';
        }, 10);
    }

    function removeQuestion(button) {
        const questionItem = button.closest('.question-item');
        const container = document.getElementById('questionsContainer');
        const questions = container.querySelectorAll('.question-item');

        if (questions.length > 1) {
            // Add removal animation
            questionItem.style.transition = 'all 0.3s ease';
            questionItem.style.opacity = '0';
            questionItem.style.transform = 'translateY(20px)';

            setTimeout(() => {
                questionItem.remove();
                // Update question numbers
                updateQuestionNumbers();
            }, 300);
        } else {
            showAlert('Quiz harus memiliki minimal satu soal!', 'error');
        }
    }

    function updateQuestionNumbers() {
        const container = document.getElementById('questionsContainer');
        const questions = container.querySelectorAll('.question-item');

        questions.forEach((question, index) => {
            const numberElement = question.querySelector('.question-number');
            if (numberElement) {
                numberElement.textContent = index + 1;
            }

            // Update question title
            const titleElement = question.querySelector('h5');
            if (titleElement) {
                titleElement.textContent = `Soal ${index + 1}`;
            }
        });

        // Show empty state if no questions left
        if (questions.length === 0) {
            const emptyState = document.getElementById('emptyState');
            if (emptyState) {
                emptyState.style.display = 'block';
            }
        }
    }

    // Choice Management
    function addChoice(button) {
        const questionItem = button.closest('.question-item');
        const choicesContainer = questionItem.querySelector('.choices-container');
        const questionIndex = getQuestionIndex(questionItem);

        const template = document.getElementById('choiceTemplate');
        const newChoice = template.content.cloneNode(true);
        const choiceElement = newChoice.querySelector('.choice-item');

        const choiceIndex = choiceCounters[questionIndex]++;

        // Update indices
        choiceElement.querySelectorAll('[name]').forEach(input => {
            input.name = input.name.replace(/__index__/g, questionIndex)
                                 .replace(/__choiceIndex__/g, choiceIndex);
        });

        choiceElement.querySelector('input[type="radio"]').value = choiceIndex;

        choicesContainer.appendChild(newChoice);

        // Add animation
        choiceElement.style.opacity = '0';
        choiceElement.style.transform = 'translateY(10px)';
        setTimeout(() => {
            choiceElement.style.transition = 'all 0.2s ease';
            choiceElement.style.opacity = '1';
            choiceElement.style.transform = 'translateY(0)';
        }, 10);
    }

    function removeChoice(button) {
        const choicesContainer = button.closest('.choices-container');
        if (choicesContainer.querySelectorAll('.choice-item').length > 2) {
            const choiceItem = button.closest('.choice-item');

            // Add removal animation
            choiceItem.style.transition = 'all 0.2s ease';
            choiceItem.style.opacity = '0';
            choiceItem.style.transform = 'translateY(10px)';

            setTimeout(() => {
                choiceItem.remove();
            }, 200);
        } else {
            showAlert('Soal harus memiliki minimal 2 pilihan jawaban!', 'error');
        }
    }

    function getQuestionIndex(questionElement) {
        const radioInput = questionElement.querySelector('input[type="radio"]');
        const name = radioInput.name;
        const match = name.match(/questions\[(\d+)\]/);
        return match ? parseInt(match[1]) : null;
    }

    function showAlert(message, type = 'info') {
        // Create alert element
        const alert = document.createElement('div');
        alert.className = `fixed top-4 right-4 p-4 rounded-xl shadow-lg z-50 transform transition-all duration-300 ${
            type === 'error' ? 'bg-red-500 text-white' : 'bg-indigo-500 text-white'
        }`;
        alert.innerHTML = `
            <div class="flex items-center">
                <i class="fas fa-${type === 'error' ? 'exclamation-triangle' : 'info-circle'} mr-2"></i>
                <span>${message}</span>
            </div>
        `;

        document.body.appendChild(alert);

        // Remove alert after 3 seconds
        setTimeout(() => {
            alert.style.opacity = '0';
            alert.style.transform = 'translateX(100%)';
            setTimeout(() => {
                document.body.removeChild(alert);
            }, 300);
        }, 3000);
    }

    // Form validation
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');
        form.addEventListener('submit', function(e) {
            const questions = document.querySelectorAll('.question-item');
            if (questions.length === 0) {
                e.preventDefault();
                showAlert('Quiz harus memiliki minimal satu soal!', 'error');
                return;
            }

            let isValid = true;
            questions.forEach((question, qIndex) => {
                const questionText = question.querySelector('input[name*="[question]"]');
                const choices = question.querySelectorAll('.choice-item');
                const correctChoice = question.querySelector('input[type="radio"]:checked');

                if (!questionText.value.trim()) {
                    isValid = false;
                    showAlert(`Soal ${qIndex + 1} tidak boleh kosong!`, 'error');
                    return;
                }

                if (choices.length < 2) {
                    isValid = false;
                    showAlert(`Soal ${qIndex + 1} harus memiliki minimal 2 pilihan jawaban!`, 'error');
                    return;
                }

                choices.forEach((choice, cIndex) => {
                    const choiceInput = choice.querySelector('input[type="text"]');
                    if (!choiceInput.value.trim()) {
                        isValid = false;
                        showAlert(`Pilihan ${cIndex + 1} pada soal ${qIndex + 1} tidak boleh kosong!`, 'error');
                    }
                });

                if (!correctChoice) {
                    isValid = false;
                    showAlert(`Soal ${qIndex + 1} harus memiliki jawaban yang benar!`, 'error');
                }
            });

            if (!isValid) {
                e.preventDefault();
            }
        });
    });
</script>
@endsection
