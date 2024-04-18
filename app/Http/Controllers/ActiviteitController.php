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
            switch ($geselecteerdkind->leerjaar) {
                case LeerjaarEnum::KL1:
                    $activiteiten['activiteiten']= Activiteit::whereDate('eindtijd', '>=', now())
                        ->where('leerjaarVanaf', '=', '1ste kleuter' )
                        ->orderBy('starttijd', 'asc')
                        ->paginate(10);
                    break;
                case LeerjaarEnum::KL2:
                    $activiteiten['activiteiten']= Activiteit::whereDate('eindtijd', '>=', now())
                        ->whereIn('leerjaarVanaf', ['1ste kleuter', '2de kleuter'])
                        ->whereIn('leerjaarTot', ['2de kleuter', '3de kleuter', '1ste leerjaar', '2de leerjaar', '3de leerjaar', '4de leerjaar', '5de leerjaar', '6de leerjaar', '1ste middelbaar', '2de middelbaar', '3de middelbaar', '4de middelbaar', '5de middelbaar', '6de middelbaar'])
                        ->orderBy('starttijd', 'asc')
                        ->paginate(10);
                    break;
                case LeerjaarEnum::KL3:
                    $activiteiten['activiteiten']= Activiteit::whereDate('eindtijd', '>=', now())
                        ->whereIn('leerjaarVanaf', ['1ste kleuter', '2de kleuter', '3de kleuter'])
                        ->whereIn('leerjaarTot', ['3de kleuter', '1ste leerjaar', '2de leerjaar', '3de leerjaar', '4de leerjaar', '5de leerjaar', '6de leerjaar', '1ste middelbaar', '2de middelbaar', '3de middelbaar', '4de middelbaar', '5de middelbaar', '6de middelbaar'])
                        ->orderBy('starttijd', 'asc')
                        ->paginate(10);
                    break;
                case LeerjaarEnum::LJ1:
                    $activiteiten['activiteiten']= Activiteit::whereDate('eindtijd', '>=', now())
                        ->whereIn('leerjaarVanaf', ['1ste kleuter', '2de kleuter', '3de kleuter', '1ste leerjaar'])
                        ->whereIn('leerjaarTot', ['1ste leerjaar', '2de leerjaar', '3de leerjaar', '4de leerjaar', '5de leerjaar', '6de leerjaar', '1ste middelbaar', '2de middelbaar', '3de middelbaar', '4de middelbaar', '5de middelbaar', '6de middelbaar'])
                        ->orderBy('starttijd', 'asc')
                        ->paginate(10);
                    break;
                case LeerjaarEnum::LJ2:
                    $activiteiten['activiteiten']= Activiteit::whereDate('eindtijd', '>=', now())
                        ->whereIn('leerjaarVanaf', ['1ste kleuter', '2de kleuter', '3de kleuter', '1ste leerjaar', '2de leerjaar'])
                        ->whereIn('leerjaarTot', ['2de leerjaar', '3de leerjaar', '4de leerjaar', '5de leerjaar', '6de leerjaar', '1ste middelbaar', '2de middelbaar', '3de middelbaar', '4de middelbaar', '5de middelbaar', '6de middelbaar'])
                        ->orderBy('starttijd', 'asc')
                        ->paginate(10);
                    break;
                case LeerjaarEnum::LJ3:
                    $activiteiten['activiteiten']= Activiteit::whereDate('eindtijd', '>=', now())
                        ->whereIn('leerjaarVanaf', ['1ste kleuter', '2de kleuter', '3de kleuter', '1ste leerjaar', '2de leerjaar', '3de leerjaar'])
                        ->whereIn('leerjaarTot', ['3de leerjaar', '4de leerjaar', '5de leerjaar', '6de leerjaar', '1ste middelbaar', '2de middelbaar', '3de middelbaar', '4de middelbaar', '5de middelbaar', '6de middelbaar'])
                        ->orderBy('starttijd', 'asc')
                        ->paginate(10);
                    break;
                case LeerjaarEnum::LJ4:
                    $activiteiten['activiteiten']= Activiteit::whereDate('eindtijd', '>=', now())
                        ->whereIn('leerjaarVanaf', ['1ste kleuter', '2de kleuter', '3de kleuter', '1ste leerjaar', '2de leerjaar', '3de leerjaar', '4de leerjaar'])
                        ->whereIn('leerjaarTot', ['4de leerjaar', '5de leerjaar', '6de leerjaar', '1ste middelbaar', '2de middelbaar', '3de middelbaar', '4de middelbaar', '5de middelbaar', '6de middelbaar'])
                        ->orderBy('starttijd', 'asc')
                        ->paginate(10);
                    break;
                case LeerjaarEnum::LJ5:
                    $activiteiten['activiteiten']= Activiteit::whereDate('eindtijd', '>=', now())
                        ->whereIn('leerjaarVanaf', ['1ste kleuter', '2de kleuter', '3de kleuter', '1ste leerjaar', '2de leerjaar', '3de leerjaar', '4de leerjaar', '5de leerjaar'])
                        ->whereIn('leerjaarTot', ['5de leerjaar', '6de leerjaar', '1ste middelbaar', '2de middelbaar', '3de middelbaar', '4de middelbaar', '5de middelbaar', '6de middelbaar'])
                        ->orderBy('starttijd', 'asc')
                        ->paginate(10);
                    break;
                case LeerjaarEnum::LJ6:
                    $activiteiten['activiteiten']= Activiteit::whereDate('eindtijd', '>=', now())
                        ->whereIn('leerjaarVanaf', ['1ste kleuter', '2de kleuter', '3de kleuter', '1ste leerjaar', '2de leerjaar', '3de leerjaar', '4de leerjaar', '5de leerjaar', '6de leerjaar'])
                        ->whereIn('leerjaarTot', ['6de leerjaar', '1ste middelbaar', '2de middelbaar', '3de middelbaar', '4de middelbaar', '5de middelbaar', '6de middelbaar'])
                        ->orderBy('starttijd', 'asc')
                        ->paginate(10);
                    break;
                case LeerjaarEnum::MB1:
                    $activiteiten['activiteiten']= Activiteit::whereDate('eindtijd', '>=', now())
                        ->whereIn('leerjaarVanaf', ['1ste kleuter', '2de kleuter', '3de kleuter', '1ste leerjaar', '2de leerjaar', '3de leerjaar', '4de leerjaar', '5de leerjaar', '6de leerjaar', '1ste middelbaar'])
                        ->whereIn('leerjaarTot', ['1ste middelbaar', '2de middelbaar', '3de middelbaar', '4de middelbaar', '5de middelbaar', '6de middelbaar'])
                        ->orderBy('starttijd', 'asc')
                        ->paginate(10);
                    break;
                case LeerjaarEnum::MB2:
                    $activiteiten['activiteiten']= Activiteit::whereDate('eindtijd', '>=', now())
                        ->whereIn('leerjaarVanaf', ['1ste kleuter', '2de kleuter', '3de kleuter', '1ste leerjaar', '2de leerjaar', '3de leerjaar', '4de leerjaar', '5de leerjaar', '6de leerjaar', '1ste middelbaar', '2de middelbaar'])
                        ->whereIn('leerjaarTot', ['2de middelbaar', '3de middelbaar', '4de middelbaar', '5de middelbaar', '6de middelbaar'])
                        ->orderBy('starttijd', 'asc')
                        ->paginate(10);
                    break;
                case LeerjaarEnum::MB3:
                    $activiteiten['activiteiten']= Activiteit::whereDate('eindtijd', '>=', now())
                        ->whereIn('leerjaarVanaf', ['1ste kleuter', '2de kleuter', '3de kleuter', '1ste leerjaar', '2de leerjaar', '3de leerjaar', '4de leerjaar', '5de leerjaar', '6de leerjaar', '1ste middelbaar', '2de middelbaar', '3de middelbaar'])
                        ->whereIn('leerjaarTot', ['3de middelbaar', '4de middelbaar', '5de middelbaar', '6de middelbaar'])
                        ->orderBy('starttijd', 'asc')
                        ->paginate(10);
                    break;
                case LeerjaarEnum::MB4:
                    $activiteiten['activiteiten']= Activiteit::whereDate('eindtijd', '>=', now())
                        ->whereIn('leerjaarVanaf', ['1ste kleuter', '2de kleuter', '3de kleuter', '1ste leerjaar', '2de leerjaar', '3de leerjaar', '4de leerjaar', '5de leerjaar', '6de leerjaar', '1ste middelbaar', '2de middelbaar', '3de middelbaar', '4de middelbaar'])
                        ->whereIn('leerjaarTot', [ '4de middelbaar', '5de middelbaar', '6de middelbaar'])
                        ->orderBy('starttijd', 'asc')
                        ->paginate(10);
                    break;
                case LeerjaarEnum::MB5;
                    $activiteiten['activiteiten']= Activiteit::whereDate('eindtijd', '>=', now())
                        ->whereIn('leerjaarVanaf', ['1ste kleuter', '2de kleuter', '3de kleuter', '1ste leerjaar', '2de leerjaar', '3de leerjaar', '4de leerjaar', '5de leerjaar', '6de leerjaar', '1ste middelbaar', '2de middelbaar', '3de middelbaar', '4de middelbaar', '5de middelbaar'])
                        ->whereIn('leerjaarTot', ['5de middelbaar', '6de middelbaar'])
                        ->orderBy('starttijd', 'asc')
                        ->paginate(10);
                    break;
                case LeerjaarEnum::MB6;
                    $activiteiten['activiteiten']= Activiteit::whereDate('eindtijd', '>=', now())
                        ->whereIn('leerjaarVanaf', ['1ste kleuter', '2de kleuter', '3de kleuter', '1ste leerjaar', '2de leerjaar', '3de leerjaar', '4de leerjaar', '5de leerjaar', '6de leerjaar', '1ste middelbaar', '2de middelbaar', '3de middelbaar', '4de middelbaar', '5de middelbaar', '6de middelbaar'])
                        ->whereIn('leerjaarTot', [ '6de middelbaar'])
                        ->orderBy('starttijd', 'asc')
                        ->paginate(10);
                    break;
            }

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
