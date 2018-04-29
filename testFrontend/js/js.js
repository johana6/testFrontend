//////FUNCIONES QUE SE EJECUTAN TAN PRONTO EL DOCUMENTO TERMINA DE CARGAR DE FORMA COMPLETA
$(document).ready(function () {


/////////////////AJAX QUE SE EJECUTA PARA CONSULTAS LAS CIUDADES
    var ciudadOrigen = $("#ciudadOrigen");

    $.ajax({
        type: "GET",
        url: "../backEnd/procesos.php?consulta_ciudad",
        success: function (resulta)
        {
            var result = jQuery.parseJSON(resulta);

            var output = "<option>Ciudad de Origen</option>";

            //////UTILIZO EL FOR PARA RECORRER E IMPRIMIR CADA UNA DE LAS CIUDADES DE LA BD
            for (var i in result) {
                output += "<option value='" + result[i].id + "'>" + result[i].nombre + "</option>";

            }

            output += "";

            ///////////IMPRIME LO QUE TRAE EN EL SELECT ESPECIAFICADO  
            ciudadOrigen.html(output);

        }});


    /////////////////AJAX QUE SE EJECUTA PARA CONSULTAS LAS CIUDADES PARA EL FILTRO

    var ciudadOrigenConsulta = $("#ciudadOrigenConsulta");

    $.ajax({
        type: "GET",
        url: "../backEnd/procesos.php?ciudadConsulta",
        success: function (resulta)
        {
            var result = jQuery.parseJSON(resulta);

            var output = "";

            //////UTILIZO EL FOR PARA RECORRER E IMPRIMIR CADA UNA DE LAS CIUDADES DE LA BD

            for (var i in result) {
                output += "<option value='" + result[i].id + "'>" + result[i].nombre + "</option>";

            }

            output += "";

///////////IMPRIME LO QUE TRAE EN EL SELECT ESPECIAFICADO  
            ciudadOrigenConsulta.html(output);
        }});


    function ocultar(clase) {
        $("." + clase).hide('fast').find('input,select').removeAttr('required').val('');
        $("#" + clase).hide('fast').find('input,select').removeAttr('required').val('');
    }

    function mostrar(panel) {
        $("#" + panel).show('fast').find('input,select').attr('required', 'required');
    }

    ocultar('camposPersonales');
    ocultar('divDestino');


    ////////////////FUNCION QUE SE EJECUTA CUANDO EL SELECT CIUDADORIGEN CAMBIA DE OPTION

    $("#ciudadOrigen").change(function () {
        ////////////////GUARDO EL VALOR SELECCIONADO EN UNA VARIABLE PARA REALIZAR UNA NUEVA CONSULTA SIN LA CIUDAD QUE YA SE ENCOGIO ANTERIORMENTE
        var ciudadOrigen = $(this).val();

        var ciudadDestino = $("#ciudadDestino");

        $("#cargando").html("<center><img src='img/spinner1.gif' width='120px'></center>");

        $.ajax({
            type: "GET",
            url: "../backEnd/procesos.php?consulta_ciudad&ciudadOrigen=" + ciudadOrigen,
            success: function (resulta)
            {
                var result = jQuery.parseJSON(resulta);

                var output = "<option>Ciudad de Origen</option>";
                for (var i in result) {
                    output += "<option value='" + result[i].id + "'>" + result[i].nombre + "</option>";
                }
                console.log(result);

                output += "";

                ciudadDestino.html(output);

            }});

        mostrar('divDestino');

    });


    $("#ciudadDestino").change(function () {
        var ciudadDestino = $(this).val();

        $("#cargando").html("");

        mostrar('camposPersonales');

        $("#cargando2").html("<center><img src='img/spinner1.gif' width='120px'></center>");

        $.ajax({
            type: "GET",
            url: "../backEnd/procesos.php?ciudadDDestino=" + ciudadDestino,
            success: function (resulta)
            {
                var result = jQuery.parseJSON(resulta);
                var output = "";

                for (var i in result) {
                    output += "<label><input type='checkbox' id='cbox1' value='" + result[i].id + "'>" + result[i].descripcion + "</label><br>";
                    
                }


                output += "";
                $("#divCheck").html(output);
                $("#cargando2").html("");
            }

        });


    });


///<input type="checkbox" id="cbox1" value="first_checkbox"> Este es mi primer checkbox</label><br>
////////////////FUNCION QUE SE EJECUTA CUANDO EL SELECT CIUDADORIGEN PARA FILTRO

    $("#ciudadOrigenConsulta").change(function () {

        ////////////////GUARDO EL VALOR SELECCIONADO EN UNA VARIABLE PARA REALIZAR UNA NUEVA CONSULTA SIN LA CIUDAD QUE YA SE ENCOGIO ANTERIORMENTE
        var ciudadOrigenConsulta = $(this).val();

        console.log(ciudadOrigenConsulta);

        var ciudadOrigenConsultaDestino = $("#ciudadOrigenConsultaDestino");

        $.ajax({
            type: "GET",
            url: "../backEnd/procesos.php?ciudadConsulta&ciudadOrigenConsulta=" + ciudadOrigenConsulta,
            success: function (resulta)
            {
                var result = jQuery.parseJSON(resulta);

                var output = "";
                for (var i in result) {
                    output += "<option value='" + result[i].id + "'>" + result[i].nombre + "</option>";
                }
                console.log(result);

                output += "";
                ciudadOrigenConsultaDestino.html(output);

            }});

    });

    $("#consultaVuelo").submit(function (e) {

        $("#cargandoVuelos").html("<center><img src='img/spinner1.gif' width='120px'></center>");

        var url = "../backEnd/procesos.php";
        $.ajax({
            type: "POST",
            url: url,
            data: $("#consultaVuelo").serialize(),
            success: function (resulta) {

                var result = jQuery.parseJSON(resulta);

                $("#tabla").html("");

                var output = "";

                for (var i in result) {

                    output += "<tr>"
                            + "<td>" + result[i].ciudadOrigen + "</td>"
                            + "<td>" + result[i].ciudadDestino + "</td>"
                            + "<td>" + result[i].fecha_salida + "</td>"
                            + "<td>" + result[i].duracion + "</td>"
                            + "</tr>";

                }

                output += "";
                $("#cargandoVuelos").html("");
                $("#agragarCampos").html(output);
            }
        });
        e.preventDefault();
    });


    $("#reservaTiquetes").submit(function (e) {

        $("#cargandoVuelos").html("<center><img src='img/spinner1.gif' width='120px'></center>");

        var url = "../backEnd/procesos.php";
        $.ajax({
            type: "POST",
            url: url,
            data: $("#reservaTiquetes").serialize(),
            success: function (resulta) {

                /*var result = jQuery.parseJSON(resulta);
                 
                 $("#tabla").html("");
                 
                 var output = "";
                 
                 for (var i in result) {
                 
                 output += "<tr>"
                 + "<td>" + result[i].ciudadOrigen + "</td>"
                 + "<td>" + result[i].ciudadDestino + "</td>"
                 + "<td>" + result[i].fecha_salida + "</td>"
                 + "<td>" + result[i].duracion + "</td>"
                 + "</tr>";
                 
                 }
                 
                 output += "";
                 $("#cargandoVuelos").html("");
                 $("#agragarCampos").html(output);*/
            }
        });
        e.preventDefault();
    });


});
