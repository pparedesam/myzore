<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Talla;
use App\Models\Genero;
use App\Models\Linea;
use App\Models\SerieTallas;

class TallasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tallas = Talla::where('estado', '1')->orderBy('nombre')->get();

        return view('admin.tallas.index',['tallas' => $tallas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tallas.create');
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
            'nombre.required' => 'Ingrese un nombre para el material.',
        ];

        $request->validate([
            'nombre' => 'required',
        ],$messages);
        
        $talla = Talla::create($request->all());

    
        
        return redirect()->route('admin.tallas.index')->with('info', 'La talla se registró con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Talla $talla)
    {
        return view('admin.talla.show', compact('talla'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Talla $talla)
    {
        return view('admin.tallas.edit', compact('talla'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Talla $talla)
    {
        $messages = [
            'nombre.required' => 'Ingrese un nombre para el material.',
        ];

        $request->validate([
            'nombre' => 'required',
        ],$messages);

        $talla->update($request->all());
        return redirect()->route('admin.tallas.index')->with('info', 'La talla se actualizó con éxito');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Talla $talla)
    {
        $talla->estado='0';
        $talla->save();

        return redirect()->route('admin.tallas.index')->with('info', 'La talla'.$talla->nombre.' se eliminó con éxito');
    
    }
}
