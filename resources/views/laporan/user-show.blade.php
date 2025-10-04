@extends('layout')

@section('title', 'Detail Laporan Saya - LKPD App')

@section('content')
<div class="max-w-6xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
  <!-- Header Section -->
  <div class="mb-8">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
      <div class="flex-1 min-w-0">
        <h1 class="text-3xl font-bold text-gray-800 flex items-center">
          <i class="fas fa-file-alt text-indigo-600 mr-3"></i>
          Detail Laporan Saya
        </h1>
        <p class="mt-2 text-sm text-gray-600">
          Informasi lengkap laporan praktikum jaringan Anda - <span class="font-semibold">View User</span>
        </p>
      </div>
      <div class="mt-4 flex md:mt-0 md:ml-4 space-x-3">
        <a href="{{ route('laporan.index') }}"
           class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition duration-300 flex items-center">
          <i class="fas fa-arrow-left mr-2"></i> Kembali ke Laporan Saya
        </a>

        @if($laporan->status == 'draft')
        <a href="{{ route('laporan.edit', $laporan->id) }}"
           class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-medium hover:bg-indigo-700 transition duration-300 flex items-center">
          <i class="fas fa-edit mr-2"></i> Edit Laporan
        </a>
        @else
        <button disabled
           class="px-4 py-2 bg-gray-400 text-white rounded-lg text-sm font-medium cursor-not-allowed flex items-center">
          <i class="fas fa-edit mr-2"></i> Tidak Dapat Edit
        </button>
        @endif
      </div>
    </div>
  </div>

  <!-- Flash Messages -->
  @if(session('success'))
    <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl flex items-center">
      <i class="fas fa-check-circle text-green-600 mr-3"></i>
      <span class="text-green-800 font-medium">{{ session('success') }}</span>
    </div>
  @endif

  @if(session('error'))
    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl flex items-center">
      <i class="fas fa-exclamation-circle text-red-600 mr-3"></i>
      <span class="text-red-800 font-medium">{{ session('error') }}</span>
    </div>
  @endif

  <!-- Status Alert -->
  @if(in_array($laporan->status, ['proses', 'selesai']))
  <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-xl">
    <div class="flex items-center">
      <i class="fas fa-info-circle text-blue-600 mr-3 text-lg"></i>
      <div>
        <p class="text-blue-800 font-medium">Laporan dalam status {{ $laporan->status == 'proses' ? 'proses' : 'selesai' }}</p>
        <p class="text-blue-700 text-sm mt-1">
          @if($laporan->status == 'proses')
            Laporan Anda sedang dalam proses peninjauan oleh admin. Tidak dapat dilakukan perubahan.
          @else
            Laporan Anda sudah selesai dan telah disetujui. Tidak dapat dilakukan perubahan.
          @endif
        </p>
      </div>
    </div>
  </div>
  @endif

  <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
    <!-- Main Information -->
    <div class="lg:col-span-3 space-y-6">
      <!-- Laporan Overview Card -->
      <div class="bg-white shadow-lg rounded-xl overflow-hidden border border-gray-100">
        <div class="px-6 py-4 bg-gradient-to-r from-indigo-500 to-purple-600">
          <div class="flex items-center justify-between">
            <h3 class="text-lg font-medium text-white">Informasi Laporan Saya</h3>
            <span class="bg-white/20 text-white px-3 py-1 rounded-full text-sm font-medium">
              <i class="fas fa-user mr-1"></i> My Report
            </span>
          </div>
        </div>
        <div class="p-6">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-4">
              <div>
                <label class="block text-sm font-medium text-gray-500 mb-1">Nama Siswa</label>
                <p class="text-lg font-semibold text-gray-900">{{ $laporan->nama }}</p>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-500 mb-1">Kelas</label>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800 border border-blue-200">
                  <i class="fas fa-graduation-cap mr-1"></i> {{ $laporan->kelas }}
                </span>
              </div>
            </div>
            <div class="space-y-4">
              <div>
                <label class="block text-sm font-medium text-gray-500 mb-1">Status Laporan</label>
                <div class="flex items-center space-x-3">
                  <span class="px-4 py-2 rounded-full text-sm font-semibold border-2
                    @if($laporan->status == 'selesai') bg-green-100 text-green-800 border-green-300
                    @elseif($laporan->status == 'proses') bg-yellow-100 text-yellow-800 border-yellow-300
                    @else bg-gray-100 text-gray-800 border-gray-300 @endif">
                    @if($laporan->status == 'selesai')
                      <i class="fas fa-check-circle mr-1"></i> Selesai
                    @elseif($laporan->status == 'proses')
                      <i class="fas fa-clock mr-1"></i> Dalam Proses
                    @else
                      <i class="fas fa-edit mr-1"></i> Draft
                    @endif
                  </span>
                </div>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-500 mb-1">Progress</label>
                <div class="w-full bg-gray-200 rounded-full h-2.5">
                  <div class="h-2.5 rounded-full
                    @if($laporan->status == 'selesai') bg-green-500 w-full
                    @elseif($laporan->status == 'proses') bg-yellow-500 w-2/3
                    @else bg-gray-400 w-1/3 @endif">
                  </div>
                </div>
                <p class="text-xs text-gray-500 mt-1">
                  @if($laporan->status == 'selesai') 100% Selesai
                  @elseif($laporan->status == 'proses') 66% Dalam Proses
                  @else 33% Draft
                  @endif
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Network Configuration Card -->
      <div class="bg-white shadow-lg rounded-xl overflow-hidden border border-gray-100">
        <div class="px-6 py-4 bg-gradient-to-r from-blue-500 to-cyan-600">
          <h3 class="text-lg font-medium text-white flex items-center">
            <i class="fas fa-network-wired mr-2"></i> Konfigurasi Jaringan Saya
          </h3>
        </div>
        <div class="p-6">
          <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- PC 1 -->
            <div class="bg-gradient-to-br from-blue-50 to-cyan-50 rounded-xl p-4 border border-blue-200">
              <div class="flex items-center justify-between mb-3">
                <div class="flex items-center">
                  <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                    <i class="fas fa-desktop text-blue-600"></i>
                  </div>
                  <span class="font-semibold text-gray-800">PC 1</span>
                </div>
                <span class="px-2 py-1 text-xs font-medium rounded-full
                  {{ $laporan->ip_pc1 ? 'bg-green-100 text-green-800 border border-green-300' : 'bg-gray-100 text-gray-800 border border-gray-300' }}">
                  {{ $laporan->ip_pc1 ? '✓ Terkonfigurasi' : '✗ Belum' }}
                </span>
              </div>
              <p class="font-mono text-lg text-gray-900 bg-white px-3 py-2 rounded-lg border text-center">
                {{ $laporan->ip_pc1 ?? 'Belum diatur' }}
              </p>
            </div>

            <!-- PC 2 -->
            <div class="bg-gradient-to-br from-blue-50 to-cyan-50 rounded-xl p-4 border border-blue-200">
              <div class="flex items-center justify-between mb-3">
                <div class="flex items-center">
                  <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                    <i class="fas fa-desktop text-blue-600"></i>
                  </div>
                  <span class="font-semibold text-gray-800">PC 2</span>
                </div>
                <span class="px-2 py-1 text-xs font-medium rounded-full
                  {{ $laporan->ip_pc2 ? 'bg-green-100 text-green-800 border border-green-300' : 'bg-gray-100 text-gray-800 border border-gray-300' }}">
                  {{ $laporan->ip_pc2 ? '✓ Terkonfigurasi' : '✗ Belum' }}
                </span>
              </div>
              <p class="font-mono text-lg text-gray-900 bg-white px-3 py-2 rounded-lg border text-center">
                {{ $laporan->ip_pc2 ?? 'Belum diatur' }}
              </p>
            </div>

            <!-- PC 3 -->
            <div class="bg-gradient-to-br from-blue-50 to-cyan-50 rounded-xl p-4 border border-blue-200">
              <div class="flex items-center justify-between mb-3">
                <div class="flex items-center">
                  <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                    <i class="fas fa-desktop text-blue-600"></i>
                  </div>
                  <span class="font-semibold text-gray-800">PC 3</span>
                </div>
                <span class="px-2 py-1 text-xs font-medium rounded-full
                  {{ $laporan->ip_pc3 ? 'bg-green-100 text-green-800 border border-green-300' : 'bg-gray-100 text-gray-800 border border-gray-300' }}">
                  {{ $laporan->ip_pc3 ? '✓ Terkonfigurasi' : '✗ Belum' }}
                </span>
              </div>
              <p class="font-mono text-lg text-gray-900 bg-white px-3 py-2 rounded-lg border text-center">
                {{ $laporan->ip_pc3 ?? 'Belum diatur' }}
              </p>
            </div>
          </div>
        </div>
      </div>

      <!-- Notes & Observations Card -->
      <div class="bg-white shadow-lg rounded-xl overflow-hidden border border-gray-100">
        <div class="px-6 py-4 bg-gradient-to-r from-purple-500 to-pink-600">
          <h3 class="text-lg font-medium text-white flex items-center">
            <i class="fas fa-clipboard-list mr-2"></i> Catatan & Observasi Saya
          </h3>
        </div>
        <div class="p-6">
          @if($laporan->catatan)
            <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-xl p-6 border border-purple-200">
              <div class="prose max-w-none">
                <p class="text-gray-700 whitespace-pre-line leading-relaxed text-lg">{{ $laporan->catatan }}</p>
              </div>
            </div>
          @else
            <div class="text-center py-8">
              <i class="fas fa-sticky-note text-4xl text-gray-300 mb-4"></i>
              <p class="text-gray-500 font-medium">Belum ada catatan</p>
              <p class="text-gray-400 text-sm mt-1">
                @if($laporan->status == 'draft')
                  Tambahkan catatan untuk laporan Anda
                @else
                  Tidak dapat menambah catatan - status sudah {{ $laporan->status }}
                @endif
              </p>
              @if($laporan->status == 'draft')
              <a href="{{ route('laporan.edit', $laporan->id) }}"
                 class="mt-4 inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-medium hover:bg-indigo-700 transition duration-200">
                <i class="fas fa-plus mr-2"></i> Tambah Catatan
              </a>
              @endif
            </div>
          @endif
        </div>
      </div>
    </div>

    <!-- Sidebar Information -->
    <div class="space-y-6">
      <!-- My Profile Card -->
      <div class="bg-white shadow-lg rounded-xl overflow-hidden border border-gray-100">
        <div class="px-6 py-4 bg-gradient-to-r from-green-500 to-emerald-600">
          <h3 class="text-lg font-medium text-white flex items-center">
            <i class="fas fa-user-check mr-2"></i> Profil Saya
          </h3>
        </div>
        <div class="p-6">
          <div class="text-center">
            <div class="mx-auto w-20 h-20 bg-gradient-to-r from-green-400 to-blue-500 rounded-full flex items-center justify-center mb-4 shadow-lg">
              <span class="text-white font-bold text-2xl">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
              </span>
            </div>
            <h4 class="text-lg font-semibold text-gray-900">{{ Auth::user()->name }}</h4>
            <p class="text-sm text-gray-500 mb-4">{{ Auth::user()->email }}</p>
            <div class="space-y-2">
              <div class="flex items-center justify-center text-sm text-gray-500 bg-gray-50 rounded-lg p-2">
                <i class="fas fa-calendar-plus mr-2 text-indigo-500"></i>
                <span>Dibuat: {{ $laporan->created_at->format('d M Y') }}</span>
              </div>
              <div class="flex items-center justify-center text-sm text-gray-500 bg-gray-50 rounded-lg p-2">
                <i class="fas fa-edit mr-2 text-indigo-500"></i>
                <span>Diupdate: {{ $laporan->updated_at->format('d M Y') }}</span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Report Status Card -->
      <div class="bg-white shadow-lg rounded-xl overflow-hidden border border-gray-100">
        <div class="px-6 py-4 bg-gradient-to-r from-orange-500 to-amber-600">
          <h3 class="text-lg font-medium text-white flex items-center">
            <i class="fas fa-chart-line mr-2"></i> Status Laporan
          </h3>
        </div>
        <div class="p-6">
          <div class="space-y-4">
            <div class="text-center">
              <div class="mx-auto w-24 h-24 rounded-full border-8
                @if($laporan->status == 'selesai') border-green-500 bg-green-50
                @elseif($laporan->status == 'proses') border-yellow-500 bg-yellow-50
                @else border-gray-400 bg-gray-50 @endif flex items-center justify-center mb-3">
                <span class="text-2xl font-bold
                  @if($laporan->status == 'selesai') text-green-700
                  @elseif($laporan->status == 'proses') text-yellow-700
                  @else text-gray-700 @endif">
                  @if($laporan->status == 'selesai') 100%
                  @elseif($laporan->status == 'proses') 66%
                  @else 33%
                  @endif
                </span>
              </div>
              <p class="text-sm text-gray-600">
                @if($laporan->status == 'selesai')
                  Laporan Anda sudah selesai dan telah disetujui
                @elseif($laporan->status == 'proses')
                  Laporan Anda sedang dalam proses peninjauan
                @else
                  Laporan Anda masih dalam tahap draft
                @endif
              </p>
            </div>
          </div>
        </div>
      </div>

      <!-- Quick Actions -->
      <div class="bg-white shadow-lg rounded-xl overflow-hidden border border-gray-100">
        <div class="px-6 py-4 bg-gradient-to-r from-indigo-600 to-purple-700">
          <h3 class="text-lg font-medium text-white flex items-center">
            <i class="fas fa-rocket mr-2"></i> Aksi Cepat
          </h3>
        </div>
        <div class="p-6">
          <div class="space-y-3">
            @if($laporan->status == 'draft')
            <a href="{{ route('laporan.edit', $laporan->id) }}"
               class="w-full flex items-center justify-center px-4 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-xl text-sm font-medium hover:from-indigo-700 hover:to-purple-700 transition duration-200">
              <i class="fas fa-edit mr-2"></i> Edit Laporan
            </a>
            @else
            <button disabled
               class="w-full flex items-center justify-center px-4 py-3 bg-gray-400 text-white rounded-xl text-sm font-medium cursor-not-allowed">
              <i class="fas fa-edit mr-2"></i> Tidak Dapat Edit
            </button>
            @endif

            <a href="{{ route('laporan.index') }}"
               class="w-full flex items-center justify-center px-4 py-3 border-2 border-gray-300 rounded-xl text-sm font-medium text-gray-700 hover:bg-gray-50 transition duration-200 hover:border-indigo-300">
              <i class="fas fa-list mr-2"></i> Laporan Saya
            </a>

            @if($laporan->status == 'draft')
            <form action="{{ route('laporan.destroy', $laporan->id) }}" method="POST"
                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus laporan ini?')">
              @csrf
              @method('DELETE')
              <button type="submit"
                      class="w-full flex items-center justify-center px-4 py-3 bg-gradient-to-r from-red-600 to-red-700 text-white rounded-xl text-sm font-medium hover:from-red-700 hover:to-red-800 transition duration-200">
                <i class="fas fa-trash-alt mr-2"></i> Hapus Laporan
              </button>
            </form>
            @else
            <button disabled
               class="w-full flex items-center justify-center px-4 py-3 bg-gray-400 text-white rounded-xl text-sm font-medium cursor-not-allowed">
              <i class="fas fa-trash-alt mr-2"></i> Tidak Dapat Hapus
            </button>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
  .card-hover {
    transition: all 0.3s ease;
  }

  .card-hover:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 35px rgba(0,0,0,0.1);
  }
</style>
@endsection
