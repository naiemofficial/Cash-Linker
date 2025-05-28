<?php

namespace App\Livewire\Order;

use App\Models\DeliveryMethod;
use App\Models\Order;
use App\Models\Product;
use Livewire\Attributes\On;
use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\WithPagination;

class Summary extends Component
{
    use WithPagination;
    public $cartContent;
    public $cartItemsCount = 0;
    public $totalMoney = 0;
    public $extraCost = 0;
    public $quantity = [];
    public $deliveryMethods = [];
    public $deliveryMethod;
    public $deliveryCost = 0;

    public $heading = true;

    public function mount(){
        $this->extracted();
    }


    #[On('refresh-cart-Summary')]
    public function refreshCart() {
        $this->extracted();
    }


    public function updateQuantity($productID, $quantity)
    {
        $product = Product::find($productID);
        $cartItem = Cart::content()->where('id', $productID)->first();
        $rowID = $cartItem->rowId;

        // Update cart item completely in-case if price or any other value changed during updating the cart
        $productData = [
            'name'  => $product->name,
            'qty'   => $quantity,
            'price' => $product->price,
            'options' => [
                'origin'        => $product->origin,
                'value'         => $product->value,
                'category'      => $product->category,
                'type'          => $product->type,
                'year'          => $product->year,
                'commission'    => $product->commission,
                'image'         => $product->image,
                'description'   => $product->description,
            ]
        ];
        Cart::update($rowID, $productData)->setTaxRate(0);

        $this->extracted();
    }

    public function removeCartItem($rowId){
        Cart::remove($rowId);
        $this->extracted();
    }

    public function selectDeliveryMethod($deliveryMethod){
        $this->deliveryCost = DeliveryMethod::find($deliveryMethod)->cost;
        $this->extracted();
    }

    public function render()
    {
        return view('livewire.order.summary');
    }

    /**
     * @return void
     */
    public function extracted(): void {
        $this->cartContent = Cart::content()->toArray();
        $this->quantity = array_column($this->cartContent, 'qty', 'id');

        $this->cartItemsCount = Cart::count();
        $this->totalMoney = number_format((float) str_replace(',', '', Cart::total()), 2, '.', ',');
        $this->extraCost = number_format(Order::countCartExtraCost(), 2, '.', ',');

        $this->deliveryMethods = DeliveryMethod::all();

        $this->dispatch('refresh-cart-Total', [
            'deliveryMethod' => $this->deliveryMethod,
            'deliveryCost' => $this->deliveryCost
        ]);
    }
}
