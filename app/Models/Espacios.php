<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Espacios extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_documento',
        'nombre_plantilla',
        'URL_plantilla',
    ];
}
