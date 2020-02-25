$(document).ready(function(){
    $("#idTrabajador").blur( getDataFromBanner );
    $("#nombreTrabajador").val( 'sdfsdfsff' );
});


/**
 * Realiza una conexión a WS que contengan datos de banner
 * para poder llenar los campos necesarios en el formulario
 * de registro de usuarios
 */
function getDataFromBanner() {    
    $.ajax({
        url: BPATH + 'Ws/cvu/'+$("#idTrabajador").val(),
        dataType: 'json',
        beforeSend: function() {
            $("#idTrabajador").prop('disabled',true);
        }
    }).done( function(data) {
        $("#idTrabajador").prop('disabled',false);
        console.log(data);
        if ( typeof(data) == 'string' ) {
            alert('ID de Trabajador no encontrado');
        }
        else {
            if ( data.error ) {

            }
            else {
                $("#nombreTrabajador").val( data[0].nombre );
            }
        }
    });
}