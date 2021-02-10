<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductoRequest;
use App\Models\Color;
use Illuminate\Http\Request;

use App\Models\Producto;
use App\Models\Linea;
use App\Models\Genero;
use App\Models\Material;
use App\Models\Producto_Provider;
use App\Models\ProductoImagenes;
use App\Models\Provider;
use App\Models\Talla;
use App\Models\Tipo;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{

    public function __construct()
    {

        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $this->authorize('viewAny', Producto::class);

        $productos = Producto::where('estado', '1')->orderBy('nombre')->get();

        return view('admin.productos.index', ['productos' => $productos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lineas = Linea::where('lineas.estado', '1')
            ->join('materials','lineas.id','=','materials.linea_id')
            ->join('tipos','lineas.id','=','tipos.linea_id')
            ->orderby('nombre')
            ->pluck('lineas.nombre', 'lineas.id');

        $generos = Genero::where('estado', '1')
            ->orderby('nombre')
            ->pluck('nombre', 'id');

        $linea = Linea::select('lineas.id')
            ->join('materials','lineas.id','=','materials.linea_id')
            ->join('tipos','lineas.id','=','tipos.linea_id')
            ->where('lineas.estado', '1')
            ->orderby('lineas.nombre')->first();
        
        $materiales = Material::where('estado', '1')
            ->where('linea_id', $linea->id)
            ->orderby('nombre')
            ->pluck('nombre', 'id');
        
        $tipos = Tipo::where('estado', '1')
            ->where('linea_id', $linea->id)
            ->orderby('nombre')
            ->pluck('nombre', 'id');

        $providers = Provider::where('estado', '1')->with('personajuridica', 'personajuridica.persona')->get();

        /* $providers = Provider::select('id','provider.personajuridica.ruc','nombre','distrito_id')
            ->with('distrito')
            ->where('estado', '1')
            ->orderby('nombre')
            ->get(); */


        $tallas = Talla::all();

        $colors = Color::all();

        return view('admin.productos.create', ['lineas' => $lineas, 'generos' => $generos, 'materiales' => $materiales, 'tipos' => $tipos, 'providers' => $providers, 'tallas' => $tallas, 'colors' => $colors]);
        //return view('admin.productos.create', compact('lineas', 'generos', 'materiales', 'tipos', 'providers','tallas','colors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Responses
     */
    public function store(StoreProductoRequest $request)
    {
        $producto = Producto::create($request->all());
        $cant = Producto::where('genero_id', $producto->genero_id)->where('tipo_id', $producto->tipo_id)->count();
        $codTipo = str_pad($producto->tipo_id, 2, "0", STR_PAD_LEFT);
        $producto->codigo = ($cant) . $producto->genero_id . $codTipo;
        $producto->save();

        if ($request->tallas) {
            $producto->tallas()->attach($request->tallas);
        }

        if ($request->colors) {
            $producto->colors()->attach($request->colors);
        }

        if (!empty($request->productoProviders)){
            $productoProviders = json_decode($request->productoProviders);
            foreach ($productoProviders as $provider) {

                DB::insert(
                    'insert into producto_provider 
                            (producto_id, provider_id,codigoProveedor,precio) 
                            values (?,?,?,?)',
                    [$producto->id, $provider->id, $provider->codigoProducto, $provider->precio]
                );
            }
        }

       

        foreach ($request->colors as $color) {
            for($i=1; $i<=4; $i++){
                
                $archivo=$request->file('image-'.$color[0].'-'.$i);
                if (isset($archivo)){
                    $nombre = $producto->codigo."-".$color[0]."-" . $i .".jpg";
                    $ruta = storage_path('app/public/images/products/' . $nombre);

                    Image::make($request->file('image-'.$color[0].'-'.$i))
                        ->resize(1200, null, function ($constraint) {
                            $constraint->aspectRatio();
                        })
                        ->save($ruta);
                    $type="1";
                    if($i>1){
                        $type="2";
                    }
                    ProductoImagenes::create([
                        'producto_id'=>$producto->id,
                        'color_id'=>$color[0],
                        'imageType_id' => $type,
                        'nombreImageColor' => $color[0].'-'.$i,
                        'url' => '/storage/images/products/' . $nombre
                    ]);
                }
                
            }
        }
        return redirect()->route('admin.productos.index')->with('info', 'El producto se registró con éxito'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
        return view('admin.productos.show', compact('producto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Producto $producto)
    {
        $lineas = Linea::where('estado', '1')
            ->orderby('nombre')
            ->pluck('nombre', 'id');


        $generos = Genero::where('estado', '1')
            ->orderby('nombre')
            ->pluck('nombre', 'id');
        $materiales = Material::where('estado', '1')
            ->orderby('nombre')
            ->pluck('nombre', 'id');

        $linea = Linea::where('estado', '1')->orderby('nombre')->first();
        $tipos = Tipo::where('estado', '1')
            ->where('linea_id', $linea->id)
            ->orderby('nombre')
            ->pluck('nombre', 'id');

        $providers = Provider::select('providers.id','personasjuridicas.razonSocial','personas.nroDocumento')
                ->join('personasjuridicas','providers.personajuridica_id','=','personasjuridicas.id')
                ->join('personas','personasjuridicas.persona_id','=','personas.id')
                ->leftJoin('producto_provider', function ($join) use($producto) {
                    $join->on('providers.id', '=', 'producto_provider.provider_id')
                    ->where('producto_provider.producto_id',$producto->id);
                })
                ->whereNull('producto_provider.provider_id')
                ->get();
        
        $productoProviders = Provider::select('providers.id','personasjuridicas.razonSocial','personas.nroDocumento','producto_provider.precio','producto_provider.codigoProveedor')
                    ->join('personasjuridicas','providers.personajuridica_id','=','personasjuridicas.id')
                    ->join('personas','personasjuridicas.persona_id','=','personas.id')
                    ->join('producto_provider', function ($join) use($producto) {
                        $join->on('providers.id', '=', 'producto_provider.provider_id')
                        ->where('producto_provider.producto_id',$producto->id);
                    })
                    ->get();
        
        $tallas = Talla::all();

        $colors = Color::select('colors.id','colors.nombre','producto_color.color_id')
                    ->leftJoin('producto_color', function ($join) use($producto) {
                        $join->on('colors.id', '=', 'producto_color.color_id')
                        ->where('producto_color.producto_id',$producto->id);
                    })->get();
                    /* ->leftJoin('productoimagenes', function ($join) use($producto) {
                        $join->on('colors.id', '=', 'productoimagenes.color_id')
                        ->where('productoimagenes.producto_id',$producto->id);
                    }) */
        $imagesColor = ProductoImagenes::select('id','color_id','url','nombreImageColor')
                        ->where('producto_id',$producto->id)
                        ->get();


        return view('admin.productos.edit', compact('producto', 'lineas', 'generos', 'materiales', 'tipos', 'providers', 'tallas', 'colors','productoProviders','imagesColor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreProductoRequest $request, Producto $producto)
    {
        $producto->update($request->all());

        DB::table('producto_talla')->where('producto_id',$producto->id)->delete();

        if ($request->tallas) {
            $producto->tallas()->attach($request->tallas);
        }

        if ($request->colors) {
            $producto->colors()->attach($request->colors);
        }

        
        return redirect()->route('admin.productos.edit',compact('producto'))->with('info', 'El producto se actualizó con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producto $producto)
    {
        $producto->estado = '0';
        $producto->save();

        return redirect()->route('admin.productos.index')->with('info', 'El producto ' . $producto->nombre . ', se eliminó con éxito');
    }

    public function asignarProvider(Request $request)
    {
        
        $productoProvider = Producto_Provider::updateOrCreate(
            ['producto_id' => $request->producto_id, 'provider_id' => $request->provider_id],
            ['precio' => $request->precio, 'codigoProveedor' => $request->modalProvProdCod]
        );
        
        $producto=Producto::where('id',$request->producto_id)->first();
        return redirect()->route('admin.productos.edit',compact('producto'))->with('info', 'Se asignó el proveedor con éxito');
        
    }

    public function desasignarProvider(Request $request,$provider_id,$producto_id)
    {
        DB::table('producto_provider')
            ->where('provider_id',$provider_id)
            ->delete();
        $producto=Producto::where('id',$producto_id)->first();
        return redirect()->route('admin.productos.edit',compact('producto'))->with('info', 'Se desasignó el proveedor con éxito');
        
    }

    public function actualizarColoresImages(Request $request)
    {
        $producto=Producto::where('id',$request->producto_id)->first();
        
        if ($request->colors) {
            DB::table('producto_color')
                ->where('producto_id',$producto->id)
                ->delete();
            foreach($request->colors as $color){
                DB::table('producto_color')
                ->insert(['producto_id'=>$producto->id,
                            'color_id'=>$color[0]]);
            }
            
        }

        $productoImages=ProductoImagenes::where('producto_id',$producto->id)->get();
        
        foreach ($request->colors as $color) {
            for($i=1; $i<=4; $i++){
                
                $archivo=$request->file('image-'.$color[0].'-'.$i);
                if (isset($archivo)){
                    
                    $nombre = $producto->codigo."-".$color[0]."-" . $i .".jpg";
                    $ruta = storage_path('app/public/images/products/' . $nombre);

                    Image::make($request->file('image-'.$color[0].'-'.$i))
                        ->resize(1200, null, function ($constraint) {
                            $constraint->aspectRatio();
                        })
                        ->save($ruta);
                    $type="1";
                    if($i>1){
                        $type="2";
                    }
                    ProductoImagenes::create([
                        'producto_id'=>$producto->id,
                        'color_id'=>$color[0],
                        'imageType_id' => $type,
                        'nombreImageColor' => $color[0].'-'.$i,
                        'url' => '/storage/images/products/' . $nombre
                    ]);
                }
                
            }
        }

        return redirect()->route('admin.productos.edit',compact('producto'))->with('info', 'Se actualizaron los colores e imágenes con éxito'); 
        
    }

    public function eliminarImagenProducto(Request $request,$id){
        $image=ProductoImagenes::where('id',$id)->first();

        $url=str_replace('storage','public',$image->url);
        Storage::delete($url);
        $producto=Producto::where('id',$image->producto_id)->first();
        $image->delete();

        return redirect()->route('admin.productos.edit',compact('producto'))->with('info', 'Se elimino la imagen con exito'); 

    }
}
