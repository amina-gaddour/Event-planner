@extends('layouts.auth')

@section('content')
    <div class="flex min-h-screen">

        <!-- LEFT PANEL -->
        <div class="hidden lg:flex w-1/2 relative">
            <img src="/images/event.jpg" class="absolute inset-0 w-full h-full object-cover">
            <div class="absolute inset-0 bg-[#2b2b2b]/80"></div>

            <div class="relative z-10 flex flex-col justify-center items-center
                            text-white px-20 text-center h-full">
                <h2 class="text-5xl font-semibold mb-4">
                    Hello Friend
                </h2>

                <p class="text-sm opacity-80 max-w-xs leading-relaxed mb-8">
                    To keep connected with us provide us with your information
                </p>

                <a href="{{ route('register') }}" class="border border-white/40 px-10 py-2 rounded-lg
                              hover:bg-white/10 transition">
                    Sign up
                </a>
            </div>
        </div>

        <!-- RIGHT FORM -->
        <div class="w-full lg:w-1/2 flex items-center justify-center">

            <form method="POST" action="{{ route('login') }}" class="w-full max-w-[480px] bg-white
                             px-14 py-16 rounded-2xl shadow-lg">

                @csrf

                {{-- GLOBAL ERRORS --}}
                @if ($errors->any())
                    <div class="mb-6 rounded-lg bg-red-50 border border-red-200
                                            p-4 text-sm text-red-600">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <p class="text-center font-medium mb-3">
                    Event <span class="text-purple-600">Planner</span>
                </p>

                <h1 class="text-3xl font-bold text-center mb-10">
                    Sign In to Event Planner
                </h1>

                <div class="space-y-6">

                    <!-- EMAIL -->
                    <div>
                        <label class="text-xs text-gray-500 uppercase">
                            Your email
                        </label>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="Enter your email" class="w-full h-12 px-4 mt-2 border rounded-lg bg-gray-50
                                          focus:ring-2 focus:ring-purple-400 focus:outline-none">

                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- PASSWORD -->
                    <div>
                        <div class="flex justify-between text-xs text-gray-500 mb-2">
                            <span>Password</span>
                        </div>

                        <input type="password" name="password" placeholder="Enter your password" class="w-full h-12 px-4 border rounded-lg bg-gray-50
                                          focus:ring-2 focus:ring-purple-400 focus:outline-none">

                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                <button class="w-full mt-10 bg-purple-600
                                   hover:bg-purple-700 text-white
                                   py-3 rounded-lg font-medium transition">
                    Sign In
                </button>

            </form>
        </div>
    </div>
@endsection