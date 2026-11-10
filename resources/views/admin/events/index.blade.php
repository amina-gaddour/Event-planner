@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-6 py-10">

        <!-- HEADER -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-xl font-semibold text-purple-600">
                Admin · Events
            </h1>

            <a href="{{ route('admin.events.create') }}"
                class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded">
                + Create event
            </a>
        </div>

        <!-- TABLE -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="w-full text-sm">
                <thead class="border-b bg-gray-50 text-gray-500">
                    <tr>
                        <th class="p-3 text-left">Image</th>
                        <th class="p-3 text-left">Title</th>
                        <th>Dates</th>
                        <th>Capacity</th>
                        <th>Place</th>
                        <th>Status</th>
                        <th class="text-right p-3">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($events as $event)
                                <tr class="border-b hover:bg-gray-50">

                                    <!-- IMAGE -->
                                    <td class="p-3">
                                        @if($event->image)
                                            <img src="{{ $event->image_url }}" class="h-16 w-24 object-cover rounded"
                                                alt="{{ $event->title }}">
                                        @else
                                            <span class="text-gray-400 text-xs">No image</span>
                                        @endif
                                    </td>

                                    <!-- TITLE -->
                                    <td class="p-3 font-medium">
                                        {{ $event->title }}
                                    </td>

                                    <!-- DATES -->
                                    <td>
                                        {{ $event->start_date->format('d M') }}
                                        →
                                        {{ $event->end_date->format('d M') }}
                                    </td>

                                    <!-- CAPACITY -->
                                    <td>{{ $event->capacity }}</td>

                                    <!-- PLACE -->
                                    <td>{{ $event->place }}</td>

                                    <!-- STATUS -->
                                    <td>
                                        <span class="px-2 py-1 text-xs rounded
                                                                                                                {{ $event->status === 'active'
                        ? 'bg-green-100 text-green-600'
                        : 'bg-gray-200 text-gray-600' }}">
                                            {{ ucfirst($event->status) }}
                                        </span>
                                    </td>

                                    <!-- ACTIONS -->
                                    <td class="p-3 text-right space-x-3">
                                        <a href="{{ route('admin.events.edit', $event) }}" class="text-purple-600 hover:underline">
                                            Edit
                                        </a>

                                        <form method="POST" action="{{ route('admin.events.destroy', $event) }}" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-red-500 hover:underline"
                                                onclick="return confirm('Delete this event ?')">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="p-6 text-center text-gray-500">
                                No events found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
@endsection