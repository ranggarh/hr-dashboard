<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'type',
        'duration',
        'questions_count',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'duration' => 'integer',
        'questions_count' => 'integer'
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}