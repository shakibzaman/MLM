<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::where('id', Auth::user()->id)->first();

        // Generate verification code
        $verificationCode = Str::random(6);

        // Save the code to the user session or a temporary database field
        $user->password_reset_code = $verificationCode;
        $user->temp_new_password = Hash::make($request->password); // Temporarily store the hashed password
        $user->save();

        // Send email with the code
        Mail::send('emails.password-verification', ['code' => $verificationCode], function ($message) use ($user) {
            $message->to($user->email)->subject('Password Change Verification Code');
        });
        return redirect()->route('verify.email')->with('success', 'A verification code has been sent to your email.');
        return back()->with('status', 'A verification code has been sent to your email.');

        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('status', 'password-updated');
    }
}
