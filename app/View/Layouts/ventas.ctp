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
        <a href="/furaibar/Venta/" class="logo">
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
            <a class="brand" href="/furaibar/Venta/">Local x</a>
            <div class="nav-collapse">
              <ul class="nav">
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Caja <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    <li><a href="/furaibar/Ventas/abrir">Abrir Caja</a></li>
                    <li><a href="/furaibar/Ventas/cerrar">Cerrar Caja</a></li>
                  </ul>
                </li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Ventas en Local<b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    <li><a href="/furaibar/Ventas/add">Abrir Venta</a></li>
                    <li><a href="/furaibar/Ventas/close">Cerrar Venta</a></li>
                    <!-- <li><a href="/furaibar/Ventas/ticket">Generar Ticket </a></li> -->
                    <li><a href="/furaibar/Ventas/colaventa">Mostrar Ventas en Cola</a></li>
                    <li><a href="/furaibar/Ventas/colaventa2">Mostrar Ventas Finalizadas</a></li>
                  </ul>
                </li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Pedidos en local<b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    <li><a href="/furaibar/Pedido/add2">Agregar Pedido a Cola</a></li>
                    <li><a href="/furaibar/Pedido/colapedido">Mostrar Pedidos en Cola</a></li>
                    <li><a href="/furaibar/Pedido/cancelar">Cancelar Pedido</a></li>
                    <li><a href="/furaibar/Pedido/entregado">Entregar Pedido</a></li>
                  </ul>
                </li>
                <!-- <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Pedidos a domicilio<b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    <li><a href="/furaibar/Ventas/colaventa">Pedidos en cola</a></li>
                    <li><a href="/furaibar/Ventas/colaventa">Pedidos entregados</a></li>
                  </ul>
                </li> -->
              </ul>
              <ul class="nav pull-right">
                <li><a href="/furaibar/Ventas/logout">Cerrar Sesión</a></li>
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