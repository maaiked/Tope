<?php

namespace App\Http\Controllers;

use App\Models\Locatie;
use Illuminate\Http\Request;

class LocatieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $locaties = Locatie::all();
        return view('locaties.index', compact('locaties'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('locaties.nieuw');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'naam' => 'required|string|max:255',
            'straat' => 'required|string|max:255',
            'gemeente' => 'required|string|max:255',
        ]);

        Locatie::create($validated);

        return redirect()->route('locatie.index')->with('status', 'locatie-created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Locatie $locatie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Locatie $locatie)
    {
        return view('locaties.edit', compact('locatie'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Locatie $locatie)
    {
        $validated = $request->validate([
            'naam' => 'required|string|max:255',
            'straat' => 'required|string|max:255',
            'gemeente' => 'required|string|max:255',
        ]);

        $locatie->update($validated);

        return redirect()->route('locatie.index')->with('status', 'locatie-updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Locatie $locatie)
    {
        //
    }
}
