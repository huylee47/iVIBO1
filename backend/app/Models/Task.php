<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'tasks';
    protected $fillable = ['task_name', 'status_id','project_id','description','start_time','end_time']; 
    public function project(){
        return $this->belongsTo(Project::class);
    }
    public function user(){
        return $this->belongsTomany(User::class,'task_users', 'task_id', 'user_id');
    }
    public function status(){
        return $this->belongsTo(Status::class);
    }
}
