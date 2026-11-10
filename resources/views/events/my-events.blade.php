@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto px-6 py-12">

        <h1 class="text-2xl font-semibold mb-8">
            My Events
        </h1>
        @if($events->isEmpty())
            <div class="bg-white p-6 rounded-lg shadow text-gray-500">
                You are not registered to any event yet.
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($events as $event)
                    <div class="bg-white rounded-xl shadow hover:shadow-lg transition">
                        {{-- IMAGE --}}
                        <img src="{{ $event->image
                        ? $event->image_url
                        : $event->image_url }}" class="h-40 w-full object-cover rounded-t-xl"
                            alt="{{ $event->title }}">

                        <div class="p-5 space-y-2">

                            {{-- TITLE --}}
                            <h2 class="font-semibold text-lg">
                                {{ $event->title }}
                            </h2>

                            {{-- PLACE --}}
                            <p class="text-sm text-gray-500">
                                {{ $event->place }}
                            </p>

                            {{-- DATE --}}
                            <p class="text-sm text-gray-500">
                                {{ $event->start_date->format('d M Y') }}
                            </p>

                            {{-- ACTION --}}
                            <a href="{{ route('events.show', $event) }}"
                                class="inline-block mt-3 text-purple-600 font-medium text-sm hover:underline">
                                View details →
                            </a>

                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </div>
@endsection