<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Lista de usuarios</title>
</head>
<body>
<div class="content-wrapper">
   <section class="content-header">
        <h1 class="titulopag">
            <b>
 				Lista de personal
            </b>
        </h1>
    </section>
    <section class="container-fluid">
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
           <table class="table table-striped table-bordered">
                    <thead>
                        <th>Nombre de Curso</th>
                        <th>Acciones</th>
                    </thead>
                    <tbody>
                    <?php if(isset($usuario)):?>
                        <?php if($usuario != null):?>
                            <?php foreach ($usuario as $key => $value):?>
                            <tr>
                                <td><?=$value['NOMBRE_PERSONA']?></td>
                                <td>
                                    <a href=""class="btn btn-danger"><i class="fa fa-trash-o"></i></a>
                                    <a href="<?=base_url('Cursos/listadeusuarios/').$value["PERSONAL_ID"]?>" class="btn btn-primary">Editar</a>
                                </td>
                            </tr>
                            <?php endforeach?>
                        <?php endif?>
                    <?php endif?>
                    </tbody>
            </table>
        <?php if(isset($usser)):?>
            <?php if($usser != null):?>
                <form action="<?=base_url('Cursos/Actulizarusuario/').$id?>" method="post">
                <label for="">Nombre</label>
                <input type="text" name="nombre" value="<?=$usser[0]['NOMBRE_PERSONA']?>" class="form-control" required>
                <label for="">Correo</label>
                <input type="email" name="correo" value="<?=$usser[0]['CORREO_PERSONA']?>" class="form-control" required>
                <label for="">contraseña</label>
                <input type="password" name="contraseña" class="form-control">
                <input type="submit"  value="Guardar" class="btn btn-default">
                </form>
            <?php endif?>
        <?php endif?>
</div>
</section>
</div>
</body>
</html>