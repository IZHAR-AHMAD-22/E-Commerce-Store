<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Thingy Store') 🛍️</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        :root {
            --bg-surface: #ffffff;
            --bg-muted: #f4f4f4;
            --text-default: #111111;
            --text-muted: #6b7280;
            --accent: #bfa64a;
            --accent-dark: #9c7a1d;
            --header-bg: #000000;
            --header-text: #ffffff;
            --border: #d1d5db;
        }

        body {
            font-family: 'Nunito', sans-serif;
            background-color: var(--bg-muted);
            color: var(--text-default);
        }

        .font-fredoka { font-family: 'Fredoka One', cursive; }
        .bg-pink-custom,
        .bg-yellow-custom,
        .bg-green-custom,
        .bg-purple-custom,
        .bg-pink-500,
        .bg-purple-600,
        .bg-green-500,
        .bg-yellow-300,
        .bg-yellow-400,
        .bg-yellow-500,
        .bg-yellow-600,
        .bg-yellow-700,
        .bg-red-500,
        .bg-purple-500,
        .bg-green-600,
        .bg-green-300 {
            background-color: var(--accent) !important;
            color: #111 !important;
        }
        .hover\:bg-pink-600:hover,
        .hover\:bg-purple-700:hover,
        .hover\:bg-pink-500:hover,
        .hover\:bg-green-600:hover,
        .hover\:bg-yellow-500:hover,
        .hover\:bg-yellow-600:hover,
        .hover\:bg-yellow-700:hover,
        .hover\:bg-green-500:hover {
            background-color: var(--accent-dark) !important;
        }
        .bg-pink-100,
        .bg-pink-200,
        .bg-purple-100,
        .bg-purple-200,
        .bg-green-100,
        .bg-green-200,
        .bg-yellow-100,
        .bg-yellow-200,
        .bg-yellow-300,
        .bg-slate-100 {
            background-color: #f5f5f5 !important;
        }
        .text-pink-custom,
        .text-yellow-custom,
        .text-green-custom,
        .text-purple-custom,
        .text-pink-600,
        .text-purple-600,
        .text-green-600,
        .text-yellow-300,
        .text-yellow-600 {
            color: var(--accent) !important;
        }
        .border-pink-custom,
        .border-pink-500 {
            border-color: var(--accent) !important;
        }
        .product-card {
            background: var(--bg-surface);
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        }
        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }
        .navbar-link {
            font-weight: 700;
            color: var(--header-text);
            transition: color 0.2s;
        }
        .navbar-link:hover { color: var(--accent); }
        .btn-primary {
            background-color: var(--accent);
            color: #111;
            padding: 10px 24px;
            border-radius: 50px;
            font-weight: 700;
            transition: all 0.3s;
            display: inline-block;
        }
        .btn-primary:hover {
            background-color: var(--accent-dark);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(191,166,74,0.35);
        }
        .btn-secondary {
            background-color: #111;
            color: #ffffff;
            padding: 10px 24px;
            border-radius: 50px;
            font-weight: 700;
            transition: all 0.3s;
            display: inline-block;
        }
        .btn-secondary:hover {
            background-color: #222;
            transform: translateY(-2px);
        }
        .toast {
            animation: slideIn 0.3s ease-out;
        }
        .bg-black-navbar {
            background-color: var(--header-bg) !important;
        }
        .text-gold {
            color: var(--accent) !important;
        }
        .bg-gold {
            background-color: var(--accent) !important;
            color: #111 !important;
        }
        .bg-accent-dark {
            background-color: var(--accent-dark) !important;
            color: #fff !important;
        }
        .hover\:bg-accent-dark:hover {
            background-color: var(--accent-dark) !important;
        }
        .border-gold {
            border-color: var(--accent) !important;
        }
        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        @keyframes marquee {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
        .marquee-content {
            animation: marquee 20s linear infinite;
            display: inline-flex;
        }
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: var(--bg-muted); }
        ::-webkit-scrollbar-thumb {
            background: var(--accent);
            border-radius: 10px;
        }
    </style>

    @yield('styles')
