<?php

namespace App\Livewire\Order;

use App\Http\Controllers\DeliveryMethodController;
use App\Http\Middleware\UserRoleMiddleware;
use App\Models\DeliveryMethod;
use App\Models\Order;
use App\Models\PaymentMethod;
use App\Models\Product;
use Livewire\Attributes\On;
use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\WithPagination;

class Summary extends Component
{
    use WithPagination;
    public $checkoutPage = false;
    public $editable = true;
    public $cartContent;
    public $cartItemsCount = 0;
    public $totalMoney = 0;
    public $extraCost = 0;
    public $quantity = [];
    public $deliveryMethods = [];
    public $deliveryMethod = null;
    public $deliveryCost = 0;
    public $showDeliveryMethod = false;
    public $paymentMethod = null;

    public $acceptance = false;

    // Inputs
    public $wallet;
    public $transactionId;
    public $transactionInfo;

    public $heading = true;

    public function mount(){
        $this->extracted();
    }


    #[On('refresh-cart-Summary')]
    public function refreshCart() {
        $this->extracted();
    }


    #[On('update-quantity-Summary')]
    public function updateQuantity($productData)
    {
        $productID = $productData['id'];
        $quantity = $productData['quantity'];

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

    #[On('remove-cart-item-Summary')]
    public function removeCartItem($rowId){
        Cart::remove($rowId);
        $this->extracted();
    }

    #[On('select-delivery-method-Summary')]
    public function selectDeliveryMethod($deliveryMethod){
        $this->deliveryMethod = DeliveryMethod::find($deliveryMethod);
        $this->deliveryCost = Cart::count() > 0 ? $this->deliveryMethod->cost : 0;
        $this->extracted();
    }

    #[On('select-payment-method-Summary')]
    public function selectPaymentMethod($paymentMethod){
        $this->paymentMethod = PaymentMethod::find($paymentMethod);
    }


    public function confirmOrder() {
        $products = Cart::content()->map(fn($item) => ['id' => $item->id, 'qty' => $item->qty])->values()->toArray();
        $data = [
            'products'          => $products,
            'deliveryMethod'    => $this->deliveryMethod->id ?? null,
            'paymentMethod'     => $this->paymentMethod->id ?? null,
            'wallet'            => $this->wallet,
            'transactionId'     => $this->transactionId,
            'transactionInfo'   => $this->transactionInfo,
            'acceptance'        => $this->acceptance,
        ];
        $this->dispatch('confirm-order-Checkout', $data);
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
