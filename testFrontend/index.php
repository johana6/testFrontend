<!DOCTYPE html>
<html>
    <head>
        <title>Aerolinea</title>
        <meta charset="utf-8"/>
        <link href="css/style.css" rel="stylesheet">
        <link href="librerias/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="librerias/jquery/jquery.min.js"></script>
        <script src="librerias/jquery.js"></script>
        <script src="librerias/jquery-ui-1.12.1/jquery-ui.min.js"></script>
        <script src="librerias/bootstrap-3.3.7-dist/js/bootstrap.js" type="text/javascript"></script>
        <script src="librerias/DataTables-1.10.13/media/js/jquery.dataTables.min.js"></script>
        <script src="js/js.js"></script>

    </head>
    <body>

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

            <nav class="navbar navbar-default" style="background-color: #0a6d9e;border-color: #ffffff;">
                <div class="container-fluid">
                    <div class="navbar-header" id="tituloAer">
                    </div>
                </div>
                <strong><center><h2 style="color: white;
                                    font-family: 'Saira Extra Condensed',serif;
                                    font-weight: 700;
                                    text-transform: uppercase;
                                    font-size: 3.5rem;">Aerolinea S.A.S</h2></center></strong>
            </nav>
        </div>    
        <div clas="row">


            <div class="col-lg-6" >
                <div class="panel panel-default">
                    <div class="panel-body">

                        <center><strong><h3 style="color: #5192cb;">Reservar tiquetes</h3></strong></center>
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="alert alert-info"><center>Por favor seleccione la ciudad de origen para continuar con la reserva</center></div>
                                <form>
                                    <div clas="row">
                                        <div class="col-sm-6">
                                            <label>Ciudad origen</label>
                                            <select  class="form-control" name="ciudadOrigen" id="ciudadOrigen" required>
                                                <option value="">Seleccione...</option>
                                            </select>
                                        </div>

                                        <div class="col-sm-6" id="divDestino">
                                            <label>Ciudad destino</label>
                                            <select  class="form-control" name="ciudadDestino" id="ciudadDestino" required>
                                                <option value="">Seleccione...</option>
                                            </select>
                                        </div>
                                        <div id="cargando"></div>
                                    </div>

                                    <div id="camposPersonales">  
                                        <div clas="row">
                                            <div class="col-sm-6">
                                                <label>Nombres</label>
                                                <input type="text" class="form-control" name="nombres" required>
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Apellido</label>
                                                <input type="text" class="form-control" name="apellidos" required>
                                            </div>
                                        </div>   

                                        <div clas="row">
                                            <div class="col-sm-6">
                                                <label>Cedula</label>
                                                <input type="number" class="form-control" name="cedula" required placeholder="123456789">
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Telefono</label>
                                                <input type="number" class="form-control" name="telefono" required placeholder="123456789">
                                            </div>
                                        </div>

                                        <div clas="row">
                                            <div class="col-sm-6">
                                                <label>Fecha nacimiento</label>
                                                <input type="date" class="form-control" name="fechaNacimiento" required>
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Celular</label>
                                                <input type="number" class="form-control" name="celular" required>
                                            </div>
                                        </div>

                                        <div clas="row">
                                            <div class="col-sm-6">
                                                <label>Correo electronico</label>
                                                <input type="email" class="form-control" name="correo" required>
                                            </div>

                                          
                                        </div>  
                                        
                                         <div clas="row">
                                          <div class="col-sm-12" style="margin-top:15px;">
                                                <input type="submit" class="btn" value="Filtrar" style="width: 100%; background-color: #119ee4;color: white;">
                                            </div>
                                         </div>    
                                    </div>  
                                </form>
                            </div> 
                        </div>
                    </div> 
                </div>



            </div>

            <div class="col-lg-6" >
                <div class="panel panel-default">
                    <div class="panel-body">

                        <center><strong><h3 style="color: #5192cb;">Consulta de vuelos</h3></strong></center>
                        <div class="panel panel-default">
                            <div class="panel-body">


                                <div class="alert alert-info"><center>Filtrar por fecha y por trayecto.</center></div>

                                <form  id="consultaVuelo" name="consultaVuelo">
                                    <div class="col-sm-6">
                                        <label>Ciudad origen</label>
                                        <select class="form-control" name="ciudadOrigenConsulta" id="ciudadOrigenConsulta" required>
                                            <option value="">Seleccione...</option>
                                        </select>
                                    </div>

                                    <div class="col-sm-6">
                                        <label>Ciudad destino</label>
                                        <select class="form-control" name="ciudadOrigenConsultaDestino" id="ciudadOrigenConsultaDestino" required>
                                            <option value="">Seleccione...</option>
                                        </select>
                                    </div>


                                    <div class="col-sm-6">
                                        <label>Fecha vuelo</label>
                                        <input type="date" class="form-control" name="fechaInicial" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Fecha regreso</label>
                                        <input type="date" class="form-control" name="fechaFinal" required>
                                    </div>
                                    <div class="col-sm-12" style="margin-top:15px;">
                                        <input type="submit" class="btn" value="Filtrar" style="width: 100%;
                                               background-color: #1a5e7f;
                                               color: white;">
                                    </div>
                                </form>
                            </div> 
                        </div>
                    </div> 
                </div>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div id="cargandoVuelos"></div>
                        <table class="table">
                            <thead style="    background-color: black;
    color: white;">
                                <tr>
                                    <th scope="col">Ciudad origen</th>
                                    <th scope="col">Ciudad destino</th>
                                    <th scope="col">Fecha</th>
                                    <th scope="col">Duracion</th>
                                </tr>
                            </thead>
                            <tbody id="agragarCampos">
                                
                            </tbody>
                    </div>
                </div>
            </div>



