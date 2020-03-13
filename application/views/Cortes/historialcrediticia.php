<!DOCTYPE html>
<html>
<head>
	<title>Historial crediticia</title>
</head>
<body>
<div class="content-wrapper">
   <section class="content-header">
        <h1 class="titulopag">
            <b>
 				<header>
					<h1 style="color: black">Historial crediticio del Alumno</h1>
				</header>
            </b>
        </h1>
    </section>
 	<section class="container-fluid">

<form method="post" action="<?=base_url('/Cortes/historialcrediticia/')?>">
  
       <div class="col-sm-12">
       <h5><label>Ingresar la Matricula del Estudiante</label></h5>	
       	<input type="number" id="Matricula" name="Matricula" class="form-control">
       	<button  class="btn btn-default">buscar </button>
</form>

       	<table id="tabla" class="table table-striped table-bordered" border="1">
       		<thead>
       			<th>Folio</th>
       			<th>Matricula</th>
       			<th>Nombre del alumno</th>
       			<th>Numero de semana pagadas</th>
       			<th>Total de pagaos</th>
       			 <th>Fecha de pago</th>
            <th>Responsable del cobro</th>
       		</thead>
       		<tbody id="tabla_resultados">
       			<?php if (isset($hitoria)): ?>
              <?php if ($hitoria != null): ?>
                <?php foreach ($hitoria as $key): ?>
                  <tr>
                    <td>
                     <?=$key['foliodepagos']?> 
                    </td>
                     <td>
                     <?=$key['iddealumnos_fk']?> 
                    </td>
                    <td>
                     <?=$key['nombre_alumno']?> 
                    </td>
                    <td>
                      <?php $var=$this->Cortesdeldia->colegiaturas($key['foliodepagos']) ;
                        foreach ($var as $colo) {
                          echo $colo['semanaspagadas']."<br>";
                        }
                       ?>
                      
                    </td>
                    <td>
                     <?=$key['totalpago']?> 
                    </td>
                    <td>
                     <?=$key['fechadepago']?> 
                    </td>
                    <td>
                     <?=$key['NOMBRE_PERSONA']?> 
                    </td>

                  </tr>  
                <?php endforeach ?>
                
              <?php endif ?>
              
            <?php endif ?>
       		</tbody>
       	</table>
       </div>

   </section>
</div>
</body>
</html>