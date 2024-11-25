<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    //
    use HasFactory;
    use SoftDeletes;

    protected $table = 'projects';
    protected $fillable = ['project_name','status_id'];
    public function tasks(){
        return $this->hasMany(Task::class);
    }
    public function status(){
        return $this->belongsTo(Status::class);
    }
}
