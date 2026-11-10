<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::orderBy('start_date')->get();
        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.events.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'place' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048',
            'is_free' => 'required|boolean',
            'price' => 'nullable|numeric|min:0',
        ]);

        if ($data['is_free']) {
            $data['price'] = 0;
        }

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('events', 'public');
        }

        $data['created_by'] = auth()->id();
        $data['status'] = 'active';

        Event::create($data);

        return redirect()->route('admin.events.index')
            ->with('success', 'Event created successfully');
    }
    public function edit(Event $event)
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.events.edit', compact('event', 'categories'));
    }
    public function update(Request $request, Event $event)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'place' => 'required|string',
            'capacity' => 'required|integer|min:1',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($event->image) {
                Storage::disk('public')->delete($event->image);
            }
            $data['image'] = $request->file('image')->store('events', 'public');
        }

        $event->update($data);

        return redirect()->route('admin.events.index');
    }
    public function destroy(Event $event)
    {
        $event->update([
            'status' => 'archived'
        ]);

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Event archived successfully');
    }

}
