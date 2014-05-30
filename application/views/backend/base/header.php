<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
		<title>Administrador Sistema Manejador de Eventos UPTM</title>
	
		<!-- Core CSS - Include with every page -->
		<link href="<?=base_url('backend/css/bootstrap.min.css')?>" rel="stylesheet">
		<link href="<?=base_url('backend/font-awesome/css/font-awesome.css')?>" rel="stylesheet">
		
		<!-- SB Admin CSS - Include with every page -->
		<link href="<?=base_url('backend/css/sb-admin.css')?>" rel="stylesheet">
	
		<?php if($controller == 'Home'): ?>
			<!-- Page-Level Plugin CSS - Dashboard -->
			<link href="<?=base_url('backend/css/plugins/morris/morris-0.4.3.min.css')?>" rel="stylesheet">
			<link href="<?=base_url('backend/css/plugins/timeline/timeline.css')?>" rel="stylesheet">
		<?php elseif ($controller == 'Job' or $controller == 'Tag' or $controller == 'Category' or $controller == 'User'): ?>
			<link href="<?=base_url('backend/css/plugins/dataTables/dataTables.bootstrap.css')?>" rel="stylesheet">
		<?php elseif ($controller == 'New_Job' or $controller == 'New_Entry'): ?>
			<link href="<?=base_url('backend/css/plugins/summernote/summernote.css')?>" rel="stylesheet">
			<link href="<?=base_url('backend/css/plugins/summernote/summernote-bs3.css')?>" rel="stylesheet">
		<?php endif; ?>

	</head>
	<body>
		<div id="wrapper">
			<nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="<?=site_url('backend/index')?>">Sistema Manejador de Eventos de la Universidad Politécnica Territorial de Mérida "Kléber Ramírez"</a>
				</div>
				<!-- /.navbar-header -->
	
				<ul class="nav navbar-top-links navbar-right">
					<!-- /.dropdown -->
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">
							<i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
						</a>
						<ul class="dropdown-menu dropdown-user">
							<li><a href="<?=site_url('user/view/')?>"><i class="fa fa-user fa-fw"></i> Perfil de Usuario</a>
							</li>
							<li><a href="#"><i class="fa fa-gear fa-fw"></i> Configuración</a>
							</li>
							<li class="divider"></li>
							<li><a href="<?=site_url('backend/logout')?>"><i class="fa fa-sign-out fa-fw"></i> Cerrar Sesión</a>
							</li>
						</ul>
						<!-- /.dropdown-user -->
					</li>
					<!-- /.dropdown -->
				</ul>
				<!-- /.navbar-top-links -->
	
				<div class="navbar-default navbar-static-side" role="navigation">
					<div class="sidebar-collapse">
						<ul class="nav" id="side-menu">
							<li>
								<a href="<?=site_url('backend/index')?>"><i class="fa fa-home fa-fw"></i> Inicio</a>
							</li>
							<li>
								<a href="<?=site_url('job/index')?>"><i class="fa fa-cogs fa-fw"></i> Administración<span class="fa arrow"></span></a>
								<ul class="nav nav-second-level">
									<li>
										<a href="<?=site_url('job/index')?>">Cuentas</a>
									</li>
									<li>
										<a href="<?=site_url('job/new_job')?>">Respaldo</a>
									</li>
								</ul>
								<!-- /.nav-second-level -->
							</li>
							<li>
								<a href="<?=site_url('job/index')?>"><i class="fa fa-thumb-tack fa-fw"></i> Eventos<span class="fa arrow"></span></a>
								<ul class="nav nav-second-level">
									<li>
										<a href="<?=site_url('job/index')?>">Eventos</a>
									</li>
									<li>
										<a href="<?=site_url('job/new_job')?>">Preventas</a>
									</li>
								</ul>
								<!-- /.nav-second-level -->
							</li>
							<li>
								<a href="#"><i class="fa fa-users fa-fw"></i> Participantes<span class="fa arrow"></span></a>
								<ul class="nav nav-second-level">
									<li>
										<a href="<?=site_url('blog/index')?>">Inscripción</a>
									</li>
									<li>
										<a href="<?=site_url('blog/new_entry')?>">Pagos</a>
									</li>
								</ul>
								<!-- /.nav-second-level -->
							</li>
							<li>
								<a href="#"><i class="fa fa-picture-o fa-fw"></i> Certificados<span class="fa arrow"></span></a>
								<ul class="nav nav-second-level">
									<li>
										<a href="<?=site_url('team/index')?>">Diseño</a>
									</li>
									<li>
										<a href="<?=site_url('team/new_worker')?>">Impresión</a>
									</li>
								</ul>
								<!-- /.nav-second-level -->
							</li>							
							<li>
								<a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Reportes</span></a>
							</li>
							<li>
								<a href="#"><i class="fa fa-user fa-fw"></i> Acceso<span class="fa arrow"></span></a>
								<ul class="nav nav-second-level">
									<li>
										<a href="<?=site_url('user/index')?>">Usuarios</a>
									</li>
									<li>
										<a href="<?=site_url('user/new_user')?>">Añadir Usuario</a>
									</li>
								</ul>
							</li>
						</ul>
						<!-- /#side-menu -->
					</div>
					<!-- /.sidebar-collapse -->
				</div>
				<!-- /.navbar-static-side -->
			</nav>

