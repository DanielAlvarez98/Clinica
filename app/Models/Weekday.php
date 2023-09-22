<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee_in_Area;

class Weekday extends Model
{
    use HasFactory;
    protected $table='weekdays';

    public function schedules(){
        return $this->belongsToMany(Employee_in_Area::class,'schedules','id_day','id_employeeArea')
        ->withPivot(['id','start_time','end_time'])->withTimestamps();
    }
    protected $guarded=[];

}
