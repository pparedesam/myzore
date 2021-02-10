@extends('adminlte::page')

@section('title', 'MyZore')

@section('content_header')
<h1>Lista de Kardex</h1>
@stop



@section('content')
{!! Form::open(['route'=>'admin.kardexes.store', 'id'=>'frmKardexes'])!!}
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-lg-4">
                        {!! Form::label('warehouse_id','Almacen')!!}

                        {!! Form::select('warehouse_id',$warehouse,null,['class'=> 'form-control'])!!}

                        {!! Form::text('producto_id',null, ['id'=>'producto_id','hidden'])!!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row-">
    <div class="card">
        <div class="card-body">
            <table class="table table-striped " id="tblKardexes">
                <thead>
                    <tr>
                        <th class="text-center">Línea</th>
                        <th class="text-center">Género</th>
                        <th class="text-center">Tipo</th>
                        <th class="text-center">Material</th>
                        <th class="text-center" data-priority='1'>Cod. Producto</th>
                        <th class="text-center">Producto</th>
                        <th class="text-center">Cod. Prod. Proveedor</th>
                        <th class="text-center" data-priority='1'>Color</th>
                        <th data-priority='1'></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kardexColors as $kardexColor)
                    <tr>
                        <td class="text-center">{{$kardexColor->producto->linea->nombre}}</td>
                        <td class="text-center">{{$kardexColor->producto->genero->nombre}}</td>
                        <td class="text-center">{{$kardexColor->producto->tipo->nombre}}</td>
                        <td class="text-center">{{$kardexColor->producto->material->nombre}}</td>
                        <td class="text-center">{{$kardexColor->producto->codigo}}</td>
                        <td class="text-center">{{$kardexColor->producto->nombre}}</td>
                        <td class="text-center">{{$kardexColor->producto->codigoProveedor}}</td>
                        <td class="text-center">{{$kardexColor->color->nombre}}</td>
                        <td class="inline-block">

                            <a class="btn btn-primary btn-sm col-12 mb-1 text-white select">Ver</button>
                                <a href="{{route('admin.kardexes.editDetails',['producto'=>$kardexColor->producto->id,'color'=>$kardexColor->color->id])}}"
                                    class="btn btn-primary btn-sm mb-1 col-lg-12">Movimiento Stock</a>


                        </td>

                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
