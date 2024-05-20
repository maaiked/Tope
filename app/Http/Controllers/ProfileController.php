<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Symfony\Component\HttpKernel\Profiler\Profile;
use function Webmozart\Assert\Tests\StaticAnalysis\string;

class ProfileController extends Controller
{

    public function index()
    {
        $users['users'] = User::where('isAdmin', true)
            ->orWhere('isAnimator', true)
            ->get();

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
     * Update whether the user is an Admin or Animator.
     */
    public function updateAdmin(Request $request): RedirectResponse
    {


        $isAdmin = $request->input('isAdmin', 0);

        $user = User::findOrFail($request->input("user_id"));

        if ($isAdmin) {
            $user->isAdmin = true;
            $user->isAnimator = false;
        } else {
            $user->isAdmin = false;
            $user->isAnimator = true;
        }

        $user->save();

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
