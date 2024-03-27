<?php

namespace App\Http\Controllers;

use App\Models\Kind;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use App\Models\User;

class KindController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->isAdmin){
            $kinderen['kinderen'] = Kind::with("user")->get();
            return view ('kinderen.indexAdmin')->with($kinderen);
        }
        else {
            $kinderen['kinderen'] = Kind::where('user_id', auth()->id())->get();
            return view ('kinderen.indexOuder')->with($kinderen);
        }



    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kinderen.nieuw');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'voornaam'=> 'required|string|max:255',
            'familienaam'=> 'required|string|max:255',
            'rijksregisternummer'=> 'required|string|max:40',
            'contactpersoon'=> 'required|string|max:255',
            'uitpasnummer'=> 'nullable|string|max:30',
            'beperking'=> 'nullable|string|max:255',
            'allergie'=> 'nullable|string|max:255',
            'medicatie'=> 'nullable|string|max:255',
            'afhalenKind'=> 'nullable|string|max:255',
            'infoAdmin'=> 'string|max:510',
            'infoAdminAnimator'=> 'string|max:510',
            'alleenNaarHuis' => 'boolean',
            'fotoToestemming' => 'boolean'
        ]);

        $request->user()->kinds()->create($validated);
        return redirect(route('kinderen.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Kind $kind)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kind $kind)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kind $kind)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kind $kind)
    {
        //
    }
}
