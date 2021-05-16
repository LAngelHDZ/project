<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Docente_datos extends Model
{
    use HasFactory;

    protected $table = 'datos_docente';

    protected $fillable = [
        'docente_id',
        'lugarNac',
        'fechaNac',
        'genero',
        'estado_civil',
        'direccion',
        'colonia',
        'ciudad',
        'telefono',
        'cp',
        'curp',
        'num_seguro',
        'tipo_sangre',
        'alergias',
        'medicamentos_alergicos',
        'complicaciones_medicas',
        'contacto_emerg',
        'tel_contacto',
        'parentesco',
        'contacto_emerg2',
        'tel_contacto2',
        'parentesco2'
    ];
}
