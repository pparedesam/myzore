@extends('adminlte::page')

@section('title', 'MyZore')

@section('content_header')
<h1>Lista de tipos</h1>
@stop



@section('content')

<div class="card">
    <div class="card-header">
        <a href="{{route('admin.tipos.create')}}" class="btn btn-primary">Nuevo tipo</a>
    </div>
    <div class="card-body">
        <table class="table table-striped " id="tblTipos">
            <thead>
                <tr>
                    <th class="text-center">Código</th>
                    <th class="text-center">Nombre</th>
                    <th class="text-center">Línea</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tipos as $tipo)
                <tr>
                    <td class="text-center">{{$tipo->id}}</td>
                    <td class="text-center">{{$tipo->nombre}}</td>
                    <td class="text-center">{{$tipo->linea->nombre}}</td>
                    <td class="inline-block text-center">
                        <form action="{{route('admin.tipos.destroy',$tipo)}}" method="post">
                            <a href="{{route('admin.tipos.edit',$tipo)}}" class="btn btn-primary btn-sm mt-1">Editar</a>

                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger btn-sm mt-1">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

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
                timer: 3000
            });

        @endif
        $('#tblTipos').DataTable({
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
                { width: "15%"},
                { width: "35%"},
                { width: "35%"},
                { width: "15%"},
            ]
            
        }
        
    );
} );
</script>

@endsection