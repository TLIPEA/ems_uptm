<?php
if(isset($costs))
{
	if($costs!=0)
	{
		$options[] = 'Seleccione';
		foreach($costs as $cost)
		{
			if($cost->Type!='Ponentes')
			$options[$cost->Id] = $cost->Type.' - '.$cost->Amount;
		}
	}
	else
	{
		$options[] = 'No hay Costos disponibles';
	}
}

if(isset($events))
{
	if($events!=0)
	{
		$options[] = 'Seleccione';
		foreach($events as $event)
		{
			$options[$event->Id] = $event->Name.' - '.date('d-m-Y',strtotime($event->Start_Date)).' al '.date('d-m-Y',strtotime($event->End_Date));
		}
	}
	else
	{
		$options[] = 'No hay Eventos disponibles';
	}
}

if(!isset($name))
{
	$phase = 3;
}
else
{
	$phase = 2;
}
?>
<ol class="breadcrumb">
	<li><a href="<?=site_url('')?>">Inicio</a></li>
	<li>Eventos</li>
	<li>Inscripción</li>
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
		<form role="form" action="<?=site_url('event/registration/'.$phase.'/'.(isset($events)?'':$event->Id))?>" method="POST" class="form-horizontal">
			<?php if(isset($events)):?>
			<?php echo form_error('Scheduled_Event_Id','<div class="alert alert-danger alert-dismissable">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><strong>Error!</strong> ','.</div>'); ?>
			<div class="form-group">
				<label class="col-sm-2 hidden-xs" for="">Evento</label>
				<div class="col-sm-10">
					<?=form_dropdown('Scheduled_Event_Id', $options, (set_value('Scheduled_Event_Id')),
                                               'id="Scheduled_Event_Id" required="" class="form-control" onchange="load_cost_by_event()"');?>
				</div>
			</div>
			<?php else:?>
			<input type="hidden" name="Scheduled_Event_Id" value="<?=$event->Id?>" />
			<?php endif;?>
			<?php echo form_error('Cost_Id','<div class="alert alert-danger alert-dismissable">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><strong>Error!</strong> ','.</div>'); ?>
			<div class="form-group">
				<label class="col-sm-2 hidden-xs" for="">Categoria</label>
				<div class="col-sm-10" id="Cost_Id">
					<?php if(isset($costs)):?>
					<?=form_dropdown('Cost_Id', $options, (set_value('Cost_Id')),
                                               'required="" class="form-control"');?>
					<?php else:?>
					<?=form_dropdown('Cost_Id', array(''=>'Seleccione el Evento Primero'), (set_value('Cost_Id')),
                                               'required="" class="form-control"');?>
					<?php endif;?>
				</div>
			</div>
			<?php if(!isset($name)):?>
			<?php echo form_error('DNI','<div class="alert alert-danger alert-dismissable">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><strong>Error!</strong> ','.</div>'); ?>
			<div class="form-group">
				<label class="col-sm-2 hidden-xs" for="">Cedula</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="DNI" placeholder="Cedula" required="" />
				</div>
			</div>
			<?php echo form_error('Name','<div class="alert alert-danger alert-dismissable">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><strong>Error!</strong> ',
									'.</div>'); ?>
			<div class="form-group">
				<label class="col-sm-2 hidden-xs" for="">Nombre</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="Name" placeholder="Nombre" required="" />
				</div>
			</div>
			<?php echo form_error('Last_Name','<div class="alert alert-danger alert-dismissable">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><strong>Error!</strong> ',
									'.</div>'); ?>
			<div class="form-group">
				<label class="col-sm-2 hidden-xs" for="">Apellido</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="Last_Name" placeholder="Apellido" required="" />
				</div>
			</div>
			<?php echo form_error('Email','<div class="alert alert-danger alert-dismissable">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><strong>Error!</strong> ',
									'.</div>'); ?>
			<div class="form-group">
				<label class="col-sm-2 hidden-xs" for="">Correo Electronico</label>
				<div class="col-sm-10">
					<input type="email" class="form-control" name="Email" placeholder="Correo Electronico" required="" />
				</div>
			</div>
			<?php echo form_error('Username','<div class="alert alert-danger alert-dismissable">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><strong>Error!</strong> ',
									'.</div>'); ?>
			<div class="form-group">
				<label class="col-sm-2 hidden-xs" for="">Usuario</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="Username" placeholder="Usuario" required="" />
				</div>
			</div>
			<?php echo form_error('Password','<div class="alert alert-danger alert-dismissable">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><strong>Error!</strong> ',
									'.</div>'); ?>
			<div class="form-group">
				<label class="col-sm-2 hidden-xs" for="">Contraseña</label>
				<div class="col-sm-10">
					<input type="password" class="form-control" name="Password" placeholder="Contraseña" required="" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 hidden-xs" for="">Repetir Contraseña</label>
				<div class="col-sm-10">
					<input type="password" class="form-control" name="Password2" placeholder="Repetir Contraseña" required="" />
				</div>
			</div>
			<?php else:?>
			<input type="hidden" name="Participant_Id" value="<?=$this->session->userdata('public_ems_uptm')['Participant_Id']?>" />
			<?php endif;?>
			<div class="form-group">
					<input type="submit" value="Inscribirse" class="btn btn-info pull-right" />
			</div>
		</form>
	</div>
</div>

<hr>
<?php $this->load->view('frontend/base/socialmedia.php');?>