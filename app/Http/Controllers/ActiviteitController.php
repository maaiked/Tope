<?php

namespace App\Http\Controllers;

use App\Enums\LeerjaarEnum;
use App\Models\Activiteit;
use App\Models\Kind;
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
            return view ('activiteiten.index', ['activiteiten'=> Activiteit::paginate(10)]);
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
        //
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
    public function edit(Activiteit $activiteit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Activiteit $activiteit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Activiteit $activiteit)
    {
        //
    }
}
