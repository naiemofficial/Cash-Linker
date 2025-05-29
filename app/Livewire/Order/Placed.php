<?php

namespace App\Livewire\Order;

use App\Models\Order;
use Livewire\Component;

class Placed extends Component
{
    public $orderId;
    public function render()
    {
        return view('livewire.order.placed', [
            'order' => Order::find($this->orderId) ?? null,
        ]);
    }
}
