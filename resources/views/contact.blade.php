@extends('layouts.app')

@section('title', 'Contact Us - Thingy Store')

@section('content')

{{-- Header --}}
<section class="py-16 px-4 text-center"
    style="background:linear-gradient(135deg,#FFE8F3,#F3E8FF);">
    <h1 class="font-fredoka text-5xl text-gray-800 mb-3">
        Contact Us 📬
    </h1>
    <p class="text-gray-500 text-lg">
        Got a question? We'd love to hear from you! 💖
    </p>
</section>

<section class="py-16 px-4 max-w-6xl mx-auto">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

        {{-- Contact Info --}}
        <div class="space-y-6">
            <h2 class="font-fredoka text-3xl text-gray-800">
                Get In Touch 🌸
            </h2>
            <p class="text-gray-500 leading-relaxed">
                We're here to help! Send us a message and
                we'll get back to you within 24 hours. 🚀
            </p>

            @foreach([
                ['emoji'=>'📍','title'=>'Address',
                 'value'=>'123 Thingy Lane, Lahore, Pakistan'],
                ['emoji'=>'📧','title'=>'Email',
                 'value'=>'hello@thingystore.com'],
                ['emoji'=>'📱','title'=>'Phone',
                 'value'=>'+92 300 1234567'],
                ['emoji'=>'🕐','title'=>'Hours',
                 'value'=>'Mon–Sat, 9am–6pm PKT'],
            ] as $info)
            <div class="flex gap-4 items-start p-4 rounded-2xl bg-white shadow-sm">
                <div class="text-3xl flex-shrink-0">{{ $info['emoji'] }}</div>
                <div>
                    <p class="font-bold text-gray-700">{{ $info['title'] }}</p>
                    <p class="text-gray-500 text-sm">{{ $info['value'] }}</p>
                </div>
            </div>
            @endforeach

            {{-- Social Links --}}
            <div class="flex gap-4 pt-2">
                @foreach([
                    ['emoji'=>'📘','label'=>'Facebook'],
                    ['emoji'=>'📸','label'=>'Instagram'],
                    ['emoji'=>'🐦','label'=>'Twitter'],
                ] as $social)
                <a href="#"
                    class="w-12 h-12 bg-white rounded-xl shadow-sm flex items-center
                    justify-content:center text-2xl hover:scale-110
                    transition-transform"
                    style="display:flex;align-items:center;justify-content:center;"
                    title="{{ $social['label'] }}">
                    {{ $social['emoji'] }}
                </a>
                @endforeach
            </div>
        </div>

        {{-- Contact Form --}}
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl p-8 shadow-sm mb-6">
                <h3 class="font-fredoka text-2xl text-gray-800 mb-6">
                    Check Your Reply 💬
                </h3>
                <p class="text-gray-500 mb-4">
                    Enter the email you used to contact us and see any reply from our team directly on the website.
                </p>
                <form action="{{ route('contact.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                    <input type="email"
                           name="email"
                           value="{{ old('email', $searchEmail ?? '') }}"
                           class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:border-pink-400"
                           placeholder="Your email address">
                    <button type="submit"
                        class="btn-primary w-full text-center text-lg py-3 sm:col-span-1">
                        🔍 Check Reply
                    </button>
                </form>

                @if(isset($searchEmail) && !$replyContact)
                <div class="mt-4 p-4 rounded-2xl bg-yellow-50 border border-yellow-200 text-yellow-800">
                    No reply has been posted yet for <strong>{{ $searchEmail }}</strong>. Check back later.
                </div>
                @endif

                @if($replyContact)
                <div class="mt-4 p-4 rounded-2xl bg-blue-50 border border-blue-200 text-blue-800">
                    <h4 class="font-semibold mb-2">Reply from our support team</h4>
                    <p class="mb-3">Subject: <strong>{{ $replyContact->subject }}</strong></p>
                    <div class="bg-white p-4 rounded-xl border border-blue-100">
                        <p class="text-gray-700 leading-relaxed">{{ $replyContact->reply }}</p>
                        <p class="text-sm text-gray-500 mt-3">Replied on {{ $replyContact->replied_at->format('d M Y, h:i A') }}</p>
                    </div>
                </div>
                @endif
            </div>

            <div class="bg-white rounded-2xl p-8 shadow-sm">
                <h3 class="font-fredoka text-2xl text-gray-800 mb-6">
                    Send Us a Message ✉️
                </h3>

                <form action="{{ route('contact.store') }}" method="POST">
                    @csrf

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-bold
                                text-gray-600 mb-2">
                                Your Name <span class="text-red-400">*</span>
                            </label>
                            <input type="text"
                                   name="name"
                                   value="{{ old('name') }}"
                                   class="w-full border-2 border-gray-200
                                   rounded-xl px-4 py-3 focus:outline-none
                                   focus:border-pink-400
                                   @error('name') border-red-400 @enderror"
                                   placeholder="Your full name">
                            @error('name')
                                <p class="text-red-400 text-xs mt-1">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-bold
                                text-gray-600 mb-2">
                                Email <span class="text-red-400">*</span>
                            </label>
                            <input type="email"
                                   name="email"
                                   value="{{ old('email') }}"
                                   class="w-full border-2 border-gray-200
                                   rounded-xl px-4 py-3 focus:outline-none
                                   focus:border-pink-400
                                   @error('email') border-red-400 @enderror"
                                   placeholder="your@email.com">
                            @error('email')
                                <p class="text-red-400 text-xs mt-1">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-bold
                            text-gray-600 mb-2">
                            Subject <span class="text-red-400">*</span>
                        </label>
                        <input type="text"
                               name="subject"
                               value="{{ old('subject') }}"
                               class="w-full border-2 border-gray-200
                               rounded-xl px-4 py-3 focus:outline-none
                               focus:border-pink-400
                               @error('subject') border-red-400 @enderror"
                               placeholder="What's it about?">
                        @error('subject')
                            <p class="text-red-400 text-xs mt-1">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-bold
                            text-gray-600 mb-2">
                            Message <span class="text-red-400">*</span>
                        </label>
                        <textarea name="message"
                            rows="5"
                            class="w-full border-2 border-gray-200
                            rounded-xl px-4 py-3 focus:outline-none
                            focus:border-pink-400
                            @error('message') border-red-400 @enderror"
                            placeholder="Tell us everything...">{{ old('message') }}</textarea>
                        @error('message')
                            <p class="text-red-400 text-xs mt-1">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <button type="submit"
                        class="btn-primary w-full text-center text-lg py-4">
                        📨 Send Message
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection

