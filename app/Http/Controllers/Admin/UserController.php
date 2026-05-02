<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.users.index');
    }

    public function getData()
    {
        $users = User::where('role', 'user')
            ->has('orders')
            ->withCount('orders')
            ->withSum('orders', 'final_amount');

        return DataTables::of($users)
            ->addColumn('actions', function ($user) {
                $url = route('admin.users.show', $user->id);
                return '<a href="' . $url . '" 
                        style="background:#8B5CF6;color:white;
                        padding:4px 12px;border-radius:6px;
                        text-decoration:none;font-size:13px;">
                        View
                        </a>';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function show($id)
    {
        $user = User::with(['orders.orderItems'])->findOrFail($id);
        return view('admin.users.show', compact('user'));
    }
}