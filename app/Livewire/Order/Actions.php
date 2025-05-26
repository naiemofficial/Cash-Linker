<?php

namespace App\Livewire\Order;

use Livewire\Component;

class Actions extends Component
{
    public $order;
    public function render()
    {
        return view('livewire.order.actions');
    }
}
