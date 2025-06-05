<?php

namespace App\Livewire\Order;

use Livewire\Component;

class Timeline extends Component
{
    public $order;
    public function render()
    {
        return view('livewire.order.timeline');
    }
}
