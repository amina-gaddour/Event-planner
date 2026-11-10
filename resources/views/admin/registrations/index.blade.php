@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto px-6 py-12">

        <!-- TITLE -->
        <div class="mb-8">
            <h1 class="text-2xl font-semibold text-gray-800">
                All Registrations
            </h1>
            <p class="text-sm text-gray-500 mt-1">
                List of all users registered to events
            </p>
        </div>

        <!-- TABLE -->
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden">

            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-gray-500">
                    <tr>
                        <th class="px-6 py-4 text-left font-medium">User</th>
                        <th class="px-6 py-4 text-left font-medium">Event</th>
                        <th class="px-6 py-4 text-left font-medium">Registered at</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                    @forelse($registrations as $registration)
                        <tr class="hover:bg-gray-50 transition">

                            <!-- USER -->
                            <td class="px-6 py-4">
                                <div class="font-medium text-gray-800">
                                    {{ $registration->user->name }}
                                </div>
                                <div class="text-xs text-gray-500">
                                    {{ $registration->user->email }}
                                </div>
                            </td>

                            <!-- EVENT -->
                            <td class="px-6 py-4 text-gray-700">
                                {{ $registration->event->title }}
                            </td>

                            <!-- DATE -->
                            <td class="px-6 py-4 text-gray-600">
                                {{ $registration->created_at->format('d/m/Y H:i') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-12 text-center text-gray-500">
                                No registrations found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <!-- PAGINATION -->
            @if($registrations->hasPages())
                <div class="px-6 py-4 border-t">
                    {{ $registrations->links() }}
                </div>
            @endif

        </div>

    </div>
@endsection