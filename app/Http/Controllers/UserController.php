<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query()->with(['roles', 'company']);

        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('email', 'like', '%' . $searchTerm . '%');
            });
        }

        $query->orderBy('id', 'desc');

        if ($request->filled('sort')) {
            $direction = $request->input('direction', 'desc');
            if (in_array($direction, ['asc', 'desc'])) {
                $query->orderBy($request->input('sort'), $direction);
            }
        }

        $users = $query->paginate(25);

        return view('dashboard.users.index', [
            'users' => $users
        ]);
    }

    public function profile()
    {
        return view('dashboard.users.profile', [
            'user' => Auth::user()
        ]);
    }

    public function update(UpdateUserProfileRequest $request)
    {
        $user = Auth::user();

        $user->update($request->validated());

        return redirect()->route('user.profile')
            ->with('success', __('dashboard.profile_updated'));
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
            ->with('success', __('dashboard.password_updated'));
    }

    public function loginAs(Request $request)
    {
        $request->validate([
            'user_id' => ['required', 'exists:users,id']
        ]);

        $user = User::findOrFail($request->input('user_id'));

        // Check if the user is not the currently authenticated user
        if ($user->id === Auth::id()) {
            return redirect()->back()->withErrors(['error' => 'You cannot log in as yourself.']);
        }

        Auth::login($user);

        return redirect()->route('dashboard')
            ->with('success', __('dashboard.logged_in_as', ['user' => $user->name]));

    }
}
