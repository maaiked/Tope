<?php

namespace App\Http\Controllers;

use App\Models\Activiteit;
use App\Models\Kind;
use App\Models\Uitpas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class UitpasController extends Controller
{
    //todo:: catch 400 & 404 responses


    /*  Token logica     */

    /**
     * Show the form for creating a new resource.
     */
    public
    function create()
    {
        //todo:: add security to stop loop indien 401 door ander probleem komt.
        // check expires_in > today()+1day ?? -> laravel http retry ! https://laravel.com/docs/10.x/http-client#retries

        // vraag inloggegevens op in db
        $client = Uitpas::find(1);
        // maak verbinding met uitpas om de access token aan te vragen
        $response = Http::post($client->account_url . '/oauth/token', [
            'client_id' => $client->clientId,
            'client_secret' => $client->clientSecret,
            'audience' => 'https://api.publiq.be',
            'grant_type' => 'client_credentials'
        ]);
        // sla token op in cache
        $access = $response->json('access_token');
        $expire = $response->json('expires_in');
        $expiredatetime = now()->addSeconds($expire);
        Cache::put('uitpastoken', Crypt::encryptString($access));
        Cache::put('expires_in', $expiredatetime);
    }

    /**
     * Store a newly created resource in storage.
     */
    public
    function store(Request $request)
    {
        $validated = $request->validate([
            'clientId' => 'required|string|max:255',
            'clientSecret' => 'required|string|max:255',
            'api_url' => 'required|string|max:255',
            'io_url' => 'required|string|max:255',
            'account_url' => 'required|string|max:255',
            'organizerId' => 'required|string|max:255',
            'locationId' => 'required|string|max:255',
        ]);

        Uitpas::create($validated);
        return redirect(route('uitpas.index'));
    }

    /**
     * Display the specified resource.
     */
    public
    function index()
    {
        // zoek record of ga naar form als record nog niet bestaat
        $uitpasdb = Uitpas::find(1);
        if ($uitpasdb === null) {
            return view('uitpas.set');
        } else {
            // als record bestaat met gegevens, geef die weer

            //   als uitpastoken nog niet werd aangemaakt, vraag nieuwe aan
            if (Cache::get('uitpastoken', 'default') === 'default') {
                $this->create();
            }

            $uitpas = [
                'expires_in' => Cache::get('expires_in'),
                'clientId' => $uitpasdb->clientId,
                'organizerId' => $uitpasdb->organizerId,
                'locationId' => $uitpasdb->locationId,
                'api_url' => $uitpasdb->api_url,
                'io_url' => $uitpasdb->io_url,
                'account_url' => $uitpasdb->account_url
            ];
            return view('uitpas.index', compact('uitpas'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public
    function edit()
    {
        $uitpas = Uitpas::find(1);
        return view('uitpas.edit', compact('uitpas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public
    function update(Request $request)
    {
        $validated = $request->validate([
            'clientId' => 'required|string|max:255',
            'clientSecret' => 'required|string|max:255',
            'api_url' => 'required|string|max:255',
            'io_url' => 'required|string|max:255',
            'account_url' => 'required|string|max:255',
            'organizerId' => 'required|string|max:255',
            'locationId' => 'required|string|max:255',
        ]);

        $uitpas = Uitpas::find(1);
        $uitpas->update($validated);

        return redirect(route('uitpas.index'));
    }


    /**
     * route for create button on uitpasindex
     */
    public
    function buttonCreate()
    {
        $this->create();
        return redirect(route('uitpas.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public
    function destroy(Uitpas $uitpas)
    {
        //
    }



    /*  uitpasnummer kind logica     */


    /**
     * Get the uitpasstatus of a child
     */
    // Haal uitpasgegevens van kind op aan de hand van zijn rijksregisternummer
    public function uitpasKind($insNumber)
    {
        $inszNumber = str_replace(['.', '-'], '', $insNumber);
        $uitpasdb = Uitpas::find(1);

        //Haal de uitpasgegevens van het kind op.
        $url = $uitpasdb->api_url . '/insz-numbers/' . $inszNumber;
        $token = Cache::get('uitpastoken');
        $uitpasKind = Http::withToken(Crypt::decryptString($token))->get($url);

        // als respons = 401 of 403 - don't ask me why hij 403 teruggeeft??, vraag nieuwe access token op en retry
        if ($uitpasKind->status() === 401 || $uitpasKind->status() === 403) {
            $this->create();
            return $this->uitpasKind($insNumber);
        } else return ($uitpasKind->body());
    }


    /*  Activiteit logica     */

    /**
     * Register new activity in uitpasdatabank
     */
    // Registreer een nieuwe activiteit in de uitpasdatabank
    public function uitpasNieuweActiviteit($activiteit)
    {
        $uitpasdb = Uitpas::find(1);

        //Geef het nieuwe event door naar uitpas
        $url = $uitpasdb->io_url . '/events';
        $token = Cache::get('uitpastoken');
        $uitpasevent = Http::withToken(Crypt::decryptString($token))->post($url,
            $data = [
                'workflowStatus' => 'READY_FOR_VALIDATION',
                'mainLanguage' => 'nl',
                'name' => [
                    'nl' => $activiteit->naam
                ],
                'organizer' => [
                    '@id' => $uitpasdb->io_url . '/organizers/' . $uitpasdb->organizerId
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
                'location' => [
                    '@id' => $uitpasdb->io_url . '/place/' . $uitpasdb->locationId
                ],
                'terms' => [
                    [
                        'id' => '0.57.0.0.0'
                        //kamp of vakantie
                    ]
                ]
            ]);


        // als respons = 401 of 403 - don't ask me why hij 403 teruggeeft??, vraag nieuwe access token op en retry
        if ($uitpasevent->status() === 401 || $uitpasevent->status() === 403) {
            $this->create();
            return $this->uitpasNieuweActiviteit($activiteit);
        }
        else return ($uitpasevent->body());
    }


    /**
     * Update activity in uitpasdatabank
     */
    // Update activiteit in de uitpasdatabank
    public function uitpasUpdateActiviteit($activiteit)
    {
        // haal activiteit info op in uitpas
        $uitpasdb = Uitpas::find(1);
        $url = $uitpasdb->io_url . '/events/' . $activiteit->uitdatabank_id;
        $token = Cache::get('uitpastoken');
        $uitpasevent = Http::withToken(Crypt::decryptString($token))->get($url);

        // als respons = 401 of 403 - don't ask me why hij 403 teruggeeft??, vraag nieuwe access token op en retry
        if ($uitpasevent->status() === 401 || $uitpasevent->status() === 403) {
            $this->create();
            return $this->uitpasUpdateActiviteit($activiteit);

            //pas activiteit gegevens aan
        } else
            $event = json_decode($uitpasevent->body());
        $event->name->nl = $activiteit->naam;
        $event->startDate = Carbon::parse($activiteit->starttijd)->toIso8601String();
        $event->endDate = Carbon::parse($activiteit->eindtijd)->toIso8601String();
        $event->priceInfo[0]->price = (int)$activiteit->prijs;
        $event->subEvent[0]->startDate = Carbon::parse($activiteit->starttijd)->toIso8601String();
        $event->subEvent[0]->endDate = Carbon::parse($activiteit->eindtijd)->toIso8601String();
        $updatedevent = Http::withToken(Crypt::decryptString($token))->put($url, $event);

        return $updatedevent;

    }


    /**
     * Get the uitpasprijs of an activity
     */
    public function uitpasPrijs($activiteit)
    {
        $uitpasdb = Uitpas::find(1);
        $url = $uitpasdb->io_url . '/event/' . $activiteit->uitdatabank_id . "?embedUitpasPrices=true";
        $uitpasPrijs = Http::get($url)->body();
        $prijsResult = json_decode($uitpasPrijs);
        //todo:: in production if organizer has only 1 organisation, change to princeInfo[1]!!
        if (isset($prijsResult->priceInfo[2]->price)) {
            $prijs = $prijsResult->priceInfo[2]->price;
            return ($prijs);
        } else {
            return $this->uitpasPrijs($activiteit);
        }
    }


    /*    Ticket logica     */

    public function uitpasTicket(Activiteit $activiteit, Kind $kind)
    {
        $uitpasdb = Uitpas::find(1);

        //Registreer het ticket in uitpasdatabase
        $url = $uitpasdb->api_url . '/ticket-sales';
        $token = Cache::get('uitpastoken');
        $ticket = Http::withToken(Crypt::decryptString($token))->post($url,
            [
                [
                    'tariff' => [
                        'id' => 'SOCIALTARIFF'
                    ],
                    'uitpasNumber' => $kind->uitpasnummer,
                    'eventId' => $activiteit->uitdatabank_id,
                    'regularPrice' => (int)$activiteit->prijs,
                ]
            ]);

        // als respons = 400 > maximum aantal tickets bereikt. "Je kan dit ticket niet meer aankopen aan kansentarief omdat je het al eerder hebt gekocht. Je kan maximaal 1 ticket(s) kopen aan kansentarief voor deze activiteit."

        // als respons = 401 of 403 - don't ask me why hij 403 teruggeeft??, vraag nieuwe access token op en retry
        if ($ticket->status() === 401 || $ticket->status() === 403) {
            $this->create();
            return $this->uitpasTicket($activiteit, $kind);
        } else return ($ticket);
    }


    /**
     * Cancel a ticket sale registration.
     */
    public function uitpasDeleteTicket($uitpasid)
    {
        $uitpasdb = Uitpas::find(1);

        //Verwijder het ticket in uitpasdatabase
        $url = $uitpasdb->api_url . '/ticket-sales/' . $uitpasid;
        $token = Cache::get('uitpastoken');
        $ticket = Http::withToken(Crypt::decryptString($token))->delete($url);

        // als respons = 401 of 403 - don't ask me why hij 403 teruggeeft??, vraag nieuwe access token op en retry
        if ($ticket->status() === 401 || $ticket->status() === 403) {
            $this->create();
            $this->uitpasDeleteTicket($uitpasid);
        }
    }
}
