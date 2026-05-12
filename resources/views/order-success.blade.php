@extends('layouts.app')

@section('title', 'Order Placed! - Thingy Store')

@section('content')

<section class="py-20 px-4 max-w-3xl mx-auto text-center">

    {{-- Success Animation --}}
    <div class="mb-8">
        <div class="text-9xl mb-4 animate-bounce inline-block">🎉</div>
        <h1 class="font-fredoka text-5xl text-gray-800 mb-4">
            Order Placed Successfully!
        </h1>
        <p class="text-gray-500 text-xl leading-relaxed">
            Woohoo! Your thingies are on their way! 🚀<br>
            We'll contact you soon to confirm your order.
        </p>
    </div>

    {{-- Order Details Card --}}
    <div class="bg-white rounded-2xl p-8 shadow-sm mb-8 text-left">

        {{-- Order Header --}}
        <div class="flex justify-between items-center mb-6 pb-6
            border-b border-gray-100">
            <div>
                <p class="text-gray-400 text-sm">Order Number</p>
                <h2 class="font-fredoka text-3xl text-pink-custom">
                    #{{ $order->id }}
                </h2>
            </div>
            <div class="text-right">
                <p class="text-gray-400 text-sm">Date</p>
                <p class="font-bold text-gray-800">
                    {{ $order->created_at->format('d M Y') }}
                </p>
            </div>
        </div>

        {{-- Order Items --}}
        <h3 class="font-fredoka text-xl text-gray-700 mb-4">Items Ordered</h3>
        <div class="space-y-3 mb-6">
            @foreach($order->orderItems as $item)
            <div class="flex justify-between items-center py-2
                border-b border-gray-50">
                <div class="flex items-center gap-3">
                    @if($item->product_image)
                        <img src="{{ asset('storage/' . $item->product_image) }}"
                             class="w-12 h-12 object-cover rounded-xl">
                    @else
                        <div class="w-12 h-12 rounded-xl text-xl flex items-center
                            justify-content:center"
                            style="background:#FFE8F3;display:flex;
                            align-items:center;justify-content:center;">
                            🛍️
                        </div>
                    @endif
                    <div>
                        <p class="font-bold text-gray-800 text-sm">
                            {{ $item->product_name }}
                        </p>
                        <p class="text-gray-400 text-xs">
                            × {{ $item->quantity }}
                        </p>
                    </div>
                </div>
                <span class="font-bold text-gray-700">
                    Rs. {{ number_format($item->subtotal) }}
                </span>
            </div>
            @endforeach
        </div>

        {{-- Total --}}
        <div class="flex justify-between items-center pt-2">
            <span class="font-bold text-gray-800 text-lg">Total Paid</span>
            <span class="font-fredoka text-3xl text-pink-custom">
                Rs. {{ number_format($order->final_amount) }}
            </span>
        </div>

        {{-- Delivery Info --}}
        <div class="mt-6 p-4 rounded-xl" style="background:#F0FFF4;">
            <p class="font-bold text-green-700 mb-1">📦 Delivery Details</p>
            <p class="text-green-600 text-sm">
                {{ $order->customer_name }} — {{ $order->customer_phone }}
            </p>
            <p class="text-green-600 text-sm">
                {{ $order->shipping_address }}, {{ $order->city }}
            </p>
            <p class="text-green-600 text-sm mt-1">
                💳 {{ $order->payment_method == 'cod'
                    ? 'Cash on Delivery'
                    : 'Bank Transfer' }}
            </p>
        </div>
    </div>

    {{-- Action Buttons --}}
    <div class="flex flex-wrap justify-center gap-4">
        <a href="{{ route('products.index') }}" class="btn-primary text-lg px-8 py-4">
            🛍️ Continue Shopping
        </a>
        <a href="{{ route('home') }}" class="btn-secondary text-lg px-8 py-4">
            🏠 Go Home
        </a>
        @auth
        <a href="{{ route('orders.show', $order->id) }}" class="btn-secondary text-lg px-8 py-4">
            📦 Track Order
        </a>
        @endauth
    </div>
    @guest
    <p class="text-center text-gray-500 mt-6">
        Log in to view more details and track this order from your account.
    </p>
    @endguest
</section>

@endsection

