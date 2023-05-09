<?php

namespace App\Http\Controllers;

use App\Models\Genero;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GeneroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $generos = Genero::all();
        return view('adminView.generosIndex', compact('generos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('adminView.generosEditCreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre_genero' => 'required|string',
        ]);

        $genero = new Genero();
        $genero->nombreGenero = $request->input('nombre_genero');
        $genero->save();

        return redirect(route('generos.index'));

    }

    /**
     * Display the specified resource.
     */
    public function show(Genero $genero)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Genero $genero)
    {
        return view('adminView.generosEditCreate',compact('genero'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Genero $genero)
    {
        $request->validate([
            'nombre_genero' => 'required|string'
        ]);

        $genero->nombreGenero = $request->input('nombre_genero');
        $genero->save();
        return redirect()->route('generos.index')->with('success', 'Genero actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Genero $genero)
    {
        //
    }
}
