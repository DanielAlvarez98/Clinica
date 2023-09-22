<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnosis extends Model
{
    use HasFactory;
    protected $table='diagnosis';
/*    public function medicalHistorys(){
        return $this->belongsTo(MedicalHistory::class,'id_history','id');
    }
    public function patientAreas(){
        return $this->belongsTo(Patient_In_Area::class,'id_patienArea','id');
    }*/
    protected $guarded=[];
}
