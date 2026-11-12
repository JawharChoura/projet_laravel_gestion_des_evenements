<?php
namespace App\Http\Controllers;


use App\Models\Event;

class AdminController extends Controller
{
    public function events()
    {
        $events = Event::with(['category', 'creator'])->get();
        return view('admin.events.index', compact('events'));
    }
}
