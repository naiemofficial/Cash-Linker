<?php

namespace App\Livewire\Order;

use App\Http\Controllers\OrderController;
use App\Http\Middleware\UserRoleMiddleware;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class Button extends Component
{
    public $statuses = [];
    public $status;
    public $note;
    public $order = null;
    public $form = 'add';


    public function mount(){
        $this->status = $this->order->status;
    }

    public function update(){
        $role = Auth::user()->role();
        $order = $this->order;

        $data = [
            'status'    => $this->status,
            'note'      => $this->note,
        ];

        $response = app(UserRoleMiddleware::class)->handle(request(), function($request) use ($data, $order){
            $OrderController = app(OrderController::class);

            $request->merge($data);
            return $OrderController->update($request, $order);
        }, role: $role);


        if($response->isSuccessful()){
            $this->reset('note');
            $this->dispatch('refresh-order-logs-Timeline');
            $this->status = $this->order->status;
        }

        $this->dispatch('refresh-message', response: $response);
    }


    public function submit(): void {
        $this->dispatch('order-form-submitted');
    }

    public function render()
    {
        return view('livewire.order.button');
    }
}
