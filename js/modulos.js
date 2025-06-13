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

  //DE AUI EN DELANTE ACTIVA EL MODULO SELECCIONADO
  const modulos = document.querySelectorAll('.modulo');
  modulos.forEach(modulo => {
    modulo.classList.remove('activo');
  });
  const modulo = document.getElementById(moduloId);
  modulo.classList.add('activo');
}


 



 
