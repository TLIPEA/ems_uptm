<?php
if($participants!=0)
{
	$options[] = 'Seleccione';
	foreach($participants as $participant)
	{
		$options[$participant->Id] = $participant->DNI.' - '.$participant->Name.' '.$participant->Last_Name;
	}
}
else
{
	$options[] = 'No hay Participantes disponibles';
}
if($accounts!=0)
{
	$options2[] = 'Seleccione';
	foreach($accounts as $account)
	{
		$options2[$account->Id] = $account->Bank.' - '.$account->Number;
	}
}
else
{
	$options2[] = 'No hay Cuentas disponibles';
}
?>
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Participantes</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Nuevo Pago <?=(isset($event))? ' en '.$event[0]->Name:''?>
							<div class="pull-right"><a class="btn btn-warning btn-xs" href="<?=site_url('payment/index/'.$event[0]->Id)?>">Pagos en el Evento</a></div>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
									<?=form_open('payment/new_pay/'.$id.'/'.$event[0]->Id.'/2', array('role'=>'form','autocomplet'=>'off','class'=>'form-horizontal'))?>
									<?=validation_errors('<div class="alert-danger input-sm"><p><strong>','</strong> </div><br />')?>
									<?php if(isset($typeError)):?>
									<div class="col-md-12">
									<div class="alert alert-<?=($typeError == 1 )? 'success' : 'danger';?> <?=($typeError == 0 )? 'hide' : '';?> alert-dismissable">
											<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
											<strong><?=($typeError != 0 )? $titleError : '';?></strong> <?=$msg?>.
												</div>
									</div>
									<?php endif;?>
									<?php if($id==0):?>
									<div class="form-group">
										<label class="col-sm-2 hidden-xs" for="">Participante</label>
										<div class="col-sm-10">
											<?=form_dropdown('Registration_Id', $options, (set_value('Registration_Id')),'required class="form-control"');?>
										</div>
									</div>
									<?php else:?>
									<input type="hidden" name="Registration_Id" value="<?=$id?>" />
									<?php endif;?>
									<div class="form-group">
										<label class="col-sm-2 hidden-xs" for="">Banco</label>
										<div class="col-sm-10">
											<?=form_dropdown('Account_Id', $options2, (set_value('Account_Id')),
																	   'required class="form-control"');?>
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
										<div class="col-md-1 pull-right text-center">
											<button type="reset" class="btn btn-info ">Limpiar</button>
										</div>
										<div class="col-md-1 pull-right text-center">
										<button type="submit" class="btn btn-success pull-right">Guardar</button>
										</div>
                                    </form>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                                
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>