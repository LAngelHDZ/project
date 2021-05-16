<?php

namespace App\Http\Livewire\Docentes;

use Livewire\Component;
use App\Models\Subtemas_model;

class SubtemasCurso extends Component
{
    public $idTema;
    public $subtemas;

    public function render()
    {
        $this->getSubtemas(); 
        return view('livewire.docentes.subtemas-curso');
    }

    public function getSubtemas(){
        $this->subtemas = Subtemas_model::where('tema_id', $this->idTema)->get();
    }
}
