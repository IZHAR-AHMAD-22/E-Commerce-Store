@extends('layouts.app')

@section('title', $product->name . ' - Thingy Store')

@section('content')

<section class="py-12 px-4 max-w-7xl mx-auto">

    {{-- Breadcrumb --}}
    <nav class="mb-8 text-sm text-gray-400">
        <a href="{{ route('home') }}"
            class="hover:text-pink-custom transition-colors">🏠 Home</a>
        <span class="mx-2">›</span>
        <a href="{{ route('products.index') }}"
            class="hover:text-pink-custom transition-colors">Products</a>
        <span class="mx-2">›</span>
        <span class="text-gray-600 font-bold">{{ $product->name }}</span>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-16">

        {{-- Product Images --}}
        <div>
            {{-- Main Image --}}
            <div class="rounded-2xl overflow-hidden mb-4 bg-white shadow-sm"
                style="height:400px;">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}"
                         alt="{{ $product->name }}"
                         id="main-image"
                         class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-content-center
                        text-8xl"
                        style="background:linear-gradient(135deg,#FFE8F3,#F3E8FF);
                        display:flex;align-items:center;justify-content:center;">
                        🛍️
                    </div>
                @endif
            </div>

            {{-- Gallery Thumbnails --}}
            @php $gallery = json_decode($product->gallery, true) ?? []; @endphp
            @if(count($gallery) > 0)
            <div class="flex gap-3 overflow-x-auto pb-2">
                @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}"
                     onclick="document.getElementById('main-image').src=this.src"
                     class="w-20 h-20 object-cover rounded-xl cursor-pointer
                     border-2 border-pink-custom flex-shrink-0">
                @endif
                @foreach($gallery as $img)
                <img src="{{ asset('storage/' . $img) }}"
                     onclick="document.getElementById('main-image').src=this.src"
                     class="w-20 h-20 object-cover rounded-xl cursor-pointer
                     border-2 border-transparent hover:border-pink-custom
                     flex-shrink-0 transition-all">
                @endforeach
            </div>
            @endif
        </div>

        {{-- Product Info --}}
        <div>
            {{-- Category + Badges --}}
            <div class="flex flex-wrap gap-2 mb-3">
                <span class="text-xs font-bold text-purple-custom
                    uppercase tracking-wide bg-purple-50 px-3 py-1 rounded-full">
                    {{ $product->category }}
                </span>
                @if($product->is_featured)
                <span class="bg-yellow-custom text-yellow-900 text-xs
                    font-bold px-3 py-1 rounded-full">⭐ Featured</span>
                @endif
                @if($product->is_new_arrival)
                <span class="bg-green-custom text-white text-xs
                    font-bold px-3 py-1 rounded-full">🆕 New Arrival</span>
                @endif
            </div>

            {{-- Name --}}
            <h1 class="font-fredoka text-4xl text-gray-800 mb-4 leading-tight">
                {{ $product->name }}
            </h1>

            {{-- Short Description --}}
            <p class="text-gray-500 text-lg mb-6 leading-relaxed">
                {{ $product->short_description }}
            </p>

            {{-- Price --}}
            <div class="flex items-center gap-4 mb-6">
                @if($product->sale_price)
                    <span class="font-fredoka text-4xl text-pink-custom">
                        Rs. {{ number_format($product->sale_price) }}
                    </span>
                    <span class="text-gray-400 line-through text-xl">
                        Rs. {{ number_format($product->price) }}
                    </span>
                    @php
                        $discount = round((($product->price - $product->sale_price)
                            / $product->price) * 100);
                    @endphp
                    <span class="bg-pink-custom text-white text-sm font-bold
                        px-3 py-1 rounded-full">
                        {{ $discount }}% OFF 🔥
                    </span>
                @else
                    <span class="font-fredoka text-4xl text-pink-custom">
                        Rs. {{ number_format($product->price) }}
                    </span>
                @endif
            </div>

            {{-- Stock Status --}}
            <div class="mb-6">
                @if($product->stock > 10)
                    <span class="text-green-600 font-bold text-sm">
                        ✅ In Stock ({{ $product->stock }} available)
                    </span>
                @elseif($product->stock > 0)
                    <span class="text-orange-500 font-bold text-sm">
                        ⚠️ Only {{ $product->stock }} left — Order soon!
                    </span>
                @else
                    <span class="text-red-500 font-bold text-sm">
                        ❌ Out of Stock
                    </span>
                @endif
            </div>

            {{-- Add to Cart Form --}}
            @if($product->stock > 0)
            <form action="{{ route('cart.add') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">

                {{-- Quantity Selector --}}
                <div class="flex items-center gap-4 mb-6">
                    <label class="font-bold text-gray-700">Quantity:</label>
                    <div class="flex items-center border-2 border-gray-200
                        rounded-xl overflow-hidden">
                        <button type="button"
                            onclick="changeQty(-1)"
                            class="px-4 py-2 text-lg font-bold text-gray-500
                            hover:bg-gray-100 transition-colors">−</button>
                        <input type="number"
                               name="quantity"
                               id="qty"
                               value="1"
                               min="1"
                               max="{{ $product->stock }}"
                               class="w-16 text-center py-2 font-bold
                               text-gray-800 border-none outline-none">
                        <button type="button"
                            onclick="changeQty(1)"
                            class="px-4 py-2 text-lg font-bold text-gray-500
                            hover:bg-gray-100 transition-colors">+</button>
                    </div>
                </div>

                <div class="flex gap-3">
                    <button type="submit"
                        class="btn-primary flex-1 text-center text-lg py-4">
                        🛒 Add to Cart
                    </button>
                    <a href="{{ route('cart.index') }}"
                        class="btn-secondary text-center text-lg py-4 px-6">
                        View Cart
                    </a>
                </div>
            </form>
            @else
            <button disabled
                class="w-full py-4 rounded-full bg-gray-200 text-gray-400
                font-bold text-lg cursor-not-allowed">
                ❌ Out of Stock
            </button>
            @endif

            {{-- Meta Info --}}
            <div class="mt-6 pt-6 border-t border-gray-100 grid grid-cols-2 gap-4">
                <div class="text-center p-3 rounded-xl" style="background:#FFE8F3;">
                    <div class="text-2xl mb-1">🚀</div>
                    <div class="text-xs font-bold text-gray-600">Fast Delivery</div>
                </div>
                <div class="text-center p-3 rounded-xl" style="background:#E8F8EA;">
                    <div class="text-2xl mb-1">🔄</div>
                    <div class="text-xs font-bold text-gray-600">Easy Returns</div>
                </div>
                <div class="text-center p-3 rounded-xl" style="background:#FFF8DC;">
                    <div class="text-2xl mb-1">💎</div>
                    <div class="text-xs font-bold text-gray-600">Premium Quality</div>
                </div>
                <div class="text-center p-3 rounded-xl" style="background:#F3E8FF;">
                    <div class="text-2xl mb-1">🔒</div>
                    <div class="text-xs font-bold text-gray-600">Secure Payment</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Full Description --}}
    <div class="bg-white rounded-2xl p-8 shadow-sm mb-16">
        <h2 class="font-fredoka text-3xl text-gray-800 mb-6">
            📋 Product Description
        </h2>
        <div class="text-gray-600 leading-relaxed text-lg">
            {!! nl2br(e($product->description)) !!}
        </div>
    </div>

    {{-- Related Products --}}
    @if($related->count() > 0)
    <div>
        <h2 class="font-fredoka text-3xl text-gray-800 mb-8">
            You Might Also Like 💖
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($related as $item)
            <div class="product-card group">
                <div class="relative overflow-hidden" style="height:180px;">
                    @if($item->image)
                        <img src="{{ asset('storage/' . $item->image) }}"
                             alt="{{ $item->name }}"
                             class="w-full h-full object-cover
                             group-hover:scale-110 transition-transform duration-500">
                    @else
                        <div class="w-full h-full flex items-center
                            justify-content-center text-5xl"
                            style="background:linear-gradient(135deg,#FFE8F3,#F3E8FF);
                            display:flex;align-items:center;justify-content:center;">
                            🛍️
                        </div>
                    @endif
                </div>
                <div class="p-4">
                    <h3 class="font-bold text-gray-800 mb-2 line-clamp-2
                        group-hover:text-pink-custom transition-colors text-sm">
                        <a href="{{ route('products.show', $item->slug) }}">
                            {{ $item->name }}
                        </a>
                    </h3>
                    <div class="flex items-center justify-between">
                        <span class="font-fredoka text-lg text-pink-custom">
                            Rs. {{ number_format($item->sale_price ?? $item->price) }}
                        </span>
                        <a href="{{ route('products.show', $item->slug) }}"
                            class="btn-secondary text-xs py-1 px-3">
                            View →
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

</section>

@endsection

@section('scripts')
<script>
function changeQty(change) {
    const input = document.getElementById('qty');
    const max = parseInt(input.getAttribute('max'));
    let val = parseInt(input.value) + change;
    if (val < 1) val = 1;
    if (val > max) val = max;
    input.value = val;
}
</script>
@endsection

