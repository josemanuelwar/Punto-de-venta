<div class="content-wrapper">
   <section class="content-header">
        <h1 class="titulopag">
            <b>
 				<header>
					<h1 style="color: black">Pagos de Colegiaturas e Inscripcion</h1>
				</header>
            </b>
        </h1>
    </section>
    <section class="container-fluid">
        <p>&nbsp;</p>

        <div class="col-sm-12">	

<?php if($this->session->flashdata('error')): ?>
                <div class="alert alert-custom alert-dismissible fade in" id="alert" name="alert">
                  <div class="col-xs-12">
                    <div class="pull-right-alert">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    </div>
                    <div class="pull-left-alert">
                        <img src="<?php echo base_url('public/imagenes/iconos/icono_error.png');?>" />
                        <span class="msjalerta">
                            <span class='alerterror'>
                              <?php echo $this->session->flashdata('error');?>
                            </span>

                        </span>
                    </div>
                    </div>
                </div>

             <?php else: ?>
                 <?php if($this->session->flashdata('ok')): ?>
                   <div class="alert alert-custom alert-dismissible fade in" id="alert" name="alert">
                     <div class="col-xs-12">
                       <div class="pull-right-alert">
                           <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                       </div>
                       <div class="pull-left-alert">
                           <img src="<?php echo base_url('public/imagenes/iconos/success-icon-ind.png');?>" />
                           <span class="msjalerta">
                               <span class='alerterror'>
                                 <?php echo $this->session->flashdata('ok');?>
                               </span>

                          </span>
                        </div>
                      </div>
                  </div>

                <?php endif; ?>
          <?php endif; ?>
          <?php
          $input_MATRICULA=array(
                                'name' => 'Matricula',
                                'id'=>'Matricula',
                                'maxlength'=>'125',
                                'class' => 'form-control',
                                'required' => true,
                                'placeholder'=>"1",

                              );
          	echo form_open(htmlspecialchars('RegistroAlumnos/buscardeuda'), array('method' => 'POST'));
          	echo form_label('Matricula');
          	echo form_input($input_MATRICULA);
          	echo "<br>";
          	echo form_submit('submit', 'Buscar','class=btn btn-default');
          	echo form_close();
           ?>
           <?php
           if (isset($alumno)):?>
           		<?php if ($alumno['incripcion_alumno'] != 0 ): ?>
			         <h5><label>Nombre del Alumno:</label></h5>
					<input class="form-control" id="Nombre" type="text" name="Nombre" readonly="readonly" placeholder="juan" value="<?=$alumno['nombre_alumno']?>">
		           <h4>Adeudos</h4>
		           <h5><label>Inscripción</label></h5>
				    <input class="form-control" type="text" name="Incripcion" id="Incripcion" readonly="readonly" value="<?=$alumno['incripcion_alumno']?>">
				    <h5><label>Colegiatura</label></h5>
				    <input class="form-control" type="text" name="Coleguiatura" id="Coleguiatura" readonly="readonly" value="<?=$alumno['colegiatura_alumno']?>">
				    <h4>A Cuenta</h4>
           <?php
           	$input_Incripcion=array(
                                'name' => 'Inscripcion',
                                'id'=>'Inscripcion',
                                'maxlength'=>'125',
                                'class' => 'form-control',
                                'required' => true,
                                'placeholder'=>"500",

                              );
           	$input_Colegitura=array(
                                'name' => 'Colegitura',
                                'id'=>'Colegitura',
                                'maxlength'=>'125',
                                'class' => 'form-control',
                                'required' => true,
                                'placeholder'=>"129",

                              );
           	echo form_open(htmlspecialchars('RegistroAlumnos/pagarincricolegitura').'/'.base64_encode($alumno['id_alumno']), array('method' => 'POST'));
           	echo form_label("Incripcion");
           	echo form_input($input_Incripcion);
           	echo form_label("Colegitura");
           	echo form_input($input_Colegitura);
           	echo form_submit('submit', 'pagar','class=btn btn-default');
          	echo form_close();
            ?>
          <?php endif ?>
          <?php if ($alumno['incripcion_alumno']==0): ?>
          	<?php if (isset($semanas)): ?>
          		<?php if ($semanas!=null): ?>
          			
          			<h5><label>Nombre del Alumno:</label></h5>
					<input class="form-control" id="Nombre" type="text" name="Nombre" readonly="readonly" placeholder="juan" value="<?=$alumno['nombre_alumno']?>">
		           <h4>Adeudos</h4>
		           <h5><label>Inscripción</label></h5>
				    <input class="form-control" style="background: red; color: pink ;" type="text" name="Incripcion" id="Incripcion" readonly="readonly" value="pagado">
				    <h5><label>Colegiatura</label></h5>
				    <input class="form-control" style="background: red; color: pink ;" type="text" name="Coleguiatura" id="Coleguiatura" readonly="readonly" value="Numero de Semana N°<?=$semanas['ultimasemanadepago']?>">
            <h5><label>Feche de pago</label></h5>
            <input class="form-control" type="text" name=""  readonly="readonly"value="<?=$semanas['fechadepago']?>">
				    <?php 
				    		$input_Adelantar=array(
                                'name' => 'Adelantar',
                                'id'=>'Adelantar',
                                'maxlength'=>'125',
                                'class' => 'form-control',
                                'required' => true,
                                'placeholder'=>"1",

                              );
				    echo form_open(htmlspecialchars('RegistroAlumnos/adelantarcolegitura').'/'.base64_encode($alumno['id_alumno']), array('method' => 'POST', 'id' => 'myForm'));
				    echo form_label("Numeros de semanas a pagar");
          	echo form_input($input_Adelantar);
