<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumnos_datos extends Model
{
    use HasFactory;

    protected $table = 'datos_alumnos';

    protected $fillable = [
        'alumno_id',
        'lugarNac',
        'fechaNac',
        'genero',
        'estado_civil',
        'direccion',
        'colonia',
        'cp',
        'ciudad',
        'telefono',
        'curp',
        'num_seguro',
        'tipo_sangre',
        'alergias',
        'medicamentos_alergicos',
        'complicaciones_medicas',
        'nom_madre',
        'direccion_madre',
        'colonia_madre',
        'tel_madre',
        'nom_padre',
        'direccion_padre',
        'colonia_padre',
        'tel_padre',
        'contacto_emergencia',
        'tel_contacto',
        'parentesco',
        'contacto_emergencia2',
        'tel_contacto2',
        'parentesco2'
    ];
}
