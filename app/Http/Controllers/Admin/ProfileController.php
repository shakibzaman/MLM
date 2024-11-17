<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $userData = User::where('id', $user->id)->first();
        $activities = $userData->activity()->paginate(20);
        return view('admin.profile', compact('userData', 'activities'));
    }
    public function edit()
    {
        $user = Auth::user();
        $userData = User::where('id', $user->id)->first();
        $activities = $userData->activity()->paginate(20);
        return view('admin.profile.edit-profile', compact('userData', 'activities'));
    }
    public function setting()
    {
        $user = Auth::user();
        $userData = User::where('id', $user->id)->first();
        return view('admin.profile.settings', compact('userData'));
    }
    public function verifyCode(Request $request)
    {
        $request->validate([
            'verification_code' => 'required',
        ]);

        $user = Auth::user();
        $user = User::where('id', $user->id)->first();

        if ($user->password_reset_code === $request->verification_code) {
            // Update the password
            $user->password = $user->temp_new_password;
            $user->password_reset_code = null; // Clear the code
            $user->temp_new_password = null;  // Clear the temporary password
            $user->save();

            return redirect()->route('profile.setting')->with('success', 'Your password has been successfully changed.');
        }

        return back()->withErrors(['verification_code' => 'The verification code is invalid.']);
    }
    public function showVerify()
    {
        return view('admin.profile.verify-code');
    }

    public function update(Request $request)
    {
        $request->validate([
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif', // Validation for profile image
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif', // Validation for cover image
        ]);

        try {
            // $user = Auth::user(); // Get the authenticated user
            $user = User::where('id', Auth::user()->id)->first();
            // Handle avatar upload
            if ($request->hasFile('avatar')) {
                // Delete the old avatar if it exists
                if ($user->avatar && Storage::exists('public/' . $user->avatar)) {
                    Storage::delete('public/' . $user->avatar);
                }

                // Store the new avatar
                $imagePath = $request->file('avatar')->store('user_images', 'public');
                $user->avatar = $imagePath;
            }

            // Handle cover image upload
            if ($request->hasFile('cover_image')) {
                // Delete the old cover image if it exists
                if ($user->cover_image && Storage::exists('public/' . $user->cover_image)) {
                    Storage::delete('public/' . $user->cover_image);
                }

                // Store the new cover image
                $coverImagePath = $request->file('cover_image')->store('user_cover_images', 'public');
                $user->cover_image = $coverImagePath;
            }

            // Update other fields
            $user->username = $request->input('username');
            $user->phone = $request->input('phone');
            $user->email = $request->input('email');
            $user->save();

            // Log success message
            info('User updated successfully.', [$user]);

            // Redirect with success message
            return redirect()->route('profile.edit')->with('success', 'Profile updated successfully.');
        } catch (Exception $e) {
            // Log exception message
            info('Exception occurred:', [$e]);

            // Return error message
            return back()->withErrors(['error' => 'An error occurred while updating the profile.']);
        }
    }
}
