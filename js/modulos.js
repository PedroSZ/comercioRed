
function activarModulo(moduloId) {
  //DE AQUI EN DELANTE PONE UNA FECHA ACTUAL EN EL CAMPO DE FECHA DE REGISTRO
  var fecha = new Date(); //Fecha actual
  var mes = fecha.getMonth()+1; //obteniendo mes
  var dia = fecha.getDate(); //obteniendo dia
  var ano = fecha.getFullYear(); //obteniendo año
  if(dia<10)
    dia='0'+dia; //agrega cero si el menor de 10
  if(mes<10)
    mes='0'+mes //agrega cero si el menor de 10
  document.getElementById('cliente_fecha_registro').value = ano+"-"+mes+"-"+dia;//ponemos la fecha actual
  document.getElementById('fecha_registro').value = ano+"-"+mes+"-"+dia;//ponemos la fecha actual
  document.getElementById('fecha_registro_p').value = ano+"-"+mes+"-"+dia;//ponemos la fecha actual
  document.getElementById('fecha_venta').value = ano+"-"+mes+"-"+dia;//ponemos la fecha actual

 
}

document.addEventListener('DOMContentLoaded', function () {
  const form = document.getElementById('frm_reg_Productos');

  if (form) {
    const inputs = Array.from(form.querySelectorAll('input, select, textarea'));

    inputs.forEach((input, index) => {
      input.addEventListener('keydown', function (e) {
        if (e.key === 'Enter') {
          e.preventDefault(); // Evita el submit automático

          // Si el input actual es de tipo submit, enviamos el formulario
          if (input.type === 'submit') {
            form.submit();
            return;
          }

          // Buscar el siguiente campo que no esté deshabilitado y sea visible
          let next = inputs[index + 1];
          while (next && (next.disabled || next.offsetParent === null)) {
            index++;
            next = inputs[index + 1];
          }

          if (next) {
            next.focus();
          }
        }
      });
    });
  }
});

document.addEventListener('DOMContentLoaded', function () {
  const form = document.getElementById('frm_reg_Productos');

  form.addEventListener('submit', function (e) {
    const codigo = document.getElementById('codigoid');
    const nombre = document.getElementById('producto_nombre');
    const cantidad = document.getElementById('cantidad');
    const precio = document.getElementById('precio');

    let valid = true;
    let mensaje = "";

    // Verifica si están vacíos
    if (codigo.value.trim() === "") {
      valid = false;
      mensaje += "- El campo CÓDIGO es obligatorio.\n";
      codigo.style.borderColor = "red";
    } else {
      codigo.style.borderColor = "";
    }

    if (nombre.value.trim() === "") {
      valid = false;
      mensaje += "- El campo NOMBRE DEL PRODUCTO es obligatorio.\n";
      nombre.style.borderColor = "red";
    } else {
      nombre.style.borderColor = "";
    }

    if (cantidad.value.trim() === "") {
      valid = false;
      mensaje += "- El campo CANTIDAD es obligatorio.\n";
      cantidad.style.borderColor = "red";
    } else {
      cantidad.style.borderColor = "";
    }

    if (precio.value.trim() === "") {
      valid = false;
      mensaje += "- El campo PRECIO es obligatorio.\n";
      precio.style.borderColor = "red";
    } else {
      precio.style.borderColor = "";
    }

    if (!valid) {
      e.preventDefault(); // Detiene el envío
      alert("Por favor completa los campos obligatorios:\n\n" + mensaje);
    }
  });
});

 



 
