<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizResult extends Model
{
    protected $fillable = [
        'quiz_id',
        'user_id',
        'score',
        'total_questions',
        'answers'
    ];

    protected $casts = [
        'answers' => 'array'
    ];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getTotalQuestionsAttribute($value)
    {
        if ($value === null && $this->quiz) {
            return $this->quiz->questions->count();
        }
        return $value;
    }
}
