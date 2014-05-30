<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Entrar - Administrador Sistema Manejador de Eventos UPTM</title>
		<link href="<?=base_url('backend/css/bootstrap.min.css')?>" rel="stylesheet">
		<link href="<?=base_url('backend/font-awesome/css/font-awesome.css')?>" rel="stylesheet">
		<link href="<?=base_url('backend/css/sb-admin.css')?>" rel="stylesheet">
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-md-4 col-md-offset-4">
					<div class="login-panel panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title text-center">Entrar</h3>
						</div>
						<div class="panel-body">
							<?=validation_errors('<div class="alert-danger input-sm"><p><strong>','</strong> </div><br />')?>
							<form role="form" method="POST" action="<?=site_url('backend/login')?>" autocomplete="off">
								<fieldset>
									<div class="form-group">
										<label for="Username">Usuario</label>
										<input class="form-control" placeholder="Escriba su Usuario" name="Username" id="Username" value="<?=set_value('Username')?>" type="text" autofocus>
									</div>
									<div class="form-group">
										<label for="Password">Contraseña</label>
										<input class="form-control" placeholder="Escriba su Contraseña" name="Password" id="Password" type="password" value="">
									</div>
									<!-- Change this to a button or input when using this as a form -->
									<button class="btn btn-lg btn-success btn-block" type="submit">Login</a>
								</fieldset>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script src="<?=base_url('backend/js/jquery-1.10.2.js')?>"></script>
		<script src="<?=base_url('backend/js/bootstrap.min.js')?>"></script>
		<script src="<?=base_url('backend/js/plugins/metisMenu/jquery.metisMenu.js')?>"></script>
		<script src="<?=base_url('backend/js/sb-admin.js')?>"></script>
	</body>
</html>
