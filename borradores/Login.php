/* ----------------Validacion de los campos cedula------SACAR EL CODIGO DE FORMATEO DE DATO------*/
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
        this.value = this.value.replace(/[^a-zA-Z]/g, ''); //validacion para solo permitir letras
        if (this.value.length > 15){
            this.value = this.value.slice(0,15); //limite de digitos a 4
        }
    });
    document.getElementById("inputLastNamel2").addEventListener("input", function(e) {
        this.value = this.value.replace(/[^a-zA-Z]/g, ''); //validacion para solo permitir letras
        if (this.value.length > 15){
            this.value = this.value.slice(0,15); //limite de digitos a 4
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

    // se utiliza para formatear los valores para que tengan comas como separadores de miles
    const formatCurrency = (amount) => amount.toLocaleString('en-US', { style: 'currency', currency: 'USD' });

    // asignamos los valores a los campos
    document.getElementById("salbruto").value = formatCurrency(salarioBruto);
    document.getElementById("descuentoSocial").value = formatCurrency(desSSocial);
    document.getElementById("descuentoEducativo").value = formatCurrency(desEducativo);
    document.getElementById("descuentoImpRenta").value = formatCurrency(desImpRenta);
    document.getElementById("subtotal").value = formatCurrency(subtotal);
    document.getElementById("sueldoNeto").value = formatCurrency(salarioNeto);
}

// Añadimos el evento onchange a los elementos que afectan el cálculo
document.getElementById("htrabajadas").addEventListener("input", planilla);
document.getElementById("shora").addEventListener("input", planilla);
document.getElementById("otros_descuentos1").addEventListener("input", planilla);
document.getElementById("otros_descuentos2").addEventListener("input", planilla);
document.getElementById("otros_descuentos3").addEventListener("input", planilla);


//FUNCION PARA GUARDAR EN LA BASE DE DATOS
function guardar() {
    $.ajax({
        type: "POST",
        url: "guardar.php",
        data: $("form").serialize(),
            success: function(resp){
                document.getElementById('formulario').reset();
                alert("Registro Guardado");
            }
    });
}


--------------------SACAR EL HTML---------------------
<form>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1">
  </div>
  <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
    </div>