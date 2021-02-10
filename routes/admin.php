<?php

use App\Http\Controllers\Admin\CatalogController;
use App\Http\Controllers\Admin\HomeController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\LineaController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\MaterialController;
use App\Http\Controllers\Admin\TallasController;
use App\Http\Controllers\Admin\GeneroController;
use App\Http\Controllers\Admin\KardexController;
use App\Http\Controllers\Admin\ProductoController;
use App\Http\Controllers\Admin\ProviderController;
use App\Http\Controllers\Admin\SocioController;
use App\Http\Controllers\UbiGeoController;
use App\Http\Controllers\Admin\TipoController;
use App\Http\Controllers\Admin\WarehouseController;
use App\Models\Warehouse;

Route::get('',[HomeController::class,'index'])->name('admin.home');

Route::resource('lineas',LineaController::class)->names('admin.lineas');
Route::get('/lineas/{id}/tipos',[LineaController::class,'getTipos']);

Route::resource('colors',ColorController::class)->names('admin.colors');
Route::resource('materials',MaterialController::class)->names('admin.materials');
Route::resource('tallas',TallasController::class)->names('admin.tallas');
Route::resource('generos',GeneroController::class)->names('admin.generos');
Route::resource('tipos',TipoController::class)->names('admin.tipos');
Route::resource('providers',ProviderController::class)->names('admin.providers');

Route::get('/kardex/{producto}/color/{color}', [KardexController::class, 'editDetails'])->name('admin.kardexes.editDetails');
Route::resource('kardex',KardexController::class)->names('admin.kardexes');

Route::post('/productos/actualizarColoresImages/',[ProductoController::class,'actualizarColoresImages'])->name('admin.productos.actualizarColoresImages');
Route::post('/productos/asignarProvider/',[ProductoController::class,'asignarProvider'])->name('admin.productos.asignarProvider');
Route::get('/productos/{producto_id}/desasignarProvider/{provider_id}',[ProductoController::class,'desasignarProvider'])->name('admin.productos.desasignarProvider');
Route::get('/productos/eliminarImagenProducto/{url}',[ProductoController::class,'eliminarImagenProducto']);

Route::resource('productos',ProductoController::class)->names('admin.productos');

Route::get('productos/registrar',[ProductoController::class,'registrar']);
Route::resource('warehouses',WarehouseController::class)->names('admin.warehouses');

//Ubigeo
Route::get('/Ubigeo/region/{id}/provincias',[UbigeoController::class,'getRegionProvincias']);
Route::get('/Ubigeo/provincia/{id}/distritos',[UbigeoController::class,'getProvinciaDistritos']);


Route::get('/kardex/index',[KardexController::class,'obtenerIngresos'])->name('admin.kardex.ingresos.index');

Route::resource('catalogs',CatalogController::class)->names('admin.catalogs');

Route::resource('socios',SocioController::class)->names('admin.socios');







