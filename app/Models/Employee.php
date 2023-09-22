<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{User,Area,Role};


class Employee extends Model
{
    use HasFactory;
    protected $table='employees';
    public function employeeAreas()
    {
        return $this->belongsToMany(Area::class, 'employee_in_area', 'id_employee', 'id_area')
        ->withPivot(['id','status'])
        ->withTimestamps();
    }
    public function roles(){
        return $this->belongsTo(Role::class,'id_rol','id');
    }
    public function user(){
        return $this->hasMany(User::class,'id_employee','id');
    }

    protected $guarded=[];

}
