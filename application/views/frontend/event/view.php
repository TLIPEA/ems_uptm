<ol class="breadcrumb">
	<li><a href="<?=site_url('')?>">Inicio</a></li>
	<?php if($type!=''):?>
	<li><a href="<?=site_url('home/index/'.$event->Type)?>"><?=($type)?><?=($type=='Taller')? 'e':''?>s</a></li>
	<li><?=$event->Name?></li>
	<?php endif;?>
</ol>

<div class="row">
	<div class="col-xs-12 col-sm-4 col-md-4">
		<?php $route = base_url('images/events/'.$event->Id.'.png');?>
		<img class="img img-responsive img-thumbnail" src="<?=$route?>"
				alt="Logo del Evento" title="<?=$event->Name?>" />
	</div>
	<div class="col-xs-12 col-sm-5 col-md-6">
		<h3><?=$type?> - <?=$event->Name?></h3>
		<h4><?=$event->Slogan?></h4>
		<h5><?=date('d-m-Y',strtotime($event->Start_Date))?> al
			<?=date('d-m-Y',strtotime($event->End_Date))?></h5>
		<h5><?=date('g:i A',strtotime($event->Start_Date))?> a <?=date('g:i A',strtotime($event->End_Date))?></h5>
		<h5><?=$event->Hours?> Horas Academicas</h5>
	</div>
	<div class="col-xs-12 col-sm-3 col-md-2">
		<div class="row">
			<div class="col-xs-12 pull-right">
			  <a href="<?=site_url('event/registration/1/'.$event->Id)?>" class="btn btn-sm btn-block btn-lg btn-appnet-inversed">
				<i class="fa fa-ticket"></i> Inscribirse
			  </a>
			</div>
		</div>
		<br>
		<?php if($event->Type=='Meeting' or $event->Type=='Conference' or $event->Type=='Congress'):?>
		<div class="row">
			<div class="col-xs-12 pull-right">
			  <a href="<?=site_url('event/postulate/1/'.$event->Id)?>" class="btn btn-sm btn-block btn-lg btn-vimeo-inversed">
				<i class="fa fa-rocket"></i> Postularse
			  </a>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-xs-12 pull-right">
			  <a href="<?=site_url('event/applications/'.$event->Id)?>" class="btn btn-sm btn-block btn-lg btn-gm-inversed">
				<i class="fa fa-graduation-cap"></i> Postulaciones
			  </a>
			</div>
		</div>
		<?php endif;?>
	</div>	
</div>
	
<hr>
  
<div class="row">
	<div class="col-xs-12">
	  <p style="font-size: larger;"><?=$event->Purpose?></p>
	</div>
</div>
  
<hr>
  
<div class="row">
	<div class="col-xs-12 col-sm-7">
	  <div class="page-header">
		<h2>Áreas del Saber</h2>
	  </div>
	  <ol>
		<?php if($knowledges != 0):?>
		<?php foreach($knowledges as $knowledge):?>
		<li><span><?=$knowledge->Content?></li>
		<?php endforeach;?>
		<?php endif;?>
	  </ol>
	</div>
	<div class="col-xs-12 col-sm-5">
	  <div class="page-header">
		<h2>Costos</h2>
	  </div>
	  <?php $pivot = 0;?>
	  <?php if(isset($costs)):?>
	  <?php foreach($costs as $cost):?>
		<?php if($cost->Sale_Id != $pivot):?>
			<?php if($pivot!=0):?>
				</table>
			</div>
			<?php endif;?>
			<?php $pivot = $cost->Sale_Id?>
			<div class="table-responsive">
				<h4>Valido del <?=date('d-m-Y',strtotime($cost->Start_Date))?> al
					<?=date('d-m-Y',strtotime($cost->End_Date))?></h4>
				<table class="table table-hover">
					<tr>
						<td><?=$cost->Type?></td>
						<td class="text-right"><?=($cost->Amount==0)?'Exonerado':$cost->Amount?></td>
					</tr>
		<?php else:?>
					<tr>
						<td><?=$cost->Type?></td>
						<td class="text-right"><?=($cost->Amount==0)?'Exonerado':$cost->Amount?></td>
					</tr>
		<?php endif;?>
	  <?php endforeach;?>
				</table>
			</div>
	  <?php endif;?>
	</div>
</div>
<hr>
<div class="row">
  <div class="col-xs-3 col-sm-3 col-md-3">
	  <a href="https://www.facebook.com/pages/UPTM-Universidad-Polit%C3%A9cnica-Territorial-de-M%C3%A9rida-Kl%C3%A9ber-Ram%C3%ADrez/353865214710431" class="btn btn-sm btn-block btn-lg btn-facebook-inversed">
		<i class="fa fa-facebook"></i> <span class="hidden-xs">Facebook</span>
	  </a>
  </div>
  
  <div class="col-xs-3 col-sm-3 col-md-3">
	  <a href="https://twitter.com/UPTMKR" class="btn btn-sm btn-block btn-lg btn-twitter-inversed">
		<i class="fa fa-twitter"></i> <span class="hidden-xs">Twitter</span>
	  </a>
	</div>
  
  <div class="col-xs-3 col-sm-3 col-md-3">
	  <a href="http://instagram.com" class="btn btn-sm btn-block btn-lg btn-instagram-inversed">
		<i class="fa fa-instagram"></i> <span class="hidden-xs">Instagram</span>
	  </a>
  </div>
  
  <div class="col-xs-3 col-sm-3 col-md-3">
	  <a href="http://youtube.com" class="btn btn-sm btn-block btn-lg btn-youtube-inversed">
		<i class="fa fa-youtube"></i> <span class="hidden-xs">Youtube</span>
	  </a>
  </div>
</div>