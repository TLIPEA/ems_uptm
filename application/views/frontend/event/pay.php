<?php
if($accounts!=0)
{
	$options[] = 'Seleccione';
	foreach($accounts as $account)
	{
		$options[$account->Id] = $account->Bank.' - '.$account->Number;
	}
}
else
{
	$options[] = 'No hay Cuentas disponibles';
}
?>
<ol class="breadcrumb">
	<li><a href="<?=site_url('')?>">Inicio</a></li>
	<li>Eventos</li>
	<li><a href="<?=site_url('event/admin/'.$event[0]->Scheduled_Event_Id)?>"><?=$event[0]->Name?></a></li>
	<li>Pago</li>
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
		<form role="form" action="<?=site_url('event/pay/2/'.$event[0]->Scheduled_Event_Id)?>" method="POST" class="form-horizontal">
			<?php echo form_error('Account_Id','<div class="alert alert-danger alert-dismissable">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><strong>Error!</strong> ','.</div>'); ?>
			<input type="hidden" name="Registration_Id" value="<?=$event[0]->Id?>" />
			<div class="form-group">
				<label class="col-sm-2 hidden-xs" for="">Banco</label>
				<div class="col-sm-10">
					<?=form_dropdown('Account_Id', $options, (set_value('Account_Id')),
                                               'required="" class="form-control"');?>
				</div>
			</div>
			<?php echo form_error('Payment_Date','<div class="alert alert-danger alert-dismissable">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><strong>Error!</strong> ','.</div>'); ?>
			<div class="form-group">
				<label class="col-sm-2 hidden-xs" for="">Fecha de Pago</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" data-date-format="YYYY-MM-DD" id="Payment_Date" name="Payment_Date" placeholder="Fecha de Realización del Pago" required="" />
				</div>
			</div>
			<?php echo form_error('Voucher_Number','<div class="alert alert-danger alert-dismissable">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><strong>Error!</strong> ','.</div>'); ?>
			<div class="form-group">
				<label class="col-sm-2 hidden-xs" for="">N° Confirmación</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="Voucher_Number" placeholder="Número de Confirmación" required="" />
				</div>
			</div>
			<?php echo form_error('Amount','<div class="alert alert-danger alert-dismissable">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><strong>Error!</strong> ',
									'.</div>'); ?>
			<div class="form-group">
				<label class="col-sm-2 hidden-xs" for="">Monto</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="Amount" placeholder="Monto" required="" />
				</div>
			</div>
			<div class="form-group">
					<input type="submit" value="Registrar" class="btn btn-info pull-right" />
			</div>
		</form>
	</div>
</div>

<hr>
<?php $this->load->view('frontend/base/socialmedia.php');?>