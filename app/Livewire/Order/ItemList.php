<?php

namespace App\Livewire\Order;

use Livewire\Component;

class ItemList extends Component
{
    public $products;
    public $quantity = [];
    public $productSource = "";
    public $checkoutPage = false;
    public $editable = false;

    public function updateQuantity($productID, $quantity){
        $this->dispatch('update-quantity-Summary', productData: ['id' => $productID, 'quantity' => $quantity]);
    }

    public function removeCartItem($rowId){
        $this->dispatch('remove-cart-item-Summary', rowId: $rowId);
    }

    public function render()
    {
        return view('livewire.order.item-list');
    }
}
