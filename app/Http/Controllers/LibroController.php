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
        return view('adminView.librosEditCreate');
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
        return view('adminView.librosEditCreate', compact('libro'));
    }
    

    
    public function update(Request $request, Libro $libro){
        $request->validate([
            'title' => 'required',
        ]);

        
        $libro->titulo = $request->input('title');
        $libro->descripcion = $request->input('description');
        $libro->cantidadPaginas = $request->input('cantPag');
        $libro->precio = $request->input('price');
        $libro->urlImagen = $request->input('urlImg');
    
        $libro->save();
    
        return redirect()->route('adminView.librosIndex')->with('success', 'Libro actualizado exitosamente');
    }
    

    
    public function destroy(Libro $libro) {
        $libro->delete();
        return redirect()->route('adminView.librosIndex')->with('success', 'Libro eliminado exitosamente'); 
    }
    
}