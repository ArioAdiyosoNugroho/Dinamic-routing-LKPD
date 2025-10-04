@extends('layout')

@section('content')
<div class="max-w-3xl mx-auto bg-white shadow-md rounded-lg p-6 mt-10">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">✏ Edit Laporan</h2>

    {{-- Error Validation --}}
    @if ($errors->any())
        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('laporan.update', $laporan->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-medium text-gray-700">Nama</label>
            <input type="text" name="nama" value="{{ old('nama', $laporan->nama) }}"
                   class="w-full p-2 border rounded focus:ring focus:ring-blue-300" required>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Kelas</label>
            <input type="text" name="kelas" value="{{ old('kelas', $laporan->kelas) }}"
                   class="w-full p-2 border rounded focus:ring focus:ring-blue-300">
        </div>

        <div class="grid grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">IP PC1</label>
                <input type="text" name="ip_pc1" value="{{ old('ip_pc1', $laporan->ip_pc1) }}"
                       class="w-full p-2 border rounded focus:ring focus:ring-blue-300">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">IP PC2</label>
                <input type="text" name="ip_pc2" value="{{ old('ip_pc2', $laporan->ip_pc2) }}"
                       class="w-full p-2 border rounded focus:ring focus:ring-blue-300">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">IP PC3</label>
                <input type="text" name="ip_pc3" value="{{ old('ip_pc3', $laporan->ip_pc3) }}"
                       class="w-full p-2 border rounded focus:ring focus:ring-blue-300">
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Catatan</label>
            <textarea name="catatan" rows="4"
                      class="w-full p-2 border rounded focus:ring focus:ring-blue-300">{{ old('catatan', $laporan->catatan) }}</textarea>
        </div>

        <div class="flex justify-between mt-6">
            <a href="{{ route('laporan.index') }}"
               class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">⬅ Kembali</a>
            <button type="submit"
                    class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">💾 Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection
