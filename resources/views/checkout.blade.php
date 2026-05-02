@extends('layouts.app')

@section('title', 'Checkout - Thingy Store')

@section('content')

<section class="py-12 px-4 max-w-6xl mx-auto">

    <div class="text-center mb-10">
        <h1 class="font-fredoka text-5xl text-gray-800 mb-3">
            Checkout 💳
        </h1>
        <p class="text-gray-500">Almost there! Fill in your details below.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- Checkout Form --}}
        <div class="lg:col-span-2">
            <form action="{{ route('checkout.store') }}" method="POST">
                @csrf

                {{-- Personal Info --}}
                <div class="bg-white rounded-2xl p-6 shadow-sm mb-6">
                    <h3 class="font-fredoka text-2xl text-gray-800 mb-5">
                        👤 Personal Information
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-bold text-gray-600 mb-2">
                                Full Name <span class="text-red-400">*</span>
                            </label>
                            <input type="text"
                                   name="customer_name"
                                   value="{{ old('customer_name',
                                       auth()->user()->name ?? '') }}"
                                   class="w-full border-2 border-gray-200 rounded-xl
                                   px-4 py-3 focus:outline-none focus:border-pink-400
                                   @error('customer_name') border-red-400 @enderror"
                                   placeholder="Your full name">
                            @error('customer_name')
                                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-600 mb-2">
                                Email <span class="text-red-400">*</span>
                            </label>
                            <input type="email"
                                   name="customer_email"
                                   value="{{ old('customer_email',
                                       auth()->user()->email ?? '') }}"
                                   class="w-full border-2 border-gray-200 rounded-xl
                                   px-4 py-3 focus:outline-none focus:border-pink-400
                                   @error('customer_email') border-red-400 @enderror"
                                   placeholder="your@email.com">
                            @error('customer_email')
                                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-600 mb-2">
                                Phone <span class="text-red-400">*</span>
                            </label>
                            <input type="text"
                                   name="customer_phone"
                                   value="{{ old('customer_phone',
                                       auth()->user()->phone ?? '') }}"
                                   class="w-full border-2 border-gray-200 rounded-xl
                                   px-4 py-3 focus:outline-none focus:border-pink-400
                                   @error('customer_phone') border-red-400 @enderror"
                                   placeholder="+92 300 1234567">
                            @error('customer_phone')
                                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-600 mb-2">
                                City <span class="text-red-400">*</span>
                            </label>
                            <input type="text"
                                   name="city"
                                   value="{{ old('city') }}"
                                   class="w-full border-2 border-gray-200 rounded-xl
                                   px-4 py-3 focus:outline-none focus:border-pink-400
                                   @error('city') border-red-400 @enderror"
                                   placeholder="Lahore, Karachi...">
                            @error('city')
                                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Shipping Info --}}
                <div class="bg-white rounded-2xl p-6 shadow-sm mb-6">
                    <h3 class="font-fredoka text-2xl text-gray-800 mb-5">
                        📍 Shipping Address
                    </h3>
                    <div>
                        <label class="block text-sm font-bold text-gray-600 mb-2">
                            Full Address <span class="text-red-400">*</span>
                        </label>
                        <textarea name="shipping_address"
                            rows="3"
                            class="w-full border-2 border-gray-200 rounded-xl
                            px-4 py-3 focus:outline-none focus:border-pink-400
                            @error('shipping_address') border-red-400 @enderror"
                            placeholder="House #, Street, Area...">{{ old('shipping_address', auth()->user()->address ?? '') }}</textarea>
                        @error('shipping_address')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Payment Method --}}
                <div class="bg-white rounded-2xl p-6 shadow-sm mb-6">
                    <h3 class="font-fredoka text-2xl text-gray-800 mb-5">
                        💳 Payment Method
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <label class="relative cursor-pointer">
                            <input type="radio" name="payment_method"
                                   value="cod" class="peer sr-only"
                                   {{ old('payment_method','cod') == 'cod' ? 'checked' : '' }}>
                            <div class="p-4 border-2 border-gray-200 rounded-xl
                                peer-checked:border-pink-custom
                                peer-checked:bg-pink-50 transition-all">
                                <div class="text-3xl mb-2">💵</div>
                                <div class="font-bold text-gray-800">
                                    Cash on Delivery
                                </div>
                                <div class="text-sm text-gray-500 mt-1">
                                    Pay when you receive your order
                                </div>
                            </div>
                        </label>
                        <label class="relative cursor-pointer">
                            <input type="radio" name="payment_method"
                                   value="bank_transfer" class="peer sr-only"
                                   {{ old('payment_method') == 'bank_transfer' ? 'checked' : '' }}>
                            <div class="p-4 border-2 border-gray-200 rounded-xl
                                peer-checked:border-pink-custom
                                peer-checked:bg-pink-50 transition-all">
                                <div class="text-3xl mb-2">🏦</div>
                                <div class="font-bold text-gray-800">
                                    Bank Transfer
                                </div>
                                <div class="text-sm text-gray-500 mt-1">
                                    Transfer to our bank account
                                </div>
                            </div>
                        </label>
                    </div>
                    @error('payment_method')
                        <p class="text-red-400 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Order Note --}}
                <div class="bg-white rounded-2xl p-6 shadow-sm mb-6">
                    <h3 class="font-fredoka text-2xl text-gray-800 mb-5">
                        📝 Order Note
                        <span class="text-gray-400 text-base font-normal">
                            (Optional)
                        </span>
                    </h3>
                    <textarea name="order_note"
                        rows="2"
                        class="w-full border-2 border-gray-200 rounded-xl
                        px-4 py-3 focus:outline-none focus:border-pink-400"
                        placeholder="Any special instructions...">{{ old('order_note') }}</textarea>
                </div>

                <button type="submit"
                    class="btn-primary w-full text-center text-xl py-5">
                    🎉 Place Order Now!
                </button>
            </form>
        </div>

        {{-- Order Summary --}}
        <div>
            <div class="bg-white rounded-2xl p-6 shadow-sm sticky top-20">
                <h3 class="font-fredoka text-2xl text-gray-800 mb-6">
                    Your Order 🛍️
                </h3>

                @php $total = 0; @endphp
                <div class="space-y-4 mb-6">
                    @foreach($cart as $item)
                    @php $total += $item['price'] * $item['quantity']; @endphp
                    <div class="flex gap-3 items-center">
                        @if($item['image'])
                            <img src="{{ asset('storage/' . $item['image']) }}"
                                 class="w-14 h-14 object-cover rounded-xl flex-shrink-0">
                        @else
                            <div class="w-14 h-14 rounded-xl flex-shrink-0 text-2xl
                                flex items-center justify-content:center"
                                style="background:#FFE8F3;display:flex;
                                align-items:center;justify-content:center;">
                                🛍️
                            </div>
                        @endif
                        <div class="flex-1 min-w-0">
                            <p class="font-bold text-gray-800 text-sm truncate">
                                {{ $item['name'] }}
                            </p>
                            <p class="text-gray-400 text-xs">
                                × {{ $item['quantity'] }}
                            </p>
                        </div>
                        <span class="font-bold text-gray-700 text-sm flex-shrink-0">
                            Rs. {{ number_format($item['price'] * $item['quantity']) }}
                        </span>
                    </div>
                    @endforeach
                </div>

                <div class="border-t border-gray-100 pt-4">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-gray-500 text-sm">Subtotal</span>
                        <span class="font-bold">
                            Rs. {{ number_format($total) }}
                        </span>
                    </div>
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-gray-500 text-sm">Delivery</span>
                        <span class="text-green-600 font-bold text-sm">
                            Calculated at delivery
                        </span>
                    </div>
                    <div class="flex justify-between items-center pt-3
                        border-t border-gray-100">
                        <span class="font-bold text-gray-800">Total</span>
                        <span class="font-fredoka text-2xl text-pink-custom">
                            Rs. {{ number_format($total) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

