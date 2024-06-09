<?php

namespace App\Http\Controllers;

use App\Models\Text;
use Illuminate\Http\Request;

class TextController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $text = Text::find(1);
        return view('dashboard')->with('text', $text);
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
        if (Text::find(1))
        {
            $text = Text::find(1);
            $text->update(request()->all());
        }
        else
        Text::create(request()->all());

        return view('dashboard')->with('text', $text);
    }

    /**
     * Display the specified resource.
     */
    public function show(Text $text)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Text $text)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Text $text)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Text $text)
    {
        //
    }
}
