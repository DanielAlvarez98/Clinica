<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;
    protected $table='medicines';

    public function invoiceDetails(){
        return $this->belongsToMany(Invoice::class,'invoice_details','id_medicine','id_invoice')
        ->withPivot(['id','amount'])->withTimestamps();
    }

    protected $guarded=[];

}
