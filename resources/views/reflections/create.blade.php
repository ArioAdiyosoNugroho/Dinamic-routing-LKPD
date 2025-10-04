@extends('layout')

@section('title', 'Buat Refleksi Baru - LKPD App')

@section('content')
<div class="max-w-4xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <!-- Header Section -->
    <div class="md:flex md:items-center md:justify-between mb-8">
        <div class="flex-1 min-w-0">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                <i class="fas fa-plus-circle text-indigo-600 mr-2"></i> Buat Refleksi Baru
            </h2>
            <p class="mt-1 text-sm text-gray-500">
                Bagikan pemikiran, perasaan, dan pembelajaran Anda
            </p>
        </div>
        <div class="mt-4 flex md:mt-0 md:ml-4">
            <a href="{{ route('reflections.index') }}"
               class="mr-3 px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 transition duration-300 flex items-center">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-200">
        <!-- Card Header -->
        <div class="px-6 py-4 bg-gradient-to-r from-indigo-500 to-purple-600">
            <h3 class="text-lg font-medium text-white">
                <i class="fas fa-edit mr-2"></i> Form Refleksi Pembelajaran
            </h3>
        </div>

        <!-- Form Content -->
        <form method="POST" action="{{ route('reflections.store') }}" class="p-6 space-y-6">
            @csrf

            <!-- Mood Selection -->
            <div>
                <label for="mood" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-smile text-yellow-500 mr-1"></i>Bagaimana perasaan Anda hari ini?
                </label>
                <div class="grid grid-cols-2 md:grid-cols-5 gap-3">
                    @php
                        $moods = [
                            '😊 Senang' => 'Senang',
                            '😢 Sedih' => 'Sedih',
                            '😐 Biasa saja' => 'Biasa saja',
                            '😌 Tenang' => 'Tenang',
                            '🤔 Pensif' => 'Pensif',
                            '😅 Lelah' => 'Lelah',
                            '😃 Bersemangat' => 'Bersemangat',
                            '😕 Bingung' => 'Bingung',
                            '😍 Termotivasi' => 'Termotivasi',
                            '😴 Mengantuk' => 'Mengantuk'
                        ];
                    @endphp
                    @foreach($moods as $emoji => $mood)
                    <label class="mood-option flex flex-col items-center p-3 border-2 border-gray-200 rounded-xl cursor-pointer transition-all duration-200 hover:border-indigo-300 hover:bg-indigo-50">
                        <input type="radio" name="mood" value="{{ $mood }}" class="hidden">
                        <span class="text-2xl mb-2">{{ explode(' ', $emoji)[0] }}</span>
                        <span class="text-sm text-gray-700 text-center">{{ $mood }}</span>
                    </label>
                    @endforeach
                </div>
                @error('mood')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Reflection Content -->
            <div>
                <label for="content" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-pencil-alt text-indigo-500 mr-1"></i>Refleksi Pembelajaran
                </label>
                <textarea name="content"
                          id="content"
                          rows="6"
                          placeholder="Apa yang Anda pelajari hari ini? Bagaimana pengalaman belajarnya? Apa yang menarik? Apa yang sulit?"
                          class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300 resize-none"
                          required>{{ old('content') }}</textarea>
                @error('content')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <div class="mt-1 text-sm text-gray-500 flex justify-between">
                    <span>Minimal 10 karakter</span>
                    <span id="char-count">0 karakter</span>
                </div>
            </div>

            <!-- Lesson Learned -->
            <div>
                <label for="lesson_learned" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-graduation-cap text-green-500 mr-1"></i>Pelajaran yang Didapat
                </label>
                <textarea name="lesson_learned"
                          id="lesson_learned"
                          rows="3"
                          placeholder="Apa pelajaran penting yang dapat Anda ambil dari pengalaman belajar hari ini?"
                          class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-300 resize-none">{{ old('lesson_learned') }}</textarea>
                @error('lesson_learned')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Improvement Plan -->
            <div>
                <label for="improvement_plan" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-chart-line text-blue-500 mr-1"></i>Rencana Perbaikan
                </label>
                <textarea name="improvement_plan"
                          id="improvement_plan"
                          rows="3"
                          placeholder="Apa yang akan Anda lakukan berbeda atau lebih baik di masa depan?"
                          class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300 resize-none">{{ old('improvement_plan') }}</textarea>
                @error('improvement_plan')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-4 pt-6 border-t border-gray-200">
                <a href="{{ route('reflections.index') }}"
                   class="px-6 py-3 border border-gray-300 rounded-xl text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-300 flex items-center justify-center">
                    <i class="fas fa-times mr-2"></i> Batal
                </a>
                <button type="submit"
                        class="gradient-bg text-white px-6 py-3 rounded-xl text-sm font-medium hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-300 transform hover:scale-105 flex items-center justify-center shadow-lg">
                    <i class="fas fa-save mr-2"></i> Simpan Refleksi
                </button>
            </div>
        </form>
    </div>

    <!-- Reflection Tips -->
    <div class="mt-8 bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-2xl p-6">
        <div class="flex items-start space-x-4">
            <div class="flex-shrink-0 w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                <i class="fas fa-lightbulb text-blue-600 text-xl"></i>
            </div>
            <div>
                <h4 class="text-lg font-semibold text-blue-800 mb-2">Tips Refleksi yang Baik</h4>
                <ul class="text-blue-700 space-y-2">
                    <li class="flex items-start space-x-2">
                        <i class="fas fa-check-circle text-blue-500 mt-1 text-sm"></i>
                        <span>Jujur dengan perasaan dan pemikiran Anda</span>
                    </li>
                    <li class="flex items-start space-x-2">
                        <i class="fas fa-check-circle text-blue-500 mt-1 text-sm"></i>
                        <span>Fokus pada proses belajar, bukan hanya hasil</span>
                    </li>
                    <li class="flex items-start space-x-2">
                        <i class="fas fa-check-circle text-blue-500 mt-1 text-sm"></i>
                        <span>Identifikasi tantangan dan bagaimana mengatasinya</span>
                    </li>
                    <li class="flex items-start space-x-2">
                        <i class="fas fa-check-circle text-blue-500 mt-1 text-sm"></i>
                        <span>Buat rencana konkret untuk perbaikan</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<style>
    .gradient-bg {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .mood-option.selected {
        border-color: #6366f1;
        background-color: #eef2ff;
        transform: scale(1.05);
    }

    textarea:focus {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.1);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Mood selection
        const moodOptions = document.querySelectorAll('.mood-option');
        moodOptions.forEach(option => {
            option.addEventListener('click', function() {
                // Remove selected class from all options
                moodOptions.forEach(opt => opt.classList.remove('selected'));
                // Add selected class to clicked option
                this.classList.add('selected');
                // Check the radio input
                this.querySelector('input').checked = true;
            });
        });

        // Character counter for content
        const contentTextarea = document.getElementById('content');
        const charCount = document.getElementById('char-count');

        contentTextarea.addEventListener('input', function() {
            const count = this.value.length;
            charCount.textContent = `${count} karakter`;

            // Change color based on length
            if (count < 10) {
                charCount.classList.add('text-red-600');
                charCount.classList.remove('text-gray-500');
            } else {
                charCount.classList.remove('text-red-600');
                charCount.classList.add('text-gray-500');
            }
        });

        // Trigger input event to update counter initially
        contentTextarea.dispatchEvent(new Event('input'));

        // Auto-resize textareas
        const textareas = document.querySelectorAll('textarea');
        textareas.forEach(textarea => {
            textarea.addEventListener('input', function() {
                this.style.height = 'auto';
                this.style.height = (this.scrollHeight) + 'px';
            });
        });
    });
</script>
@endsection
