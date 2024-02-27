<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>EIM | Fraccionamiento</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.5 -->
  <link rel="stylesheet" href="/Fraccionamiento/public/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/Fraccionamiento/public/css/font-awesome.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/Fraccionamiento/public/css/AdminLTE.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="/Fraccionamiento/public/css/_all-skins.css">

  <link rel="apple-touch-icon" href="/Fraccionamiento/public/img/apple-touch-icon.png">
  <link rel="icon" href="/Fraccionamiento/public/img/img_login/LOGO_TESIS_BL2.png" type="image/x-icon">

  <!-- DATATABLES -->
  <link rel="stylesheet" type="text/css" href="/Fraccionamiento/public/datatables/jquery.dataTables.min.css">
  <link href="/Fraccionamiento/public/datatables/buttons.dataTables.min.css" rel="stylesheet" />
  <link href="/Fraccionamiento/public/datatables/responsive.dataTables.min.css" rel="stylesheet" />

  <link rel="stylesheet" type="text/css" href="/Fraccionamiento/public/css/bootstrap-select.min.css">

  <!-- CSS Listado -->
  <link rel="stylesheet" href="/Fraccionamiento/public/css/css_main/listado.css">
  <!-- CSS Page Loader -->
  <link rel="stylesheet" href="/Fraccionamiento/public/css/css_page_loader/style_loader.css">

  <!-- FONT AWESOME -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

</head>

