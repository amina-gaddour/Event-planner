@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto py-10">

        <h1 class="text-2xl font-bold mb-6">My registrations</h1>

        @forelse($registrations as $reg)
            <div class="bg-white p-5 rounded shadow mb-4">
                <h2 class="font-semibold">{{ $reg->event->title }}</h2>
                <p class="text-gray-500">{{ $reg->event->place }}</p>
            </div>
        @empty
            <p class="text-gray-500">No registrations yet.</p>
        @endforelse

    </div>
@endsection