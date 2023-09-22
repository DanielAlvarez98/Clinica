<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $table='invoices';

    protected static function boot()
    {
        parent::boot();
    
        static::creating(function ($invoice) {
            // Encuentra el último registro y obtén su código
            $ultimoCodigo = self::max('codigo');
            // Extrae la parte numérica de la cadena y suma 1
            $ultimoNumero = intval(preg_replace("/[^0-9]/", "", $ultimoCodigo));
            $nuevoNumero = $ultimoNumero + 1;
            // Formatea el nuevo número con ceros a la izquierda y concaténalo con 'F-'
            $nuevoCodigo = 'F-' . str_pad($nuevoNumero, 4, '0', STR_PAD_LEFT);
            // Establece el nuevo código en el modelo
            $invoice->codigo = $nuevoCodigo;
        });
    }
    
    


    public function patients(){
        return $this->belongsTo(Patient::class,'id_patient','id');
    }
    public function invoiceDetails(){
        return $this->belongsToMany(Medicine::class,'invoice_details','id_invoice','id_medicine')
        ->withPivot(['id','amount'])->withTimestamps();
    }

    protected $guarded=[];
}
