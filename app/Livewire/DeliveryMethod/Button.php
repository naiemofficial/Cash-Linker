<?php

namespace App\Livewire\DeliveryMethod;

use Livewire\Component;

class Button extends Component
{
    public $form = 'add';
    public $statuses = [];
    public $status = null;

    public function submit(): void {
        $this->dispatch('deliveryMethod-form-submitted', status: $this->status);
    }

    public function render()
    {
        return view('livewire.delivery-method.button');
    }
}
