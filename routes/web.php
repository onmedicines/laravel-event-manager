<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrganizerEventController;
use App\Http\Controllers\PasswordResetController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\GuestEventController;
use App\Http\Controllers\TicketController;

Route::middleware(["guest"])->group(function () {
    /**
     * Welcome page
     */
    Route::get("/", function () {
        return view("welcome");
    });

    /**
     * Show register page
     */
    Route::get("/register", [RegisteredUserController::class, "create"]);

    /**
     * Store registered user
     */
    Route::post("/register", [RegisteredUserController::class, "store"]);

    /**
     * Show login page
     */
    Route::get("/login", [SessionController::class, "create"])->name("login");

    /**
     * Create a session for the logged in user
     * also limit the amount of login attempts
     */
    Route::post("/login", [SessionController::class, "store"])->middleware(
        "throttle:login"
    );

    /**
     * Show the forgot password page
     */
    Route::get("/forgot-password", [
        PasswordResetController::class,
        "create",
    ])->name("password.request");

    /**
     * Send the password reset mail to the user
     */
    Route::post("/forgot-password", [
        PasswordResetController::class,
        "store",
    ])->name("password.email");

    /**
     * Show the password reset page to the user
     */
    Route::get("/reset-password/{token}", [
        PasswordResetController::class,
        "edit",
    ])->name("password.reset");

    /**
     * Reset the password
     */
    Route::post("/reset-password", [
        PasswordResetController::class,
        "update",
    ])->name("password.update");
});

Route::middleware(["auth"])->group(function () {
    /**
     * Logout a user
     */
    Route::delete("/logout", [SessionController::class, "destroy"]);

    /**
     * Display the dashboard for organizer
     */
    Route::get("/dashboard", [DashboardController::class, "view"])->name(
        "dashboard"
    );

    /**
     * CRUD for events for an organizer
     */
    Route::resource("/dashboard/events", OrganizerEventController::class);

    /**
     * Archive and Unarchive for events for an organizer
     */
    Route::patch("/dashboard/events/{event}/archive", [
        OrganizerEventController::class,
        "archive",
    ])->name("events.archive");
    Route::patch("/dashboard/events/{event}/unarchive", [
        OrganizerEventController::class,
        "unarchive",
    ])->name("events.unarchive");

    /**
     * Events for a guest/client
     * only show all events (no CRUD operations)
     */
    Route::get("/dashboard/buyer/events", [
        GuestEventController::class,
        "index",
    ])->name("guest.events.index");

    /**
     * Tickets for a guest/client
     */
    Route::controller(TicketController::class)->group(function () {
        Route::get("/dashboard/buyer/tickets", "index")->name("tickets.index");
        Route::post("/dashboard/buyer/events/{event}/tickets", "store")->name(
            "tickets.store"
        );
        Route::get("/dashboard/buyer/{ticket}", "show")->name("tickets.show");
    });
});
