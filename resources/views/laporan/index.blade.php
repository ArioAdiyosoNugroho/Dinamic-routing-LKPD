@extends('layout')

@section('title', 'Kelola Laporan - LKPD App')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
  <!-- Header Section -->
  <div class="mb-8">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
      <div class="flex-1 min-w-0">
        <h1 class="text-3xl font-bold text-gray-800 flex items-center">
          <i class="fas fa-file-alt text-indigo-600 mr-3"></i>
          @if(Auth::user()->role == 'admin')
            Semua Laporan
          @else
            Laporan Saya
          @endif
        </h1>
        <p class="mt-2 text-sm text-gray-600">
          @if(Auth::user()->role == 'admin')
            Kelola semua laporan praktikum jaringan dari semua siswa
          @else
            Kelola laporan praktikum jaringan Anda
          @endif
        </p>
      </div>
      <div class="mt-4 flex md:mt-0 md:ml-4">
        <a href="{{ route('laporan.create') }}"
           class="gradient-bg text-white px-6 py-3 rounded-lg font-medium hover:opacity-90 transition duration-300 flex items-center shadow-lg">
          <i class="fas fa-plus-circle mr-2"></i> Tambah Laporan
        </a>
      </div>
    </div>
  </div>

  <!-- Stats Cards -->
  <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4 mb-8">
    <div class="bg-white overflow-hidden shadow rounded-lg card-hover">
      <div class="px-4 py-5 sm:p-6">
        <div class="flex items-center">
          <div class="flex-shrink-0 bg-blue-100 rounded-md p-3">
            <i class="fas fa-file-alt text-blue-600 text-xl"></i>
          </div>
          <div class="ml-5 w-0 flex-1">
            <dl>
              <dt class="text-sm font-medium text-gray-500 truncate">
                @if(Auth::user()->role == 'admin')
                  Total Laporan
                @else
                  Laporan Saya
                @endif
              </dt>
              <dd class="text-lg font-semibold text-gray-900">{{ $laporans->count() }}</dd>
            </dl>
          </div>
        </div>
      </div>
    </div>

    <div class="bg-white overflow-hidden shadow rounded-lg card-hover">
      <div class="px-4 py-5 sm:p-6">
        <div class="flex items-center">
          <div class="flex-shrink-0 bg-green-100 rounded-md p-3">
            <i class="fas fa-check-circle text-green-600 text-xl"></i>
          </div>
          <div class="ml-5 w-0 flex-1">
            <dl>
              <dt class="text-sm font-medium text-gray-500 truncate">Selesai</dt>
              <dd class="text-lg font-semibold text-gray-900">{{ $laporans->where('status', 'selesai')->count() }}</dd>
            </dl>
          </div>
        </div>
      </div>
    </div>

    <div class="bg-white overflow-hidden shadow rounded-lg card-hover">
      <div class="px-4 py-5 sm:p-6">
        <div class="flex items-center">
          <div class="flex-shrink-0 bg-yellow-100 rounded-md p-3">
            <i class="fas fa-clock text-yellow-600 text-xl"></i>
          </div>
          <div class="ml-5 w-0 flex-1">
            <dl>
              <dt class="text-sm font-medium text-gray-500 truncate">Dalam Proses</dt>
              <dd class="text-lg font-semibold text-gray-900">{{ $laporans->where('status', 'proses')->count() }}</dd>
            </dl>
          </div>
        </div>
      </div>
    </div>

    <div class="bg-white overflow-hidden shadow rounded-lg card-hover">
      <div class="px-4 py-5 sm:p-6">
        <div class="flex items-center">
          <div class="flex-shrink-0 bg-purple-100 rounded-md p-3">
            <i class="fas fa-user-graduate text-purple-600 text-xl"></i>
          </div>
          <div class="ml-5 w-0 flex-1">
            <dl>
              <dt class="text-sm font-medium text-gray-500 truncate">
                @if(Auth::user()->role == 'admin')
                  Total Siswa
                @else
                  Kelas Saya
                @endif
              </dt>
              <dd class="text-lg font-semibold text-gray-900">
                @if(Auth::user()->role == 'admin')
                  {{ $laporans->pluck('user_id')->unique()->count() }}
                @else
                  {{ $laporans->first()->kelas ?? '-' }}
                @endif
              </dd>
            </dl>
          </div>
        </div>
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

  <!-- Table Section -->
  <div class="bg-white shadow overflow-hidden rounded-xl">
    <div class="px-4 py-5 sm:px-6 bg-gradient-to-r from-indigo-500 to-purple-600">
      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div>
          <h3 class="text-lg font-medium text-white">
            @if(Auth::user()->role == 'admin')
              Semua Laporan Siswa
            @else
              Laporan Praktikum Saya
            @endif
          </h3>
          <p class="mt-1 text-sm text-indigo-100">
            @if(Auth::user()->role == 'admin')
              Daftar lengkap laporan praktikum dari semua siswa
            @else
              Daftar laporan praktikum jaringan komputer Anda
            @endif
          </p>
        </div>
        <div class="mt-3 sm:mt-0">
          <div class="relative">
            <input type="text" placeholder="Cari laporan..."
                   class="bg-white/20 text-white placeholder-white/70 px-4 py-2 rounded-full text-sm focus:outline-none focus:ring-2 focus:ring-white/50 transition duration-300 w-48">
            <i class="fas fa-search absolute right-3 top-1/2 transform -translate-y-1/2 text-white/70"></i>
          </div>
        </div>
      </div>
    </div>

    <div class="overflow-x-auto">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              No
            </th>
            @if(Auth::user()->role == 'admin')
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              Pembuat
            </th>
            @endif
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
          @forelse($laporans as $i => $laporan)
            <tr class="table-row-hover">
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                {{ $i + 1 }}
              </td>

              @if(Auth::user()->role == 'admin')
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                  <div class="flex-shrink-0 h-8 w-8 bg-gradient-to-r from-green-400 to-blue-500 rounded-full flex items-center justify-center">
                    <span class="text-white font-medium text-xs">{{ strtoupper(substr($laporan->user->name ?? 'U', 0, 1)) }}</span>
                  </div>
                  <div class="ml-4">
                    <div class="text-sm font-medium text-gray-900">{{ $laporan->user->name ?? 'User' }}</div>
                    <div class="text-sm text-gray-500">{{ $laporan->user->email ?? '-' }}</div>
                  </div>
                </div>
              </td>
              @endif

              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                  <div class="flex-shrink-0 h-8 w-8 bg-gradient-to-r from-indigo-400 to-purple-500 rounded-full flex items-center justify-center">
                    <span class="text-white font-medium text-xs">{{ strtoupper(substr($laporan->nama, 0, 1)) }}</span>
                  </div>
                  <div class="ml-4">
                    <div class="text-sm font-medium text-gray-900">{{ $laporan->nama }}</div>
                    <div class="text-sm text-gray-500">
                      @if(Auth::user()->role != 'admin')
                        {{ Auth::user()->name }}
                      @endif
                    </div>
                  </div>
                </div>
              </td>

              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-medium">
                  {{ $laporan->kelas }}
                </span>
              </td>

              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900 space-y-1">
                  <div class="flex items-center">
                    <i class="fas fa-desktop text-gray-400 mr-2 text-xs"></i>
                    <span class="font-mono text-xs">{{ $laporan->ip_pc1 ?? '-' }}</span>
                  </div>
                  <div class="flex items-center">
                    <i class="fas fa-desktop text-gray-400 mr-2 text-xs"></i>
                    <span class="font-mono text-xs">{{ $laporan->ip_pc2 ?? '-' }}</span>
                  </div>
                  <div class="flex items-center">
                    <i class="fas fa-desktop text-gray-400 mr-2 text-xs"></i>
                    <span class="font-mono text-xs">{{ $laporan->ip_pc3 ?? '-' }}</span>
                  </div>
                </div>
              </td>

              <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                  @if($laporan->status == 'selesai') bg-green-100 text-green-800
                  @elseif($laporan->status == 'proses') bg-yellow-100 text-yellow-800
                  @else bg-gray-100 text-gray-800 @endif">
                  @if($laporan->status == 'selesai')
                    <i class="fas fa-check-circle mr-1"></i> Selesai
                  @elseif($laporan->status == 'proses')
                    <i class="fas fa-clock mr-1"></i> Proses
                  @else
                    <i class="fas fa-edit mr-1"></i> Draft
                  @endif
                </span>
              </td>

              <td class="px-6 py-4 text-sm text-gray-500 max-w-xs">
                <div class="truncate">
                  {{ $laporan->catatan ? Str::limit($laporan->catatan, 60, '...') : 'Tidak ada catatan' }}
                </div>
              </td>

              <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                <div class="flex justify-end space-x-2">
                  <a href="{{ route('laporan.show', $laporan->id) }}"
                     class="text-indigo-600 hover:text-indigo-900 transition duration-200 p-2 rounded-lg hover:bg-indigo-50"
                     title="Lihat Detail">
                    <i class="fas fa-eye"></i>
                  </a>

                  {{-- Tombol Edit: Admin bisa edit semua, User hanya edit milik sendiri --}}
                  @if(Auth::user()->role == 'admin' || $laporan->user_id == Auth::id())
                  <a href="{{ route('laporan.edit', $laporan->id) }}"
                     class="text-yellow-600 hover:text-yellow-900 transition duration-200 p-2 rounded-lg hover:bg-yellow-50"
                     title="Edit">
                    <i class="fas fa-edit"></i>
                  </a>
                  @endif

                  {{-- Tombol Hapus: Admin bisa hapus semua, User hanya hapus milik sendiri --}}
                  @if(Auth::user()->role == 'admin' || $laporan->user_id == Auth::id())
                  <form action="{{ route('laporan.destroy', $laporan->id) }}" method="POST"
                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus laporan ini?')" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="text-red-600 hover:text-red-900 transition duration-200 p-2 rounded-lg hover:bg-red-50"
                            title="Hapus">
                      <i class="fas fa-trash-alt"></i>
                    </button>
                  </form>
                  @endif
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="{{ Auth::user()->role == 'admin' ? 8 : 7 }}" class="px-6 py-12 text-center">
                <div class="flex flex-col items-center justify-center text-gray-500">
                  <i class="fas fa-file-alt text-4xl mb-4 text-gray-300"></i>
                  <p class="text-lg font-medium text-gray-900">Belum ada laporan</p>
                  <p class="text-gray-500 mt-2">Mulai dengan membuat laporan pertama Anda</p>
                  <a href="{{ route('laporan.create') }}"
                     class="mt-4 gradient-bg text-white px-6 py-2 rounded-lg font-medium hover:opacity-90 transition duration-300 inline-flex items-center">
                    <i class="fas fa-plus-circle mr-2"></i> Buat Laporan Pertama
                  </a>
                </div>
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    @if($laporans->hasPages())
      <div class="px-6 py-4 border-t border-gray-200">
        <div class="flex items-center justify-between">
          <div class="text-sm text-gray-700">
            Menampilkan {{ $laporans->firstItem() }} - {{ $laporans->lastItem() }} dari {{ $laporans->total() }} laporan
          </div>
          <div class="flex space-x-2">
            @if($laporans->onFirstPage())
              <span class="px-3 py-1 bg-gray-100 text-gray-400 rounded-lg cursor-not-allowed">
                <i class="fas fa-chevron-left"></i>
              </span>
            @else
              <a href="{{ $laporans->previousPageUrl() }}" class="px-3 py-1 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition duration-200">
                <i class="fas fa-chevron-left"></i>
              </a>
            @endif

            @if($laporans->hasMorePages())
              <a href="{{ $laporans->nextPageUrl() }}" class="px-3 py-1 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition duration-200">
                <i class="fas fa-chevron-right"></i>
              </a>
            @else
              <span class="px-3 py-1 bg-gray-100 text-gray-400 rounded-lg cursor-not-allowed">
                <i class="fas fa-chevron-right"></i>
              </span>
            @endif
          </div>
        </div>
      </div>
    @endif
  </div>
</div>

<style>
  .table-row-hover:hover {
    background-color: #f8fafc;
  }

  .card-hover {
    transition: all 0.3s ease;
  }

  .card-hover:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
  }
</style>
@endsection
