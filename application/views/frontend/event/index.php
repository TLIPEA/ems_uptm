<ol class="breadcrumb">
	<li><a href="<?=site_url('')?>">Inicio</a></li>
	<li>Eventos</li>
	<li>Mis Eventos</li>
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
	</div>
	<?php $count = 0;?>
	<?php if($events!=0):?>
	<?php foreach($events as $event):?>
	
		<?php if($count == 0 or $count%4 == 0):?>
		<div class="row">
		<?php endif;?>
		
		<div class="col-sm-3">
			<div class="panel panel-info">
			  <div class="panel-heading">
				<h3 class="panel-title"><?=$event->Type?></h3>
			  </div>
			  <div class="panel-body text-center">
				<?php $route = base_url('images/events/'.$event->Id.'.png');?>
				<img class="img img-responsive img-thumbnail" src="<?=$route?>"
						alt="Logo del Evento" title="<?=$event->Name?>" />
				<h4><?=$event->Name?></h4>
				<h5><?=date('d-m-Y',strtotime($event->Start_Date))?> al <?=date('d-m-Y',strtotime($event->End_Date))?></h5>
				<h5><?=date('g:i A',strtotime($event->Start_Date))?> a <?=date('g:i A',strtotime($event->End_Date))?></h5>
			  </div>
			  <div class="panel-footer">
				<a href="<?=site_url('event/view/'.$event->Id);?>"
					class="btn btn-block btn-primary">Detalles</a>
			  </div>
			</div>
		</div>
		<?php $count++;?>
		
		<?php if($count%4 == 0):?>
		</div>
		
		<hr>
		<?php endif;?>
	<?php endforeach;?>
		<?php if($count%4 != 0):?>
			</div>
			<hr>
		<?php endif;?>
	<?php else:?>
	<h2>No hay Eventos Disponibles</h2>
	<hr>
<?php endif;?>
</div>

<hr>
<?php $this->load->view('frontend/base/socialmedia.php');?>