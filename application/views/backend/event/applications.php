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
                    Lista de Ponentes <?=(isset($event)? ' de '.$event[0]->Name : '')?>
					<?php if(isset($event)):?>
					<div class="pull-right">
						<div class="btn-group">
							<button type="button" class="btn btn-info btn-xs dropdown-toggle" data-toggle="dropdown">
								Acciones
								<span class="caret"></span>
							</button>
							<ul class="dropdown-menu pull-right" role="menu">
								<li>
									<a title="Añadir Nuevo Ponente" href="<?=site_url('events/new_application')?>"> <i class="fa fa-plus text-info"></i> Añadir Nuevo Ponente</a>
								</li>
								<li class="divider"></li>
								<li>
									<a title="Ir a los Detalles del Evento" href="<?=site_url('events/view/'.$event[0]->Id)?>"> <i class="fa fa-reply text-info"></i> Regresar</a>
								</li>
							</ul>
						</div>
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
									<th>Cedula</th>
									<th>Nombre</th>
									<?=(!isset($event))? '<th>Evento</th>':''?>
									<th>Titulo</th>
									<th>Participación</th>
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
												<?php if($row->Status == 'Accepted'):?>
												<i class="fa fa-check text-success" title="Aceptada"></i>
												<?php endif;?>
												<?php if($row->Status == 'Amend'):?>
												<i class="fa fa-exchange text-info" title="Con Correcciones"></i>
												<?php endif;?>
												<?php if($row->Status == 'Proposal'):?>
												<i class="fa fa-spinner text-warning" title="Propuesta"></i>
												<?php endif;?>
												<?php if($row->Status == 'Rejected'):?>
												<i class="fa fa-minus-o text-warning" title="No Aceptada"></i>
												<?php endif;?>
												<?php if($row->Mode == 'Online'):?>
												<i class="fa fa-cloud text-primary" title="En Linea"></i>
												<?php else:?>
												<i class="fa fa-user text-info" title="Presencial"></i>
												<?php endif;?>
											</td>
											<td><?=$row->DNI?></td>
											<td><?=$row->Name.' '.$row->Last_Name?></td>
											<?php if(!isset($event)):?> <td><?=$row->Event?></td><?php endif;?>
											<td><?=$row->Title?></td>
											<td><?=translate($row->Mode)?></td>
											<td class="text-center">
												<div class="btn-group">
													<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" title="¿Que Acción desea realizar?">
														<i class="fa fa-hand-o-up"></i>
													</button>
													<ul class="dropdown-menu text-center" role="menu"  style="min-width:40px;">
													  <li><a href="<?=site_url('events/view_application/'.$row->Id)?>" title="Ver"><i class="fa fa-search-plus text-success"></i></a></li>
													  <li><a href="<?=site_url('events/edit_application/'.$row->Id.'/1')?>" title="Editar"><i class="fa fa-pencil-square-o text-warning"></i></a></li>
													  <li><a href="<?=site_url('events/change_status_application/'.$row->Id.'/1')?>" title="Cambiar Estado"><i class="fa fa-exchange text-info"></i></a></li>
													  <li><a href="<?=site_url('events/delete_application/'.$row->Id)?>" title="Eliminar"><i class="fa fa-times-circle text-danger"></i></a></li>
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
								<div class="text-danger">No hay Ponentes Registrados.</div>
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