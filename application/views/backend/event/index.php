<div id="page-wrapper">
	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Eventos</h1>
        </div>
    <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
	<div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Lista de Eventos
					<div class="pull-right">
						<div class="btn-group">
							<button type="button" class="btn btn-info btn-xs dropdown-toggle" data-toggle="dropdown">
								Acciones
								<span class="caret"></span>
							</button>
							<ul class="dropdown-menu pull-right" role="menu">
								<li>
									<a title="Añadir un Nuevo Evento" href="<?=site_url('events/new_event')?>"> <i class="fa fa-plus text-info"></i> Añadir Nuevo Evento</a>
								</li>
								<li>
									<a title="Nueva Edición de un Evento" href="<?=site_url('events/scheduled')?>"> <i class="fa fa-calendar text-primary"></i> Programar Evento</a>
								</li>
							</ul>
						</div>
					</div>
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
									<th>Tipo</th>
									<th>Nombre</th>
									<th>Fecha Inicio</th>
									<th>Fecha Fin</th>
									<th>Hora Inicio</th>
									<th>Hora Fin</th>
									<th>Horas</th>
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
												<?php if($row->Status == 'Active'):?>
												<i class="fa fa-check text-success" title="Activo"></i>
												<?php else:?>
												<i class="fa fa-minus-circle text-danger" title="Inactivo"></i>
												<?php endif;?>
												<?php if($row->Mode == 'Online'):?>
												<i class="fa fa-cloud text-primary" title="En Linea"></i>
												<?php else:?>
												<i class="fa fa-user text-info" title="Presencial"></i>
												<?php endif;?>
											</td>
											<td><?=typeEvent($row->Type)?></td>
											<td><?=$row->Name?></td>
											<td><?=date('d/m/Y',strtotime($row->Start_Date))?></td>
											<td><?=date('d/m/Y',strtotime($row->End_Date))?></td>
											<td><?=date('h:i A',strtotime($row->Start_Date))?></td>
											<td><?=date('h:i A',strtotime($row->End_Date))?></td>
											<td><?=$row->Hours?></td>
											<td class="text-center">
												<div class="btn-group">
													<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" title="¿Que Acción desea realizar?">
														<i class="fa fa-hand-o-up"></i>
													</button>
													<ul class="dropdown-menu text-center" role="menu"  style="min-width:40px;">
													  <li><a href="<?=site_url('events/view/'.$row->Id)?>" title="Ver"><i class="fa fa-search-plus text-success"></i></a></li>
													  <li><a href="<?=site_url('events/edit/'.$row->Id.'/1')?>" title="Editar"><i class="fa fa-pencil-square-o text-warning"></i></a></li>
													  <li><a href="<?=site_url('events/delete/'.$row->Id)?>" title="Eliminar"><i class="fa fa-times-circle text-danger"></i></a></li>
													  <li class="divider"></li>
													  <li><a href="<?=site_url('events/knowledges/'.$row->Id)?>" title="Saberes"><i class="fa fa-tasks text-info"></i></a></li>
													  <li><a href="<?=site_url('events/applicacions/'.$row->Id)?>" title="Ponentes"><i class="fa fa-rocket" style="color: #00a2cd;"></i></a></li>
													  <li><a href="<?=site_url('registration/index/'.$row->Id)?>" title="Inscritos"><i class="fa fa-users text-primary"></i></a></li>
													  <li><a href="<?=site_url('payment/index/'.$row->Id)?>" title="Pagos"><i class="fa fa-money text-success"></i></a></li>
													  <li><a href="<?=site_url('events/planning/'.$row->Id)?>" title="Planificación"><i class="fa fa-calendar" style="color: #6f1167;"></i></a></li>
													  <li><a href="<?=site_url('events/places/'.$row->Id)?>" title="Lugar"><i class="fa fa-map-marker" style="color: #ff3333;"></i></a></li>
													  <li><a href="<?=site_url('sale/index/'.$row->Id)?>" title="Costos"><i class="fa fa-clock-o" style="color: #f88a00;"></i></a></li>
													</ul>
												</div>
											</td>    
                                        </tr>
											<?php $band++; ?>
										<?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
							<?php else: ?>
								<div class="text-danger">No hay eventos registrados.</div>
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