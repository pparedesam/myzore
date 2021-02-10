<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Tipo;

use App\Models\Linea;

class TipoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipos = Tipo::where('estado', '1')->get();

        return view('admin.tipos.index', ['tipos' => $tipos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lineas = Linea::where('estado', '1')
            ->orderby('nombre')
            ->pluck('nombre', 'id');

        return view('admin.tipos.create', compact('lineas'));
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
            'nombre.required' => 'Ingrese un nombre para la línea.',
        ];

        $request->validate([
            'nombre' => 'required',
        ],$messages);
        
        $tipo = Tipo::create($request->all());
        //$tipo->id=str_pad($tipo->id,2,"0",STR_PAD_LEFT);
                
        return redirect()->route('admin.tipos.index')->with('info', 'Se registró el tipo con éxito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Tipo $tipo)
    {
        $lineas = Linea::where('estado', '1')
            ->orderby('nombre')
            ->pluck('nombre', 'id');

        return view('admin.tipos.edit', compact('tipo','lineas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tipo $tipo)
    {
        $messages = [
            'nombre.required' => 'Ingrese un nombre para el tipo.',
        ];

        $request->validate([
            'nombre' => 'required',
        ],$messages);

        $tipo->update($request->all());
        return redirect()->route('admin.tipos.index')->with('info', 'Se actualizó el tipo con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tipo $tipo)
    {
        $tipo->estado='0';
        $tipo->save();

        Tipo::where('id',$tipo->id)
                        ->update(['estado'=>'0']);

        return redirect()->route('admin.tipos.index')->with('info', 'El tipo '.$tipo->nombre.' se eliminó con éxito');
    }

    public function getLineaTipos($linea_id)
    {
        //$tipos->Tipo::where('linea_id',$linea_id)->get();


        return Tipo::where('estado','1')->get();
    }
}
