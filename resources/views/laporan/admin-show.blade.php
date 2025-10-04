@extends('layout')

@section('title', 'Detail Laporan - LKPD App')

@section('content')
<div class="max-w-6xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
  <!-- Header Section -->
  <div class="mb-8">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
      <div class="flex-1 min-w-0">
        <h1 class="text-3xl font-bold text-gray-800 flex items-center">
          <i class="fas fa-file-alt text-indigo-600 mr-3"></i>
          Detail Laporan
        </h1>
        <p class="mt-2 text-sm text-gray-600">
          Informasi lengkap laporan praktikum jaringan - <span class="font-semibold">View Admin</span>
        </p>
      </div>
      <div class="mt-4 flex md:mt-0 md:ml-4 space-x-3">
        <a href="{{ route('admin.laporan.index') }}"
           class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition duration-300 flex items-center">
          <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar
        </a>
        <form action="{{ route('admin.laporan.destroy', $laporan->id) }}" method="POST"
              onsubmit="return confirm('Apakah Anda yakin ingin menghapus laporan ini?')" class="inline">
          @csrf
          @method('DELETE')
          <button type="submit"
                  class="px-4 py-2 bg-red-600 text-white rounded-lg text-sm font-medium hover:bg-red-700 transition duration-300 flex items-center">
            <i class="fas fa-trash-alt mr-2"></i> Hapus Laporan
          </button>
        </form>
      </div>
    </div>
  </div>

  <!-- Flash Message -->
  @if(session('success'))
    <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl flex items-center">
      <i class="fas fa-check-circle text-green-600 mr-3"></i>
      <span class="text-green-800 font-medium">{{ session('success') }}</span>
    </div>
  @endif

  <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
    <!-- Main Information -->
    <div class="lg:col-span-3 space-y-6">
      <!-- Laporan Overview Card -->
      <div class="bg-white shadow-lg rounded-xl overflow-hidden border border-gray-100">
        <div class="px-6 py-4 bg-gradient-to-r from-indigo-500 to-purple-600">
          <div class="flex items-center justify-between">
            <h3 class="text-lg font-medium text-white">Informasi Laporan</h3>
            <span class="bg-white/20 text-white px-3 py-1 rounded-full text-sm font-medium">
              <i class="fas fa-eye mr-1"></i> Admin View
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
                  <span class="px-3 py-1 rounded-full text-sm font-semibold border
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

                  <!-- Form Update Status -->
                  <form action="{{ route('admin.laporan.updateStatus', $laporan->id) }}" method="POST" class="flex items-center space-x-2">
                    @csrf
                    @method('PATCH')
                    <select name="status"
                            class="text-sm border-2 rounded-lg px-3 py-1 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-200 font-medium
                                  @if($laporan->status == 'selesai') bg-green-50 text-green-700 border-green-300
                                  @elseif($laporan->status == 'proses') bg-yellow-50 text-yellow-700 border-yellow-300
                                  @else bg-gray-50 text-gray-700 border-gray-300 @endif">
                      <option value="draft" {{ $laporan->status == 'draft' ? 'selected' : '' }}>Draft</option>
                      <option value="proses" {{ $laporan->status == 'proses' ? 'selected' : '' }}>Proses</option>
                      <option value="selesai" {{ $laporan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                    <button type="submit"
                            class="px-3 py-1 bg-indigo-600 text-white rounded-lg text-sm hover:bg-indigo-700 transition duration-200 flex items-center">
                      <i class="fas fa-save mr-1"></i> Update
                    </button>
                  </form>
                </div>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-500 mb-1">Progress</label>
                <div class="w-full bg-gray-200 rounded-full h-2">
                  <div class="h-2 rounded-full
                    @if($laporan->status == 'selesai') bg-green-500 w-full
                    @elseif($laporan->status == 'proses') bg-yellow-500 w-2/3
                    @else bg-gray-400 w-1/3 @endif">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Network Configuration Card -->
      <div class="bg-white shadow-lg rounded-xl overflow-hidden border border-gray-100">
        <div class="px-6 py-4 bg-gradient-to-r from-blue-500 to-cyan-600">
          <h3 class="text-lg font-medium text-white flex items-center">
            <i class="fas fa-network-wired mr-2"></i> Konfigurasi Jaringan
          </h3>
        </div>
        <div class="p-6">
          <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- PC 1 -->
            <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl p-4 border border-blue-200">
              <div class="flex items-center justify-between mb-3">
                <div class="flex items-center">
                  <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                    <i class="fas fa-desktop text-blue-600"></i>
                  </div>
                  <span class="font-semibold text-gray-800">PC 1</span>
                </div>
                <span class="px-2 py-1 text-xs font-medium rounded-full
                  {{ $laporan->ip_pc1 ? 'bg-green-100 text-green-800 border border-green-300' : 'bg-gray-100 text-gray-800 border border-gray-300' }}">
                  {{ $laporan->ip_pc1 ? 'Aktif' : 'Nonaktif' }}
                </span>
              </div>
              <p class="font-mono text-lg text-gray-900 bg-white px-3 py-2 rounded-lg border">
                {{ $laporan->ip_pc1 ?? '192.168.1.1' }}
              </p>
            </div>

            <!-- PC 2 -->
            <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl p-4 border border-blue-200">
              <div class="flex items-center justify-between mb-3">
                <div class="flex items-center">
                  <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                    <i class="fas fa-desktop text-blue-600"></i>
                  </div>
                  <span class="font-semibold text-gray-800">PC 2</span>
                </div>
                <span class="px-2 py-1 text-xs font-medium rounded-full
                  {{ $laporan->ip_pc2 ? 'bg-green-100 text-green-800 border border-green-300' : 'bg-gray-100 text-gray-800 border border-gray-300' }}">
                  {{ $laporan->ip_pc2 ? 'Aktif' : 'Nonaktif' }}
                </span>
              </div>
              <p class="font-mono text-lg text-gray-900 bg-white px-3 py-2 rounded-lg border">
                {{ $laporan->ip_pc2 ?? '192.168.1.2' }}
              </p>
            </div>

            <!-- PC 3 -->
            <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl p-4 border border-blue-200">
              <div class="flex items-center justify-between mb-3">
                <div class="flex items-center">
                  <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                    <i class="fas fa-desktop text-blue-600"></i>
                  </div>
                  <span class="font-semibold text-gray-800">PC 3</span>
                </div>
                <span class="px-2 py-1 text-xs font-medium rounded-full
                  {{ $laporan->ip_pc3 ? 'bg-green-100 text-green-800 border border-green-300' : 'bg-gray-100 text-gray-800 border border-gray-300' }}">
                  {{ $laporan->ip_pc3 ? 'Aktif' : 'Nonaktif' }}
                </span>
              </div>
              <p class="font-mono text-lg text-gray-900 bg-white px-3 py-2 rounded-lg border">
                {{ $laporan->ip_pc3 ?? '192.168.1.3' }}
              </p>
            </div>
          </div>
        </div>
      </div>

      <!-- Notes & Observations Card -->
      <div class="bg-white shadow-lg rounded-xl overflow-hidden border border-gray-100">
        <div class="px-6 py-4 bg-gradient-to-r from-purple-500 to-pink-600">
          <h3 class="text-lg font-medium text-white flex items-center">
            <i class="fas fa-clipboard-list mr-2"></i> Catatan & Observasi
          </h3>
        </div>
        <div class="p-6">
          @if($laporan->catatan)
            <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
              <div class="prose max-w-none">
                <p class="text-gray-700 whitespace-pre-line leading-relaxed">{{ $laporan->catatan }}</p>
              </div>
            </div>
          @else
            <div class="text-center py-8">
              <i class="fas fa-sticky-note text-4xl text-gray-300 mb-4"></i>
              <p class="text-gray-500 font-medium">Tidak ada catatan</p>
              <p class="text-gray-400 text-sm mt-1">Belum ada observasi yang dicatat</p>
            </div>
          @endif
        </div>
      </div>
    </div>

    <!-- Sidebar Information -->
    <div class="space-y-6">
      <!-- Creator Information -->
      <div class="bg-white shadow-lg rounded-xl overflow-hidden border border-gray-100">
        <div class="px-6 py-4 bg-gradient-to-r from-green-500 to-emerald-600">
          <h3 class="text-lg font-medium text-white flex items-center">
            <i class="fas fa-user-circle mr-2"></i> Informasi Pembuat
          </h3>
        </div>
        <div class="p-6">
          <div class="text-center">
            <div class="mx-auto w-20 h-20 bg-gradient-to-r from-green-400 to-blue-500 rounded-full flex items-center justify-center mb-4 shadow-lg">
              <span class="text-white font-bold text-2xl">
                {{ strtoupper(substr($laporan->user->name ?? 'U', 0, 1)) }}
              </span>
            </div>
            <h4 class="text-lg font-semibold text-gray-900">{{ $laporan->user->name }}</h4>
            <p class="text-sm text-gray-500 mb-4">{{ $laporan->user->nis ?? '-' }}</p>
            <div class="flex items-center justify-center text-sm text-gray-500 bg-gray-50 rounded-lg p-3">
              <i class="fas fa-calendar-alt mr-2 text-indigo-500"></i>
              <span>Dibuat: {{ $laporan->created_at->format('d M Y, H:i') }}</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Status Timeline -->
      <div class="bg-white shadow-lg rounded-xl overflow-hidden border border-gray-100">
        <div class="px-6 py-4 bg-gradient-to-r from-orange-500 to-amber-600">
          <h3 class="text-lg font-medium text-white flex items-center">
            <i class="fas fa-road mr-2"></i> Timeline Status
          </h3>
        </div>
        <div class="p-6">
          <div class="space-y-4">
            <div class="flex items-center">
              <div class="flex-shrink-0 w-8 h-8 rounded-full bg-green-500 flex items-center justify-center">
                <i class="fas fa-check text-white text-xs"></i>
              </div>
              <div class="ml-4 flex-1">
                <p class="text-sm font-medium text-gray-900">Draft</p>
                <p class="text-xs text-gray-500">Laporan dibuat</p>
              </div>
              <div class="w-2 h-2 rounded-full {{ $laporan->status != 'draft' ? 'bg-green-500' : 'bg-gray-300' }}"></div>
            </div>

            <div class="flex items-center">
              <div class="flex-shrink-0 w-8 h-8 rounded-full {{ $laporan->status == 'proses' || $laporan->status == 'selesai' ? 'bg-yellow-500' : 'bg-gray-300' }} flex items-center justify-center">
                <i class="fas {{ $laporan->status == 'proses' || $laporan->status == 'selesai' ? 'fa-spinner' : 'fa-clock' }} text-white text-xs"></i>
              </div>
              <div class="ml-4 flex-1">
                <p class="text-sm font-medium text-gray-900">Dalam Proses</p>
                <p class="text-xs text-gray-500">Sedang dikerjakan</p>
              </div>
              <div class="w-2 h-2 rounded-full {{ $laporan->status == 'proses' || $laporan->status == 'selesai' ? 'bg-yellow-500' : 'bg-gray-300' }}"></div>
            </div>

            <div class="flex items-center">
              <div class="flex-shrink-0 w-8 h-8 rounded-full {{ $laporan->status == 'selesai' ? 'bg-green-500' : 'bg-gray-300' }} flex items-center justify-center">
                <i class="fas fa-flag-checkered text-white text-xs"></i>
              </div>
              <div class="ml-4 flex-1">
                <p class="text-sm font-medium text-gray-900">Selesai</p>
                <p class="text-xs text-gray-500">Laporan selesai</p>
              </div>
              <div class="w-2 h-2 rounded-full {{ $laporan->status == 'selesai' ? 'bg-green-500' : 'bg-gray-300' }}"></div>
            </div>
          </div>
        </div>
      </div>

      <!-- Technical Information -->
      <div class="bg-white shadow-lg rounded-xl overflow-hidden border border-gray-100">
        <div class="px-6 py-4 bg-gradient-to-r from-gray-600 to-gray-800">
          <h3 class="text-lg font-medium text-white flex items-center">
            <i class="fas fa-info-circle mr-2"></i> Informasi Teknis
          </h3>
        </div>
        <div class="p-6">
          <div class="space-y-3 text-sm">
            <div class="flex justify-between items-center py-2 border-b border-gray-100">
              <span class="text-gray-500 font-medium">ID Laporan:</span>
              <span class="font-mono text-gray-900 bg-gray-50 px-2 py-1 rounded">#{{ $laporan->id }}</span>
            </div>
            <div class="flex justify-between items-center py-2 border-b border-gray-100">
              <span class="text-gray-500 font-medium">Dibuat:</span>
              <span class="text-gray-900">{{ $laporan->created_at->format('d/m/Y H:i') }}</span>
            </div>
            <div class="flex justify-between items-center py-2 border-b border-gray-100">
              <span class="text-gray-500 font-medium">Diupdate:</span>
              <span class="text-gray-900">{{ $laporan->updated_at->format('d/m/Y H:i') }}</span>
            </div>
            <div class="flex justify-between items-center py-2">
              <span class="text-gray-500 font-medium">User ID:</span>
              <span class="font-mono text-gray-900 bg-gray-50 px-2 py-1 rounded">{{ $laporan->user_id }}</span>
            </div>
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
