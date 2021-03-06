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
                    Saberes de <?=$event[0]->Name?>
					<div class="pull-right">
						<div class="btn-group">
							<button type="button" class="btn btn-info btn-xs dropdown-toggle" data-toggle="dropdown">
								Acciones
								<span class="caret"></span>
							</button>
							<ul class="dropdown-menu pull-right" role="menu">
								<li>
									<a title="Añadir un Nuevo Saber" href="<?=site_url('events/new_knowledge/'.$event[0]->Id)?>"> <i class="fa fa-plus text-info"></i> Añadir Nuevo Saber</a>
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
						<table class="table table-bordered table-hover" id="dataTables-example">
							<thead>
								<tr>
									<th>Orden</th>
									<th>Saber</th>
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
											<td><?=$row->Order?></td>
											<td><?=$row->Content?></td>
											<td class="text-center">
												<div class="btn-group">
													<a href="<?=site_url('events/edit_knowledge/'.$row->Id.'/1')?>" title="Editar"><i class="fa fa-pencil-square-o text-warning"></i></a>
													<a href="<?=site_url('events/delete_knowledge/'.$row->Id)?>" title="Eliminar"><i class="fa fa-times-circle text-danger"></i></a>
												</div>
											</td>    
                                        </tr>
											<?php $band++; ?>
										<?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
							<?php else: ?>
								<div class="text-danger">No hay Saberes registrados.</div>
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