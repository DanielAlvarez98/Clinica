<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;
    protected $table='quotes';

    public function patienst()
    {
        return $this->belongsTo(Patient::class,'id_patient','id');
    }
    public function schedules()
    {
        return $this->belongsTo(Schedule::class,'id_schedule','id');
    }
    protected $guarded=[];
}
