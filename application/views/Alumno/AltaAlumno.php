<!DOCTYPE html>
<html>
<head>
	<title>Alta de Alumnos</title>
</head>
<body>
<div class="content-wrapper">
   <section class="content-header">
        <h1 class="titulopag">
            <b>
 				<header>
					<h1 style="color: black">Registro Alumnos</h1>
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

           <div style="float:right; border-style: solid; border-color:red; ">
            <h5 style="float:left;">Matricula :                 <?php  $var=$this->Alumno->Matricula();
                        echo $var['id_alumno']+1;
                ?>
                </h5>

            </div>
            <br>

           <?php  
$input_USUARIO_USERNAME=array(
                                'name' => 'USUARIO_USERNAME',
                                'id'=>'USUARIO_USERNAME',
                                'maxlength'=>'125',
                                'class' => 'form-control',
                                'required' => true,
                                'placeholder'=>"SANCHEZ VASQUEZ JOSE JUAN", 

                              );

$input_USUARIO_FECHA=array(
                                'name' => 'FECHADENACIMIENTO',
                                'id'=>'FECHADENACIMIENTO',
                                'maxlength'=>'125',
                                'class' => 'form-control',
                                'required' => true,
                                'type'=>'date',

                              );
$input_USUARIO_Tutor= array(
                                'name' => 'NOMBREDELPADRE',
                                'id'=>'NOMBREDELPADRE',
                                'maxlength'=>'125',
                                'class' => 'form-control',
                                'required' => true,
                                'placeholder'=>"Sanchez Vasquez Jose Juan",

                              );
$input_USUARIO_Direccion= array(
                                'name' => 'DIRECCION',
                                'id'=>'DIRECCION',
                                'maxlength'=>'125',
                                'class' => 'form-control',
                                'required' => true,
                                'placeholder'=>"14 SUR",

                              );
$input_USUARIO_Telefono= array(
                                'name' => 'TELEFONO',
                                'id'=>'TELEFONO',
                                'maxlength'=>'125',
                                'class' => 'form-control',
                                'required' => true,
                                'type'=>'tel',
                                'pattern'=>"[0-9]{10}",
                                'placeholder'=>"55-45-12-34-12",


                              );

$input_USUARIO_Horario= array(
                                'name' => 'HORARIO',
                                'id'=>'HORARIO',
                                'maxlength'=>'125',
                                'class' => 'form-control',
                                'required' => true,
                                'placeholder'=>"10:00 A 11:00",
                              );
$input_USUARIO_FECHADEINICIO=array(
                                'name' => 'FECHADEINICIO',
                                'id'=>'FECHADEINICIO',
                                'maxlength'=>'125',
                                'class' => 'form-control',
                                'required' => true,
                                'type'=>'date',

                              );
$input_USUARIO_Semana_de_inicio= array(
                                'name' => 'SEMANADEINICIO',
                                'id'=>'SEMANEDEINICIO',
                                'maxlength'=>'125',
                                'class' => 'form-control',
                                'required' => true,
                                'placeholder'=>"30",
                            );
$input_USUARIO_colegiatura= array(
                                'name' => 'colegiatura',
                                'id'=>'colegiatura',
                                'maxlength'=>'125',
                                'class' => 'form-control',
                                'required' => true,
                                 'placeholder'=>"129",
                            );
$input_USUARIO_Inscripción= array(
                                'name' => 'Inscripción',
                                'id'=>'Inscripción',
                                'maxlength'=>'125',
                                'class' => 'form-control',
                                'required' => true,
                                 'placeholder'=>"500",
                            );

echo form_open(htmlspecialchars('RegistroAlumnos/RegistraAlumnos'), array('method' => 'POST'));
echo form_label('Nombre');
echo form_input($input_USUARIO_USERNAME);
echo form_label('Fecha de Nacimiento');
echo form_input($input_USUARIO_FECHA);
echo form_label('Tutor Responsable');
echo form_input($input_USUARIO_Tutor);
echo form_label('Direccion');
echo form_input($input_USUARIO_Direccion);
echo form_label('Telefono');
echo form_input($input_USUARIO_Telefono);
echo form_label('Cursos');
?>
<select name="Cursos" id="Cursos" class=form-control>
<?php foreach ($cursos as $key => $value):?>
<option value="<?=$value['NOMBRE_CURSO']?>"><?=$value['NOMBRE_CURSO']?></option>
<?php endforeach ?>
</select>
<?php
echo form_label('Horario y dia');
echo form_input($input_USUARIO_Horario);
echo form_label('Fecha de Inicio');
echo form_input($input_USUARIO_FECHADEINICIO);
echo form_label('Semana de  inicio');
echo form_input($input_USUARIO_Semana_de_inicio);
echo form_label('Colegiatura');
echo form_input($input_USUARIO_colegiatura);
echo form_label('Inscripción');
echo form_input($input_USUARIO_Inscripción);
echo "<br>";
echo form_submit('submit', 'Registrar','class=btn btn-default');
echo form_close();
?>
</div>
</section>
</body>
</html>