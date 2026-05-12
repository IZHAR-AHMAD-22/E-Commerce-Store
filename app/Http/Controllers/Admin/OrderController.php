<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Mail\OrderStatusUpdated;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{
    public function index()
    {
        return view('admin.orders.index');
    }

    public function getData()
    {
        return DataTables::of(Order::query())
            ->addColumn('status', function ($order) {
                $colors = [
                    'pending'    => '#F59E0B',
                    'confirmed'  => '#3B82F6',
                    'processing' => '#F97316',
                    'shipped'    => '#8B5CF6',
                    'delivered'  => '#10B981',
                    'cancelled'  => '#EF4444',
                ];
                $color = $colors[$order->status] ?? '#6B7280';
                $label = ucfirst($order->status);
                return '<span style="background:' . $color . ';
                        color:white;padding:3px 12px;
                        border-radius:20px;font-size:12px;">
                        ' . $label . '</span>';
            })
            ->addColumn('actions', function ($order) {
                $url = route('admin.orders.show', $order->id);
                return '<a href="' . $url . '" 
                        style="background:#8B5CF6;color:white;
                        padding:4px 12px;border-radius:6px;
                        text-decoration:none;font-size:13px;">
                        View
                        </a>';
            })
            ->rawColumns(['status', 'actions'])
            ->make(true);
    }

    public function show($id)
    {
        $order = Order::with('orderItems')->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,processing,shipped,delivered,cancelled',
            'admin_note' => 'nullable|string|max:1000',
        ]);

        $order = Order::findOrFail($id);
        $order->update([
            'status' => $request->status,
            'admin_note' => $request->admin_note,
        ]);

        Mail::to($order->customer_email)
            ->send(new OrderStatusUpdated($order));

        return redirect()->back()
            ->with('success', 'Order status updated successfully!');
    }
}