<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(User $user)
    {
        $events = Event::all();

        return view('event.index', compact('user', 'events'));
    }

    public function create(User $user)
    {
        return view('event.create', compact('user'));
    }

    public function store(Request $request)
    {
        $user = Auth::user(); // Pasiimi dabartinį user ir susetini į kintamajį

        // kuri naują Event ir iš request kintamojo pasiimi vertes
        // verčių pavadinimai pareina iš create.blade formos kur yra <input name="title"... etc.
        // ofc turėtum dar tikrinti ar geri values pareina, bet kolkas tiek to

        Event::create(
            $this->validateData()
        );

        // jeigu viskas gerai, redirektini į route kurio vardą apsirašai prie routes 'web.php' kur yra
        // Route::get('/{user}/Events', [EventController::class, 'index'])->name('Events.show');
        // matai                ->name('Events.show') ir kaip antrą argumentą passini vartotojo ID
        return redirect()->route('events.index', $user->id);
    }

    public function show(User $user, Event $event)
    {
        return view('event.show', compact('event', 'user'));
    }

    public function edit(User $user, Event $event)
    {
        return view('event.edit', compact('event', 'user'));
    }

    public function update()
    {

    }

    public function destroy(User $user, Event $event)
    {
        $event->delete();
    
        return redirect()->route('events.index', $user->id);
    }

    private function validateData()
    {
        return request()->validate([
            'title' => ['required', 'string', 'max:30', 'min:1'],            
            'place' => ['string', 'nullable', 'max:50'], 
            'start_date' => ['required', 'date', 'after:now'],            
            'end_date' => ['required', 'date', 'after:start_date'],            
            'description' => ['string', 'nullable', 'max:255'],
            'picture' => ['nullable', 'max:10240'],
        ]);
    }
}
