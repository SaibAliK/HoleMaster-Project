<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobDetail extends Model
{
    use HasFactory;

    protected $fillable = ['client_id', 'operative_id', 'visit_date', 'user_id', 'parent_id'];

    public function userClient()
    {
        return $this->belongsTo(Client::class, 'client_id')->withTrashed();
    }
    public function userOperative()
    {
        return $this->belongsTo(User::class, 'operative_id', 'id')->with(['operative']);
    }
    
    public function forms()
    {
        return $this->hasMany(Form::class, 'job_detail_id', 'id')->with(['sections']);
    }

    public function jobDetailForms()
    {
        return $this->hasMany(JobDetailForm::class, 'job_detail_id')->with('forms');
    }
    public function jobSite()
    {
        return $this->belongsTo(Site::class, 'site_id')->withTrashed();;
    }
    public function users(){
        return $this->belongsTo(User::class,'parent_id')->withTrashed();
    }
}
