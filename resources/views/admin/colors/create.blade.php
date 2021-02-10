@extends('adminlte::page')

@section('title', 'MyZore')

@section('content_header')
<h1>Crear nuevo color</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        {!! Form::open(['route'=>'admin.colors.store'])!!}
        <div class="form-group">
            {!! Form::label('nombre','Nombre')!!}
            {!! Form::text('nombre',null,['class'=> 'form-control text-uppercase','placeholder'=>'Ingrese el nombre del color'])!!}

            @error('nombre')
                <span class="text-danger">{{$message}}</span>
            @enderror

        </div>
        <div class="form-group">
            {!! Form::label('hexadecimal','Hexadecimal')!!}
            <div id="cp2" class="input-group" title="Using input value">
                <input type="text" class="form-control input-lg" value="#DD0F20FF"/>
                <span class="input-group-append">
                  <span class="input-group-text colorpicker-input-addon"><i></i></span>
                </span>
              </div>
            

            @error('nombre')
                <span class="text-danger">{{$message}}</span>
            @enderror

        </div>
        <div class="form-group">
            {!! Form::submit('Crear color', ['class' => 'btn btn-primary float-right']) !!}
        </div>


        {!! Form::close()!!}
    </div>
</div>
@stop

@section('js')
<script>
   $('#cp2').colorpicker();
</script>
@endsection