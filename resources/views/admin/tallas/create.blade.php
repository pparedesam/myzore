@extends('adminlte::page')

@section('title', 'MyZore')

@section('content_header')
<h1>Crear nueva talla</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        {!! Form::open(['route'=>'admin.tallas.store'])!!}
        <div class="form-group">
            {!! Form::label('nombre','Nombre')!!}
            {!! Form::text('nombre',null,['class'=> 'form-control text-uppercase','placeholder'=>'Ingrese el nombre de la talla'])!!}

            @error('nombre')
                <span class="text-danger">{{$message}}</span>
            @enderror

        </div>

        <div class="form-group">
            {!! Form::submit('Crear talla', ['class' => 'btn btn-primary float-right']) !!}
        </div>


        {!! Form::close()!!}
    </div>
</div>
@stop
