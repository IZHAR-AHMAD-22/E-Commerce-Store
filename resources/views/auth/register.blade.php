@extends('layouts.app')

@section('title', 'Register - Thingy Store')

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
            <p class="text-gray-500 mt-2">Join the Thingy family today! 🎊</p>
        </div>

        {{-- Card --}}
        <div class="bg-white rounded-3xl p-8 shadow-xl">
            <h2 class="font-fredoka text-3xl text-gray-800 mb-6 text-center">
                Create Your Account
            </h2>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                {{-- Name --}}
                <div class="mb-4">
                    <label class="block text-sm font-bold text-gray-600 mb-2">
                        Full Name
                    </label>
                    <input type="text"
                           name="name"
                           value="{{ old('name') }}"
                           required autofocus
                           class="w-full border-2 border-gray-200 rounded-xl
                           px-4 py-3 focus:outline-none focus:border-pink-400
                           transition-colors
                           @error('name') border-red-400 @enderror"
                           placeholder="Your full name">
                    @error('name')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="mb-4">
                    <label class="block text-sm font-bold text-gray-600 mb-2">
                        Email Address
                    </label>
                    <input type="email"
                           name="email"
                           value="{{ old('email') }}"
                           required
                           class="w-full border-2 border-gray-200 rounded-xl
                           px-4 py-3 focus:outline-none focus:border-pink-400
                           transition-colors
                           @error('email') border-red-400 @enderror"
                           placeholder="your@email.com">
                    @error('email')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Phone --}}
                <div class="mb-4">
                    <label class="block text-sm font-bold text-gray-600 mb-2">
                        Phone Number
                        <span class="text-gray-400 font-normal">(optional)</span>
                    </label>
                    <input type="text"
                           name="phone"
                           value="{{ old('phone') }}"
                           class="w-full border-2 border-gray-200 rounded-xl
                           px-4 py-3 focus:outline-none focus:border-pink-400
                           transition-colors"
                           placeholder="+92 300 1234567">
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
                           placeholder="Min 8 characters">
                    @error('password')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Confirm Password --}}
                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-600 mb-2">
                        Confirm Password
                    </label>
                    <input type="password"
                           name="password_confirmation"
                           required
                           class="w-full border-2 border-gray-200 rounded-xl
                           px-4 py-3 focus:outline-none focus:border-pink-400
                           transition-colors"
                           placeholder="Repeat your password">
                </div>

                {{-- Submit --}}
                <button type="submit"
                    class="btn-primary w-full text-center text-lg py-4 mb-4">
                    🎉 Create Account
                </button>

                {{-- Login Link --}}
                <p class="text-center text-gray-500 text-sm">
                    Already have an account?
                    <a href="{{ route('login') }}"
                        class="text-pink-custom font-bold hover:underline">
                        Login here! 🚀
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

