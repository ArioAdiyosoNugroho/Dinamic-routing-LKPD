<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reflection extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'content',
        'mood',
        'lesson_learned',
        'improvement_plan'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scope untuk admin melihat semua
    public function scopeWithUser($query)
    {
        return $query->with('user');
    }

    // Scope untuk user melihat miliknya sendiri
    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}
