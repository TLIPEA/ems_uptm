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
                            Detalles de la Inscripción
							<div class="pull-right"><a class="btn btn-warning btn-xs" href="<?=site_url('registration')?>">Inscripciones</a></div>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6 col-xs-12">
									<div class="page-header">
										<h4>Datos Base</h4>
									</div>
									<?=form_open('#', array('role'=>'form','autocomplet'=>'off','class'=>'form-horizontal'))?>
									<?php if(isset($typeError)):?>
									    <div class="col-md-12">
									        <div class="alert alert-<?=($typeError == 1 )? 'success' : 'danger';?> <?=($typeError == 0 )? 'hide' : '';?> alert-dismissable">
												<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
												<strong><?=($typeError != 0 )? $titleError : '';?></strong> <?=$msg?>.
									        </div>
									    </div>
									<?php endif;?>
										<div class="form-group">
                                            <label class="col-md-5">Cédula</label>
											<div class="col-md-7">
												<span class="form-control-static text-primary"><?=$registration[0]->DNI?></span>
											</div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-5">Nombre</label>
											<div class="col-md-7">
												<span class="form-control-static text-primary"><?=$registration[0]->Name.' '.$registration[0]->Last_Name?></span>
											</div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-5">Evento</label>
											<div class="col-md-7">
												<span class="form-control-static text-primary"><?=$registration[0]->Event?></span>
											</div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-5">Tipo de Evento</label>
											<div class="col-md-7">
												<span class="form-control-static text-primary"><?=typeEvent($registration[0]->Event_Type)?></span>
											</div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-5">Estatus</label>
											<div class="col-md-7">
												<span class="form-control-static text-primary"><?=translate($registration[0]->Status)?></span>
											</div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-5">Usuario desde</label>
											<div class="col-md-7">
												<span class="form-control-static text-primary"><?=date('d/m/Y',strtotime($registration[0]->Registration_Date))?></span>
											</div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-5">Categoria</label>
											<div class="col-md-7">
												<span class="form-control-static text-primary"><?=translate($registration[0]->Cost_Type)?></span>
											</div>
                                        </div>
									</form>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                                <div class="col-md-6 col-xs-12">
									<div class="page-header">
										<h4>Costos y Preventa</h4>
									</div>
									<?=form_open('#', array('role'=>'form','autocomplet'=>'off','class'=>'form-horizontal'))?>
									<div class="form-group">
										<label class="col-md-5">Fecha Fin de Preventa</label>
										<div class="col-md-7">
											<span class="form-control-static text-primary"><?=date('d/m/Y',strtotime($registration[0]->Sale_End_Date))?></span>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-5">Costo</label>
										<div class="col-md-7">
											<span class="form-control-static text-primary"><?=($registration[0]->Amount==0)? 'Gratis': $registration[0]->Amount.' Bs'?> </span>
										</div>
									</div>
									<?php if($registration[0]->Amount!=0):?>
									<div class="form-group">
										<label class="col-md-5">Pagado</label>
										<div class="col-md-7">
											<span class="form-control-static text-primary"><?=($registration[0]->Total_Pay=='')? 0 : $registration[0]->Total_Pay?> Bs</span>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-5">Resta</label>
										<div class="col-md-7">
											<span class="form-control-static text-primary"><?=$registration[0]->Amount-$registration[0]->Total_Pay?> Bs</span>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-5">Pagos Validados</label>
										<div class="col-md-7">
											<span class="form-control-static text-primary"><?=$registration[0]->Payment_Validated?> Bs</span>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-5">Pagos Sin Validar</label>
										<div class="col-md-7">
											<span class="form-control-static text-primary"><?=$registration[0]->Payment_No_Validated?> Bs</span>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-5">Pagos Invalidos</label>
										<div class="col-md-7">
											<span class="form-control-static text-primary"><?=$registration[0]->Payment_Invalid?> Bs</span>
										</div>
									</div>
									<?php endif;?>
									</form>
								</div>
                                <!-- /.col-lg-6 (nested) -->
								<?php if($registration[0]->Amount!=0):?>
								<div class="form-group col-md-12 col-xs-12">
									<hr>
									
									<div class="page-header">
										<div class="pull-right"><a title="Registrar Pago" class="btn btn-md btn-success" href="<?=site_url('payment/new_pay/'.$registration[0]->Id.'/'.$registration[0]->Scheduled_Event_Id)?>"><i class="fa fa-money"></i></a></div>
										<h3>Pagos Registrados</h3>
									</div>
								  <?php if($payments!=0):?>
								  <div class="table-responsive">
									<table class="table table-hover">
									  <tr>
										  <th>Banco</th>
										  <th>N° Confirmación</th>
										  <th>Monto</th>
										  <th>Fecha</th>
										  <th>Estatus</th>
									  </tr>
									  <?php foreach($payments as $payment):?>
									  <tr>
										<td><?=$payment->Bank?></td>
										<td><?=$payment->Voucher_Number?></td>
										<td><?=$payment->Amount?> Bs</td>
										<td><?=date('d-m-Y',strtotime($payment->Payment_Date))?></td>
										<td><?=translate($payment->Status)?></td>
									  </tr>
									  <?php endforeach;?>
									</table>
								  </div>
								  <?php else:?>
								  <h4>No hay Pagos Registrados</h4>
								  <?php endif;?>
								</div>
								<?php endif;?>
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