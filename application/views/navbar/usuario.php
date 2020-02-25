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
                  Sistema de Cobranza del Instituto Tecnologico de Mexico
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
                              <i class="fa fa-user fa-6" aria-hidden="true"></i>
                                    <span>
                                      Home
                                    </span>         
                           </a>
                      </li>
                      <li>
                          <a title="" href="<?php echo base_url('RegistroAlumnos') ?>">
                              <i class="fa fa-user fa-6" aria-hidden="true"></i>
                                    <span>
                                      Registro de Alumnos
                                    </span>         
                           </a>
                      </li>
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
                              <i class="fa fa-user fa-6" aria-hidden="true"></i>
                                    <span>
                                     Colegituras e Inscripcion
                                    </span>         
                           </a>
                      </li>
                      <li>
                          <a title="" href="<?php echo base_url('Cortes') ?>">
                              <i class="fa fa-user fa-6" aria-hidden="true"></i>
                                    <span>
                                     Cortes
                                    </span>         
                           </a>
                      </li>
                      <li>
                          <a title="" href="<?php echo base_url('Cortes/historialcrediticia') ?>">
                              <i class="fa fa-user fa-6" aria-hidden="true"></i>
                                    <span>
                                     Historial de cobros
                                    </span>         
                           </a>
                      </li>
                      <li>
                          <a title="" href="<?php echo base_url('Productos') ?>">
                              <i class="fa fa-user fa-6" aria-hidden="true"></i>
                                    <span>
                                     Registro de productos
                                    </span>         
                           </a>
                      </li>
                      <li>
                        <a title="" href="<?= base_url('Login/cerrarsecion')?>">
                            <i class="fa fa-sign-out fa-6" aria-hidden="true"></i>
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
