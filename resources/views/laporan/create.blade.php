@extends('layout')

@section('title', 'Buat Laporan Baru - LKPD App')

@section('content')
<!-- Main Content -->
<div class="max-w-4xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <!-- Header Section -->
    <div class="md:flex md:items-center md:justify-between mb-8">
        <div class="flex-1 min-w-0">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                <i class="fas fa-file-alt text-indigo-600 mr-2"></i> Buat Laporan Baru
            </h2>
            <p class="mt-1 text-sm text-gray-500">
                Isi form berikut untuk membuat laporan konfigurasi jaringan baru
            </p>
        </div>
        <div class="mt-4 flex md:mt-0 md:ml-4">
            <a href="{{ url()->previous() }}" class="mr-3 px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 transition duration-300 flex items-center">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-200">
        <!-- Card Header -->
        <div class="px-6 py-4 bg-gradient-to-r from-indigo-500 to-purple-600">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-medium text-white">
                    <i class="fas fa-plus-circle mr-2"></i> Form Laporan Konfigurasi
                </h3>
                <span class="bg-white/20 text-white px-3 py-1 rounded-full text-sm font-medium">
                    <i class="fas fa-network-wired mr-1"></i> Jaringan Komputer
                </span>
            </div>
        </div>

        <!-- Form Content -->
        <form method="POST" action="{{ route('laporan.store') }}" class="p-6 space-y-6">
            @csrf

            <!-- Informasi Siswa Section -->
            <div class="space-y-4">
                <h4 class="text-lg font-semibold text-gray-900 border-b border-gray-200 pb-2">
                    <i class="fas fa-user-graduate mr-2 text-indigo-600"></i>Informasi Siswa
                </h4>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nama Siswa -->
                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-user text-indigo-500 mr-1"></i>Nama Lengkap Siswa
                        </label>
                        <input type="text"
                               name="nama"
                               id="nama"
                               placeholder="Masukkan nama lengkap siswa"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300"
                               required
                               value="{{ old('nama') }}">
                        @error('nama')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kelas -->
                    <div>
                        <label for="kelas" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-graduation-cap text-indigo-500 mr-1"></i>Kelas
                        </label>
                        <input type="text"
                               name="kelas"
                               id="kelas"
                               placeholder="Contoh: XI RA"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300"
                               value="{{ old('kelas') }}">
                        @error('kelas')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Konfigurasi IP Section -->
            <div class="space-y-4">
                <h4 class="text-lg font-semibold text-gray-900 border-b border-gray-200 pb-2">
                    <i class="fas fa-server mr-2 text-indigo-600"></i>Konfigurasi Alamat IP
                </h4>

                <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 mb-4">
                    <div class="flex items-start">
                        <i class="fas fa-info-circle text-blue-500 mt-1 mr-3"></i>
                        <p class="text-sm text-blue-700">
                            Masukkan alamat IP untuk masing-masing komputer dalam jaringan. Format: 192.168.1.1
                        </p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- IP PC 1 -->
                    <div>
                        <label for="ip_pc1" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-desktop text-blue-500 mr-1"></i>IP Address PC 1
                        </label>
                        <input type="text"
                               name="ip_pc1"
                               id="ip_pc1"
                               placeholder="192.168.1.1"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300"
                               value="{{ old('ip_pc1') }}">
                        @error('ip_pc1')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- IP PC 2 -->
                    <div>
                        <label for="ip_pc2" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-desktop text-green-500 mr-1"></i>IP Address PC 2
                        </label>
                        <input type="text"
                               name="ip_pc2"
                               id="ip_pc2"
                               placeholder="192.168.1.2"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-300"
                               value="{{ old('ip_pc2') }}">
                        @error('ip_pc2')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- IP PC 3 -->
                    <div>
                        <label for="ip_pc3" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-desktop text-purple-500 mr-1"></i>IP Address PC 3
                        </label>
                        <input type="text"
                               name="ip_pc3"
                               id="ip_pc3"
                               placeholder="192.168.1.3"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition duration-300"
                               value="{{ old('ip_pc3') }}">
                        @error('ip_pc3')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Catatan Section -->
            <div class="space-y-4">
                <h4 class="text-lg font-semibold text-gray-900 border-b border-gray-200 pb-2">
                    <i class="fas fa-sticky-note mr-2 text-indigo-600"></i>Catatan dan Hasil Ping
                </h4>

                <div>
                    <label for="catatan" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-edit text-indigo-500 mr-1"></i>Catatan Konfigurasi & Hasil Test Ping
                    </label>
                    <textarea name="catatan"
                              id="catatan"
                              rows="6"
                              placeholder="Tuliskan catatan konfigurasi, hasil test ping, kendala yang dihadapi, dan solusi yang diterapkan..."
                              class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300 resize-none">{{ old('catatan') }}</textarea>
                    @error('catatan')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tips Textarea -->
                <div class="bg-amber-50 border border-amber-200 rounded-xl p-4">
                    <div class="flex items-start">
                        <i class="fas fa-lightbulb text-amber-500 mt-1 mr-3"></i>
                        <div>
                            <p class="text-sm font-medium text-amber-800 mb-1">Tips mengisi catatan:</p>
                            <ul class="text-sm text-amber-700 list-disc list-inside space-y-1">
                                <li>Hasil test ping antara komputer</li>
                                <li>Kendala yang ditemukan selama konfigurasi</li>
                                <li>Solusi yang berhasil diterapkan</li>
                                <li>Waktu yang dibutuhkan untuk menyelesaikan konfigurasi</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-4 pt-6 border-t border-gray-200">
                <a href="{{ url()->previous() }}" class="px-6 py-3 border border-gray-300 rounded-xl text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-300 flex items-center justify-center">
                    <i class="fas fa-times mr-2"></i> Batal
                </a>
                <button type="submit" class="gradient-bg text-white px-6 py-3 rounded-xl text-sm font-medium hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-300 transform hover:scale-105 flex items-center justify-center shadow-lg">
                    <i class="fas fa-paper-plane mr-2"></i> Kirim Laporan
                </button>
            </div>
        </form>
    </div>

</div>

<style>
    .gradient-bg {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    /* Smooth focus transitions */
    input:focus, textarea:focus {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.1);
    }

    /* Hover effects for cards */
    .card-hover:hover {
        transform: translateY(-2px);
        transition: all 0.3s ease;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }
</style>

<script>
    // Add some interactive features
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-format IP addresses
        const ipInputs = document.querySelectorAll('input[name^="ip_pc"]');
        ipInputs.forEach(input => {
            input.addEventListener('input', function(e) {
                // Remove any non-digit and non-dot characters
                let value = e.target.value.replace(/[^\d.]/g, '');

                // Limit to 15 characters (max length of IP address)
                if (value.length > 15) {
                    value = value.substring(0, 15);
                }

                e.target.value = value;
            });
        });

        // Add character counter for textarea
        const textarea = document.getElementById('catatan');
        const charCount = document.createElement('div');
        charCount.className = 'text-right text-xs text-gray-500 mt-1';
        charCount.textContent = '0 karakter';
        textarea.parentNode.appendChild(charCount);

        textarea.addEventListener('input', function() {
            charCount.textContent = `${this.value.length} karakter`;

            // Change color based on length
            if (this.value.length > 500) {
                charCount.classList.add('text-green-600');
                charCount.classList.remove('text-gray-500');
            } else {
                charCount.classList.remove('text-green-600');
                charCount.classList.add('text-gray-500');
            }
        });

        // Trigger input event to update counter initially
        textarea.dispatchEvent(new Event('input'));
    });
</script>
@endsection
