<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;
    protected $fillable = [
        'section_name',
        'form_id'
    ];

    public function questions(){
        return $this->hasMany(Question::class)->with(['options:id,question_option,question_id']);
    }
}
