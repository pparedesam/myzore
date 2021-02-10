<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Distrito;
use App\Models\Documento;
use App\Models\ProviderNivel;
use App\Models\Provincia;
use App\Models\Region;
use App\Models\Socio;
use Illuminate\Http\Request;

class SocioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $socios = Socio::where('estado', '1')->with('personaNatural', 'personaNatural.persona')->get();

        return view('admin.socios.index', ['socios' => $socios]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $regiones = Region::orderby('nombre')
            ->pluck('nombre', 'id');

        $provincias = Provincia::where('region_id', '01')
            ->pluck('nombre', 'id');

        $distritos = Distrito::where('provincia_id', '0101')
            ->pluck('nombre', 'id');

        $documentos = Documento::where('nombre', 'ruc')->orderby('nombre')
            ->pluck('nombre', 'id');

        return view('admin.socios.create', compact('regiones', 'provincias', 'distritos', 'niveles', 'documentos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
