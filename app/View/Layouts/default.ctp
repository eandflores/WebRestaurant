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
        <a href="/furaibar/Deusuario/" class="logo">
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
            <a class="brand" href="/furaibar/Deusuario/">Local x</a>
            <div class="nav-collapse">
              <ul class="nav">
                <?php if(isset($_SESSION["usuario"]) && $_SESSION["usuario"]->rol_nombre=="CLIENTE"){ ?>
                <li><a href="/furaibar/Deusuario/comprar">Comprar</a></li>
                <li><a href="/furaibar/Deusuario/cuantopido">¿Cuanto pido?</a></li>
                <li><a href="/furaibar/Deusuario/reservar">Reservar Mesa</a></li>
                <?php } ?>
              </ul>
              <ul class="nav pull-right">
                <?php if(isset($_SESSION["usuario"])){ ?>
                  <li><a href="/furaibar/Users/logout">Cerrar Sesión</a></li>
                  <?php }else{ ?>
                  <li><a href="/furaibar/Deusuario/registrarme">Registrarse</a></li>
                  <li><a href="/furaibar/Users/login">Iniciar Sesión</a></li>
                  <?php } ?>
              </ul>
            </div>
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