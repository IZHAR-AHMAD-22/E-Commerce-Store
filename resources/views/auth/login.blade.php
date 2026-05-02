@extends('layouts.app')

@section('title', 'Login - Thingy Store')

@section('content')

<section class="min-h-screen py-20 px-4 flex items-center justify-center"
    style="background:linear-gradient(135deg,#FFFBF0,#FFE8F3,#F3E8FF);">

    <div class="w-full max-w-md">

        {{-- Logo --}}
        <div class="text-center mb-8">
            <a href="{{ route('home') }}"
                class="font-fredoka text-4xl text-pink-custom">
                🛍️ Thingy Store
            </a>
            <p class="text-gray-500 mt-2">Welcome back! We missed you 💖</p>
        </div>

        {{-- Card --}}
        <div class="bg-white rounded-3xl p-8 shadow-xl">
            <h2 class="font-fredoka text-3xl text-gray-800 mb-6 text-center">
                Login to Your Account
            </h2>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                {{-- Email --}}
                <div class="mb-4">
                    <label class="block text-sm font-bold text-gray-600 mb-2">
                        Email Address
                    </label>
                    <input type="email"
                           name="email"
                           value="{{ old('email') }}"
                           required autofocus
                           class="w-full border-2 border-gray-200 rounded-xl
                           px-4 py-3 focus:outline-none focus:border-pink-400
                           transition-colors
                           @error('email') border-red-400 @enderror"
                           placeholder="your@email.com">
                    @error('email')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="mb-4">
                    <label class="block text-sm font-bold text-gray-600 mb-2">
                        Password
                    </label>
                    <input type="password"
                           name="password"
                           required
                           class="w-full border-2 border-gray-200 rounded-xl
                           px-4 py-3 focus:outline-none focus:border-pink-400
                           transition-colors
                           @error('password') border-red-400 @enderror"
                           placeholder="Your password">
                    @error('password')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Remember Me --}}
                <div class="flex items-center justify-between mb-6">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox"
                               name="remember"
                               class="w-4 h-4 accent-pink-500">
                        <span class="text-sm text-gray-600 font-semibold">
                            Remember me
                        </span>
                    </label>
                    @if(Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                        class="text-sm text-pink-custom font-bold hover:underline">
                        Forgot password?
                    </a>
                    @endif
                </div>

                {{-- Submit --}}
                <button type="submit"
                    class="btn-primary w-full text-center text-lg py-4 mb-4">
                    🚀 Login Now
                </button>

                {{-- Register Link --}}
                <p class="text-center text-gray-500 text-sm">
                    Don't have an account?
                    <a href="{{ route('register') }}"
                        class="text-pink-custom font-bold hover:underline">
                        Register here! 🎉
                    </a>
                </p>
            </form>
        </div>

        {{-- Back to Home --}}
        <div class="text-center mt-6">
            <a href="{{ route('home') }}"
                class="text-gray-400 text-sm hover:text-pink-custom transition-colors">
                ← Back to Home
            </a>
        </div>
    </div>
</section>

@endsection

