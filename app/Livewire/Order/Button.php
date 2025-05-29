<?php

namespace App\Livewire\Order;

use Livewire\Component;

class Button extends Component
{
    public $statuses = [];
    public $form = 'add';

    public function submit(): void {
        $this->dispatch('order-form-submitted');
    }


    public function render()
    {
        return view('livewire.order.button');
    }
}
