<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
// db facade
use Illuminate\Support\Facades\DB;



use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function wallet(Request $request): View
    {
        return view('wallet');
    }
    public function portfolio(Request $request): View
    {
        return view('portfolio');
    }
    public function profile(Request $request): View
    {
        return view('profile');
    }
    public function changePassword(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'User is not authenticated.'], 401);
        }

        // Validate request data
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8',
        ]);

        $user = Auth::user();
        $plain_password = $request->new_password;

        // Check if the current password is correct
        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json(['error' => 'Current password is incorrect.'], 400);
        }

        try {
            // Update the password
            $hashed_password = Hash::make($plain_password);
            DB::update("UPDATE users set password= '$hashed_password',plain_password='$plain_password' where id = $user->id");

            return response()->json(['success' => 'Password changed successfully!'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to change password. Error: ' . $e->getMessage()], 500);
        }
    }
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
        ]);

        $user = Auth::user();
        $uid = $user->id;
        $user = User::find($uid);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();

        return response()->json(['message' => 'Profile updated successfully']);
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

}
