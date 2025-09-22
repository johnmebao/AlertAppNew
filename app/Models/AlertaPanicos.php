<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlertaPanicos extends Model
{
    use HasFactory;

    protected $fillable = [
        'usuario_id',
        'sede_id',
        'tipo',
        'consultorio',
        'hora_evento'
    ];
}
