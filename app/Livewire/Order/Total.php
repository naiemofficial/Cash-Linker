<?php

namespace App\Livewire\Order;

use App\Models\DeliveryMethod;
use App\Models\Order;
use App\Models\Product;
use Livewire\Attributes\On;
use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;

class Total extends Component
{
    public $cartItemsCount = 0;
    public $totalMoney = 0;
    public $extraCost = 0;
    public $deliveryMethod = null;
    public $deliveryCost = 0;
    public $showDeliveryMethod = false;

    public function mount(){
        $this->cartItemsCount = Cart::count();
        $this->totalMoney = number_format((float) str_replace(',', '', Cart::total()), 2, '.', ',');
        $this->extraCost = number_format(Order::countCartExtraCost(), 2, '.', ',');
    }


    #[On('refresh-cart-Total')]
    public function refreshCart($props = []) {
        $this->cartItemsCount = Cart::count();
        $this->totalMoney = number_format((float) str_replace(',', '', Cart::total()), 2, '.', ',');
        $this->extraCost = number_format(Order::countCartExtraCost(), 2, '.', ',');
        if(isset($props['deliveryMethod'])){
            $this->deliveryMethod = DeliveryMethod::find($props['deliveryMethod']);
            $this->deliveryCost = floatval($this->deliveryMethod->cost);
        }
    }

    public function render()
    {
        return view('livewire.order.total', [
            'total' => number_format((str_replace(',', '', $this->totalMoney) + str_replace(',', '', $this->extraCost) + $this->deliveryCost), 2, '.', ',')
        ]);
    }
}
