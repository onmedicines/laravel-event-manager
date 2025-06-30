<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScanTicketController extends Controller
{
    public function scan(Request $request)
    {
        $qrcode = $request->code;
        $ticket = Ticket::where("qr_code", $qrcode)->first();
        $event = Event::find($ticket->event_id);

        if (Auth::user()->cannot("update", $event)) {
            return response()->json(
                [
                    "message" => "Unauthorized",
                ],
                403
            );
        }

        if ($ticket->scanned_at !== null) {
            return response()->json(
                [
                    "message" => "Already Scanned",
                ],
                409
            );
        }

        $ticket->scanned_at = now();
        $ticket->save();

        return response()->json(
            [
                "message" => "Ticket valid",
                "ticket" => $ticket,
            ],
            200
        );
    }
}
