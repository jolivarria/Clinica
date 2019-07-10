

$("input[name='RFC']").focusout(function () {
    $('#cargando').html('<div class="loading"><img src="../img/loader.gif" alt="loading" /><br/>Un momento, por favor...</div>');
//    var confirmacion = confirm("Deseas realizar una busqueda del RFC: " + $('#RFC').val());
//    if (confirmacion == true) {
        $.ajax({
            type: "POST",
            url: "buscarfc/" + $('#RFC').val(),
            success: function (data) {
                $('#message-text').html('<div class="alert alert-info alert-block"> <a class="close" data-dismiss="alert" href="#">×</a><h4 class="alert-heading">Busqueda de RFC!:</h4>'+data+'</div>');
                $('#cargando').html('');
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
//                alert("Status: " + textStatus);
//                alert("Error: " + errorThrown);
                $('#message-text').html('<div class="alert alert-info alert-block"> <a class="close" data-dismiss="alert" href="#">×</a><h4 class="alert-heading">Busqueda de RFC!:</h4>No tubimos resultados... </div>');
                $('#cargando').html('');
            }
        });
//    } else {
//       $('#cargando').html('');
//    }




});


