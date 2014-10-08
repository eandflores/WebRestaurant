<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- <link rel="shortcut icon" href="/furaibar/img/logo2.png"> -->
<title>Local x</title>
<?php 
  echo $this->Html->css("reset.css");
  echo $this->Html->css("bootswatch-slate.css");
  echo $this->Html->css("admin-main.css");
  echo $this->Html->script("jquery.js");
  echo $this->Html->script("bootstrap.js");
  echo $this->Html->script("jquery.rut.js");
  echo $this->Html->script("main.js");
?>
<style type="text/css">
</style>
</head>
<body>
  <div id="wrapper" class="container">
    <div class="MainNav">
      <div class="container">
        <a href="/furaibar/Admin/" class="logo">
          <!-- <img src="/furaibar/img/logo.png"> -->
        </a>
      </div>
      <div class="navbar">
        <div class="navbar-inner">
          <div class="container" style="width: auto;">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </a>
            <a class="brand" href="/furaibar/Admin/">Local x</a>
            <div class="nav-collapse">
              <ul class="nav">
                <li class="dropdown">
                  <a href="/furaibar/Deadmin/">Informe Ventas</a>
                </li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Personal <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    <li><a href="/furaibar/Personal">Gestion Personal</a></li>
                    <li><a href="/furaibar/Personal/add">Agregar Usuario</a></li>
                    <!-- <li class="divider"></li>
                    <li><a href="/furaibar/Personal/remuneraciones">Informe Remuneraciones</a></li>
                    <li><a href="/furaibar/Personal/agregarremuneracion">Calcular Remuneraciones Diarias</a></li> -->
                  </ul>
                </li>

                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Inventario <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                 	  <li><a href="/furaibar/Inventario/">Gestión Ingredientes</a></li>
                    <!-- <li><a href="/furaibar/Inventario/nuevo">Agregar Nuevo Ingrediente</a></li> -->
                    <!-- <li class="divider"></li> -->
                    <li><a href="/furaibar/Producto">Gestion Productos</a></li>
                    <!-- <li><a href="/furaibar/Producto/add">Agregar Nuevo Producto</a></li> -->
                    <!-- <li class="divider"></li> -->
                    <li><a href="/furaibar/Menu/index">Gestión Menus</a></li>
                    <!-- <li><a href="/furaibar/Menu/nuevo">Agregar Nuevo Menu</a></li> -->
                  </ul>
                </li>
                <!-- <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Gastos <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    <li><a href="/furaibar/Gasto/">Gestión Gastos</a></li>
                    <li><a href="/furaibar/Gasto/nuevo">Agregar Nuevo Gasto</a></li>
                  </ul>
                </li> -->
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Mesas <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    <!-- <li><a href="/furaibar/Cliente">Gestion cliente</a></li> -->
                    <!-- <li><a href="/furaibar/Reserva">Gestion Reservas</a></li> -->
                    <!-- <li><a href="/furaibar/Caja">Gestión Cajas</a></li> -->
                    <!-- <li><a href="/furaibar/Sucursal">Gestión Sucursales</a></li> -->
                    <!-- <li><a href="/furaibar/Rol">Gestión Roles</a></li> -->
                    <li><a href="/furaibar/Mesa">Gestión Mesas</a></li>
                    <li><a href="/furaibar/Mesa/add">Agregar Mesa</a></li>
                  </ul>
                </li>
              </ul>
              <ul class="nav pull-right">
                <li><a href="/furaibar/Users/logout">Cerrar Sesión</a></li>
              </ul>
            </div><!-- /.nav-collapse -->
          </div>
        </div><!-- /navbar-inner -->
      </div><!-- /navbar -->
    </div>
  </div>
  <div id='wrap_cuerpo' class='container'>
    <div class='row'>
      <div class="span12 Cuerpo">
        <?php echo $this->Session->flash(); ?>
        <?php echo $this->fetch('content'); ?>
      </div>
    </div>
  </div>
  </div>
</body>
<?php
  echo $this->Html->script("jquery.js");
  echo $this->Html->script("bootstrap.js");
  echo $this->Html->script("jquery.rut.js");
  echo $this->Html->script("main.js");
?>
</html>