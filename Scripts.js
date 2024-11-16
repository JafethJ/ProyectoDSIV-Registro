
/* ----------------Validaciones de campos------------*/
document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("fcedulaC2").addEventListener("input", function(e) {
        this.value = this.value.replace(/[^0-9]/g, ''); //validacion para solo permitir numeros
        if (this.value.length > 4){
            this.value = this.value.slice(0,4); //limite de digitos a 4
        }
        if (this.value.startsWith("0")){
           this.value = this.value.slice(1); //eliminacion del primer digito en caso de ser 0
        }
    })
    document.getElementById("fcedulaC3").addEventListener("input", function(e) {
        this.value = this.value.replace(/[^0-9]/g, ''); //validacion para solo permitir numeros
        if (this.value.length > 4){
            this.value = this.value.slice(0,5); //limite de digitos a 5
        }
        if (this.value.startsWith("0")){
           this.value = this.value.slice(1); //eliminacion del primer digito en caso de ser 0
        }
    })

    //validacion de campos de nombres
    document.getElementById("inputNamel1").addEventListener("input", function(e) {
        this.value = this.value.replace(/[^a-zA-Z]/g, ''); //validacion para solo permitir letras
        if (this.value.length > 15){
            this.value = this.value.slice(0,15); //limite de digitos a 4
        }
    });
    document.getElementById("inputNamel2").addEventListener("input", function(e) {
        this.value = this.value.replace(/[^a-zA-Z]/g, ''); //validacion para solo permitir letras
        if (this.value.length > 15){
            this.value = this.value.slice(0,15); //limite de digitos a 4
        }
    });
    document.getElementById("inputLastNamel1").addEventListener("input", function(e) {
        // Permitir solo letras y espacios, pero evitar más de un espacio consecutivo
        this.value = this.value.replace(/[^a-zA-Z\s]/g, ''); // Solo letras y espacios
        this.value = this.value.replace(/\s{2,}/g, ' '); // Reemplazar múltiples espacios por uno solo
    
        // Limitar a un máximo de 15 caracteres
        if (this.value.length > 15) {
            this.value = this.value.slice(0, 15);
        }
    });
    document.getElementById("inputLastNamel2").addEventListener("input", function(e) {
       // Permitir solo letras y espacios, pero evitar más de un espacio consecutivo
       this.value = this.value.replace(/[^a-zA-Z\s]/g, ''); // Solo letras y espacios
       this.value = this.value.replace(/\s{2,}/g, ' '); // Reemplazar múltiples espacios por uno solo
   
       // Limitar a un máximo de 15 caracteres
       if (this.value.length > 15) {
           this.value = this.value.slice(0, 15);
       }
    });
    //campos de descuentos
    //Variable para guardar el sueldo neto anterior
    let sueldonetoanterior = '';
    // variable para guardar el valor anterior del descuento 1
    let valorAnteriorDescuento1 = '';

    document.getElementById("otros_descuentos1").addEventListener("input", function(e) {
        if (parseFloat(this.value) <= 0) {
            this.value = '';
            return;
        }

        // Evitar que el usuario ingrese la letra "e" o cualquier letra
        if (this.value.includes('e') || /[a-zA-Z]/.test(this.value)) {
            this.value = this.value.replace(/[eE]/g, '');
            this.value = this.value.replace(/[a-zA-Z]/g, '');
        }

        // Verificar si el descuento no supera el sueldo neto
        const sueldoneto = parseFloat(document.getElementById("sueldoNeto").value) || 0;

        if (sueldoneto<0) {
            alert("El descuento no puede ser mayor que el sueldo neto");
            this.value = valorAnteriorDescuento1; // Volver al valor anterior si excede
            document.getElementById("sueldoNeto").value = sueldonetoanterior;
        } else {
            valorAnteriorDescuento1 = this.value; // Actualizar el valor anterior si es válido
            sueldonetoanterior = sueldoneto;
        }
    });

    // variable para guardar el valor anterior del descuento 2
    let valorAnteriorDescuento2 = '';

    document.getElementById("otros_descuentos2").addEventListener("input", function(e) {
        if (parseFloat(this.value) <= 0) {
            this.value = '';
            return;
        }

        // Evitar que el usuario ingrese la letra "e" o cualquier letra
        if (this.value.includes('e') || /[a-zA-Z]/.test(this.value)) {
            this.value = this.value.replace(/[eE]/g, '');
            this.value = this.value.replace(/[a-zA-Z]/g, '');
        }

        // Verificar si el descuento no supera el sueldo neto
        const sueldoneto = parseFloat(document.getElementById("sueldoNeto").value) || 0;

        if (sueldoneto<0) {
            alert("El descuento no puede ser mayor que el sueldo neto");
            this.value = valorAnteriorDescuento2; // Volver al valor anterior si excede
            document.getElementById("sueldoNeto").value = sueldonetoanterior;

        } else {
            valorAnteriorDescuento2 = this.value; // Actualizar el valor anterior si es válido
            sueldonetoanterior = sueldoneto;

        }
    });

    // variable para guardar el valor anterior del descuento 3
    let valorAnteriorDescuento3 = '';

    document.getElementById("otros_descuentos3").addEventListener("input", function(e) {
        if (parseFloat(this.value) <= 0) {
            this.value = '';
            return;
        }

        // Evitar que el usuario ingrese la letra "e" o cualquier letra
        if (this.value.includes('e') || /[a-zA-Z]/.test(this.value)) {
            this.value = this.value.replace(/[eE]/g, '');
            this.value = this.value.replace(/[a-zA-Z]/g, '');
        }

        // Verificar si el descuento no supera el sueldo neto
        const sueldoneto = parseFloat(document.getElementById("sueldoNeto").value) || 0;

        if (sueldoneto<0) {
            alert("El descuento no puede ser mayor que el sueldo neto");
            this.value = valorAnteriorDescuento3; // Volver al valor anterior si excede
            document.getElementById("sueldoNeto").value = sueldonetoanterior;

        } else {
            valorAnteriorDescuento3 = this.value; // Actualizar el valor anterior si es válido
            sueldonetoanterior = sueldoneto;

        }
    });


    
    //--------------VALIDACIONES DE LOS CAMPOS DE SUELDO-----------
    // Validar que "Horas trabajadas" solo acepte números mayores que 0
    document.getElementById("htrabajadas").addEventListener("input", function(e) {
        // Evitar que el usuario ingrese un valor menor o igual a 0
        if (parseInt(this.value) <= 0) {
            this.value = '';
        }
        
        // Evitar que el usuario ingrese la letra "e", cualquier letra o un punto decimal
        this.value = this.value.replace(/[eE]/g, '');
        this.value = this.value.replace(/[a-zA-Z]/g, '');
        this.value = this.value.replace(/\./g, '');
    });

    // Validar que "Sueldo por hora" solo acepte números mayores que 0
    document.getElementById("shora").addEventListener("input", function(e) {
        if (this.value <= 0) {
            this.value = '';
        }
        // Evitar que el usuario ingrese la letra "e" o cualquier letra
        if (this.value.includes('e') || /[a-zA-Z]/.test(this.value)) {
            this.value = this.value.replace(/[eE]/g, '');
            this.value = this.value.replace(/[a-zA-Z]/g, '');
        }
    });
});

