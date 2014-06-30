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
                    Preventas de <?=$event[0]->Name?>
					<div class="pull-right">
						<div class="btn-group">
							<button type="button" class="btn btn-info btn-xs dropdown-toggle" data-toggle="dropdown">
								Acciones
								<span class="caret"></span>
							</button>
							<ul class="dropdown-menu pull-right" role="menu">
								<li>
									<a title="Añadir Nueva Preventa" href="<?=site_url('sale/new_sale/'.$event[0]->Id)?>"> <i class="fa fa-plus text-info"></i> Añadir Nueva Preventa</a>
								</li>
								<li class="divider"></li>
								<li>
									<a title="Ir a todos los Evento" href="<?=site_url('events')?>"> <i class="fa fa-calendar text-primary"></i> Todos los Eventos</a>
								</li>
								<li class="divider"></li>
								<li>
									<a title="Ir a los Detalles del Evento" href="<?=site_url('events/view/'.$event[0]->Id)?>"> <i class="fa fa-reply text-info"></i> Regresar</a>
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
						<table class="table table-striped table-bordered table-hover" id="dataTables-example">
							<thead>
								<tr>
									<th></th>
									<th>Preventa</th>
									<th>Fecha Inicio</th>
									<th>Fecha Fin</th>
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
											</td>
											<td><?=$row->Description?></td>
											<td><?=date('d/m/Y',strtotime($row->Start_Date))?></td>
											<td><?=date('d/m/Y',strtotime($row->End_Date))?></td>
											<td class="text-center">
												<div class="btn-group">
													<a href="<?=site_url('sale/costs/'.$row->Id.'/1')?>" title="Costos"><i class="fa fa-money text-success"></i></a>
													<a href="<?=site_url('sale/edit/'.$row->Id.'/1')?>" title="Editar"><i class="fa fa-pencil-square-o text-warning"></i></a>
													<button class="btn-link btn-danger" style="color: #d2322d;" data-toggle="modal" title="Eliminar" data-target="#myModal<?=$band?>"><i class="fa fa-times-circle"></i>
													</button>
													<!-- Modal -->
													<div class="modal fade" id="myModal<?=$band?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
														<div class="modal-dialog">
															<div class="modal-content">
																<div class="modal-header">
																	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
																	<h4 class="modal-title text-danger" id="myModalLabel">Advertencia</h4>
																</div>
																<div class="modal-body">
																	¿Desea eliminar la preventa <strong class="text-danger"><?=$row->Description?></strong>  ?<br /> Si esta es la <strong class="text-success">Preventa Activa</strong> debe Activar otra para que se puedan registrar nuevos participantes
																</div>
																<form method="post" accept-charset="utf-8" action="<?=site_url('sale/delete/'.$row->Id)?>">
																		<input type="hidden" name="Id" id="Id" value="<?=$row->Id?>" >
																<div class="modal-footer">
																	<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
																	<button type="submit" class="btn btn-danger">Eliminar</button>
																	</form>
																</div>
															</div>
															<!-- /.modal-content -->
														</div>
														<!-- /.modal-dialog -->
													</div>
													<!-- /.modal -->
												</div>
											</td>    
                                        </tr>
											<?php $band++; ?>
										<?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
							<?php else: ?>
								<div class="text-danger">No hay Preventas registradas.</div>
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