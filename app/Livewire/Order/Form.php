<?php

namespace App\Livewire\Order;

use App\Helpers\Response;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\UserRoleMiddleware;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;
use Gloudemans\Shoppingcart\Facades\Cart;


class Form extends Component
{
    use WithPagination;

    public $form = 'add';
    // public $products = null;
    public $order = null;
    public $quantity = [];

    public $user = null;
    public $items;
    public $delivery_method;
    public $address;
    public $payment_method;
    public $payment_info;
    public $status;
    public $note;




    public function mount(){
        $order = $this->order;
        if(!empty($order)){
            $this->user             = User::find($order->user);
            $this->items            = $order->items;
            $this->delivery_method  = $order->delivery_method;
            $this->address          = $order->address;
            $this->payment_method   = $order->payment_method;
            $this->payment_info     = $order->payment_info;
            $this->status           = $order->status;
            $this->note             = $order->note;
        }

        $this->quantity = array_fill_keys(Product::all()->pluck('id')->toArray(), 1);
    }



    #[On('product-form-submitted')]
    public function submit(){
        $role = Auth::user()->role();
        $order = $this->product;

        $data = [

        ];

        $response = app(UserRoleMiddleware::class)->handle(request(), function($request) use ($data, $order){
            $ProductController = app(ProductController::class);

            $request->merge($data);

            if(empty($order)){
                return $ProductController->store($request);
            } else {
                return $ProductController->update($request, $order);
            }
        }, role: $role);

        if($this->form == 'add' && $response->isSuccessful()){
            if(empty($order)){
                $order_id = $response->getData()->id;
                $this->resetExcept(['values', 'types', 'categories']);
                $this->redirect(route('order.edit', $order_id));
            }
        }

        $this->dispatch('refresh-message', response: $response);
    }


    public function addToCart($productID){
        $product = Product::find($productID);
        $quantity = $this->quantity[$product->id] ?? 1;

        $options = [
            'origin'        => $product->origin,
            'value'         => $product->value,
            'category'      => $product->category,
            'type'          => $product->type,
            'year'          => $product->year,
            'commission'    => $product->commission,
            'image'         => $product->image,
            'description'   => $product->description,
        ];

        $productData = [
            'name'  => $product->name,
            'price' => $product->price,
            'options' => $options
        ];


        try {
            if(Cart::content()->where('id', $product->id)->isEmpty()){
                Cart::add($product->id, $product->name, $quantity, $product->price, options: $options)->setTaxRate(0);
                $response = ['success' => $product->name . ' added to cart successfully!'];
            } else {
                $cartItem = Cart::content()->where('id', $product->id)->first();
                $rowID = $cartItem->rowId;
                Cart::update($rowID, ($cartItem->qty + $quantity))->setTaxRate(0);
                Cart::update($rowID, $productData)->setTaxRate(0);
                $response = ['info' => $product->name . ' cart updated successfully!'];
            }
            $this->dispatch('refresh-cart-Total');
            $this->dispatch('refresh-cart-Summary');
            $this->dispatch('refresh-message', response: $response);

            $this->quantity[$product->id] = 1;
        } catch (\Exception $error){
            $response = ['error' => $error->getMessage()];
            $this->dispatch('refresh-message', response: $response);
        }
    }


    public function updateQuantity($productID, $quantity)
    {
        $this->quantity[$productID] = intval($quantity);
    }


    public function render()
    {
        return view('livewire.order.form', [
            'className' => $this::class,
            'products' => Product::paginate(15),
        ]);
    }
}
