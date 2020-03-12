<script src='<?=base_url()?>public/js/a076d05399.js'></script>
<div class="wrapper">
      <!---------------HEADER------------------------------------------------------------------------------------->
      <header class="main-header">

          <a class="logo" href="#">
              <img align="left" class="logobuap" src="<?php echo base_url("public/img/logo.png"); ?>" />

          </a>
          <!-- end Logo -->
          <!-- end logo -->
          <!--------------------------------------------CONTRAE EL MENÚ------------>
          <a class="sidebar-toggle" data-toggle="offcanvas" href="#" role="button">
          </a>
          <!-----------------------------------------end CONTRAE EL MENÚ------------>
          <nav class="navbar navbar-static-top" role="navigation">
              <span class="header-wrapper" style="font-size:20pt;color: black;line-height:70px">
                  <span>
                  Sistema de Cobranza del Instituto Técnico de Mexico
                  </span>
              </span>
          </nav>
      </header>
      <aside class="main-sidebar" style="background-color: #222d32">
          <div class="slimScrollDiv">
              <section class="sidebar">
                  <div class="user-panel">
                      <div class="center info" >
                        <br>
                          <img style="display: block;margin-left: auto;margin-right: auto;" id="logohead" alt="User Img" class="logo" src="<?php echo base_url("public/img/user.png"); ?>" , height=50 />
                          <br>

                       <span class="etiqueta-user" style="font-size:9pt;font-weight: bold;">
                            <?php
                               $Nombre=$this->session->userdata('itm')['Nombre'];
                               echo $Nombre;
                             ?>
                          </span>

                      </div>
                  </div>
                  <ul class="sidebar-menu">

                    
                      <li>
                          <a title="" href="<?php echo base_url('Login') ?>">
                              <i class="fas fa-home" aria-hidden="true"></i>
                                    <span>
                                      Inicio
                                    </span>         
                           </a>
                      </li>
                      <?php if ($this->session->userdata('itm')['Rol'] == 2): ?>
                      
                <div class="dropdown">
                <a class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-user-plus" aria-hidden="true"></i>
                        <span>
                            Personal
                        </span>
                    </a>
                    <div class="dropdown-menu">
                    <li>
          		            <a href="<?=base_url(),'Login/Registrodeusuarios'?>">
                              <i class="fa fa-user-plus" aria-hidden="true"></i>
                                    <span>
                                        Registro de personal
                                    </span>
                            </a>
                      </li>
                      <li>
          		            <a href="<?=base_url(),'Cursos/listadeusuarios'?>">
                              <i class="fa fa-user-plus" aria-hidden="true"></i>
                                    <span>
                                        lista de Personal
                                    </span>
                            </a>
                      </li>
                    </div>
                </div>
                      
                    <?php endif ?>
                      <li>
                          <a title="" href="<?php echo base_url('RegistroAlumnos') ?>">
                              <i class="fa fa-user-plus" aria-hidden="true"></i>
                                    <span>
                                      Registro de Alumnos
                                    </span>
                           </a>
                      </li>
                      <?php if ($this->session->userdata('itm')['Rol'] == 2): ?>
                      <li>
                            <a href="<?= base_url('Cursos') ?>">
                                <i class="fas fa-plus" aria-hidden="true"></i>
                                    <span>
                                    Agregar cursos
                                    </span>
                            </a>
                      </li>
                      <?php endif ?>
                      <li>
                          <a title="" href="<?php echo base_url('RegistroAlumnos/Actulizar') ?>">
                              <i class="fa fa-user fa-6" aria-hidden="true"></i>
                                    <span>
                                     Actualizar datos del
                                     Alumno
                                    </span>         
                           </a>
                      </li>
                      <li>
                          <a title="" href="<?php echo base_url('RegistroAlumnos/pagosdeAlumnos') ?>">
                              <i class="fas fa-dollar-sign" aria-hidden="true"></i>
                                    <span>
                                     Colegiaturas e Inscripcion
                                    </span>
                           </a>
                      </li>
                      <li>
                          <a title="" href="<?php echo base_url('Cortes') ?>">
                              <i class="fas fa-money-check" aria-hidden="true"></i>
                                    <span>
                                     Cortes
                                    </span>
                           </a>
                      </li>
                      <li>
                          <a title="" href="<?php echo base_url('Cortes/historialcrediticia') ?>">
                              <i class="fas fa-money-check" aria-hidden="true"></i>
                                    <span>
                                     Historial de cobros
                                    </span>
                           </a>
                      </li>
                      <li>
                          <a title="" href="<?php echo base_url('Productos') ?>">
                              <i class="fab fa-steam-square" aria-hidden="true"></i>
                                    <span>
                                     Registro de productos
                                    </span>
                           </a>
                      </li>
                      <li>
                        <a title="" href="<?= base_url('Login/cerrarsecion')?>">
                            <i class="fa fa-remove" aria-hidden="true"></i>
                            <span>
                                Salir
                            </span>
                        </a>

                      </li>
                  </ul>
              </section>
          </div>
      </aside>
  </div>
