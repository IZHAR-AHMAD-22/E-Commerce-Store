@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Page Header -->
    <div class="bg-white shadow-sm">
        <div class="container mx-auto px-4 py-6">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">Our Products</h1>
                    <p class="text-gray-600 mt-2">Discover amazing products at great prices</p>
                </div>
                <div class="mt-4 md:mt-0">
                    <div class="flex flex-col sm:flex-row gap-4">
                        <!-- Search -->
                        <div class="relative">
                            <input type="text" placeholder="Search products..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-transparent" id="searchInput">
                            <svg class="absolute left-3 top-2.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <!-- Sort -->
                        <select class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-transparent" id="sortSelect">
                            <option value="name">Sort by Name</option>
                            <option value="price-low">Price: Low to High</option>
                            <option value="price-high">Price: High to Low</option>
                            <option value="newest">Newest First</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Sidebar Filters -->
            <div class="lg:w-1/4">
                <div class="bg-white rounded-lg shadow-md p-6 sticky top-4">
                    <h3 class="text-lg font-semibold mb-4 text-gray-800">Filters</h3>

                    <!-- Price Range -->
                    <div class="mb-6">
                        <h4 class="font-medium mb-3 text-gray-700">Price Range</h4>
                        <div class="space-y-2">
                            <input type="range" min="0" max="1000" value="1000" class="w-full" id="priceRange">
                            <div class="flex justify-between text-sm text-gray-600">
                                <span>$0</span>
                                <span id="priceValue">$1000</span>
                            </div>
                        </div>
                    </div>

                    <!-- Categories -->
                    <div class="mb-6">
                        <h4 class="font-medium mb-3 text-gray-700">Categories</h4>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded border-gray-300 text-pink-600 focus:ring-pink-500" checked>
                                <span class="ml-2 text-sm text-gray-700">All Categories</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded border-gray-300 text-pink-600 focus:ring-pink-500">
                                <span class="ml-2 text-sm text-gray-700">Electronics</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded border-gray-300 text-pink-600 focus:ring-pink-500">
                                <span class="ml-2 text-sm text-gray-700">Fashion</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded border-gray-300 text-pink-600 focus:ring-pink-500">
                                <span class="ml-2 text-sm text-gray-700">Home & Garden</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded border-gray-300 text-pink-600 focus:ring-pink-500">
                                <span class="ml-2 text-sm text-gray-700">Books</span>
                            </label>
                        </div>
                    </div>

                    <!-- Availability -->
                    <div class="mb-6">
                        <h4 class="font-medium mb-3 text-gray-700">Availability</h4>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded border-gray-300 text-pink-600 focus:ring-pink-500" checked>
                                <span class="ml-2 text-sm text-gray-700">In Stock</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded border-gray-300 text-pink-600 focus:ring-pink-500">
                                <span class="ml-2 text-sm text-gray-700">On Sale</span>
                            </label>
                        </div>
                    </div>

                    <button class="w-full bg-pink-500 hover:bg-pink-600 text-white font-medium py-2 px-4 rounded-lg transition duration-300">
                        Apply Filters
                    </button>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="lg:w-3/4">
                <!-- Results Info -->
                <div class="flex justify-between items-center mb-6">
                    <p class="text-gray-600">Showing <span id="productCount">{{ $products->count() }}</span> products</p>
                    <div class="flex gap-2">
                        <button class="p-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition duration-300" id="gridView">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                            </svg>
                        </button>
                        <button class="p-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition duration-300" id="listView">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Products -->
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6" id="productsGrid">
                    @forelse($products as $product)
                    <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition duration-300 overflow-hidden group product-card relative">
                        <a href="{{ route('products.show', $product->slug) }}" class="absolute inset-0 z-10" aria-label="View {{ $product->name }}"></a>
                        <div class="relative z-20 overflow-hidden">
                            <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/placeholder.jpg') }}"
                                 alt="{{ $product->name }}"
                                 class="w-full h-48 object-cover group-hover:scale-105 transition duration-300">
                            @if($product->discount > 0)
                            <div class="absolute top-2 right-2 bg-red-500 text-white px-2 py-1 rounded-full text-sm font-bold">
                                -{{ $product->discount }}%
                            </div>
                            @endif
                            @if($product->is_featured)
                            <div class="absolute top-2 left-2 bg-yellow-500 text-white px-2 py-1 rounded-full text-sm font-bold">
                                Featured
                            </div>
                            @endif
                        </div>
                        <div class="p-4 relative z-20">
                            <h3 class="font-semibold text-lg mb-2 text-gray-800 hover:text-pink-600 transition duration-300">
                                <a href="{{ route('products.show', $product->slug) }}">{{ $product->name }}</a>
                            </h3>
                            <p class="text-gray-600 text-sm mb-2 line-clamp-2">{{ Str::limit($product->description, 80) }}</p>
                            <div class="flex items-center justify-between mb-3">
                                <div class="flex items-center space-x-2">
                                    @if($product->discount > 0)
                                    <span class="text-gray-500 line-through">${{ number_format($product->price, 2) }}</span>
                                    <span class="text-green-600 font-bold text-lg">${{ number_format($product->price * (1 - $product->discount / 100), 2) }}</span>
                                    @else
                                    <span class="text-gray-800 font-bold text-lg">${{ number_format($product->price, 2) }}</span>
                                    @endif
                                </div>
                                <div class="flex items-center">
                                    <div class="flex text-yellow-400">
                                        @for($i = 1; $i <= 5; $i++)
                                        <svg class="w-4 h-4 {{ $i <= 4 ? 'fill-current' : 'text-gray-300' }}" viewBox="0 0 24 24">
                                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                        </svg>
                                        @endfor
                                    </div>
                                    <span class="text-sm text-gray-600 ml-1">(4.0)</span>
                                </div>
                            </div>
                            <div class="flex gap-2">
                                <form action="{{ route('cart.add') }}" method="POST" class="flex-1">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="relative z-20 w-full bg-pink-500 hover:bg-pink-600 text-white font-medium py-2 px-4 rounded-lg transition duration-300 transform hover:scale-105">
                                        Add to Cart
                                    </button>
                                </form>
                                <button class="relative z-20 p-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition duration-300 wishlist-btn" data-product-id="{{ $product->id }}">
                                    <svg class="w-5 h-5 text-gray-600 hover:text-red-500 transition duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-full text-center py-12">
                        <div class="w-24 h-24 bg-gray-100 rounded-full mx-auto mb-4 flex items-center justify-center">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">No products found</h3>
                        <p class="text-gray-600 mb-4">Try adjusting your filters or search terms.</p>
                        <button class="bg-pink-500 hover:bg-pink-600 text-white font-medium py-2 px-6 rounded-lg transition duration-300">
                            Clear Filters
                        </button>
                    </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                @if($products->hasPages())
                <div class="mt-8">
                    {{ $products->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.product-card:hover {
    transform: translateY(-2px);
}
</style>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Price range slider
    const priceRange = document.getElementById('priceRange');
    const priceValue = document.getElementById('priceValue');

    priceRange.addEventListener('input', function() {
        priceValue.textContent = '$' + this.value;
    });

    // Search functionality
    const searchInput = document.getElementById('searchInput');
    let searchTimeout;

    searchInput.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            // Implement search logic here
            console.log('Searching for:', this.value);
        }, 300);
    });

    // Sort functionality
    const sortSelect = document.getElementById('sortSelect');

    sortSelect.addEventListener('change', function() {
        // Implement sort logic here
        console.log('Sorting by:', this.value);
    });

    // Wishlist functionality
    document.querySelectorAll('.wishlist-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const productId = this.dataset.productId;
            // Implement wishlist logic here
            this.classList.toggle('text-red-500');
            console.log('Toggled wishlist for product:', productId);
        });
    });

    // View toggle (grid/list)
    const gridView = document.getElementById('gridView');
    const listView = document.getElementById('listView');
    const productsGrid = document.getElementById('productsGrid');

    gridView.addEventListener('click', function() {
        productsGrid.className = 'grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6';
        gridView.classList.add('bg-pink-100', 'border-pink-500');
        listView.classList.remove('bg-pink-100', 'border-pink-500');
    });

    listView.addEventListener('click', function() {
        productsGrid.className = 'space-y-4';
        listView.classList.add('bg-pink-100', 'border-pink-500');
        gridView.classList.remove('bg-pink-100', 'border-pink-500');
    });
});
</script>
@endsection