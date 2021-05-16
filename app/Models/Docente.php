<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    use HasFactory;

    protected $table = 'docente';
    protected $primaryKey = 'idDocente';

    protected $fillable = [
        'idDocente',
        'matricula',
        'RFC',
        'user_id'
    ];
}
