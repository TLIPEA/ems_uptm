<!DOCTYPE html>
<html lang="es">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="http://getbootstrap.com/assets/ico/favicon.ico">

    <title><?=$title?></title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="<?=base_url('css/bootstrap.css')?>" media="screen">
        
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="<?=base_url('css/sticky-footer.css')?>" media="screen">
        
    <!-- FontAwesome Icons-->
    <link rel="stylesheet" href="<?=base_url('css/font-awesome.min.css')?>">
        
    <!-- Brand Social   -->
    <link rel="stylesheet" href="<?=base_url('css/brand-buttons.min.css')?>">
    <link rel="stylesheet" href="<?=base_url('css/brand-buttons-inversed.min.css')?>">
        
    <!-- Custom styles for this template -->
    <link href="<?=base_url('css/home.css')?>" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style id="holderjs-style" type="text/css"></style>
  </head>

  <body role="document" style="" data-pinterest-extension-installed="cr1.3.1">
    <!-- Fixed navbar -->
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand hidden-xs" href="<?=site_url('')?>"><img class="img-responsive" src="<?=base_url('images/logo/imagotipo.png');?>" alt="Logo del la Universidad" /></a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li <?=($type=='')? 'class="active"':''?>><a href="<?=site_url('');?>">Inicio</a></li>
            <li class="hidden-lg dropdown <?=($type!='')? 'active':''?>">
                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" title="Eventos Academicos">Eventos Academicos <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="<?=site_url('home/index/Course');?>">Cursos</a></li>
                    <li><a href="<?=site_url('home/index/Practical Course');?>">Talleres</a></li>
                    <li><a href="<?=site_url('home/index/Meeting');?>">Encuentros</a></li>
                    <li><a href="<?=site_url('home/index/Seminary');?>">Seminarios</a></li>
                    <li><a href="<?=site_url('home/index/Conversational');?>">Conversatorios</a></li>
                    <li><a href="<?=site_url('home/index/Conference');?>">Jornadas</a></li>
                    <li><a href="<?=site_url('home/index/Congress');?>">Congresos</a></li>
                    <li><a href="<?=site_url('home/index/Diplomaed');?>">Diplomados</a></li>
                </ul>
            </li>
            <li class="visible-lg <?=($type=='Course')? 'active':''?>">
			  <a href="<?=site_url('home/index/Course');?>">Cursos</a></li>
            <li class="visible-lg <?=($type=='Practical%20Course')? 'active':''?>">
			  <a href="<?=site_url('home/index/Practical Course');?>">Talleres</a></li>
            <li class="visible-lg <?=($type=='Meeting')? 'active':''?>">
			  <a href="<?=site_url('home/index/Meeting');?>">Encuentros</a></li>
            <li class="visible-lg <?=($type=='Seminary')? 'active':''?>">
			  <a href="<?=site_url('home/index/Seminary');?>">Seminarios</a></li>
            <li class="visible-lg <?=($type=='Conversational')? 'active':''?>">
			  <a href="<?=site_url('home/index/Conversational');?>">Conversatorios</a></li>
            <li class="visible-lg <?=($type=='Conference')? 'active':''?>">
			  <a href="<?=site_url('home/index/Conference');?>">Jornadas</a></li>
            <li class="visible-lg <?=($type=='Congress')? 'active':''?>">
			  <a href="<?=site_url('home/index/Congress');?>">Congresos</a></li>
            <li class="visible-lg <?=($type=='Diplomaed')? 'active':''?>">
			  <a href="<?=site_url('home/index/Diplomaed');?>">Diplomados</a></li>
            <li><a href="<?=site_url('home/contact/');?>">Contacto</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
			  <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" title="Inicio de Sesion y Registro"><i class="fa fa-user" style="font-size: 20px;"></i></a>
              <ul class="dropdown-menu login-menu">
                <form role="form" class="form-horizontal" action="<?=site_url('frontend/login/');?>" method="POST">
                    <div class="col-md-12 text-center form-login">
                        <h4>Inicio de Sesión</h4>
                        <input type="text" class="form-control" name="Username" placeholder="Usuario" />
                        <input type="password" class="form-control" name="Password" placeholder="Contraseña" />
                        <input type="submit" value="Ingresar" class="btn btn-info" />
                        <hr>
                        <h4><a href="<?=site_url('frontend/sign_in/');?>">Registrarse</a></h4>
                    </div>
                </form>
			  </ul>
			</li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
	
	<div class="container theme-showcase" role="main">
        <div class="row" style="margin-top: 100px;">
            
        </div>
		<?php include('home.php');?>
	</div>
	<div id="footer">
        <div class="container">
            <div class="text-center">
                <p>Todos los Derechos y Zurdos Reservados de la UPTM Kleber Ramirez.<br>Diseño y Desarrollo de <a href="http://styp152.com.ve">Typson Sánchez</a></p>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?=base_url('js/jquery.min.js')?>"></script>
    <script src="<?=base_url('js/bootstrap.min.js')?>"></script>
  </body>
</html>