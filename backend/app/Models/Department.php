<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Symfony\Component\Routing\Loader\Configurator\Traits\AddTrait;

class Department extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'departments';
    protected $fillable = ['department_name','company_id','parent_id'];
    public function user(){
        return $this->hasMany(User::class); 
    }
    public function company(){
        return $this->belongsTo(Company::class,'id');
    }
    public function parent(){
        return $this->belongsTo(Department::class,'parent_id');
    }
    public function children(){
        return $this->hasMany(Department::class,'parent_id');
    }
}
