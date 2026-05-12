<?php
namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')
                ->with('error', 'Your cart is empty!');
        }
        return view('checkout', compact('cart'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name'    => 'required|string|max:255',
            'customer_email'   => 'required|email|max:255',
            'customer_phone'   => 'required|string|max:20',
            'shipping_address' => 'required|string|max:500',
            'city'             => 'required|string|max:100',
            'payment_method'   => 'required|in:cod,bank_transfer',
        ]);

        $cart  = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')
                ->with('error', 'Your cart is empty!');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $order = Order::create([
            'user_id'          => auth()->id(),
            'customer_name'    => $request->customer_name,
            'customer_email'   => $request->customer_email,
            'customer_phone'   => $request->customer_phone,
            'shipping_address' => $request->shipping_address,
            'city'             => $request->city,
            'total_amount'     => $total,
            'discount_amount'  => 0,
            'final_amount'     => $total,
            'status'           => 'pending',
            'payment_method'   => $request->payment_method,
            'order_note'       => $request->order_note,
        ]);

        foreach ($cart as $item) {
            OrderItem::create([
                'order_id'      => $order->id,
                'product_id'    => $item['id'],
                'product_name'  => $item['name'],
                'product_image' => $item['image'],
                'unit_price'    => $item['price'],
                'quantity'      => $item['quantity'],
                'subtotal'      => $item['price'] * $item['quantity'],
            ]);
        }

        session()->forget('cart');
        return redirect()->route('checkout.success', $order->id);
    }

    public function success($id)
    {
        $order = Order::with('orderItems')->findOrFail($id);
        return view('order-success', compact('order'));
    }

    public function track()
    {
        return view('track-order');
    }

    public function showTrack(Request $request)
    {
        $request->validate([
            'order_id' => 'required|integer|exists:orders,id',
            'email' => 'required|email',
        ]);

        $order = Order::where('id', $request->order_id)
            ->where('customer_email', $request->email)
            ->with('orderItems')
            ->first();

        if (!$order) {
            return back()->withErrors(['order_id' => 'Order not found or email does not match.']);
        }

        return view('track-order', compact('order'));
    }
}