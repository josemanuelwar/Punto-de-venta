
  <?php if($this->session->flashdata('alertaError') && $this->session->flashdata('alertaError')!=""): ?>
  <div id="divError" class="alert alert-custom alert-dismissible fade in" name="alert" style="display:flex;">
    <div class="col-xs-12">
      <div class="pull-right-alert">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
      </div>
      <div class="pull-left-alert">
          <img src="<?php echo base_url('public/imagenes/iconos/icono_error.png');?>" />
            <span id="valido" style="color:black;">
                <?php echo $this->session->flashdata('alertaError');?>
            </span>
      </div>
      </div>
  </div>

  <script> setTimeout(function(){ document.getElementById('divError').style.display = "none";}, 5000); </script>


<?php else: ?>
  <?php if($this->session->flashdata('alertaExito')&& $this->session->flashdata('alertaExito')!=""): ?>
    <div id="divExito" class="alert alert-custom alert-dismissible fade in"  name="alert" style="display:flex;">
      <div class="col-xs-12">
        <div class="pull-right-alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        </div>
        <div class="pull-left-alert">
            <img src="<?php echo base_url('public/imagenes/iconos/success-icon-ind.png');?>" />
            <span style="color:black;">
                <?php echo $this->session->flashdata('alertaExito');?>
            </span>
        </div>
        </div>
      </div>
    <script> setTimeout(function(){ document.getElementById('divExito').style.display = "none";}, 4000); </script>

  <?php endif; ?>
<?php endif; ?>
