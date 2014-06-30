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
                    Pagos <?=(isset($event))? ' en '.$event[0]->Name:''?>
					<?php if(isset($event)):?>
					<div class="pull-right">
						<a title="Añadir Nuevo Pago" class="btn btn-info btn-xs" href="<?=site_url('payment/new_pay/0/'.$event[0]->Id)?>"> <i class="fa fa-plus"></i> Añadir Nuevo Pago</a>
					</div>
					<?php endif;?>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
					<?php if(isset($typeError)):?>
						<div class="col-md-12">
							<div class="alert alert-<?=($typeError == 1 )? 'success' : 'danger';?> <?=($typeError == 0 )? 'hide' : '';?> alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<strong><?=($typeError != 0 )? $titleError : '';?></strong> <?=$msg?>.
							</div>
						</div>
					<?php endif;?>
					<?php if ($rows != 0): ?>
					<div class="table-responsive">
						<table class="table table-bordered table-hover" id="dataTables-example">
							<thead>
								<tr>
									<th></th>
									<th width="10%">Cédula</th>
									<th>Banco</th>
									<th>Referencia</th>
									<th>Monto</th>
									<th>Fecha</th>
									<?=(!isset($event))? '<th>Evento</th>' :''?>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<?php $band = 2 ?>
								<?php foreach($rows as $row): ?>
									<?php if ($band % 2 == 0): ?>
										<tr class="odd gradeX">
									<?php else: ?>
										<tr class="even gradeC">
									<?php endif; ?>
											<td>
												<?php if($row->Status == 'Validated'):?>
												<i class="fa fa-check text-success" title="Validado"></i>
												<?php endif;?>
												<?php if($row->Status == 'No Validated'):?>
												<i class="fa fa-spinner text-warning" title="No Validado"></i>
												<?php endif;?>
												<?php if($row->Status == 'Invalid'):?>
												<i class="fa fa-minus-circle text-danger" title="Inválido"></i>
												<?php endif;?>
											</td>
											<td><?=$row->DNI?></td>
											<td><?=$row->Bank?></td>
											<td><?=$row->Voucher_Number?></td>
											<td><?=$row->Amount?> Bs</td>
											<td><?=date('d/m/Y',strtotime($row->Payment_Date))?></td>
											<?php if(!isset($event)):?><td><?=$row->Name?></td><?php endif;?>
											<td class="text-center">
												<a href="<?=site_url('payment/change_state/'.$row->Id)?>" title="Cambiar Estado"><i class="fa fa-exchange text-info"></i></a>
											</td>
                                        </tr>
											<?php $band++; ?>
										<?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
							<?php else: ?>
								<div class="text-danger">No hay Pagos.</div>
							<?php endif; ?>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
</div>
    <!-- /#wrapper -->