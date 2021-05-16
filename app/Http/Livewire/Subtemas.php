<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Subtemas_model;

class Subtemas extends Component
{
    public $idTema;
    public $subtemas;

    public function render()
    {
        $this->getSubtemas();
        return view('livewire.subtemas');
    }

    public function getSubtemas(){
        $this->subtemas = Subtemas_model::where('tema_id', $this->idTema)->get();
    }


}
