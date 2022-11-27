<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recursos extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre_documento',
        'URL_documento',
        'id_estudiante',
    ];
}
