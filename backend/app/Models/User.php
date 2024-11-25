<?php

namespace App\Models;
use Laravel\Sanctum\HasApiTokens;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable,HasApiTokens;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'avatar',
        'address',
        'phone_number',
        'role_id',
        'status_id',
        'limit_remaining',
        
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function role(){
        return $this->belongsTo(Role::class);
    }
    public function tasks(){
        return $this->belongsToMany(Task::class,'task_user');
    }
    public function status(){   
        return $this->belongsTo(Status::class);
    }
    public function check_log(){
        return $this->hasMany(Check_log::class);
    }
    public function assignment_request(){
        return $this->hasMany(Assignment_request::class);
    }
    public function leave_request(){
        return $this->hasMany(Leave_request::class);
    }
    public function department(){
        return $this->belongsTo(Department::class);
    }
}
