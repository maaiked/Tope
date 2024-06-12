<?php

namespace App\Http\Controllers;

use App\Enums\LeerjaarEnum;
use App\Models\Kind;
use App\Models\Profiel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use function PHPUnit\Framework\isNull;

class ProfielController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users['users'] = User::where('isAdmin', false)->where('isAnimator', false)->get();
        return view ('profiel.indexAdmin')->with($users);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $userprofiel = Profiel::where('user_id', auth()->id())->first();
        if($userprofiel === null) {
            return view('profiel.nieuw');
        }
        else {
            return redirect(route('profiel.edit'));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'voornaam'=> 'required|string|max:255',
            'familienaam'=> 'required|string|max:255',
            'straat'=> 'required|string|max:255',
            'huisnummer'=> 'required|string|max:255',
            'bus'=> 'nullable|string|max:30',
            'postcode'=> 'required|string|max:255',
            'gemeente'=> 'required|string|max:255',
            'telefoonnummer'=> 'required|string|max:255',
            'rijksregisternummer'=> 'required|string|max:255',
        ]);

        $request->user()->profiel()->create($validated);
        return redirect(route('profiel.edit'))->with('success', 'Profiel werd geupdate.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Profiel $profiel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $userprofiel= $request->user()->profiel()->first();
        return view('profiel.edit', compact('userprofiel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Profiel $profiel)
    {
        $validated = $request->validate([
            'voornaam'=> 'required|string|max:255',
            'familienaam'=> 'required|string|max:255',
            'straat'=> 'required|string|max:255',
            'huisnummer'=> 'required|string|max:255',
            'bus'=> 'nullable|string|max:30',
            'postcode'=> 'required|string|max:255',
            'gemeente'=> 'required|string|max:255',
            'telefoonnummer'=> 'required|string|max:255',
            'rijksregisternummer'=> 'required|string|max:255',
        ]);

        $request->user()->profiel()->update($validated);
        return redirect(route('profiel.edit'))->with('success', 'Profiel werd geupdate');
    }

    public function editAddKind(Request $request)
    {
        $user= $request->user()->first();
        return view('profiel.addKind', compact('user'));
    }

    public function updateAddKind(Request $request, $id)
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

        $user= $request->user()->first();
        $kind = $user->kinds()->create($validated);
        (new KindController)->uitpasInfo($kind->id);

        return redirect(route('kinderen.indexAdminOuder', $user->id));
    }

    public function editById(Request $request, int $id)
    {
        $userprofiel = Profiel::where('user_id', $id)->first();
        return view('profiel.edit', compact('userprofiel', 'id'));
    }

    public function updateById(Request $request, Profiel $profiel, int $id)
    {
        $validated = $request->validate([
            'voornaam'=> 'required|string|max:255',
            'familienaam'=> 'required|string|max:255',
            'straat'=> 'required|string|max:255',
            'huisnummer'=> 'required|string|max:255',
            'bus'=> 'nullable|string|max:30',
            'postcode'=> 'required|string|max:255',
            'gemeente'=> 'required|string|max:255',
            'telefoonnummer'=> 'required|string|max:255',
            'rijksregisternummer'=> 'required|string|max:255',
        ]);

        $user = User::findOrFail($id);
        $user->profiel()->update($validated);

        return redirect(route('profiel.editById', $id))->with('success', 'Profiel werd geupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profiel $profiel)
    {
        //
    }

}
