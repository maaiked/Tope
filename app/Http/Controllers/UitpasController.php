<?php

namespace App\Http\Controllers;

use App\Models\Uitpas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use DateTimeInterface;

class UitpasController extends Controller
{
    /**
     * Get the uitpasstatus of a child
     */

    // Haal uitpasgegevens van kind op aan de hand van zijn rijksregisternummer
    public function uitpasKind($insNumber)
    {
        $inszNumber = str_replace(['.', '-'], '', $insNumber);

        //Haal de uitpasgegevens van het kind op.
        $url = 'https://api-test.uitpas.be/insz-numbers/' .$inszNumber;
        $token = Cache::get('uitpastoken');
        $uitpasKind = Http::withToken($token)->get($url);

        // als respons = 401 of 403 - don't ask me why hij 403 teruggeeft??, vraag nieuwe access token op en retry
        if ($uitpasKind->status() === 401 || $uitpasKind->status() === 403) {
            $this->create();
            return $this->uitpasKind($insNumber);
        } else return ($uitpasKind->body());
    }


    // Registreer een nieuwe activiteit in de uitpasdatabank
    public function uitpasNieuweActiviteit($activiteit)
    {
        //Geef het nieuwe event door naar uitpas
        $url = 'https://io-test.uitdatabank.be/events';
        $token = Cache::get('uitpastoken');
        $uitpasevent = Http::withToken($token)->post($url,
            $data = [
                'workflowStatus' => 'READY_FOR_VALIDATION',
                'mainLanguage' => 'nl',
                'name' => [
                    'nl' => $activiteit->naam
                ],
                //todo:: pas aan naar cache
                'organizer' => [
                    '@id' => 'https://io-test.uitdatabank.be/organizers/0ce87cbc-9299-4528-8d35-92225dc9489f'
                ],
                'priceInfo' => [
                    [
                        'category' => 'base',
                        'name' => [
                            'nl' => 'Basistarief'
                        ],
                        'price' => (int)$activiteit->prijs,
                        'priceCurrency' => 'EUR'
                    ]
                ],
                'calendarType' => 'single',
                'subEvent' => [
                    [
                        'startDate' => Carbon::parse($activiteit->starttijd)->toIso8601String(),
                        'endDate' => Carbon::parse($activiteit->eindtijd)->toIso8601String()
                    ]
                ],
                //todo:: pas aan naar cache
                'location' => [
                    '@id' => 'https://io-test.uitdatabank.be/place/8248e289-c986-4006-902f-b0616dcbcde7'
                ],
                'terms' => [
                    [
                        'id' => '0.50.4.0.0'
                    ]
                ]
            ]);


        // als respons = 401 of 403 - don't ask me why hij 403 teruggeeft??, vraag nieuwe access token op en retry
        if ($uitpasevent->status() === 401 || $uitpasevent->status() === 403) {
            $this->create();
            return $this->uitpasActiviteit($activiteit);
        } else
            return ($uitpasevent->body());
    }

    /**
     * Show the form for creating a new resource.
     */
    public
    function create()
    {
        //todo:: in activiteit en sale: als accesstoken in cache niet bestaat OF
        // als api request met token, returns 401:
        // get new access token:

        //todo:: add security to stop loop indien 401 door ander probleem komt.
        // check expires_in > today()+1day ??


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
        $access = $response->json('access_token');
        $expire = $response->json('expires_in');
        Cache::put('uitpastoken', $access);
        Cache::put('expires_in', $expire);
    }

    /**
     * Store a newly created resource in storage.
     */
    public
    function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public
    function show(Uitpas $uitpas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public
    function edit(Uitpas $uitpas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public
    function update(Request $request, Uitpas $uitpas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public
    function destroy(Uitpas $uitpas)
    {
        //
    }
}