</div>
</div>
<div class="card">
    <div class="card-body">

        <div class="row">
            <div class="col-lg-6"></div>
            <div class="col-lg-6">
                <div class="form-group ">
                    {!! Form::label('Codigo','Codigo')!!}
                    {!! Form::text('idKardex',null,['class'=> 'form-control text-uppercase col-lg-12
                    text-center','disabled','id'=>'idKardex','hidden'])!!}
                    {!! Form::text('Codigo',null,['class'=> 'form-control text-uppercase col-lg-12
                    text-center','disabled','id'=>'txtCodigo'])!!}
                </div>
                <div class="form-group">
                    {!! Form::label('nombre','Producto')!!}

                    {!! Form::text('nombre',null,['class'=> 'form-control text-uppercase col-lg-12
                    text-center','disabled','id'=>'txtNombre'])!!}
                </div>
                <div class="form-group">
                    {!! Form::label('codProdProv','Cod. Prod. Proveedor')!!}

                    {!! Form::text('codProdProv',null,['class'=> 'form-control text-uppercase col-lg-12
                    text-center','disabled','id'=>'txtCodProdProv'])!!}
                </div>
                <div class="form-group">
                    {!! Form::label('color','Color')!!}

                    {!! Form::text('color',null,['class'=> 'form-control text-uppercase
                    text-center','disabled','id'=>'txtColor'])!!}
                </div>
            </div>
        </div>
        <hr>


    </div>
</div>

<div class="card">
    <div class="card-body">

        <table class="table table-striped " id="tblKardexesColorsTallas">
            <thead>
                <tr>
                    <th class="text-center" data-priority='1'>Cod. Producto</th>
                    <th class="text-center">Producto</th>
                    <th class="text-center">Cod. Prod. Proveedor</th>
                    <th class="text-center">Color</th>
                    <th class="text-center">Talla</th>
                    <th class="text-center" data-priority='1'>Stock Fisico</th>
                    <th class="text-center" data-priority='1'>Stock Disponible</th>

                </tr>
            </thead>
            <tbody>

            </tbody>

        </table>

    </div>
</div>

{!! Form::close()!!}
@stop


@section('js')
<script>
    let productos=[];
    let kardexColors=[];
    let kardexColorsTallas=[];
    $(document).ready( function () {
        @if (session('info'))
            Swal.fire(
                {icon: 'success',
                title: '{{session('info')}}',
                showConfirmButton: true,
                timer: 3000
            });
        @endif    

        kardexColors=(<?php echo json_encode($kardexColors) ?>);
        kardexColorsTallas=(<?php echo json_encode($kardexColorTalla) ?>);
        /* let almacenKardexes=kardexes.filter(function(kardex){
            return kardex.warehouse_id=$("#warehouse_id").val();
        }) */
        $("#txtCodigo").val(kardexColors[0].producto.codigo)
        $("#txtNombre").val(kardexColors[0].producto.nombre)
        $("#txtCodProdProv").val(kardexColors[0].producto.codigoProveedor)
        $("#txtColor").val(kardexColors[0].color.nombre)
        $("#idKardex").val(kardexColors[0].id)
        
        let listaKardexColorTallas=kardexColorsTallas.filter(function(kardex){
            return kardex.producto_id==kardexColors[0].producto.id
                && kardex.color.id==kardexColors[0].color.id;
        })
        
        /* listarTablaKardexes(almacenKardexes); */
        listarTablaKardexColorTallas(listaKardexColorTallas)    ;
    } );

    
    $('#tblKardexes').DataTable({
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
        "pageLength": 1,
        "paging": true, 
        "bInfo": false,
            
        "columns": [
            { width: "7%"},
            { width: "7%"},
            { width: "7%"},
            { width: "7%"},
            { width: "10%"},
            { width: "30%"},
            { width: "30%"},
            { width: "7%"},
            { width: "10%"},
        ],
        createdRow: function (row, data, indice) {
            $(row).find("td:eq(0)").attr('data-id', data.id);
            $(row).find("td:eq(0)").attr('data-index', indice);
        }
    });

    $('#tblKardexes').on("click", ".select", function () {
        fn_seleccionarKardex(this);
    });

    function fn_seleccionarKardex(elem){
        let par = $(elem).parent().parent();
        let tdbuttons = par.children("td:nth-child(1)");
        let kardex_id = tdbuttons.attr('data-id') === undefined ? 0 : tdbuttons.attr('data-id');
        let productoCodigo = par.children("td:nth-child(5)").html();
        let productoColor = par.children("td:nth-child(8)").html();

        

        let tempKardex = kardexColors.filter(function(kardex){
            return kardex.producto.codigo==productoCodigo && kardex.color.nombre==productoColor;
        })

        $("#txtCodigo").val(tempKardex[0].producto.codigo)
        $("#txtNombre").val(tempKardex[0].producto.nombre)
        $("#txtCodProdProv").val(tempKardex[0].producto.codigoProveedor)
        $("#txtColor").val(tempKardex[0].color.nombre)
        $("#idKardex").val(tempKardex[0].id)
        
        let listaKardexColorTallas=kardexColorsTallas.filter(function(kardex){
            return kardex.producto_id==tempKardex[0].producto.id
                && kardex.color.id==tempKardex[0].color.id;
        })
        
        /* listarTablaKardexes(almacenKardexes); */
        listarTablaKardexColorTallas(listaKardexColorTallas)    ;
    } 
    
    function listarTablaKardexColorTallas(listaKardexesColorsTallas){
        $('#tblKardexesColorsTallas').DataTable({
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
            "pageLength": 10,
            ordering: false,
            data: listaKardexesColorsTallas,
            "columns": [
                { data: 'producto.codigo', width: "15%","class":"text-center"},
                { data: 'producto.nombre',width: "35%","class":"text-center"},
                { data: 'producto.codigoProveedor',width: "15%","class":"text-center"},
                { data: 'color.nombre',width: "15%","class":"text-center"},
                { data: 'talla.nombre',width: "15%","class":"text-center"},
                { data: 'stockFisico',width: "15%","class":"text-center"},
                { data: 'stockDisponible',width: "15%","class":"text-center"}
            ],
            createdRow: function (row, data, indice) {
                $(row).find("td:eq(0)").attr('data-id', data.id);
                $(row).find("td:eq(0)").attr('data-index', indice);
            }
        });
    }

</script>

@endsection