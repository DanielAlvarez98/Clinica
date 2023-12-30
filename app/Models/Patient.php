<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $table = 'patients';
    protected $fillable = [
        'name',
        'lastname',
        'birthday',
        'dni',
        'phone',
        'email',
        'gender',
        'photo'
    ];

    public function historys()
    {
        return $this->hasMany(MedicalHistory::class, 'id_patient', 'id');
    }
    public function patientsAreas()
    {
        return $this->belongsToMany(Area::class, 'patients_in_area', 'id_patient', 'id_area')
            ->withPivot(['id', 'status'])->withTimestamps();
    }
    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'id_patient', 'id');
    }
    public function quotes()
    {
        return $this->belongsToMany(Schedule::class, 'quotes', 'id_patient', 'id_schedule')
            ->withPivot(['id', 'start_time', 'end_time', 'description', 'status'])
            ->withTimestamps();
    }
    public function folders()
    {
        return $this->hasMany(Folder::class, 'id_patient', 'id');
        
    }
    public function file(){
        return $this->morphOne(File::class,'fileable');
    }
    public function loadCourseImage()
    {
        return $this->loadMissing([
            'file' => fn ($query) =>
            $query->where('file_type', 'imagenes')
                ->where('category', 'patient')
        ]);
    }

}
