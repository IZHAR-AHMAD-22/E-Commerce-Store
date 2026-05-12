@extends('layouts.app')

@section('content')
<div class="min-h-screen">
    <!-- Hero Section -->
    <section class="relative bg-black text-white py-20 overflow-hidden">
        <div class="absolute inset-0 bg-slate-900 opacity-90"></div>
        <div class="relative container mx-auto px-4 text-center">
            <h1 class="text-5xl md:text-7xl font-bold mb-6 animate-bounce">
                Welcome to <span class="text-gold">Thingy Store</span>
            </h1>
            <p class="text-xl md:text-2xl mb-8 max-w-3xl mx-auto text-slate-200">
                Discover products in a crisp black-and-white storefront with rich golden highlights.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('products.index') }}" class="bg-gold hover:bg-accent-dark text-black font-bold py-3 px-8 rounded-full transition duration-300 transform hover:scale-105">
                    Shop Now
                </a>
                <a href="#featured" class="border-2 border-white hover:bg-white hover:text-black font-bold py-3 px-8 rounded-full transition duration-300">
                    Learn More
                </a>
            </div>
        </div>
        <!-- Floating Elements -->
        <div class="absolute top-10 left-10 animate-float">
            <div class="w-16 h-16 bg-slate-700 rounded-full opacity-70"></div>
        </div>
        <div class="absolute bottom-10 right-10 animate-float-delayed">
            <div class="w-12 h-12 bg-slate-600 rounded-full opacity-70"></div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-12 text-gray-800">Shop by Category</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition duration-300 p-6 text-center group">
                    <div class="w-16 h-16 bg-pink-100 rounded-full mx-auto mb-4 flex items-center justify-center group-hover:bg-pink-200 transition duration-300">
                        <svg class="w-8 h-8 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-800">Electronics</h3>
                </div>
                <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition duration-300 p-6 text-center group">
                    <div class="w-16 h-16 bg-purple-100 rounded-full mx-auto mb-4 flex items-center justify-center group-hover:bg-purple-200 transition duration-300">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-800">Fashion</h3>
                </div>
                <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition duration-300 p-6 text-center group">
                    <div class="w-16 h-16 bg-green-100 rounded-full mx-auto mb-4 flex items-center justify-center group-hover:bg-green-200 transition duration-300">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-800">Dashboard & Garden</h3>
                </div>
                <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition duration-300 p-6 text-center group">
                    <div class="w-16 h-16 bg-yellow-100 rounded-full mx-auto mb-4 flex items-center justify-center group-hover:bg-yellow-200 transition duration-300">
                        <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-800">Books</h3>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Products Section -->
    <section id="featured" class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-12 text-gray-800">Featured Products</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @forelse($products ?? [] as $product)
                <a href="{{ route('products.show', $product->slug) }}" class="block bg-white rounded-lg shadow-md hover:shadow-lg transition duration-300 overflow-hidden group">
                    <div class="relative overflow-hidden">
                        <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/placeholder.jpg') }}" alt="{{ $product->name }}" class="w-full h-48 object-cover group-hover:scale-105 transition duration-300">
                        @if(count($product->gallery ?? []) > 0)
                        <img src="{{ asset('storage/' . $product->gallery[0]) }}" alt="{{ $product->name }}" class="absolute inset-0 w-full h-48 object-cover opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        @endif
                        @if($product->discount > 0)
                        <div class="absolute top-2 right-2 bg-red-500 text-white px-2 py-1 rounded-full text-sm font-bold">
                            -{{ $product->discount }}%
                        </div>
                        @endif
                    </div>
                    <div class="p-4">
                        <h3 class="font-semibold text-lg mb-2 text-gray-800">{{ $product->name }}</h3>
                        <p class="text-gray-600 text-sm mb-2">{{ Str::limit($product->description, 50) }}</p>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-2">
                                @if($product->discount > 0)
                                <span class="text-gray-500 line-through">${{ number_format($product->price, 2) }}</span>
                                <span class="text-green-600 font-bold">${{ number_format($product->price * (1 - $product->discount / 100), 2) }}</span>
                                @else
                                <span class="text-gray-800 font-bold">${{ number_format($product->price, 2) }}</span>
                                @endif
                            </div>
                            <form action="{{ route('cart.add') }}" method="POST" class="inline">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="bg-pink-500 hover:bg-pink-600 text-white px-4 py-2 rounded-full transition duration-300 transform hover:scale-105">
                                    Add to Cart
                                </button>
                            </form>
                        </div>
                    </div>
                </a>
                @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-gray-500 text-lg">No featured products available at the moment.</p>
                </div>
                @endforelse
            </div>
            <div class="text-center mt-8">
                <a href="{{ route('products.index') }}" class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-3 px-8 rounded-full transition duration-300 transform hover:scale-105">
                    View All Products
                </a>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="py-16 bg-gradient-to-r from-pink-100 to-purple-100">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-12 text-gray-800">Why Choose Thingy Store?</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="w-20 h-20 bg-pink-500 rounded-full mx-auto mb-4 flex items-center justify-center">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2 text-gray-800">Fast Delivery</h3>
                    <p class="text-gray-600">Get your orders delivered quickly and safely to your doorstep.</p>
                </div>
                <div class="text-center">
                    <div class="w-20 h-20 bg-purple-500 rounded-full mx-auto mb-4 flex items-center justify-center">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2 text-gray-800">Quality Guarantee</h3>
                    <p class="text-gray-600">All our products come with a quality guarantee and satisfaction promise.</p>
                </div>
                <div class="text-center">
                    <div class="w-20 h-20 bg-green-500 rounded-full mx-auto mb-4 flex items-center justify-center">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2 text-gray-800">24/7 Support</h3>
                    <p class="text-gray-600">Our customer support team is always ready to help you with any questions.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="py-16 bg-gray-800 text-white">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-6">Stay Updated</h2>
            <p class="text-xl mb-8 max-w-2xl mx-auto">
                Subscribe to our newsletter and be the first to know about new products, exclusive deals, and special offers.
            </p>
            <form class="max-w-md mx-auto flex flex-col sm:flex-row gap-4">
                <input type="email" placeholder="Enter your email" class="flex-1 px-4 py-3 rounded-full text-gray-800 focus:outline-none focus:ring-2 focus:ring-pink-500">
                <button type="submit" class="bg-pink-500 hover:bg-pink-600 px-8 py-3 rounded-full font-bold transition duration-300 transform hover:scale-105">
                    Subscribe
                </button>
            </form>
        </div>
    </section>
</div>
@endsection

@section('styles')
<style>
@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-20px); }
}

@keyframes float-delayed {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-15px); }
}

.animate-float {
    animation: float 3s ease-in-out infinite;
}

.animate-float-delayed {
    animation: float-delayed 4s ease-in-out infinite;
    animation-delay: 1s;
}
</style>
@endsection