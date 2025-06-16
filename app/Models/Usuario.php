<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Usuario extends Model
{
    protected $table = 'usuario';
    protected $primaryKey = 'id_usuario';
    protected $fillable = [
        'nom_usuario',
        'ap_usuario',
        'am_usuario',
        'tel_cel_usuario',
        'tel_emergencia',
        'rfc',
        'notas_medicas',
    ];

    // Encriptar RFC al guardar
    public function setRFCAttribute($value)
    {
        $this->attributes['rfc'] = Crypt::encryptString($value);
    }

    // Desencriptar RFC al acceder
    public function getRFCAttribute($value)
    {
        return Crypt::decryptString($value);
    }
}

