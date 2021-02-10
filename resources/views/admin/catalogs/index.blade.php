@extends('adminlte::page')

@section('title', 'MyZore')

@section('content_header')
<h1>Catálogos</h1>
@stop



@section('content')
<div class="row">
    <div class="card col-lg-3 mr-4">
        <div class="card-header">
            <h3>Nuevo Catálogo</h3>
        </div>
        <div class="card-body">
            {!! Form::open(['route'=>'admin.catalogs.store'])!!}
            <div class="form-group">
                {!! Form::label('nombre','Campaña')!!}
                {!! Form::text('nombre',null,['class'=> 'form-control text-uppercase','placeholder'=>'NOMBRE PARA LA CAMPAÑA'])!!}

                @error('nombre')
                <span class="text-danger">{{$message}}</span>
                @enderror

            </div>

            <div class="form-group">
                {!! Form::label('fechaInicio','Fecha inicio')!!}
                <div class="" id="sandbox-container">
                    <div class="input-group date">
                        {!! Form::text('fechaInicio',null,['class'=> 'form-control text-center','placeholder'=>'FECHA DE INICIO','readonly'])!!}
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                        </div>
                    </div>
                </div>
                @error('fechaInicio')
                <span class="text-danger">{{$message}}</span>
                @enderror

            </div>

            <div class="form-group">
                {!! Form::label('fechaFin','Fecha fin')!!}
                <div class="" id="sandbox-container">
                    <div class="input-group date">
                        {!! Form::text('fechaFin',null,['class'=> 'form-control text-center','placeholder'=>'FECHA DE FIN','readonly'])!!}
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                        </div>
                    </div>
                </div>

                @error('fechaFin')
                <span class="text-danger">{{$message}}</span>
                @enderror

            </div>

            <div class="form-group ">
                {!! Form::label('type_id','Tipo')!!}

                {!! Form::select('type_id',$types,null,['class'=> 'form-control'])!!}
            </div>
            <hr>
            <div class="form-group">
                {!! Form::submit('Crear catalogo', ['class' => 'btn btn-primary float-right col-12']) !!}
            </div>


            {!! Form::close()!!}
        </div>

    </div>
    <div class="card col-lg-8">
        <div class="card-header">
            <h3>Lista de catálogos</h3>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="tblCatalogs">
                <thead>
                    <tr>
                        <th class="text-center">Campaña</th>
                        <th class="text-center">Fecha Inicio</th>
                        <th class="text-center">Fecha Fin</th>
                        <th class="text-center">Tipo</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($catalogs as $catalog)
                    <tr>
                        <td class="text-center">{{$catalog->nombre}}</td>
                        <td class="text-center">{{$catalog->fechaInicio}}</td>
                        <td class="text-center">{{$catalog->fechaFin}}</td>
                        <td class="text-center">{{$catalog->type->nombre}}</td>
                        <td class="text-center">
                            <form action="{{route('admin.catalogs.destroy',$catalog)}}" method="post">
                                <a href="{{route('admin.catalogs.edit',$catalog)}}"
                                    class="btn btn-primary btn-sm mt-1 col-12">Editar</a>
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger btn-sm mt-1 col-12">Eliminar</button>
                            </form>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>
@stop

@section('js')
<script>
    $(document).ready( function () {
        @if (session('info'))
            Swal.fire(
                {icon: 'success',
                title: '{{session('info')}}',
                showConfirmButton: true,
                timer: 3000,
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            });

        @endif        
    } );

    $('#tblCatalogs').DataTable({
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
            "aria": {
                "sortAscending":  ": activate to sort column ascending",
                "sortDescending": ": activate to sort column descending"
            }
        },
        destroy: true,
        responsive: true,
        autoWidth: false,
        ordering: false,
        "columns": [
            { width: "30%"},
            { width: "20%"},
            { width: "20%"},
            { width: "20%"},
            { width: "10%"},
        ]
        
    });

    $('#sandbox-container .input-group.date').datepicker({
        format: "yyyy-mm-dd",
        maxViewMode: 0,
        todayBtn: "linked",
        language: "es",
        autoclose: true
    });
</script>

@endsection