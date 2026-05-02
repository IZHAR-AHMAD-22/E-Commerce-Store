@extends('layouts.app')

@section('title', 'All Products - Thingy Store')

@section('content')

{{-- Page Header --}}
<section class="py-12 px-4 text-center"
    style="background:linear-gradient(135deg,#FFE8F3,#F3E8FF);">
    <h1 class="font-fredoka text-5xl text-gray-800 mb-3">
        All Products 🛍️
    </h1>
    <p class="text-gray-500 text-lg">
        Discover our full collection of cute & quirky thingies!
    </p>
</section>

{{-- Filters + Products --}}
<section class="py-12 px-4 max-w-7xl mx-auto">
    <div class="flex flex-col lg:flex-row gap-8">

        {{-- Sidebar Filters --}}
        <div class="lg:w-64 flex-shrink-0">
            <form method="GET" action="{{ route('products.index') }}">
                <div class="bg-white rounded-2xl p-6 shadow-sm sticky top-20">
                    <h3 class="font-fredoka text-xl text-gray-800 mb-4">
                        🔍 Filter Products
                    </h3>

                    {{-- Search --}}
                    <div class="mb-4">
                        <label class="block text-sm font-bold text-gray-600 mb-2">
                            Search
                        </label>
                        <input type="text"
                               name="search"
                               value="{{ request('search') }}"
                               placeholder="Search products..."
                               class="w-full border border-gray-200 rounded-xl
                               px-4 py-2 text-sm focus:outline-none
                               focus:border-pink-400">
                    </div>

                    {{-- Category --}}
                    <div class="mb-4">
                        <label class="block text-sm font-bold text-gray-600 mb-2">
                            Category
                        </label>
                        <select name="category"
                            class="w-full border border-gray-200 rounded-xl
                            px-4 py-2 text-sm focus:outline-none
                            focus:border-pink-400">
                            <option value="">All Categories</option>
                            @foreach([
                                'gadgets'   => '📱 Gadgets',
                                'stationery'=> '✏️ Stationery',
                                'home-decor'=> '🏠 Home Decor',
                                'fashion'   => '👗 Fashion',
                                'toys'      => '🧸 Toys',
                                'beauty'    => '💄 Beauty',
                                'other'     => '📦 Other',
                            ] as $val => $label)
                            <option value="{{ $val }}"
                                {{ request('category') == $val ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Price Range --}}
                    <div class="mb-4">
                        <label class="block text-sm font-bold text-gray-600 mb-2">
                            Price Range (Rs.)
                        </label>
                        <div class="flex gap-2">
                            <input type="number"
                                   name="min_price"
                                   value="{{ request('min_price') }}"
                                   placeholder="Min"
                                   class="w-1/2 border border-gray-200 rounded-xl
                                   px-3 py-2 text-sm focus:outline-none
                                   focus:border-pink-400">
                            <input type="number"
                                   name="max_price"
                                   value="{{ request('max_price') }}"
                                   placeholder="Max"
                                   class="w-1/2 border border-gray-200 rounded-xl
                                   px-3 py-2 text-sm focus:outline-none
                                   focus:border-pink-400">
                        </div>
                    </div>

                    {{-- Buttons --}}
                    <button type="submit" class="btn-primary w-full text-center
                        text-sm py-2 mb-2">
                        🔍 Apply Filters
                    </button>
                    <a href="{{ route('products.index') }}"
                        class="block text-center text-sm text-gray-400
                        hover:text-pink-custom py-2">
                        ✕ Clear Filters
                    </a>
                </div>
            </form>
        </div>

        {{-- Products Grid --}}
        <div class="flex-1">

            {{-- Results Info --}}
            <div class="flex justify-between items-center mb-6">
                <p class="text-gray-500 text-sm">
                    Showing <span class="font-bold text-gray-800">
                    {{ $products->total() }}</span> products
                </p>
                @if(request()->hasAny(['search','category','min_price','max_price']))
                <a href="{{ route('products.index') }}"
                    class="text-sm text-pink-custom font-bold hover:underline">
                    Clear All Filters ✕
                </a>
                @endif
            </div>

            {{-- Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
                @forelse($products as $product)
                <div class="product-card group">

                    {{-- Image --}}
                    <div class="relative overflow-hidden" style="height:200px;">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}"
                                 alt="{{ $product->name }}"
                                 class="w-full h-full object-cover
                                 group-hover:scale-110 transition-transform duration-500">
                        @else
                            <div class="w-full h-full flex items-center
                                justify-content:center text-5xl"
                                style="background:linear-gradient(135deg,#FFE8F3,#F3E8FF);
                                display:flex;align-items:center;justify-content:center;">
                                🛍️
                            </div>
                        @endif

                        {{-- Badges --}}
                        <div class="absolute top-3 left-3 flex flex-col gap-1">
                            @if($product->is_featured)
                            <span class="bg-yellow-custom text-yellow-900 text-xs
                                font-bold px-2 py-1 rounded-full">
                                ⭐ Featured
                            </span>
                            @endif
                            @if($product->is_new_arrival)
                            <span class="bg-green-custom text-white text-xs
                                font-bold px-2 py-1 rounded-full">
                                🆕 New
                            </span>
                            @endif
                            @if($product->sale_price)
                            <span class="bg-pink-custom text-white text-xs
                                font-bold px-2 py-1 rounded-full">
                                🔥 Sale
                            </span>
                            @endif
                        </div>
                    </div>

                    {{-- Info --}}
                    <div class="p-4">
                        <span class="text-xs font-bold text-purple-custom
                            uppercase tracking-wide">
                            {{ $product->category }}
                        </span>
                        <h3 class="font-bold text-gray-800 mt-1 mb-2 line-clamp-2
                            group-hover:text-pink-custom transition-colors">
                            <a href="{{ route('products.show', $product->slug) }}">
                                {{ $product->name }}
                            </a>
                        </h3>

                        {{-- Price --}}
                        <div class="flex items-center gap-2 mb-3">
                            @if($product->sale_price)
                                <span class="font-fredoka text-xl text-pink-custom">
                                    Rs. {{ number_format($product->sale_price) }}
                                </span>
                                <span class="text-gray-400 line-through text-sm">
                                    Rs. {{ number_format($product->price) }}
                                </span>
                            @else
                                <span class="font-fredoka text-xl text-pink-custom">
                                    Rs. {{ number_format($product->price) }}
                                </span>
                            @endif
                        </div>

                        {{-- Stock --}}
                        @if($product->stock <= 5 && $product->stock > 0)
                        <p class="text-xs text-orange-500 font-bold mb-2">
                            ⚠️ Only {{ $product->stock }} left!
                        </p>
                        @elseif($product->stock == 0)
                        <p class="text-xs text-red-500 font-bold mb-2">
                            ❌ Out of Stock
                        </p>
                        @endif

                        {{-- Buttons --}}
                        <div class="flex gap-2">
                            <a href="{{ route('products.show', $product->slug) }}"
                                class="btn-secondary text-center text-sm py-2 px-3 flex-1">
                                👁️ View
                            </a>
                            @if($product->stock > 0)
                            <form action="{{ route('cart.add') }}"
                                  method="POST" class="flex-1">
                                @csrf
                                <input type="hidden" name="product_id"
                                    value="{{ $product->id }}">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit"
                                    class="btn-primary w-full text-center
                                    text-sm py-2">
                                    🛒 Add
                                </button>
                            </form>
                            @else
                            <button disabled
                                class="flex-1 text-sm py-2 px-3 rounded-full
                                bg-gray-200 text-gray-400 font-bold cursor-not-allowed">
                                Sold Out
                            </button>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-3 text-center py-20">
                    <div class="text-6xl mb-4">😢</div>
                    <h3 class="font-fredoka text-2xl text-gray-600 mb-2">
                        No Products Found!
                    </h3>
                    <p class="text-gray-400 mb-6">
                        Try different filters or search terms.
                    </p>
                    <a href="{{ route('products.index') }}" class="btn-primary">
                        Clear Filters
                    </a>
                </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            @if($products->hasPages())
            <div class="mt-10 flex justify-center">
                {{ $products->withQueryString()->links() }}
            </div>
            @endif
        </div>
    </div>
</section>

@endsection

