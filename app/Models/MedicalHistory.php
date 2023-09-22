<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalHistory extends Model
{
    use HasFactory;
    protected $table='medical_history';

    public function patients(){
        return $this->belongsTo(Patient::class,'id_patient','id');
    }
    public function diagnosisAreas(){
        return $this->belongsToMany(Area::class, 'diagnosis','id_history','id_patienArea')
            ->withPivot(['id','diagnosi','treatment','date'])
            ->withTimestamps();
    }

    protected $guarded=[];
}
