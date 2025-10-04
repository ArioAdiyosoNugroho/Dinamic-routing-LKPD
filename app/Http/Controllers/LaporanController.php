<?php
// app/Http/Controllers/LaporanController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    public function index()
    {
        $laporans = Laporan::where('user_id', Auth::id())->latest()->get();
        return view('laporan.user-index', compact('laporans'));
    }

    public function create()
    {
        return view('laporan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'   => 'required|string|max:100',
            'kelas'  => 'required|string|max:20',
            'ip_pc1' => 'nullable|ip',
            'ip_pc2' => 'nullable|ip',
            'ip_pc3' => 'nullable|ip',
            'catatan'=> 'nullable|string',
        ]);

        Laporan::create([
            'nama' => $request->nama,
            'kelas' => $request->kelas,
            'ip_pc1' => $request->ip_pc1,
            'ip_pc2' => $request->ip_pc2,
            'ip_pc3' => $request->ip_pc3,
            'catatan' => $request->catatan,
            'status' => 'draft',
            'user_id' => Auth::id()
        ]);

        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil disimpan');
    }

    public function show($id)
    {
        $laporan = Laporan::where('user_id', Auth::id())->findOrFail($id);
        return view('laporan.user-show', compact('laporan'));
    }

    public function edit($id)
    {
        $laporan = Laporan::where('user_id', Auth::id())->findOrFail($id);

        if (in_array($laporan->status, ['proses', 'selesai'])) {
            return redirect()->route('laporan.index')->with('error', 'Laporan tidak dapat diedit karena status sudah ' . $laporan->status);
        }

        return view('laporan.edit', compact('laporan'));
    }

    public function update(Request $request, $id)
    {
        $laporan = Laporan::where('user_id', Auth::id())->findOrFail($id);

        if (in_array($laporan->status, ['proses', 'selesai'])) {
            return redirect()->route('laporan.index')->with('error', 'Laporan tidak dapat diupdate karena status sudah ' . $laporan->status);
        }

        $request->validate([
            'nama'   => 'required|string|max:100',
            'kelas'  => 'required|string|max:20',
            'ip_pc1' => 'nullable|ip',
            'ip_pc2' => 'nullable|ip',
            'ip_pc3' => 'nullable|ip',
            'catatan'=> 'nullable|string',
            'status' => 'nullable|in:draft,proses,selesai'
        ]);

        $laporan->update($request->all());

        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil diperbarui');
    }

    public function destroy($id)
    {
        $laporan = Laporan::where('user_id', Auth::id())->findOrFail($id);

        if (in_array($laporan->status, ['proses', 'selesai'])) {
            return redirect()->route('laporan.index')->with('error', 'Laporan tidak dapat dihapus karena status sudah ' . $laporan->status);
        }

        $laporan->delete();

        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil dihapus');
    }
}
