<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Material;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $materials = Material::where('estado', '1')->orderBy('nombre')->get();

        return view('admin.materials.index',['materials' => $materials]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.materials.create');
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
        
        $material = Material::create($request->all());
        
        return redirect()->route('admin.materials.index')->with('info', 'El material se registró con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Material $material)
    {
        return view('admin.materials.show', compact('material'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Material $material)
    {
        return view('admin.materials.edit', compact('material'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Material $material)
    {
       
        $messages = [
            'nombre.required' => 'Ingrese un nombre para el material.',
        ];

        $request->validate([
            'nombre' => 'required',
        ],$messages);

        $material->update($request->all());
        return redirect()->route('admin.materials.index')->with('info', 'El material se actualizó con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Material $material)
    {
        $material->estado='0';
        $material->save();

        return redirect()->route('admin.materials.index')->with('info', 'El material '.$material->nombre.' se eliminó con éxito');
    }

}
