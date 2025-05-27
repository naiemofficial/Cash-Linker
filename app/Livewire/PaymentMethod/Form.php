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

    public $logo;
    public $name;
    public $account_no;
    public $account_name;
    public $types = [];
    public $type;
    public $categories = [];
    public $category;
    public $swift_code;
    public $description;



    public function mount(){
        $paymentMethod = $this->paymentMethod;
        if(!empty($paymentMethod)){
            $this->logo         = $paymentMethod->logo;
            $this->name         = $paymentMethod->name;
            $this->account_no   = $paymentMethod->account_no;
            $this->account_name = $paymentMethod->account_name;
            $this->type         = $paymentMethod->type;
            $this->category     = $paymentMethod->category;
            $this->swift_code   = $paymentMethod->swift_code;
            $this->description  = $paymentMethod->description;
        }
    }


    #[On('paymentMethod-form-submitted')]
    public function submit($status){
        $role = Auth::user()->role();
        $paymentMethod = $this->paymentMethod;

        $data = [
            'logo'          => $this->logo,
            'name'          => $this->name,
            'account_no'    => $this->account_no,
            'account_name'  => $this->account_name,
            'type'          => $this->type,
            'category'      => $this->category,
            'swift_code'    => $this->swift_code,
            'description'   => $this->description,
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
                $this->redirect(route('payment-method.edit', $paymentMethod_id));
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
