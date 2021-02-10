<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Distrito;
use App\Models\Producto;
use App\Models\Provincia;
use App\Models\Region;
use App\Models\User;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $warehouses = Warehouse::where('estado', '1')
                ->with('user.persona.personajuridica')
                ->orderBy('nombre')->get();

               

        return view('admin.warehouses.index', ['warehouses' => $warehouses]);
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

        $users = User::join('personas', 'users.persona_id', '=', 'personas.id')
            ->join('personasjuridicas', 'personas.id', '=', 'personasjuridicas.persona_id')
            ->where('users.estado', '1')
            ->select('users.id','personasjuridicas.razonSocial as nombre')
            ->pluck('nombre','id');

 

        //return view('admin.stores.create', compact('region', 'provincia', 'distrito'));
        return view('admin.warehouses.create', ['regiones' => $regiones, 'provincias' => $provincias, 'distritos' => $distritos,'users' =>$users]);
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
            'nombre.required' => 'Ingrese un nombre para el proveedor.',
            
        ];

        $request->validate([
            'nombre' => 'required',
        ], $messages);

        $warehouse = Warehouse::create($request->all());

        return redirect()->route('admin.warehouses.index')->with('info', 'Se registró el almacen con éxito.');
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
    public function edit(Warehouse $warehouse)
    {
        $regiones = Region::orderby('nombre')
            ->pluck('nombre', 'id');

        $provincias = Provincia::where('region_id', $warehouse->region->id)
            ->pluck('nombre', 'id');

        $distritos = Distrito::where('provincia_id', $warehouse->provincia->id)
            ->pluck('nombre', 'id');

        $users = User::join('personas', 'users.persona_id', '=', 'personas.id')
            ->join('personasjuridicas', 'personas.id', '=', 'personasjuridicas.persona_id')
            ->where('users.estado', '1')
            ->select('users.id','personasjuridicas.razonSocial as nombre')
            ->pluck('nombre','id');

        return view('admin.warehouses.edit', compact('warehouse', 'regiones', 'provincias', 'distritos','users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Warehouse $warehouses)
    {
        $messages = [
            'nombre.required' => 'Ingrese un nombre para el proveedor.',
            
        ];

        $request->validate([
            'nombre' => 'required',
            
        ], $messages);

        $warehouses->update($request->all());
        return redirect()->route('admin.warehouses.index')->with('info', 'El almacen se actualizó con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Warehouse $warehouses)
    {
        $warehouses->estado='0';
        $warehouses->save();

        
        return redirect()->route('admin.warehouses.index')->with('info', 'El almacen '.$warehouses->nombre.', se eliminó con éxito');
    }
}
