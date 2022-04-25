<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Greetings extends Component
{
    public $name='Kir';
    public $loud=false;
    public $greeting = ['Hello'];

    public function resetName($s='Kate'){
        $this->name = $s;
    }

    public function render()
    {
        return view('livewire.greetings');
    }
}
