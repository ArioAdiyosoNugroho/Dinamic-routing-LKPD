@extends('layout')

@section('title', 'Edit Laporan - LKPD App')

@section('content')
<div class="max-w-4xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <!-- Header Section -->
    <div class="mb-8 animate-fade-in">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div class="flex-1 min-w-0">
                <h1 class="text-3xl font-bold text-gray-800 flex items-center">
                    <div class="w-12 h-12 flex items-center justify-center bg-gradient-to-b from-indigo-400 to-purple-500 rounded-xl shadow-md mr-4">
                        <i class="fas fa-edit text-white text-2xl"></i>
                    </div>
                    <span>Edit Laporan</span>
                </h1>
                <p class="mt-2 text-lg text-gray-600 max-w-2xl">
                    Perbarui informasi laporan praktikum jaringan Anda
                </p>
            </div>
            <div class="mt-4 md:mt-0">
                <a href="{{ route('laporan.index') }}"
                   class="px-6 py-3 bg-gradient-to-r from-gray-500 to-gray-600 text-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 flex items-center hover:scale-105">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali ke Daftar
                </a>
            </div>
        </div>
    </div>

    <!-- Notifikasi -->
    <x-notifikasi />

    <!-- Form Section -->
    <div class="bg-white rounded-2xl shadow-large overflow-hidden animate-slide-up">
        <!-- Form Header -->
        <div class="px-6 py-5 bg-gradient-to-r from-indigo-500 to-purple-600">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-medium text-white flex items-center">
                        <i class="fas fa-file-edit mr-2"></i>
                        Form Edit Laporan
                    </h3>
                    <p class="mt-1 text-sm text-indigo-100">
                        Lengkapi informasi laporan praktikum jaringan
                    </p>
                </div>
                <div class="flex items-center space-x-2">
                    <span class="text-indigo-100 text-sm bg-indigo-400 bg-opacity-50 px-3 py-1 rounded-full">
                        <i class="fas fa-id-card mr-1"></i>
                        ID: {{ $laporan->id }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Error Validation -->
        @if ($errors->any())
        <div class="mx-6 mt-6 p-4 bg-red-50 border border-red-200 rounded-xl animate-pulse">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-red-800">
                        Terdapat {{ $errors->count() }} error dalam pengisian form
                    </h3>
                    <div class="mt-2 text-sm text-red-700">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Form Content -->
        <form action="{{ route('laporan.update', $laporan->id) }}" method="POST" class="p-6 space-y-6">
            @csrf
            @method('PUT')

            <!-- Informasi Dasar -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nama -->
                <div class="space-y-2">
                    <label for="nama" class="block text-sm font-medium text-gray-700 flex items-center">
                        <i class="fas fa-user mr-2 text-indigo-500"></i>
                        Nama Lengkap
                        <span class="text-red-500 ml-1">*</span>
                    </label>
                    <div class="relative">
                        <input type="text"
                               id="nama"
                               name="nama"
                               value="{{ old('nama', $laporan->nama) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-200"
                               placeholder="Masukkan nama lengkap"
                               required>
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <i class="fas fa-user text-gray-400"></i>
                        </div>
                    </div>
                </div>

                <!-- Kelas -->
                <div class="space-y-2">
                    <label for="kelas" class="block text-sm font-medium text-gray-700 flex items-center">
                        <i class="fas fa-users mr-2 text-indigo-500"></i>
                        Kelas
                        <span class="text-red-500 ml-1">*</span>
                    </label>
                    <div class="relative">
                        <input type="text"
                               id="kelas"
                               name="kelas"
                               value="{{ old('kelas', $laporan->kelas) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-200"
                               placeholder="Contoh: X IPA 1"
                               required>
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <i class="fas fa-graduation-cap text-gray-400"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Alamat IP Section -->
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <label class="block text-sm font-medium text-gray-700 flex items-center">
                        <i class="fas fa-network-wired mr-2 text-indigo-500"></i>
                        Konfigurasi Alamat IP
                    </label>
                    <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded-full">
                        Opsional
                    </span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- IP PC1 -->
                    <div class="space-y-2">
                        <label for="ip_pc1" class="block text-xs font-medium text-gray-600 flex items-center">
                            <i class="fas fa-desktop mr-1 text-blue-500"></i>
                            PC 1
                        </label>
                        <div class="relative">
                            <input type="text"
                                   id="ip_pc1"
                                   name="ip_pc1"
                                   value="{{ old('ip_pc1', $laporan->ip_pc1) }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                                   placeholder="192.168.1.1">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <i class="fas fa-server text-gray-400 text-sm"></i>
                            </div>
                        </div>
                    </div>

                    <!-- IP PC2 -->
                    <div class="space-y-2">
                        <label for="ip_pc2" class="block text-xs font-medium text-gray-600 flex items-center">
                            <i class="fas fa-desktop mr-1 text-green-500"></i>
                            PC 2
                        </label>
                        <div class="relative">
                            <input type="text"
                                   id="ip_pc2"
                                   name="ip_pc2"
                                   value="{{ old('ip_pc2', $laporan->ip_pc2) }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-200"
                                   placeholder="192.168.1.2">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <i class="fas fa-server text-gray-400 text-sm"></i>
                            </div>
                        </div>
                    </div>

                    <!-- IP PC3 -->
                    <div class="space-y-2">
                        <label for="ip_pc3" class="block text-xs font-medium text-gray-600 flex items-center">
                            <i class="fas fa-desktop mr-1 text-purple-500"></i>
                            PC 3
                        </label>
                        <div class="relative">
                            <input type="text"
                                   id="ip_pc3"
                                   name="ip_pc3"
                                   value="{{ old('ip_pc3', $laporan->ip_pc3) }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition duration-200"
                                   placeholder="192.168.1.3">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <i class="fas fa-server text-gray-400 text-sm"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- IP Help Text -->
                <div class="bg-blue-50 border border-blue-200 rounded-xl p-4">
                    <div class="flex items-start">
                        <i class="fas fa-info-circle text-blue-500 mt-0.5 mr-3"></i>
                        <div class="text-sm text-blue-700">
                            <p class="font-medium">Format Alamat IP</p>
                            <p class="mt-1">Gunakan format IPv4 standar (contoh: 192.168.1.1). Pastikan alamat IP sesuai dengan konfigurasi jaringan yang digunakan.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Catatan Section -->
            <div class="space-y-4">
                <label for="catatan" class="block text-sm font-medium text-gray-700 flex items-center">
                    <i class="fas fa-sticky-note mr-2 text-indigo-500"></i>
                    Catatan Praktikum
                </label>

                <div class="relative">
                    <textarea
                        id="catatan"
                        name="catatan"
                        rows="6"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-200 resize-none"
                        placeholder="Tuliskan catatan, observasi, atau hasil praktikum Anda di sini...">{{ old('catatan', $laporan->catatan) }}</textarea>
                    <div class="absolute top-3 right-3">
                        <i class="fas fa-edit text-gray-400"></i>
                    </div>
                </div>

                <!-- Character Counter -->
                <div class="flex justify-between items-center text-xs text-gray-500">
                    <span>Tambahkan catatan untuk menjelaskan hasil praktikum</span>
                    <span id="charCount">{{ strlen(old('catatan', $laporan->catatan)) }}/1000</span>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex flex-col sm:flex-row justify-between space-y-4 sm:space-y-0 sm:space-x-4 pt-6 border-t border-gray-200">
                <a href="{{ route('laporan.index') }}"
                   class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 text-sm font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50 transition-all duration-300 transform hover:scale-105 hover:shadow-md shadow-sm">
                    <i class="fas fa-times mr-2"></i>
                    Batal
                </a>

                <div class="flex space-x-3">
                    <button type="reset"
                            class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 text-sm font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50 transition-all duration-300 transform hover:scale-105 hover:shadow-md shadow-sm">
                        <i class="fas fa-redo mr-2"></i>
                        Reset
                    </button>

                    <button type="submit"
                            class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-sm font-medium rounded-xl text-white bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 transition-all duration-300 transform hover:scale-105 hover:shadow-md shadow-sm">
                        <i class="fas fa-save mr-2"></i>
                        Simpan Perubahan
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Info Panel -->
    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Last Updated -->
        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-4 border border-blue-200">
            <div class="flex items-center">
                <div class="flex-shrink-0 w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-clock text-blue-600"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-blue-900">Terakhir Diperbarui</p>
                    <p class="text-sm text-blue-700">{{ $laporan->updated_at->format('d F Y H:i') }}</p>
                </div>
            </div>
        </div>

        <!-- Created Info -->
        <div class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl p-4 border border-green-200">
            <div class="flex items-center">
                <div class="flex-shrink-0 w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-calendar-plus text-green-600"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-green-900">Dibuat Pada</p>
                    <p class="text-sm text-green-700">{{ $laporan->created_at->format('d F Y H:i') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

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

    /* Focus styles for better accessibility */
    input:focus, textarea:focus {
        transform: translateY(-1px);
        transition: all 0.2s ease;
    }

    /* Character counter styling */
    #charCount {
        font-family: 'Courier New', monospace;
        font-weight: 600;
    }
</style>

<script>
    // Character counter for catatan textarea
    document.addEventListener('DOMContentLoaded', function() {
        const catatanTextarea = document.getElementById('catatan');
        const charCount = document.getElementById('charCount');

        catatanTextarea.addEventListener('input', function() {
            const length = this.value.length;
            charCount.textContent = `${length}/1000`;

            // Change color when approaching limit
            if (length > 900) {
                charCount.classList.add('text-red-500');
                charCount.classList.remove('text-gray-500');
            } else if (length > 800) {
                charCount.classList.add('text-yellow-500');
                charCount.classList.remove('text-gray-500', 'text-red-500');
            } else {
                charCount.classList.remove('text-yellow-500', 'text-red-500');
                charCount.classList.add('text-gray-500');
            }
        });

        // Add animation to form elements on focus
        const formInputs = document.querySelectorAll('input, textarea');
        formInputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('ring-2', 'ring-indigo-200', 'rounded-xl');
            });

            input.addEventListener('blur', function() {
                this.parentElement.classList.remove('ring-2', 'ring-indigo-200', 'rounded-xl');
            });
        });

        // Form validation enhancement
        const form = document.querySelector('form');
        form.addEventListener('submit', function(e) {
            const nama = document.getElementById('nama').value.trim();
            const kelas = document.getElementById('kelas').value.trim();

            if (!nama || !kelas) {
                e.preventDefault();
                // Add shake animation to empty required fields
                const requiredFields = document.querySelectorAll('input[required]');
                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        field.classList.add('border-red-500');
                        field.classList.remove('border-gray-300');

                        // Shake animation
                        field.style.animation = 'shake 0.5s ease-in-out';
                        setTimeout(() => {
                            field.style.animation = '';
                        }, 500);
                    }
                });

                // Scroll to first error
                const firstError = document.querySelector('.border-red-500');
                if (firstError) {
                    firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            }
        });

        // Remove red border when user starts typing
        formInputs.forEach(input => {
            input.addEventListener('input', function() {
                if (this.classList.contains('border-red-500')) {
                    this.classList.remove('border-red-500');
                    this.classList.add('border-gray-300');
                }
            });
        });
    });

    // Shake animation for form validation
    const style = document.createElement('style');
    style.textContent = `
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }
    `;
    document.head.appendChild(style);

    document.addEventListener('DOMContentLoaded', function() {
    // Real-time IP validation
    const ipInputs = document.querySelectorAll('input[name^="ip_pc"]');

    ipInputs.forEach(input => {
        input.addEventListener('blur', function() {
            validateIPAddress(this);
        });

        input.addEventListener('input', function() {
            // Remove error state when user starts typing
            if (this.classList.contains('border-red-500')) {
                this.classList.remove('border-red-500', 'text-red-500');
                this.classList.add('border-gray-300', 'text-gray-700');
                hideIPError(this);
            }
        });
    });

    function validateIPAddress(input) {
        const value = input.value.trim();

        if (value === '') {
            return true; // Empty is allowed (nullable)
        }

        // Basic IP validation pattern
        const ipPattern = /^(\d{1,3}\.){3}\d{1,3}(\/\d{1,2})?$/;
        const wildcardPattern = /^(\d{1,3}|\*)\.(\d{1,3}|\*)\.(\d{1,3}|\*)\.(\d{1,3}|\*)$/;

        let isValid = false;

        if (ipPattern.test(value)) {
            // Validate IPv4 format
            const parts = value.split('/');
            const ipParts = parts[0].split('.');

            isValid = ipParts.every(part => {
                const num = parseInt(part);
                return num >= 0 && num <= 255;
            });

            // Validate subnet mask if present
            if (isValid && parts.length > 1) {
                const mask = parseInt(parts[1]);
                isValid = mask >= 0 && mask <= 32;
            }
        } else if (wildcardPattern.test(value)) {
            // Validate wildcard format
            const ipParts = value.split('.');
            isValid = ipParts.every(part => {
                if (part === '*') return true;
                const num = parseInt(part);
                return num >= 0 && num <= 255;
            });
        }

        if (!isValid && value !== '') {
            showIPError(input, 'Format IP address tidak valid. Contoh: 192.168.1.1 atau 192.168.1.0/24');
            return false;
        }

        return true;
    }

    function showIPError(input, message) {
        input.classList.add('border-red-500', 'text-red-500');
        input.classList.remove('border-gray-300', 'text-gray-700');

        // Remove existing error message
        hideIPError(input);

        // Add error message
        const errorDiv = document.createElement('div');
        errorDiv.className = 'mt-1 text-sm text-red-600 flex items-center';
        errorDiv.innerHTML = `<i class="fas fa-exclamation-circle mr-1"></i> ${message}`;
        errorDiv.id = `error-${input.name}`;

        input.parentNode.appendChild(errorDiv);
    }

    function hideIPError(input) {
        const existingError = document.getElementById(`error-${input.name}`);
        if (existingError) {
            existingError.remove();
        }
    }

    // Form submission validation
    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        let isValid = true;

        // Validate all IP inputs
        ipInputs.forEach(input => {
            if (!validateIPAddress(input)) {
                isValid = false;
                // Scroll to first error
                if (isValid === false) {
                    input.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    input.focus();
                    isValid = true; // Prevent multiple scrolls
                }
            }
        });

        if (!isValid) {
            e.preventDefault();
            // Show general error message
            showGeneralError('Terdapat error dalam format IP address. Silakan periksa kembali.');
        }
    });

    function showGeneralError(message) {
        // Remove existing general error
        hideGeneralError();

        const errorDiv = document.createElement('div');
        errorDiv.className = 'mb-4 p-4 bg-red-50 border border-red-200 rounded-xl animate-pulse';
        errorDiv.innerHTML = `
            <div class="flex items-center">
                <i class="fas fa-exclamation-triangle text-red-600 mr-3"></i>
                <div>
                    <h3 class="text-sm font-medium text-red-800">Validasi Gagal</h3>
                    <p class="text-sm text-red-700 mt-1">${message}</p>
                </div>
            </div>
        `;
        errorDiv.id = 'general-ip-error';

        form.prepend(errorDiv);
    }

    function hideGeneralError() {
        const existingError = document.getElementById('general-ip-error');
        if (existingError) {
            existingError.remove();
        }
    }

    // Auto-format IP address on blur
    ipInputs.forEach(input => {
        input.addEventListener('blur', function() {
            const value = this.value.trim();
            if (value && this.isValidIPFormat(value)) {
                this.value = this.autoFormatIP(value);
            }
        });
    });

    // Helper function to auto-format IP
    function autoFormatIP(ip) {
        // Remove extra spaces and normalize
        return ip.replace(/\s+/g, '').toLowerCase();
    }

    // Helper function to check basic IP format
    function isValidIPFormat(ip) {
        const basicPattern = /^[\d.*\/-]+$/;
        return basicPattern.test(ip);
    }
});
</script>
@endsection
