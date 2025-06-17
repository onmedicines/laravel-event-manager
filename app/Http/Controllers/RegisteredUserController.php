<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Closure;
use Illuminate\Support\Facades\Auth;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view("auth.register");
    }

    public function store(Request $request)
    {
        $check_spaces = function (
            string $attribute,
            mixed $value,
            Closure $fail
        ) {
            foreach (str_split($value) as $c) {
                if (ctype_space($c)) {
                    $fail("The " . $attribute . " cannot have spaces");
                    return;
                }
            }
        };

        $validated = $request->validate([
            "first_name" => ["required", "min:3"],
            "last_name" => ["required", "min:3"],
            "email" => ["required", "email"],
            "password" => ["min:6", "confirmed", $check_spaces],
            "role" => ["required", "exists:roles"],
        ]);

        $user = User::create($validated);

        Auth::login($user);

        return redirect("/dashboard");
    }
}
