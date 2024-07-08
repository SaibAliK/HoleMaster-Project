<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $fillable = [
        'question',
        'type',
        'precaution',
        'section_id',
        'is_required'
    ];

    public function options()
    {
        return $this->hasMany(QuestionOption::class,'question_id');
    }
}
