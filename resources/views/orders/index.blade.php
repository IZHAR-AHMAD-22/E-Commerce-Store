@extends('layouts.app')

@section('title', 'My Orders - Thingy Store')

@section('content')
<div class="min-h-screen bg-gray-50 py-16">
    <div class="container mx-auto px-4">
        <div class="max-w-5xl mx-auto bg-white rounded-3xl shadow-lg overflow-hidden">
            <div class="px-8 py-8 border-b border-gray-100">
                <h1 class="text-4xl font-bold text-gray-900">My Orders</h1>
                <p class="text-gray-600 mt-2">Track the progress of your purchases and view responses from the admin.</p>
            </div>
            <div class="p-8 space-y-6">
                @forelse($orders as $order)
                <a href="{{ route('orders.show', $order->id) }}" class="block rounded-3xl border border-gray-200 p-6 hover:border-pink-400 hover:shadow-lg transition duration-300">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div>
                            <p class="text-sm text-gray-500">Order #{{ $order->id }}</p>
                            <h2 class="text-2xl font-semibold text-gray-900">{{ ucfirst($order->status) }}</h2>
                        </div>
                        <div class="text-right">
                            <p class="text-gray-500">Placed on {{ $order->created_at->format('d M Y') }}</p>
                            <p class="text-xl font-semibold text-pink-custom">Rs. {{ number_format($order->final_amount) }}</p>
                        </div>
                    </div>
                    <div class="mt-4 flex flex-wrap gap-3 text-sm">
                        <span class="inline-flex items-center rounded-full bg-slate-100 px-3 py-1 text-slate-700">{{ $order->orderItems_count }} item(s)</span>
                        @if($order->admin_note)
                        <span class="inline-flex items-center rounded-full bg-yellow-100 px-3 py-1 text-yellow-800">Admin message available</span>
                        @endif
                        <span class="inline-flex items-center rounded-full bg-green-100 px-3 py-1 text-green-800">{{ ucfirst($order->status) }}</span>
                    </div>
                </a>
                @empty
                <div class="rounded-3xl border border-dashed border-gray-300 p-12 text-center text-gray-500">
                    <p class="text-xl font-semibold mb-4">No orders found yet.</p>
                    <p>Start shopping and place your first order today.</p>
                    <a href="{{ route('products.index') }}" class="mt-6 inline-block btn-primary">Shop Products</a>
                </div>
                @endforelse
            </div>
            <div class="px-8 py-6 border-t border-gray-100">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
