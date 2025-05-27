<?php

namespace App\Livewire\DeliveryMethod;

use App\Http\Controllers\DeliveryMethodController;
use App\Http\Middleware\UserRoleMiddleware;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class Form extends Component
{
    public $form = 'add';
    public $deliveryMethod = null;

    public $name;
    public $cost;
    public $details;



    public function mount(){
        $deliveryMethod = $this->deliveryMethod;
        if(!empty($deliveryMethod)){
            $this->name         = $deliveryMethod->name;
            $this->cost         = $deliveryMethod->cost;
            $this->details      = $deliveryMethod->details;
        }
    }


    #[On('deliveryMethod-form-submitted')]
    public function submit($status){
        $role = Auth::user()->role();
        $deliveryMethod = $this->deliveryMethod;

        $data = [
            'name'      => $this->name,
            'cost'      => $this->cost,
            'details'   => $this->details,
        ];

        if(!empty($status)){
            $data['status'] = $status;
        }


        $response = app(UserRoleMiddleware::class)->handle(request(), function($request) use ($data, $deliveryMethod){
            $DeliveryMethodController = app(DeliveryMethodController::class);

            $request->merge($data);

            if(empty($deliveryMethod)){
                return $DeliveryMethodController->store($request);
            } else {
                return $DeliveryMethodController->update($request, $deliveryMethod);
            }
        }, role: $role);


        if($this->form == 'add' && $response->isSuccessful()){
            if(empty($deliveryMethod)){
                $deliveryMethod_id = $response->getData()->id;
                $this->reset();
                $this->redirect(route('delivery-method.edit', $deliveryMethod_id));
            }
        }

        $this->dispatch('refresh-message', response: $response);
    }

    public function render()
    {
        return view('livewire.delivery-method.form', [
            'className' => $this::class
        ]);
    }
}
