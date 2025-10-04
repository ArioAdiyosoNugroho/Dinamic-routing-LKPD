@extends('layout')

@section('title', 'Detail Laporan - LKPD App')

@section('content')
<div class="max-w-4xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
  <!-- Header Section -->
  <div class="mb-8">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
      <div class="flex-1 min-w-0">
        <h1 class="text-3xl font-bold text-gray-800 flex items-center">
          <i class="fas fa-file-alt text-indigo-600 mr-3"></i>
          Detail Laporan
        </h1>
        <p class="mt-2 text-sm text-gray-600">
          Informasi lengkap laporan praktikum jaringan
        </p>
      </div>
      <div class="mt-4 flex md:mt-0 md:ml-4 space-x-3">
        <a href="{{ route('admin.laporan.index') }}"
           class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition duration-300 flex items-center">
          <i class="fas fa-arrow-left mr-2"></i> Kembali
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

  <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Main Information -->
    <div class="lg:col-span-2 space-y-6">
      <!-- Laporan Card -->
      <div class="bg-white shadow rounded-xl overflow-hidden">
        <div class="px-6 py-4 bg-gradient-to-r from-indigo-500 to-purple-600">
          <h3 class="text-lg font-medium text-white">Informasi Laporan</h3>
        </div>
        <div class="p-6">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <label class="block text-sm font-medium text-gray-500 mb-1">Nama Siswa</label>
              <p class="text-lg font-semibold text-gray-900">{{ $laporan->nama }}</p>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-500 mb-1">Kelas</label>
              <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                {{ $laporan->kelas }}
              </span>
            </div>
            <div class="md:col-span-2">
              <label class="block text-sm font-medium text-gray-500 mb-1">Status</label>
              <div class="flex items-center space-x-4">
                <span class="px-3 py-1 rounded-full text-sm font-semibold
                  @if($laporan->status == 'selesai') bg-green-100 text-green-800
                  @elseif($laporan->status == 'proses') bg-yellow-100 text-yellow-800
                  @else bg-gray-100 text-gray-800 @endif">
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
                          class="text-sm border rounded-lg px-3 py-1 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-200
                                @if($laporan->status == 'selesai') bg-green-100 text-green-800 border-green-300
                                @elseif($laporan->status == 'proses') bg-yellow-100 text-yellow-800 border-yellow-300
                                @else bg-gray-100 text-gray-800 border-gray-300 @endif">
                    <option value="draft" {{ $laporan->status == 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="proses" {{ $laporan->status == 'proses' ? 'selected' : '' }}>Proses</option>
                    <option value="selesai" {{ $laporan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                  </select>
                  <button type="submit"
                          class="px-3 py-1 bg-indigo-600 text-white rounded-lg text-sm hover:bg-indigo-700 transition duration-200">
                    <i class="fas fa-save"></i>
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Alamat IP Card -->
      <div class="bg-white shadow rounded-xl overflow-hidden">
        <div class="px-6 py-4 bg-gradient-to-r from-blue-500 to-cyan-600">
          <h3 class="text-lg font-medium text-white">Konfigurasi Jaringan</h3>
        </div>
        <div class="p-6">
          <div class="space-y-4">
            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
              <div class="flex items-center">
                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                  <i class="fas fa-desktop text-blue-600"></i>
                </div>
                <div>
                  <p class="text-sm font-medium text-gray-500">PC 1</p>
                  <p class="text-lg font-mono text-gray-900">{{ $laporan->ip_pc1 ?? 'Belum diatur' }}</p>
                </div>
              </div>
              <span class="px-2 py-1 text-xs font-medium rounded-full
                {{ $laporan->ip_pc1 ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                {{ $laporan->ip_pc1 ? 'Terkonfigurasi' : 'Belum' }}
              </span>
            </div>

            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
              <div class="flex items-center">
                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                  <i class="fas fa-desktop text-blue-600"></i>
                </div>
                <div>
                  <p class="text-sm font-medium text-gray-500">PC 2</p>
                  <p class="text-lg font-mono text-gray-900">{{ $laporan->ip_pc2 ?? 'Belum diatur' }}</p>
                </div>
              </div>
              <span class="px-2 py-1 text-xs font-medium rounded-full
                {{ $laporan->ip_pc2 ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                {{ $laporan->ip_pc2 ? 'Terkonfigurasi' : 'Belum' }}
              </span>
            </div>

            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
              <div class="flex items-center">
                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                  <i class="fas fa-desktop text-blue-600"></i>
                </div>
                <div>
                  <p class="text-sm font-medium text-gray-500">PC 3</p>
                  <p class="text-lg font-mono text-gray-900">{{ $laporan->ip_pc3 ?? 'Belum diatur' }}</p>
                </div>
              </div>
              <span class="px-2 py-1 text-xs font-medium rounded-full
                {{ $laporan->ip_pc3 ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                {{ $laporan->ip_pc3 ? 'Terkonfigurasi' : 'Belum' }}
              </span>
            </div>
          </div>
        </div>
      </div>

      <!-- Catatan Card -->
      <div class="bg-white shadow rounded-xl overflow-hidden">
        <div class="px-6 py-4 bg-gradient-to-r from-purple-500 to-pink-600">
          <h3 class="text-lg font-medium text-white">Catatan & Observasi</h3>
        </div>
        <div class="p-6">
          @if($laporan->catatan)
            <div class="prose max-w-none">
              <p class="text-gray-700 whitespace-pre-line">{{ $laporan->catatan }}</p>
            </div>
          @else
            <div class="text-center py-8">
              <i class="fas fa-sticky-note text-4xl text-gray-300 mb-4"></i>
              <p class="text-gray-500">Tidak ada catatan</p>
            </div>
          @endif
        </div>
      </div>
    </div>

    <!-- Sidebar Information -->
    <div class="space-y-6">
      <!-- Informasi Pembuat -->
      <div class="bg-white shadow rounded-xl overflow-hidden">
        <div class="px-6 py-4 bg-gradient-to-r from-green-500 to-emerald-600">
          <h3 class="text-lg font-medium text-white">Informasi Pembuat</h3>
        </div>
        <div class="p-6">
          <div class="text-center">
            <div class="mx-auto w-16 h-16 bg-gradient-to-r from-green-400 to-blue-500 rounded-full flex items-center justify-center mb-4">
              <span class="text-white font-bold text-xl">
                {{ strtoupper(substr($laporan->user->name ?? 'U', 0, 1)) }}
              </span>
            </div>
            <h4 class="text-lg font-semibold text-gray-900">{{ $laporan->nama ?? 'User' }}</h4>
            <p class="text-sm text-gray-500 mb-4">{{ $laporan->nis ?? '-' }}</p>
            <div class="flex items-center justify-center text-sm text-gray-500">
              <i class="fas fa-calendar-alt mr-2"></i>
              <span>Dibuat: {{ $laporan->created_at->format('d M Y') }}</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Status Progress -->
      <div class="bg-white shadow rounded-xl overflow-hidden">
        <div class="px-6 py-4 bg-gradient-to-r from-orange-500 to-amber-600">
          <h3 class="text-lg font-medium text-white">Progress Laporan</h3>
        </div>
        <div class="p-6">
          <div class="space-y-4">
            <div class="flex items-center justify-between">
              <span class="text-sm font-medium text-gray-700">Draft</span>
              <div class="w-16 h-2 bg-gray-200 rounded-full">
                <div class="h-2 rounded-full {{ $laporan->status != 'draft' ? 'bg-green-500' : 'bg-gray-400' }}"></div>
              </div>
            </div>
            <div class="flex items-center justify-between">
              <span class="text-sm font-medium text-gray-700">Proses</span>
              <div class="w-16 h-2 bg-gray-200 rounded-full">
                <div class="h-2 rounded-full {{ $laporan->status == 'proses' || $laporan->status == 'selesai' ? 'bg-yellow-500' : 'bg-gray-400' }}"></div>
              </div>
            </div>
            <div class="flex items-center justify-between">
              <span class="text-sm font-medium text-gray-700">Selesai</span>
              <div class="w-16 h-2 bg-gray-200 rounded-full">
                <div class="h-2 rounded-full {{ $laporan->status == 'selesai' ? 'bg-green-500' : 'bg-gray-400' }}"></div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Informasi Teknis -->
      <div class="bg-white shadow rounded-xl overflow-hidden">
        <div class="px-6 py-4 bg-gradient-to-r from-gray-600 to-gray-800">
          <h3 class="text-lg font-medium text-white">Informasi Teknis</h3>
        </div>
        <div class="p-6">
          <div class="space-y-3 text-sm">
            <div class="flex justify-between">
              <span class="text-gray-500">ID Laporan:</span>
              <span class="font-mono text-gray-900">#{{ $laporan->id }}</span>
            </div>
            <div class="flex justify-between">
              <span class="text-gray-500">Dibuat:</span>
              <span class="text-gray-900">{{ $laporan->created_at->format('d/m/Y H:i') }}</span>
            </div>
            <div class="flex justify-between">
              <span class="text-gray-500">Diupdate:</span>
              <span class="text-gray-900">{{ $laporan->updated_at->format('d/m/Y H:i') }}</span>
            </div>
            <div class="flex justify-between">
              <span class="text-gray-500">User ID:</span>
              <span class="font-mono text-gray-900">{{ $laporan->user_id }}</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Quick Actions -->
      <div class="bg-white shadow rounded-xl overflow-hidden">
        <div class="px-6 py-4 bg-gradient-to-r from-indigo-600 to-purple-700">
          <h3 class="text-lg font-medium text-white">Aksi Cepat</h3>
        </div>
        <div class="p-6">
          <div class="space-y-3">
            <a href="{{ route('admin.laporan.index') }}"
               class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition duration-200">
              <i class="fas fa-list mr-2"></i> Semua Laporan
            </a>
            <form action="{{ route('admin.laporan.destroy', $laporan->id) }}" method="POST"
                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus laporan ini?')">
              @csrf
              @method('DELETE')
              <button type="submit"
                      class="w-full flex items-center justify-center px-4 py-2 bg-red-600 text-white rounded-lg text-sm font-medium hover:bg-red-700 transition duration-200">
                <i class="fas fa-trash-alt mr-2"></i> Hapus Laporan
              </button>
            </form>
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
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
  }
</style>
@endsection
