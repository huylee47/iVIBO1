<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Status extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table ='status';
    protected $fillable = ['status_name'];
    public function projects(){
        return $this->hasMany(Project::class);
    }
    public function tasks(){
        return $this->hasMany(Task::class);
    }
    public function users(){
        return $this->hasMany(User::class);
    }
    public function leave_request(){
        return $this->hasMany(Leave_Request::class);
    }
    public function assignment_request(){
        return $this->hasMany(Assignment_Request::class);
    }
}
