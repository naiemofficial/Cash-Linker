<?php

namespace App\Livewire\Guest;

use Livewire\Attributes\On;
use Livewire\Component;

class Button extends Component
{
    public $authorized;
    public function mount(){
        $this->authorized = auth()->check();
    }
    #[On('refresh-guest-Button')]
    public function refresh(){
        $this->authorized = auth()->check();
    }
    public function render()
    {
        return view('livewire.guest.button');
    }
}
