<!DOCTYPE html>
<html>
  <head>
      <meta name="csrf-token" content="{{csrf_token()}}">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sistema OTB</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('css/_all-skins.min.css')}}">
    <!-- <link rel="shortcut icon" href="{{asset('img/favicon.ico')}}" /> -->
    <link rel="shortcut icon" href="{{asset('img/agua.jpg')}}">
    <link rel="stylesheet" href="{{asset('css/imprimir.css')}}">

    @yield('css')

  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    
    <div class="wrapper">

      <header class="main-header">

        <!-- Logo -->
        <a href="index2.html" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>S</b>OTB</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Sistema OTB</b></span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Navegación</span>
          </a>
          <!-- Navbar Right Menu -->
          @if(Auth::check())
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->

              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"> 
                  <small class="bg-red">Usuario: {{ Auth::user()->name }}</small>
                 
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <div class="pull-right">
                      <a href="{{url('/logout')}}" class="btn btn-default btn-flat">Cerrar Sesion</a>
                    </div>
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
          <!-- Sidebar user panel -->

          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header"></li>
                @if (Auth::user()->idRol==1)

            <li class="treeview">
              <a href="#">
                <i class="fa fa-users"></i>
                <span>Socios</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{url('administracion/socio/create')}}"><i class="fa fa-circle-o"></i> Registrar Socio</a></li>
                <li><a href="{{url('administracion/socio')}}"><i class="fa fa-circle-o"></i> Listar Socio</a></li>
              </ul>
            </li>
          @endif
            @if (Auth::user()->idRol==2 ||Auth::user()->idRol==1)

            <li class="treeview">
              <a href="#">
                <i class="fa fa-clipboard"></i>
                <span>Lecturas</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{url('administracion/lectura')}}"><i class="fa fa-circle-o"></i> Listar Lecturas</a></li>
              </ul>
            </li>
          @endif
            @if (Auth::user()->idRol==1 || Auth::user()->idRol==4)

            <li class="treeview">
              <a href="#">
                <i class="fa fa-dollar"></i> <span>Cobros</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                  
                    <li><a href="{{url('cobro/agua')}}"><i class="fa fa-circle-o"></i>Registrar Cobro</a></li>
                   

                

              </ul>
            </li>
          @endif
            @if (Auth::user()->idRol==1)

            <li class="treeview">
              <a href="#">
                <i class="fa fa-check"></i><span>Multas</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{url('administracion/multa/create')}}"><i class="fa fa-circle-o"></i>Registrar Multa</a></li>
                <li><a href="{{url('administracion/multa')}}"><i class="fa fa-circle-o"></i>Listar Multa</a></li>

              </ul>
            </li>
          @endif
          @if (Auth::user()->idRol==1)

            <li class="treeview">
              <a href="#">
                <i class="fa fa-list-ul"></i><span>Reportes</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{url('asistencia')}}" target="_blank"><i class="fa fa-circle-o"></i>Control Asistencia</a></li>
                <li><a href="{{url('Reporte/socioList')}}" target="_blank"><i class="fa fa-circle-o"></i>Control de lectura</a></li>
                <li><a href="{{url('Reporte/socioMulta')}}" target="_blank"><i class="fa fa-circle-o"></i>Lista Socios con Multas</a></li>
                 <li><a href="{{url('cobro/lista/agua')}}"><i class="fa fa-circle-o"></i>Listar Cobros de Agua</a></li>
                    <li><a href="{{url('cobro/lista/multa')}}"><i class="fa fa-circle-o"></i>Listar Cobros de Multa</a></li>
                    <li><a href="{{url('cobro/lista/accion')}}"><i class="fa fa-circle-o"></i>Listar Cobros de Accion</a></li>
                    <li><a href="{{url('Reporte/corte')}}" target="_blank"><i class="fa fa-circle-o"></i>Socio en Corte</a></li>
                    <li><a href="{{url('deudor/accion')}}" target="_blank"><i class="fa fa-circle-o"></i>Deudores por accion</a></li>
                     <li><a href="{{url('Reporte/retraso')}}" target="_blank"><i class="fa fa-circle-o"></i>Reportes de retrasos</a></li>
                  <li><a href="{{url('movimiento/lista')}}"><i class="fa fa-circle-o"></i>Reporte de Movimiento</a></li>

              </ul>
            </li>
          @endif
          @if (Auth::user()->idRol==1)

            <li class="treeview">
              <a href="#">
                <i class="fa fa-sign-out"></i> <span>Acceso</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{url('seguridad/usuario')}}"><i class="fa fa-circle-o"></i>Listar Usuario</a></li>
                <li><a href="{{url('seguridad/usuario/create')}}"><i class="fa fa-circle-o"></i>Registrar Usuario</a></li>

              </ul>
            </li>

              <li class="treeview">
                <a href="#">
                  <i class="fa fa-money"></i> <span>Movimientos Economicos</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li><a href="{{url('movimiento/ingreso')}}"><i class="fa fa-circle-o"></i>Registro de Ingreso</a></li>
                  <li><a href="{{url('movimiento/egreso')}}"><i class="fa fa-circle-o"></i>Registro de Egreso</a></li>

                </ul>
              </li>

              <li class="treeview">
                <a href="#">
                  <i class="fa fa-money"></i> <span>Aportes</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li><a href="{{url('aporte/index')}}"><i class="fa fa-circle-o"></i>Registro de Aporte</a></li>
                  <li><a href="{{url('aporte/lista')}}"><i class="fa fa-circle-o"></i>Lista de Aporte</a></li>
                </ul>
              </li>

          @endif

            <li>
              <a href="{{url('acercaDe')}}">
                <i class="fa fa-info-circle"></i> <span>Acerca De...</span>
                <small class="label pull-right bg-yellow">INFO</small>
              </a>
            </li>

          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>





       <!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">

        <!-- Main content -->
        <section class="content">

          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-header with-border"  style="text-align: center">
                  <h3 class="box-title" style="font-size:2em;"> <b> Sistema de Agua Willcataco</b></h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>

                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  	<div class="row">
	                  	<div class="col-md-12">
		                          <!--Contenido-->
                              @yield('contenido')
		                          <!--Fin Contenido-->
                           </div>
                        </div>

                  		</div>
                  	</div><!-- /.row -->
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <!--Fin-Contenido-->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.1.0
        </div>
        <strong>Desarrolladores <br>
          <a href="#">Cristian Merida</a>  <br>
           <a href="#">Carlos Vedia Limpias</a>. <br>
         </strong> All rights reserved.
      </footer>


    <!-- jQuery 2.1.4 -->
    <script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('js/busqueda.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('js/app.min.js')}}"></script>
    @yield('scripts')
  </body>
</html>
@else
  <?php
  header('location: login');
  exit;
  ?>
@endif
