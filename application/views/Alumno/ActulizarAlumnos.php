<div class="content-wrapper">
   <section class="content-header">
        <h1 class="titulopag">
            <b>
 				<header>
					<h1 style="color: black">Actulizar datos del Alumno</h1>
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
          	echo form_open(htmlspecialchars('RegistroAlumnos/BuscarAlumno'), array('method' => 'POST'));
          	echo form_label('Matricula');
          	echo form_input($input_MATRICULA);
          	echo "<br>";
          	echo form_submit('submit', 'Buscar','class=btn btn-default');
          	echo form_close();
           ?>
           <?php 
           if (isset($alumno)): ?>
           	<?php 
           	$input_USUARIO_USERNAME=array(
                                'name' => 'USUARIO_USERNAME',
                                'id'=>'USUARIO_USERNAME',
                                'maxlength'=>'125',
                                'class' => 'form-control',
                                'required' => true,
                                'value'=>$alumno['nombre_alumno'], 

                              );

$input_USUARIO_FECHA=array(
                                'name' => 'FECHADENACIMIENTO',
                                'id'=>'FECHADENACIMIENTO',
                                'maxlength'=>'125',
                                'class' => 'form-control',
                                'required' => true,
                                'type'=>'date',
                                'value'=>$alumno['fechadenacimiento_alumno'],

                              );
$input_USUARIO_Tutor= array(
                                'name' => 'NOMBREDELPADRE',
                                'id'=>'NOMBREDELPADRE',
                                'maxlength'=>'125',
                                'class' => 'form-control',
                                'required' => true,
                                'value'=>$alumno['tutorResponsable_alumno'],


                              );
$input_USUARIO_Direccion= array(
                                'name' => 'DIRECCION',
                                'id'=>'DIRECCION',
                                'maxlength'=>'125',
                                'class' => 'form-control',
                                'required' => true,
                                'value'=>$alumno['direccion_alumno'],

                              );
$input_USUARIO_Telefono= array(
                                'name' => 'TELEFONO',
                                'id'=>'TELEFONO',
                                'maxlength'=>'125',
                                'class' => 'form-control',
                                'required' => true,
                                'type'=>'tel',
                                'pattern'=>"[0-9]{10}",
                                'value'=>$alumno['telefono_alumno'],




                              );

$input_USUARIO_Horario= array(
                                'name' => 'HORARIO',
                                'id'=>'HORARIO',
                                'maxlength'=>'125',
                                'class' => 'form-control',
                                'required' => true,
                                'value'=>$alumno['horario_alumno'],
                              );
$input_USUARIO_FECHADEINICIO=array(
                                'name' => 'FECHADEINICIO',
                                'id'=>'FECHADEINICIO',
                                'maxlength'=>'125',
                                'class' => 'form-control',
                                'required' => true,
                                'type'=>'date',
                                'value'=>$alumno['fechadeinicio_alumno'],

                              );
$input_USUARIO_Semana_de_inicio= array(
                                'name' => 'SEMANADEINICIO',
                                'id'=>'SEMANEDEINICIO',
                                'maxlength'=>'125',
                                'class' => 'form-control',
                                'required' => true,
                                'value' =>$alumno['semanadeincio'],
                            );
$input_USUARIO_colegiatura= array(
                                'name' => 'colegiatura',
                                'id'=>'colegiatura',
                                'maxlength'=>'125',
                                'class' => 'form-control',
                                'required' => true,
                                'value' =>$alumno['colegiatura_alumno'],
                            );
$input_USUARIO_Inscripción= array(
                                'name' => 'Inscripción',
                                'id'=>'Inscripción',
                                'maxlength'=>'125',
                                'class' => 'form-control',
                                'required' => true,
                                'value' =>$alumno['incripcion_alumno'],
                            );
$input_USUARIO_Curso= array(
                                'name' => 'Curso',
                                'id'=>'Curso',
                                'maxlength'=>'125',
                                'class' => 'form-control',
                                'required' => true,
                                'value' =>$alumno['curso_alumno'],
                            );

$options = array(
        'Curso de verano'   => 'Curso de verano',
        'Autocad'           => 'Autocad',
        'Esp.Diseño Grafico'=> 'Esp.Diseño Grafico',
        'Esp.Asitente de Negocios con informatica'=> 'Esp.Asitente de Negocios con informatica',
        'Dip.Robotica'     => 'Dip.Robotica',
        'Esp.Robotica'     => 'Esp.Robotica',
        'Curso Infantil'   => 'Curso Infantil',
        'Curso de Matematicas' => 'Curso de Matematicas',
        'Esp. Ingles'           => 'Esp. Ingles',
        'Taekwondo'           => 'Taekwondo',
        'Curso Basico'           => 'Curso Basico',
        'Otro Curso'           => 'Otro Curso',
);

echo form_open(htmlspecialchars('RegistroAlumnos/Actulizardatos').'/'.base64_encode($matricula), array('method' => 'POST'));
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
echo form_input($input_USUARIO_Curso);
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
echo form_submit('submit', 'Actulizar','class=btn btn-default');
echo form_close();
?>
<?php endif ?>
</div>
</section>
</div>