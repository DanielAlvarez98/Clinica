<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{Employee,Patient};

class Area extends Model
{
    use HasFactory;
    protected $table='areas';

    public function employeeAreas()
    {
        return $this->belongsToMany(Employee::class,'employee_in_area','id_area','id_employee')
        ->withPivot(['id','status'])
        ->withTimestamps();
    }
    public function patientsAreas()
    {
        return $this->belongsToMany(Patient::class,'patients_in_area','id_area','id_patient')
                    ->withPivot(['id','status'])
                    ->withTimestamps();
    }
    public function diagnosisAreas(){
        return $this->belongsToMany(MedicalHistory::class, 'diagnosis','id_patienArea','id_history')
        ->withPivot(['id','diagnosi','treatment','date'])
        ->withTimestamps();
    }
    protected $guarded=[];

}
