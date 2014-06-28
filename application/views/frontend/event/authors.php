<ol class="breadcrumb">
	<li><a href="<?=site_url('')?>">Inicio</a></li>
	<li>Eventos</li>
	<?=(isset($event)?'<li><a href="'.site_url('event/view/'.$event->Id).'">'.$event->Name.'</a></li>':'')?>
	<li>Postularse</li>
	<li>CoAutores</li>
</ol>

<?php if(isset($typeError)):?>
	<div class="alert alert-<?=($typeError == 1 )? 'success' : 'danger';?> <?=($typeError == 0 )? 'hide' : '';?> alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<strong><?=($typeError != 0 )? $titleError : '';?></strong> <?=$msg?>.
	</div>
<?php endif;?>

<div class="row">
	<div class="col-xs-12">
		<div class="page-header">
			<h2><?=$title?></h2>
		</div>
		<div class="alert alert-warning">
			<strong>Advertencia</strong> Recuerda que si postulas una actividad, tu quedaras como el facilitador de la misma y podras registrar a los CoAutores.
		</div>
		<form role="form" action="<?=site_url('event/postulate/5/')?>" method="POST" class="form-horizontal">
			<?php if(isset($authors)):?>
			<?php $count = 0;?>
			<?php foreach($authors as $author):?>
				<div class="page-header">
					<h4>CoAutor <?=$count+1?></h4>
				</div>
				<input type="hidden" name="Id[]" value="<?=($author!=0)? $author[0]->Id: 0?>" />
				<?php echo form_error('DNI[]','<div class="alert alert-danger alert-dismissable">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><strong>Error!</strong> ','.</div>'); ?>
				<div class="form-group">
					<label class="col-sm-2 hidden-xs" for="">Cedula</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="DNI[]" placeholder="Cedula" required="" value="<?=($author!=0)? $author[0]->DNI: $authors_backup[$count]?>" readonly="readonly"/>
					</div>
				</div>
				<?php echo form_error('Name[]','<div class="alert alert-danger alert-dismissable">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><strong>Error!</strong> ',
										'.</div>'); ?>
				<div class="form-group">
					<label class="col-sm-2 hidden-xs" for="">Nombre</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="Name[]" placeholder="Nombre" required="" value="<?=($author!=0)? $author[0]->Name: ''?>" <?=($author!=0)? 'readonly="readonly"':''?>/>
					</div>
				</div>
				<?php echo form_error('Last_Name[]','<div class="alert alert-danger alert-dismissable">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><strong>Error!</strong> ',
										'.</div>'); ?>
				<div class="form-group">
					<label class="col-sm-2 hidden-xs" for="">Apellido</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="Last_Name[]" placeholder="Apellido" required="" value="<?=($author!=0)? $author[0]->Last_Name: ''?>" <?=($author!=0)? 'readonly="readonly"':''?> />
					</div>
				</div>
				<?php echo form_error('Email[]','<div class="alert alert-danger alert-dismissable">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><strong>Error!</strong> ',
										'.</div>'); ?>
				<div class="form-group">
					<label class="col-sm-2 hidden-xs" for="">Correo Electronico</label>
					<div class="col-sm-10">
						<input type="email" class="form-control" name="Email[]" placeholder="Correo Electronico" required="" value="<?=($author!=0)? $author[0]->Email: ''?>" <?=($author!=0)? 'readonly="readonly"':''?> />
					</div>
				</div>
				<?php echo form_error('Institution[]','<div class="alert alert-danger alert-dismissable">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><strong>Error!</strong> ','.</div>'); ?>
				<div class="form-group">
					<label class="col-sm-2 hidden-xs" for="">Institución y/o Comunidad</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="Institution[]" placeholder="Institución y/o Comunidad" required="" value="" />
					</div>
				</div>
			<?php $count++;?>
			<?php endforeach;?>
			<?php endif;?>
				<input type="hidden" name="Activity_Id" value="<?=$Activity_Id?>" />
				<div class="form-group text-center">
					<input type="submit" value="Registrar" class="btn btn-info" />
				</div>
		</form>
	</div>
</div>

<hr>
<?php $this->load->view('frontend/base/socialmedia.php');?>