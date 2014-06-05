<div id="page-wrapper">
	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Administración</h1>
        </div>
    <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
	<div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Cuentas
					<div class="pull-right"><a class="btn btn-success btn-xs" href="<?=site_url('admin/new_account')?>">Añadir Cuenta</a></div>
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
						<table class="table table-striped table-bordered table-hover" id="dataTables-example">
							<thead>
								<tr>
									<th width="8%">Acciones</th>
									<th>Banco</th>
									<th>Número</th>
									<th>Titular</th>
									<th>Tipo</th>
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
											<td class="text-center">
												<a class="text-success" href="<?=site_url('admin/account_view/'.$row->Id)?>"><i class="fa fa-search-plus" data-toggle="tooltip" data-placement="bottom" title="Ver"></i></a> &nbsp;<a class="text-primary" title="Editar" href="<?=site_url('admin/account_edit/'.$row->Id.'/1')?>" ><i class="fa fa-pencil-square-o"></i></a> &nbsp;<a class="text-danger" href="<?=site_url('admin/account_event/'.$row->Id)?>"><i class="fa fa-calendar" data-toggle="tooltip" data-placement="bottom" title="Ver"></i></a>
											</td>    
											<td><?=$row->Bank?></td>
											<td><?=$row->Number?></td>
											<td><?=$row->Holder?></td>
											<td>
												<?php switch($row->Type)
												    {
													case 'Savings Account':
														$type = 'Cuenta de Ahorros';
														break;
													case 'Checking Account':
														$type = 'Cuenta Corriente';
														break;
													default:
														$type = '';
														break;
													}
												?>
												<?=$type?>
											</td>
                                        </tr>
											<?php $band++; ?>
										<?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
							<?php else: ?>
								<div class="text-danger">No hay cuentras registradas.</div>
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