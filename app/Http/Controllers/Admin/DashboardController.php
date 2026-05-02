<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use App\Models\Contact;

class DashboardController extends Controller
{
    public function index()
    {
        $total_products   = Product::count();
        $total_orders     = Order::count();
        $total_revenue    = Order::where('status', 'delivered')
                                ->sum('final_amount');
        $total_users      = User::where('role', 'user')->count();
        $unread_contacts  = Contact::where('is_read', false)->count();
        $recent_orders    = Order::latest()->take(10)->get();
        $recent_contacts  = Contact::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'total_products',
            'total_orders',
            'total_revenue',
            'total_users',
            'unread_contacts',
            'recent_orders',
            'recent_contacts'
        ));
    }
}