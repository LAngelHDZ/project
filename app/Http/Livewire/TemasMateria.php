<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Temas;

class TemasMateria extends Component
{
    public $idMateria;
    public $temas;

    public function render()
    {
        $this->getTemas();
        return view('livewire.temas-materia');
    }

    public function getTemas(){
        $this->temas = Temas::where('materia_id', $this->idMateria)->orderBy('indice','asc')->get();
    }
}
