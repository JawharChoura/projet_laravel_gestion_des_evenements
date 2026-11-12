<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $events = Event::when($request->search, fn($q) => $q->search($request->search))
            ->when($request->category, fn($q) => $q->where('CJ_category_id', $request->category))
            ->when($request->weekday, fn($q) => $q->byWeekday($request->weekday))
            ->with('category', 'creator')
            ->orderBy('CJ_start_date')
            ->get();

        return view('events.index', compact('events'));
    }

    public function show(Event $event)
    {
        $event->load('category', 'creator', 'registrations');

        return view('events.show', [
            'event' => $event,
            'relatedEvents' => Event::where('CJ_id', '!=', $event->CJ_id)->limit(6)->get(),
            'isUserRegistered' => $event->isUserRegistered(Auth::id()),
            'availableSpots' => $event->getAvailableSpots(),
        ]);
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->rules());
        $data['CJ_created_by'] = Auth::id();
        $data['CJ_status'] = 'active';
        if ($request->hasFile('CJ_image')) {
            $data['CJ_image'] = $request->file('CJ_image')->store('events', 'public');
        }
        Event::create($data);
        return redirect()->route('admin.events.index')->with('success', 'Événement créé!');
    }

    public function edit(Event $event)
    {
        $categories = \App\Models\Category::all();
        return view('admin.events.edit', compact('event', 'categories'));
    }

    public function update(Request $request, Event $event)
    {
        $data = $request->validate($this->rules(false));
        if ($request->hasFile('CJ_image')) {
            if ($event->CJ_image) {
                Storage::disk('public')->delete($event->CJ_image);
            }
            $data['CJ_image'] = $request->file('CJ_image')->store('events', 'public');
        }
        $event->update($data);
        return redirect()->route('admin.events.index')->with('success', 'Événement modifié!');
    }

    public function destroy(Event $event)
    {
        if ($event->CJ_image) {
            Storage::disk('public')->delete($event->CJ_image);
        }
        $event->delete();
        return redirect()->route('admin.events.index')->with('success', 'Événement supprimé!');
    }

    private function rules(bool $isCreation = true): array
    {
        return [
            'CJ_title' => 'required|max:255',
            'CJ_description' => 'required|min:10',
            'CJ_start_date' => 'required|date' . ($isCreation ? '|after_or_equal:now' : ''),
            'CJ_end_date' => 'required|date|after:CJ_start_date',
            'CJ_place' => 'required|max:255',
            'CJ_price' => 'required|numeric|min:0|max:9999.99',
            'CJ_is_free' => 'boolean',
            'CJ_capacity' => 'required|integer|min:1|max:10000',
            'CJ_image' => 'nullable|image|max:2048',
            'CJ_category_id' => 'required|exists:CJ_categories,CJ_id',
            'CJ_status' => 'nullable|in:active,archived',
        ];
    }
}
