<?php

namespace App\Http\Controllers;

use App\Models\Inschrijvingsdetail;
use App\Models\Kind;
use App\Models\User;
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
    public function store(Request $request)
    {
        //
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
