@extends('adminlte::page')

@section('title', 'MyZore')

@section('content_header')
<h1>Lista de materials</h1>
@stop



@section('content')

<div class="card">
    <div class="card-header">
        <a href="{{route('admin.materials.create')}}" class="btn btn-primary">Nuevo material</a>
    </div>
    <div class="card-body">
        <table class="table table-striped" id="tblMaterials">
            <thead>
                <tr>
                    <th class="text-center">Nombre</th>
                    <th ></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($materials as $material)
                <tr>
                    <td class="text-center">{{$material->nombre}}</td>
                    <td class="text-center">
                        <form action="{{route('admin.materials.destroy',$material)}}" method="post">
                            <a href="{{route('admin.materials.edit',$material)}}" class="btn btn-primary btn-sm mt-1">Editar</a>
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
                timer: 3000,
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            });

        @endif
        $('#tblMaterials').DataTable({
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
                { width: "70%"},
                { width: "30%"},
            ]
            
        }
        
    );
} );
</script>

@endsection