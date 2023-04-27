<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LibroController extends Controller
{
    
    public function index() {
        $libros = Libro::all();
        return view('adminView.librosIndex', compact('libros'));
    }

   
    public function create() {
        return view('adminView.libros.create');
    }

  
    public function store(Request $request)  {
        $request->validate([
            'titulo' => 'required',
            'autor' => 'required',
            
        ]);

        Libro::create($request->all()); 
        return redirect()->route('adminView.libros.index')->with('success', 'Libro creado exitosamente');
    }

  
    public function show(Libro $libro) {
        return view('libros.show', compact('libro'));
    }

    
    public function edit(Libro $libro) {
        return view('libros.edit', compact('libro'));
    }

    
    public function update(Request $request, Libro $libro) {
        $request->validate([
            'titulo' => 'required',
            'autor' => 'required',
           
        ]);

        $libro->update($request->all()); 
        return redirect()->route('adminView.libros.index')->with('success', 'Libro actualizado exitosamente'); 
    }

    
    public function destroy(Libro $libro) {
        $libro->delete();
        return redirect()->route('adminView.libros.index')->with('success', 'Libro eliminado exitosamente'); 
    }
    
}