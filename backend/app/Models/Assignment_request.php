<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Assignment_request extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table = "assignment_requests";
    protected $fillable = ['user_request_id','user_access_id','status_id','location_assignment','reason','start_time','end_time',];
    public function status(){
        return $this->belongsTo(Status::class,'status_id');
    }
    public function user_request() {
        return $this->belongsTo(User::class,'user_request_id','user_access_id');
    }
}
