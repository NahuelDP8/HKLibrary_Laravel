<?php

namespace App\Http\Controllers;

use App\Models\Genero;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GeneroController extends Controller
{
    public function index(){
        $generos = Genero::all();
        return view('adminView.generosIndex', compact('generos'));
    }

    public function create() {
        return view('adminView.generosEditCreate');
    }

    public function store(Request $request) {
        $request->validate([
            'nombre_genero' => 'required|unique:genero,nombreGenero|string',
        ]);

        $genero = new Genero();
        $genero->nombreGenero = $request->input('nombre_genero');
        $genero->save();

        return redirect(route('generos.index'));

    }

    public function show(Genero $genero) {
        return redirect()->route('generos.edit', $genero);
    }

    public function edit(Genero $genero)
    {
        return view('adminView.generosEditCreate',compact('genero'));
    }

    public function update(Request $request, Genero $genero)
    {
        $request->validate([
            'nombre_genero' => 'required|unique:genero,nombreGenero|string'
        ]);

        $genero->nombreGenero = $request->input('nombre_genero');
        $genero->save();
        return redirect()->route('generos.index')->with('success', 'Genero actualizado exitosamente');
    }

}
