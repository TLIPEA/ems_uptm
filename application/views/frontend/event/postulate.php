<?php
$options_mode = array(''                 => 'Seleccione',
					  'Oral Speech'      => 'Ponencia',
					  'Practical Course' => 'Taller',
					  'Cartel'           => 'Cartel',
					  'Conversational'   => 'Conversatorio');

$options_type = array(''          =>  'Seleccione',
					  'Online'    =>  'En Linea',
					  'Classroom' =>  'Presencial',);
if(isset($knowledges))
{
	if($knowledges!=0)
	{
		$options_knowledges[] = 'Seleccione';
		foreach($knowledges as $knowledge)
		{
			$options_knowledges[$knowledge->Id] = $knowledge->Content;
		}
	}
	else
	{
		$options_knowledges[] = 'No hay Saberes Asociados';
	}
}
					  
if(isset($costs))
{
	if($costs!=0)
	{
		$options[] = 'Seleccione';
		foreach($costs as $cost)
		{
			if($cost->Type=='Ponentes')
			$options[$cost->Id] = $cost->Type.' - '.(($cost->Amount==0)?'Exonerado':$cost->Amount.'Bs');
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
	<?=(isset($event)?'<li><a href="'.site_url('event/view/'.$event->Id).'">'.$event->Name.'</a></li>':'')?>
	<li>Postularse</li>
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
		<form role="form" action="<?=site_url('event/postulate/'.$phase.'/'.(isset($events)?'':$event->Id))?>" method="POST" class="form-horizontal">
			<?php if(isset($events)):?>
			<?php echo form_error('Scheduled_Event_Id','<div class="alert alert-danger alert-dismissable">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><strong>Error!</strong> ','.</div>'); ?>
			<div class="form-group">
				<label class="col-sm-2 hidden-xs" for="">Evento</label>
				<div class="col-sm-10">
					<?=form_dropdown('Scheduled_Event_Id', $options, (set_value('Scheduled_Event_Id')),
                                               'id="Scheduled_Event_Id" required="" class="form-control" onchange="load_cost_by_event_for_falitator()"');?>
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
			<?php echo form_error('Knowledge_Id	','<div class="alert alert-danger alert-dismissable">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><strong>Error!</strong> ','.</div>'); ?>
			<div class="form-group">
				<label class="col-sm-2 hidden-xs" for="">Área del Saber Asociada</label>
				<div class="col-sm-10" id="Knowledge_Id">
					<?php if(isset($knowledges)):?>
					<?=form_dropdown('Knowledge_Id', $options_knowledges, (set_value('Knowledge_Id')),
                                               'required="" class="form-control"');?>
					<?php else:?>
					<?=form_dropdown('Knowledge_Id', array(''=>'Seleccione el Evento Primero'),
									 (set_value('Knowledge_Id')),'required="" class="form-control"');?>
					<?php endif;?>
				</div>
			</div>
			<?php echo form_error('Title','<div class="alert alert-danger alert-dismissable">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><strong>Error!</strong> ','.</div>'); ?>
			<div class="form-group">
				<label class="col-sm-2 hidden-xs" for="">Titulo de la Actividad</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="Title" placeholder="Titulo de la Actividad" required="" />
				</div>
			</div>
			<?php echo form_error('Mode','<div class="alert alert-danger alert-dismissable">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><strong>Error!</strong> ','.</div>'); ?>
			<div class="form-group">
				<label class="col-sm-2 hidden-xs" for="">Tipo de Actividad</label>
				<div class="col-sm-10">
					<?=form_dropdown('Mode', $options_mode, (set_value('Mode')),
                                    ' required="" class="form-control"');?>
				</div>
			</div>
			<?php echo form_error('Keywords','<div class="alert alert-danger alert-dismissable">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><strong>Error!</strong> ','.</div>'); ?>
			<div class="form-group">
				<label class="col-sm-2 hidden-xs" for="">Palabras Claves</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="Keywords" placeholder="Palabras Claves, separadas por coma" required="" />
				</div>
			</div>
			<?php echo form_error('Summary_Words','<div class="alert alert-danger alert-dismissable">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><strong>Error!</strong> ','.</div>'); ?>
			<div class="form-group">
				<label class="col-sm-2 hidden-xs" for="">Resumen</label>
				<div class="col-sm-10">
					<textarea name="Summary_Words" rows="5" class="form-control" style="resize: none;" placeholder="Maximo 300 palabras"></textarea>
				</div>
			</div>
			<?php echo form_error('Participation_Type','<div class="alert alert-danger alert-dismissable">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><strong>Error!</strong> ','.</div>'); ?>
			<div class="form-group">
				<label class="col-sm-2 hidden-xs" for="">Tipo de Participación</label>
				<div class="col-sm-10">
					<?=form_dropdown('Participation_Type', $options_type, (set_value('Participation_Type')),
                                    ' required="" class="form-control"');?>
				</div>
			</div>
			<?php echo form_error('Institution','<div class="alert alert-danger alert-dismissable">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><strong>Error!</strong> ','.</div>'); ?>
			<div class="form-group">
				<label class="col-sm-2 hidden-xs" for="">Institución y/o Comunidad</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="Institution" placeholder="Institución y/o Comunidad" required="" />
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
			<hr>
			<div class="page-header">
				<div class="pull-right">
					<a href="javascript:void(0)" class="btn btn-primary" onclick="add_input_author()">
						<b class="fa fa-plus"></b></a>
				</div>
				<h2>Añadir CoAutores</h2>
			</div>
			<div class="alert alert-warning">
				<strong>Advertencia</strong> Añadir CoAutores no es Obligante.
			</div>
			<input type="hidden" name="authors" id="authors" value="0" />
			<div id="divAuthors"></div>
			<div class="form-group text-center">
					<input type="submit" value="Postularse" class="btn btn-info" />
			</div>
		</form>
	</div>
</div>

<hr>
<?php $this->load->view('frontend/base/socialmedia.php');?>