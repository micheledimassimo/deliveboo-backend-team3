<?php

namespace App\Http\Controllers\Admin;

use App\Models\Typology;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class TypologyController extends Controller
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
    public function store(Request $request)
    {
        $request->validate([
            'typologies' => 'required|array|min:1|max:4', 
            'typologies.*' => 'integer|exists:typologies,id', 
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Typology $typology)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Typology $typology)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Typology $typology)
    {
        $request->validate([
            'typologies' => 'required|array|min:1|max:4', // Deve essere un array con almeno un elemento
            'typologies.*' => 'integer|exists:typologies,id', // Ogni elemento deve esistere nella tabella 'typologies'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Typology $typology)
    {
        //
    }
}
