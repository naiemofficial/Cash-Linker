<?php

namespace App\Http\Controllers;

use App\Helpers\Database;
use App\Livewire\Message\Index as MessageIndex;
use App\Livewire\Order\Checkout;
use App\Models\DeliveryMethod;
use App\Models\Order;
use App\Models\OrderLog;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class OrderController extends Controller
{
    public function db_enums()
    {
        $Order = app(Order::class);
        $enums = [
            'statuses'    => Database::getEnum($Order, 'status'),
        ];
        return $enums;
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trashPage = request()->segment(3) === 'trash';
        $query = $trashPage
            ? Auth::user()->orders(['onlyTrashed' => true])
            : Auth::user()->orders();

        return view('order.index', [
            'orders' => $query->paginate(15),
            'trash_count' => Auth::user()->orders(['onlyTrashed' => true])->count(),
            'trashPage' => $trashPage,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('order.create', [
            'products' => Product::orderBy('created_at', 'desc')->paginate(5),
            ...$this->db_enums()
        ]);
    }


    /**
     * Show the form for checkout order.
     */
    public function checkout()
    {
        return view('order.checkout');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $input  = $request->all();
            $showCountryCity = app(Checkout::class)->showCountryCity;

            // Create user if not logged in
            if(!Auth::check()){
                $user_validated = $request->validate([
                    'name'              => ['required', 'string', 'max:255'],
                    'email'             => ['required', 'string', 'email', 'max:255', Rule::unique('users')],
                    'phone'             => ['nullable', 'numeric', 'digits:11', Rule::unique('users')],
                    'password'          => ['required', 'string', 'min:8', 'confirmed']
                ]);

                $user_validated['password'] = bcrypt($user_validated['password']);
            } else {
                $user_validated = [];
                $User = Auth::user();
            }

            $validated = $request->validate([
                'name'              => ['required', 'string', 'max:255'],
                'email'             => ['nullable', 'string', 'email', 'max:255'],
                'phone'             => ['required', 'numeric', 'digits:11'],
                'products'          => ['required', 'array', 'min:1'],
                'products.*'        => ['required', 'min:1'],
                'deliveryMethod'    => ['required', 'numeric', Rule::in(DeliveryMethod::pluck('id')->toArray())],
                'paymentMethod'     => ['required', 'numeric', Rule::in(PaymentMethod::pluck('id')->toArray())],
                'country'           => [Rule::requiredIf($showCountryCity)],
                'city'              => [Rule::requiredIf($showCountryCity)],
                'deliveryAddress'   => ['required', 'string'],
                'note'              => ['nullable', 'string'],
            ]);


            // Order Data
            if($this->isMfsPayment($request->input('paymentMethod'))){
                $validated_payment_info = $request->validate([
                    'wallet' => ['required', 'numeric', 'digits_between:11,12'],
                    'transactionId' => ['required', 'max:15'],
                ]);
            } else {
                $validated_payment_info = $request->validate([
                    'transactionInfo' => ['required', 'string'],
                ]);
            }

            // Agreed with the Terms
            $request->validate([
               'acceptance' => ['required', 'accepted'],
            ]);




            // All the fields checking has been completed, NOW => Next
            // Create User
            if(!Auth::check()){
                $User = User::create($user_validated);
                Auth::login($User);
            }




            // Get all cart products for snapshot
            $productIds = array_column($validated['products'], 'id');
            $products = Product::findMany($productIds)->toArray();

            $product_data = [
                'user_id' => Auth::id(),
                'receiver' => [
                    'name'   => $validated['name'],
                    'email'     => Arr::get($validated, 'email', null),
                    'phone'     => $validated['phone'],
                ],
                'delivery_address' => [
                    'country'   => Arr::get($validated, 'country', null),
                    'city'      => Arr::get($validated, 'city', null),
                    'address'   => $validated['deliveryAddress'],
                ],
                'note'       => Arr::get($validated, 'note', null),
                'delivery_method_snapshot'  => DeliveryMethod::find($validated['deliveryMethod'])->toArray(),
                'payment_method_snapshot'   => PaymentMethod::find($validated['paymentMethod'])->toArray(),
                'products' => $validated['products'],
                'products_snapshot' => $products,
                'payment_info' => $validated_payment_info
            ];

            // Create Order
            $Order = Order::create($product_data);
            Cart::destroy();

            return response()->json([
                'success' => 'You order has been placed',
                'id' => $Order->id,
            ], 201);

        } catch (\Exception $error){
            $message = ['error' => $error->getMessage()];
            return response()->json($message, 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        return view('order.edit', [
            'order' => $order,
            ...$this->db_enums()
        ]);
    }


    /**
     * Store the updated information in storage as order log.
     */
    private function createLog($orderId, $data = []){
        $log_data = $data;
        $log_data['order_id'] = $orderId;
        $log_data['user_id'] = Auth::user()->id;

        try {
            OrderLog::create($log_data);
            return response()->json([
                'success' => 'A note added to the order'
            ], 201);
        } catch (\Exception $error){
            $message = ['error' => $error->getMessage()];
            return response()->json($message, 400);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $restricted_statuses = ['cancelled', 'delivered'];
        try {
            $validated = $request->validate([
                'status'    => [Rule::requiredIf(function () use ($restricted_statuses, $order) {
                    return !in_array($order->status, $restricted_statuses);
                })],
                'note'      => [Rule::requiredIf(function () use ($restricted_statuses, $order) {
                    return in_array($order->status, $restricted_statuses);
                }), 'nullable', 'string'],
            ]);

            // Prevent Status update by Customer
            if(Auth::user()->role() == 'customer'){
                if(empty($validated['status']) || $validated['status'] !== 'cancelled'){
                    return response()->json([
                        'error' => 'Order cannot be updated'
                    ]);
                }
            }

            $isSameStatus = ($order->status === $validated['status']);
            if(isset($validated['status']) &&  $isSameStatus && empty($validated['note'])){
                return response()->json([
                    'warning' => 'No changes made!'
                ], 204);
            }

            if(!empty($validated['note']) && ($isSameStatus || empty($validated['status'])  || in_array($order->status, $restricted_statuses))) {
                if($isSameStatus) unset($validated['status']);
                return $this->createLog($order->id, $validated);
            }



            $order->status = $validated['status'];
            $order->save();
            return $this->createLog($order->id, $validated);

            return response()->json([
                'success' => 'Order updated successfully'
            ], 200);

        } catch (\Exception $error){
            $message = ['error' => $error->getMessage()];
            return response()->json($message, 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order, bool $redirect = false)
    {
        try {
            if(Auth::user()->role() != 'administrator'){
                throw new \Exception('Unauthorized access to delete the order.');
            }

            $order->delete();
            $message = [ 'pending' => 'Order moved to trash' ];

            if($redirect){
                MessageIndex::refresh($message);
                return redirect()->route('order.index');
            } else {
                return response()->json($message, 200);
            }
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyPermanent(int $orderID, bool $redirect = false)
    {
        try {
            if(Auth::user()->role() != 'administrator'){
                throw new \Exception('Unauthorized access to delete the order permanently.');
            }

            $order = Order::withTrashed()->findOrFail($orderID);
            $order->forceDelete();
            $message = [ 'success' => 'Order deleted successfully' ];
            if($redirect){
                MessageIndex::refresh($message);
                return redirect()->route('order.index.trash');
            } else {
                return response()->json($message, 200);
            }
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore(int $orderID, bool $redirect = false)
    {
        try {
            if(Auth::user()->role() != 'administrator'){
                throw new \Exception('Unauthorized access to restore the order.');
            }

            $order = Order::withTrashed()->findOrFail($orderID);
            $order->restore();
            $message = ['success' => 'Order restored successfully'];
            if($redirect){
                MessageIndex::refresh($message);
                return redirect()->route('order.index.trash');
            } else {
                return response()->json($message, 200);
            }
        } catch (\Exception $e) {
            $message = [ 'error' => $e->getMessage() ];
            if($redirect){
                MessageIndex::refresh($message);
                return redirect()->route('order.index.trash');
            } else {
                return response()->json($message, 500);
            }
        }
    }




    // Helper Functions
    protected function isMfsPayment($paymentMethodId) {
        $paymentMethod = PaymentMethod::find($paymentMethodId);
        return $paymentMethod && $paymentMethod->type == 'mfs';
    }
}
