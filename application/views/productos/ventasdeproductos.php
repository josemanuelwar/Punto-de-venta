<!DOCTYPE html>
<html>
<head>
	<title>Ventas</title>
</head>
<body>
<div class="content-wrapper">
   <section class="content-header">
        <h1 class="titulopag">
            <b>
 				Venta de productos
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

        	
        <form method="post" action="<?= base_url('Productos/ventaproduc')?>">
        	<select name="productos" class="form-control">
        		<option>Selecione un producto</option>
        		<?php if (isset($producto)): ?>
        			<?php if ($producto!=null): ?>
		        		
		        		<?php foreach ($producto as $key ): ?>
		        			<option value="<?=$key->producto_id?>" ><?=$key->nombredelproducto?></option>
		        		<?php endforeach ?>
        				
        			<?php endif ?>
        			
        		<?php endif ?>
        	</select>
        	<label>Numero de producto a vender</label>
        	<input type="number" name="numero" required class="form-control">
        	<button class="btn btn-success"> Vender</button>
        </form>
        <table class="table table-striped table-bordered">
        	<thead>
        		<th>Folio</th>
        		<th>Nombre del producto</th>
        		<th>Cantidad</th>
        		<th>Total</th>
        		<TH>Fecha</TH>
        		<TH>Responsable de venta</TH>
        		<th>Acciones</th>

        	</thead>
               <tbody>
        	
        	<?php if (isset($ventas)): ?>
        		<?php if ($ventas!=null): ?>
		        	<?php foreach ($ventas as  $value): ?>
		        		
		        			<?php if ($value["Eliminarproducto"]!=1): ?>
		        				<tr>
				        			<td>
				        				<?=$value["id_folioregistroventa"]?>
				        			</td>
				        			<td>
				        				<?=$value["nombredelproducto"]?>
				        			</td>
				        			<td>
				        				<?=$value["cantidadproducto"]?>	
				        			</td>
				        			<td>
				        				<?=$value["totaldeventas"]?>	
				        			</td>
				        			<td>
				        				<?=$value["fechadeventa"]?>
				        			</td>
				        			<td>
				        				<?=$value["NOMBRE_PERSONA"]?>
				        			</td>
				        			<td>
				        				<button class="btn btn-danger" onclick="Canselar(<?=$value["id_folioregistroventa"]?>);">Canselar</button>
				        			</td>
		        				</tr>
		        			<?php endif ?>
		        		
		        	<?php endforeach ?>
        		<?php endif ?>
        	<?php endif ?>
        </tbody>
      </table>

        </div>
    </section>
</body>
</html>
<script type="text/javascript">
	function Canselar(argument) {
		console.log(argument);
		var mensaje;
        var opcion = confirm("Esta seguro de eliminar el folio pulse Aceptar si no precione  Cancelar");

        if (opcion == true) {
                
                    $.ajax({
                         cache:false,
                         dataType:"json",
                         type: 'POST',
                         url:'<?php echo base_url('/Productos/canselaraxaj/') ?>',
                         data:{id_folio:argument},
                         success:function(hola){
                          
                          if (hola=1) {
                            console.log("eliminado con exito");
                           
                            //location.reload();

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