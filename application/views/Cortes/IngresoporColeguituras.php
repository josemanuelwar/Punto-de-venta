<div class="content-wrapper">
   <section class="content-header">
        <h1 class="titulopag">
            <b>
 				<header>
					<h1 style="color: black">Ingresos</h1>
				</header>
            </b>
        </h1>
    </section>
<section class="container-fluid">
        <p>&nbsp;</p>
<div class="col-sm-12">

        <?php 
          $input_fecha=array(
                                'name' => 'fecha',
                                'id'=>'fecha',
                                'maxlength'=>'125',
                                'class' => 'form-control',
                                'required' => true,
                                'type' => 'date',  

                              );
            echo form_open(htmlspecialchars('Cortes/cortefecha'), array('method' => 'POST'));
            echo form_label('Fecha del corte');
            echo form_input($input_fecha);
            echo "<br>";
            echo form_submit('submit', 'Buscar','class=btn btn-default');
            echo form_close();
           ?>
            <?php 
          $input_numerosemana=array(
                                'name' => 'numerosemana',
                                'id'=>'numerosemana',
                                'maxlength'=>'125',
                                'class' => 'form-control',
                                'required' => true,
                                'type' => 'number',  

                              );
            echo form_open(htmlspecialchars('Cortes/numerodesemana'), array('method' => 'POST'));
            echo form_label('Numero de semana de corte');
            echo form_input($input_numerosemana);
            echo "<br>";
            echo form_submit('submit', 'Buscar','class=btn btn-default');
            echo form_close();
           ?>
           <?php if ($this->session->userdata('itm')['Rol'] == 2): ?>
            <?php if (isset($fecha)): ?>
                  <?php $f=$fecha; ?>
              <?php else: ?>
                <?php $f=1; ?>
            <?php endif ?>
            <?php if (isset($numero)): ?>
                  <?php $n=$numero; ?>
                <?php else: ?>
                  <?php $n="";?>
            <?php endif ?>
                <a href="<?= base_url('RegistroAlumnos/generarexelfecha/').$f.'/'.$n?>" class="btn btn-success"  >Exportar Exel por Fecha</a>
               
              <?php endif ?>
   <table id="tabla" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Folio</th>
                <th>Matricula</th>
                <th>Nombre del alumno</th>
                <th>Numero de semana pagada</th>
                <th>Inscripcion</th>
                <th>Colegitura</th>
                <th>Fecha de pago</th>
                <th>Responzable del cobro</th>
                <?php if ($this->session->userdata('itm')['Rol'] == 2): ?>
                <th>Acciones</th>
              <?php endif ?>
            </tr>
        </thead>
        <?php 
        
        if (isset($cortes)): ?>
            
            <tbody>
                <?php foreach ($cortes as $key ): ?>
                    <?php if ($key['Eliminarpagos'] != 1): ?>
                        
                        <td><?=$key['foliodepagos']?></td>
                        <td><?=$key['id_alumno']?></td>
                        <td><?=$key['nombre_alumno']?></td>
                        
                        <td><?=$key['ultimasemanadepago']?></td>
                        <?php if ($key['incripcionpago']==null): ?>
                            <td>pagado</td>
                         <?php else: ?>
                           <td> <?=$key['incripcionpago']?></td>
                        <?php endif ?>
                        <td><?=$key['colegiaturapago']?></td>
                        <td><?=$key['fechadepago']?></td>
                        <td><?=$key['NOMBRE_PERSONA']?></td>
                        <td>
                          <?php if ($this->session->userdata('itm')['Rol'] == 2): ?>
                            <button class="btn btn-danger" onclick="canselar(<?=$key['foliodepagos']?>)" id="canselar<?=$key['foliodepagos']?>">Canselar </button>
                          <?php endif ?>
                    <?php endif ?>
                    <tr>
                        </td>
                    </tr>
                    
                <?php endforeach ?>
            </tbody>
        <?php endif ?>
    </table>
    <label>Total</label>
    <?php if (isset($Total)): ?>
        <?php if ($Total!=null): ?>
            <?=$Total[0]['SUM(totalpago)']?>
        <?php endif ?>
    <?php endif ?>
</div>
</section>	
<script type="text/javascript">
    
    function canselar(argument) {
        var mensaje;
        var opcion = confirm("Esta seguro de eliminar el folio pulse Aceptar si no precione  Cancelar");

        if (opcion == true) {
                
                    $.ajax({
                         cache:false,
                         dataType:"json",
                         type: 'POST',
                         url:'<?php echo base_url('/Cortes/canselar/') ?>',
                         data:{id_folio:argument},
                         success:function(hola){
                          
                          if (hola=1) {
                            console.log("eliminado con exito");
                           
                            location.reload();

                          }else{
                            console.log('ocurrio un erro al eliminar el folio');
                            
                          }

                         },
                         error:function(objXMLHttpRequest){

                         }
                     });
            } else {
                mensaje = "Has clickado Cancelar";
                console.log(mensaje);
            }

    }

function exportarexelfecha(){

  var fech= document.getElementById("fecha").value; 

  var mensaje;
        var opcion = confirm("Esta seguro de eliminar el folio pulse Aceptar si no precione  Cancelar");

        if (opcion == true) {
                
                    $.ajax({
                         cache:false,
                         dataType:"json",
                         type: 'POST',
                         url:'<?php echo base_url('/RegistroAlumnos/generarexelfecha/') ?>',
                         data:{fecha:fech},
                         success:function(hola){
                          
                          if (hola=1) {
                            console.log("eliminado con exito");
                           
                            location.reload();

                          }else{
                            console.log('ocurrio un erro al eliminar el folio');
                            
                          }

                         },
                         error:function(objXMLHttpRequest){

                         }
                     });
            } else {
                mensaje = "Has clickado Cancelar";
                console.log(mensaje);
            }
}

</script>