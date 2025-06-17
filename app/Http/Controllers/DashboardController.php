<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function view(Request $request)
    {
        $role = Auth::user()->role;
        // dd($role);
        if ($role === "organizer") {
            return redirect()->route("events.index", ["sort" => "latest"]);
        } elseif ($role === "guest") {
            return redirect()->route("guest.events.index", [
                "sort" => "latest",
            ]);
        } else {
            abort(403);
        }
    }
}
