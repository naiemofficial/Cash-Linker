<?php

namespace App\Livewire\Order;

use App\Models\DeliveryMethod;
use App\Models\PaymentMethod;
use Livewire\Component;
use WW\Countries\Models\Country;

class Checkout extends Component
{
    public $checkoutPage = true;
    public $name;
    public $email;
    public $mobile;
    public $password;
    public $password_confirmation;
    public $countries = [];
    public $country;
    public $cities = [];
    public $city;
    public $hideCountryCity = true;
    public $address;
    public $deliveryMethods;
    public $deliveryMethod;
    public $paymentMethods;
    public $paymentMethod;

    public function mount() {
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

    public function render()
    {
        return view('livewire.order.checkout');
    }
}
