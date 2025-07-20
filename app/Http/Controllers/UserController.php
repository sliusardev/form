<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function profile()
    {
        return view('dashboard.profile', [
            'user' => Auth::user()
        ]);
    }

    public function update(UpdateUserProfileRequest $request)
    {
        $user = Auth::user();

        $user->update($request->validated());

        return redirect()->route('user.profile')
            ->with('success', 'Profile updated successfully.');
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $rules = [
            'password' => ['required', 'confirmed', Password::defaults()],
        ];

        // Only require current password if user already has one
        if ($user->password) {
            $rules['current_password'] = ['required', 'current_password'];
        }

        $request->validate($rules);

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('user.profile')
            ->with('success', 'Password updated successfully.');
    }
}
