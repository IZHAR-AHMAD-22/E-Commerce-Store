@extends('layouts.app')

@section('title', 'Track Your Order - Thingy Store')

@section('content')
<div class="min-h-screen bg-gray-50 py-12 px-4">
    <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md p-8">
        <h1 class="text-3xl font-bold text-center mb-8 text-gray-800">Track Your Order</h1>

        @if(!isset($order))
        <form action="{{ route('orders.showTrack') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label for="order_id" class="block text-sm font-medium text-gray-700">Order Number</label>
                <input type="number" name="order_id" id="order_id" required
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-pink-500 focus:border-pink-500">
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                <input type="email" name="email" id="email" required
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-pink-500 focus:border-pink-500">
            </div>
            <button type="submit" class="w-full bg-pink-600 hover:bg-pink-700 text-white font-bold py-2 px-4 rounded-md transition duration-300">
                Track Order
            </button>
        </form>
        @else
        <div class="space-y-6">
            <div class="text-center">
                <h2 class="text-2xl font-bold text-gray-800">Order #{{ $order->id }}</h2>
                <p class="text-gray-600">Status: <span class="font-semibold {{ $order->status == 'delivered' ? 'text-green-600' : 'text-blue-600' }}">{{ ucfirst($order->status) }}</span></p>
            </div>

            <div class="border-t pt-6">
                <h3 class="text-lg font-semibold mb-4">Order Details</h3>
                <div class="space-y-2">
                    <p><strong>Customer:</strong> {{ $order->customer_name }}</p>
                    <p><strong>Email:</strong> {{ $order->customer_email }}</p>
                    <p><strong>Phone:</strong> {{ $order->customer_phone }}</p>
                    <p><strong>Shipping Address:</strong> {{ $order->shipping_address }}, {{ $order->city }}</p>
                    <p><strong>Payment Method:</strong> {{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}</p>
                    <p><strong>Total Amount:</strong> ${{ number_format($order->final_amount, 2) }}</p>
                    @if($order->order_note)
                    <p><strong>Order Note:</strong> {{ $order->order_note }}</p>
                    @endif
                </div>
            </div>

            <div class="border-t pt-6">
                <h3 class="text-lg font-semibold mb-4">Order Items</h3>
                <div class="space-y-4">
                    @foreach($order->orderItems as $item)
                    <div class="flex items-center space-x-4">
                        <img src="{{ $item->product_image ? asset('storage/' . $item->product_image) : asset('images/placeholder.jpg') }}" alt="{{ $item->product_name }}" class="w-16 h-16 object-cover rounded">
                        <div class="flex-1">
                            <h4 class="font-semibold">{{ $item->product_name }}</h4>
                            <p class="text-sm text-gray-600">Quantity: {{ $item->quantity }} | Price: ${{ number_format($item->unit_price, 2) }}</p>
                        </div>
                        <p class="font-semibold">${{ number_format($item->subtotal, 2) }}</p>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="text-center">
                <a href="{{ route('home') }}" class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-6 rounded-md transition duration-300">
                    Continue Shopping
                </a>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection