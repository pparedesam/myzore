@extends('adminlte::page')
@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">

@endsection
@section('title', 'MyZore')


@section('content_header')
<h1>DETALLE DE KARDEX DE {{$producto->nombre}}</h1>
@stop

@section('content')

<div class="card col-lg-12">
    <div class="card-header">
        <h4>Registrar nuevo movimiento</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-6"></div>
            <div class="col-lg-6">
                <div class="form-group ">
                    {!! Form::label('linea','Linea')!!}

                    {!! Form::text('linea',$producto->linea->nombre,['class'=> 'form-control text-uppercasecol-lg-12
                    text-center','placeholder'=>'Ingrese el nombre del almacen','autocomplete'=>'off','disabled'])!!}
                </div>
                <div class="form-group ">
                    {!! Form::label('genero','Género')!!}

                    {!! Form::text('genero',$producto->genero->nombre,['class'=> 'form-control text-uppercasecol-lg-12
                    text-center','placeholder'=>'Ingrese el nombre del almacen','autocomplete'=>'off','disabled'])!!}
                </div>
                <div class="form-group ">
                    {!! Form::label('material','Material')!!}

                    {!! Form::text('material',$producto->material->nombre,['class'=> 'form-control
                    text-uppercasecol-lg-12 text-center','placeholder'=>'Ingrese el nombre del
                    almacen','autocomplete'=>'off','disabled'])!!}
                </div>
                <div class="form-group ">
                    {!! Form::label('tipo','Tipo')!!}

                    {!! Form::text('tipo',$producto->tipo->nombre,['class'=> 'form-control text-uppercasecol-lg-12
                    text-center','placeholder'=>'Ingrese el nombre del almacen','autocomplete'=>'off','disabled'])!!}
                </div>
                <div class="form-group ">
                    {!! Form::label('color','Color')!!}

                    {!! Form::text('color',$color->nombre,['class'=> 'form-control text-uppercase
                    text-center','placeholder'=>'Ingrese el nombre del almacen','autocomplete'=>'off','disabled'])!!}
                </div>
            </div>
        </div>

    </div>
</div>

{!! Form::open(['route'=>'admin.kardexes.store'])!!}
<div class="card ">
    <div class="card-body">
        <div class="row">
            <div class="form-group col-lg-3">
                {!! Form::label('tipo_id','Tipo')!!}
                {!! Form::text('producto_id',$producto->id,['hidden'])!!}
                {!! Form::text('color_id',$color->id,['hidden'])!!}
                {!! Form::select('tipo_id',$kardexTiposDetalle,null,['class'=> 'form-control'])!!}
            </div>
            <div class="form-group col-lg-9">
                {!! Form::label('motivo','Motivo')!!}
                {!! Form::text('motivo',null,['class'=> 'form-control text-uppercase ','placeholder'=>'Ingrese un motivo','autocomplete'=>'off'])!!}
                @error('motivo')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        @foreach ($kardexes as $kardex)
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    {!! Form::checkbox('kardexes[]', $kardex, $kardex->id, ['class'=> '','onclick'=>'return false']) !!}
                </div>
            </div>
            <input type="text" class="form-control col-2" readonly aria-label="" value={{$kardex->nombreTalla}}>
            
            <input type="text" class="form-control text-center" name={{$kardex->id}} aria-label="" value="0" onkeypress="return soloNumero(event, this);" onblur="soloNumero(event, this);">
        </div>
        @endforeach
    </div>
</div>

<div class="card ">
    <div class="card-body">
        <div class="row">
            <div class="form-group col-lg-6 offset-lg-3">
                {!! Form::submit('Registrar movimiento', ['class' => 'btn btn-primary float-right col-lg-12'])!!}
            </div>
        </div>

    </div>
</div>
{!! Form::close()!!}

@stop


@section('js')

<script>
    $(document).ready( function () {
        @if (session('info'))
            Swal.fire(
                {icon: 'success',
                title: '{{session('info')}}',
                showConfirmButton: true,
                timer: 3000
            });
        @endif

        @if (session('error'))
            Swal.fire(
                {icon: 'error',
                title: '{{session('error')}}',
                showConfirmButton: true,
                timer: 3000
            });
        @endif      
  
    } );

    $('#tblMovimientos').DataTable({
        "language":{
            "decimal":        "",
            "emptyTable":     "No hay registros",
            "info":           "Mostrando _START_ de _END_ de _TOTAL_ registros",
            "infoEmpty":      "Mostrando 0 de 0 de 0 registros",
            "infoFiltered":   "(filtrado de un total de _MAX_ registros.)",
            "infoPostFix":    "",
            "thousands":      ",",
            "lengthMenu":     "Mostrando _MENU_ registros",
            "loadingRecords": "cargando...",
            "processing":     "procesando...",
            "search":         "Buscar:",
            "zeroRecords":    "No se encontraron registros",
            "paginate": {
                "first":      "Primero",
                "last":       "Ultimo",
                "next":       "Siguiente",
                "previous":   "Anterior"
            },
        },
        destroy: true,
        responsive:true,
        autoWidth: false,
        "lengthChange": false,
        filter:true,
        "paging": true, 
        "bInfo": false,
        "pageLength": 5,
        ordering: false,
        "columns": [
            { width: "20%"},
            { width: "20%"},
            { width: "40%"},
            { width: "20%"},
        ],

        createdRow: function (row, data, indice) {
            $(row).find("td:eq(0)").attr('data-id', data.id);
            $(row).find("td:eq(0)").attr('data-index', indice);
        }
        
    });
    

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

    function soloNumero(e, input) {
        var key = window.Event ? e.which : e.keyCode

        if (input.value.length >= 4) {
            return false;
        } else {
            e.value = parseInt(e.value, 10);
            return ((key >= 48 && key <= 57));
        }
    }

</script>

@endsection