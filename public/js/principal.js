
$("input[name='RFC']").focusout(function () {
    if ($('#RFC').val() != '') {
        $('#cargando').html('<div class="loading"><img src="../img/loader.gif" alt="loading" /><br/>Un momento, por favor...</div>');
//    var confirmacion = confirm("Deseas realizar una busqueda del RFC: " + $('#RFC').val());
//    if (confirmacion == true) {
        $.ajax({
            type: "POST",
            url: "buscarfc/" + $('#RFC').val(),
            success: function (data) {
                $('#message-text').html('<div class="alert alert-info alert-block"> <a class="close" data-dismiss="alert" href="#">×</a><h4 class="alert-heading">Busqueda de RFC!:</h4>' + data + '</div>');
                $('#cargando').html('');
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
//                alert("Status: " + textStatus);
//                alert("Error: " + errorThrown);
                $('#message-text').html('<div class="alert alert-info alert-block"> <a class="close" data-dismiss="alert" href="#">×</a><h4 class="alert-heading">Busqueda de RFC!:</h4>No tubimos resultados... </div>');
                $('#cargando').html('');
            }
        });
    }
//    } else {
//       $('#cargando').html('');
//    }
});


$("#vehiculos_idvehiculos").change(function () {
     $('#cargando').html('<div class="loading"><img src="../img/loader.gif" alt="loading" /><br/>Un momento, por favor...</div>');
   
    $.ajax({
        type: "POST",
        url: "obtenercarro/" + $('#vehiculos_idvehiculos').val(),
        success: function (data) {
            $('#message-text').html('<div class="alert alert-info alert-block"> <a class="close" data-dismiss="alert" href="#">×</a><h4 class="alert-heading">Busqueda de datos del Carro!:</h4>' + data + '</div>');
            $('#cargando').html('');
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
//                alert("Status: " + textStatus);
//                alert("Error: " + errorThrown);
            $('#message-text').html('<div class="alert alert-info alert-block"> <a class="close" data-dismiss="alert" href="#">×</a><h4 class="alert-heading">Busqueda de datos del Carro!:</h4>No tubimos resultados... </div>');
            $('#cargando').html('');
        }
    });
});

//buscar productos 
$("#productos_idproductos").change(function () {
     $('#cargando').html('<div class="loading"><img src="../img/loader.gif" alt="loading" /><br/>Un momento, por favor...</div>');
   
    $.ajax({
        type: "POST",
        url: "../buscarproducto/" + $('#productos_idproductos').val(),
        success: function (data) {
            $('#message-text').html('<div class="alert alert-success"> <a class="close" data-dismiss="alert" href="#">×</a><h4 class="alert-heading">Busqueda del Producto!:</h4>' + data + '</div>');
            $('#cargando').html('');
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
//                alert("Status: " + textStatus);
//                alert("Error: " + errorThrown);
            $('#message-text').html('<div class="alert alert-info alert-block"> <a class="close" data-dismiss="alert" href="#">×</a><h4 class="alert-heading">Busqueda de datos del Producto!:</h4>No tubimos resultados... </div>');
            $('#cargando').html('');
        }
    });
});

$('#labNumServicio').html('');
$('#inputNumServicio').hide();
$("select[name='servicioMedico']").change(function () {
    if ($('select[name=servicioMedico]').val() == 'Si') {
        $('#labNumServicio').html('<div id="labNumServicio">Num. de servicio</div>');
        $('#inputNumServicio').show();
    }
    else
    {
        $('#labNumServicio').html('');
        $('#inputNumServicio').hide();
    }

});
$('#labNumServicio').html('');
$('#inputOtros').hide();
$("button[name='otros']").click(function () {
    if ($("button[name='otros']").val() == 'otros') {
        $('#inputOtros').show();
    } else {
        $('#inputOtros').hide();
    }
});
$("button[name='centroRedaptacion']").click(function () {
    $('#inputOtros').hide();
});



