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
    <link rel="stylesheet" href="Styles.css">

    <!--AQUI VA EL LINK DE AJAX-->
    <script src="Sources/jquery3-4.min.js" type="text/javascript"></script>
</head>
<body> 
    <div id="form_datos_generales">
        <h4 id="subtitle_DG" class="textColor">Datos Generales</h4>
        <form id="formulario" class="row g-3"  method="post">

            <!--Direccion -->
            <div class="col-sm-4">
                <label class="visually-hidden" for="provincia">Preference</label>
                <label class="textColor" class="form-label">Provincia: </label>
                <select type="text" class="form-select" id="provincia" name="provincia" onchange="javascript:mostrar_distritos(this.value)">
                    <?php
                        $busca_provincia = mysqli_query($conexion, "SELECT * FROM provincia");
                        while ($provincia_encontrada=mysqli_fetch_assoc($busca_provincia)){
                            echo "<option value='".$provincia_encontrada['codigo_provincia']."'>".$provincia_encontrada['nombre_provincia']."</option>";
                        }
                    ?>
                </select>
            </div>

            <div class="col-sm-4" id="desplegabledistritos">
                <label class="textColor" class="formdistrito-label">Distrito: </label>
                <select class="form-select" id="" name="distrito" onchange="javascript:mostrar_corregimientos(this.value)">
                    <?php
                        $busca_distrito = mysqli_query($conexion, "SELECT * FROM distrito WHERE codigo_provincia = '01'");
                        while ($distrito_encontrada=mysqli_fetch_assoc($busca_distrito)){
                            echo "<option value='".$distrito_encontrada['codigo_distrito']."'>".$distrito_encontrada['nombre_distrito']."</option>";
                        }
                    ?>
                </select>
            </div>

            <div class="col-sm-4" id="desplegablecorregimientos">
                <label class="textColor" class="form-label" >Corregimiento: </label>
                <select class="form-select" id="corregimiento" name="corregimiento" required>
                    <?php
                        $busca_corregimiento = mysqli_query($conexion, "SELECT * FROM corregimiento WHERE codigo_distrito = '0101'");
                        while ($corregimiento_encontrada=mysqli_fetch_assoc($busca_corregimiento)){
                            echo "<option value='".$corregimiento_encontrada['codigo_corregimiento']."'>".$corregimiento_encontrada['nombre_corregimiento']."</option>";
                        }
                    ?>
                </select>
            </div>
            <br><br>
            
            
        </form>
    </div>
    

    <!--Ponemos el script de bootstrap-->
    <script src="Bootstrap/js/bootstrap.min.js"></script>

    <!--Agregamos el archivo de validaciones-->
    <script src="Scriptsb.js"></script>
</body>
</html>
