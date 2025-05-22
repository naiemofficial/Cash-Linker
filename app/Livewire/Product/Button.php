<?php

namespace App\Livewire\Product;

use Livewire\Component;

class Button extends Component
{
    public $form = 'add';

    public function submit(): void {
        $this->dispatch('product-form-submitted');
    }


    public function render()
    {
        return view('livewire.product.button');
    }
}
