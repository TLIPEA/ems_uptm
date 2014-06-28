<ol class="breadcrumb">
	<li><a href="<?=site_url('')?>">Inicio</a></li>
	<?=(isset($event)?'<li><a href="'.site_url('home/index/'.$event->Type).'">'.$type.'s</a></li>':'<li>Eventos</li>')?>
	<?=(isset($event)?'<li><a href="'.site_url('event/view/'.$event->Id).'">'.$event->Name.'</a></li>':'')?>
	<li><?=(isset($event)?'':'Mis ')?>Postulaciones</li>
</ol>

<div class="row">
	<div class="col-xs-12">
		<div class="page-header">
			<?php if(isset($event)):?>
			<a href="<?=site_url('event/postulate/1/'.$event->Id)?>" class="btn btn-sm btn-lg btn-vimeo-inversed pull-right">
				<i class="fa fa-rocket"></i> Postularse
			</a>
			<?php endif;?>
			<h2><?=$title?></h2>
		</div>
		<?php if($activitys!=0):?>
		<div class="table-responsive">
			<table class="table table-hover">
				<tr>
					<th></th>
					<?=(isset($event)?'':'<th>Evento</th> ')?>
					<th>Titulo</th>
					<th>Tipo</th>
					<th>Palabras Clave</th>
					<?=(isset($event)?'':'<th>Rol</th>')?>
					<th>Estatus</th>
					<th></th>
				</tr>
				<?php foreach($activitys as $activity):?>
				<tr>
					<td><b class="fa fa-<?=($activity->Participation_Type=='Online')?'cloud':'user'?>" title="<?=($activity->Participation_Type=='Online')?'En Linea':'Presencial'?>"></b></td>
					<?=(isset($event)?'':'<td>'.$activity->Name.'</td> ')?>
					<td><?=$activity->Title?></td>
					<td><?=$activity->Mode?></td>
					<td><?=$activity->Keywords?></td>
					<?=(isset($event)?'':'<td>'.$activity->Type.'</td>')?>
					<td><span <?php if($activity->Status=='Propuesta'): echo 'class="text-warning" title="En espera de Revisón"'; elseif($activity->Status=='Aceptada'):  echo 'class="text-success" title="Revisada y Aceptada"';elseif($activity->Status=='No Aceptada'):  echo 'class="text-danger" title="No Aceptada por el Comite"';else:  echo 'class="text-info" title="Con Correcciones por Realizar"';endif;?>><?=$activity->Status?></span></td>
					<td>
						
						<b class="fa fa-search" title="Ver Resumen" onclick="load_summary(<?=$activity->Id?>)"></b>
						<b class="fa fa-graduation-cap" title="Áreas del Saber" onclick="load_knowledges(<?=$activity->Id?>)"></b>
						<b class="fa fa-university" title="Ver Autores" onclick="load_coauthors(<?=$activity->Id?>)"></b>
						<?php if($this->session->userdata('public_ems_uptm')):
								if($activity->Status=='Aceptada'):
									if($this->Registration_Model->get_registration_with_cost_by_activity($activity->Id)!=0):
										if(!($this->Registration_Model->get_payment_status_by_activity($activity->Id)!=0)):?>
						<a href="<?=site_url('event/pay/3/'.$activity->Scheduled_Event_Id)?>" class="btn btn-success fa fa-money" title="Pagar"></a>
						<?php 			else:?>
						<b class="fa fa-check" title="<?=($this->Registration_Model->get_payment_status_by_activity($activity->Id)[0]->Amount == 0)? 'Exonerado': 'Pagado'?>"></b>
						<?php 			endif;
									endif;
								endif;
							endif;?>				
					</td>
				</tr>
				<?php endforeach;?>
			</table>
		</div>
		<?php else:?>
		<h1 class="text-center">No Hay Postulaciones Registradas</h1>
		<?php endif;?>
	</div>
</div>

<hr>
<?php $this->load->view('frontend/base/socialmedia.php');?>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body" id="myModalBody">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>