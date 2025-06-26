<?php

namespace App\Http\Controllers;

use App\Models\DeliveryMethod;
use App\Models\Order;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.index', [
            'products'          => Product::all()->count(),
            'customers'         => User::where('user_role_id', UserRole::firstWhere('name', 'customer')->id)->count(),
            'orders'            => Order::select('id', 'created_at')->get(),
            'userOrders'        => Auth::user()->orders()->count(),
            'pendingOrders'     => Auth::user()->orders()->where('status', 'pending')->count(),
            'deliveryMethods'   => DeliveryMethod::all()->count(),
            'paymentMethods'    => PaymentMethod::all()->count(),
        ]);
    }
}
