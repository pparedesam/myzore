@extends('adminlte::page')

@section('title', 'MyZore')

@section('content_header')
<h1>Crear nueva l&iacute;nea</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        {!! Form::open(['route'=>'admin.lineas.store'])!!}
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
            {!! Form::submit('Crear linea', ['class' => 'btn btn-primary float-right']) !!}
        </div>


        {!! Form::close()!!}
    </div>
</div>
@stop

@section('js')
<script src="{{asset('vendor/jQuery-Plugin-stringToSlug-1.3/jquery.stringToSlug.min.js')}}"></script>
<script>
    $(document).ready( function() {
        $("#nombre").stringToSlug({
            setEvents: 'keyup keydown blur',
            getPut: '#slug',
            space: '-'
        });
    })
</script>
@endsection