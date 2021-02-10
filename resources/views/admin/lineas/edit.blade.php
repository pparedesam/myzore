@extends('adminlte::page')

@section('title', 'MyZore')

@section('content_header')
    <h1>Editar l&iacute;nea</h1>
@stop

@section('content')

    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{session('info')}}</strong>
        </div>
    @endif
    

<div class="card">
    <div class="card-body">
        {!! Form::model($linea,['route'=>['admin.lineas.update',$linea],'method'=>'put'])!!}
        <div class="form-group">
            {!! Form::label('nombre','Nombre')!!}
            {!! Form::text('nombre',null,['class'=> 'form-control text-uppercase','placeholder'=>'Ingrese el nombre de la línea'])!!}

            @error('nombre')
                <span class="text-danger">{{$message}}</span>
            @enderror

        </div>
        <div class="form-group">
            {!! Form::label('slug','slug')!!}
            {!! Form::text('slug',null,['class'=> 'form-control','placeholder'=>'Ingrese el slug de la línea','readonly'])!!}

            @error('slug')
                <span class="text-danger">{{$message}}</span>
            @enderror

        </div>
        <div class="form-group">
            {!! Form::submit('Actualizar línea', ['class' => 'btn btn-primary float-right']) !!}
        </div>


        {!! Form::close()!!}
    </div>
</div>
@stop