<body class="hold-transition skin-blue-light sidebar-mini load_navbar-hidden">

  <!-- START LOADER SECTION -->
  <div class="loader-container" id="onload-load">
    <div class="title-load">
      <h1 id="texto">CARGANDO</h1>
    </div>
    <div class="loader">
      <span></span>
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>
  <!--Validando Dartos-->

  <!-- END LOADER SECTION -->

  <div class="wrapper">

    <header class="main-header">

      <!-- Logo -->
      <a href="/Fraccionamiento/EIM/" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><img src="../public/img/img_login/EIM.png" width="80%"></span>
        <!-- logo for regular state and mobile devices LOGO APP MOVIL A 60%-->
        <span class="logo-lg"><img src="../public/img/img_login/GREENTECH2.png" class="LogoInicio"></span>
      </a>

      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          <span class="sr-only">Navegación</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- Messages: style can be found in dropdown.less-->

            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu container-user">
              <a href="#" class="dropdown-toggle cu-a" data-toggle="dropdown" style="display: inline-block !important;">
                <span class="badge bg-dark" style="background-color: #fff !important;"><svg
                    xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512"
                    style="margin:auto !important;"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                    <path
                      d="M224 0c-17.7 0-32 14.3-32 32V51.2C119 66 64 130.6 64 208v25.4c0 45.4-15.5 89.5-43.8 124.9L5.3 377c-5.8 7.2-6.9 17.1-2.9 25.4S14.8 416 24 416H424c9.2 0 17.6-5.3 21.6-13.6s2.9-18.2-2.9-25.4l-14.9-18.6C399.5 322.9 384 278.8 384 233.4V208c0-77.4-55-142-128-156.8V32c0-17.7-14.3-32-32-32zm0 96c61.9 0 112 50.1 112 112v25.4c0 47.9 13.9 94.6 39.7 134.6H72.3C98.1 328 112 281.3 112 233.4V208c0-61.9 50.1-112 112-112zm64 352H224 160c0 17 6.7 33.3 18.7 45.3s28.3 18.7 45.3 18.7s33.3-6.7 45.3-18.7s18.7-28.3 18.7-45.3z" />
                  </svg>
                  <span class="badge bg-secondary" style="margin-top: -5px !important;">0</span>
                </span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header user-menu-float_ntf">
                  <small>Notificaciones</small>
                  <div class="listNoty">
                    <!-- mensaje contenedor -->
                    <div class="message_notify">
                      <div class="group__notify">
                        <img src="../files/FotoPerfil/groups.jpg" class="img-circle img-panel-short__notify"
                          alt="User Image">
                        <h4 class="title__group">GRUPO MANTENIMIENTO</h4>
                      </div>

                      <h4 class="title">ASUNTO</h4>
                      <p class="description_notify">Texto de ejemplo</p>
                      <p class="time">12:14pm</p>
                    </div>


                  </div>

                  <br>
                  <br>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer user-footer__notification">
                  <a href="../vistas/LogOut" class="btn btn-default btn-flat">Ver más</a>
                </li>
              </ul>
            </li>

            <li class="dropdown user user-menu container-user">
              <a href="#" class="dropdown-toggle cu-a" data-toggle="dropdown"
                style="display: inline-block !important;line-height:20px !important; padding-left:0;">
                <img src="<?php echo $_SESSION['Foto']; ?>" class="user-image img-user-preview-view" alt="User Image"
                  style="margin-top:0.2px !important;">
                <span class="hidden-xs">
                  <?php echo $_SESSION['NombreUsuario']; ?>
                </span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header user-menu-float">
                  <img src="<?php echo $_SESSION['Foto']; ?>" class="img-circle img-panel-short" alt="User Image">
                  <p>
                    <?php echo $_SESSION['Cargo']; ?>
                    <small>Fraccionamiento</small>
                    <a class="edit-profile-btn" href="../EIM/perfil">Editar Perfil</a>
                  </p>
                  <br>
                  <br>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                  <a href="../vistas/LogOut" class="btn btn-default btn-flat">Cerrar Sesión</a>
                </li>
              </ul>
            </li>

          </ul>
        </div>

      </nav>
      <div class="body-notifications">

        <ul class="notifications">
          <!-- <li class="toast success">
          <div class="column">
            <i class="fa-solid fa-circle-check"></i>
            <span>Success: this is a success toast.</span>
          </div>
          <i class="fa-solid fa-xmark"></i>
        </li>
        <li class="toast error">
          <div class="column">
            <i class="fa-solid fa-circle-xmark"></i>
            <span>Success: this is an error toast.</span>
          </div>
          <i class="fa-solid fa-xmark"></i>
        </li>
        <li class="toast warning">
          <div class="column">
            <i class="fa-solid fa-triangle-exclamation"></i>
            <span>Success: this is a warning toast.</span>
          </div>
          <i class="fa-solid fa-xmark"></i>
        </li>
        <li class="toast info">
          <div class="column">
            <i class="fa-solid fa-circle-info"></i>
            <span>Success: this is a info toast.</span>
          </div>
          <i class="fa-solid fa-xmark"></i>
        </li> -->
        </ul>

      </div>
    </header>

    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
          <li class="header"></li>
          <li>
            <a href="../EIM">
              <i class="fa fa-tasks"></i> <span>Inicio</span>
            </a>
          </li>
          <li class="treeview">
            <a href="../EIM/miQr">
              <i class="fa fa-qrcode"></i>
              <span>Mi QR</span>
            </a>
          </li>
          <?php
          if ($_SESSION['Cargo'] == "ADMINISTRADOR") {
            ?>

            <li class="treeview">
              <a href="#">
                <i class="fa-regular fa-id-card"></i>
                <span>Residente</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="../ADMIN/registroResidente"><i class="fa-solid fa-people-roof"></i> Mis Residentes</a></li>
                <!--<li><a href="categoria.php"><i class="fa fa-circle-o"></i> Categorías</a></li>-->
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa-solid fa-user-tie"></i>
                <span>Vigilante</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="../VIGILANTE/scanner"><i class="fa fa-plus"></i> Escanear QR</a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa-solid fa-ticket"></i>
                <span>Accesos</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="../RESIDENTE/visita"><i class="fa fa-home"></i> Acceso Visita</a></li>
              </ul>
              <!-- <ul class="treeview-menu">
                <li><a href="ingreso.php"><i class="fa fa-gift"></i> Acceso Paquetería</a></li>
              </ul>
              <ul class="treeview-menu">
                <li><a href="ingreso.php"><i class="fa fa-car"></i> Acceso Transporte</a></li>
              </ul>
              <ul class="treeview-menu">
                <li><a href="ingreso.php"><i class="fa fa-cutlery"></i> Acceso de Reparto</a></li>
              </ul> -->
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa-solid fa-users-rectangle"></i>
                <span>Grupos</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="../ADMIN/AgregarGrupo"><i class="fa fa-plus-square"></i> Crear Grupo</a></li>
                <li><a href="../EIM/MisGrupos"><i class="fa fa-history"></i>Mis Grupos</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-bar-chart"></i> <span>Consulta Gráfica</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="consultacompras.php"><i class="fa fa-circle-o"></i> Consulta Compras</a></li>
              </ul>
            </li>

            <?php
          }
          ?>
          <?php
          if ($_SESSION['Cargo'] == "RESIDENTE") {
            ?>
            <li class="treeview">
              <a href="#">
                <i class="fa-solid fa-ticket"></i>
                <span>Accesos</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="../RESIDENTE/visita"><i class="fa fa-home"></i> Acceso Visita</a></li>
              </ul>
              <!-- <ul class="treeview-menu">
                <li><a href="ingreso.php"><i class="fa fa-gift"></i> Acceso Paquetería</a></li>
              </ul>
              <ul class="treeview-menu">
                <li><a href="ingreso.php"><i class="fa fa-car"></i> Acceso Transporte</a></li>
              </ul>
              <ul class="treeview-menu">
                <li><a href="ingreso.php"><i class="fa fa-cutlery"></i> Acceso de Reparto</a></li>
              </ul> -->
            </li>
            <!-- <li class="treeview">
              <a href="#">
                <i class="fa fa-credit-card"></i>
                <span>Pagos</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="articulo.php"><i class="fa fa-money"></i> Pagar Mantenimiento</a></li>
                <li><a href="categoria.php"><i class="fa fa-history"></i> Historial de Pago</a></li>
              </ul>
            </li> -->
            <li class="treeview">
              <a href="#">
                <i class="fa fa-users"></i>
                <span>Grupos</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="../EIM/MisGrupos"><i class="fa fa-history"></i>Mis Grupos</a></li>
              </ul>
            </li>
            <?php
          }
          if ($_SESSION['Cargo'] == "VIGILANTE") {
            ?>
            <li class="treeview">
              <a href="#">
                <i class="fa-solid fa-user-tie"></i>
                <span>Vigilante</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="../VIGILANTE/scanner"><i class="fa fa-plus"></i> Escanear QR</a></li>
              </ul>
            </li>
            <?php
          }
          ?>
          <li>
            <a href="#">
              <i class="fa fa-plus-square"></i> <span>Ayuda</span>
              <small class="label pull-right bg-red">PDF</small>
            </a>
          </li>
          <li>
            <a href="#">
              <i class="fa fa-info-circle"></i> <span>Acerca De...</span>
              <small class="label pull-right bg-yellow">IT</small>
            </a>
          </li>

        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>