?>
				     <button type="button" class="btn btn-success" onclick="myFunction();">Cobrar</button>
				     <button type="button" id="Formul" class="btn btn-primary" onclick="formularia();"style="margin:5px; float:
right">Condonacion</button>
             <?php echo form_close(); ?>
              <div id="condenacion" style="display:none">
             <label for="">Contraseña</label>
             <input type="password" id="contrasena">
             <button onclick="verificacion();" class="btn btn-warning">Continuar</button>
             <button type="button" id="canselar" onclick="canselar();" class="btn btn-danger">Canselar</button>
             </div>
          		<?php endif ?>
          	<?php endif ?>
          <?php endif ?>
        <?php endif ?>
       </div>
       <div id="formulario" style="display:none">
           <?php echo form_open(htmlspecialchars('RegistroAlumnos/condonar').'/'.base64_encode($alumno['id_alumno']), array('method' => 'POST')); ?>
            <label for="">Ingresa numero de semana a Condonar</label>
            <input type="text" name="Semana" class="form-control">
            <label for=""> Motivo de la condonacio</label>
            <textarea name="Descripcion" id="" cols="30" rows="10"class="form-control"></textarea>
            <input type="submit" value="Enviar" class="btn btn-success">
            </form>
       </div>
   </section>
</div>
<script type="text/javascript">
function myFunction() {
 	var mensaje;
    var opcion = confirm("Esta seguro de su datos estan correctos precione Aceptar si no precione  Cancelar");

if (opcion == true) {
        document.getElementById("myForm").submit();
	} else {
	    mensaje = "Has clickado Cancelar";
	}
}
function formularia() {
  document.getElementById('condenacion').style.display="block";
  document.getElementById('Formul').style.display="none";
}
function verificacion() {
  const passwor = document.getElementById('contrasena').value;
  if(passwor == '123'){
    document.getElementById('formulario').style.display="block";
    document.getElementById('condenacion').style.display="none";
  }else{
    document.getElementById('contrasena').value="";
  }
}
function canselar() {
  document.getElementById('condenacion').style.display="none";
  document.getElementById('Formul').style.display="block";
}
</script>