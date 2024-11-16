<?php
    $host="localhost";
    $user="d42024";
    $pass="1234";
    $BD="planilla";
    $conexion = mysqli_connect($host, $user, $pass, $BD);
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
    <!--Link de bootstrap-->
    <link rel="stylesheet" href="Bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="Index.css">


    <!--AQUI VA EL LINK DE AJAX-->
    <script src="Sources/jquery3-4.min.js" type="text/javascript"></script>
</head>
<body> 
    <div id="form_datos_generales">
        <h4 id="subtitle_DG" class="textColor">Ingrese la cedula</h4>
        <form id="formulario" class="row g-3"  method="post">
            <div id="container_cedula" class="d-flex align-items-center">
                <select name="z" id="fcedulaC1" id="validationDefault01" class="form-select mx-2" style="width: auto;" aria-label="Default select example" onchange="revisar_si_existe()" required>
                    <option value="01">1</option>
                    <option value="02">2</option>
                    <option value="03">3</option>
                    <option value="04">4</option>
                    <option value="05">5</option>
                    <option value="06">6</option>
                    <option value="07">7</option>
                    <option value="08" selected>8</option>
                    <option value="09">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                </select>
                
                <label id="guionCedula" class="textColor" class="mx-1"> - </label>
                
                <input type="text" name="fcedulaC2" id="fcedulaC2" class="form-control mx-2"  placeholder="0000" required onchange="revisar_si_existe()">
                
                <label id="guionCedula" class="textColor" class="mx-1"> - </label>
                
                <input type="text" name="fcedulaC3" id="fcedulaC3" class="form-control mx-2" placeholder="00000" required onchange="revisar_si_existe()">
            </div>

            <div class="col-12">
                <button class="btn btn-primary btn-index-buscar" class="textColor" id="boton_buscar" type="button" onclick="revisar_si_existe()">Buscar</button>
                <button class="btn btn-primary btn-index-ver" class="textColor" id="boton_ver" type="button" onclick="abrirVerRegistro()" hidden>Ver</button>
                <button class="btn btn-primary btn-index-agregar" class="textColor" id="boton_agregar" type="button" onclick="abrirAgregarRegistro()" hidden>Agregar</button>
                <button class="btn btn-primary btn-index-borrar" id="borrar" type="button" onclick="recargar_pagina()">Borrar</button>

            </div>

        </form>
    </div>

    <!--Ponemos el script de bootstrap-->
    <script src="Bootstrap/js/bootstrap.min.js"></script>

    <!--Agregamos el archivo de validaciones-->
    <script src="Scripts.js"></script>
    <script src="script_index.js"></script>

    

</body>
</html>
