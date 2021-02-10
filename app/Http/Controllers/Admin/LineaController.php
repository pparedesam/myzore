<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Catalog;
use Illuminate\Http\Request;

use App\Models\Linea;

use App\Models\Genero;
use App\Models\Material;
use App\Models\Talla;
use App\Models\SerieTallas;
use App\Models\Tipo;

class LineaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lineas = Linea::where('estado', '1')->orderBy('nombre')->get();
        //dd($lineas);
        return view('admin.lineas.index',['lineas' => $lineas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.lineas.create');
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
            'slug.required' => 'Ingrese un slug para la línea.',
        ];

        $request->validate([
            'nombre' => 'required',
            'slug' => 'required|unique:lineas'
        ],$messages);
        
        $linea = Linea::create($request->all());
        
        //Registrar la nueva linea en serieTallas

        $generos = Genero::all();
        $tallas = Talla::where('estado','1')->get();

       


        return redirect()->route('admin.lineas.index')->with('info', 'La línea se registró con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Linea $linea)
    {
        return view('admin.lineas.show', compact('linea'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Linea $linea)
    {
        return view('admin.lineas.edit', compact('linea'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Linea $linea)
    {
        $messages = [
            'nombre.required' => 'Ingrese un nombre para la línea.',
            'slug.required' => 'Ingrese un slug para la línea.',
            'slug.unique' => 'El slug ya existe en la base de datos.',
        ];

        $request->validate([
            'nombre' => 'required',
            'slug' => "required|unique:lineas,slug,[$linea->id,$linea->estado]"
        ],$messages);

        $linea->update($request->all());
        return redirect()->route('admin.lineas.index')->with('info', 'La línea se actualizó con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Linea $linea)
    {
        $linea->estado='0';
        $linea->save();

        

        return redirect()->route('admin.lineas.index')->with('info', 'La línea '.$linea->nombre.' se eliminó con éxito');
    }

    public function getTipos($linea_id)
    {
        $tipos=Tipo::where('estado','1')->where('linea_id',$linea_id)->get();
        $materiales=Material::where('estado','1')->where('linea_id',$linea_id)->get();

        return compact('tipos','materiales');
    }

}
