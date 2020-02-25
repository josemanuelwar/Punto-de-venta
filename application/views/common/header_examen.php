<!DOCTYPE html>
<html lang="es" style="position: relative;min-height: 100%;">
    <head>
        <meta content="”0;url=http://www.google.com/”" http-equiv="”refresh”">
            <meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
            <meta content="IE=edge" http-equiv="X-UA-Compatible">
                <meta content="width=device-width, initial-scale=1.0" name="viewport">
                    <meta content="" name="description">
                        <meta content="" name="author">
                            <title>
                            </title>
                            <!-- Bootstrap core CSS -->
                            <link href="<?php echo base_url('/public/templates/default/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet">
                                <!-- CSS Implementing Plugins -->
                                <link href="<?php echo base_url('/public/templates/default/custom/css/flexslider.css');?>" media="screen" rel="stylesheet" type="text/css">
                                    <link href="<?php echo base_url('/public/templates/default/custom/css/parallax-slider.css');?>" rel="stylesheet" type="text/css">
                                        <link href="<?php echo base_url('/public/templates/default/custom/css/font-awesome.css')?>" rel="stylesheet" type="text/css">
                                            <!-- Custom styles for this template -->
                                            <link href="<?php echo base_url('/public/templates/default/custom/css/business-plate.css')?>" rel="stylesheet">
                                                <!-- JS Global Compulsory -->
                                                <script src="<?php echo base_url('/public/templates/default/custom/js/jquery-1.8.2.min.js');?>" type="text/javascript">
                                                </script>
                                                <script src="<?php echo base_url('/public/templates/default/custom/js/modernizr.custom.js');?>" type="text/javascript">
                                                </script>
                                                <script src="<?php echo base_url('/public/templates/default/bootstrap/js/bootstrap.min.js');?>" type="text/javascript">
                                                </script>
                                                <!-- JS Implementing Plugins -->
                                                <script src="<?php echo base_url('/public/templates/default/custom/js/jquery.flexslider-min.js');?>" type="text/javascript">
                                                </script>
                                                <script src="<?php echo base_url('/public/templates/default/custom/js/modernizr.js');?>" type="text/javascript">
                                                </script>
                                                <script src="<?php echo base_url('/public/templates/default/custom/js/jquery.cslider.js');?>" type="text/javascript">
                                                </script>
                                                <script src="<?php echo base_url('/public/templates/default/custom/js/back-to-top.js');?>" type="text/javascript">
                                                </script>
                                                <script src="<?php echo base_url('/public/templates/default/custom/js/jquery.sticky.js');?>" type="text/javascript">
                                                </script>
                                                <!-- JS Page Level -->
                                                <script src="<?php echo base_url('/public/templates/default/custom/js/app.js');?>" type="text/javascript">
                                                </script>
                                                <script src="<?php echo base_url('/public/templates/default/custom/js/index.js');?>" type="text/javascript">
                                                </script>
                                                <style>
                                                    #suggestDiv {border: 1px solid #003046; visibility:hidden; text-align: left;  white-space: nowrap; background-color: #eeeeee;}
  .suggestions { font-size: 14;background-color: #eeeeee;  }
  .suggestionMouseOver { font-size: 14;background: #003046; color: white;  }
                                                </style>
                                            </link>
                                        </link>
                                    </link>
                                </link>
                            </link>
                        </meta>
                    </meta>
                </meta>
            </meta>
        </meta>
    </head>
    <body style="margin: 0 0 150px;padding: 0 !important;">
        <div class="top">
            <div class="container" style="width: 100% !important;
    padding: 0 !important;">
                <div class="row-fluid">
                    <ul class="loginbar">
                    </ul>
                </div>
            </div>
        </div>
        <div class="topHeaderSection">
            <div class="header">
                <div class="container">
                    <div class="navbar-header col-md-11 col-sm-12" style="display: flex;flex-direction: row;justify-content: space-around;">
                        <a class="navbar-brand">
                            <img alt="Benemérita Universidad Autónoma de Puebla" src="<?php echo base_url('/public/imagenes/logos/buap_logo.png');?>" style="height: 60px;" title="Benemérita Universidad Autónoma de Puebla"/>
                        </a>
                        <h1 style="color: black;">
                            <?php $area=$this->Areatem->area($this->session->userdata('examen')['id']);
                            ?>
                            <center><h1 style="color: black;"><?= $area[0]['AREA_NOMBRE']?></h1></center>
                            
                        </h1>
                        <div style="text-align: center;">
	                        <h5 style="color: black;margin-bottom: 2px;">
	                        	Minutos transcurridos
	                        </h5>
	                        <div style="border-style: solid;">
		                        <span style="font-size: 20pt; color: red;">
		                        	00:00
		                        </span>
	                        	
	                        </div>
                        </div>
                    </div>
                    <div class="navbar-collapse collapse">
                        <ul class="nav navbar-nav">
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                        </ul>
                    </div>
                    <!--/.nav-collapse -->
                </div>
            </div>
        </div>
    </body>
</html>