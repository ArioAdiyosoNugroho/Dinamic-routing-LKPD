@extends('layout')

@section('title', 'Laporan Saya - LKPD App')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <!-- Header Section -->
    <div class="mb-8 animate-fade-in">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div class="flex-1 min-w-0">
                <h1 class="text-3xl font-bold text-gray-800 flex items-center">
                    <div class="w-12 h-12 flex items-center justify-center bg-gradient-to-b from-indigo-400 to-purple-500 rounded-xl shadow-md mr-4">
                        <i class="fas fa-file-alt text-white text-2xl"></i>
                    </div>
                    <span>Laporan Saya</span>
                </h1>
                <p class="mt-2 text-lg text-gray-600 max-w-2xl">
                    Kelola laporan praktikum jaringan Anda dengan antarmuka yang intuitif
                </p>
            </div>
            <div class="mt-4 md:mt-0 flex space-x-3">
                <div class="relative">
                    <input type="text" placeholder="Cari laporan..."
                           class="pl-10 pr-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-200">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                </div>
                <a href="{{ route('laporan.create') }}"
                   class="px-6 py-3 bg-gradient-to-r from-indigo-500 to-purple-600 text-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 flex items-center hover:scale-105">
                    <i class="fas fa-plus-circle mr-2"></i>
                    Tambah Laporan
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
                        <dt class="text-sm font-medium text-gray-500 truncate">Total Laporan</dt>
                        <dd class="text-2xl font-bold text-gray-900">{{ $laporans->count() }}</dd>
                    </dl>
                    <div class="mt-1">
                        <span class="text-xs font-medium text-indigo-500 bg-indigo-50 px-2 py-1 rounded-full">
                            <i class="fas fa-cubes mr-1"></i> Semua laporan
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="dashboard-card rounded-2xl shadow-soft p-6 card-hover animate-slide-up" style="animation-delay: 0.2s">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-green-100 rounded-xl p-4 stats-icon">
                    <i class="fas fa-check-circle text-green-600 text-2xl"></i>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Selesai</dt>
                        <dd class="text-2xl font-bold text-gray-900">{{ $laporans->where('status', 'selesai')->count() }}</dd>
                    </dl>
                    <div class="mt-1">
                        <span class="text-xs font-medium text-green-500 bg-green-50 px-2 py-1 rounded-full">
                            <i class="fas fa-check mr-1"></i> Telah diselesaikan
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="dashboard-card rounded-2xl shadow-soft p-6 card-hover animate-slide-up" style="animation-delay: 0.3s">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-yellow-100 rounded-xl p-4 stats-icon">
                    <i class="fas fa-clock text-yellow-600 text-2xl"></i>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Dalam Proses</dt>
                        <dd class="text-2xl font-bold text-gray-900">{{ $laporans->where('status', 'proses')->count() }}</dd>
                    </dl>
                    <div class="mt-1">
                        <span class="text-xs font-medium text-yellow-500 bg-yellow-50 px-2 py-1 rounded-full">
                            <i class="fas fa-hourglass-half mr-1"></i> Sedang diproses
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="dashboard-card rounded-2xl shadow-soft p-6 card-hover animate-slide-up" style="animation-delay: 0.4s">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-purple-100 rounded-xl p-4 stats-icon">
                    <i class="fas fa-user-graduate text-purple-600 text-2xl"></i>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Kelas Saya</dt>
                        <dd class="text-2xl font-bold text-gray-900">{{ $laporans->first()->kelas ?? '-' }}</dd>
                    </dl>
                    <div class="mt-1">
                        <span class="text-xs font-medium text-purple-500 bg-purple-50 px-2 py-1 rounded-full">
                            <i class="fas fa-users mr-1"></i> Kelas aktif
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Laporan List -->
    <div class="bg-white rounded-2xl shadow-large overflow-hidden animate-slide-up" style="animation-delay: 0.5s">
        <!-- Table Header -->
        <div class="px-6 py-5 bg-gradient-to-r from-indigo-500 to-purple-600">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h3 class="text-lg font-medium text-white">Laporan Praktikum Saya</h3>
                    <p class="mt-1 text-sm text-indigo-100">
                        Daftar laporan praktikum jaringan komputer Anda
                    </p>
                </div>
                <div class="mt-3 sm:mt-0 flex items-center space-x-2">
                    <span class="text-indigo-100 text-sm">Total: {{ $laporans->count() }} laporan</span>
                </div>
            </div>
        </div>

        @if($laporans->isEmpty())
        <div class="px-4 py-16 sm:px-6 text-center animate-pulse">
            <div class="bg-gray-100 p-6 rounded-full inline-flex mb-4">
                <i class="fas fa-file-alt text-gray-300 text-4xl"></i>
            </div>
            <h3 class="text-xl font-medium text-gray-900 mb-2">Belum ada laporan</h3>
            <p class="text-gray-500 mb-6 max-w-md mx-auto">Mulai dengan membuat laporan pertama Anda</p>
            <a href="{{ route('laporan.create') }}"
                class="px-6 py-3 bg-gradient-to-r from-indigo-500 to-purple-600 text-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 flex items-center justify-center hover:scale-105 inline-flex">
                <i class="fas fa-plus-circle mr-2"></i>
                Buat Laporan Pertama
            </a>
        </div>
        @else
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            No
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nama Siswa
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Kelas
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Alamat IP
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Catatan
                        </th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($laporans as $i => $laporan)
                    <tr class="table-row-hover">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $i + 1 }}
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 bg-gradient-to-r from-indigo-400 to-purple-500 rounded-full flex items-center justify-center">
                                    <span class="text-white font-medium text-sm">{{ strtoupper(substr($laporan->nama, 0, 1)) }}</span>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $laporan->nama }}</div>
                                    <div class="text-sm text-gray-500">{{ Auth::user()->name }}</div>
                                </div>
                            </div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 shadow-sm">
                                <i class="fas fa-users mr-1.5" style="font-size: 10px;"></i>
                                {{ $laporan->kelas }}
                            </span>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900 space-y-2">
                                <div class="flex items-center">
                                    <i class="fas fa-desktop mr-2 text-blue-500 text-xs"></i>
                                    <span class="font-mono text-xs bg-blue-50 px-2 py-1 rounded">{{ $laporan->ip_pc1 ?? '-' }}</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-desktop mr-2 text-green-500 text-xs"></i>
                                    <span class="font-mono text-xs bg-green-50 px-2 py-1 rounded">{{ $laporan->ip_pc2 ?? '-' }}</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-desktop mr-2 text-purple-500 text-xs"></i>
                                    <span class="font-mono text-xs bg-purple-50 px-2 py-1 rounded">{{ $laporan->ip_pc3 ?? '-' }}</span>
                                </div>
                            </div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($laporan->status == 'selesai')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 shadow-sm">
                                <i class="fas fa-check-circle mr-1.5" style="font-size: 10px;"></i>
                                Selesai
                            </span>
                            @elseif($laporan->status == 'proses')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 shadow-sm">
                                <i class="fas fa-clock mr-1.5" style="font-size: 10px;"></i>
                                Proses
                            </span>
                            @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800 shadow-sm">
                                <i class="fas fa-edit mr-1.5" style="font-size: 10px;"></i>
                                Draft
                            </span>
                            @endif
                        </td>

                        <td class="px-6 py-4 text-sm text-gray-500 max-w-xs">
                            <div class="truncate bg-gray-50 px-3 py-2 rounded-lg">
                                {{ $laporan->catatan ? Str::limit($laporan->catatan, 20, '...') : 'Tidak ada catatan' }}
                            </div>
                        </td>

                        <!-- Action Buttons -->
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex justify-end space-x-2">
                                <!-- Lihat Detail -->
                                <a href="{{ route('laporan.show', $laporan->id) }}"
                                   class="w-10 h-10 rounded-xl bg-gradient-to-r from-blue-500 to-cyan-500 hover:from-blue-600 hover:to-cyan-600 text-white flex items-center justify-center shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-110 active:scale-95"
                                   title="Lihat Detail">
                                    <i class="fas fa-eye text-xs"></i>
                                </a>

                                @if($laporan->status == 'draft')
                                <!-- Edit -->
                                <a href="{{ route('laporan.edit', $laporan->id) }}"
                                   class="w-10 h-10 rounded-xl bg-gradient-to-r from-emerald-500 to-green-500 hover:from-emerald-600 hover:to-green-600 text-white flex items-center justify-center shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-110 active:scale-95"
                                   title="Edit">
                                    <i class="fas fa-edit text-xs"></i>
                                </a>

                                <!-- Hapus -->
                                <button onclick="openDeleteModal({{ $laporan->id }}, '{{ addslashes($laporan->nama) }}')"
                                        class="w-10 h-10 rounded-xl bg-gradient-to-r from-rose-500 to-pink-500 hover:from-rose-600 hover:to-pink-600 text-white flex items-center justify-center shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-110 active:scale-95"
                                        title="Hapus">
                                    <i class="fas fa-trash-alt text-xs"></i>
                                </button>
                                @else
                                <!-- Edit Disabled -->
                                <button disabled
                                   class="w-10 h-10 rounded-xl bg-gray-300 text-gray-500 flex items-center justify-center cursor-not-allowed"
                                   title="Tidak dapat edit - status {{ $laporan->status }}">
                                    <i class="fas fa-edit text-xs"></i>
                                </button>
                                <!-- Hapus Disabled -->
                                <button disabled
                                   class="w-10 h-10 rounded-xl bg-gray-300 text-gray-500 flex items-center justify-center cursor-not-allowed"
                                   title="Tidak dapat hapus - status {{ $laporan->status }}">
                                    <i class="fas fa-trash-alt text-xs"></i>
                                </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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
            <h3 class="text-xl font-bold text-gray-900 mb-2">Hapus Laporan</h3>
            <div class="mt-2 px-4 py-3">
                <p class="text-sm text-gray-600 mb-4">
                    Apakah Anda yakin ingin menghapus laporan <span class="font-semibold text-gray-900" id="deleteLaporanTitle"></span>?
                </p>
                <p class="text-xs text-red-500 bg-red-50 p-3 rounded-lg">
                    <i class="fas fa-info-circle mr-1"></i>
                    Tindakan ini tidak dapat dibatalkan dan semua data laporan akan dihapus permanen.
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

    .table-row-hover:hover {
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
    function openDeleteModal(laporanId, laporanTitle) {
        document.getElementById('deleteLaporanTitle').textContent = laporanTitle;
        document.getElementById('deleteForm').action = `/laporan/${laporanId}`;
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
