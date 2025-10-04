<?php
// app/Http/Controllers/AdminLaporanController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;

class AdminLaporanController extends Controller
{
    public function index()
    {
        // Ganti get() dengan paginate()
        $laporans = Laporan::with('user')->latest()->paginate(10); // 10 item per halaman

        return view('laporan.admin-index', compact('laporans'));
    }

    public function show($id)
    {
        $laporan = Laporan::with('user')->findOrFail($id);
        return view('laporan.admin-show', compact('laporan'));
    }

    public function updateStatus(Request $request, $id)
    {
        $laporan = Laporan::findOrFail($id);

        $request->validate([
            'status' => 'required|in:draft,proses,selesai'
        ]);

        $laporan->update([
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', 'Status laporan berhasil diperbarui');
    }

    public function destroy($id)
    {
        $laporan = Laporan::findOrFail($id);
        $laporan->delete();

        return redirect()->route('admin.laporan.index')->with('success', 'Laporan berhasil dihapus');
    }
}
