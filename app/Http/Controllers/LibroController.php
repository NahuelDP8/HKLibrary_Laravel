<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use App\Models\Autor;
use App\Models\Genero;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Cloudinary\Api\Exception\ApiError;
use Cloudinary\Api\Upload\UploadApi;

class LibroController extends Controller
{
    
    public function index() {
        $libros = Libro::with('autores','generos')->get();
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
            'urlImagen' => 'required|image',
            'disponible' => 'required|boolean',
            'precio' => 'required',
            'autores' => 'required|array',
            'generos' => 'required|array',
        ]);
        $libro = new Libro();
        $libro->generos()->attach($request->generos);
        $libro->autores()->attach($request->autores);
        $uploadedFile = Cloudinary::upload($request->file('urlImagen')->getRealPath(), [
            'folder' => 'Books' 
        ]);
        
        $libro->titulo = $request->input('titulo');
        $libro->descripcion = $request->input('descripcion');
        $libro->cantidadPaginas = $request->input('cantidadPaginas');
        $libro->precio = $request->input('precio');
        $libro->disponible= $request->input('disponible');
        $libro->urlImagen = $uploadedFile->getSecurePath();
        $libro->save();
        return redirect()->route('libros.index')->with('success', 'Libro creado exitosamente');
    }

  
    public function show(Libro $libro) {
        return redirect()->route('libros.edit', $libro);
    }

    
    public function edit(Libro $libro) {
        $autores = Autor::all();
        $generos = Genero::all();
        return view('adminView.librosEditCreate', compact('libro','autores','generos'));
    }
    

    
    public function update(Request $request, Libro $libro){
        $request->validate([
            'titulo' => 'required|string|max:100',
            'descripcion' => 'required|string|max:10000',
            'cantidadPaginas' => 'required|integer',
            'urlImagen' => 'required|image',
            'disponible' => 'required|boolean',
            'precio' => 'required',
            'autores' => 'required|array',
            'generos' => 'required|array',
        ]);

        $imagenAnterior = $libro->urlImagen;
        if (!empty($imagenAnterior)) {
            $token = explode('/', $imagenAnterior);
            $token2 = explode('.', $token[sizeof($token)-1]);
            Cloudinary::destroy ('Books/'.$token2[0]);
        }
        $libro->titulo = $request->input('titulo');
        $libro->descripcion = $request->input('descripcion');
        $libro->urlImagen = $request->input('urlImagen');
        $libro->cantidadPaginas = $request->input('cantidadPaginas');
        $libro->precio = $request->input('precio');
        $libro->disponible= $request->input('disponible');
        $image = $request->file('urlImagen');
        $uploadedFile = $image->storeOnCloudinary('Books');
        $libro->urlImagen = $uploadedFile->getSecurePath();
        $libro->generos()->sync($request->generos);
        $libro->autores()->sync($request->autores);
        $libro->save();
        return redirect()->route('libros.index')->with('success', 'Libro actualizado exitosamente');
    }
    

    
 
}