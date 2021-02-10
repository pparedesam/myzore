@extends('adminlte::page')

@section('title', 'MyZore')

@section('content_header')
<h1>Editar material</h1>
@stop

@section('content')

@if (session('info'))
<div class="alert alert-success">
    <strong>{{session('info')}}</strong>
</div>
@endif


<div class="card">
    <div class="card-body">
        
        {!! Form::model($material,['route'=>['admin.materials.update', $material],'method'=>'put'])!!}
        
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