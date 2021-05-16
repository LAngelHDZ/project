<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CargaAcademica extends Model
{
    use HasFactory;

    protected $table = 'carga_academica';
    protected $primaryKey = 'idCA';

    protected $fillable = [
        'idCA',
        'alumno_id',
        'curso_id',
        'status'
    ];
}