</head>
<body class="min-h-screen">

    <!-- Navbar -->
    <nav class="bg-black-navbar shadow-md sticky top-0 z-50" x-data="{ mobileOpen: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">

                <!-- Logo -->
                <a href="{{ route('home') }}" class="font-fredoka text-2xl text-pink-custom flex items-center gap-2">
                    🛍️ Thingy Store
                </a>

                <!-- Desktop Links -->
                <div class="hidden md:flex items-center gap-8">
                    <a href="{{ route('home') }}" class="navbar-link">Home</a>
                    <a href="{{ route('products.index') }}" class="navbar-link">Products</a>
                    <a href="{{ route('contact.index') }}" class="navbar-link">Contact</a>
                    @auth
                        <a href="{{ route('orders.index') }}" class="navbar-link">My Orders</a>
                    @endauth
                </div>

                <!-- Right Side -->
                <div class="flex items-center gap-4">
                    <!-- Cart Icon -->
                    <a href="{{ route('cart.index') }}" class="relative">
                        <span class="text-2xl">🛒</span>
                        @php $cartCount = count(session()->get('cart', [])); @endphp
                        @if($cartCount > 0)
                        <span class="absolute -top-2 -right-2 bg-pink-custom text-white text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center">
                            {{ $cartCount }}
                        </span>
                        @endif
                    </a>

                    @auth
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="btn-primary text-sm py-2 px-4">
                                Admin Panel
                            </a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="navbar-link text-sm">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="navbar-link text-sm">Login</a>
                    @endauth

                    <!-- Mobile Hamburger -->
                    <button @click="mobileOpen = !mobileOpen" class="md:hidden text-2xl">
                        <span x-show="!mobileOpen">☰</span>
                        <span x-show="mobileOpen">✕</span>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div x-show="mobileOpen"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 -translate-y-2"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 class="md:hidden pb-4 space-y-2">
                <a href="{{ route('home') }}" class="block py-2 navbar-link">🏠 Home</a>
                <a href="{{ route('products.index') }}" class="block py-2 navbar-link">🛍️ Products</a>
                <a href="{{ route('contact.index') }}" class="block py-2 navbar-link">📬 Contact</a>
                <a href="{{ route('cart.index') }}" class="block py-2 navbar-link">🛒 Cart ({{ $cartCount }})</a>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    @if(session('success'))
    <div x-data="{ show: true }"
         x-show="show"
         x-init="setTimeout(() => show = false, 4000)"
         class="toast fixed top-20 right-4 z-50 bg-green-500 text-white px-6 py-3 rounded-2xl shadow-lg flex items-center gap-2 max-w-sm">
        <span class="text-xl">✅</span>
        <span class="font-semibold">{{ session('success') }}</span>
        <button @click="show = false" class="ml-2 text-white opacity-70 hover:opacity-100">✕</button>
    </div>
    @endif

    @if(session('error'))
    <div x-data="{ show: true }"
         x-show="show"
         x-init="setTimeout(() => show = false, 4000)"
         class="toast fixed top-20 right-4 z-50 bg-red-500 text-white px-6 py-3 rounded-2xl shadow-lg flex items-center gap-2 max-w-sm">
        <span class="text-xl">❌</span>
        <span class="font-semibold">{{ session('error') }}</span>
        <button @click="show = false" class="ml-2 text-white opacity-70 hover:opacity-100">✕</button>
    </div>
    @endif

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-slate-950 mt-20 border-t-4 border-slate-800">
        <div class="max-w-7xl mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="col-span-1 md:col-span-2">
                    <h3 class="font-fredoka text-2xl text-gold mb-3">🛍️ Thingy Store</h3>
                    <p class="text-slate-400 leading-relaxed">
                        Your one-stop shop for a sharp black-and-white aesthetic, now polished with gold highlight accents.
                    </p>
                </div>
                <div>
                    <h4 class="font-bold text-gray-700 mb-3">Quick Links</h4>
                    <ul class="space-y-2 text-slate-400">
                        <li><a href="{{ route('home') }}" class="hover:text-gold transition-colors">🏠 Home</a></li>
                        <li><a href="{{ route('products.index') }}" class="hover:text-gold transition-colors">🛍️ Products</a></li>
                        <li><a href="{{ route('contact.index') }}" class="hover:text-gold transition-colors">📬 Contact</a></li>
                        <li><a href="{{ route('cart.index') }}" class="hover:text-gold transition-colors">🛒 Cart</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold text-gray-700 mb-3">Contact Us</h4>
                    <ul class="space-y-2 text-gray-500">
                        <li>📍 123 Thingy Lane</li>
                        <li>📧 hello@thingystore.com</li>
                        <li>📱 +92 300 1234567</li>
                        <li>🕐 Mon-Sat 9am-6pm</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-100 mt-8 pt-6 text-center text-gray-400 text-sm">
                © {{ date('Y') }} Thingy Store. Made with 💖 in Pakistan.
            </div>
        </div>
    </footer>

    <!-- WhatsApp Floating Button -->
    <a href="https://wa.me/923001234567"
       target="_blank"
       class="fixed bottom-6 left-6 z-50 bg-green-500 text-white rounded-full w-14 h-14 flex items-center justify-center text-2xl shadow-lg hover:scale-110 transition-transform">
        💬
    </a>

    <!-- Back to Top -->
    <button x-data="{ show: false }"
            x-show="show"
            x-init="window.addEventListener('scroll', () => show = window.scrollY > 300)"
            @click="window.scrollTo({top: 0, behavior: 'smooth'})"
            class="fixed bottom-6 right-6 z-50 bg-pink-custom text-white rounded-full w-12 h-12 flex items-center justify-center text-xl shadow-lg hover:scale-110 transition-transform">
        ⬆️
    </button>

    @yield('scripts')
</body>
</html>

