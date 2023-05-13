<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use App\Models\Autor;
use App\Models\Genero;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LibroController extends Controller
{
    
    public function index() {
        $libros = Libro::all();
        return view('adminView.librosIndex', compact('libros'));
    }

   
    public function create() {
        $autores = Autor::all();
        $generos = Genero::all();
        return view('adminView.librosEditCreate', compact('autores','generos'));
    }

  
    public function store(Request $request)  {
        $request->validate([
            'titulo' => 'required|string|max:100',
            'descripcion' => 'required|string|max:10000',
            'cantidadPaginas' => 'required|integer',
            'urlImagen' => 'required|string|max:4096',
            'disponible' => 'required|boolean',
            'precio' => 'required',
        ]);
        $libro = Libro::create($request->all()); 
        $libro->generos()->attach($request->generos);
        $libro->autores()->attach($request->autores);
        return redirect()->route('libros.index')->with('success', 'Libro creado exitosamente');
    }

  
    public function show(Libro $libro) {
        return view('libros.show', compact('libro'));
    }

    
    public function edit(Libro $libro) {
        $autores = Autor::all();
        $generos = Genero::all();
        return view('adminView.librosEditCreate', compact('libro','autores','generos'));
    }
    

    
    public function update(Request $request, Libro $libro){
        $request->validate([
            'titulo' => 'required',
        ]);

       
        $libro->titulo = $request->input('titulo');
        $libro->descripcion = $request->input('descripcion');
        $libro->urlImagen = $request->input('urlImagen');
        $libro->cantidadPaginas = $request->input('cantidadPaginas');
        $libro->precio = $request->input('precio');
        $libro->disponible= $request->input('disponible');
        $libro->generos()->sync($request->generos);
        $libro->autores()->sync($request->autores);
        $libro->save();
        return redirect()->route('libros.index')->with('success', 'Libro actualizado exitosamente');
    }
    

    
    public function destroy(Libro $libro) {
        $libro->delete();
        return redirect()->route('adminView.librosIndex')->with('success', 'Libro eliminado exitosamente'); 
    }
    
}