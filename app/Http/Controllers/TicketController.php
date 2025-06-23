<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TicketController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $tickets = $user->tickets()->with("event")->get();

        return view("tickets.index", [
            "tickets" => $tickets,
        ]);
    }

    public function store(Event $event)
    {
        $user = auth()->user();
        if (!$user->isGuest()) {
            abort(403);
        }

        Ticket::create([
            "user_id" => $user->id,
            "event_id" => $event->id,
            "amount_paid" => $event->price,
            "qr_code" => Str::uuid()->toString(),
        ]);

        return redirect()->route("tickets.index");
    }

    public function show(Ticket $ticket)
    {
        return view("tickets.show", [
            "ticket" => $ticket,
        ]);
    }
}
