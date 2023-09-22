<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $table='schedules';
    public function quotes(){
        return $this->belongsToMany(Patient::class,'quotes','id_schedule','id_patient')
        ->withPivot(['id','start_time','end_time','description','status'])
        ->withTimestamps();
    }
    public function weekdays(){
        return $this->belongsTo(Weekday::class,'id_day','id');
    }
    public function employeeInAreas(){
        return $this->belongsTo(Employee_in_Area::class,'id_employeeArea','id');
    }

    protected $guarded=[];

}
