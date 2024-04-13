<?php

namespace App\Http\Controllers;

use App\Models\Activiteit;
use App\Models\Inschrijvingsdetail;
use App\Models\Inschrijvingsdetail_optie;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InschrijvingsdetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        // if admin: toon alle inschrijvingen
        if (auth()->user()->isAdmin){
            $inschrijvingsdetails['inschrijvingsdetails'] = Inschrijvingsdetail::paginate(20);
            return view ('inschrijvingsdetails.index')->with($inschrijvingsdetails);
        }
        // if user: toon inschrijvingen van eigen kinderen
        else {
             $inschrijvingsdetails['inschrijvingsdetails']= Inschrijvingsdetail::join('kinds', 'inschrijvingsdetails.kind_id','=', 'kinds.id' )
                 ->select('*', 'inschrijvingsdetails.id AS inschrijvingsdetails_id')
                ->where('kinds.user_id', '=', auth()->user()->id)
                 ->orderBy('inschrijvingsdatum', 'desc')
                 ->paginate(20);
            return view ('inschrijvingsdetails.index')->with($inschrijvingsdetails);
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
        // based on https://laracasts.com/discuss/channels/laravel/how-do-i-handle-multiple-submit-buttons-in-a-single-form-with-laravel

        // als knop 'meer info' werd aangeklikt, ga naar detailpagina activiteit
        switch ($request->input('action')){
            case 'info':
                    return \Redirect::route('activiteiten.show', $request->activiteit);
                break;

        // als knop 'inschrijven' werd aangeklikt, maak inschrijving aan
            case 'inschrijven':
                $activiteit = Activiteit::find($request->activiteit);
                // bereken totaalprijs (prijs activiteit + prijs opties)
                $totaalprijs = $request->prijs;
                foreach ($activiteit->opties as $optie)
                {
                    if ($request->has($optie->omschrijving))
                    {
                        $totaalprijs += $optie->prijs;
                    }
                }
                // als capaciteit activiteit niet vol is, maak inschrijving aan
                if ($activiteit->aantalInschrijvingen < $activiteit->capaciteit){
                    $inschrijvingsdetail = Inschrijvingsdetail::create(
                        ['kind_id' => $request->kindid,
                            'activiteit_id' => $request->activiteit,
                            'prijs' => $totaalprijs,
                            'inschrijvingsdatum' => today()]
                    );
                    //update aantalInschrijvingen
                    $inschrijvingen = $activiteit->aantalInschrijvingen +1;
                    $activiteit->update(['aantalInschrijvingen' => $inschrijvingen]);
                    // als opties werden toegevoegd aan de inschrijving, sla deze op
                    foreach ($activiteit->opties as $optie)
                    {
                        if ($request->has($optie->omschrijving))
                        {
                            $inschrijvingsdetail_opties = new Inschrijvingsdetail_optie(['inschrijvingsdetail_id' => $inschrijvingsdetail->id, 'optie_id' => $optie->id]);
                            $inschrijvingsdetail_opties->save();
                        }
                    }
                }
                return \Redirect::Route('activiteiten.index', $request->kindid);
                break;
        }
        return redirect(route('dashboard'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // toon details van inschrijving
        $inschrijving = Inschrijvingsdetail::find($id);
        return view('inschrijvingsdetails.detail', compact('inschrijving'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inschrijvingsdetail $inschrijvingsdetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Inschrijvingsdetail $inschrijvingsdetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $inschrijvingsdetail = Inschrijvingsdetail::find($id);

        //update aantalInschrijvingen
        $activiteitsid = $inschrijvingsdetail->activiteit_id;
        $activiteit = Activiteit::find($activiteitsid);
        $inschrijvingen = $activiteit->aantalInschrijvingen -1;
        $activiteit->update(['aantalInschrijvingen' => $inschrijvingen]);

        // verwijder inschrijving
        $inschrijvingsdetail->delete();

        return redirect(route('inschrijvingsdetails.index'))->with('status', 'inschrijving-verwijderd');
    }
}
