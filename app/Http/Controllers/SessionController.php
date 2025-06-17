<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function create()
    {
        return view("auth.login");
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "email" => ["required", "email"],
            "password" => ["required"],
        ]);
        $remember = $request->boolean("remember");

        if (Auth::attempt($validated, $remember)) {
            $request->session()->regenerate();
            return redirect()->intended("/dashboard");
        }

        return back()
            ->withErrors([
                "email" => "Please check your credentials and try again",
            ])
            ->withInput();
    }

    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect("/");
    }
}
