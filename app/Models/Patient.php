<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $table='patients';

    public function historys(){
        return $this->hasMany(MedicalHistory::class,'id_patient','id');
    }
    public function patientsAreas(){
        return $this->belongsToMany(Area::class,'patients_in_area','id_patient','id_area')
        ->withPivot(['id','status'])->withTimestamps();
    }
    public function invoices(){
        return $this->hasMany(Invoice::class,'id_patient','id');
    }
    public function quotes(){
        return $this->belongsToMany(Schedule::class,'quotes','id_patient','id_schedule')
        ->withPivot(['id','start_time','end_time','description','status'])
        ->withTimestamps();
    }
    protected $guarded=[];
}
