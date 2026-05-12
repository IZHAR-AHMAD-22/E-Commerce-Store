@extends('layouts.app')

@section('title', 'Order #' . $order->id . ' - Thingy Store')

@section('content')
<div class="min-h-screen bg-gray-50 py-16">
    <div class="container mx-auto px-4">
        <div class="max-w-5xl mx-auto space-y-6">
            <div class="bg-white rounded-3xl shadow-lg overflow-hidden">
                <div class="px-8 py-8 border-b border-gray-100">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div>
                            <p class="text-sm text-gray-500">Order #{{ $order->id }}</p>
                            <h1 class="text-4xl font-bold text-gray-900">Order Progress</h1>
                        </div>
                        <div class="text-right">
                            <span class="inline-flex items-center rounded-full bg-slate-100 px-4 py-2 text-slate-700 text-sm">{{ ucfirst($order->status) }}</span>
                        </div>
                    </div>
                    <p class="mt-4 text-gray-600">You can check order status and admin replies here.</p>
                </div>
                <div class="p-8 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="rounded-3xl bg-slate-50 p-6 border border-gray-200">
                            <p class="text-sm text-gray-500 mb-2">Customer</p>
                            <p class="font-semibold text-gray-900">{{ $order->customer_name }}</p>
                            <p class="text-gray-600">{{ $order->customer_email }}</p>
                            <p class="text-gray-600">{{ $order->customer_phone }}</p>
                        </div>
                        <div class="rounded-3xl bg-slate-50 p-6 border border-gray-200">
                            <p class="text-sm text-gray-500 mb-2">Delivery</p>
                            <p class="font-semibold text-gray-900">{{ $order->city }}</p>
                            <p class="text-gray-600">{{ $order->shipping_address }}</p>
                            <p class="text-gray-600 mt-3">Payment: {{ $order->payment_method == 'cod' ? 'Cash on Delivery' : 'Bank Transfer' }}</p>
                        </div>
                    </div>

                    <div class="rounded-3xl bg-white p-6 border border-gray-200">
                        <h2 class="text-xl font-semibold text-gray-900 mb-4">Order Items</h2>
                        <div class="space-y-4">
                            @foreach($order->orderItems as $item)
                            <div class="flex items-center justify-between gap-4 p-4 rounded-3xl bg-slate-50">
                                <div class="flex items-center gap-4">
                                    @if($item->product_image)
                                    <img src="{{ asset('storage/' . $item->product_image) }}" class="w-16 h-16 object-cover rounded-2xl">
                                    @else
                                    <div class="w-16 h-16 rounded-2xl bg-gray-200 flex items-center justify-center">🛍️</div>
                                    @endif
                                    <div>
                                        <p class="font-semibold text-gray-900">{{ $item->product_name }}</p>
                                        <p class="text-sm text-gray-500">Qty: {{ $item->quantity }}</p>
                                    </div>
                                </div>
                                <p class="font-semibold text-gray-900">Rs. {{ number_format($item->subtotal) }}</p>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="rounded-3xl bg-slate-50 p-6 border border-gray-200">
                        <div class="flex items-center justify-between gap-4 mb-4">
                            <p class="text-gray-600">Subtotal</p>
                            <p class="font-semibold text-gray-900">Rs. {{ number_format($order->total_amount) }}</p>
                        </div>
                        @if($order->discount_amount > 0)
                        <div class="flex items-center justify-between gap-4 mb-4">
                            <p class="text-gray-600">Discount</p>
                            <p class="font-semibold text-green-700">- Rs. {{ number_format($order->discount_amount) }}</p>
                        </div>
                        @endif
                        <div class="flex items-center justify-between gap-4 text-lg font-semibold text-gray-900">
                            <p>Total</p>
                            <p>Rs. {{ number_format($order->final_amount) }}</p>
                        </div>
                    </div>

                    <div class="rounded-3xl bg-white p-6 border border-gray-200">
                        <h2 class="text-xl font-semibold text-gray-900 mb-4">Admin Response</h2>
                        @if($order->admin_note)
                        <p class="text-gray-700 leading-relaxed">{{ $order->admin_note }}</p>
                        @else
                        <p class="text-gray-500">The admin has not added a message yet. Please check back later for updates.</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="text-center">
                <a href="{{ route('orders.index') }}" class="inline-block btn-primary px-10 py-4">Back to My Orders</a>
            </div>
        </div>
    </div>
</div>
@endsection
