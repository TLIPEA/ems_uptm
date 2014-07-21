<ol class="breadcrumb">
	<li><a href="<?=site_url('')?>">Inicio</a></li>
	<?php if($type!=''):?>
	<li><a href="<?=site_url('home/index/'.$event->Type)?>"><?=($type)?><?=($type=='Taller')? 'e':''?>s</a></li>
	<li><?=$event->Name?></li>
	<?php endif;?>
</ol>

<?php if(isset($typeError)):?>
	<div class="alert alert-<?=($typeError == 1 )? 'success' : 'danger';?> <?=($typeError == 0 )? 'hide' : '';?> alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<strong><?=($typeError != 0 )? $titleError : '';?></strong> <?=$msg?>.
	</div>
<?php endif;?>

<div class="row">
	<div class="col-xs-12 col-sm-4 col-md-4">
		<?php $route = base_url('images/events/'.$event->Scheduled_Event_Id.'.png');?>
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
		<?php if($event->Amount!=0):?>
		<?php if($event->Status != 'Paid' OR $event->Status != 'Free' OR $event->Status != 'Exempt'):?>
		<div class="row">
			<div class="col-xs-12 pull-right">
			  <a href="<?=site_url('event/pay/1/'.$event->Scheduled_Event_Id)?>" class="btn btn-sm btn-block btn-lg btn-appnet-inversed">
				<i class="fa fa-money"></i> Pagar
			  </a>
			</div>
		</div>
		<br>
		<?php endif;?>
		<?php endif;?>
		<?php if($event->Type=='Meeting' or $event->Type=='Conference' or $event->Type=='Congress'):?>
		<div class="row">
			<div class="col-xs-12 pull-right">
			  <a href="<?=site_url('event/postulate/1/'.$event->Scheduled_Event_Id)?>" class="btn btn-sm btn-block btn-lg btn-vimeo-inversed">
				<i class="fa fa-rocket"></i> Postularse
			  </a>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-xs-12 pull-right">
			  <a href="<?=site_url('event/applications/'.$event->Scheduled_Event_Id)?>" class="btn btn-sm btn-block btn-lg btn-gm-inversed">
				<i class="fa fa-graduation-cap"></i> Postulaciones
			  </a>
			</div>
		</div>
		<br>
		<?php endif;?>
		<div class="row">
			<div class="col-xs-12 pull-right">
			  <a href="<?=site_url('event/remove_registration/'.$event->Id)?>" class="btn btn-sm btn-block btn-lg btn-googleplus-inversed <?=($payments==0)?'':'disabled'?>" title="Solo se puede eliminar una Inscripción cuando no se tienen pagos registrados">
				<i class="fa fa-trash"></i> Eliminar Inscripción
			  </a>
			</div>
		</div>
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
	  <div class="table-responsive">
		<h4>Valido del <?=date('d-m-Y',strtotime($event->Sale_Start_Date))?> al <?=date('d-m-Y',strtotime($event->Sale_End_Date))?></h4>
		<table class="table table-hover">
		  <tr>
			<td>Categoria</td>
			<td><?=$event->Cost_Type?></td>
		  </tr>
		  <tr>
			<td>Total a Pagar</td>
			<td><?php if($event->Amount==0):?> Exonerado <?php else:?> <?=$event->Amount?> Bs<?php endif;?></td>
		  </tr>
		  <?php if($event->Amount!=0):?>
		  <tr>
			<td>Pagado</td>
			<td><?=($event->Total_Pay=='')?0:$event->Total_Pay?> Bs</td>
		  </tr>
		  <tr>
			<td>Resta</td>
			<td><?=$event->Amount-$event->Total_Pay?> Bs</td>
		  </tr>
		  <tr>
			<td>Pagos Validados</td>
			<td><?=$event->Payment_Validated?></td>
		  </tr>
		  <tr>
			<td>Pagos Sin Validar</td>
			<td><?=$event->Payment_No_Validated?></td>
		  </tr>
		  <tr>
			<td>Pagos Invalidos</td>
			<td><?=$event->Payment_Invalid?></td>
		  </tr>
		  <?php endif;?>
		</table>
	  </div>
	</div>
</div>
<hr>

<div class="row">
	<div class="page-header">
	  <h2>Pagos Registrados</h2>
	</div>
	<?php if($payments!=0):?>
	<div class="table-responsive">
	  <table class="table table-hover">
		<tr>
			<th>Banco</th>
			<th>N° Confirmación</th>
			<th>Monto</th>
			<th>Fecha</th>
			<th>Estatus</th>
		</tr>
		<?php foreach($payments as $payment):?>
		<tr>
		  <td><?=$payment->Bank?></td>
		  <td><?=$payment->Voucher_Number?></td>
		  <td><?=$payment->Amount?> Bs</td>
		  <td><?=date('d-m-Y',strtotime($payment->Payment_Date))?></td>
		  <td><?=$payment->Status?></td>
		</tr>
		<?php endforeach;?>
	  </table>
	</div>
	<?php else:?>
	<h3>No hay Pagos Registrados</h3>
	<?php endif;?>
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