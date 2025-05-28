<?php

namespace App\Livewire\Product;

use Livewire\Attributes\On;
use Livewire\Component;

class Cart extends Component
{
    public $cartProducts = [];

    #[On('product-add-to-cart')]
    public function cartProducts(array $data) {
        $this->cartProducts[] = $data;
    }

    public function render()
    {
        return view('livewire.product.cart');
    }
}
