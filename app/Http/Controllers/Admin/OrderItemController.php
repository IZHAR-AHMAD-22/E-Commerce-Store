<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use Yajra\DataTables\Facades\DataTables;

class OrderItemController extends Controller
{
    public function index()
    {
        return view('admin.order-items.index');
    }

    public function getData()
    {
        return DataTables::of(OrderItem::with(['order']))
            ->addColumn('image', function ($item) {
                $url = $item->product_image
                    ? asset('storage/' . $item->product_image)
                    : asset('images/no-image.svg');
                return '<img src="' . $url . '" width="50" 
                        height="50" style="object-fit:cover;
                        border-radius:6px;">';
            })
            ->rawColumns(['image'])
            ->make(true);
    }
}