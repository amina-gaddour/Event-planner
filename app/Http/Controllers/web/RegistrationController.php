<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Registration;

class RegistrationController extends Controller
{
    public function myRegistrations()
    {
        $events = auth()->user()
            ->registeredEvents()
            ->where('events.status', 'active')
            ->with('category')
            ->orderBy('start_date')
            ->get();

        return view('events.my-registrations', compact('events'));
    }

    public function store(Event $event)
    {
        $user = auth()->user();

        if ($event->status !== 'active') {
            return back()->with('error', 'Event is no longer available');
        }

        if ($event->isFull()) {
            return back()->with('error', 'Event is full');
        }

        if ($event->users()->where('user_id', $user->id)->exists()) {
            return back()->with('error', 'Already registered');
        }

        Registration::create([
            'user_id' => $user->id,
            'event_id' => $event->id,
        ]);

        return back()->with('success', 'Registered successfully');
    }

    public function destroy(Event $event)
    {
        Registration::where('user_id', auth()->id())
            ->where('event_id', $event->id)
            ->delete();

        return back()->with('success', 'Unregistered successfully');
    }
}
