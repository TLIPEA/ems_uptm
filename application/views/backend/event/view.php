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
                            Detalles del Evento
							<div class="pull-right"><a class="btn btn-warning btn-xs" href="<?=site_url('events')?>">Eventos</a></div>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6 col-xs-12">
									<?=form_open('events/edit/'.$event[0]->Id.'/2', array('role'=>'form','autocomplet'=>'off','class'=>'form-horizontal'))?>
									<?php if(isset($typeError)):?>
									    <div class="col-md-12">
									        <div class="alert alert-<?=($typeError == 1 )? 'success' : 'danger';?> <?=($typeError == 0 )? 'hide' : '';?> alert-dismissable">
												<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
												<strong><?=($typeError != 0 )? $titleError : '';?></strong> <?=$msg?>.
									        </div>
									    </div>
									<?php endif;?>
										<div class="form-group">
                                            <label class="col-md-5">Evento
												<?php if($event[0]->Status == 'Active'):?>
												<i class="fa fa-check text-success" title="Activo"></i>
												<?php else:?>
												<i class="fa fa-minus-circle text-danger" title="Inactivo"></i>
												<?php endif;?>
												<?php if($event[0]->Mode == 'Online'):?>
												<i class="fa fa-cloud text-primary" title="En Linea"></i>
												<?php else:?>
												<i class="fa fa-user text-info" title="Presencial"></i>
												<?php endif;?></label>
											<div class="col-md-7">
												<span class="form-control-static text-primary"><?=$event[0]->Name?></span>
											</div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-5">Tipo de Evento</label>
											<div class="col-md-7">
												<span class="form-control-static text-primary"><?=typeEvent($event[0]->Type)?></span>
											</div>
                                        </div>
										
										<div class="form-group">
                                            <label class="col-md-5">Fecha Inicio</label>
											<div class="col-md-7">
												<span class="form-control-static text-primary"><?=date('d/m/Y',strtotime($event[0]->Start_Date))?></span>
											</div>
                                        </div>
										<div class="form-group">
										  <label for="Start_Date" class="col-md-5">Fecha Fin</label>
											<div class="col-md-7">
												<span class="form-control-static text-primary"><?=date('d/m/Y',strtotime($event[0]->End_Date))?></span>
											</div>
										</div>
										<div class="form-group">
                                            <label class="col-md-5">Hora Inicio</label>
											<div class="col-md-7">
												<span class="form-control-static text-primary"><?=date('h:i A',strtotime($event[0]->Start_Date))?></span>
											</div>
                                        </div>
										<div class="form-group">
										  <label for="Start_Date" class="col-md-5">Hora Fin</label>
											<div class="col-md-7">
												<span class="form-control-static text-primary"><?=date('h:i A',strtotime($event[0]->End_Date))?></span>
											</div>
										</div>
										<div class="form-group">
										  <label for="Quota" class="col-md-5">Capacidad</label>
											<div class="col-md-7">
												<span class="form-control-static text-primary"><?=$event[0]->Quota?></span>
											</div>
										</div>
										<div class="form-group">
										  <label for="Hours" class="col-md-5">Horas</label>
											<div class="col-md-7">
												<span class="form-control-static text-primary"><?=$event[0]->Hours?></span>
											</div>
										</div>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                                <div class="col-md-6 col-xs-12">
									<div class="pull-left"><a title="Ponentes" class="btn btn-primary btn-md" href="<?=site_url('events/applications/'.$event[0]->Id)?>" style="background: #00a2cd;"><i class="fa fa-rocket"></i></a></div>
									<div class="pull-right"><a title="Administrar Saberes" class="btn btn-primary btn-md" href="<?=site_url('events/knowledges/'.$event[0]->Id)?>"><i class="fa fa-tasks"></i></a></div>
									<div class="page-header">
										<h4>Áreas del Saber</h4>
									</div>
									<ol>
										<?php if($knowledges != 0):?>
										<?php foreach($knowledges as $knowledge):?>
										<li><span><?=$knowledge->Content?></li>
										<?php endforeach;?>
										<?php endif;?>
									</ol>
								</div>
                                <!-- /.col-lg-6 (nested) -->
								<div class="form-group col-md-12 col-xs-12">
									<hr>
									<div class="col-md-12">
												<label for="Slogan" class="col-md-5">Slogan</label>
												<div class="col-md-7">
													<span class="form-control-static text-primary"><?=$event[0]->Slogan?></span>
												</div>
									</div>
									<div class="page-header">
									    <hr>
										<div class="pull-right">
												<a title="Administrar Lugares" class="btn btn-md" href="<?=site_url('events/places/'.$event[0]->Id)?>" style="background: #ff3333;color: #FFF;"><i class="fa fa-map-marker"></i></a>
										</div>
										<h4>Lugar</h4>
									</div>
									<?php if($places != 0):?>
									<div class="table-responsive">
										<table class="table table-hover">
											<tr>
												<th>Nombre</th>
												<th>Referencia</th>
											</tr>
											<?php foreach($places as $place):?>
											<tr>
												<td><?=$place->Name?></td>
												<td><?=$place->Description?></td>
											</tr>
											<?php endforeach;?>
										</table>
									</div>
									<?php else:?>
									<h5>No hay Lugares Registrados</h5>
									<?php endif;?>
									
									<div class="page-header">
										<hr>
										<div class="pull-right"><a title="Administrar Planificación" class="btn btn-md" href="<?=site_url('events/planning/'.$event[0]->Id)?>" style="background: #6f1167;color: #FFF;"><i class="fa fa-calendar"></i></a></div>
										<h4>Planificación</h4>
									</div>
									<?php if($planning != 0):?>
									<div class="table-responsive">
										<table class="table table-hover">
											<tr>
												<th>Actividad</th>
												<th>Fecha Inicio</th>
												<th>Fecha Fin</th>
											</tr>
											<?php foreach($planning as $plan):?>
											<tr>
												<td><?=$plan->Description?></td>
												<td><?=date('d/m/Y',strtotime($plan->Start_Date))?></td>
												<td><?=date('d/m/Y',strtotime($plan->End_Date))?></td>
											</tr>
											<?php endforeach;?>
										</table>
									</div>
									<?php else:?>
									<h5>No hay Actividades Planificidas</h5>
									<?php endif;?>
										
									
									<div class="page-header">
										<hr>
										<div class="pull-right"><a title="Administrar Costos" class="btn btn-md" href="<?=site_url('sale/index/'.$event[0]->Id)?>" style="background: #f88a00;color: #FFF;"><i class="fa fa-clock-o"></i></a></div>
										<h4>Costos</h4>
									</div>
									  <?php $pivot = 0;?>
									  <?php if($costs!=0):?>
									  <?php foreach($costs as $cost):?>
										<?php if($cost->Sale_Id != $pivot):?>
											<?php if($pivot!=0):?>
												</table>
											</div>
											<?php endif;?>
											<?php $pivot = $cost->Sale_Id?>
											<div class="table-responsive">
												<h4>Valido del <?=date('d-m-Y',strtotime($cost->Start_Date))?> al
													<?=date('d-m-Y',strtotime($cost->End_Date))?></h4>
												<table class="table table-hover">
													<tr>
														<td><?=translate($cost->Type)?></td>
														<td class="text-right"><?=($cost->Amount==0)?'Exonerado':$cost->Amount?></td>
													</tr>
										<?php else:?>
													<tr>
														<td><?=translate($cost->Type)?></td>
														<td class="text-right"><?=($cost->Amount==0)?'Exonerado':$cost->Amount?></td>
													</tr>
										<?php endif;?>
									  <?php endforeach;?>
												</table>
											</div>
									  <?php else:?>
									  <h5>No hay Costos Asociados</h5>
									  <?php endif;?>
									<div class="page-header">
										<hr>
										<div class="pull-right"><a title="Pagos" class="btn btn-md btn-success" href="<?=site_url('sale/index/'.$event[0]->Id)?>" ><i class="fa fa-money"></i></a></div>
										<h4>Pagos</h4>
									</div>
								</div>
								<div class="col-md-6 text-center">
									<button type="submit" class="btn btn-success pull-right">Editar</button>
								</div>
								</form>
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