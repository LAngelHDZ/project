<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalificacionFinal extends Model
{
    use HasFactory;

    protected $table = 'calificacionfinal';
    protected $primaryKey = 'idCalFinal';

    protected $fillable = [
        'idCalFinal',
        'calificacion',
        'alumno_ins_id'
    ];
}
