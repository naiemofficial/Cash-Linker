<?php

namespace App\Livewire\Product;

use App\Helpers\Response;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\UserRoleMiddleware;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class Form extends Component
{
    public $form = 'add';
    public $product = null;

    public $name;
    public $values = [];
    public $value;
    public $categories = [];
    public $category;
    public $types = [];
    public $type;
    public $year;
    public $amount;
    public $commission;
    public $image;
    public $description;



    public function mount(){
        $product = $this->product;
        if(!empty($product)){
            $this->name         = $product->name;
            $this->value        = $product->value;
            $this->category     = $product->category;
            $this->type         = $product->type;
            $this->year         = $product->year;
            $this->amount       = $product->amount;
            $this->commission   = $product->commission;
            $this->image        = $product->image;
            $this->description  = $product->description;
        }
    }



    #[On('product-form-submitted')]
    public function submit(){
        $role = Auth::user()->role();
        $product = $this->product;

        $data = [
            'name' => $this->name,
            'value' => $this->value,
            'type' => $this->type,
            'category' => $this->category,
            'year' => $this->year,
            'amount' => $this->amount,
            'commission' => $this->commission,
            'image' => $this->image,
            'description' => $this->description,
        ];

        $response = app(UserRoleMiddleware::class)->handle(request(), function($request) use ($data, $product){
            $ProductController = app(ProductController::class);

            $request->merge($data);

            if(empty($product)){
                return $ProductController->store($request);
            } else {
                return $ProductController->update($request, $product);
            }
        }, role: $role);

        if($response->isSuccessful()){
            if(empty($product)){
                $product_id = $response->getData()->id;
                $this->resetExcept(['values', 'types', 'categories']);
                $this->redirect(route('product.index', $product_id));
            }
        }

        $this->dispatch('refresh-message', response: $response);
    }

    public function render()
    {
        return view('livewire.product.form', [
            'className' => $this::class
        ]);
    }
}
