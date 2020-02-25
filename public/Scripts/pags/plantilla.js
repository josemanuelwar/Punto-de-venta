$(document).on('click', '.eliminar', function(e){
  let totalCampos = $("#totalCampos");
  e.preventDefault();
  a = a-1;
  totalCampos.val(a);//variable para saber cuantos campos esta mandando
  this.parentNode.parentNode.remove();
});
$(function() {
    $( "#tbody" ).sortable();
  });
<?php if (isset($post)): ?>
a = '<?php echo ($cam/4) ?>';
<?php else: ?>
   a = 1;
<?php endif; ?>
function vercat(nomcat,indice){
  $.ajax({
    async:true,
    cache:false,
    dataType:"html",
    type: 'POST',
    url: '<?php echo base_url('Coordinador/get_contcat') ?>',
    data: {cat:nomcat,indice:indice,'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'},
    success:  function(item){
      $("#aj"+indice).html(item);
    },
    beforeSend:function(){},
    error:function(objXMLHttpRequest){}
  });

}
 $(document).ready(function (){
  let totalCampos = $("#totalCampos");
  let tipoSelect = document.getElementsByClassName('tipoSelect');
  for (var i = tipoSelect.length - 1; i >= 0; i--) {
      let selected = tipoSelect[i].options[tipoSelect[i].selectedIndex].value;
      let divs = tipoSelect[i].parentNode.parentNode.childNodes[3];
      if(selected == "Catalogo")
      {      
        divs.childNodes[1].style.display = 'none';
        divs.childNodes[1].childNodes[0].value = '';
        divs.childNodes[1].childNodes[1].value = '';
        divs.childNodes[3].style.display = 'block';
      }
      else
      {
        divs.childNodes[1].style.display = 'block';
        divs.childNodes[1].childNodes[0].value = '';
        divs.childNodes[3].style.display = 'none'; 
        divs.childNodes[3].childNodes[1].value = ''; 
      }
  }

  for (var i = tipoSelect.length - 1; i >= 0; i--) {
    tipoSelect[i].addEventListener('change',function(){
    let selected = this.options[this.selectedIndex].value;
    let divs = this.parentNode.parentNode.childNodes[3];
    if(selected == "Catalogo")
    {      
      divs.childNodes[1].style.display = 'none';
      divs.childNodes[1].childNodes[0].value = '';
      if (typeof divs.childNodes[1].childNodes[1] !== "undefined") {
        divs.childNodes[1].childNodes[1].value = '';

      }
      divs.childNodes[3].style.display = 'block';
    }
    else
    {
      divs.childNodes[1].style.display = 'block';
      divs.childNodes[1].childNodes[0].value = '';
      divs.childNodes[3].style.display = 'none'; 
      divs.childNodes[3].childNodes[1].value = ''; 
    }
  });
  }

   function dibujarCabecera(){
     $("#tablaprueba tr").remove();
    //$("#canciones .campo"+a).each(function () {
    var htmlTags = '<tr class="fila">';
    var encabezados = "";
    for(var i=1;i<=a;i++){
      if ($('#divo'+i).is(":visible")) {
        encabezados += '<th class="campo">' + $("#campo"+(i)).val()+ '</th>';
      }else {
        encabezados += '<th class="campo">' + $("#cat"+(i)).val()+ '</th>';

      }
    }
    htmlTags += encabezados + '</tr>';
    $('#tablaprueba thead').append(htmlTags);
    //agregar tds
    var htmlTags1 = '<tr class="fila">';
    var encabezados1 = "";
    for(var i=1;i<=a;i++){

      if ($('#divo'+i).is(":visible")) {
        encabezados1 += '<td class="campo"></td>';
      }else{
        encabezados1 += '<td class="campo">';
        encabezados1 += "<button type='button' onclick='vercat("+'"'+$("#cat"+(i)).val()+'"'+","+'"'+i+'"'+")' class='btn btn-success'>Ver Elementos del Catalogo</button>";
      //  encabezados1 += "<button type='button' onclick='vercat("+$("#cat"+(i)).val()+','+i+')' class="btn btn-light">Ver Elementos del Catalogo</button>";
        encabezados1 += '<div id="aj'+(i)+'" >';
        encabezados1 += '</div></td>';

      }
   }
    htmlTags1 += encabezados1 + '</tr>';
    $('#tablaprueba tbody').append(htmlTags1);
    //});

              //dibujarCuerpo();
   }
   $("#agregar").click(function () {
      // console.log("hola");
        dibujarCabecera();
    });
     /**
  * Funcion para añadir una nueva columna en la tabla
  */
 $("#add").click(function(){
     // Obtenemos el numero de filas (td) que tiene la primera columna
     // (tr) del id "tabla"
    a++;
     totalCampos.val(a);//variable para saber cuantos campos esta mandando
     var tds=$("#tabla tr:first td").length;
     // Obtenemos el total de columnas (tr) del id "tabla"
     var trs=$("#tabla tr").length;
     var nuevaFila="<tr>";
     /*for(var i=0;i<tds;i++){
         // añadimos las columnas
         nuevaFila+="<td>columna "+(i+1)+" Añadida con jquery</td>";
     }*/
     nuevaFila+='<td><select class="form-control tipoSelect"  id="tipoCampo'+a+'" name="tipoCampo[]"><option value="Texto">Texto</option><option value="Numero">Número entero</option><option value="Real">Número decimal</option><option value="Catalogo">Catálogo</option></select></td>';
      nuevaFila+='<td>';
      nuevaFila+='<div id="divo'+a+'"style="display:block"><input class="form-control" id="campo'+a+'" name="campo[]" type="text"/></div>';
      nuevaFila+='<div id="div'+a+'" style="display:none">';
      nuevaFila+='<select  class="form-control" id="cat'+a+'" class="" name="cat[]"><option value="">Seleccionar Catálago</option>';
      nuevaFila+='<?php foreach ($catalogo as $cat): ?>';
      nuevaFila+='<option value="<?php echo $cat['descripcion'] ?>"><?php echo $cat['descripcion'] ?></option>';
      nuevaFila+='<?php endforeach; ?>';
      nuevaFila+='</select>';
      nuevaFila+='</div>';

      nuevaFila+='</td>';
      nuevaFila+='<td><input class="form-control" id="campos'+a+'" name="campos[]" required type="text"/></td>';
      nuevaFila+='<td><button class="btn btn-danger eliminar"><i class="fa fa-trash"></i></button></td>';
     // Añadimos una columna con el numero total de filas.
     // Añadimos uno al total, ya que cuando cargamos los valores para la
     // columna, todavia no esta añadida
     //nuevaFila+="<td>"+(trs+1)+" filas";
     nuevaFila+="</tr>";
     $("#tabla").append(nuevaFila);
     tipoSelect = document.getElementsByClassName('tipoSelect');
      for (var i = tipoSelect.length - 1; i >= 0; i--) {
      tipoSelect[i].addEventListener('change',function(){
        let selected = this.options[this.selectedIndex].value;
        let divs = this.parentNode.parentNode.childNodes[1].childNodes;
        if(selected == "Catalogo")
        { 
          divs[0].style.display = 'none';
          divs[0].childNodes[0].value = '';
          divs[1].style.display = 'block';
        }
        else
        {
          divs[1].style.display = 'none';
          divs[1].childNodes[0].value = '';
          divs[0].style.display = 'block'; 
        }
      });
    }
     //dibujarCabecera();
 });

 /**
  * Funcion para eliminar la ultima columna de la tabla.
  * Si unicamente queda una columna, esta no sera eliminada
  */


 $("#tabla").DataTable({
     "paging": false,
     "lengthChange": false,
     "searching": false,
     "ordering": false,
     "info": false,
     "autoWidth": false,
     "stateSave": false,
     "responsive": true,
     "language": {
         "lengthMenu": "Mostrar _MENU_ registros por p&aacute;gina",
         "search": "Buscar: ",
         "zeroRecords": "No hay registros",
         "info": "Mostrando _START_ de _END_ de un total de _TOTAL_ registros",
         "infoFiltered": "(Fitltrando de un total de _MAX_ registros)",
         "paginate": {
             "first": "Inicio",
             "last": "&Uacte;ltimo",
             "next": "Siguiente",
             "previous": "Anterior"
         },
         "infoEmpty": "Sin Registros",
     },

 });
 $("#tablaprueba").DataTable({
     "paging": true,
     "lengthChange": false,
     "searching": false,
     "ordering": false,
     "info": false,
     "autoWidth": false,
     "stateSave": false,
     "responsive": true,
     "language": {
         "lengthMenu": "Mostrar _MENU_ registros por p&aacute;gina",
         "search": "Buscar: ",
         "zeroRecords": "No hay registros",
         "info": "Mostrando _START_ de _END_ de un total de _TOTAL_ registros",
         "infoFiltered": "(Fitltrando de un total de _MAX_ registros)",
         "paginate": {
             "first": "Inicio",
             "last": "&Uacte;ltimo",
             "next": "Siguiente",
             "previous": "Anterior"
         },
         "infoEmpty": "Sin Registros",
     },

 });

});

$(function() {
  let tipoSelect = document.getElementsByClassName('selectTipo');
  for (var i = tipoSelect.length - 1; i >= 0; i--) {
      let selected = tipoSelect[i].options[tipoSelect[i].selectedIndex].value;
      let divs = tipoSelect[i].parentNode.parentNode.childNodes[3];
      if(selected == "Catalogo")
      {      
        divs.childNodes[1].style.display = 'none';
        divs.childNodes[1].childNodes[0].value = '';
        divs.childNodes[3].style.display = 'block';
      }
      else
      {
        divs.childNodes[1].style.display = 'block';
        divs.childNodes[1].childNodes[0].value = '';
        divs.childNodes[3].style.display = 'none'; 
        divs.childNodes[3].childNodes[1].value = ''; 
      }
  }
  });