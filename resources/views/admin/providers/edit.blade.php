@extends('adminlte::page')

@section('title', 'MyZore')

@section('content_header')
<h1>Editar color</h1>
@stop

@section('content')
{!! Form::model($provider,['route'=>['admin.providers.update',$provider],'method'=>'put'])!!}
<div class="row">
    <div class="card col-lg-12">

        <div class="card-body">

            <div class="row">
                <div class="form-group col-lg-12">
                    {!! Form::label('razonSocial','Nombre')!!}
                    {!! Form::text('razonSocial',$provider->personajuridica->razonSocial,['class'=> 'form-control text-uppercase
                    col-lg-12','placeholder'=>'Ingrese el nombre del proveedor','autocomplete'=>'off'])!!}
                    @error('nombre')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                
            </div>
            <div class="row">
                <div class="form-group col-lg-4">

                    {!! Form::label('documento_id','Tipo Documento')!!}

                    {!! Form::select('documento_id',$documentos,null,['class'=> 'form-control'])!!}
                </div>
                <div class="form-group col-lg-4">
                    {!! Form::label('nroDocumento','Nro. Documento')!!}
                    {!! Form::text('nroDocumento',$provider->personajuridica->persona->nroDocumento,['class'=> 'form-control text-uppercase
                    col-lg-12','placeholder'=>'Ingrese el RUC del proveedor','autocomplete'=>'off'])!!}
                    @error('ruc')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                
                <div class="form-group col-lg-4">

                    {!! Form::label('nivel_id','Nivel')!!}

                    {!! Form::select('nivel_id',$niveles,null,['class'=> 'form-control'])!!}
                </div>
            </div>
            <div class="row">
                <div class="form-group col-lg-4">

                    {!! Form::label('region_id','Región')!!}

                    {!! Form::select('region_id',$regiones,null,['class'=> 'form-control'])!!}
                </div>
                <div class="form-group col-lg-4">

                    {!! Form::label('provincia_id','Provincia')!!}

                    {!! Form::select('provincia_id',$provincias,null,['class'=> 'form-control'])!!}
                </div>
                <div class="form-group col-lg-4">

                    {!! Form::label('distrito_id','Distrito')!!}

                    {!! Form::select('distrito_id',$distritos,null,['class'=> 'form-control'])!!}
                </div>
            </div>
            <div class="row">
                
                <div class="form-group col-lg-4">
                    {!! Form::label('direccion','Dirección')!!}
                    {!! Form::text('direccion',$provider->personajuridica->persona->direccion,['class'=> 'form-control text-uppercase
                    col-lg-12','placeholder'=>'Ingrese la dirección del proveedor','autocomplete'=>'off'])!!}
                    @error('direccion')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group col-lg-4">
                    {!! Form::label('telefono','Teléfono')!!}
                    {!! Form::text('telefono',$provider->personajuridica->persona->telefono,['class'=> 'form-control text-uppercase
                    col-lg-12','placeholder'=>'Ingrese el teléfono del proveedor','autocomplete'=>'off'])!!}
                    @error('ruc')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group col-lg-4">
                    {!! Form::label('email','Email')!!}
                    {!! Form::text('email',$provider->personajuridica->persona->email,['class'=> 'form-control text-uppercase
                    col-lg-12','placeholder'=>'Ingrese un email para el proveedor','autocomplete'=>'off'])!!}
                    @error('email')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
               
            </div>
            

        </div>
    </div>
</div>

<div class="row">
    <div class="card col-lg-12">
        <div class="card-body">
            <div class="form-group">
                {!! Form::submit('Editar proveedor', ['class' => 'btn btn-primary float-right'])!!}
            </div>
        </div>
    </div>
</div>
{!! Form::close()!!}
@stop