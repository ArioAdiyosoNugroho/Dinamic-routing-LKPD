@extends('layout')

@section('title', 'Manajemen Quiz - Admin')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <!-- Header Section -->
    <div class="mb-8 animate-fade-in">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div class="flex-1 min-w-0">
               <h1 class="text-3xl font-bold text-gray-800 flex items-center">
                    <div class="w-12 h-12 flex items-center justify-center bg-gradient-to-b from-indigo-400 to-purple-500 rounded-xl shadow-md mr-4">
                        <i class="fas fa-question-circle text-white text-2xl"></i>
                    </div>
                    <span>Manajemen Quiz</span>
                </h1>
                <p class="mt-2 text-lg text-gray-600 max-w-2xl">
                    Kelola kuis pembelajaran interaktif untuk siswa dengan antarmuka yang intuitif
                </p>
            </div>
            <div class="mt-4 md:mt-0 flex space-x-3">
                <div class="relative">
                    <input type="text" placeholder="Cari quiz..."
                           class="pl-10 pr-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-200">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                </div>
                <a href="{{ route('admin.quiz.create') }}"
                   class="px-6 py-3 bg-gradient-to-r from-indigo-500 to-purple-600 text-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 flex items-center hover:scale-105">
                    <i class="fas fa-plus mr-2"></i>
                    Buat Quiz Baru
                </a>
            </div>
        </div>
    </div>

    <!-- Notifikasi -->
    <x-notifikasi />

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4 mb-8">
        <div class="dashboard-card rounded-2xl shadow-soft p-6 card-hover animate-slide-up" style="animation-delay: 0.1s">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-indigo-100 rounded-xl p-4 stats-icon">
                    <i class="fas fa-file-alt text-indigo-600 text-2xl"></i>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Total Quiz</dt>
                        <dd class="text-2xl font-bold text-gray-900">{{ $quizzes->count() }}</dd>
                    </dl>
                    <div class="mt-1">
                        <span class="text-xs font-medium text-indigo-500 bg-indigo-50 px-2 py-1 rounded-full">
                            <i class="fas fa-cubes mr-1"></i> Semua quiz
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="dashboard-card rounded-2xl shadow-soft p-6 card-hover animate-slide-up" style="animation-delay: 0.2s">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-green-100 rounded-xl p-4 stats-icon">
                    <i class="fas fa-play-circle text-green-600 text-2xl"></i>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Quiz Aktif</dt>
                        <dd class="text-2xl font-bold text-gray-900">{{ $quizzes->where('is_active', true)->count() }}</dd>
                    </dl>
                    <div class="mt-1">
                        <span class="text-xs font-medium text-green-500 bg-green-50 px-2 py-1 rounded-full">
                            <i class="fas fa-check mr-1"></i> Sedang berjalan
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="dashboard-card rounded-2xl shadow-soft p-6 card-hover animate-slide-up" style="animation-delay: 0.3s">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-blue-100 rounded-xl p-4 stats-icon">
                    <i class="fas fa-question-circle text-blue-600 text-2xl"></i>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Total Soal</dt>
                        <dd class="text-2xl font-bold text-gray-900">{{ $quizzes->sum(function($quiz) { return $quiz->questions->count(); }) }}</dd>
                    </dl>
                    <div class="mt-1">
                        <span class="text-xs font-medium text-blue-500 bg-blue-50 px-2 py-1 rounded-full">
                            <i class="fas fa-list-ol mr-1"></i> Semua soal
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="dashboard-card rounded-2xl shadow-soft p-6 card-hover animate-slide-up" style="animation-delay: 0.4s">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-purple-100 rounded-xl p-4 stats-icon">
                    <i class="fas fa-clock text-purple-600 text-2xl"></i>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Rata-rata Durasi</dt>
                        <dd class="text-2xl font-bold text-gray-900">{{ $quizzes->avg('duration') ? round($quizzes->avg('duration')) : 0 }} menit</dd>
                    </dl>
                    <div class="mt-1">
                        <span class="text-xs font-medium text-purple-500 bg-purple-50 px-2 py-1 rounded-full">
                            <i class="fas fa-hourglass-half mr-1"></i> Per quiz
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quiz List -->
    <div class="bg-white rounded-2xl shadow-large overflow-hidden animate-slide-up" style="animation-delay: 0.5s">
        <!-- Table Header -->
        <div class="px-6 py-5 bg-gradient-to-r from-indigo-500 to-purple-600">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h3 class="text-lg font-medium text-white">Daftar Quiz</h3>
                    <p class="mt-1 text-sm text-indigo-100">
                        Kelola semua kuis pembelajaran yang tersedia
                    </p>
                </div>
                <div class="mt-3 sm:mt-0 flex items-center space-x-2">
                    <span class="text-indigo-100 text-sm">Total: {{ $quizzes->count() }} quiz</span>
                </div>
            </div>
        </div>

        @if($quizzes->isEmpty())
        <div class="px-4 py-16 sm:px-6 text-center animate-pulse">
            <div class="bg-gray-100 p-6 rounded-full inline-flex mb-4">
                <i class="fas fa-question-circle text-gray-300 text-4xl"></i>
            </div>
            <h3 class="text-xl font-medium text-gray-900 mb-2">Belum ada quiz</h3>
            <p class="text-gray-500 mb-6 max-w-md mx-auto">Mulai dengan membuat quiz pertama Anda untuk memulai pembelajaran interaktif</p>
            <a href="{{ route('admin.quiz.create') }}"
                class="px-6 py-3 bg-gradient-to-r from-indigo-500 to-purple-600 text-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 flex items-center justify-center hover:scale-105 inline-flex">
                <i class="fas fa-plus mr-2"></i>
                Buat Quiz Pertama
            </a>
        </div>
        @else
        <div class="overflow-hidden">
            <div class="divide-y divide-gray-200">
                @foreach($quizzes as $quiz)
                <div class="quiz-item p-6 hover:bg-gray-50 transition-all duration-300 border-l-4 border-transparent hover:border-indigo-500">
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                        <div class="flex-1">
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0">
                                    <div class="w-14 h-14 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                                        <i class="fas fa-question text-white text-lg"></i>
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center flex-wrap gap-2 mb-2">
                                        <h4 class="text-xl font-semibold text-gray-900">{{ $quiz->title }}</h4>
                                        @if($quiz->is_active)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800 shadow-sm">
                                            <i class="fas fa-circle text-green-500 mr-1.5" style="font-size: 6px;"></i>
                                            Aktif
                                        </span>
                                        @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800 shadow-sm">
                                            <i class="fas fa-circle text-red-500 mr-1.5" style="font-size: 6px;"></i>
                                            Nonaktif
                                        </span>
                                        @endif
                                    </div>
                                    <p class="text-gray-600 mb-3">{{ $quiz->description ?: 'Tidak ada deskripsi' }}</p>
                                    <div class="flex flex-wrap items-center gap-4 text-sm text-gray-500">
                                        <span class="flex items-center bg-blue-50 px-3 py-1 rounded-lg">
                                            <i class="fas fa-question mr-2 text-blue-500"></i>
                                            {{ $quiz->questions->count() }} soal
                                        </span>
                                        <span class="flex items-center bg-green-50 px-3 py-1 rounded-lg">
                                            <i class="fas fa-clock mr-2 text-green-500"></i>
                                            {{ $quiz->duration }} menit
                                        </span>
                                        <span class="flex items-center bg-purple-50 px-3 py-1 rounded-lg">
                                            <i class="fas fa-calendar mr-2 text-purple-500"></i>
                                            {{ $quiz->created_at->format('d M Y') }}
                                        </span>
                                        @if($quiz->updated_at->gt($quiz->created_at))
                                        <span class="flex items-center bg-yellow-50 px-3 py-1 rounded-lg">
                                            <i class="fas fa-edit mr-2 text-yellow-500"></i>
                                            Diperbarui {{ $quiz->updated_at->diffForHumans() }}
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Questions Preview -->
                            @if($quiz->questions->count() > 0)
                            <div class="mt-6 ml-0 lg:ml-18">
                                <div class="bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl p-4 border border-gray-200">
                                    <div class="flex items-center justify-between mb-3">
                                        <h5 class="text-sm font-semibold text-gray-700 flex items-center">
                                            <i class="fas fa-list-ol mr-2 text-indigo-500"></i>
                                            Daftar Soal ({{ $quiz->questions->count() }})
                                        </h5>
                                        <span class="text-xs text-gray-500 bg-white px-2 py-1 rounded-full shadow-sm">
                                            Preview
                                        </span>
                                    </div>
                                    <div class="space-y-3 max-h-48 overflow-y-auto pr-2">
                                        @foreach($quiz->questions->take(3) as $index => $question)
                                        <div class="border-l-4 border-indigo-400 pl-3 py-2 bg-white rounded-r-lg shadow-sm">
                                            <p class="text-sm font-medium text-gray-900 mb-2">
                                                <span class="bg-indigo-100 text-indigo-800 rounded-full w-6 h-6 inline-flex items-center justify-center text-xs mr-2">
                                                    {{ $index + 1 }}
                                                </span>
                                                {{ Str::limit($question->question, 80) }}
                                            </p>
                                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-1 ml-6">
                                                @foreach($question->choices->take(2) as $choice)
                                                <span class="text-xs text-gray-600 flex items-center {{ $choice->is_correct ? 'text-green-600 font-semibold' : '' }}">
                                                    <span class="w-2 h-2 rounded-full bg-gray-400 mr-2 {{ $choice->is_correct ? 'bg-green-500' : '' }}"></span>
                                                    {{ Str::limit($choice->choice, 35) }}
                                                    @if($choice->is_correct)
                                                    <i class="fas fa-check ml-1 text-green-500 text-xs"></i>
                                                    @endif
                                                </span>
                                                @endforeach
                                                @if($question->choices->count() > 2)
                                                <span class="text-xs text-gray-400 flex items-center">
                                                    <span class="w-2 h-2 rounded-full bg-gray-300 mr-2"></span>
                                                    +{{ $question->choices->count() - 2 }} pilihan lainnya...
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        @endforeach
                                        @if($quiz->questions->count() > 3)
                                        <div class="text-center pt-2">
                                            <span class="text-xs text-gray-400 bg-white px-3 py-1 rounded-full border border-gray-200">
                                                +{{ $quiz->questions->count() - 3 }} soal lainnya
                                            </span>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @else
                            <div class="mt-4 ml-0 lg:ml-18">
                                <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4">
                                    <div class="flex items-center">
                                        <i class="fas fa-exclamation-triangle text-yellow-500 mr-3"></i>
                                        <div>
                                            <p class="text-sm font-medium text-yellow-800">Quiz belum memiliki soal</p>
                                            <p class="text-xs text-yellow-600 mt-1">Tambahkan soal untuk membuat quiz ini aktif</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>

                        <!-- Action Buttons -->
                        <!-- Action Buttons -->
                        <div class="mt-4 lg:mt-0 lg:ml-6 flex flex-col space-y-3 min-w-[200px]">
                            <!-- Tombol Preview Soal - TAMBAH INI -->
                            <a href="{{ route('quiz.preview', $quiz->id) }}"
                                class="w-full inline-flex items-center justify-center px-4 py-2.5 border border-transparent text-sm font-medium rounded-xl text-white bg-gradient-to-r from-blue-500 to-cyan-500 hover:from-blue-600 hover:to-cyan-600 transition-all duration-200 hover:shadow-md shadow-sm">
                                <i class="fas fa-eye mr-2"></i>
                                Preview Soal
                            </a>

                            <button onclick="toggleQuizStatus({{ $quiz->id }})"
                                class="w-full inline-flex items-center justify-center px-4 py-2.5 border border-gray-300 shadow-sm text-sm font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50 transition-all duration-200 hover:shadow-md group">
                                <i class="fas fa-power-off mr-2 text-gray-500 group-hover:text-indigo-500 transition-colors duration-200"></i>
                                {{ $quiz->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                            </button>

                            <a href="{{ route('admin.quiz.edit', $quiz->id) }}"
                               class="w-full inline-flex items-center justify-center px-4 py-2.5 border border-transparent text-sm font-medium rounded-xl text-white bg-gradient-to-r from-yellow-500 to-orange-500 hover:from-yellow-600 hover:to-orange-600 transition-all duration-200 hover:shadow-md shadow-sm">
                                <i class="fas fa-edit mr-2"></i>
                                Edit Quiz
                            </a>

                            <button onclick="openDeleteModal({{ $quiz->id }}, '{{ addslashes($quiz->title) }}')"
                                class="w-full inline-flex items-center justify-center px-4 py-2.5 border border-transparent text-sm font-medium rounded-xl text-white bg-gradient-to-r from-red-500 to-pink-500 hover:from-red-600 hover:to-pink-600 transition-all duration-200 hover:shadow-md shadow-sm">
                                <i class="fas fa-trash mr-2"></i>
                                Hapus Quiz
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden transition-opacity duration-300">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-md shadow-2xl rounded-2xl bg-white modal-animation">
        <div class="mt-3 text-center">
            <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-red-100 mb-4">
                <i class="fas fa-exclamation-triangle text-red-600 text-2xl"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-2">Hapus Quiz</h3>
            <div class="mt-2 px-4 py-3">
                <p class="text-sm text-gray-600 mb-4">
                    Apakah Anda yakin ingin menghapus quiz <span class="font-semibold text-gray-900" id="deleteQuizTitle"></span>?
                </p>
                <p class="text-xs text-red-500 bg-red-50 p-3 rounded-lg">
                    <i class="fas fa-info-circle mr-1"></i>
                    Tindakan ini tidak dapat dibatalkan dan semua data quiz akan dihapus permanen.
                </p>
            </div>
            <div class="flex items-center justify-center gap-3 px-4 py-4 border-t border-gray-200">
                <button id="cancelDelete"
                    class="flex-1 inline-flex justify-center items-center px-4 py-3 border border-gray-300 shadow-sm text-sm font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50 transition-all duration-200 hover:shadow-md">
                    <i class="fas fa-times mr-2"></i>
                    Batal
                </button>
                <form id="deleteForm" method="POST" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="w-full inline-flex justify-center items-center px-4 py-3 border border-transparent text-sm font-medium rounded-xl shadow-sm text-white bg-gradient-to-r from-red-500 to-pink-500 hover:from-red-600 hover:to-pink-600 transition-all duration-200 hover:shadow-md">
                        <i class="fas fa-trash mr-2"></i>
                        Hapus
                    </button>
                </form>
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

    .quiz-item {
        transition: all 0.3s ease;
    }

    .quiz-item:hover {
        background-color: #f8fafc;
    }

    .stats-icon {
        transition: all 0.3s ease;
    }

    .stats-card:hover .stats-icon {
        transform: scale(1.1);
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

    .modal-animation {
        animation: modalFadeIn 0.3s ease-out;
    }

    @keyframes modalFadeIn {
        from {
            opacity: 0;
            transform: scale(0.9) translateY(-20px);
        }
        to {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
    }
</style>

<script>
    // Modal Functions
    function openDeleteModal(quizId, quizTitle) {
        document.getElementById('deleteQuizTitle').textContent = quizTitle;
        document.getElementById('deleteForm').action = `/admin/quiz/${quizId}`;
        document.getElementById('deleteModal').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    // Quiz Status Toggle
    function toggleQuizStatus(quizId) {
        if (confirm('Apakah Anda yakin ingin mengubah status quiz ini?')) {
            // Buat form secara dinamis untuk mengirim request
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/admin/quiz/${quizId}/toggle-status`;

            // Tambahkan CSRF token
            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}';
            form.appendChild(csrfToken);

            // Tambahkan method spoofing untuk POST
            const method = document.createElement('input');
            method.type = 'hidden';
            method.name = '_method';
            method.value = 'POST';
            form.appendChild(method);

            document.body.appendChild(form);
            form.submit();
        }
    }

    // Event Listeners
    document.getElementById('cancelDelete').addEventListener('click', closeDeleteModal);

    // Close modal when clicking outside
    document.getElementById('deleteModal').addEventListener('click', function(e) {
        if (e.target === this) closeDeleteModal();
    });

    // Staggered animation for cards
    document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.animate-slide-up');
        cards.forEach((card, index) => {
            card.style.animationDelay = `${0.1 * index}s`;
        });
    });

    // Smooth scroll behavior for question preview
    document.addEventListener('DOMContentLoaded', function() {
        const questionContainers = document.querySelectorAll('.max-h-48');
        questionContainers.forEach(container => {
            container.addEventListener('wheel', function(e) {
                if (e.deltaY !== 0) {
                    e.preventDefault();
                    this.scrollTop += e.deltaY;
                }
            });
        });
    });
</script>
@endsection
