<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::where('status', 'active');

        //  SEARCH
        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->q . '%')
                    ->orWhere('place', 'like', '%' . $request->q . '%')
                    ->orWhere('description', 'like', '%' . $request->q . '%');
            });
        }

        //  CATEGORY
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // UPCOMING ONLY
        if ($request->filled('upcoming')) {
            $query->whereDate('start_date', '>=', now());
        }

        $events = $query
            ->orderBy('start_date')
            ->paginate(6)
            ->withQueryString();

        return view('home', compact('events'));
    }
    public function show(Event $event)
    {
        if ($event->status !== 'active') {
            abort(404);
        }
        //Vérifier si l’utilisateur est déjà inscrit
        $user = auth()->user();

        $alreadyBooked = false;
        if ($user && $user->role === 'user') {
            $alreadyBooked = $event->registrations()
                ->where('user_id', $user->id)
                ->exists();
        }

        return view('events.show', [
            'event' => $event,
            'alreadyBooked' => $alreadyBooked,
            'remainingSeats' => $event->remainingSeats(),
            'relatedEvents' => Event::where('status', 'active')
                ->where('id', '!=', $event->id)
                ->take(6)
                ->get(),
        ]);
    }

    public function myEvents()
    {
        $events = auth()->user()
            ->registeredEvents()
            ->where('events.status', 'active')
            ->orderBy('start_date')
            ->get();

        return view('events.my-events', compact('events'));
    }
}
