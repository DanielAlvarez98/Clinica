<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice_Detail extends Model
{
    use HasFactory;

    protected $table='invoice_details';
    protected $guarded=[];

}
