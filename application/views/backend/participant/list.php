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
                    <?=$title?>
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
									<th width="10%">Cédula</th>
									<th>Nombre</th>
									<th>Apellido</th>
									<th>Estatus</th>
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
											<td><?=$row->DNI?></td>
											<td><?=$row->Name?></td>
											<td><?=$row->Last_Name?></td>
											<td class="<?=(($row->Status=='Active')? 'text-success' : (($row->Status=='Block')? 'text-danger':''))?>"><?=$row->Status?></td>
											<td class="text-center">
												<div class="btn-group">
													<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" title="¿Que Acción desea realizar?">
														<i class="fa fa-hand-o-up"></i>
													</button>
													<ul class="dropdown-menu text-center" role="menu"  style="min-width:40px;">
													  <li><a href="<?=site_url('participant/verify/'.$row->Id.'/'.$row->Username)?>" title="Verificar"><i class="fa fa-check text-success"></i></a></li>
													  <li><button class="btn-link btn-danger" style="color: #d2322d;" data-toggle="modal" title="Bloquear" data-target="#myModal<?=$band?>"><i class="fa fa-times-circle"></i></button></li>
													</ul>
												</div>
                            <!-- Modal -->
                            <div class="modal fade" id="myModal<?=$band?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title text-danger" id="myModalLabel">Advertencia</h4>
                                        </div>
                                        <div class="modal-body">
                                            ¿Desea bloquear el participate <strong class="text-danger"><?=$row->Name.' '.$row->Last_Name?></strong> para el acceso al sistema ?<br />
                                        </div>
										<form method="post" accept-charset="utf-8" action="<?=site_url('participant/block/'.$row->Id.'/'.$row->Username)?>">
												<input type="hidden" name="Id" id="Id" value="<?=$row->Id?>" >
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-danger">Bloquear</button>
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