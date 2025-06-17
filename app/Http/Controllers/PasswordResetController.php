<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{
    public function create()
    {
        return view("auth.forgot-password");
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "email" => ["required", "email"],
        ]);

        $status = Password::sendResetLink($request->only("email"));

        if ($status == Password::ResetLinkSent) {
            return back()->with(["status" => __($status)]);
        } else {
            return back()->withErrors(["email" => __($status)]);
        }
    }

    public function edit(string $token)
    {
        return view("auth.reset-password", [
            "token" => $token,
        ]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            "token" => ["required"],
            "email" => ["required", "email"],
            "password" => ["required", "min:6", "confirmed"],
        ]);

        $status = Password::reset(
            $request->only(["email", "password", "confirm_password", "token"]),
            function (User $user, string $password) {
                $user
                    ->forceFill([
                        "password" => Hash::make($password),
                    ])
                    ->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status == PasswordReset
            ? redirect("/login")->with("status", __(status))
            : back()->withErrors(["email" => __($status)]);
    }
}
