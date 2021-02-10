<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Models\Kardex;
use App\Models\KardexDetalle;
use App\Models\KardexTipoDetalle;
use App\Models\Producto;
use App\Models\Store;
use App\Models\Talla;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KardexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $warehouse = Warehouse::where('user_id', auth()->user()->id)->pluck('nombre', 'id');

        $kardexColors = Kardex::with('producto', 'producto.tipo', 'producto.material', 'producto.genero', 'producto.linea', 'color')
            ->select('warehouse_id', 'producto_id', 'color_id')
            ->groupby('warehouse_id', 'producto_id', 'color_id')
            ->get();

        $kardexColorTalla = Kardex::with('producto', 'producto.tipo', 'producto.material', 'producto.genero', 'producto.linea', 'color', 'talla')
            ->get();

        return view('admin.kardexes.index', ['warehouse' => $warehouse, 'kardexColors' => $kardexColors, 'kardexColorTalla' => $kardexColorTalla]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipos = KardexTipoDetalle::orderby('tipo')
            ->pluck('tipo', 'id');

        return view('admin.kardexes.create', compact('tipos'));
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
            'motivo.required' => 'Ingrese un motivo para el movimiento.',

        ];

        $request->validate([
            'motivo' => 'required',

        ], $messages);

        if ($request->tipo_id == "2") {
            foreach ($request->kardexes as $kardex) {
                $tmpKardex = json_decode($kardex);

                $cantidad = $request->all()[$tmpKardex->id];

                if ($tmpKardex->stockDisponible < $cantidad) {


                    return redirect()->route('admin.kardexes.editDetails',['producto'=>$request->producto_id,'color'=>$request->color_id])->with('error', 'La talla ' . $tmpKardex->nombreTalla . ' no cuenta con stock disponible. No se realizo ningun cambio.');
                }
            }
        }

        foreach ($request->kardexes as $kardex) {
            $tmpKardex = json_decode($kardex);
            $cantidad = $request->all()[$tmpKardex->id];
            if ($cantidad > 0) {
               
                

                $kardexDetalle = new KardexDetalle();
                $kardexDetalle->kardex_id = $tmpKardex->id;
                $kardexDetalle->tipo_id = $request->tipo_id;
                $kardexDetalle->fecha = date("y-m-d");
                $kardexDetalle->cantidad = $cantidad;
                $kardexDetalle->motivo = $request->motivo;

                $kardexEdit = Kardex::where('id', $tmpKardex->id)->first();
         
                if ($request->tipo_id == "1") {
                    
                    $kardexEdit->stockFisico = $kardexEdit->stockFisico + $cantidad;
                    $kardexEdit->stockDisponible = $kardexEdit->stockDisponible + $cantidad;
                } else if ($request->tipo_id == "2") {
                    $kardexEdit->stockFisico = $kardexEdit->stockFisico - $cantidad;
                    $kardexEdit->stockDisponible = $kardexEdit->stockDisponible - $cantidad;
                }
                
                $kardexDetalle->save();
                $kardexEdit->save();
            }
            
            
        }

        return redirect()->route('admin.kardexes.index')->with('info', 'Se registro el movimiento correctamente');
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
    public function edit($producto, $color)
    {

       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
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


    public function editDetails($producto, $color)
    {

        $kardexes = Kardex::where('producto_id', $producto)
            ->where('color_id', $color)
            ->join('tallas', 'kardexes.talla_id', '=', 'tallas.id')
            ->select('kardexes.id', 'talla_id', 'tallas.nombre as nombreTalla', 'stockFisico', 'stockDisponible')
            ->get();

        $color = Color::where('id', $color)->first();
        $producto = Producto::where('id', $producto)->with('tipo', 'material', 'genero', 'linea')->first();

        $kardexTiposDetalle = KardexTipoDetalle::pluck('tipo', 'id');
        return view('admin.kardexes.edit', compact('kardexes', 'producto', 'color', 'kardexTiposDetalle'));
    }
}
