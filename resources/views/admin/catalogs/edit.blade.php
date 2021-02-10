@extends('adminlte::page')

@section('title', 'MyZore')

@section('content_header')
<h1>Editar campaña</h1>
@stop

@section('content')

@if (session('info'))
<div class="alert alert-success">
    <strong>{{session('info')}}</strong>
</div>
@endif

{!! Form::model($catalog,['route'=>['admin.catalogs.update',$catalog],'method'=>'put'])!!}
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="form-group col-lg-5">
                {!! Form::label('nombre','Nombre')!!}
                {!! Form::text('nombre',null,['class'=> 'form-control text-uppercase text-center','readonly'])!!}
            </div>
            <div class="form-group col-lg-2">
                {!! Form::label('fechaInicio','Fecha inicio')!!}
                {!! Form::text('fechaInicio',null,['class'=> 'form-control text-uppercase text-center','readonly'])!!}
            </div>
            <div class="form-group col-lg-2">
                {!! Form::label('fechaFin','Fecha fin')!!}
                {!! Form::text('fechaFin',null,['class'=> 'form-control text-uppercase text-center','readonly'])!!}
            </div>
            <div class="form-group col-lg-3">
                {!! Form::label('type','Tipo campaña')!!}
                {!! Form::text('type',$catalog->type->nombre,['class'=> 'form-control text-uppercase
                text-center','readonly'])!!}
            </div>

        </div>


    </div>
</div>
<div class="card">
    <div class="card-header">

        <div class="form-group col-lg-12">
            {!! Form::button('Agregar producto', ['class' => 'btn btn-primary float-right col-md-3 col-lg-2','data-toggle'=>'modal','data-target'=>'#modalProducts','id'=>'btnModalProducts']) !!}
        </div>
        {!! Form::model($catalog,['route'=>['admin.catalogs.update',$catalog],'method'=>'put'])!!}
        <div class="modal fade" id="modalProducts" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Agregar productos</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        
                        <table class="table table-striped " id="tblModalProducts">
                            <thead>
                                <tr>
                                    <th class="text-center" data-priority='1'>Código</th>
                                    <th class="text-center" data-priority='2'>Nombre</th>
                                    <th class="text-center" data-priority='3'>Código Proveedor</th>
                                    <th data-priority='1'></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td class="text-center" data-id={{$product->id}} data-colors={{$product->colors}} data-tallas={{$product->tallas}}>{{$product->codigo}}</td>
                                        <td class="text-center">{{$product->nombre}}</td>
                                        <td class="text-center">{{$product->codigoProveedor}}</td>
                                        <td class="inline-block">
                                            <a class="btn btn-primary btn-sm mb-1 col-12 text-white select">Seleccionar</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                            
                        <hr />
                        <div class="row">
                            <div class="form-group col-lg-2">
                                {!! Form::label('codigo','Código')!!}
                                {!! Form::text('id',null,['class'=> 'form-control text-uppercase','placeholder'=>'Seleccione producto','autocomplete'=>'off','readonly','id'=>'txtModalId','hidden'])!!}
                                {!! Form::text('codigo',null,['class'=> 'form-control text-uppercase','placeholder'=>'Seleccione producto','autocomplete'=>'off','readonly','id'=>'txtModalCodigo'])!!}
                            </div>
                            <div class="form-group col-lg-5">
                                {!! Form::label('nombreProducto','Nombre')!!}
                                {!! Form::text('nombreProducto',null,['class'=> 'form-control text-uppercase','placeholder'=>'Seleccione producto','autocomplete'=>'off','readonly','id'=>'txtModalNombre'])!!}
                            </div>
                            <div class="form-group col-lg-3">
                                {!! Form::label('codigoProveedor','Código Proveedor')!!}
                                {!! Form::text('codigoProveedor',null,['class'=> 'form-control text-uppercase','placeholder'=>'','autocomplete'=>'off','readonly','id'=>'txtModalCodProve'])!!}
                            </div>
                            <div class="form-group col-lg-2">
                                {!! Form::label('modalProvProdPrec','Precio venta')!!}
                                {!! Form::text('modalProvProdPrec','0.00',['class'=> 'form-control
                                text-uppercase col-lg-12 text-center','autocomplete'=>'off', 'autocomplete'=>'off',
                                'onkeypress'=>'return numeroDosDecimales(event,
                                this);','onblur'=>'format(this);'])!!}
                            </div>
                           
                        </div>
                        <hr/>
                        
                        <div id="rowColors">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary" id="btnModalAgregarProv">Agregar producto</button>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close()!!}

    </div>
    <div class="card-body">
        <table class="table table-striped" id="tblProducts">
            <thead>
                <tr>
                    <th class="text-center">linea</th>
                    <th class="text-center">Género</th>
                    <th class="text-center">Material</th>
                    <th class="text-center">Tipo</th>
                    <th class="text-center" data-priority='1'>Código</th>
                    <th class="text-center" data-priority='3'>Nombre</th>
                    <th class="text-center" data-priority='3'>Código proveedor</th>
                    <th class="text-center" data-priority='2'>Precio venta</th>
                    <th data-priority='1'></th>
                </tr>
            </thead>
            <tbody>
                
                @foreach ($productsCatalog as $product)
                    <tr> 
                        <td class="text-center">{{$product->linea->nombre}}</td>
                        <td class="text-center">{{$product->genero->nombre}}</td>
                        <td class="text-center">{{$product->material->nombre}}</td>
                        <td class="text-center">{{$product->tipo->nombre}}</td>
                        <td class="text-center">{{$product->codigo}}</td>
                        <td class="text-center">{{$product->nombre}}</td>
                        <td class="text-center">{{$product->codigoProveedor}}</td>
                        <td class="text-center">{{$product->precioventa}}</td>
                        <td class="inline-block">
                            <a class="btn btn-primary btn-sm mb-1 col-12 text-white select">Seleccionar</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
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
} );

$('#tblProducts').DataTable({
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
        { width: "10%"},
        { width: "20%"},
        { width: "10%"},
        { width: "10%"},
        { width: "10%"}
    ]
    
});

$('#tblModalProducts').DataTable({
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
    "pageLength": 1,
    "columns": [
        { width: "20%"},
        { width: "50%"},
        { width: "20%"},
        { width: "10%"},
    ]
});

$('#tblModalProducts').on("click", ".select", function () {
    fn_SelectProducto(this);
});

function fn_SelectProducto(elem){
    let par = $(elem).parent().parent();
    let tdbuttons = par.children("td:nth-child(1)");
    let prodId = tdbuttons.attr('data-id') === undefined ? 0 : tdbuttons.attr('data-id');
    let colors = JSON.parse(tdbuttons.attr('data-colors') === undefined ? 0 : tdbuttons.attr('data-colors'));
    let tallas = JSON.parse(tdbuttons.attr('data-tallas') === undefined ? 0 : tdbuttons.attr('data-tallas'));
    let productoNombre = par.children("td:nth-child(2)").html();
    let productoCodigo = par.children("td:nth-child(1)").html();
    let productoCodProveedor = par.children("td:nth-child(3)").html();
    
    $("#txtModalId").val(prodId);
    $("#txtModalCodigo").val(productoCodigo);
    $("#txtModalNombre").val(productoNombre);
    $("#txtModalCodProve").val(productoCodProveedor);
    
    var list = document.getElementById("rowColors");

    // As long as <ul> has a child node, remove it
    while (list.hasChildNodes()) {  
    list.removeChild(list.firstChild);
    }
    

    colors.forEach(color => {
        let rowColor = document.createElement("div");
        rowColor.className ="row";

        let divColor = document.createElement("div");
        divColor.className ="col-6";

        let div = document.createElement("div");
        div.className ="input-group mb-3";

        let inputTex = document.createElement("input");
        inputTex.className ="form-control";
        inputTex.setAttribute("readonly",true);
        inputTex.setAttribute("type","text");
        inputTex.setAttribute("value",color.nombre);

        let divPrepend = document.createElement("div");
        divPrepend.className ="input-group-prepend";

        let divInput = document.createElement("div");
        divInput.className ="input-group-text";

        let inputCheck = document.createElement("input");
        inputCheck.className ="checkColor";
        inputCheck.setAttribute("name","colors[]");
        inputCheck.setAttribute("type","checkbox");
        inputCheck.setAttribute("value",color.id);

        divInput.appendChild(inputCheck);
        divPrepend.appendChild(divInput);
        div.appendChild(divPrepend);
        div.appendChild(inputTex);
        divColor.appendChild(div);
        

        let divTalla = document.createElement("div");
        divTalla.className ="col-6";

        tallas.forEach(talla => {

            let divCheckTalla = document.createElement("div");
            divCheckTalla.className ="input-group mb-3";

            let inputTextTalla = document.createElement("input");
            inputTextTalla.className ="form-control";
            inputTextTalla.setAttribute("type","text");
            inputTextTalla.setAttribute("readonly",true);
            inputTextTalla.setAttribute("value",talla.nombre);

            let divPrependTalla = document.createElement("div");
            divPrependTalla.className ="input-group-prepend";

            let divInputTalla = document.createElement("div");
            divInputTalla.className ="input-group-text";

            let inputCheckTalla = document.createElement("input");
            inputCheckTalla.className ="checkTallas"+color.id;
            inputCheckTalla.setAttribute("name","tallas-"+color.id+"[]");
            inputCheckTalla.setAttribute("type","checkbox");
            inputCheckTalla.setAttribute("value",talla.id);
            inputCheckTalla.setAttribute("disabled","true");

            divInputTalla.appendChild(inputCheckTalla);
            divPrependTalla.appendChild(divInputTalla);
            divCheckTalla.appendChild(divPrependTalla);
            divCheckTalla.appendChild(inputTextTalla);
            divTalla.appendChild(divCheckTalla);

        })

        rowColor.appendChild(divColor);
        rowColor.appendChild(divTalla);
        
        document.getElementById('rowColors').appendChild(rowColor);
        let divHR= document.createElement("hr");
        document.getElementById('rowColors').appendChild(divHR);
    });
    
    $(".checkColor").change(function() {
        if(this.checked){
            
            $(".checkTallas"+$(this).val()).removeAttr('disabled');
            $(".checkTallas"+$(this).val()).prop('checked', true); 
        }else{
            $(".checkTallas"+$(this).val()).prop('checked', false); 
            $(".checkTallas"+$(this).val()).prop('disabled','true')
        }
    });  
}





function numeroDosDecimales(evt, input) {
    // Backspace = 8, Enter = 13, ‘0′ = 48, ‘9′ = 57, ‘.’ = 46, ‘-’ = 43
    var key = window.Event ? evt.which : evt.keyCode;
    var chark = String.fromCharCode(key);
    var tempValue = input.value + chark;
    if (key >= 48 && key <= 57) {

        return true;

    } else {
        if (key == 8 || key == 13 || key == 0) {
            return true;
        } else if (key == 46) {
            if (filter(tempValue) === false) {
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }
}
function filter(__val__) {
    var preg = /^([0-9]+\.?[0-9]{0,2})$/;
    if (preg.test(__val__) === true) {
        return true;
    } else {
        return false;
    }

}

function format(input)
{   

    if(input.value==''){
        var numero = 0;
    }else{
        var numero = input.value;
    }
    
    var num = parseFloat(numero);
    
    input.value = num.toFixed(2);
}
</script>

@endsection