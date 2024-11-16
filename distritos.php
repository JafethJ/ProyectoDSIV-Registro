<?php

$host="localhost";
$user="d42024";
$pass="1234";
$BD="planilla";
$conexion = mysqli_connect($host, $user, $pass, $BD);

$dis  = $_POST['dis'];
?>

<label class="textColor" class="form-label">Distrito: </label>
<select class="form-select" id="distrito" name="distrito" onchange="javascript:mostrar_corregimientos(this.value)">
    <?php
        $busca_distrito = mysqli_query($conexion, "SELECT * FROM distrito WHERE codigo_provincia = '$dis'");
        while ($distrito_encontrada=mysqli_fetch_assoc($busca_distrito)){
            echo "<option value='".$distrito_encontrada['codigo_distrito']."'>".$distrito_encontrada['nombre_distrito']."</option>";
        }
    ?>
</select>