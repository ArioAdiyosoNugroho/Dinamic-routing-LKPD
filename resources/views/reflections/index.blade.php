@extends('layout')

@section('title', 'Manajemen Refleksi - LKPD App')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <!-- Header Section -->
    <div class="mb-8 animate-fade-in">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div class="flex-1 min-w-0">
                <h1 class="text-3xl font-bold text-gray-800 flex items-center">
                    <div class="w-12 h-12 flex items-center justify-center bg-gradient-to-b from-indigo-400 to-purple-500 rounded-xl shadow-md mr-4">
                        <i class="fas fa-brain text-white text-2xl"></i>
                    </div>
                    <span>Manajemen Refleksi</span>
                </h1>
                <p class="mt-2 text-lg text-gray-600 max-w-2xl">
                    Kelola refleksi pembelajaran siswa untuk meningkatkan proses belajar mengajar
                </p>
            </div>
            @if(Auth::user()->role !== 'admin')
            <div class="mt-4 md:mt-0 flex space-x-3">
                <div class="relative">
                    <input type="text" placeholder="Cari refleksi..."
                           class="pl-10 pr-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-200">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                </div>
                <a href="{{ route('reflections.create') }}"
                   class="px-6 py-3 bg-gradient-to-r from-indigo-500 to-purple-600 text-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 flex items-center hover:scale-105">
                    <i class="fas fa-plus mr-2"></i>
                    Refleksi Baru
                </a>
            </div>
            @endif
        </div>
    </div>

    <!-- Notifikasi -->
    <x-notifikasi />

    <!-- Stats Cards -->
    @if(auth()->user()->role === 'user')
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-3 mb-8">
        <div class="dashboard-card rounded-2xl shadow-soft p-6 card-hover animate-slide-up" style="animation-delay: 0.1s">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-indigo-100 rounded-xl p-4 stats-icon">
                    <i class="fas fa-file-alt text-indigo-600 text-2xl"></i>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Total Refleksi</dt>
                        <dd class="text-2xl font-bold text-gray-900">{{ $reflections->total() }}</dd>
                    </dl>
                    <div class="mt-1">
                        <span class="text-xs font-medium text-indigo-500 bg-indigo-50 px-2 py-1 rounded-full">
                            <i class="fas fa-cubes mr-1"></i> Semua refleksi
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="dashboard-card rounded-2xl shadow-soft p-6 card-hover animate-slide-up" style="animation-delay: 0.2s">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-green-100 rounded-xl p-4 stats-icon">
                    <i class="fas fa-calendar-day text-green-600 text-2xl"></i>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Refleksi Bulan Ini</dt>
                        <dd class="text-2xl font-bold text-gray-900">
                            {{ $reflections->where('created_at', '>=', now()->startOfMonth())->count() }}
                        </dd>
                    </dl>
                    <div class="mt-1">
                        <span class="text-xs font-medium text-green-500 bg-green-50 px-2 py-1 rounded-full">
                            <i class="fas fa-check mr-1"></i> Bulan ini
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="dashboard-card rounded-2xl shadow-soft p-6 card-hover animate-slide-up" style="animation-delay: 0.3s">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-blue-100 rounded-xl p-4 stats-icon">
                    <i class="fas fa-star text-blue-600 text-2xl"></i>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Rata-rata per Bulan</dt>
                        <dd class="text-2xl font-bold text-gray-900">
                            {{ number_format($reflections->total() / max(1, ceil((now()->diffInDays($reflections->first()->created_at ?? now())) / 30)), 1) }}
                        </dd>
                    </dl>
                    <div class="mt-1">
                        <span class="text-xs font-medium text-blue-500 bg-blue-50 px-2 py-1 rounded-full">
                            <i class="fas fa-chart-line mr-1"></i> Per bulan
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Reflections List -->
    <div class="bg-white rounded-2xl shadow-large overflow-hidden animate-slide-up" style="animation-delay: 0.4s">
        <!-- Table Header -->
        <div class="px-6 py-5 bg-gradient-to-r from-indigo-500 to-purple-600">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h3 class="text-lg font-medium text-white">
                        @if(auth()->user()->role === 'admin')
                            <i class="fas fa-users mr-2"></i> Semua Refleksi Siswa
                        @else
                            <i class="fas fa-user mr-2"></i> Refleksi Saya
                        @endif
                    </h3>
                    <p class="mt-1 text-sm text-indigo-100">
                        @if(auth()->user()->role === 'admin')
                            Pantau perkembangan refleksi semua siswa
                        @else
                            Riwayat refleksi pembelajaran Anda
                        @endif
                    </p>
                </div>
                <div class="mt-3 sm:mt-0 flex items-center space-x-2">
                    <span class="text-indigo-100 text-sm">Total: {{ $reflections->total() }} refleksi</span>
                </div>
            </div>
        </div>

        @if($reflections->isEmpty())
        <div class="px-4 py-16 sm:px-6 text-center animate-pulse">
            <div class="bg-gray-100 p-6 rounded-full inline-flex mb-4">
                <i class="fas fa-brain text-gray-300 text-4xl"></i>
            </div>
            <h3 class="text-xl font-medium text-gray-900 mb-2">Belum ada refleksi</h3>
            <p class="text-gray-500 mb-6 max-w-md mx-auto">
                @if(auth()->user()->role === 'admin')
                    Siswa belum membuat refleksi pembelajaran
                @else
                    Mulai dengan membuat refleksi pertama Anda untuk meningkatkan proses belajar
                @endif
            </p>
            @if(auth()->user()->role !== 'admin')
            <a href="{{ route('reflections.create') }}"
                class="px-6 py-3 bg-gradient-to-r from-indigo-500 to-purple-600 text-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 flex items-center justify-center hover:scale-105 inline-flex">
                <i class="fas fa-plus mr-2"></i>
                Buat Refleksi Pertama
            </a>
            @endif
        </div>
        @else
            @if(auth()->user()->role === 'admin')
            <!-- Admin View - Table Layout -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Siswa
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Refleksi
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Mood
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tanggal
                            </th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($reflections as $reflection)
                        <tr class="table-row-hover">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 bg-gradient-to-r from-indigo-400 to-purple-500 rounded-full flex items-center justify-center">
                                        <span class="text-white font-medium">{{ strtoupper(substr($reflection->user->name, 0, 1)) }}</span>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $reflection->user->name }}</div>
                                        <div class="text-sm text-gray-500">{{ $reflection->user->kelas ?? '-' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900 max-w-md">{{ Str::limit($reflection->content, 100) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($reflection->mood)
                                    @php
                                        $moodColors = [
                                            'senang' => 'bg-green-100 text-green-800',
                                            'biasa' => 'bg-blue-100 text-blue-800',
                                            'sedih' => 'bg-yellow-100 text-yellow-800',
                                            'frustasi' => 'bg-red-100 text-red-800',
                                            'bingung' => 'bg-purple-100 text-purple-800'
                                        ];
                                        $moodColor = $moodColors[$reflection->mood] ?? 'bg-gray-100 text-gray-800';
                                    @endphp
                                    <span class="px-3 py-1 inline-flex items-center text-xs font-semibold rounded-full {{ $moodColor }} shadow-sm">
                                        <i class="fas fa-smile mr-1"></i> {{ ucfirst($reflection->mood) }}
                                    </span>
                                @else
                                    <span class="text-xs text-gray-500">-</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $reflection->created_at->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex justify-end space-x-2">
                                    <a href="{{ route('reflections.show', $reflection) }}"
                                       class="w-10 h-10 rounded-xl bg-gradient-to-r from-blue-500 to-cyan-500 hover:from-blue-600 hover:to-cyan-600 text-white flex items-center justify-center shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-110 active:scale-95"
                                       title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @if(auth()->user()->role === 'user' && $reflection->user_id === auth()->id())
                                    <a href="{{ route('reflections.edit', $reflection) }}"
                                       class="w-10 h-10 rounded-xl bg-gradient-to-r from-emerald-500 to-green-500 hover:from-emerald-600 hover:to-green-600 text-white flex items-center justify-center shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-110 active:scale-95"
                                       title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button onclick="openDeleteModal({{ $reflection->id }}, '{{ addslashes(Str::limit($reflection->content, 50)) }}')"
                                            class="w-10 h-10 rounded-xl bg-gradient-to-r from-rose-500 to-pink-500 hover:from-rose-600 hover:to-pink-600 text-white flex items-center justify-center shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-110 active:scale-95"
                                            title="Hapus">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <!-- User View - Card Layout -->
            <div class="overflow-hidden">
                <div class="divide-y divide-gray-200">
                    @foreach($reflections as $reflection)
                    <div class="reflection-item p-6 hover:bg-gray-50 transition-all duration-300 border-l-4 border-transparent hover:border-indigo-500">
                        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                            <div class="flex-1">
                                <div class="flex items-start space-x-4">
                                    <div class="flex-shrink-0">
                                        <div class="w-14 h-14 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                                            <i class="fas fa-brain text-white text-lg"></i>
                                        </div>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center flex-wrap gap-2 mb-2">
                                            <h4 class="text-xl font-semibold text-gray-900">Refleksi Pembelajaran</h4>
                                            <!-- Mood Badge -->
                                            @if($reflection->mood)
                                                @php
                                                    $moodColors = [
                                                        'senang' => 'bg-green-100 text-green-800',
                                                        'biasa' => 'bg-blue-100 text-blue-800',
                                                        'sedih' => 'bg-yellow-100 text-yellow-800',
                                                        'frustasi' => 'bg-red-100 text-red-800',
                                                        'bingung' => 'bg-purple-100 text-purple-800'
                                                    ];
                                                    $moodColor = $moodColors[$reflection->mood] ?? 'bg-gray-100 text-gray-800';
                                                @endphp
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $moodColor }} shadow-sm">
                                                    <i class="fas fa-smile mr-1.5" style="font-size: 10px;"></i>
                                                    {{ ucfirst($reflection->mood) }}
                                                </span>
                                            @endif
                                        </div>
                                        <div class="text-gray-600 mb-3">{{ Str::limit($reflection->content, 150) }}</div>
                                        <div class="flex flex-wrap items-center gap-4 text-sm text-gray-500">
                                            <span class="flex items-center bg-blue-50 px-3 py-1 rounded-lg">
                                                <i class="fas fa-calendar mr-2 text-blue-500"></i>
                                                {{ $reflection->created_at->format('d M Y') }}
                                            </span>
                                            <span class="flex items-center bg-green-50 px-3 py-1 rounded-lg">
                                                <i class="fas fa-clock mr-2 text-green-500"></i>
                                                {{ $reflection->created_at->format('H:i') }}
                                            </span>
                                            @if($reflection->updated_at->gt($reflection->created_at))
                                            <span class="flex items-center bg-yellow-50 px-3 py-1 rounded-lg">
                                                <i class="fas fa-edit mr-2 text-yellow-500"></i>
                                                Diperbarui {{ $reflection->updated_at->diffForHumans() }}
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="mt-4 lg:mt-0 lg:ml-6 flex flex-col space-y-3 min-w-[200px]">
                                <a href="{{ route('reflections.show', $reflection) }}"
                                   class="w-full inline-flex items-center justify-center px-4 py-2.5 border border-transparent text-sm font-medium rounded-xl text-white bg-gradient-to-r from-blue-500 to-cyan-500 hover:from-blue-600 hover:to-cyan-600 transition-all duration-200 hover:shadow-md shadow-sm">
                                    <i class="fas fa-eye mr-2"></i>
                                    Lihat Detail
                                </a>

                                <a href="{{ route('reflections.edit', $reflection) }}"
                                   class="w-full inline-flex items-center justify-center px-4 py-2.5 border border-transparent text-sm font-medium rounded-xl text-white bg-gradient-to-r from-yellow-500 to-orange-500 hover:from-yellow-600 hover:to-orange-600 transition-all duration-200 hover:shadow-md shadow-sm">
                                    <i class="fas fa-edit mr-2"></i>
                                    Edit Refleksi
                                </a>

                                <button onclick="openDeleteModal({{ $reflection->id }}, '{{ addslashes(Str::limit($reflection->content, 50)) }}')"
                                    class="w-full inline-flex items-center justify-center px-4 py-2.5 border border-transparent text-sm font-medium rounded-xl text-white bg-gradient-to-r from-red-500 to-pink-500 hover:from-red-600 hover:to-pink-600 transition-all duration-200 hover:shadow-md shadow-sm">
                                    <i class="fas fa-trash mr-2"></i>
                                    Hapus Refleksi
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Pagination -->
            @if($reflections->hasPages())
            <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <div class="text-sm text-gray-700 mb-4 sm:mb-0">
                        Menampilkan <span class="font-semibold">{{ $reflections->firstItem() }}</span> - <span class="font-semibold">{{ $reflections->lastItem() }}</span> dari <span class="font-semibold">{{ $reflections->total() }}</span> refleksi
                    </div>
                    <div class="flex space-x-1">
                        @if($reflections->onFirstPage())
                        <span class="px-3 py-2 bg-gray-100 text-gray-400 rounded-lg cursor-not-allowed">
                            <i class="fas fa-chevron-left"></i>
                        </span>
                        @else
                        <a href="{{ $reflections->previousPageUrl() }}" class="px-3 py-2 bg-white text-gray-700 rounded-lg hover:bg-gray-100 transition duration-200 shadow-sm">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                        @endif

                        @foreach($reflections->getUrlRange(1, $reflections->lastPage()) as $page => $url)
                            @if($page == $reflections->currentPage())
                            <span class="px-3 py-2 bg-indigo-500 text-white rounded-lg shadow-sm">{{ $page }}</span>
                            @else
                            <a href="{{ $url }}" class="px-3 py-2 bg-white text-gray-700 rounded-lg hover:bg-gray-100 transition duration-200 shadow-sm">{{ $page }}</a>
                            @endif
                        @endforeach

                        @if($reflections->hasMorePages())
                        <a href="{{ $reflections->nextPageUrl() }}" class="px-3 py-2 bg-white text-gray-700 rounded-lg hover:bg-gray-100 transition duration-200 shadow-sm">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                        @else
                        <span class="px-3 py-2 bg-gray-100 text-gray-400 rounded-lg cursor-not-allowed">
                            <i class="fas fa-chevron-right"></i>
                        </span>
                        @endif
                    </div>
                </div>
            </div>
            @endif
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
            <h3 class="text-xl font-bold text-gray-900 mb-2">Hapus Refleksi</h3>
            <div class="mt-2 px-4 py-3">
                <p class="text-sm text-gray-600 mb-4">
                    Apakah Anda yakin ingin menghapus refleksi <span class="font-semibold text-gray-900" id="deleteReflectionTitle"></span>?
                </p>
                <p class="text-xs text-red-500 bg-red-50 p-3 rounded-lg">
                    <i class="fas fa-info-circle mr-1"></i>
                    Tindakan ini tidak dapat dibatalkan dan data refleksi akan dihapus permanen.
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

    .reflection-item {
        transition: all 0.3s ease;
    }

    .reflection-item:hover {
        background-color: #f8fafc;
    }

    .stats-icon {
        transition: all 0.3s ease;
    }

    .stats-card:hover .stats-icon {
        transform: scale(1.1);
    }

    .table-row-hover:hover {
        background-color: #f9fafb;
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
    function openDeleteModal(reflectionId, reflectionTitle) {
        document.getElementById('deleteReflectionTitle').textContent = reflectionTitle;
        document.getElementById('deleteForm').action = `/reflections/${reflectionId}`;
        document.getElementById('deleteModal').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
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
</script>
@endsection
