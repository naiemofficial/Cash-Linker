<?php

namespace App\Livewire\Order;

use App\Http\Controllers\DeliveryMethodController;
use App\Http\Controllers\OrderController;
use App\Http\Middleware\UserRoleMiddleware;
use App\Models\DeliveryMethod;
use App\Models\Order;
use App\Models\PaymentMethod;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use WW\Countries\Models\Country;

class Checkout extends Component
{
    public $cartCount;
    public $checkoutPage = true;
    public $name;
    public $email;
    public $phone;
    public $password;
    public $passwordConfirmation;
    public $countries = [];
    public $country = 'Bangladesh';
    public $cities = [];
    public $city;
    public $showCountryCity = false;
    public $deliveryAddress;
    public $note;
    public $deliveryMethods;
    public $deliveryMethod;
    public $paymentMethods;
    public $paymentMethod;

    public $showOrderSummary = false;
    public $orderId = null;

    public function mount() {
        // If User Logged in
        if(Auth::check()){
            $this->name     = Auth::user()->name;
            $this->email    = Auth::user()->email;
            $this->phone    = Auth::user()->phone;
        }

        $this->cartCount = Cart::count();
        $this->deliveryMethods = DeliveryMethod::where('status', 'active')->get();
        $this->paymentMethods = PaymentMethod::where('status', 'active')->get();
        $this->countries = Country::where('name', 'Bangladesh')->orderBy('name')->pluck('name')->toArray();
    }

    public function updateDeliveryMethod($deliverMethodId){
        $this->dispatch('select-delivery-method-Summary', intval($deliverMethodId));
    }

    public function updatePaymentMethod($paymentMethodId){
        $this->dispatch('select-payment-method-Summary', intval($paymentMethodId));
    }

    #[On('confirm-order-Checkout')]
    public function confirmOrder($data){
        $data = [
            ...$data,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'password' => $this->password,
            'password_confirmation' => $this->passwordConfirmation,
            'country' => $this->country,
            'city' => $this->city,
            'deliveryAddress' => $this->deliveryAddress,
        ];

        $request = request();
        $request->merge($data);
        $response = app(OrderController::class)->store($request);

        if($response->isSuccessful()){
            $this->showOrderSummary = true;
            $this->orderId = $response->getData()->id;
            $this->dispatch('refresh-guest-Button');
        }
        $this->dispatch('refresh-message', response: $response);
    }

    public function render()
    {
        return view('livewire.order.checkout');
    }
}
