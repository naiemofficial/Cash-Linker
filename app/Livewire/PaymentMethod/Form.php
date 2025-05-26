<?php

namespace App\Livewire\PaymentMethod;

use App\Http\Controllers\PaymentMethodController;
use App\Http\Middleware\UserRoleMiddleware;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class Form extends Component
{
    public $form = 'add';
    public $paymentMethod = null;

    public $name;
    public $cost;
    public $details;



    public function mount(){
        $paymentMethod = $this->paymentMethod;
        if(!empty($paymentMethod)){
            $this->name         = $paymentMethod->name;
            $this->cost         = $paymentMethod->cost;
            $this->details      = $paymentMethod->details;
        }
    }


    #[On('paymentMethod-form-submitted')]
    public function submit($status){
        $role = Auth::user()->role();
        $paymentMethod = $this->paymentMethod;

        $data = [
            'name'      => $this->name,
            'cost'      => $this->cost,
            'details'   => $this->details,
        ];

        if(!empty($status)){
            $data['status'] = $status;
        }


        $response = app(UserRoleMiddleware::class)->handle(request(), function($request) use ($data, $paymentMethod){
            $PaymentMethodController = app(PaymentMethodController::class);

            $request->merge($data);

            if(empty($paymentMethod)){
                return $PaymentMethodController->store($request);
            } else {
                return $PaymentMethodController->update($request, $paymentMethod);
            }
        }, role: $role);


        if($this->form == 'add' && $response->isSuccessful()){
            if(empty($paymentMethod)){
                $paymentMethod_id = $response->getData()->id;
                $this->reset();
                $this->redirect(route('payment-method.index', $paymentMethod_id));
            }
        }

        $this->dispatch('refresh-message', response: $response);
    }

    public function render()
    {
        return view('livewire.payment-method.form', [
            'className' => $this::class
        ]);
    }
}
