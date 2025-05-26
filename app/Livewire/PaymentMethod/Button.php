<?php

namespace App\Livewire\PaymentMethod;

use Livewire\Component;

class Button extends Component
{
    public $form = 'add';
    public $statuses = [];
    public $status = null;

    public function submit(): void {
        $this->dispatch('paymentMethod-form-submitted', status: $this->status);
    }

    public function render()
    {
        return view('livewire.payment-method.button');
    }
}
