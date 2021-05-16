<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actividades extends Model
{
    use HasFactory;

    protected $table = 'actividadtemas';
    protected $primaryKey = 'idActividadTemas';

    protected $fillable = [
        'idActividadTemas',
        'nombreActividad',
        'descripcionActividad',
        'recursos',
        'tipoActividad',
        'porcentajeCurso',
        //'puntuacion',
        'fechainicio',
        'fechalimite',
        'temas_id',
        'curso_id',
        'semana_id',
    ];
}
