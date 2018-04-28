
$(document).ready(function () {

    function ocultar(clase) {
        $("." + clase).hide('fast').find('input,select').removeAttr('required').val('');
        $("#" + clase).hide('fast').find('input,select').removeAttr('required').val('');
    }

    function mostrar(panel) {
        $("#" + panel).show('fast').find('input,select').attr('required', 'required');
    }

    ocultar('camposPersonales');
    ocultar('divDestino');

    $("#ciudadOrigen").change(function () {
        $("#cargando").html("<center><img src='img/spinner1.gif' width='120px'></center>");
        mostrar('divDestino');
    });

    $("#ciudadDestino").change(function () {
        $("#cargando").html("");
        mostrar('camposPersonales');
    });

    $("#agregarTarea").submit(function (e) {
        $("#cargando").html("<center><img src='img/spinner1.gif' width='120px'></center>");
        var url = "ajax/insercion.php";
        $.ajax({
            type: "POST",
            url: url,
            data: $("#agregarTarea").serialize(),
            success: function (registro) {

                if (registro == 1) {
                    $("#cargando").html("<center><div style='margin-top:10px;' class='alert alert-info'>Se ha registrado la tarea con éxito.</div></center>");
                    $("#agregarTarea")[0].reset();
                } else {
                    alert("No se ha podido ingresar el registro");
                }
            }
        });
        e.preventDefault();
    });
});
     