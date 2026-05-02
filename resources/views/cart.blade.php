@extends('layouts.app')

@section('title', 'My Cart - Thingy Store')

@section('content')

<section class="py-12 px-4 max-w-7xl mx-auto">

    <div class="text-center mb-10">
        <h1 class="font-fredoka text-5xl text-gray-800 mb-3">
            My Cart 🛒
        </h1>
        <p class="text-gray-500">Review your items before checkout!</p>
    </div>

    @if(count($cart) > 0)
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- Cart Items --}}
        <div class="lg:col-span-2 space-y-4">
            @foreach($cart as $id => $item)
            <div class="bg-white rounded-2xl p-5 shadow-sm flex gap-4
                items-center">

                {{-- Image --}}
                <div class="flex-shrink-0">
                    @if($item['image'])
                        <img src="{{ asset('storage/' . $item['image']) }}"
                             alt="{{ $item['name'] }}"
                             class="w-24 h-24 object-cover rounded-xl">
                    @else
                        <div class="w-24 h-24 rounded-xl flex items-center
                            justify-content:center text-4xl"
                            style="background:#FFE8F3;display:flex;
                            align-items:center;justify-content:center;">
                            🛍️
                        </div>
                    @endif
                </div>

                {{-- Info --}}
                <div class="flex-1 min-w-0">
                    <h3 class="font-bold text-gray-800 mb-1 truncate">
                        {{ $item['name'] }}
                    </h3>
                    <p class="text-pink-custom font-fredoka text-lg">
                        Rs. {{ number_format($item['price']) }}
                    </p>

                    {{-- Quantity Update --}}
                    <form action="{{ route('cart.update') }}"
                          method="POST"
                          class="flex items-center gap-2 mt-2">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $id }}">
                        <div class="flex items-center border-2 border-gray-200
                            rounded-xl overflow-hidden">
                            <button type="button"
                                onclick="this.nextElementSibling.value=
                                    Math.max(1,parseInt(this.nextElementSibling.value)-1)"
                                class="px-3 py-1 text-gray-500 hover:bg-gray-100
                                font-bold">−</button>
                            <input type="number"
                                   name="quantity"
                                   value="{{ $item['quantity'] }}"
                                   min="1"
                                   class="w-12 text-center py-1 font-bold
                                   border-none outline-none text-sm">
                            <button type="button"
                                onclick="this.previousElementSibling.value=
                                    parseInt(this.previousElementSibling.value)+1"
                                class="px-3 py-1 text-gray-500 hover:bg-gray-100
                                font-bold">+</button>
                        </div>
                        <button type="submit"
                            class="text-xs bg-gray-100 hover:bg-gray-200
                            text-gray-600 font-bold px-3 py-2 rounded-xl
                            transition-colors">
                            Update
                        </button>
                    </form>
                </div>

                {{-- Subtotal + Remove --}}
                <div class="text-right flex-shrink-0">
                    <p class="font-fredoka text-xl text-gray-800 mb-2">
                        Rs. {{ number_format($item['price'] * $item['quantity']) }}
                    </p>
                    <form action="{{ route('cart.remove') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $id }}">
                        <button type="submit"
                            class="text-red-400 hover:text-red-600 text-xs
                            font-bold transition-colors">
                            🗑️ Remove
                        </button>
                    </form>
                </div>
            </div>
            @endforeach

            {{-- Clear Cart --}}
            <div class="text-right">
                <form action="{{ route('cart.clear') }}" method="POST"
                    onsubmit="return confirm('Clear entire cart?')">
                    @csrf
                    <button type="submit"
                        class="text-sm text-red-400 hover:text-red-600
                        font-bold transition-colors">
                        🗑️ Clear Entire Cart
                    </button>
                </form>
            </div>
        </div>

        {{-- Order Summary --}}
        <div>
            <div class="bg-white rounded-2xl p-6 shadow-sm sticky top-20">
                <h3 class="font-fredoka text-2xl text-gray-800 mb-6">
                    Order Summary 📋
                </h3>

                {{-- Items --}}
                <div class="space-y-3 mb-6">
                    @php $total = 0; @endphp
                    @foreach($cart as $item)
                    @php $total += $item['price'] * $item['quantity']; @endphp
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500 truncate mr-2">
                            {{ $item['name'] }}
                            <span class="text-gray-400">×{{ $item['quantity'] }}</span>
                        </span>
                        <span class="font-bold text-gray-700 flex-shrink-0">
                            Rs. {{ number_format($item['price'] * $item['quantity']) }}
                        </span>
                    </div>
                    @endforeach
                </div>

                <div class="border-t border-gray-100 pt-4 mb-6">
                    <div class="flex justify-between items-center">
                        <span class="font-bold text-gray-700">Total</span>
                        <span class="font-fredoka text-2xl text-pink-custom">
                            Rs. {{ number_format($total) }}
                        </span>
                    </div>
                    <p class="text-xs text-gray-400 mt-1">
                        + Delivery charges may apply
                    </p>
                </div>

                <a href="{{ route('checkout.index') }}"
                    class="btn-primary w-full text-center block text-lg py-4">
                    Proceed to Checkout →
                </a>

                <a href="{{ route('products.index') }}"
                    class="block text-center text-sm text-gray-400
                    hover:text-pink-custom mt-4 transition-colors">
                    ← Continue Shopping
                </a>
            </div>
        </div>
    </div>

    @else
    {{-- Empty Cart --}}
    <div class="text-center py-24">
        <div class="text-8xl mb-6">🛒</div>
        <h2 class="font-fredoka text-4xl text-gray-600 mb-4">
            Your Cart is Empty!
        </h2>
        <p class="text-gray-400 text-lg mb-8">
            Looks like you haven't added any thingies yet! 😢
        </p>
        <a href="{{ route('products.index') }}" class="btn-primary text-lg px-10 py-4">
            🛍️ Start Shopping
        </a>
    </div>
    @endif

</section>

@endsection

