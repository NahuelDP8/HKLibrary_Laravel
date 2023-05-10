<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AutorController extends Controller
{
    public function index(){
        $autores = Autor::paginate(15); 
        return view('adminView.autoresIndex', compact('autores'));
    }

    public function create(){
        return view('adminView.autoresEditCreate');
    }

    public function store(Request $request){
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255'
        ]);
        Autor::create($request->all());
        return redirect()->route('autores.index')->with('success', 'Autor creado exitosamente');
    }

    public function show(Autor $autor)
    {
        //
    }

    public function edit(Autor $autor){
        return view('adminView.autoresEditCreate',compact('autor'));
    }
    

    public function update(Request $request, Autor $autor){
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255'
            ]);
        $autor->nombre = $request->input('nombre');
        $autor->apellido = $request->input('apellido');
        $autor->save();
        return redirect()->route('autores.index')->with('success', 'Autor actualizado exitosamente');
    }

    public function destroy(Autor $autor)
    {
        //
    }
}
