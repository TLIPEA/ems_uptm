<ol class="breadcrumb">
	<li><a href="<?=site_url('')?>">Inicio</a></li>
	<?php if($type!=''):?>
	<li><?=urldecode($type)?></li>
	<?php endif;?>
</ol>

<?php $count = 0;?>
<?php if($events!=0):?>
	<div class="page-header">
	  <h2>Proximos Eventos</h2>
	</div>
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
				<h5><?=$event->Start_Date?> al <?=$event->End_Date?></h5>
				<h5><?=$event->Start_Date?> al <?=$event->End_Date?></h5>
			  </div>
			  <div class="panel-footer">
				<a href="<?=site_url('events/view/'.$event->Id);?>"
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

<div class="row">
  <div class="col-xs-3 col-sm-3 col-md-3">
	  <a href="" class="btn btn-sm btn-block btn-lg btn-facebook-inversed">
		<i class="fa fa-facebook"></i> <span class="hidden-xs">Facebook</span>
	  </a>
  </div>
  
  <div class="col-xs-3 col-sm-3 col-md-3">
	  <a href="" class="btn btn-sm btn-block btn-lg btn-twitter-inversed">
		<i class="fa fa-twitter"></i> <span class="hidden-xs">Twitter</span>
	  </a>
	</div>
  
  <div class="col-xs-3 col-sm-3 col-md-3">
	  <a href="" class="btn btn-sm btn-block btn-lg btn-instagram-inversed">
		<i class="fa fa-instagram"></i> <span class="hidden-xs">Instagram</span>
	  </a>
  </div>
  
  <div class="col-xs-3 col-sm-3 col-md-3">
	  <a href="" class="btn btn-sm btn-block btn-lg btn-youtube-inversed">
		<i class="fa fa-youtube"></i> <span class="hidden-xs">Youtube</span>
	  </a>
  </div>
</div>