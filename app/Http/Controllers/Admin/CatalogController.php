<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Catalog;
use App\Models\CatalogType;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $catalogs = Catalog::where('estado', '1')->orderBy('created_at', 'desc')->with('type')->get();
        $types = CatalogType::where('estado', '1')->orderBy('nombre')->pluck('nombre', 'id');

        return view('admin.catalogs.index', ['catalogs' => $catalogs, 'types' => $types]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'nombre.required' => 'Ingrese un nombre para la campaña.',
            'fechaInicio.required' => 'Ingrese una fecha de inicio.',
            'fechaFin.required' => 'Ingrese una fecha de fin.',
        ];

        $request->validate([
            'nombre' => 'required',
            'fechaInicio' => 'required',
            'fechaFin' => 'required'
        ], $messages);

        $catalog = Catalog::create($request->all());


        $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $catalog->nombre);
        $slug = strtolower($slug);
        $catalog->slug = $slug;
        $catalog->save();

        return redirect()->route('admin.catalogs.index')->with('info', 'El catálogo se registro con éxito');
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
    public function edit(Catalog $catalog)
    {
        $productsCatalog=Producto::join('catalog_products', 'productos.id', '=', 'catalog_products.product_id')
                        ->where('catalog_products.catalog_id',$catalog->id)
                        ->get();

        $products = Producto::select('id', 'nombre', 'codigo', 'codigoProveedor')->where('estado', '1')->with('tallas:id,nombre', 'colors:id,nombre')->get();
        return view('admin.catalogs.edit', compact('catalog', 'products','productsCatalog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Catalog $catalog)
    {
        
        DB::table('catalog_products_color')
                ->where('catalog_id', '=', $catalog->id)
                ->where('product_id', '=', $request->id)
                ->delete();

        foreach ($request->colors as $color) {
            

            DB::table('catalog_products_color')->insert([
                'catalog_id' => $catalog->id,
                'product_id' => $request->id,
                'color_id' => $color[0],
            ]);
            $tallas = $request->all()["tallas-" . $color[0]];

            DB::table('catalog_products_colors_tallas')
                    ->where('catalog_id', '=', $catalog->id)
                    ->where('product_id', '=', $request->id)
                    ->where('color_id', '=', $color[0])
                    ->delete();
            foreach ($tallas as $talla) {
                

                DB::table('catalog_products_colors_tallas')->insert([
                    'catalog_id' => $catalog->id,
                    'product_id' => $request->id,
                    'color_id' => $color[0],
                    'talla_id' => $talla[0],
                ]);
            }
        }

        DB::table('catalog_products')
                ->where('catalog_id', '=', $catalog->id)
                ->where('product_id', '=', $request->id)
                ->delete();
        DB::table('catalog_products')->insert([
            'catalog_id' => $catalog->id,
            'product_id' => $request->id,
            'precioventa' => $request->modalProvProdPrec,
        ]); 

        return redirect()->route('admin.catalogs.edit',compact('catalog'))->with('info', 'Se registro el producto correctamente');
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
