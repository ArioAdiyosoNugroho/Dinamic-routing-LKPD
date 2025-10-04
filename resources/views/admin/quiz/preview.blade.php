@extends('layout')

@section('title', $quiz->title . ' - Preview Admin')

@section('content')
<div class="max-w-4xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
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
                        <div class="bg-gradient-to-r from-indigo-500 to-purple-600 p-3 rounded-xl mr-4 shadow-lg">
                            <i class="fas fa-eye text-white text-xl"></i>
                        </div>
                        <span>Preview Kuis - Admin</span>
                    </h1>
                </div>
                <p class="text-lg text-gray-600 max-w-3xl">
                    Tinjau detail kuis sebagai administrator
                </p>
            </div>
            <div class="mt-4 md:mt-0">
                <div class="flex items-center space-x-2 text-sm text-gray-500 bg-gray-100 px-3 py-2 rounded-lg">
                    <i class="fas fa-user-shield text-indigo-500"></i>
                    <span>{{ Auth::user()->name }} (Admin)</span>
                    <span class="mx-1">•</span>
                    <i class="fas fa-calendar text-indigo-500"></i>
                    <span>{{ now()->format('d M Y') }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Quiz Overview -->
    <div class="bg-white rounded-2xl shadow-large overflow-hidden mb-8 animate-slide-up" style="animation-delay: 0.1s">
        <div class="px-6 py-5 bg-gradient-to-r from-indigo-500 to-purple-600">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div class="flex-1">
                    <h2 class="text-2xl font-bold text-white mb-2">{{ $quiz->title }}</h2>
                    <p class="text-indigo-100 text-lg">
                        {{ $quiz->description ?: 'Deskripsi kuis tidak tersedia' }}
                    </p>
                </div>
                <div class="mt-3 sm:mt-0 flex items-center space-x-3">
                    <span class="bg-white/20 text-white px-3 py-1 rounded-full text-sm font-medium">
                        <i class="fas fa-question-circle mr-1"></i>
                        {{ $quiz->questions->count() }} Soal
                    </span>
                    <span class="bg-white/20 text-white px-3 py-1 rounded-full text-sm font-medium">
                        <i class="fas fa-power-off mr-1"></i>
                        {{ $quiz->is_active ? 'Aktif' : 'Nonaktif' }}
                    </span>
                </div>
            </div>
        </div>

        <div class="p-6">
            <!-- Quiz Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="flex items-center p-4 bg-blue-50 rounded-xl border border-blue-200">
                    <div class="bg-blue-100 p-3 rounded-lg mr-4">
                        <i class="fas fa-clock text-blue-600 text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Durasi Pengerjaan</p>
                        <p class="text-xl font-bold text-gray-900">{{ $quiz->duration }} Menit</p>
                    </div>
                </div>

                <div class="flex items-center p-4 bg-green-50 rounded-xl border border-green-200">
                    <div class="bg-green-100 p-3 rounded-lg mr-4">
                        <i class="fas fa-question-circle text-green-600 text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Jumlah Soal</p>
                        <p class="text-xl font-bold text-gray-900">{{ $quiz->questions->count() }} Soal</p>
                    </div>
                </div>

                <div class="flex items-center p-4 bg-purple-50 rounded-xl border border-purple-200">
                    <div class="bg-purple-100 p-3 rounded-lg mr-4">
                        <i class="fas fa-star text-purple-600 text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Status</p>
                        <p class="text-xl font-bold text-gray-900 {{ $quiz->is_active ? 'text-green-600' : 'text-red-600' }}">
                            {{ $quiz->is_active ? 'Aktif' : 'Nonaktif' }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Admin Notice -->
            <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-xl">
                <div class="flex items-start">
                    <div class="bg-blue-100 p-2 rounded-lg mr-3">
                        <i class="fas fa-info-circle text-blue-600"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-blue-800 font-medium mb-1">Mode Preview Administrator</p>
                        <p class="text-blue-700 text-sm">
                            Anda sedang melihat preview kuis. Halaman ini hanya untuk review konten kuis.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Instructions -->
            <div class="bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl p-5 mb-6 border border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <div class="bg-indigo-100 p-2 rounded-lg mr-3">
                        <i class="fas fa-info-circle text-indigo-600"></i>
                    </div>
                    Informasi Kuis
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="flex items-start space-x-3">
                        <div class="bg-blue-100 p-1 rounded mt-0.5">
                            <i class="fas fa-list-ol text-blue-600 text-sm"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-800">Total Soal</p>
                            <p class="text-xs text-gray-600">{{ $quiz->questions->count() }} soal pilihan ganda</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="bg-green-100 p-1 rounded mt-0.5">
                            <i class="fas fa-clock text-green-600 text-sm"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-800">Waktu</p>
                            <p class="text-xs text-gray-600">{{ $quiz->duration }} menit pengerjaan</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="bg-purple-100 p-1 rounded mt-0.5">
                            <i class="fas fa-check-circle text-purple-600 text-sm"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-800">Tipe Jawaban</p>
                            <p class="text-xs text-gray-600">Satu jawaban benar per soal</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="bg-orange-100 p-1 rounded mt-0.5">
                            <i class="fas fa-calendar text-orange-600 text-sm"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-800">Dibuat</p>
                            <p class="text-xs text-gray-600">{{ $quiz->created_at->format('d M Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Questions Preview -->
    <div class="bg-white rounded-2xl shadow-large overflow-hidden animate-slide-up" style="animation-delay: 0.2s">
        <div class="px-6 py-5 bg-gradient-to-r from-blue-500 to-cyan-600">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-medium text-white flex items-center">
                        <i class="fas fa-list-ol mr-3"></i>
                        Preview Soal ({{ $quiz->questions->count() }})
                    </h3>
                    <p class="mt-1 text-sm text-blue-100">
                        Tinjau semua soal dalam kuis ini
                    </p>
                </div>
                <button id="togglePreview"
                        class="text-white hover:text-blue-200 transition duration-200 flex items-center space-x-2 bg-white/20 px-3 py-2 rounded-lg">
                    <span class="text-sm">Buka Preview</span>
                    <i class="fas fa-chevron-down transition-transform duration-300"></i>
                </button>
            </div>
        </div>

        <div id="questionsPreview" class="hidden transition-all duration-300">
            <div class="p-6 space-y-6 max-h-96 overflow-y-auto">
                @foreach($quiz->questions as $index => $question)
                <div class="border-2 border-gray-200 rounded-xl p-5 question-preview hover:border-indigo-300 hover:shadow-md transition-all duration-300 bg-white">
                    <!-- Question Header -->
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-start space-x-4 flex-1">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                                    <span class="text-white font-bold text-lg">{{ $index + 1 }}</span>
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="text-lg font-semibold text-gray-900 mb-3 leading-relaxed">
                                    {{ $question->question }}
                                </h4>

                                <!-- Choices Preview -->
                                <div class="space-y-3">
                                    @foreach($question->choices as $choiceIndex => $choice)
                                    <div class="flex items-center space-x-3 p-3 rounded-lg border-2 border-gray-200 transition-all duration-200
                                        {{ $choice->is_correct ? 'border-green-300 bg-green-50' : 'hover:border-gray-300 hover:bg-gray-50' }}">
                                        <div class="flex-shrink-0">
                                            <div class="w-8 h-8 rounded-full flex items-center justify-center
                                                {{ $choice->is_correct ? 'bg-green-500 text-white' : 'bg-gray-200 text-gray-600' }}
                                                font-semibold text-sm shadow-sm">
                                                {{ chr(65 + $choiceIndex) }}
                                            </div>
                                        </div>
                                        <span class="text-gray-700 flex-1 {{ $choice->is_correct ? 'text-green-800 font-medium' : '' }}">
                                            {{ $choice->choice }}
                                        </span>
                                        @if($choice->is_correct)
                                        <div class="flex-shrink-0">
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <i class="fas fa-check mr-1"></i>
                                                Jawaban Benar
                                            </span>
                                        </div>
                                        @endif
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Admin Actions -->
    <div class="mt-8 flex justify-center space-x-4">
        <a href="{{ route('admin.quiz.edit', $quiz->id) }}"
           class="px-6 py-3 bg-gradient-to-r from-yellow-500 to-orange-500 text-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 flex items-center hover:scale-105">
            <i class="fas fa-edit mr-2"></i>
            Edit Quiz
        </a>
        <a href="{{ route('admin.quiz.index') }}"
           class="px-6 py-3 bg-gradient-to-r from-gray-500 to-gray-600 text-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 flex items-center hover:scale-105">
            <i class="fas fa-arrow-left mr-2"></i>
            Kembali ke Manajemen
        </a>
    </div>
</div>

<!-- Scripts tetap sama -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleButton = document.getElementById('togglePreview');
        const questionsPreview = document.getElementById('questionsPreview');
        let isExpanded = false;

        toggleButton.addEventListener('click', function() {
            isExpanded = !isExpanded;
            questionsPreview.classList.toggle('hidden');

            const icon = toggleButton.querySelector('i');
            const text = toggleButton.querySelector('span');
            if (isExpanded) {
                icon.classList.remove('fa-chevron-down');
                icon.classList.add('fa-chevron-up');
                text.textContent = 'Tutup Preview';
                toggleButton.classList.add('bg-white/30');
            } else {
                icon.classList.remove('fa-chevron-up');
                icon.classList.add('fa-chevron-down');
                text.textContent = 'Buka Preview';
                toggleButton.classList.remove('bg-white/30');
            }
        });
    });
</script>
@endsection
