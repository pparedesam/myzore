@extends('adminlte::page')

@section('title', 'MyZore')

@section('content_header')
<h1>Editar color</h1>
@stop

@section('content')

<div class="card">
    <div class="card-body">
        {!! Form::model($talla,['route'=>['admin.tallas.update',$talla],'method'=>'put'])!!}

        <div class="form-group">
            {!! Form::label('nombre','Nombre')!!}
            {!! Form::text('nombre',null,['class'=> 'form-control text-uppercase','placeholder'=>'Ingrese el nombre del color'])!!}

            @error('nombre')
            <span class="text-danger">{{$message}}</span>
            @enderror

        </div>
        <div class="form-group">
            {!! Form::submit('Actualizar color', ['class' => 'btn btn-primary float-right']) !!}
        </div>


        {!! Form::close()!!}
    </div>
</div>
@stop