@extends('adminlte::page')

@section('title', 'MyZore')

@section('content_header')
<h1>Lista de almacenes</h1>
@stop



@section('content')

<div class="card">
    <div class="card-header">
        <a href="{{route('admin.warehouses.create')}}" class="btn btn-primary">Nuevo almacen</a>
    </div>
    <div class="card-body">


        <table class="table table-striped " id="tblAlmacen">
            <thead>
                <tr>
                    <th class="text-center" data-priority='1'>Almacen</th>
                    <th class="text-center">Responsable</th>
                    <th class="text-center">Dirección</th>
                    <th class="text-center">Distrito</th>
                    <th class="text-center">Provincia</th>
                    <th class="text-center">Region</th>
                    <th data-priority='1'></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($warehouses as $warehouse)
                <tr>
                    <td class="text-center">{{$warehouse->nombre}}</td>
                    <td class="text-center">{{$warehouse->user->persona->personajuridica->razonSocial}}</td>
                    <td class="text-center">{{$warehouse->direccion}}</td>
                    <td class="text-center">{{$warehouse->distrito->nombre}}</td>
                    <td class="text-center">{{$warehouse->provincia->nombre}}</td>
                    <td class="text-center">{{$warehouse->region->nombre}}</td>
                    
                    
                   
                    <td class="inline-block">
                        <form action="{{route('admin.warehouses.destroy',$warehouse)}}" method="post">
                            <a href="{{route('admin.warehouses.edit',$warehouse)}}" class="btn btn-primary btn-sm col-12 mb-1">Editar</a>

                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger btn-sm col-12">Eliminar</button>
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

        $('#tblAlmacen').DataTable({
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
            
            ordering: false,
            "columns": [
                { width: "25%"},
                { width: "15%"},
                { width: "10%"},
                { width: "10%"},
                { width: "10%"},
                { width: "15%"},
                { width: "15%"},
            ]
            
        }
        
    );
} );
</script>

@endsection