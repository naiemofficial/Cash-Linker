<?php

namespace App\Livewire\Order;

use App\Models\Order;
use Livewire\Attributes\On;
use Livewire\Component;

class Timeline extends Component
{
    public $order;
    public $logs;

    public function mount(){
        $this->logs = $this->order->logs;
    }

    #[On('refresh-order-logs-Timeline')]
    public function refreshOrderLogs() {
        $this->logs = $this->order->logs;
    }

    public function render()
    {
        return view('livewire.order.timeline');
    }
}
