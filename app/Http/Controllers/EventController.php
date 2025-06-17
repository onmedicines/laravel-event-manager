<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $organizer = Auth::user();
        $query = $organizer->events();

        switch ($request->query("sort")) {
            case "az":
                $query->where("archived", false)->orderBy("title", "asc");
                break;
            case "za":
                $query->where("archived", false)->orderBy("title", "desc");
                break;
            case "upcoming":
                $query
                    ->where("archived", false)
                    ->where("start_date", ">", now());
                break;
            case "ongoing":
                $query
                    ->where("archived", false)
                    ->where("start_date", "<=", now())
                    ->where("end_date", ">=", now());
                break;
            case "archived":
                $query->where("archived", true);
                break;
            case "latest":
            case null:
                $query->where("archived", false)->latest();
                break;
            default:
                abort(404);
        }

        $events = $query->get();

        return view("profile.dashboard", compact("events"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->cannot("create", Event::class)) {
            abort(403);
        }
        return view("events.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Auth::user()->cannot("create", Event::class)) {
            abort(403);
        }

        $validated = $request->validate([
            "title" => ["required", "string", "max:150"],
            "description" => ["required", "string"],
            "category" => [
                "required",
                "string",
                "in:Music,Technology,Art,Business,Sports,Education,Other",
            ],
            "start_time" => ["required", "date"],
            "end_time" => ["nullable", "date", "after_or_equal:start_time"],
            "location" => ["required", "string"],
            "landmark" => ["nullable", "string"],
            // 'latitude' and 'longitude'
            "price" => ["required", "numeric", "min:0"],
            "capacity" => ["nullable", "integer", "min:1"],
            // "slug" => ["nullable","string","alpha_dash","unique:events,slug"],
        ]);
        $validated["user_id"] = Auth::id();

        $event = Event::create($validated);

        return redirect()->route("events.index", ["sort" => "latest"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        if (Auth::user()->cannot("view", $event)) {
            abort(403);
        }

        return view("events.show", [
            "event" => $event,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        if (Auth::user()->cannot("update", $event)) {
            abort(403);
        }

        return view("events.edit", [
            "event" => $event,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        if (Auth::user()->cannot("update", $event)) {
            abort(403);
        }

        $validated = $request->validate([
            "title" => ["required", "string", "max:150"],
            "description" => ["required", "string"],
            "category" => [
                "required",
                "string",
                "in:Music,Technology,Art,Business,Sports,Education,Other",
            ],
            "start_time" => ["required", "date"],
            "end_time" => ["nullable", "date", "after_or_equal:start_time"],
            "location" => ["required", "string"],
            "landmark" => ["nullable", "string"],
            // 'latitude' and 'longitude'
            "price" => ["required", "numeric", "min:0"],
            "capacity" => ["nullable", "integer", "min:1"],
            // "slug" => ["nullable","string","alpha_dash","unique:events,slug"],
        ]);

        $event->update($validated);

        return redirect()
            ->route("events.show", $event)
            ->with("success", "Event updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        if (Auth::user()->cannot("delete", $event)) {
            abort(403);
        }

        $event->delete();

        return redirect()->route("events.index");
    }

    /**
     * Archive the specified resource.
     */
    public function archive(Event $event)
    {
        if (Auth::user()->cannot("archive", $event)) {
            abort(403);
        }

        $event->archived = true;
        $event->save();

        return redirect()->route("events.index");
    }

    /**
     * Unarchive the specified resource.
     */
    public function unarchive(Event $event)
    {
        if (Auth::user()->cannot("archive", $event)) {
            abort(403);
        }

        $event->archived = false;
        $event->save();

        return redirect()->route("events.index");
    }
}
