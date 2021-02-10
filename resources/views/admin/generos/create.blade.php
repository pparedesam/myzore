@extends('adminlte::page')

@section('title', 'MyZore')

@section('content_header')
<h1>Crear nuevo género</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        {!! Form::open(['route'=>'admin.generos.store'])!!}
        <div class="form-group">
            {!! Form::label('nombre','Nombre')!!}
            {!! Form::text('nombre',null,['class'=> 'form-control text-uppercase','placeholder'=>'Ingrese el nombre del género'])!!}

            @error('nombre')
                <span class="text-danger">{{$message}}</span>
            @enderror

        </div>
        <div class="form-group">
            {!! Form::submit('Crear género', ['class' => 'btn btn-primary float-right']) !!}
        </div>


        {!! Form::close()!!}
    </div>
</div>
@stop

@section('js')
<script src="{{asset('vendor/jQuery-Plugin-stringToSlug-1.3/jquery.stringToSlug.min.js')}}"></script>
<script>
    
</script>
@endsection