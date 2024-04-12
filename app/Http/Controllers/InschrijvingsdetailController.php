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
            $inschrijvingsdetails['inschrijvingsdetails'] = Inschrijvingsdetail::paginate(10);
            return view ('inschrijvingsdetails.index')->with($inschrijvingsdetails);
        }
        // if user: toon inschrijvingen van eigen kinderen
        else {
             $inschrijvingsdetails['inschrijvingsdetails']= Inschrijvingsdetail::join('kinds', 'inschrijvingsdetails.kind_id','=', 'kinds.id' )
                ->where('kinds.user_id', '=', auth()->user()->id)
                 ->orderBy('inschrijvingsdatum', 'desc')
                ->paginate(10);
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
        // basen on https://laracasts.com/discuss/channels/laravel/how-do-i-handle-multiple-submit-buttons-in-a-single-form-with-laravel
        switch ($request->input('action')){
            case 'info':
                    return \Redirect::route('activiteiten.show', $request->activiteit);
                break;
            case 'inschrijven':
                $totaalprijs = $request->prijs;
                $activiteit = Activiteit::find($request->activiteit);
                foreach ($activiteit->opties as $optie)
                {
                    if ($request->has($optie->omschrijving))
                    {
                        $totaalprijs += $optie->prijs;
                    }
                }
                $inschrijvingsdetail = Inschrijvingsdetail::create(
                    ['kind_id' => $request->kindid,
                        'activiteit_id' => $request->activiteit,
                        'prijs' => $totaalprijs,
                        'inschrijvingsdatum' => today()]
                );
                foreach ($activiteit->opties as $optie)
                {
                    if ($request->has($optie->omschrijving))
                    {
                       $inschrijvingsdetail_opties = new Inschrijvingsdetail_optie(['inschrijvingsdetail_id' => $inschrijvingsdetail->id, 'optie_id' => $optie->id]);
                       $inschrijvingsdetail_opties->save();
                    }
                }

                return \Redirect::Route('activiteiten.index');
                break;
        }
        return redirect(route('dashboard'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Inschrijvingsdetail $inschrijvingsdetail)
    {
        //
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
    public function destroy(Inschrijvingsdetail $inschrijvingsdetail)
    {
        //
    }
}
