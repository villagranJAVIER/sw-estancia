<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Universidades extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'direccion',
        'telefono',
    ];
}
