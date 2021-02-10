@extends('adminlte::page')

@section('title', 'MyZore')

@section('content_header')
<h1>Lista de proveedores</h1>
@stop



@section('content')

<div class="card">
    <div class="card-header">
        <a href="{{route('admin.socios.create')}}" class="btn btn-primary">Nuevo socio</a>
    </div>
    <div class="card-body">
        <table class="table table-striped " id="tblSocios">
            <thead>
                <tr>
                    <th class="text-center">Nro documento</th>
                    <th class="text-center">Apellido paterno</th>
                    <th class="text-center">Apellido materno</th>
                    <th class="text-center">Nombres</th>
                    <th class="text-center">Teléfono</th>
                    <th class="text-center">WhatsApp</th>
                    <th class="text-center">Fecha Nac.</th>
                    <th class="text-center">Estado civil</th>
                    <th class="text-center">Género</th>
                    <th class="text-center">Dirección</th>
                    <th class="text-center">Referencia</th>
                    <th class="text-center">Distrito</th>
                    <th class="text-center">Provincia</th>
                    <th class="text-center">Región</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($socios as $socio)
                <tr>
                    {{-- <td class="text-center">{{$provider->personajuridica->persona->nroDocumento}}</td>
                    <td class="text-center">{{$provider->personajuridica->razonSocial}}</td>
                    <td class="text-center">{{$provider->personajuridica->persona->telefono}}</td>
                    <td class="text-center">{{$provider->personajuridica->persona->direccion}}</td>
                    <td class="text-center">{{$provider->personajuridica->persona->distrito->nombre}}</td>
                    <td class="text-center">{{$provider->personajuridica->persona->provincia->nombre}}</td>
                    <td class="text-center">{{$provider->personajuridica->persona->region->nombre}}</td>
                    <td class="inline-block text-center">
                        <form action="{{route('admin.providers.destroy',$provider)}}" method="post">
                            <a href="{{route('admin.providers.edit',$provider)}}" class="btn btn-primary btn-sm mt-1">Editar</a>

                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger btn-sm mt-1">Eliminar</button>
                        </form>
                    </td> --}}
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
        $('#tblSocios').DataTable({
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
                { width: "10%"},
                { width: "10%"},
                { width: "10%"},
                { width: "10%"},
                { width: "5%"},
                { width: "5%"},
                { width: "5%"},
                { width: "5%"},
                { width: "5%"},
                { width: "5%"},
                { width: "5%"},
                { width: "5%"},
                { width: "5%"},
                { width: "5%"},
                { width: "10%"},
            ]
            
        }
        
    );
} );
</script>

@endsection