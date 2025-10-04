<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Quiz extends Model
{
    protected $fillable = [
        'title',
        'description',
        'duration',
        'is_active'
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function results()
    {
        return $this->hasMany(QuizResult::class);
    }

    public function userResults()
    {
        return $this->hasMany(QuizResult::class)->where('user_id', Auth::id());
    }
}
