<ol class="breadcrumb">
	<li><a href="<?=site_url('')?>">Inicio</a></li>
	<li>Contacto</li>
</ol>

<div class="page-header">
  <h3>Contacto</h3>
</div>
	
<div class="row">
	<div class="col-xs-12 col-sm-6">
		<form role="form" action="" method="POST" class="form-vertical">
			<div class="form-group">
				<label for="">Nombre Completo</label>
				<input type="text" name="" placeholder="" class="form-control" />
			</div>
			<div class="form-group">
				<label for="">Correo</label>
				<input type="text" name="" placeholder="" class="form-control" />
			</div>
			<div class="form-group">
				<label for="">Asunto</label>
				<textarea name="" placeholder="" class="form-control" style="resize: none;"></textarea>
			</div>
			<div class="form-group">
				Deseo recibir una copia del Correo
				<input type="checkbox" name="" value="1" />
				<input type="submit" value="Enviar" class="btn btn-success pull-right" />
			</div>
		</form>
	</div>
	<div class="col-xs-12 col-sm-6">
		Colocar Mapita
		<!-- TODO Mapa 8.5506911,-71.2330431 -->
	</div>
</div>

<hr>

<?php include('socialmedia.php');?>