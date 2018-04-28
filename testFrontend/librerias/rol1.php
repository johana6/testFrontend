<?php
if (isset($_SESSION['userMasterClaro']) && $rol == 1) {

    require('../../connections/workforce.php');
    ?>


    <style>
        body {

            padding-left: 0; 
        }
        .navbar {
            border-radius: 0; 
        }
        select.form-control:not([size]):not([multiple]) {
            height: calc(2.25rem + 9px);
        }
    </style>
    <div class="wrapper" style="transform: none;">



        <div class="header header-default header-style-default v1 absolute header-sticky " style="background-color: black;opacity: 0.7;">

            <div class="navbar navbar-default iw-header" style="background-image: url('img/jo.png');    background-color: black;
                 opacity: 0.7;">
                <div class="container-fluid" style="height: 400px;">
                    <div class="navbar-header">

                    </div>
                </div>
            </div>
        </div>
    </div>    
    <div clas="row">

        <!--<nav class="navbar navbar-default" style=" background-color: #111111;
             border-color: #080808;;">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" style="font-size: xx-large; color: #ffffff; font-weight: bold"> Worforce Admin</a>
                </div>
            </div>
        </nav>-->


        <div class="col-lg-1">
            <button class="btn" data-toggle="modal" data-target="#exampleModal"><span class="glyphicon glyphicon-th-list"></span></button>

        </div>
        <div class="col-lg-11" >
            <div class="panel panel-default">
                <div class="panel-body">
                     <center><strong><h2 style=" color: #203d57;">Administrador</h2></strong></center>
                    
                    <center><strong><h3 style="color: #5192cb;">Seguimiento de tareas</h3></strong></center>
                    <div class="panel panel-default">
                        <div class="panel-body">


                            <div class="alert alert-info"><center>Filtra por fecha de entrega para ver su estado de gestión y progreso.</center></div>

                            <form id="consulta">
                                <div class="col-sm-4">
                                    <label>Fecha inicial</label>
                                    <input type="date" class="form-control" name="fechaInicial" required>
                                </div>
                                <div class="col-sm-4">
                                    <label>Fecha final</label>
                                    <input type="date" class="form-control" name="fechaFinal" required>
                                </div>
                                <div class="col-sm-4">
                                    <label>Tipo tarea</label>
                                    <select class="form-control" name="tipo" id="tipo" required>
                                        <option value="">Seleccione...</option>
                                        <option value="General">General</option>
                                        <option value="Especial">Especial</option>
                                        <option value="Normal">Normal</option>
                                    </select>
                                </div>
                                <div class="col-sm-12" style="margin-top:15px;">
                                    <input type="submit" class="btn" value="Filtrar" style="width: 100%;
                                           background-color: #119ee4;
                                           color: white;">
                                </div>
                            </form>
                        </div> 
                    </div>
                    <div id='ponerTBLa'></div>
                    <div id='cargando'></div>
                </div> 
            </div>


            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-sm-7"  >
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <center><strong><h3 style="color: black;">Solicitudes cerradas.</h3></strong></center>

                                <form id="consultaCerrados">
                                    <div class="col-sm-6">
                                        <label>Fecha inicial</label>
                                        <input type="date" class="form-control" name="fechaInicialC" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Fecha final</label>
                                        <input type="date" class="form-control" name="fechaFinalC" required>
                                    </div>
                                    <div class="col-sm-12" style="margin-top:15px;">
                                        <input type="submit" class="btn" value="Filtrar" style="width: 100%;
                                               background-color: #119ee4;
                                               color: white;" >
                                    </div>
                                </form>


                            </div>
                        </div>

                        <div id="reporteGestion"></div>
                    </div>  

                    <div class="col-sm-5" >
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <center><strong><h3 style="color: black;">Dashboard de gestión</h3></strong></center>



                                <form id="consultaDashboard">
                                    <div class="col-sm-6">
                                        <label>Fecha inicial</label>
                                        <input type="date" class="form-control" name="fechaInicialDD" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Fecha final</label>
                                        <input type="date" class="form-control" name="fechaFinalDD" required>
                                    </div>
                                    <div class="col-sm-12" style="margin-top:15px;">
                                        <input type="submit" class="btn" value="Filtrar" style="width: 100%;
                                               background-color: #165879;
                                               color: white;" >
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div id="contenidoDetalleaDMIN"></div>

                        <div class="row">
                            <div class="col-sm-6" id="grafica1Admin"></div>
                            <div class="col-sm-6" id="grafica2Admin"></div>
                        </div>
                    </div>
                </div> 
            </div>
        </div>


        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <center><strong><h3 style="color: #5192cb;">Nueva tarea</h3></strong></center>

                                    <form id='agregarTarea'>
                                        <div class='row'>
                                            <div class='col-sm-12'>
                                                <label>Encargado</label>
                                                <select name='encargado' id='encargado' class='form-control' required>
                                                    <option value=''>Seleccione...</option>
                                                    <?php
                                                    $consultarEncargado = mysql_query("SELECT usuarios.id_usuario,id_permiso,usuarios.nombre_usuario,usuarios.apellido_usuario FROM crm_masterclaro.permisos_grupos
                                                JOIN crm_masterclaro.usuarios on permisos_grupos.id_usuario=usuarios.id_usuario where id_grupo=11") or die(mysql_error());
                                                    while ($listaEnvargado = mysql_fetch_array($consultarEncargado)) {
                                                        ?>
                                                        <option value='<?php echo $listaEnvargado['id_usuario']; ?>'><?php echo $listaEnvargado['nombre_usuario'] . ' ' . $listaEnvargado['apellido_usuario']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div> 
                                        <div class='row'>
                                            <div class='col-sm-12'>
                                                <label>¿Quien Solicita?</label>
                                                <input name='quienSolicita' class='form-control' required>
                                            </div>
                                        </div>

                                        <div class='row'>
                                            <div class='col-sm-12'>
                                                <label>Descripción</label>
                                                <textarea name='descripcion' class='form-control' required></textarea>
                                            </div>
                                        </div>
                                        <div class='row'>
                                            <div class='col-sm-12'>
                                                <label>Observaciones</label>
                                                <textarea name='observaciones' class='form-control' required></textarea>
                                            </div>    
                                        </div>  
                                        <div class='row'>
                                            <div class='col-sm-12'>
                                                <label>Fecha de entrega</label>
                                                <input name='fechaEntrega' class='form-control' type="date" required></input>
                                            </div>
                                        </div>
                                        <div class='row'>
                                            <div class='col-sm-12'>
                                                <label>Tipo </label>
                                                <select class="form-control" name="tipo" id="tipo" required>
                                                    <option value="">Seleccione...</option>
                                                    <option value="Especial">Especial</option>
                                                    <option value="Normal">Normal</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class='row' style='margin-top:5px;'>
                                            <div class='col-sm-12'>
                                                <input type='submit' class='btn' value='Registrar' style='width:100%;width: 100%;
                                                       background-color: #1a405e;
                                                       color: white;'>
                                            </div>
                                        </div>    
                                    </form>
                                    <div id='cargando'></div>
                                </div>    
                        </div> 
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(document).ready(function () {

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


                $("#consulta").submit(function (e) {
                    $("#ponerTBLa").html("<center><img src='img/spinner1.gif' width='120px'></center>");
                    var url = "ajax/consultas.php";
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: $("#consulta").serialize(),
                        success: function (registro) {
                            $("#ponerTBLa").html(registro);
                        }
                    });
                    e.preventDefault();
                });


                $("#consultaCerrados").submit(function (e) {
                    $("#reporteGestion").html("<center><img src='img/spinner1.gif' width='120px'></center>");
                    var url = "ajax/consultas.php";
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: $("#consultaCerrados").serialize(),
                        success: function (registro) {
                            $("#reporteGestion").html(registro);
                        }
                    });
                    e.preventDefault();
                });


                $("#consultaDashboard").submit(function (e) {

                    $("#contenidoDetalleaDMIN").html("<center><img src='img/spinner1.gif' width='120px'></center>");

                    var url = "ajax/consultas.php";
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: $("#consultaDashboard").serialize(),
                        success: function (registro3) {
                            $("#contenidoDetalleaDMIN").html(registro3);


                        }
                    });
                    e.preventDefault();
                });

            });

        </script>

        <?php
    } else {
        header("location:../");
    }
    ?>
