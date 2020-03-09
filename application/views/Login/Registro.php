<!DOCTYPE html>
<html>
<head>
	<title>
		Registro de Personal
	</title>
</head>
<body>
	<div class="content-wrapper">
   <section class="content-header">
        <h1 class="titulopag">
            <b>
 				<header>
					<h1 style="color: black">Registro de Presonal</h1>
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
$input_USUARIO_USERNAME=array(
                                'name' => 'USUARIO_USERNAME',
                                'id'=>'USUARIO_USERNAME',
                                'maxlength'=>'125',
                                'class' => 'form-control',
                                'required' => true,

                              );

$input_USUARIO_PASSWORD=array(
                                'name' => 'USUARIO_PASSWORD',
                                'id'=>'USUARIO_PASSWORD',
                                'maxlength'=>'125',
                                'class' => 'form-control',
                                'required' => true,

                              );
$input_USUARIO_EMAIL= array(
                                'name' => 'USUARIO_EMAIL',
                                'id'=>'USUARIO_EMAIL',
                                'maxlength'=>'125',
                                'class' => 'form-control',
                                'required' => true,

                              );

echo form_open(htmlspecialchars('Login/GuardarUsuariobase'), array('method' => 'POST'));
echo form_label('Nombre de usuario');
echo form_input($input_USUARIO_USERNAME);
echo form_label('Ingresa Email');
echo form_input($input_USUARIO_EMAIL);
echo form_label('Contaseña');
echo form_password($input_USUARIO_PASSWORD);
echo "<br>";
echo form_submit('submit', 'Registrar','class=btn btn-default');
echo form_close();
?>
</div>
</section>
</body>
</html>