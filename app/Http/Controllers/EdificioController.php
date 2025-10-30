<?php

namespace App\Http\Controllers;

use App\Models\Edificio;
use App\Http\Requests\StoreEdificioRequest;
use App\Http\Requests\UpdateEdificioRequest;
use Illuminate\Http\Request;
use App\Models\Aula;

class EdificioController extends Controller
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
    public function store(StoreEdificioRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Edificio $edificio)
    {
        return view('edificios.edificio-show', compact('edificio'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Edificio $edificio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEdificioRequest $request, Edificio $edificio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Edificio $edificio)
    {
        //
    }

    public function agregarAula(Request $request, Edificio $edificio)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'capacidad' => 'nullable|integer|min:1',
            'codigo' => 'nullable|string|max:50',
        ]);

        if (method_exists($edificio, 'aulas')) {
            $aula = $edificio->aulas()->create($validated);
        } else {
            $validated['edificio_id'] = $edificio->id;
            $aula = Aula::create($validated);
        }

        return redirect()->route('edificios.show', $edificio)
            ->with('success', 'Aula agregada correctamente.');
    }
}
