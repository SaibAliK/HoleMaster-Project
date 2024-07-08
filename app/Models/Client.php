<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function jobDetail(){
        return $this->hasOne(JobDetail::class,'operative_id','id');
    }

    public function sites(){
        return $this->hasMany(Site::class,'client_id');
    }
    
    public function users(){
        return $this->belongsTo(User::class,'parent_id')->withTrashed();
    }
}
