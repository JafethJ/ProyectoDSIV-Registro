<?php
    $host="localhost";
    $user="d42024";
    $pass="1234";
    $BD="planilla";
    $conexion = mysqli_connect($host, $user, $pass, $BD);

    $cedula = isset($_GET['cedula']) ? $_GET['cedula'] : '';
    $prefijo = isset($_GET['prefijo']) ? $_GET['prefijo'] : '';
    $tomo = isset($_GET['tomo']) ? $_GET['tomo'] : '';
    $asiento = isset($_GET['asiento']) ? $_GET['asiento'] : '';
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
    <!--Link de bootstrap-->
    <link rel="stylesheet" href="Bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="Styles.css">
    <!--EL LINK DE sweealert-->

    <!--AQUI VA EL LINK DE AJAX-->
    <script src="Sources/jquery3-4.min.js" type="text/javascript"></script>
</head>
<body> 
    <div id="form_datos_generales">
        <h4 id="subtitle_DG" class="textColor">Datos Generales</h4>
        <form id="formulario" class="row g-3"  method="post">
            <div id="container_cedula" class="d-flex align-items-center">
                <select name="z" id="fcedulaC1" class="form-select mx-2" style="width: auto;" disabled required>
                    <option value="<?php echo $prefijo; ?>" selected><?php echo $prefijo; ?></option>
                    <!-- Otros valores opcionales del select -->
                </select>

                <label id="guionCedula" class="textColor" class="mx-1"> - </label>

                <input type="text" name="fcedulaC2" id="fcedulaC2" class="form-control mx-2" value="<?php echo $tomo; ?>" readonly required>

                <label id="guionCedula" class="textColor" class="mx-1"> - </label>

                <input type="text" name="fcedulaC3" id="fcedulaC3" class="form-control mx-2" value="<?php echo $asiento; ?>" readonly required>
            </div>

            <!--Para que se ejecute de una vez apenas entra a este archivo-->
            <script>
                function ver_registro() {
                    var prefijo = document.getElementById('fcedulaC1').value.trim();
                    var tomo = document.getElementById('fcedulaC2').value.trim();
                    var asiento = document.getElementById('fcedulaC3').value.trim();

                    var id = prefijo + "-" + tomo + "-" + asiento;
                    
                    $.ajax({
                        type: "POST",
                        url: "Buscar_registros.php",
                        data: { id: id },
                        dataType: "json",
                        success: function (response) {
                            if (response.error) {
                                alert(response.error);
                                return;
                            }

                            document.getElementById('inputNamel1').value = response.nombre1 || '';
                            document.getElementById('inputNamel2').value = response.nombre2 || '';
                            document.getElementById('inputLastNamel1').value = response.apellido1 || '';
                            document.getElementById('inputLastNamel2').value = response.apellido2 || '';
                            document.getElementById('provincia').value = response.provincia || '';

                            // Actualizar el select de distrito y seleccionar el distrito correcto
                            var distritoSelect = document.getElementById('distrito');
                            distritoSelect.innerHTML = "<option value='" + response.distrito + "'>" + response.nombre_distrito + "</option>";
                            
                            // Actualizar el select de corregimiento y seleccionar el corregimiento correcto
                            var corregimientoSelect = document.getElementById('corregimiento');
                            corregimientoSelect.innerHTML = "<option value='" + response.corregimiento + "'>" + response.nombre_corregimiento + "</option>";
                            
                            document.getElementById('htrabajadas').value = response.htrabajadas || '';
                            document.getElementById('shora').value = response.shora || '';
                            document.getElementById('salbruto').value = response.sbruto || '';
                            document.getElementById('descuentoSocial').value = response.ssocial || '';
                            document.getElementById('descuentoEducativo').value = response.seducativo || '';
                            document.getElementById('descuentoImpRenta').value = response.irenta || '';
                            document.getElementById('otros_descuentos1').value = response.descuento1 || '';
                            document.getElementById('otros_descuentos2').value = response.descuento2 || '';
                            document.getElementById('otros_descuentos3').value = response.descuento3 || '';
                            document.getElementById('sueldoNeto').value = response.sneto || '';
                        },
                        error: function (xhr, status, error) {
                            console.log('Error en la solicitud AJAX:', error);
                        }
                    });
                }

                //Ejecutar la funcion al cargar la página
                document.addEventListener("DOMContentLoaded", ver_registro);

            </script>

            <div class="col-md-6">  
                <label for="inputNamel1" class="textColor" class="form-label">Primer Nombre: *</label>
                <input type="text" class="form-control editable-input" name="inputNamel1" id="inputNamel1" placeholder="Primer Nombre" readonly required>
            </div>
            <div class="col-md-6">
                <label for="inputNamel2" class="textColor" class="form-label">Segundo Nombre: </label>
                <input type="text" class="form-control editable-input" name="inputNamel2" id="inputNamel2" placeholder="Segundo Nombre" readonly>
            </div>
            <div class="col-md-6">
                <label for="inputLastNamel1" class="textColor" class="form-label">Primer Apellido: *</label>
                <input type="text" class="form-control editable-input" name="inputLastNamel1" id="inputLastNamel1" placeholder="Primer Apellido" readonly required>
            </div>
            <div class="col-md-6">
                <label for="inputLastNamel2" class="textColor" class="form-label">Segundo Apellido: *</label>
                <input type="text" class="form-control editable-input" name="inputLastNamel2" id="inputLastNamel2" placeholder="Segundo Apellido" readonly required>
            </div>

            <!--Direccion -->
            <div class="col-sm-4">
                <label class="visually-hidden" for="provincia">Preference</label>
                <label class="textColor" class="form-label">Provincia: </label>
                <select type="text" class="form-select editable-select" id="provincia" name="provincia" disabled onchange="javascript:mostrar_distritos(this.value)">
                    <?php
                        $busca_provincia = mysqli_query($conexion, "SELECT * FROM provincia");
                        while ($provincia_encontrada=mysqli_fetch_assoc($busca_provincia)){
                            echo "<option value='".$provincia_encontrada['codigo_provincia']."'>".$provincia_encontrada['nombre_provincia']."</option>";
                        }
                    ?>
                </select>
            </div>

            <div class="col-sm-4" id="desplegabledistritos">
                <label class="textColor" class="form-label">Distrito: </label>
                <select class="form-select editable-select" id="distrito" name="distrito" disabled onchange="javascript:mostrar_corregimientos(this.value)">
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
                <select class="form-select editable-select" id="corregimiento" disabled name="corregimiento" required>
                    <?php
                        $busca_corregimiento = mysqli_query($conexion, "SELECT * FROM corregimiento WHERE codigo_distrito = '0102'");
                        while ($corregimiento_encontrada=mysqli_fetch_assoc($busca_corregimiento)){
                            echo "<option value='".$corregimiento_encontrada['codigo_corregimiento']."'>".$corregimiento_encontrada['nombre_corregimiento']."</option>";
                        }
                    ?>
                </select>
            </div>
            <br><br>

            <!--Datos para la planilla-->
            <h4 id="subtitle_DP" class="textColor">Datos de Planilla</h4>

            <!-- Campos editables -->

            <div class="col-md-4">
                <label for="shora" class="textColor form-label">Sueldo Por Hora *</label>
                <div class="input-group">
                    <div id="signoDolarSB" class="input-group-prepend">
                        <span class="input-group-text">$</span>
                    </div>
                    <input type="number" class="form-control editable-input" name="shora" id="shora" placeholder="00.00" onchange="planilla()" readonly required>
                </div>
            </div>
            
            <div class="col-md-4">
                <label for="htrabajadas" class="textColor form-label">Horas trabajadas *</label>
                <input type="number" class="form-control editable-input" name="htrabajadas" id="htrabajadas" placeholder="00" onchange="planilla()" readonly required>
            </div>
        
            <div class="col-md-4">
                <label for="salbruto" class="textColor form-label">Salario Bruto</label>
                <div class="input-group">
                    <div id="signoDolarSB" class="input-group-prepend">
                        <span class="input-group-text">$</span>
                    </div>
                    <input type="number" class="form-control" name="salbruto" id="salbruto" placeholder="000.00" readonly>
                </div>
            </div>

            <!-- Tabla para mostrar los valores readonly -->
            <div class="col-12 mt-4">
                <table class="table table-bordered" id="planillatable">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">Descripción</th>
                            <th scope="col">Monto</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <tr>
                            <td>Descuento de Seguro Social</td>
                            <td>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input type="number" class="form-control" name="descuentoSocial" id="descuentoSocial" placeholder="00.00" readonly>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Descuento Educativo</td>
                            <td>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input type="number" class="form-control" name="descuentoEducativo" id="descuentoEducativo" placeholder=" 00.00" readonly>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Descuento de Impuesto sobre renta</td>
                            <td>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input type="number" class="form-control" name="descuentoImpRenta" id="descuentoImpRenta" placeholder="00.00" readonly>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><b><i>Subtotal</i></b></td>
                            <td>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input type="number" class="form-control" name="subtotal" id="subtotal" placeholder="00.00" readonly>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Descuento 1</td>
                            <td>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input type="number" class="form-control editable-input" name="otros_descuentos1"  id="otros_descuentos1" readonly placeholder="00.00" onchange="planilla()">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Descuento 2</td>
                            <td>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input type="number" class="form-control editable-input" name="otros_descuentos2" id="otros_descuentos2" readonly placeholder="00.00" onchange="planilla()">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Descuento 3</td>
                            <td>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input type="number" class="form-control editable-input" name="otros_descuentos3" id="otros_descuentos3" placeholder="00.00" onchange="planilla()">
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td><b><i>Suelo Neto:</i></b></td>
                            <td>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input type="number" class="form-control" name="sueldoNeto" id="sueldoNeto" placeholder="00.00" readonly>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="col-12">
                <button class="btn btn-primary btn-cancel" class="textColor" type="button" onclick="habilitar_campus()">Editar</button>
                <button class="btn btn-primary btn-cancel" class="textColor" type="button" onclick="delete_registro()">Eliminar</button>

                <button class="btn btn-primary btn-update" class="textColor" type="submit" onclick="verificar_campus_obligatorio_Actualizar()" hidden>Actualizar</button>
                <button class="btn btn-primary btn-update" class="textColor" type="button" onclick="cancelar_actualizacion()" hidden>Cancelar</button>
                
                <a href="Index.php">
                    <button class="btn btn-primary" class="textColor" type="button">Regresar</button>
                </a>
            </div> 

        </form>
    </div>
    </script>
    <!--Ponemos el script de bootstrap-->
    <script src="Bootstrap/js/bootstrap.min.js"></script>

    <!--Agregamos el archivo de validaciones-->
    <script src="crud.js"></script>

    <script src="Scripts.js"></script>

</body>
</html>
