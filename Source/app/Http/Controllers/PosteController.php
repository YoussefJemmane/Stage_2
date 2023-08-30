<?php

namespace App\Http\Controllers;

use App\Models\Poste;
use App\Http\Requests\StorePosteRequest;
use App\Http\Requests\UpdatePosteRequest;

class PosteController extends Controller
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
        return view('postes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePosteRequest $request)
    {
        $validatedData = $request->validated();

        Poste::create($validatedData);

        return redirect()->route('employees.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(Poste $poste)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Poste $poste)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePosteRequest $request, Poste $poste)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Poste $poste)
    {
        //
    }
}
