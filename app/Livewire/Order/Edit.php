<?php

namespace App\Livewire\Order;

use Livewire\Component;

class Edit extends Component
{
    public $statuses = [];
    public $order = null;
    public $orderId;
    public function render()
    {
        return view('livewire.order.edit');
    }
}
