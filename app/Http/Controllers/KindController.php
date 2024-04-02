<?php

namespace App\Http\Controllers;

use App\Enums\LeerjaarEnum;
use App\Models\Kind;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Illuminate\View\View;
use App\Models\User;

class KindController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // als user = admin -> geef alle kinderen weer
        if (auth()->user()->isAdmin){
            $kinderen['kinderen'] = Kind::with("user")->get();
            return view ('kinderen.indexAdmin')->with($kinderen);
        }
        // als user = geen admin -> geef enkel eigen kinderen weer
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
            'fotoToestemming' => 'boolean',
            'leerjaar' => [Rule::enum(LeerjaarEnum::class)],
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
    public function edit($id)
    {
        // als kindid behoort tot ingelogde user, geef form weer
        $kind = Kind::find($id);
        if (auth()->id() == $kind->user->id ){
            return view('kinderen.edit', compact('kind'));
        }
        //als kindid niet behoort tot de ingelogde user, keer terug naar index
        else {
            return redirect(route('kinderen.index'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $kind = Kind::find($id);
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
            'fotoToestemming' => 'boolean',
            'leerjaar' => [new Enum(LeerjaarEnum::class)],
        ]);

        $kind->update($validated);
        return redirect(route('kinderen.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kind $kind)
    {
        //
    }
}
