<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuestEventController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::query();
        $query->where("archived", false)->with("user:id,first_name,last_name");

        switch ($request->sort) {
            case "az":
                $query->orderBy("title", "asc");
                break;
            case "za":
                $query->orderBy("title", "desc");
                break;
            case "upcoming":
                $query->where("start_date", ">", now());
                break;
            case "latest":
            case null:
                $query->latest();
                break;
            default:
                abort(404);
        }

        $events = $query->get();

        return view("profile.dashboard", compact("events"));
    }
}
