<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee_in_Area extends Model
{
    use HasFactory;
    protected $table='employee_in_area';
    public function schedules(){
        return $this->belongsToMany(Weekday::class,'schedules','id_employeeArea','id_day')
        ->withPivot(['id','start_time','end_time'])->withTimestamps();
    } 
    public function employees(){
        return $this->belongsTo(Employee::class,'id_employee','id');
    }
    public function areas(){
        return $this->belongsTo(Area::class,'id_area','id');
    }

    protected $guarded=[];
}
