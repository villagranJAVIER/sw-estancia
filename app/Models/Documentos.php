<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documentos extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre_documento',
        'URL_documento',
        'estatus',
        'comentarios',
        'id_estudiante',
    ];
}
