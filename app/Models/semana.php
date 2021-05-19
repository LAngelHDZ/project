<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class semana extends Model
{
    use HasFactory;
    protected $table = 'semanas';
    protected $primaryKey = 'idSemanas';

    protected $fillable = [
        'idSemanas',
        'finicio',
        'ffinal',
        'periodo_id'
    ]; 
}
