<?php

namespace App\Http\Controllers;

use App\Models\Activiteit;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ActiviteitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view ('activiteiten.index', ['activiteiten'=> Activiteit::paginate(5)]);
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
        $request->validate([
            'message'=> 'required|string|max:255'
        ]);
        Activiteit::create([
            'message'=>$request->message,
        ]);
        return redirect(route('activiteiten.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Activiteit $activiteit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Activiteit $activiteit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Activiteit $activiteit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Activiteit $activiteit)
    {
        //
    }
}
