<?php
// app/Models/Laporan.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'kelas',
        'ip_pc1',
        'ip_pc2',
        'ip_pc3',
        'catatan',
        'status',
        'user_id'
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scope untuk laporan milik user tertentu
    public function scopeUserLaporan($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}
