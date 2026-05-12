<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    public function index()
    {
        return view('admin.products.index');
    }

    public function getData()
    {
        return DataTables::of(Product::query())
            ->addColumn('image', function ($product) {
                $url = $product->image
                    ? asset('storage/' . $product->image)
                    : asset('images/no-image.svg');
                return '<img src="' . $url . '" width="60" 
                        height="60" style="object-fit:cover;
                        border-radius:8px;">';
            })
            ->addColumn('status', function ($product) {
                $color = $product->status === 'active' 
                    ? 'green' : 'red';
                $label = ucfirst($product->status);
                return '<span style="background:' . $color . ';
                        color:white;padding:3px 10px;
                        border-radius:20px;font-size:12px;">
                        ' . $label . '</span>';
            })
            ->addColumn('actions', function ($product) {
                $edit = route('admin.products.edit', $product->id);
                $delete = route('admin.products.destroy', $product->id);
                return '
                    <a href="' . $edit . '" 
                        style="background:#3B82F6;color:white;
                        padding:4px 12px;border-radius:6px;
                        text-decoration:none;font-size:13px;">
                        Edit
                    </a>
                    <form action="' . $delete . '" method="POST" 
                        style="display:inline;"
                        onsubmit="return confirm(\'Delete this product?\')">
                        <input type="hidden" name="_token" 
                            value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" 
                            value="DELETE">
                        <button type="submit" 
                            style="background:#EF4444;color:white;
                            padding:4px 12px;border-radius:6px;
                            border:none;font-size:13px;cursor:pointer;">
                            Delete
                        </button>
                    </form>';
            })
            ->rawColumns(['image', 'status', 'actions'])
            ->make(true);
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'              => 'required|string|max:255',
            'description'       => 'required|string',
            'short_description' => 'required|string|max:500',
            'price'             => 'required|numeric|min:0',
            'sale_price'        => 'nullable|numeric|min:0',
            'stock'             => 'required|integer|min:0',
            'category'          => 'required|string',
            'status'            => 'required|in:active,inactive',
            'image'             => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'gallery.*'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')
                ->store('products', 'public');
        }

        $galleryPaths = [];
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                $galleryPaths[] = $file->store('products/gallery', 'public');
            }
        }

        Product::create([
            'name'              => $request->name,
            'slug'              => Str::slug($request->name) . '-' . time(),
            'description'       => $request->description,
            'short_description' => $request->short_description,
            'price'             => $request->price,
            'sale_price'        => $request->sale_price,
            'stock'             => $request->stock,
            'category'          => $request->category,
            'status'            => $request->status,
            'is_featured'       => $request->boolean('is_featured'),
            'is_new_arrival'    => $request->boolean('is_new_arrival'),
            'image'             => $imagePath,
            'gallery'           => json_encode($galleryPaths),
        ]);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product created successfully!');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name'              => 'required|string|max:255',
            'description'       => 'required|string',
            'short_description' => 'required|string|max:500',
            'price'             => 'required|numeric|min:0',
            'sale_price'        => 'nullable|numeric|min:0',
            'stock'             => 'required|integer|min:0',
            'category'          => 'required|string',
            'status'            => 'required|in:active,inactive',
            'image'             => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'gallery.*'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imagePath = $product->image;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')
                ->store('products', 'public');
        }

        $galleryPaths = json_decode($product->gallery, true) ?? [];
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                $galleryPaths[] = $file->store('products/gallery', 'public');
            }
        }

        $product->update([
            'name'              => $request->name,
            'slug'              => Str::slug($request->name) . '-' . $product->id,
            'description'       => $request->description,
            'short_description' => $request->short_description,
            'price'             => $request->price,
            'sale_price'        => $request->sale_price,
            'stock'             => $request->stock,
            'category'          => $request->category,
            'status'            => $request->status,
            'is_featured'       => $request->boolean('is_featured'),
            'is_new_arrival'    => $request->boolean('is_new_arrival'),
            'image'             => $imagePath,
            'gallery'           => json_encode($galleryPaths),
        ]);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated successfully!');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('admin.products.index')
            ->with('success', 'Product deleted successfully!');
    }
}