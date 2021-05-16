<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examen extends Model
{
    use HasFactory;

    protected $table = 'examenCurso';
    protected $primaryKey = 'idExamen';

    protected $fillable = [
        'idExamen',
        'titulo',
        'descripcion',
        'fecha_apertura',
        'hora_apertura',
        'fechalimite',
        'horalimite',
        'curso_id'
    ];
}
