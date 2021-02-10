@extends('adminlte::page')

@section('title', 'MyZore')

@section('content_header')
<h1>Lista de productos</h1>
@stop



@section('content')

<div class="card">
    <div class="card-header">
        <a href="{{route('admin.productos.create')}}" class="btn btn-primary">Nuevo producto</a>
    </div>
    <div class="card-body">
        <table class="table table-striped " id="tblProductos">
            <thead>
                <tr>
                    <th class="text-center" data-priority='1'>Código</th>
                    <th class="text-center">Nombre</th>
                    <th class="text-center">Línea</th>
                    <th class="text-center">Tipo</th>
                    <th class="text-center">Género</th>
                    <th class="text-center">Material</th>
                    <th class="text-center">Código Proveedor</th>
                    <th data-priority='1'></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($productos as $producto)
                <tr>
                    <td class="text-center">{{$producto->codigo}}</td>
                    <td class="text-center">{{$producto->nombre}}</td>
                    <td class="text-center">{{$producto->linea->nombre}}</td>
                    <td class="text-center">{{$producto->tipo->nombre}}</td>
                    <td class="text-center">{{$producto->genero->nombre}}</td>
                    <td class="text-center">{{$producto->material->nombre}}</td>
                    <td class="text-center">{{$producto->codigoProveedor}}</td>
                    <td class="inline-block">
                        <form action="{{route('admin.productos.destroy',$producto)}}" method="post">
                            <a href="{{route('admin.productos.edit',$producto)}}" class="btn btn-primary btn-sm mb-1 col-12">Editar</a>

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

        $('#tblProductos').DataTable({
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
                { width: "15%"},
                { width: "25%"},
                { width: "10%"},
                { width: "10%"},
                { width: "10%"},
                { width: "10%"},
                { width: "10%"},
                { width: "10%"},
            ]
            
        }
        
    );
} );
</script>

@endsection