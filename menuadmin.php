--//*<?php
      header('Content-Type: text/html; charset=UTF-8');
      ?>
<!DOCTYPE html>
<html lang="es">
<meta charset="utf-8">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/x-icon" href="IMAGENES/hospital2.ico">
  <title>SysPediatría</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

  <style>
    hr.solid {
      border-top: 1px solid #0d0d0d;
    }

    [class*=sidebar-dark-] .sidebar a {
      color: black;
    }

    .brand-link {
      background: linear-gradient(to right, #E8A9F7, #e4e5dc);
      color: black;
    }

    .os-content {
      background: linear-gradient(to right, #E8A9F7, #e4e5dc);
      color: black;
      font-size: 18px;
    }

    .os-viewport {
      background: linear-gradient(to right, #E8A9F7, #e4e5dc);
      color: black;
    }

    .content-header {
      background: linear-gradient(to right, #E8A9F7, #e4e5dc);
    }

    .navbar-white {
      background: linear-gradient(to right, #E8A9F7, #e4e5dc);
    }

    [class*=sidebar-dark-] .nav-treeview>.nav-item>.nav-link {
      color: black;
    }

    [class*=sidebar-dark] .btn-sidebar,
    [class*=sidebar-dark] .form-control-sidebar {
      background-color: white;
      border: 1px solid #56606a;
      color: black;
    }

    .main-sidebar .brand-text,
    .main-sidebar .logo-xl,
    .main-sidebar .logo-xs,
    .sidebar .nav-link p,
    .sidebar .user-panel .info {
      color: black;

    }

    .nav-sidebar>.nav-header,
    .sidebar-form {
      color: black;
      font-size: 16px ;
    }
  </style>

  <script src="https://kit.fontawesome.com/726ca5cfb3.js" crossorigin="anonymous"></script>


</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="IMAGENES/icons8-hospital-3-80.png" alt="AdminLTELogo" height="60" width="60">
    </div>

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>


      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
          <a class="nav-link" data-widget="navbar-search" href="#" role="button">
            <i class="fas fa-search"></i>
          </a>


          <div class="navbar-search-block">
            <form class="form-inline">
              <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Buscar" aria-label="Search">
                <div class="input-group-append">
                  <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                  <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#" onclick="cambiarIframe('menu.php')" role="button">
            <i class="material-icons" style="font-size:small;color:#f0f0f0;text-shadow:2px 2px 4px #000000;">menu</i> Menú Principal
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
            <i class="fas fa-th-large"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="#" onclick="cambiarIframe('menu.php')" class="brand-link">
        <img src="IMAGENES/icons8-hospital-3-80.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Pediatra Sis</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="IMAGENES/user.bmp" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">AdMin</a>
          </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
          <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Buscar" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

            <li class="nav-header">
              <i class="fa-regular fa-window-restore"></i>
              <span style="font-weight: bolder;">═ MANTENIMIENTOS ═══</span>
            </li>
            <li>
              <hr class="solid">
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="fa-solid fa-hospital-user"></i>
                <p>
                  Pacientes
                  <i class="fas fa-angle-left right"></i>
                  <!-- <span class="badge badge-info right">6</span> -->
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">

                  <a href="#" onclick="cambiarIframe('paciente.php')" class="nav-link">
                    <i class="nav-icon  material-icons">group</i>
                    <p>Paciente General</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" onclick="cambiarIframe('mant_paciente_historiaClinica.php')" class="nav-link">
                    <i class="nav-icon  material-icons">healing</i>
                    <p>Historia Paciente</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" onclick="cambiarIframe('MANT-pacientevacuna.php')" class="nav-link">
                    <i class="nav-icon  material-icons">vaccines</i>
                    <p>Vacunas del Paciente</p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="#" onclick="cambiarIframe('mant_padres_pacientes.php')" class="nav-link">
                    <i class="nav-icon  material-icons"><span class="material-symbols-outlined">
                        family_restroom
                      </span></i>
                    <p>Padres Pacientes</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" onclick="cambiarIframe('mant_localizadorp.php')" class="nav-link">
                  <i class="fa-regular fa-address-book"></i>
                    <p> Agenda Padres </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" onclick="cambiarIframe('MANT_PadresConPacientes.php')" class="nav-link">
                  <i class="fa-solid fa-people-arrows"></i>
                    <br><p> Vincular <br> Padre-Paciente</p>
                  </a>
                </li>
              </ul>
            </li>


            <li class="nav-item">
              <a href="#" onclick="cambiarIframe('menu-medico.php')" class="nav-link">
                <i class="fa-solid fa-user-doctor"></i>
                <p>
                  Médico
                  <i class="fas fa-angle-left right"></i>
                  <!-- <span class="badge badge-info right">6</span> -->
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">

                  <a href="#" onclick="cambiarIframe('mant_medico.php')" class="nav-link">
                    <span class="material-symbols-outlined">
                      stethoscope
                    </span>
                    <p>Doctor General</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" onclick="cambiarIframe('mant_trabajosmedicos.php')" class="nav-link">
                    <i class="fa-solid fa-notes-medical"></i>
                    <p>Trabajo Médicos</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" onclick="cambiarIframe('mant_especialidad.php')" class="nav-link">
                    <i class="fa-solid fa-people-group"></i>
                    <p>Especialidad Médico</p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="#" onclick="cambiarIframe('mant_horario.php')" class="nav-link">
                    <i class="fa-solid fa-clock"></i>
                    <p>Horario Médico</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" onclick="cambiarIframe('mant_localizadorm.php')" class="nav-link">
                    <i class="fa-solid fa-address-book"></i>
                    <p>Localizador Médico</p>
                  </a>
                </li>
              </ul>
            </li>

            <li>
              <hr class="solid">
            </li>

            <li class="nav-item">
              <a href="#" onclick="cambiarIframe('mant_seguro.php')" class="nav-link">
                <i class="fa-solid fa-suitcase-medical"></i>
                <p>Seguros</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" onclick="cambiarIframe('mant-Agregaruser.php')" class="nav-link">
                <i class="fa-solid fa-user-plus"></i>
                <p>Usuarios</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="#" onclick="cambiarIframe('mant-centromedico.php')" class="nav-link">
                <i class="fa-solid fa-house-medical"></i>
                <p>Centro Médico</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="#" onclick="cambiarIframe('mant_medicamentos.php')" class="nav-link">
                <i class="fa-solid fa-prescription-bottle-medical"></i>
                <p>Medicamentos</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="#" onclick="cambiarIframe('mant_vacunas.php')" class="nav-link">
                <i class="fa-solid fa-syringe"></i>
                <p>Vacunas</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="#" onclick="cambiarIframe('mant_padecimientos_comunes.php')" class="nav-link">
                <i class="fa-solid fa-head-side-cough"></i>
                <p>Padecimientos</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" onclick="cambiarIframe('mant_laboratorio.php')" class="nav-link">
                <i class="fa-solid fa-flask"></i>
                <p>Laboratorio</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" onclick="cambiarIframe('backup/php/index.php')" class="nav-link">
              <i class="fa-solid fa-download"></i>
                <p>Backup</p>
              </a>
            </li>

            <li class="nav-header">
              <i class="fa-solid fa-gears"></i>
              <span style="font-weight: bolder;">═ PROCESOS ═══</span>
            </li>


            <li class="nav-item">
              <a href="#" onclick="cambiarIframe('mant_citasmedicas.php')" class="nav-link">
                <i class="fa-solid fa-calendar-days"></i>
                <p>
                  Citas
                  <i class="fas fa-angle-left right"></i>
                  <!-- <span class="badge badge-info right">6</span> -->
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">

                  <a href="#" onclick="cambiarIframe('proces_citas.php')" class="nav-link">
                    <i class="fa-solid fa-calendar-plus"></i>
                    <p>Agendar Cita</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" onclick="cambiarIframe('consultamedicospacientescitas.php')" class="nav-link">
                    <i class="fa-solid fa-calendar-day"></i><i class="fa-solid fa-user-doctor"></i>
                    <p>Citas del Médico</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" onclick="cambiarIframe('consultamedicospacientescitas2.php')" class="nav-link">
                  <i class="fa-solid fa-clock-rotate-left"></i>
                    <p>Turnos en pantalla</p>
                  </a>
                </li>



              </ul>
            </li>



            <li class="nav-item">
              <a href="#" onclick="cambiarIframe('proces_consulta.php')" class="nav-link">
                <i class="fa-solid fa-book-medical"></i>
                <p>
                  Consultas Médicas
                  <i class="fas fa-angle-left right"></i>
                  <!-- <span class="badge badge-info right">6</span> -->
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">

                  <a href="#" onclick="cambiarIframe('proces_receta.php')" class="nav-link">
                    <i class="fa-solid fa-file-prescription"></i>
                    <p>Recetas</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" onclick="cambiarIframe('proces_referimientos.php')" class="nav-link">
                    <i class="fa-solid fa-file-medical"></i>
                    <p>Referimientos</p>
                  </a>
                </li>
                
                <li class="nav-item">
                  <a href="#" onclick="cambiarIframe('proces_CERTIFICADOMEDICO.php')" class="nav-link">
                    <i class="fa-solid fa-receipt"></i>
                    <p>Certificados</p>
                  </a>
                </li>



              </ul>
            </li>

            <li class="nav-header">
              <i class="fa-solid fa-gears"></i>
              <span style="font-weight: bolder;">═ Consultas y Reportes</span>
            </li>
            <li class="nav-item">
              <a href="#" onclick="cambiarIframe('menu-consultas.php')" class="nav-link">
                <span class="material-symbols-outlined">screen_search_desktop</span>
                <p>Menu de consultas</p>
              </a>
            </li>


            <!-- <li class="nav-item">
          
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Login & Register v1
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="pages/examples/login.html" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Login v1</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="pages/examples/register.html" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Register v1</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="pages/examples/forgot-password.html" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Forgot Password v1</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="pages/examples/recover-password.html" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Recover Password v1</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Login & Register v2
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="pages/examples/login-v2.html" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Login v2</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="pages/examples/register-v2.html" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Register v2</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="pages/examples/forgot-password-v2.html" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Forgot Password v2</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="pages/examples/recover-password-v2.html" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Recover Password v2</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="pages/examples/lockscreen.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lockscreen</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/legacy-user-menu.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Legacy User Menu</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/language-menu.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Language Menu</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/404.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Error 404</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/500.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Error 500</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/pace.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pace</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/blank.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Blank Page</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="starter.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Starter Page</p>
                </a>
              </li>
            </ul>
          </li> -->
            <li class="nav-item">

              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="pages/search/simple.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Simple Search</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="pages/search/enhanced.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Enhanced</p>
                  </a>
                </li>
              </ul>
            </li>











          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Sistema de Pediatría</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a id="redireccionar" href="#">Salir</a>

                  <script>
                    document.getElementById("redireccionar").addEventListener("click", function(event) {
                      event.preventDefault(); // Evita el comportamiento predeterminado del enlace
                      window.top.location.href = "index.php"; // Redirige a menuadmin.php en la ventana principal
                    });
                  </script>
                </li>

              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <iframe id="miIframe" width="100%" height="800px" frameborder="0" src="menu.php"></iframe>

      </section>
      <script>
        function cambiarIframe(nuevaFuente) {
          // Obtener el elemento iframe
          var iframe = document.getElementById('miIframe');

          // Cambiar la fuente del iframe
          iframe.src = nuevaFuente;
        }
      </script>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- ChartJS -->
  <script src="plugins/chart.js/Chart.min.js"></script>
  <!-- Sparkline -->
  <script src="plugins/sparklines/sparkline.js"></script>
  <!-- JQVMap -->
  <script src="plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="plugins/jquery-knob/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="plugins/moment/moment.min.js"></script>
  <script src="plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Summernote -->
  <script src="plugins/summernote/summernote-bs4.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.js"></script>
  <!-- AdminLTE for demo purposes -->

  <script src="dist/js/pages/dashboard.js"></script>
</body>

</html>