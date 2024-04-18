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
            $inschrijvingsdetails['inschrijvingsdetails'] = Inschrijvingsdetail::select('*', 'inschrijvingsdetails.id AS inschrijvingsdetails_id')->paginate(20);
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
     * Display a listing of the resource by Activity.
     */
    public function indexActiviteit($id): View
    {
            $inschrijvingsdetails['inschrijvingsdetails']= Inschrijvingsdetail::select('*', 'inschrijvingsdetails.id AS inschrijvingsdetails_id')
                ->where('activiteit_id', '=', $id)
                ->withTrashed()
                ->orderBy('inschrijvingsdatum', 'desc')
                ->get();
            return view ('inschrijvingsdetails.perActiviteit.index')->with($inschrijvingsdetails);
    }

    /**
     * Display a listing of printable lists by Activity.
     */
    public function indexLijsten($id): View
    {
        $activiteit = Activiteit::select('*')
        ->where('id', '=', $id)
        ->first();
        return view ('inschrijvingsdetails.perActiviteit.lijsten', compact('activiteit'));
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
     * Display the specified resource.
     */
    public function showLijst($id, $modus)
    {
        switch ($modus){
            case 'alleKinderen':
                $lijstnaam = "alle kinderen";
                 break;
            case 'aanwezigeKinderen':
                $lijstnaam = "aanwezige kinderen";
                break;
            case 'medisch':
                $lijstnaam = "medische gegevens";
                break;
            case 'medicatie':
                $lijstnaam = "medicatie";
                break;
            case 'allergie':
                $lijstnaam = "allergieën";
                break;
            case 'opties':
                $lijstnaam = "opties";
                break;
            case 'alleContact':
                $lijstnaam = "alle kinderen met contactgegevens";
                break;
        }
        $inschrijvingen= Inschrijvingsdetail::select('*')
            ->where('activiteit_id', '=', $id)
            ->orderBy('inschrijvingsdatum', 'desc')
            ->get();
        return view ('inschrijvingsdetails.perActiviteit.lijst', ['lijstnaam'=>$lijstnaam, 'inschrijvingen'=>$inschrijvingen]);



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

        //update aantal inschrijvingen in activiteit
        $activiteitsid = $inschrijvingsdetail->activiteit_id;
        $activiteit = Activiteit::find($activiteitsid);
        $inschrijvingen = $activiteit->aantalInschrijvingen -1;
        $activiteit->update(['aantalInschrijvingen' => $inschrijvingen]);

        // verwijder bijhorende opties waarvoor ingeschreven werd
        foreach ($inschrijvingsdetail->inschrijvingsdetail_opties as $opties) {
            $optie = Inschrijvingsdetail_optie::find($opties->id);
            $optie->delete();
        }

        // verwijder inschrijving
        $inschrijvingsdetail->delete();

        return redirect(route('inschrijvingsdetails.index'))->with('status', 'inschrijving-verwijderd');
    }
}
