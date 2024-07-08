<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaveResponse extends Model
{
    use HasFactory;
    protected $fillable = ['job_detail_id','job_form_id','form_id','section_id','question_id','question_type','answer','option'];

    public function form()
    {
        return $this->belongsTo(Form::class,'job_form_id');
    }

}
