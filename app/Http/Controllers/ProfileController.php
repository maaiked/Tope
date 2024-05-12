<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{

    public function index()
    {
        $users['users'] = User::all();
        return view('profile.indexAdmin')->with($users);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('profile.nieuw');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email'=> 'required|email:rfc,dns|unique:users|max:255',
            'password'=> 'required|string|max:255',
            'isAdmin'=> 'bool',
        ]);

        $request->user()->create($validated);
        return redirect(route('profile.index'));
    }

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
     * Update if the user is an Admin or Animator.
     */
    public function updateAdmin(ProfileUpdateRequest $request): RedirectResponse
    {
        if ($request->has('isAdmin') && $request->get('isAdmin') == 1) {
            $request->user->isAdmin = true;
            $request->user->isAnimator = false;
        } else {
            $request->user->isAdmin = false;
            $request->user->isAnimator = true;
        }

        $request->user->save();

        return Redirect::route('profile.index')->with('status', 'profile-updated');
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
}
