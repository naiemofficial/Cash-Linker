<?php

namespace App\Livewire\DeliveryMethod;

use Livewire\Component;

class Actions extends Component
{
    public $deliveryMethod;
    public function render()
    {
        return view('livewire.delivery-method.actions');
    }
}
