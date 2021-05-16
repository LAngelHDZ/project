<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subtemas_model extends Model
{
    use HasFactory;

    protected $table = 'subtemas';
    protected $primaryKey = 'idSubtema';

    protected $fillable = [
        'idSubtema',
        'subindice',
        'nombre_subindice',
        'tema_id'
    ];
}
