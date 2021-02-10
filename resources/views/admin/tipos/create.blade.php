@extends('adminlte::page')
@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">

@endsection
@section('title', 'MyZore')

@section('content_header')
<h1>Crear nuevo tipo</h1>
@stop

@section('content')

<div class="card col-lg-12">

    <div class="card-body">
        {!! Form::open(['route'=>'admin.tipos.store','id'=>'frmDatos','name'=>'frmDatos'])!!}

        <div class="form-group">
            {!! Form::label('linea_id','Línea')!!}

            {!! Form::select('linea_id',$lineas,null,['class'=> 'form-control'])!!}

        </div>
        <div class="form-group">
            {!! Form::label('nombre','Nombre')!!}
            {!! Form::text('nombre',null,['class'=> 'form-control text-uppercase col-lg-12','placeholder'=>'Ingrese un nombre para el tipo','autocomplete'=>'off'])!!}
            @error('nombre')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <div class="form-group">
            {!! Form::submit('Crear tipo', ['class' => 'btn btn-primary float-right'])!!}
        </div>

        {!! Form::close()!!}
    </div>
</div>
@stop

@section('js')



@endsection