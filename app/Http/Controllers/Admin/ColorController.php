<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Color;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $colors = Color::where('estado', '1')->orderBy( 'nombre' )->get();
        //dd($lineas);
        //dd($colors);
        return view('admin.colors.index',['colors' => $colors]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.colors.create');
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
            'nombre.required' => 'Ingrese un nombre de color.',
        ];

        $request->validate([
            'nombre' => 'required',
        ]);
        $colors = Color::create($request->all());
        return redirect()->route('admin.colors.index')->with('info', 'El color se registró con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Color $color)
    {   
        return view('admin.colors.show', compact('color'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Color $color)
    {
        return view('admin.colors.edit', compact('color'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Color $color)
    {
        $messages = [
            'nombre.required' => 'Ingrese un nombre de color.',
        ];

        $request->validate([
            'nombre' => 'required'
        ],$messages);
        //dd($request->input('nombre'));
        //dd($color);
        //$color->nombre = $request->input('nombre');
        //$color->save();
        $color->update($request->all());
        return redirect()->route('admin.colors.index')->with('info', 'El color se actualizó con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( Color $color)
    {
        $color->estado='0';
        $color->save();

        return redirect()->route('admin.colors.index')->with('info', 'La eliminó el color '.$color->nombre.' con éxito');
    }
}
