<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Agregar Cursos</title>
</head>
<body>
<div class="content-wrapper">
   <section class="content-header">
        <h1 class="titulopag">
            <b>
 				Agregar Cursos
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
           <form action="<?=base_url('Cursos/GuardarCursos')?>" method="post">
           <label for="">Nombre del Curso</label>
           <input type="text" name="Cursos" class="form-control" required>
           <label for=""> Fecha de Creacion</label>
           <input type="date" class="form-control" name="fecha_creasion" required>
           <input type="submit" value="Agragar" class="btn btn-default">
           </form>
           <table class="table table-striped table-bordered">
                    <thead>
                        <th>Nombre de Curso</th>
                        <th>Fecha de Creasion</th>
                        <th>Acciones</th>
                    </thead>
                    <tbody>
                        <?php if (isset($Cursos)):?>
                            <?php if ($Cursos != null):?>
                                <?php foreach ($Cursos as $key => $value) :?>
                                    <tr>
                                        <td>
                                            <div id="texto<?=$value['ID_CURSO']?>">
                                                <?=$value["NOMBRE_CURSO"]?>
                                            </div>
                                            <input style="display:none" type="text" id="<?=$value['ID_CURSO']?>" value="<?=$value["NOMBRE_CURSO"]?>">
                                        </td>
                                        <td><?=$value["FECHEDECRACIONCURSO"]?></td>
                                        <td>
                                            <a id="eliminar<?=$value['ID_CURSO']?>" href="<?=base_url('Cursos/Eliminar_curso/').$value["ID_CURSO"]?>" class="btn btn-danger"><i class="fa fa-trash-o"></i></a>
                                            <button id="editar<?=$value['ID_CURSO']?>" class="btn btn-primary" onclick="Editar(<?=$value['ID_CURSO']?>);">Editar</button>
                                            <button id="guardar<?=$value['ID_CURSO']?>" style="display:none" class="btn btn-primary" onclick="guardar(<?=$value['ID_CURSO']?>);" ><i class="fa fa-refresh"></i> Actulizar</button>
                                        </td>
                                    </tr>
                                <?php endforeach?>
                            <?php endif?>
                        <?php endif?>
                    </tbody>
            </table>
</div>
</section>
</div>
</body>
</html>
<script>
function Editar(params) {
    document.getElementById('texto'+params).style.display='none';
    document.getElementById(params).style.display='block';
    document.getElementById('eliminar'+params).style.display='none';
    document.getElementById('editar'+params).style.display='none';
    document.getElementById('guardar'+params).style.display='block';
}
function guardar(params) {
    var curso=document.getElementById(params).value;
    var id_curso=params;
    $.ajax({
     cache:false,
     dataType:"html",
     type: 'POST',
     url:'<?php echo base_url('/Cursos/Actulizar/') ?>',
     data:{id_curso:id_curso,curso:curso},
     success:function(hola){
      console.log(hola);
      location.reload();
     },
     error:function(objXMLHttpRequest){

     }
     });

}
</script>