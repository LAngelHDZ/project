<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalActividad extends Model
{
    use HasFactory;

    protected $table = 'cal_actividades';
    protected $primaryKey = 'idCalActividad';

    protected $fillable = [
        'idCalActividad',
        'calificacion',
        'comentarios',
        'tarea_id',
    ];
}
