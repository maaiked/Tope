<?php

namespace App\Http\Controllers;

use App\Models\Profiel;
use App\Models\User;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isNull;

class ProfielController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $userprofiel = Profiel::where('user_id', auth()->id())->first();
        if($userprofiel === null) {
            return view('profiel.nieuw');
        }
        else {
            return redirect(route('profiel.edit'));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'voornaam'=> 'required|string|max:255',
            'familienaam'=> 'required|string|max:255',
            'straat'=> 'required|string|max:255',
            'huisnummer'=> 'required|string|max:255',
            'bus'=> 'nullable|string|max:30',
            'postcode'=> 'required|string|max:255',
            'gemeente'=> 'required|string|max:255',
            'telefoonnummer'=> 'required|string|max:255',
            'rijksregisternummer'=> 'required|string|max:255',
        ]);

        $request->user()->profiel()->create($validated);
        return redirect(route('profiel.edit'))->with('status', 'profiel-updated');
    }

    /**
     * Display the specified resource.
     */
    public function show(Profiel $profiel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $userprofiel = Profiel::where('user_id', auth()->id())->first();
        return view('profiel.edit', compact('userprofiel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Profiel $profiel)
    {
        $validated = $request->validate([
            'voornaam'=> 'required|string|max:255',
            'familienaam'=> 'required|string|max:255',
            'straat'=> 'required|string|max:255',
            'huisnummer'=> 'required|string|max:255',
            'bus'=> 'nullable|string|max:30',
            'postcode'=> 'required|string|max:255',
            'gemeente'=> 'required|string|max:255',
            'telefoonnummer'=> 'required|string|max:255',
            'rijksregisternummer'=> 'required|string|max:255',
        ]);

        $request->user()->profiel()->update($validated);
        return redirect(route('profiel.edit'))->with('status', 'profiel-updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profiel $profiel)
    {
        //
    }
}