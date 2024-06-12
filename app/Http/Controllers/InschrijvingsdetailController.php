<?php

namespace App\Http\Controllers;

use App\Models\Activiteit;
use App\Models\Inschrijvingsdetail;
use App\Models\Inschrijvingsdetail_optie;
use App\Models\Kind;
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
            $inschrijvingsdetails= Inschrijvingsdetail::select('*', 'inschrijvingsdetails.id AS inschrijvingsdetails_id')
                ->where('activiteit_id', '=', $id)
                ->withTrashed()
                ->orderBy('inschrijvingsdatum', 'desc')
                ->get();
            $activiteit = Activiteit::find($id);
            return view ('inschrijvingsdetails.perActiviteit.index')->with(['inschrijvingsdetails' => $inschrijvingsdetails, 'activiteit'=>$activiteit]);
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
    public function create(Request $request)
    {
        $validated = $request->validate([
            'zoek'=> 'required|string|max:255',
            'activiteit'=>'required|int']);
        $activiteit = Activiteit::find($validated['activiteit']);

        if (auth()->user()->isAdmin){
            $kinderen = Kind::where(function ($query) use ($validated)
            {
                $query->where('voornaam', 'like', '%'.$validated['zoek'].'%')
                    ->orWhere('familienaam', 'like', '%'.$validated['zoek'].'%')
                    ->orWhere('rijksregisternummer', 'like', '%'.$validated['zoek'].'%')
                    ->orWhere('uitpasnummer', 'like', '%'.$validated['zoek'].'%');
            })->get();
        } else {
            $kinderen = Kind::where(function ($query) use ($validated)
            {
                $query->where('voornaam', 'like', '%'.$validated['zoek'].'%')
                    ->orWhere('familienaam', 'like', '%'.$validated['zoek'].'%')
                    ->orWhere('rijksregisternummer', 'like', '%'.$validated['zoek'].'%')
                    ->orWhere('uitpasnummer', 'like', '%'.$validated['zoek'].'%');
            })->where('leerjaar', '>=', $activiteit->leerjaarVanaf)
                ->where('leerjaar', '<=', $activiteit->leerjaarTot)
                ->get();
        }


        // verwijder kinderen die reeds ingeschreven zijn uit array
        $arraynr = 0;
        foreach ($kinderen as $kind)
        {
            $inschrijving = Inschrijvingsdetail::whereKindId($kind->id)->whereActiviteitId($activiteit->id)->first();
            if ($inschrijving)
            {
                unset($kinderen[$arraynr]);
            }
            $arraynr = $arraynr+1;
        }
        if (count($kinderen) == 0)
            return \Redirect::Route('inschrijvingsdetails.indexActiviteit', $activiteit)->with('error', 'Er werd geen kind gevonden met de gevraagde parameters');
        else
            return view('inschrijvingsdetails.perActiviteit.nieuw')->with(['kinderen' =>$kinderen, 'activiteit'=>$activiteit]);
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
                    return \Redirect::route('activiteiten.show', $request->input('activiteit'));


        // als knop 'inschrijven' werd aangeklikt, maak inschrijving aan
            case 'inschrijven':
                $activiteit = Activiteit::find($request->activiteit);

                // als capaciteit activiteit niet vol is, maak inschrijving aan
                if ($activiteit->aantalInschrijvingen < $activiteit->capaciteit)
                {
                    //update aantalInschrijvingen
                    $inschrijvingen = $activiteit->aantalInschrijvingen +1;
                    $activiteit->update(['aantalInschrijvingen' => $inschrijvingen]);


                    $kind = Kind::find($request->kindid);

                    //controleer of uitpasinfo up to date is
                    if($kind->uitpasDatumCheck < today())
                    {
                        (new KindController())->uitpasInfo($kind->id);
                    }

                    // als kind -> kansentarief, registreer verkoop bij uitpas
                    if($kind->uitpasKansentarief === 'ACTIVE')
                    {
                        $uitpasverkoop = (new UitpasController)->uitpasTicket($activiteit, $kind);
                        $verkoopbody = json_decode($uitpasverkoop->body());
                        if($uitpasverkoop->successful())
                        {
                            $totaalprijs = $activiteit->uitdatabank_kansentarief;
                            $uitid = $verkoopbody[0]->id;
                            $message = "Inschrijving met kansentarief succesvol";
                        }
                        else {
                            $totaalprijs = $activiteit->prijs;
                            $message = $verkoopbody->endUserMessage->nl;
                        }
                    }
                    else
                    {
                        $totaalprijs = $request->prijs;
                        $message = "Inschrijving succesvol";
                    }
                    // bereken totaalprijs (activiteit + opties)
                    foreach ($activiteit->opties as $optie)
                    {
                        if ($request->has($optie->omschrijving))
                        {
                            $totaalprijs += $optie->prijs;
                        }
                    }

                    // maak inschrijving aan
                    $inschrijvingsdetail = Inschrijvingsdetail::create(
                        ['kind_id' => $request->kindid,
                            'activiteit_id' => $request->activiteit,
                            'prijs' => $totaalprijs,
                            'inschrijvingsdatum' => today(),
                            'uitpasid' => $uitid ?? null
                        ]
                    );

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

                // als activiteit volzet is:
                else $message = "Helaas, de activiteit is reeds volzet";
                $request->session()->put('success', $message);
                if (auth()->user()->isAnimator || auth()->user()->isAdmin)
                {
                    return \Redirect::Route('inschrijvingsdetails.indexActiviteit', $activiteit);
                }
                else
                {
                    return \Redirect::Route('activiteiten.index', $request->kindid);
                }

        }
        return redirect(route('dashboard'));
    }


    /**
     * Display the specified resource.
     */

    //todo :: beveilig zodat user enkel attest van eigen kinderen kan raadplegen.
    // maar dat admin dit van iedereen kan zien
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
    public function edit($activiteitid, $i, $detail)
    {
        $activiteit = Activiteit::find($activiteitid);
        $is = Inschrijvingsdetail::find($i);
        switch ($detail)
        {
            case 'inchecken':
                if (!$is->ingechecked)
                {
                    $is->update(['ingechecked' => true]);
                }
                else $is->update(['ingechecked' => false]);
                break;
            case 'uitchecken':
                if (!$is->uitgechecked)
                {
                    $is->update(['uitgechecked' => true]);
                }
                else $is->update(['uitgechecked' => false]);
                break;
        }
        return \Redirect::Route('inschrijvingsdetails.indexActiviteit', $activiteit);
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

        //indien uitpasverkoop, verwijder ticket in uitpas
        if (!empty($inschrijvingsdetail->uitpasid))
        {
          (new UitpasController)->uitpasDeleteTicket($inschrijvingsdetail->uitpasid);
        }

        // verwijder inschrijving
        $inschrijvingsdetail->delete();

        return redirect(route('inschrijvingsdetails.index'))->with('success', 'De inschrijving werd verwijderd voor '.$inschrijvingsdetail->kind->voornaam.' '.$inschrijvingsdetail->kind->familienaam.' in activiteit '.$activiteit->naam);
    }

    /**
     * Create deelname attest.
     */

    public function createAttestZiekenfonds($id)
    {
        // Maak ziekenfonds attest beschikbaar voor elke inschrijving in deze activiteit door ziekenfondsattest datum in te stellen
        $inschrijvingsdetails= Inschrijvingsdetail::select('*', 'inschrijvingsdetails.id AS inschrijvingsdetails_id')
            ->where('activiteit_id', '=', $id)
            ->get();
        foreach ($inschrijvingsdetails as $i)
        {
            $i->update(['ziekenfondsAttest' => today()]);
        }
        return redirect(route('inschrijvingsdetails.indexActiviteit',$id))->with('success', 'De ziekenfondsattesten werden aangemaakt.');;
    }

    /**
     * Show ziekenfondsattest
     */
//todo :: beveilig zodat user enkel ziekenfondsattest van eigen kinderen kan raadplegen.
// maar dat admin dit van iedereen kan zien  + maak PDF
    public function ziekenfondsattest($id)
    {
        // toon ziekenfondsattest voor inschrijving
        $inschrijving = Inschrijvingsdetail::find($id);
         return view('attesten.ziekenfonds', compact('inschrijving'));
    }
}
