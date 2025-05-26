<?php

namespace App\Livewire\PaymentMethod;

use Livewire\Component;

class Actions extends Component
{
    public $paymentMethod;
    public function render()
    {
        return view('livewire.payment-method.actions');
    }
}
