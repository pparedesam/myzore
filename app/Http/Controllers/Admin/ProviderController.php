<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Distrito;
use App\Models\Documento;
use App\Models\Persona;
use App\Models\PersonaJuridica;
use App\Models\Provider;
use App\Models\ProviderNivel;
use App\Models\Provincia;
use App\Models\Region;
use App\Models\User;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $providers = Provider::where('estado', '1')->with('personajuridica', 'personajuridica.persona')->get();

        return view('admin.providers.index', ['providers' => $providers]);
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

        $niveles = ProviderNivel::orderby('nombre')
            ->pluck('nombre', 'id');

        $documentos = Documento::where('nombre', 'ruc')->orderby('nombre')
            ->pluck('nombre', 'id');

        return view('admin.providers.create', compact('regiones', 'provincias', 'distritos', 'niveles', 'documentos'));
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
            'razonSocial.required' => 'Ingrese un nombre para el proveedor.',
            'nroDocumento.required' => 'Ingrese un nro de documento para el proveedor.',
        ];

        $request->validate([
            'razonSocial' => 'required',
            'nroDocumento' => 'required',
        ], $messages);

        $persona = Persona::create($request->all());

        $personaJuridica = new PersonaJuridica();
        $personaJuridica->razonSocial = $request->razonSocial;
        $personaJuridica->persona_id = $persona->id;
        $personaJuridica->save();

        $provider = new Provider();
        $provider->personajuridica_id = $personaJuridica->id;
        $provider->nivel_id = $request->nivel_id;
        $provider->save();

        if ($request->nivel_id == 2) {
            $userProvider = User::factory()->create([

                'name' => $provider->personajuridica->persona->nroDocumento,
                'email' => $request->email,
                'password' => bcrypt('12345678'),
                'persona_id' => $persona->id,
            ]);
            $userProvider->assignRole('Provider');
        }
        //$tipo->id=str_pad($tipo->id,2,"0",STR_PAD_LEFT);

        return redirect()->route('admin.providers.index')->with('info', 'Se registró el proveedor con éxito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Provider $provider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Provider $provider)
    {
        $regiones = Region::orderby('nombre')
            ->pluck('nombre', 'id');

        $provincias = Provincia::where('region_id', '01')
            ->pluck('nombre', 'id');

        $distritos = Distrito::where('provincia_id', '0101')
            ->pluck('nombre', 'id');

        $niveles = ProviderNivel::orderby('nombre')
            ->pluck('nombre', 'id');

        $documentos = Documento::where('nombre', 'ruc')->orderby('nombre')
            ->pluck('nombre', 'id');

        return view('admin.providers.edit', compact('provider','regiones', 'provincias', 'distritos', 'niveles', 'documentos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Provider $provider)
    {
        $messages = [
            'razonSocial.required' => 'Ingrese un nombre para el proveedor.',
            'nroDocumento.required' => 'Ingrese un nro de documento para el proveedor.',
        ];

        $request->validate([
            'razonSocial' => 'required',
            'nroDocumento' => 'required',
        ], $messages);

        $provider->personajuridica->update($request->all());
        $provider->personajuridica->persona->update($request->all());

        $provider->update($request->all());
        return redirect()->route('admin.providers.index')->with('info', 'El proveedor se actualizó con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Provider $provider)
    {
        $provider->estado = '0';
        $provider->save();


        return redirect()->route('admin.providers.index')->with('info', 'El proveedor ' . $provider->personajuridica->razonSocial . ', se eliminó con éxito');
    }
}
