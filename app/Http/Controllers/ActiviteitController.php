<?php

namespace App\Http\Controllers;

use App\Enums\LeerjaarEnum;
use App\Models\Activiteit;
use App\Models\Kind;
use App\Models\Locatie;
use App\Models\Optie;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ActiviteitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id = null): View
    {
        // if admin, toon alle activiteiten
        if(auth()->user()->isAdmin)
        {
            return view ('activiteiten.indexAdmin', ['activiteiten'=> Activiteit::paginate(10)]);
        }
        elseif(auth()->user()->isAnimator)
        {
            $activiteiten['activiteiten']= Activiteit::whereDate('eindtijd', '>=', now())
                ->whereDate('starttijd', '<=', now() )
                ->orderBy('starttijd', 'asc')
            ->paginate(10);
            return view ('activiteiten.indexAnimator')->with($activiteiten);
        }

        // if geen kind werd geselecteerd, toon alle activiteiten
        elseif (empty($id))
        {
            $activiteiten['activiteiten']= Activiteit::whereDate('eindtijd', '>=', now())
            ->orderBy('starttijd', 'asc')
            ->paginate(10);
            return view ('activiteiten.index')->with($activiteiten)->with('geselecteerdkind', $id);
        }

        // if kind werd geselecteerd, toon enkel activiteiten waar kind kan aan meedoen
        else
        {   $geselecteerdkind = Kind::find($id);

                    $activiteiten['activiteiten']= Activiteit::whereDate('eindtijd', '>=', now())
                        ->where('leerjaarVanaf', '<=', $geselecteerdkind->leerjaar)
                        ->where('leerjaarTot', '>=', $geselecteerdkind->leerjaar)
                        ->orderBy('starttijd', 'asc')
                        ->paginate(10);

            return view ('activiteiten.index')->with($activiteiten)->with(compact('geselecteerdkind'));
        }
    }

/**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('activiteiten.nieuw');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'naam'=> 'required|string|max:255'
        ]);
        Activiteit::create([
            'naam'=>$request->message,
        ]);
        return redirect(route('activiteiten.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show($activiteitid)
    {
        $activiteit = Activiteit::find($activiteitid);
        return view ('activiteiten.detail', compact('activiteit'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $activiteit = Activiteit::find($id);
        $locaties = Locatie::all();
        return view('activiteiten.edit', compact('activiteit', 'locaties'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'locatie_id' => 'required|exists:locaties,id',
            'naam' => 'required|string|max:255',
            'omschrijving' => 'nullable|string|max:255',
            'prijs' => 'required|numeric',
            'capaciteit' => 'required|integer',
            'starttijd' => 'required|date',
            'eindtijd' => 'required|date',
            'inschrijvenVanaf' => 'required|date',
            'inschrijvenTot' => 'required|date',
            'annulerenTot' => 'required|date',
            'leerjaarVanaf' => 'required|integer',
            'leerjaarTot' => 'required|integer',
            'existing_opties.*.omschrijving' => 'required_with:existing_opties.*.prijs',
            'existing_opties.*.prijs' => 'required_with:existing_opties.*.omschrijving|numeric',
            'new_opties.*.omschrijving' => 'nullable|string',
            'new_opties.*.prijs' => 'nullable|numeric',
        ]);

        $activiteit = Activiteit::findOrFail($id);
        $activiteit->update($request->only([
            'locatie_id', 'naam', 'omschrijving', 'prijs', 'capaciteit',
            'starttijd', 'eindtijd', 'inschrijvenVanaf', 'inschrijvenTot',
            'annulerenTot', 'leerjaarVanaf', 'leerjaarTot'
        ]));

        $existingOptionIds = $activiteit->opties->pluck('id')->toArray();
        $optionsToDelete = $request->delete_opties ? array_diff($existingOptionIds, $request->delete_opties) : $existingOptionIds;

        Optie::destroy($optionsToDelete);

        if ($request->has('existing_opties')) {
            foreach ($request->existing_opties as $optieId => $optieData) {
                Optie::where('id', $optieId)->update($optieData);
            }
        }

        if ($request->has('new_opties')) {
            foreach ($request->new_opties as $optieData) {
                if (!empty($optieData['omschrijving']) && !empty($optieData['prijs'])) {
                    $activiteit->opties()->create($optieData);
                }
            }
        }

        return redirect()->route('activiteiten.index')->with('status', 'activiteit-updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Activiteit $activiteit)
    {
        //
    }
}