/*-------------------CALCULOS DE PLANILLA--------------------- */
function planilla() {
    const cantidadHoraTrabajada = parseFloat(document.getElementById("htrabajadas").value) || 0;
    const sueldoHora = parseFloat(document.getElementById("shora").value) || 0;

    const salarioBruto = cantidadHoraTrabajada * sueldoHora;
    const desSSocial = salarioBruto * 0.0975;
    const desEducativo = salarioBruto * 0.0125;
    let desImpRenta = 0;

    if (salarioBruto * 12 > 11000) {
        desImpRenta = (((salarioBruto * 12) - 11000) / 12) * 0.15;
    }

    const descuento1 = parseFloat(document.getElementById("otros_descuentos1").value) || 0;
    const descuento2 = parseFloat(document.getElementById("otros_descuentos2").value) || 0;
    const descuento3 = parseFloat(document.getElementById("otros_descuentos3").value) || 0;

    const subtotal = salarioBruto - (desSSocial + desEducativo + desImpRenta);
    const salarioNeto = subtotal - (descuento1 + descuento2 + descuento3);

    // Asignamos los valores a los campos de entrada sin formateo de moneda
    document.getElementById("salbruto").value = salarioBruto.toFixed(2);
    document.getElementById("descuentoSocial").value = desSSocial.toFixed(2);
    document.getElementById("descuentoEducativo").value = desEducativo.toFixed(2);
    document.getElementById("descuentoImpRenta").value = desImpRenta.toFixed(2);
    document.getElementById("subtotal").value = subtotal.toFixed(2);
    document.getElementById("sueldoNeto").value = salarioNeto.toFixed(2);
}
// Añadimos el evento onchange a los elementos que afectan el cálculo
document.getElementById("htrabajadas").addEventListener("input", planilla);
document.getElementById("shora").addEventListener("input", planilla);
document.getElementById("otros_descuentos1").addEventListener("input", planilla);
document.getElementById("otros_descuentos2").addEventListener("input", planilla);
document.getElementById("otros_descuentos3").addEventListener("input", planilla);

/*------------------------ AJAX ---------------------*/

//FUNCIONES PARA LA DIRECCION DE UBICACION

function mostrar_distritos(distritos) {
    $.post("distritos.php", {"dis":distritos}, function(data){
    $("#desplegabledistritos").html(data);
    });
    let provinciaactual = document.getElementById('provincia').value;
    let provdistr = provinciaactual + '01'; //concatenamos la provincia actual con el codigo 01
    mostrar_corregimientos(provdistr);

}

function mostrar_corregimientos(corregimientos) {
    $.post("corregimientos.php", {"corr":corregimientos}, function(data){
    $("#desplegablecorregimientos").html(data);
    });
}

