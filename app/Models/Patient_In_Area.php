<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Area;

class Patient_In_Area extends Model
{
    use HasFactory;
    
    protected $table='patients_in_area';

    /*public function diagnosisAreas(){
        return $this->belongsToMany(MedicalHistory::class, 'diagnosis','id_patienArea','id_history')
        ->withPivot(['id','diagnosi','treatment','date'])
        ->withTimestamps();
    }
    public function areas(){
        return $this->belongsTo(Area::class,'id_area','id');
    }*/
    protected $guarded=[];
}
