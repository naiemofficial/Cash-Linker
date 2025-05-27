<?php

namespace App\Livewire\Product;

use Livewire\Component;

class Button extends Component
{
    public $form = 'add';
    public $default = [];
    public $statuses = [];
    public $status;

    public function mount(){
        if($this->form == 'add'){
            $this->status = $this->default['status'] ?? '';
        }
    }

    public function submit(): void {
        $this->dispatch('product-form-submitted', status: $this->status);
    }


    public function render()
    {
        return view('livewire.product.button');
    }
}
