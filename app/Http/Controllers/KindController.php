<?php

namespace App\Http\Controllers;

use App\Enums\LeerjaarEnum;
use App\Models\Activiteit;
use App\Models\Kind;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class KindController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // als user = admin -> geef alle kinderen weer
        if (auth()->user()->isAdmin) {
            $kinderen['kinderen'] = Kind::all();
            return view('kinderen.indexAdmin')->with($kinderen);
        }

        // als user = geen admin -> geef enkel eigen kinderen weer
        else {
            $kinderen['kinderen'] = Kind::where('user_id', auth()->id())->get();
            foreach ($kinderen as $kind) {
                foreach ($kind as $k) {
                    if ($k->uitpasDatumCheck < today()) {
                        $this->uitpasInfo($k->id);
                    }
                }
            }
            return view('kinderen.indexOuder')->with($kinderen);
        }
    }

    public function indexAdminOuder($id)
    {
        $kinderen = Kind::where('user_id', $id)->get();
        $ouder = User::where('id', $id)->first();
        return view('kinderen.indexAdminOuder', ['kinderen' => $kinderen, 'ouder' => $ouder]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kinderen.nieuw');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'voornaam' => 'required|string|max:255',
            'familienaam' => 'required|string|max:255',
            'rijksregisternummer' => 'required|string|max:40|regex:/^[0-9]{2}[.][0-9]{2}[.][0-9]{2}[-][0-9]{3}[.][0-9]{2}$/',
            'contactpersoon' => 'required|string|max:255',
            'beperking' => 'nullable|string|max:255',
            'allergie' => 'nullable|string|max:255',
            'medicatie' => 'nullable|string|max:255',
            'afhalenKind' => 'nullable|string|max:255',
            'infoAdmin' => 'string|max:510',
            'infoAdminAnimator' => 'string|max:510',
            'alleenNaarHuis' => 'boolean',
            'fotoToestemming' => 'boolean',
            'leerjaar' => [Rule::enum(LeerjaarEnum::class)],
        ]);

        $kind = $request->user()->kinds()->create($validated);
        $this->uitpasInfo($kind->id);

        return redirect(route('kinderen.index'))->with('success', 'Kind '.$kind->voornaam.' '.$kind->familienaam.' aangemaakt.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kind $kind)
    {
        //
    }

    /**
     * Display the specified resources.
     */
    public function showAll(Kind $kind)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // als kindid behoort tot ingelogde user, geef form weer
        $kind = Kind::find($id);
        if (auth()->id() == $kind->user->id || auth()->user()->isAdmin) {
            return view('kinderen.edit', compact('kind'));
        } //als kindid niet behoort tot de ingelogde user, keer terug naar index
        else {
            return redirect(route('kinderen.index'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $kind = Kind::find($id);
        $validated = $request->validate([
            'voornaam' => 'required|string|max:255',
            'familienaam' => 'required|string|max:255',
            'rijksregisternummer' => 'required|string|max:40|regex:/^[0-9]{2}[.][0-9]{2}[.][0-9]{2}[-][0-9]{3}[.][0-9]{2}$/',
            'contactpersoon' => 'required|string|max:255',
            'beperking' => 'nullable|string|max:255',
            'allergie' => 'nullable|string|max:255',
            'medicatie' => 'nullable|string|max:255',
            'afhalenKind' => 'nullable|string|max:255',
            'infoAdmin' => 'nullable|string|max:510',
            'infoAdminAnimator' => 'nullable|string|max:510',
            'alleenNaarHuis' => 'boolean',
            'fotoToestemming' => 'boolean',
            'leerjaar' => [Rule::enum(LeerjaarEnum::class)],
        ]);
        $oldrijksregisternummer = $kind->rijksregisternummer;
        $kind->update($validated);

        // als rijksregisternummer wordt aangepast, update uitpas kolommen.
        if (strcmp($oldrijksregisternummer, $kind->rijksregisternummer) !== 0) {
            $this->uitpasInfo($kind->id);
        }

        return redirect(route('kinderen.index'))->with('success', $kind->voornaam.' '.$kind->familienaam.' werd succusvol gewijzigd.');
    }

    public function uitpasInfo($kindid)
    {
        $kind = Kind::find($kindid);

        $uitpas = (new UitpasController)->uitpasKind($kind->rijksregisternummer);
        $result = json_decode($uitpas, true);

        // als uitpas bestaat, vul kolommen aan
        if (array_key_exists('uitpasNumber', $result)) {
            $kind->update([
                'uitpasKansentarief' => $result['socialTariff']['status'],
                'uitpasDatumCheck' => today(),
                'uitpasnummer' => $result['uitpasNumber']
            ]);
            if (array_key_exists('messages', $result)) {
                $kind->update(['uitpasTekst' => $result['messages'][0]['text'],]);
            } else {
                $kind->update(['uitpasTekst' => '']);
            }
        } // als uitpas niet bestaat, wis kolommen
        else {
            $kind->update([
                'uitpasnummer' => '',
                'uitpasKansentarief' => '',
                'uitpasTekst' => '',
                'uitpasDatumCheck' => today()
            ]);
        }

    }

    public function editAdminAnimatorInfo(Request $request, $id)
    {
        $validated = $request->validate([
            'infoAdminAnimator' => 'nullable|string|max:510',
            'kind' => 'string|max:20'
        ]);
        $kind = Kind::find($validated['kind']);
        $activiteit = Activiteit::find($id);
        $kind->update(['infoAdminAnimator' => $validated['infoAdminAnimator']]);
        return redirect(route('inschrijvingsdetails.indexActiviteit', $activiteit));
    }

    public function editAdminInfo(Request $request, $id)
    {
        $validated = $request->validate([
            'infoAdmin' => 'nullable|string|max:510',
            'kind' => 'string|max:20'
        ]);
        $kind = Kind::find($validated['kind']);
        $activiteit = Activiteit::find($id);
        $kind->update(['infoAdmin' => $validated['infoAdmin']]);
        return redirect(route('inschrijvingsdetails.indexActiviteit', $activiteit));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kind $kind)
    {
        //
    }
}
