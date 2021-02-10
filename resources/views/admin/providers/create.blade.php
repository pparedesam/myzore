@extends('adminlte::page')
@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">

@endsection
@section('title', 'MyZore')

@section('content_header')
<h1>Crear nuevo proveedor</h1>
@stop

@section('content')
{!! Form::open(['route'=>'admin.providers.store','id'=>'frmDatos','name'=>'frmDatos'])!!}
<div class="row">
    <div class="card col-lg-12">

        <div class="card-body">

            <div class="row">
                <div class="form-group col-lg-12">
                    {!! Form::label('razonSocial','Nombre')!!}
                    {!! Form::text('razonSocial',null,['class'=> 'form-control text-uppercase
                    col-lg-12','placeholder'=>'Ingrese el nombre del proveedor','autocomplete'=>'off'])!!}
                    @error('razonSocial')
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
                    {!! Form::label('nroDocumento','Nro. Ruc')!!}
                    {!! Form::text('nroDocumento',null,['class'=> 'form-control text-uppercase
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
                    {!! Form::text('direccion',null,['class'=> 'form-control text-uppercase
                    col-lg-12','placeholder'=>'Ingrese la dirección del proveedor','autocomplete'=>'off'])!!}
                    @error('direccion')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group col-lg-4">
                    {!! Form::label('telefono','Teléfono')!!}
                    {!! Form::text('telefono',null,['class'=> 'form-control text-uppercase
                    col-lg-12','placeholder'=>'Ingrese el teléfono del proveedor','autocomplete'=>'off'])!!}
                    @error('ruc')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group col-lg-4">
                    {!! Form::label('email','Email')!!}
                    {!! Form::text('email',null,['class'=> 'form-control text-uppercase
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
                {!! Form::submit('Crear proveedor', ['class' => 'btn btn-primary float-right'])!!}
            </div>
        </div>
    </div>
</div>

{!! Form::close()!!}

@stop

@section('js')
<script>
    $("#region_id").change(function(){
        let region_id=$("#region_id").val();
        orbtenerProvincias(region_id)
    })

    $("#provincia_id").change(function(){
        let provincia_id=$("#provincia_id").val();
        onSelectProvinciaChanged(provincia_id)
    })

    function orbtenerProvincias(region_id){
               
        $.get('/admin/Ubigeo/region/'+region_id+'/provincias',function(data){
            let html_select = '';
            for (let i=0; i<data.length;++i){
                html_select +='<option value="'+data[i].id+'">'+data[i].nombre+'</option>';
                if(i==0){
                    obtenerDistritos(data[i].id)
                }
            }     
            $('#provincia_id').html(html_select);
        })
        
    }

    function obtenerDistritos(provincia_id){

        $.get('/admin/Ubigeo/provincia/'+provincia_id+'/distritos',function(data){
            let html_select = '';
            for (let i=0; i<data.length;++i)
                html_select +='<option value="'+data[i].id+'">'+data[i].nombre+'</option>';
            $('#distrito_id').html(html_select);
        })
        
    }
</script>
@endsection