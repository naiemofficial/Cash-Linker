<?php

namespace App\Livewire\PaymentMethod;

use App\Http\Controllers\PaymentMethodController;
use App\Http\Middleware\UserRoleMiddleware;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Actions extends Component
{
    public $paymentMethod;

    /*public function delete($id, $action = null){
        $role = Auth::user()->role();
        $paymentMethod = ($action == 'trash') ? PaymentMethod::onlyTrashed()->find($id) : PaymentMethod::find($id);

        $response = app(UserRoleMiddleware::class)->handle(request(), function($request) use ($paymentMethod){
            return app(PaymentMethodController::class)->destroy($paymentMethod);
        }, role: $role);


        if($response->isSuccessful()){
            $this->dispatch('refresh-message', response: $response);
            $this->dispatch('update-paymentMethod-trash-count');
        }
    }*/

    public function render()
    {
        return view('livewire.payment-method.actions');
    }
}
