<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Persona extends Model
{
    //
    protected $table = 'personals';

    protected $fillable = [
        'usuario_id',
        'nombres',
        'documento',
        'correo',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }


    
}
