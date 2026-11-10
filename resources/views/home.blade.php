@extends('layouts.app')

@section('content')

    {{-- ================= HERO ================= --}}
    <section class="max-w-7xl mx-auto px-6 pt-10 pb-14">

        @auth
            @if(auth()->user()->role === 'admin')
                {{-- ================= ADMIN DASHBOARD ================= --}}
                <h2 class="text-2xl font-semibold text-gray-900 mb-8">
                    Dashboard <span class="text-purple-600">Statistics</span>
                </h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                    <div class="bg-white rounded-2xl shadow-sm p-6">
                        <p class="text-sm text-gray-500">Total Events</p>
                        <p class="text-3xl font-bold text-purple-600 mt-2">
                            {{ \App\Models\Event::count() }}
                        </p>
                    </div>

                    <div class="bg-white rounded-2xl shadow-sm p-6">
                        <p class="text-sm text-gray-500">Active Events</p>
                        <p class="text-3xl font-bold text-green-600 mt-2">
                            {{ \App\Models\Event::where('status', 'active')->count() }}
                        </p>
                    </div>

                    <div class="bg-white rounded-2xl shadow-sm p-6">
                        <p class="text-sm text-gray-500">Registrations</p>
                        <p class="text-3xl font-bold text-blue-600 mt-2">
                            {{ \App\Models\Registration::count() }}
                        </p>
                    </div>

                    <div class="bg-white rounded-2xl shadow-sm p-6">
                        <p class="text-sm text-gray-500">Categories</p>
                        <p class="text-3xl font-bold text-orange-600 mt-2">
                            {{ \App\Models\Category::count() }}
                        </p>
                    </div>

                </div>

            @else
                {{-- ================= USER HERO ================= --}}
                <div class="relative rounded-3xl overflow-hidden shadow-sm">
                    <img src="{{ asset('images/hero.jpg') }}" class="w-full h-[360px] object-cover">
                    <div class="absolute inset-0 bg-black/60"></div>
                    <div class="absolute inset-0 flex items-center justify-center text-center px-6">
                        <h1 class="text-white text-4xl md:text-5xl font-semibold">
                            Discover amazing <br class="hidden sm:block"> events near you
                        </h1>
                    </div>
                </div>
            @endif
        @else
            {{-- ================= GUEST HERO ================= --}}
            <div class="relative rounded-3xl overflow-hidden shadow-sm">
                <img src="{{ asset('images/hero.jpg') }}" class="w-full h-[360px] object-cover">
                <div class="absolute inset-0 bg-black/60"></div>
                <div class="absolute inset-0 flex items-center justify-center text-center px-6">
                    <h1 class="text-white text-4xl md:text-5xl font-semibold">
                        Discover amazing <br class="hidden sm:block"> events near you
                    </h1>
                </div>
            </div>
        @endauth

    </section>


    {{-- ================= EVENTS SECTION ================= --}}
    <section class="max-w-7xl mx-auto px-6 pb-20">

        {{-- TITLE + FILTER --}}
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6 mb-10">

            <h2 class="text-2xl font-semibold text-gray-900">
                Upcoming <span class="text-purple-600">Events</span>
            </h2>

            {{-- FILTER BAR --}}
            <form method="GET" action="{{ route('home') }}"
                class="bg-white rounded-2xl shadow-sm px-4 py-3
                                                                 flex flex-col sm:flex-row gap-3 items-center w-full lg:w-auto">

                {{-- SEARCH --}}
                <div class="relative w-full sm:w-64">
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Search events..."
                        class="w-full pl-10 pr-4 py-2 text-sm border border-gray-200
                                                                          rounded-xl focus:ring-2 focus:ring-purple-400 focus:outline-none">
                    <span class="absolute left-3 top-2.5 text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m21 21-4.35-4.35M17 11a6 6 0 1 1-12 0 6 6 0 0 1 12 0z" />
                        </svg>
                    </span>
                </div>

                {{-- CATEGORY --}}
                <select name="category" class="w-full sm:w-44 py-2 px-3 text-sm border border-gray-200
                                                                       rounded-xl focus:ring-2 focus:ring-purple-400">
                    <option value="">Any category</option>
                    @foreach(\App\Models\Category::orderBy('name')->get() as $cat)
                        <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>

                {{-- UPCOMING --}}
                <select name="upcoming" class="w-full sm:w-40 py-2 px-3 text-sm border border-gray-200
                                                                       rounded-xl focus:ring-2 focus:ring-purple-400">
                    <option value="">All dates</option>
                    <option value="1" {{ request('upcoming') ? 'selected' : '' }}>
                        Upcoming only
                    </option>
                </select>

                {{-- SUBMIT --}}
                <button class="bg-purple-600 hover:bg-purple-700
                                                                       text-white text-sm font-medium
                                                                       px-5 py-2 rounded-xl transition">
                    Filter
                </button>

            </form>
        </div>
        {{-- EVENTS GRID --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

            @forelse($events as $event)
                <div class="bg-white rounded-2xl shadow-sm hover:shadow-md transition overflow-hidden">

                    <div class="relative">
                        <img src="{{ $event->image_url }}" class="h-48 w-full object-cover">

                        {{-- PRICE BADGE --}}
                        <span
                            class="absolute top-3 left-3
                                                                                                                {{ $event->is_free ? 'bg-green-600' : 'bg-purple-600' }}
                                                                                                                text-white text-xs font-medium px-3 py-1 rounded-full">
                            {{ $event->is_free ? 'FREE' : number_format($event->price, 2) . ' DT' }}
                        </span>
                    </div>

                    <div class="p-6">
                        <h3 class="font-semibold text-gray-900 mb-1">
                            {{ $event->title }}
                        </h3>

                        <p class="text-sm text-gray-500 mb-4">
                            {{ $event->start_date->format('d M Y') }}
                        </p>

                        <a href="{{ route('events.show', $event) }}"
                            class="inline-flex items-center gap-1
                                                                                                                      text-purple-600 text-sm font-medium hover:underline">
                            View details →
                        </a>
                    </div>

                </div>
            @empty
                <p class="text-gray-500">No events found.</p>
            @endforelse

        </div>

        {{-- PAGINATION --}}
        <div class="mt-12">
            {{ $events->links() }}
        </div>

    </section>

@endsection