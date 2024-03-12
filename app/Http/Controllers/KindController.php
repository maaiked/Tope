<?php

namespace App\Http\Controllers;

use App\Models\Kind;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use App\Models\User;

class KindController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->isAdmin){
            $kinderen['kinderen'] = Kind::paginate(10);
        }
        else {
            $kinderen['kinderen'] = Kind::where('user_id', auth()->id())->get();
        }
    
        return view ('kinderen.index')->with($kinderen);
   
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
        $validated = $request->validate([
            'name'=> 'required|string|max:255'
        ]);
        
        $request->user()->kinderen()->create($validated);
        return redirect(route('kinderen.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Kind $kind)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kind $kind)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kind $kind)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kind $kind)
    {
        //
    }
}
