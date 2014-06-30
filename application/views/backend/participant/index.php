<div id="page-wrapper">
	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Inscripciones</h1>
        </div>
    <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
	<div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Inscripciones <?=(isset($event))? ' en '.$event[0]->Name:''?>
					<div class="pull-right">
						<a title="Añadir Nueva Inscripción" class="btn btn-info btn-xs" href="<?=site_url('registration/search')?>"> <i class="fa fa-plus"></i> Añadir Nueva Inscripción</a>
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
									<th width="10%">Cedula</th>
									<th>Nombre</th>
									<th>Apellido</th>
									<?=(!isset($event))? '<th>Evento</th>' :''?>
									<th>Acciones</th>
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
											<td><?=$row->DNI?></td>
											<td><?=$row->Name?></td>
											<td><?=$row->Last_Name?></td>
											<?php if(!isset($event)):?><td><?=$row->Event?></td><?php endif;?>
											<td class="text-center">
										<a class="text-success" href="<?=site_url('registration/view/'.$row->Id)?>"><i class="fa fa-search-plus" data-toggle="tooltip" data-placement="bottom" title="Ver"></i></a> &nbsp;&nbsp;
										<a class="text-primary" title="Editar" href="<?=site_url('registration/edit/'.$row->Id.'/1')?>" ><i class="fa fa-pencil-square-o"></i></a>
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
                                            ¿Desea eliminar la inscripción de <strong class="text-danger"><?=$row->Name.' '.$row->Last_Name?></strong> <?php if(!isset($event)):?> en <strong class="text-danger"><?=$row->Event?></strong><?php endif;?> ?<br />
                                        </div>
										<form method="post" accept-charset="utf-8" action="<?=site_url('registration/delete/'.$row->Id)?>">
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
											</td>
                                        </tr>
											<?php $band++; ?>
										<?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
							<?php else: ?>
								<div class="text-danger">No hay Inscritos.</div>
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