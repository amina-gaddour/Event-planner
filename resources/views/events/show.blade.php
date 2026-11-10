@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-6 py-12">

        {{-- HERO --}}
        <div class="relative rounded-3xl overflow-hidden shadow-xl mb-20">

            <img src="{{ $event->image ? asset('storage/' . $event->image) : asset('images/event.jpg') }}"
                class="w-full h-[420px] object-cover">

            <div class="absolute inset-0 bg-black/60"></div>

            <div class="absolute inset-0 flex flex-col justify-center px-12 text-white max-w-3xl">
                <h1 class="text-4xl md:text-5xl font-extrabold mb-4 leading-tight">
                    {{ $event->title }}
                </h1>

                <p class="text-white/80 text-lg mb-8">
                    📍 {{ $event->place }} · 🗓 {{ $event->start_date->format('d M Y') }}
                </p>

                {{-- BOOK BUTTON --}}
                @auth
                    @if(auth()->user()->role === 'user')

                        @if($alreadyBooked)
                            <span class="inline-block bg-gray-400 px-8 py-3 rounded-xl font-medium">
                                Already booked
                            </span>

                        @elseif($remainingSeats > 0)
                            <button onclick="openBookModal()"
                                class="bg-purple-600 hover:bg-purple-700
                                                                                                   hover:scale-105 transition-transform
                                                                                                   shadow-lg shadow-purple-600/40
                                                                                                   px-10 py-3 rounded-xl font-semibold">
                                Book now
                            </button>
                        @else
                            <span class="inline-block bg-red-500 px-8 py-3 rounded-xl font-medium">
                                Event full
                            </span>
                        @endif

                    @endif
                @else
                    <a href="{{ route('login') }}" class="bg-purple-600 px-10 py-3 rounded-xl font-semibold shadow-lg">
                        Login to book
                    </a>
                @endauth
            </div>
        </div>

        {{-- CONTENT --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-16 mb-24">

            {{-- DESCRIPTION --}}
            <div class="lg:col-span-2">
                <h2 class="text-2xl font-semibold mb-6">Description</h2>
                <p class="text-gray-600 leading-relaxed text-lg">
                    {{ $event->description }}
                </p>
            </div>

            {{-- INFO CARD --}}
            <div class="bg-white rounded-2xl shadow-lg p-6 space-y-6 sticky top-24">

                <div>
                    <p class="text-sm text-gray-400">Capacity</p>
                    <p class="text-xl font-bold text-purple-600">
                        {{ $event->capacity }} persons
                    </p>
                    <p class="text-xs text-gray-500">
                        Remaining: {{ $remainingSeats }}
                    </p>
                </div>

                <div>
                    <p class="text-sm text-gray-400">Time</p>
                    <p class="font-semibold">
                        {{ $event->start_date->format('H:i') }} - {{ $event->end_date->format('H:i') }}
                    </p>
                </div>

                <div>
                    <p class="text-sm text-gray-400">Price</p>
                    <span
                        class="inline-block px-4 py-1 rounded-full text-sm font-medium
                                    {{ $event->is_free ? 'bg-green-100 text-green-700' : 'bg-purple-100 text-purple-700' }}">
                        {{ $event->is_free ? 'FREE' : number_format($event->price, 2) . 'DT' }}
                    </span>
                </div>

            </div>
        </div>

        {{-- RELATED EVENTS --}}
        <section>
            <h2 class="text-2xl font-semibold mb-8">
                Other events you may like
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($relatedEvents as $e)
                    <div class="bg-white rounded-xl shadow
                                                            hover:shadow-xl hover:-translate-y-1 transition-all">

                        <img src="{{ $e->image ? asset('storage/' . $e->image) : asset('images/event.jpg') }}"
                            class="h-44 w-full object-cover rounded-t-xl">

                        <div class="p-5">
                            <h3 class="font-semibold text-lg">{{ $e->title }}</h3>
                            <p class="text-sm text-gray-500">{{ $e->place }}</p>

                            <a href="{{ route('events.show', $e) }}" class="inline-block mt-4 text-purple-600 font-medium">
                                View details →
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </div>

    {{-- BOOK MODAL --}}
    <div id="bookModal" class="fixed inset-0 bg-black/60 hidden items-center justify-center z-50">

        <div id="bookModalContent" class="bg-white rounded-2xl w-[380px] p-6 text-center
                                transform scale-95 opacity-0 transition">

            <h3 class="text-xl font-bold mb-4"> Confirm your booking</h3>

            <p class="text-gray-500 text-sm mb-6">
                You are about to register for <strong>{{ $event->title }}</strong>
            </p>

            <form method="POST" action="{{ route('events.register', $event) }}">
                @csrf
                <button class="bg-purple-600 hover:bg-purple-700
                                           text-white w-full py-3 rounded-xl font-medium mb-3">
                    Confirm booking
                </button>
            </form>

            <button onclick="closeBookModal()" class="text-gray-500 text-sm hover:underline">
                Cancel
            </button>
        </div>
    </div>

@endsection