@extends('adminlte::page')
@section('head')


@endsection
@section('title', 'MyZore')

@section('content_header')
<h1>Crear nuevo producto</h1>
@stop

@section('content')
{!! Form::open(['route'=>'admin.productos.store', 'autocomplete'=>'off','files'=> true,'id'=>'fromCrearProducto'])!!}

<div class="row">
    <div class="card col-lg-9">
        <h5 class="card-header">Datos producto</h5>
        <div class="card-body">

            <div class="row">
                <div class="form-group col-lg-12">
                    {!! Form::label('nombre','Nombre')!!}
                    {!! Form::text('nombre',null,['class'=> 'form-control text-uppercase
                    col-lg-12','placeholder'=>'Ingrese el nombre del producto','autocomplete'=>'off'])!!}
                    @error('nombre')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="form-group col-lg-6">

                    {!! Form::label('linea_id','Línea')!!}

                    {!! Form::select('linea_id',$lineas,null,['class'=> 'form-control'])!!}
                </div>
                <div class="form-group col-lg-6">

                    {!! Form::label('tipo_id','Tipo')!!}

                    {!! Form::select('tipo_id',$tipos,null,['class'=> 'form-control'])!!}
                </div>


            </div>

            <div class="row">
                <div class="form-group col-lg-6">
                    {!! Form::label('genero_id','Género')!!}

                    {!! Form::select('genero_id',$generos,null,['class'=> 'form-control'])!!}
                </div>


                <div class="form-group col-lg-6">
                    {!! Form::label('material_id','Material')!!}

                    {!! Form::select('material_id',$materiales,null,['class'=> 'form-control'])!!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('descripcion','Descripción')!!}
                {!! Form::textarea('descripcion',null,['class'=> 'form-control text-uppercase','placeholder'=>'Ingrese una descripción','rows'=>'5','style'=>'resize:none;'])!!}

                @error('descripcion')
                <span class="text-danger">{{$message}}</span>
                @enderror

            </div>
            <hr>
            <div class="row col-lg-12">
                <div class="form-group col-lg-12">
                    {!! Form::text('productoProviders',null, ['class' => 'btn btn-primary float-right
                    mb-2','id'=>'productoProviders','hidden'])!!}
                    {!! Form::button('Asignar proveedor', ['class' => 'btn btn-primary float-right
                    mb-2','data-toggle'=>'modal','data-target'=>'#modalProveedor','id'=>'btnModalProv'])!!}

                    <div class="modal fade" id="modalProveedor" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Asignar proveedor</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row rowModalProviderTable">
                                        <table class="table table-striped " id="tblProviders">
                                            <thead>
                                                <th class="text-center" data-priority='1'>RUC</th>
                                                <th class="text-center" data-priority='1'>Razon Social</th>
                                                <th data-priority='1'></th>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                    <hr />
                                    <div class="row">
                                        <div class="form-group col-lg-4">

                                            {!! Form::label('modalProvRuc','RUC')!!}

                                            {!! Form::text('modalProvRuc',null,['class'=> 'form-control text-uppercase
                                            col-lg-12','placeholder'=>'Selecciones un
                                            proveedor','autocomplete'=>'off','readonly'])!!}
                                        </div>
                                        <div class="form-group col-lg-8">

                                            {!! Form::label('modalProvRazonSocial','Razon Social')!!}

                                            {!! Form::text('modalProvRazonSocial',null,['class'=> 'form-control
                                            text-uppercase col-lg-12','placeholder'=>'Selecciones un
                                            proveedor','autocomplete'=>'off','readonly'])!!}
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-lg-4">

                                            {!! Form::label('modalProvProdPrec','Precio')!!}

                                            {!! Form::text('modalProvProdPrec','0.00',['class'=> 'form-control
                                            text-uppercase col-lg-12','autocomplete'=>'off', 'autocomplete'=>'off',
                                            'onkeypress'=>'return numeroDosDecimales(event,
                                            this);','onblur'=>'format(this);'])!!}
                                        </div>
                                        <div class="form-group col-lg-8">

                                            {!! Form::label('modalProvProdCod','Codigo Producto')!!}

                                            {!! Form::text('modalProvProdCod',null,['class'=> 'form-control
                                            text-uppercase col-lg-12','placeholder'=>'Codigo del proveedor para el
                                            producto','autocomplete'=>'off'])!!}
                                        </div>

                                    </div>


                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">cerrar</button>
                                    <button type="button" class="btn btn-primary" id="btnModalEditarProv">Editar asignación</button>
                                    <button type="button" class="btn btn-primary" id="btnModalAgregarProv">Agregar asignación</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row col-lg-12">
                <div class="form-group col-lg-12">
                    <table class="table table-striped " id="tblProductoProviders">
                        <thead>
                            <th class="text-center" data-priority='1'>RUC</th>
                            <th class="text-center">Razon Social</th>
                            <th class="text-center">Codigo Producto</th>
                            <th class="text-center">Precio</th>
                            <th data-priority='1'></th>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="form-group">

            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card">
            <h5 class="card-header">Tallas</h5>
            <div class="card-body">
                @foreach ($tallas as $talla)
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            {!! Form::checkbox('tallas[]', $talla->id, null, ['class'=> 'checkTallas']) !!}
                        </div>
                    </div>
                    <input type="text" class="form-control" aria-label="Text input with checkbox"
                        value={{$talla->nombre}}>
                </div>

                @endforeach
            </div>
        </div>

        
    </div>
</div>

<div class="card">
    <h5 class="card-header">Colores</h5>
    <div class="card-body" id="cardColors">
        
    </div>
</div>



<div class="card col-lg-12">
    <div class="card-body">
        <div class="form-group">
            {!! Form::button('Crear producto', ['class' => 'btn btn-primary
            float-right','id'=>'btnRegistrarProducto'])!!}
        </div>
    </div>

</div>

{!! Form::close()!!}

@stop

@section('js')
<script>

    let productoProviders=[];
    let provider=new Object();
    let providers=[];
    let prov_index;
    let colors=[];


    $(function() {
        
        providers=(<?php echo json_encode($providers) ?>);
        colors=(<?php echo json_encode($colors) ?>);
        listarTablaProviders(providers)
        listarColors();


    });

    
    $('#material_id').select2();
    $('#tipo_id').select2();

    
   
   

    function listarColors(){
        colors.forEach(color => {
            let rowColor = document.createElement("div");
            rowColor.className ="row";

            let divColor = document.createElement("div");
            divColor.className ="col-12";
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
            inputCheck.setAttribute("data-rowImageColor","rowImageColor-"+color.id);
            inputCheck.setAttribute("value",color.id);

            divInput.appendChild(inputCheck);
            divPrepend.appendChild(divInput);
            div.appendChild(divPrepend);
            div.appendChild(inputTex);
            divColor.appendChild(div);
            rowColor.appendChild(divColor);

            document.getElementById('cardColors').appendChild(rowColor);

            let rowImage = document.createElement("div");
            rowImage.className ="row";
            rowImage.setAttribute("id","rowImageColor-"+color.id);
            rowImage.setAttribute("hidden","true");
            for(i=1;i<=4;i++){
                
                let txtTipo="Borrador";

                if(i>1){
                    txtTipo="Catalogo";
                }

                let formGroup1 = document.createElement("div");
                formGroup1.className ="form-group col-lg-3 col-md-6";

                let divImage = document.createElement("div");
                divImage.setAttribute("id","divImage-"+color.id+"-"+i);

                let inputFile1 = document.createElement("input");
                inputFile1.setAttribute("type","file");
                inputFile1.setAttribute("class","fileImage");
                inputFile1.setAttribute("name","image-"+color.id+"-"+i);
                inputFile1.setAttribute("data-id","divImage-"+color.id+"-"+i);
                inputFile1.setAttribute("id","inputImage-"+color.id+"-"+i);
                inputFile1.setAttribute("accept","image/jpeg");
                inputFile1.setAttribute("hidden",true);
                inputFile1.setAttribute("id","inputImage-"+color.id+"-"+i);
                

                let buttonFile = document.createElement("a");
                buttonFile.setAttribute("class","btn btn-primary col-md-12 btnImage text-white")
                buttonFile.setAttribute("data-id","inputImage-"+color.id+"-"+i);
                buttonFile.setAttribute("name","image-"+color.id+"-"+"-"+i);
                buttonFile.innerText = "Imagen "+txtTipo;
                
                //buttonFile.setAttribute("onclick", "document.getElementById('inputImage"+i+"-"+color.id+"').click()" );
                
                
                formGroup1.appendChild(inputFile1);
                formGroup1.appendChild(buttonFile);
                formGroup1.appendChild(divImage);

                rowImage.appendChild(formGroup1);
            }
            document.getElementById('cardColors').appendChild(rowImage);

            
            
        })

        $(".btnImage").click(function(e){
            let inputFile = $(this).attr("data-id");
            $('#'+inputFile).trigger('click'); 
        })

        $(".fileImage").change(function(e){
            let divImage = $(this).attr("data-id");
            let id = $(this).attr("id");
            vistaPrevia(this,id,divImage)
        })

        function vistaPrevia(input,id,divPreview){
            let filePath = input.value;
            var allowedExtensions = /(.jpg|.jpeg)$/i;
            if(!allowedExtensions.exec(filePath)){
                toastr["error"]("Solo se permites archivos con la extension .jpeg/.jpg .", "IMAGEN")

                input.value = '';
                return false;
            }else{
              
                if(input.files && input.files[0]){
                    
                    let reader = new FileReader();
                    
                    reader.onload= function(e){
                        
                        $("#"+divPreview).html("<img src='"+e.target.result+"'  style='max-width:100%; height:100%; max-height: 200px; margin-left: auto; margin-right: auto; display: block;'/> <a class='btn btn-danger col-md-12 btnDeleteImage text-white' data-div='"+divPreview+"' data-input='"+id+"'>Eliminar</a>");
                        $(".btnDeleteImage").click(function() {
                            let divImage = $(this).attr("data-div");
                            let inputImage = $(this).attr("data-input");
                            $("#"+divImage).html("")
                            $("#"+inputImage).val("");
                            
                        });
                        
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
        }    

        $(".checkColor").change(function() {
            let rowImage = $(this).attr("data-rowImageColor");
            if(this.checked){
                $("#"+rowImage).removeAttr('hidden');
            }else{
                $("#"+rowImage).prop('hidden','true')
            }
        });     
    }



    $("#linea_id").change(function (){
        let linea_id = $(this).val();
        
        $.get('/admin/lineas/'+linea_id+'/tipos',function(data){
            let html_materiales = '';
            let html_tipos = '';
            let materiales = data.materiales;
            let tipos = data.tipos;
            for (let i=0; i<materiales.length;++i){
                html_materiales +='<option value="'+materiales[i].id+'">'+materiales[i].nombre+'</option>';
            }
            $('#material_id').html(html_materiales);

            for (let i=0; i<tipos.length;++i){
                html_tipos +='<option value="'+tipos[i].id+'">'+tipos[i].nombre+'</option>';
            }
            $('#tipo_id').html(html_tipos);
        })
    })

    $("#btnModalProv").click(function(){
       
        
        provider = new Object();
        $("#modalProvRuc").val('');
        $("#modalProvRazonSocial").val('');
        $("#modalProvProdCod").val('');
        $("#modalProvProdPrec").val('0.00');
        $(".rowModalProviderTable").css('display','block');

        $("#btnModalEditarProv").css('display','none');
        $("#btnModalAgregarProv").css('display','block');
    })

    function listarTablaProviders(listProviders){
        $('#tblProviders').DataTable({
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
            "pageLength": 1,
            ordering: false,
            data: listProviders,
            "columns": [
                { data: 'personajuridica.persona.nroDocumento', width: "15%","class":"text-center"},
                { data: 'personajuridica.razonSocial',width: "25%","class":"text-center"},
                { data: function(){
                    return '<a class="btn btn-primary text-white btn-sm mb-1 col-12 add_provider">Seleccionar</a>';

                },width: "10%"},
            ],

            createdRow: function (row, data, indice) {
                $(row).find("td:eq(0)").attr('data-id', data.id);
                $(row).find("td:eq(0)").attr('data-index', indice);
            }
            
        })

    }

    $('#tblProviders').on("click", ".add_provider", function () {
        fn_addProvider(this);
    });

    function fn_addProvider(elem){
        let par = $(elem).parent().parent();
        let tdbuttons = par.children("td:nth-child(1)");
        let prov_id = tdbuttons.attr('data-id') === undefined ? 0 : tdbuttons.attr('data-id');
        prov_index = tdbuttons.attr('data-index') === undefined ? 0 : tdbuttons.attr('data-index');
        let prov_ruc = par.children("td:nth-child(1)").html();
        let prov_rs = par.children("td:nth-child(2)").html();

        
        provider.id=prov_id;
        provider.ruc=prov_ruc;
        provider.nombre=prov_rs;
        
        $("#modalProvRuc").val(prov_ruc);
        $("#modalProvRazonSocial").val(prov_rs);
        $("#modalProvProdCod").val('');            
    }

    function listarTablaProductoProviders(listProviders){
        $('#tblProductoProviders').DataTable({
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
            data: listProviders,
            "columns": [
                { data: 'ruc', width: "10%","class":"text-center"},
                { data: 'nombre',width: "40%","class":"text-center"},
                { data: 'codigoProducto',width: "20%","class":"text-center"},
                { data: 'precio',width: "20%","class":"text-center"},
                { data: function(){
                    return '<a class="btn btn-primary text-white btn-sm mb-1 col-12 edit_provider">Editar</a> <a class="btn btn-danger text-white btn-sm mb-1 col-12 remove_provider">Eliminar</a>';

                },width: "10%"},
            ],

            createdRow: function (row, data, indice) {
                $(row).find("td:eq(0)").attr('data-id', data.id);
                $(row).find("td:eq(0)").attr('data-index', indice);
            }
            
        })

    }

    $('#tblProductoProviders').on("click", ".edit_provider", function () {
        fn_editProvider(this);
    });

    $('#tblProductoProviders').on("click", ".remove_provider", function () {
        fn_removeProvider(this);
    });

    function fn_editProvider(elem){
        let par = $(elem).parent().parent();
        let tdbuttons = par.children("td:nth-child(1)");
        let prov_id = tdbuttons.attr('data-id') === undefined ? 0 : tdbuttons.attr('data-id');
        prov_index = tdbuttons.attr('data-index') === undefined ? 0 : tdbuttons.attr('data-index');
        let prov_ruc = par.children("td:nth-child(1)").html();
        let prov_rs = par.children("td:nth-child(2)").html();
        let prov_codProd = par.children("td:nth-child(3)").html();
        let prov_precio = par.children("td:nth-child(4)").html();

        
        provider.id=prov_id;
        provider.ruc=prov_ruc;
        provider.nombre=prov_rs;
        provider.codProd=prov_codProd;
        provider.precio=prov_precio;
        
        $("#modalProvRuc").val(provider.ruc);
        $("#modalProvRazonSocial").val(provider.nombre);
        $("#modalProvProdCod").val(provider.codProd);     
        $("#modalProvProdPrec").val(provider.precio);   
        $(".rowModalProviderTable").css('display','none');

        $("#btnModalEditarProv").css('display','block');
        $("#btnModalAgregarProv").css('display','none');

        $("#modalProveedor").modal('show');       
    }

    function fn_removeProvider(elem){
        let par = $(elem).parent().parent();
        let tdbuttons = par.children("td:nth-child(1)");
        let prov_id = tdbuttons.attr('data-id') === undefined ? 0 : tdbuttons.attr('data-id');
        prov_index = tdbuttons.attr('data-index') === undefined ? 0 : tdbuttons.attr('data-index');
        let prov_ruc = par.children("td:nth-child(1)").html();
        let prov_rs = par.children("td:nth-child(2)").html();
        
        provider.id=prov_id;
        let persona=new Object();
        persona.nroDocumento=prov_ruc;
        
        let personajuridica=new Object();
        personajuridica.persona=persona
        personajuridica.razonSocial=prov_rs;

        provider.personajuridica=personajuridica;
       

        providers.push(provider);
        $("#productoProviders").val(JSON.stringify(productoProviders));

        productoProviders.splice(prov_index, 1);
        listarTablaProviders(providers);
        listarTablaProductoProviders(productoProviders);
    }

    

    $("#btnModalAgregarProv").click(function(){

        
        provider.precio=$("#modalProvProdPrec").val();
        provider.codigoProducto=$("#modalProvProdCod").val();
        providers.splice(prov_index, 1);

        productoProviders.push(provider);

        listarTablaProviders(providers);
        listarTablaProductoProviders(productoProviders);
        $("#productoProviders").val(JSON.stringify(productoProviders));

        $("#modalProveedor").modal('hide');

    })

    $("#btnModalEditarProv").click(function(){

        provider.precio=$("#modalProvProdPrec").val();
        provider.codigoProducto=$("#modalProvProdCod").val();
        productoProviders.splice(prov_index, 1,provider);
        
        
        listarTablaProductoProviders(productoProviders);
        $("#productoProviders").val(JSON.stringify(productoProviders));

        $("#modalProveedor").modal('hide');
        
    })

    

    $("#btnRegistrarProducto").click(function(){
        let checkColors=0;
        let checkTallas=0;
        $('.checkColor:checked').each(
            function() {
                checkColors=1;
            }
        );

        $('.checkTallas:checked').each(
            function() {
                checkTallas=1;
            }
        );

        

        if(productoProviders.length==0){
            toastr["error"]("Asigne al menos un proveedor", "PROVEEDOR")
        }else if(checkColors==0){
            toastr["error"]("Elija al menos un color", "COLORES")
        }else if(checkTallas==0){
            toastr["error"]("Elija al menos una talla", "TALLAS")
        }else{
            $("#fromCrearProducto").submit();
        }
        
        
    })

    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-full-width",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
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