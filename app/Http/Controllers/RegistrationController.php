<?php
namespace App\Http\Controllers;
use App\Models\Event;
use App\Models\Registration;

use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{
    public function register(Event $event)
    {
        abort_if(!$event->hasAvailableSpots(), 422, 'Aucune place disponible.');
        abort_if($event->isUserRegistered(Auth::id()), 422, 'Déjà inscrit à cet événement.');

        Registration::create([
            'CJ_user_id' => Auth::id(),
            'CJ_event_id' => $event->CJ_id,
        ]);

        return back()->with('success', 'Inscription réussie!');
    }

    public function unregister(Event $event)
    {
        abort_if(!$event->isUserRegistered(Auth::id()), 422, 'Vous n\'êtes pas inscrit.');

        Registration::where('CJ_user_id', Auth::id())
                ->where('CJ_event_id', $event->CJ_id)
                ->delete();

        return back()->with('success', 'Désinscription réussie!');
    }

    public function myRegistrations()
    {
        $registrations = Registration::with(['event.category'])
            ->where('CJ_user_id', Auth::id())
            ->latest()
            ->get();

        return view('user.registrations', compact('registrations'));
    }

    public function allRegistrations()
    {
        $registrations = Registration::with(['user', 'event'])
            ->latest()
            ->get();

        return view('admin.registrations.index', compact('registrations'));
    }
}
