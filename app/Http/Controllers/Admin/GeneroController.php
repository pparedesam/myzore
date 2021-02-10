<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Genero;
use App\Models\Linea;
use App\Models\Talla;
use App\Models\SerieTallas;

class GeneroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $generos = Genero::where('estado', '1')->get();
        return view('admin.generos.index',['generos' => $generos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.generos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'nombre.required' => 'Ingrese un nombre de genero.',
        ];

        $request->validate([
            'nombre' => 'required',
        ]);
        $genero = Genero::create($request->all());

        
        
    

        return redirect()->route('admin.generos.index')->with('info', 'El género se registró con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Genero $genero)
    {
        return view('admin.generos.show', compact('genero'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Genero $genero)
    {
        return view('admin.generos.edit', compact('genero'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Genero $genero)
    {
        $messages = [
            'nombre.required' => 'Ingrese un nombre de género.',
        ];

        $request->validate([
            'nombre' => 'required'
        ],$messages);
       
        $genero->update($request->all());
        return redirect()->route('admin.generos.index')->with('info', 'El género se actualizó con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Genero $genero)
    {
        $genero->estado='0';
        $genero->save();

        return redirect()->route('admin.generos.index')->with('info', 'La eliminó el género '.$genero->nombre.' con éxito');
    }
}
