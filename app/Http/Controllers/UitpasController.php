<?php

namespace App\Http\Controllers;

use App\Models\Uitpas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class UitpasController extends Controller
{
    /**
     * Get the uitpasstatus of a child
     */
    public function uitpasKind($insNumber)
    {
        $inszNumber = str_replace(['.', '-'], '', $insNumber);

        //Haal de uitpasgegevens van het kind op.
        $url='https://api-test.uitpas.be/insz-numbers/'.$inszNumber;
        $token = Cache::get('uitpastoken');
        $uitpasKind = Http::withToken($token)->get($url);

        // als respons = 401, vraag nieuwe access token op en retry
        if ($uitpasKind->status() === 401)
        {
            $this->create();
            return $this->uitpasKind($insNumber);
        }
        else return($uitpasKind->body());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //todo:: in activiteit en sale: als accesstoken in cache niet bestaat OF
        // als api request met token, returns 401:
        // get new access token:


        // vraag inloggegevens op in db
        $client = Uitpas::find(1);
        // maak verbinding met uitpas om de access token aan te vragen
        $response = Http::post('https://account-test.uitid.be/oauth/token', [
            'client_id' => $client->clientId,
            'client_secret' => $client->clientSecret,
            'audience' => 'https://api.publiq.be',
            'grant_type' => 'client_credentials'
        ]);
        // sla token op in cache
        // Todo:: vragen aan beoordelers: is het veiliger om tokens op te slaan in cache of beter in db??
        $access=$response->json('access_token');
        $expire=$response->json('expires_in');
        Cache::put('uitpastoken', $access);
        Cache::put('expires_in', $expire);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Uitpas $uitpas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Uitpas $uitpas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Uitpas $uitpas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Uitpas $uitpas)
    {
        //
    }
}
