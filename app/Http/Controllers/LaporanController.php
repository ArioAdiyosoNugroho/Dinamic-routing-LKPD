<?php
// app/Http/Controllers/LaporanController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

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
            'ip_pc1' => [
                'nullable',
                function ($attribute, $value, $fail) {
                    if ($value && !$this->isValidIPAddress($value)) {
                        $fail('Format IP address PC1 tidak valid.');
                    }
                }
            ],
            'ip_pc2' => [
                'nullable',
                function ($attribute, $value, $fail) {
                    if ($value && !$this->isValidIPAddress($value)) {
                        $fail('Format IP address PC2 tidak valid.');
                    }
                }
            ],
            'ip_pc3' => [
                'nullable',
                function ($attribute, $value, $fail) {
                    if ($value && !$this->isValidIPAddress($value)) {
                        $fail('Format IP address PC3 tidak valid.');
                    }
                }
            ],
            'catatan'=> 'nullable|string|max:1000',
        ], [
            'nama.required' => 'Nama lengkap harus diisi.',
            'nama.max' => 'Nama tidak boleh lebih dari 100 karakter.',
            'kelas.required' => 'Kelas harus diisi.',
            'kelas.max' => 'Kelas tidak boleh lebih dari 20 karakter.',
            'catatan.max' => 'Catatan tidak boleh lebih dari 1000 karakter.',
        ]);

        Laporan::create([
            'nama' => $request->nama,
            'kelas' => $request->kelas,
            'ip_pc1' => $request->ip_pc1 ? $this->cleanIPAddress($request->ip_pc1) : null,
            'ip_pc2' => $request->ip_pc2 ? $this->cleanIPAddress($request->ip_pc2) : null,
            'ip_pc3' => $request->ip_pc3 ? $this->cleanIPAddress($request->ip_pc3) : null,
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
            'ip_pc1' => [
                'nullable',
                function ($attribute, $value, $fail) {
                    if ($value && !$this->isValidIPAddress($value)) {
                        $fail('Format IP address PC1 tidak valid.');
                    }
                }
            ],
            'ip_pc2' => [
                'nullable',
                function ($attribute, $value, $fail) {
                    if ($value && !$this->isValidIPAddress($value)) {
                        $fail('Format IP address PC2 tidak valid.');
                    }
                }
            ],
            'ip_pc3' => [
                'nullable',
                function ($attribute, $value, $fail) {
                    if ($value && !$this->isValidIPAddress($value)) {
                        $fail('Format IP address PC3 tidak valid.');
                    }
                }
            ],
            'catatan'=> 'nullable|string|max:1000',
            'status' => 'nullable|in:draft,proses,selesai'
        ], [
            'nama.required' => 'Nama lengkap harus diisi.',
            'nama.max' => 'Nama tidak boleh lebih dari 100 karakter.',
            'kelas.required' => 'Kelas harus diisi.',
            'kelas.max' => 'Kelas tidak boleh lebih dari 20 karakter.',
            'catatan.max' => 'Catatan tidak boleh lebih dari 1000 karakter.',
            'status.in' => 'Status tidak valid.',
        ]);

        $laporan->update([
            'nama' => $request->nama,
            'kelas' => $request->kelas,
            'ip_pc1' => $request->ip_pc1 ? $this->cleanIPAddress($request->ip_pc1) : null,
            'ip_pc2' => $request->ip_pc2 ? $this->cleanIPAddress($request->ip_pc2) : null,
            'ip_pc3' => $request->ip_pc3 ? $this->cleanIPAddress($request->ip_pc3) : null,
            'catatan' => $request->catatan,
        ]);

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

    /**
     * Validasi IP Address yang lebih komprehensif
     * Menerima IPv4 dengan format yang umum digunakan
     */
    private function isValidIPAddress($ip)
    {
        // Bersihkan dan trim IP address
        $ip = trim($ip);

        // Cek format IPv4 dasar
        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            return true;
        }

        // Cek format dengan subnet mask (CIDR)
        if (preg_match('/^(\d{1,3}\.){3}\d{1,3}\/\d{1,2}$/', $ip)) {
            $parts = explode('/', $ip);
            if (filter_var($parts[0], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
                $mask = intval($parts[1]);
                return $mask >= 0 && $mask <= 32;
            }
        }

        // Cek format dengan wildcard
        if (preg_match('/^(\d{1,3}|\*)\.(\d{1,3}|\*)\.(\d{1,3}|\*)\.(\d{1,3}|\*)$/', $ip)) {
            return $this->isValidWildcardIP($ip);
        }

        return false;
    }

    /**
     * Validasi IP address dengan wildcard
     */
    private function isValidWildcardIP($ip)
    {
        $parts = explode('.', $ip);

        foreach ($parts as $part) {
            if ($part === '*') continue;

            $num = intval($part);
            if ($num < 0 || $num > 255) {
                return false;
            }
        }

        return true;
    }

    /**
     * Membersihkan dan memformat IP address
     */
    private function cleanIPAddress($ip)
    {
        $ip = trim($ip);

        // Jika IP mengandung wildcard, biarkan seperti itu
        if (strpos($ip, '*') !== false) {
            return $ip;
        }

        // Untuk IP biasa, pastikan formatnya konsisten
        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            return $ip;
        }

        return $ip;
    }

    /**
     * Validasi range IP address (untuk future use)
     */
    private function isValidIPRange($ipRange)
    {
        // Contoh: 192.168.1.1-192.168.1.100
        if (strpos($ipRange, '-') !== false) {
            $parts = explode('-', $ipRange);
            if (count($parts) === 2) {
                return $this->isValidIPAddress(trim($parts[0])) &&
                       $this->isValidIPAddress(trim($parts[1]));
            }
        }

        return false;
    }
}
