<?php

namespace App\Livewire\Product;

use Livewire\Component;

class Actions extends Component
{
    public $product;
    public function render()
    {
        return view('livewire.product.actions');
    }
}
