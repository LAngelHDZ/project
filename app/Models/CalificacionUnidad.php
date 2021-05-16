<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalificacionUnidad extends Model
{
    use HasFactory;

    protected $table = 'calificacionparcial';
    protected $primaryKey = 'idCalparcial';

    protected $fillable = [
        'idCalparcial',
        'calificacion',
        'unidad_id',
        'alumno_ins_id',
    ];
}
