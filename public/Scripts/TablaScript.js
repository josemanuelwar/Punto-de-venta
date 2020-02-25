$(document).ready(function () {
    $(".botonEditar").click(function () {
        var valor = "";
        $(this).parents("tr").find("#idUsuario").each(function () {
            valor = $(this).html();
        });

        valor = valor.replace(/ /g, "");
        //alert(valor);

        var urlEditar = '/Coordinador/EditarUsuario/' + valor;
        location.href = urlEditar; 
    });

    $(".botonEliminar").click(function () {
        
        var opcion = confirm("¿RESTRINGIR/PERMITIR ACCESO A ESTE USUARIO?");

        if (opcion) {
            var valor = "";
            $(this).parents("tr").find("#idUsuario").each(function () {
                valor = $(this).text();
            });

            valor = valor.trim();

           alert(valor);

            $.ajax({
                url: '/Coordinador/Acceso',
                data: { idUsuario: valor },
                type: 'POST',
                success: function (html) {
                    alert(html);
                    location.reload();
                }

            });
        } else {
            location.reload();
        }

    });

});
