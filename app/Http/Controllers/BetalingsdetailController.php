<?php

namespace App\Http\Controllers;

use App\Enums\MethodeEnum;
use App\Models\Activiteit;
use App\Models\Betalingsdetail;
use App\Models\Inschrijvingsdetail;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BetalingsdetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request, $id)
    {
        // valideer form request input
        $validated = $request->validate([
            'methode' => [Rule::enum(MethodeEnum::class)],
            'inschrijvingsdetail_id' => 'required|int|max:250'
        ]);
        // zoek het inschrijvingsdetail waarvoor de betaling erd uitgevoerd
        $i_id = Inschrijvingsdetail::find($validated['inschrijvingsdetail_id']);
        $betaling = ['methode' => $validated['methode'],
            'inschrijvingsdetail_id' => $i_id,
            'datum' => today()];
        $i_id->betalingsdetail()->create($betaling);
        // zoek de bijhorende activiteit zodat we kunnen terugkeren naar de juiste activiteitsindex
        $activiteit = Activiteit::find($id);
        return redirect(route('inschrijvingsdetails.indexActiviteit', $activiteit));

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
