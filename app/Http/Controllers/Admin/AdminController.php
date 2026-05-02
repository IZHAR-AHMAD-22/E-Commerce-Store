<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.admins.index');
    }

    public function getData()
    {
        $admins = User::where('role', 'admin');

        return DataTables::of($admins)
            ->addColumn('actions', function ($admin) {
                return '<span style="background:#6B7280;color:white;
                        padding:3px 10px;border-radius:6px;
                        font-size:12px;">
                        Admin
                        </span>';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'admin',
        ]);

        return redirect()->back()
            ->with('success', 'Admin created successfully!');
    }
}