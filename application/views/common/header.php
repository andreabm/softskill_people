<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SoftSkill People</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url("assets/bootstrap/css/bootstrap.min.css"); ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url("assets/font-awesome/css/font-awesome.min.css"); ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url("assets/ionicons-2.0.1/css/ionicons.min.css"); ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url("assets/dist/css/AdminLTE.min.css"); ?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url("assets/dist/css/skins/_all-skins.min.css"); ?>">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url("assets/plugins/iCheck/flat/blue.css"); ?>">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?php echo base_url("assets/plugins/morris/morris.css"); ?>">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo base_url("assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css"); ?>">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php echo base_url("assets/plugins/datepicker/datepicker3.css"); ?>">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url("assets/plugins/daterangepicker/daterangepicker.css"); ?>">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo base_url("assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css"); ?>">
    <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url("assets/plugins/datatables/dataTables.bootstrap.css"); ?>">
  <!-- fullCalendar 2.2.5-->
  <link rel="stylesheet" href="<?php echo base_url("assets/plugins/fullcalendar/fullcalendar.min.css"); ?>">
  <link rel="stylesheet" href="<?php echo base_url("assets/plugins/fullcalendar/fullcalendar.print.css"); ?>" media="print">
    <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="<?php echo base_url("assets/plugins/timepicker/bootstrap-timepicker.min.css"); ?>">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url("assets/plugins/select2/select2.min.css"); ?>">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <script src="<?php echo base_url("assets/plugins/jQuery/jquery-2.2.3.min.js"); ?>"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="<?php echo base_url("assets/plugins/jQuery/jquery-ui.min.js"); ?>"></script>
  <!-- bootstrap datepicker -->
  <script src="<?php echo base_url("assets/plugins/datepicker/bootstrap-datepicker.js"); ?>"></script>
  <!-- bootstrap time picker -->
  <script src="<?php echo base_url("assets/plugins/timepicker/bootstrap-timepicker.min.js"); ?>"></script>
</head>
<body class="hold-transition skin-purple sidebar-mini">
<div class="wrapper">
  <header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>SS</b>P</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>SoftSkill</b>People</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
         
      

          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo $this->session->userdata('img'); ?>" class="user-image" alt="User Image">
              <span class="hidden-xs">Hola, &nbsp; <?php echo $this->session->userdata('nombre'); ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo $this->session->userdata('img'); ?>" class="img-circle" alt="User Image">

                <p>
                  <?php echo $this->session->userdata('nombre'); ?>
                  <small><?php echo $this->session->userdata('mail'); ?></small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo base_url('/index.php/usuarios/logout');?>" class="btn btn-default btn-flat">Logout</a>
                </div>
              </li>
            </ul>
          </li>
         
        </ul>
      </div>
    </nav>
  </header>
    <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
      <li class="active"><a href="<?php echo base_url('/index.php/index/dashboard');?>"><i class="fa fa-home"></i> <span>Inicio</span></a></li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-child"></i> <span>Gestion de Personas</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url('/index.php/gestion/solicitudes');?>"><i class="fa fa-circle-o"></i> Ver Solicitudes</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Reportes</a></li>
            <li><a href="<?php echo base_url('/index.php/gestion/entrevistas');?>"><i class="fa fa-circle-o"></i> Entrevistas</a></li>
            <li>
              <a href="#"><i class="fa fa-circle-o"></i> Postulantes
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url('/index.php/gestion/postulantes');?>"><i class="fa fa-circle-o"></i>Ver Postulantes </a></li>
                <li><a href="<?php echo base_url('/index.php/gestion/agregar_postulante');?>"><i class="fa fa-circle-o"></i> Agregar Postulante</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i> Test Psicologico</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i> Competencias</a></li>
                
              </ul>
            </li>
            <li>
              <a href="#"><i class="fa fa-circle-o"></i> Administracion
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url('/index.php/gestion/turnos');?>"><i class="fa fa-circle-o"></i> Turnos</a></li>
                <li><a href="<?php echo base_url('/index.php/gestion/competencias');?>"><i class="fa fa-circle-o"></i> Competencias</a></li>
                <li><a href="<?php echo base_url('/index.php/gestion/fuentes');?>"><i class="fa fa-circle-o"></i> Fuentes</a></li>
                <li><a href="<?php echo base_url('/index.php/gestion/motivo_no_califica');?>"><i class="fa fa-circle-o"></i> Motivo No Califica</a></li>
              </ul>
            </li>
            
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-check-square"></i> <span>Calidad</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-circle-o"></i> Calidad</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i> <span>RRHH</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-circle-o"></i> RRHH</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-bar-chart"></i> <span>Operaciones</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li ><a href="<?php echo base_url('/index.php/operaciones/solicitudes');?>"><i class="fa fa-circle-o"></i> Solicitudes</a></li>
            <li><a href="<?php echo base_url('/index.php/operaciones/ejecutivos');?>"><i class="fa fa-circle-o"></i> Validar Solicitudes</a></li>
            <li><a href="<?php echo base_url('/index.php/operaciones/ejecutivos');?>"><i class="fa fa-circle-o"></i> Ejecutivos</a></li>
            <li>
              <a href="#"><i class="fa fa-circle-o"></i> Asistencia
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href=""><a href="<?php echo base_url('/index.php/operaciones/ver_asistencia');?>"><i class="fa fa-circle-o"></i>Ver Asistencia </a></li>
                <li><a href=""><a href="<?php echo base_url('/index.php/operaciones/pasar_asistencia');?>"><i class="fa fa-circle-o"></i>Pasar Asistencia </a></li>
                <li><a href=""><a href="<?php echo base_url('/index.php/operaciones/validar_asistencia');?>"><i class="fa fa-circle-o"></i> Validar Asistencia</a></li>
              </ul>
            </li>
            <li>
              <a href="#"><i class="fa fa-circle-o"></i> Evaluaciones
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href=""><a href="<?php echo base_url('/index.php/operaciones/escuchas');?>"><i class="fa fa-circle-o"></i>Escuchas </a></li>
                <li><a href=""><a href="<?php echo base_url('/index.php/operaciones/desempeño');?>"><i class="fa fa-circle-o"></i>Desempe&ntilde;o </a></li>
                <li><a href=""><a href="<?php echo base_url('/index.php/operaciones/continuidad_laboral');?>"><i class="fa fa-circle-o"></i> Continuidad Laboral</a></li>
              </ul>
            </li>
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
    <!-- Content Wrapper. Contains page content -->

   