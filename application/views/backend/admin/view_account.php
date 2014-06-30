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
                            Ver Cuenta Bancaria
							<div class="pull-right"><a class="btn btn-warning btn-xs" href="<?=site_url('admin/accounts_index')?>">Cuentas</a></div>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
									<?=form_open('admin/account_edit/'.$account[0]->Id.'/2', array('role'=>'form','autocomplet'=>'off','class'=>'form-horizontal'))?>
									<?=validation_errors('<div class="alert-danger input-sm"><p><strong>','</strong> </div><br />')?>
									<?php if(isset($typeError)):?>
									    <div class="col-md-12">
									        <div class="alert alert-<?=($typeError == 1 )? 'success' : 'danger';?> <?=($typeError == 0 )? 'hide' : '';?> alert-dismissable">
												<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
												<strong><?=($typeError != 0 )? $titleError : '';?></strong> <?=$msg?>.
									        </div>
									    </div>
									<?php endif;?>
										<div class="form-group">
                                            <label class="col-md-2">Titular</label>
											<div class="col-md-10">
												<span class="form-control-static text-primary"><?=$account[0]->Holder?></span>
											</div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2">Cédula / Rif</label>
											<div class="col-md-10">
												<span class="form-control-static text-primary"><?=$account[0]->DNI?></span>
											</div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-2">Tipo</label>
											<div class="col-md-10">
												<?php switch($account[0]->Type)
												{
													case 'Savings Account':
														$type = 'Cuenta de Ahorros';
														break;
													case 'Checking Account':
														$type = 'Cuenta Corriente';
														break;
													default:
														$type = 'Cuenta sin tipo';
														break;
												}
												?>

												<span class="form-control-static text-primary"><?=$type?></span>
											</div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-2">Banco</label>
											<div class="col-md-10">
												<span class="form-control-static text-primary"><?=$account[0]->Bank?></span>
											</div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-2">Número</label>
											<div class="col-md-10">
												<span class="form-control-static text-primary"><?=$account[0]->Number?></span>
											</div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-2">Estatus</label>
											<div class="col-md-10">
												<?php switch($account[0]->Status)
												{
													case 'Active':
														$status = 'Activa';
														break;
													case 'Off':
														$status = 'Desactiva';
														break;
													default:
														$status = 'Desactiva';
														break;
												}
												?>
												<span class="form-control-static text-primary"><?=$status?></span>
											</div>
                                        </div>
										<?php if($events != 0):?>
										<div class="form-group">
                                            <label class="col-md-2">Eventos Asociados</label>
											<div class="col-md-10">
												<?php foreach($events as $event): ?>
													<span class="form-control-static text-primary"><?=$event->Name?></span><br />
												<?php endforeach;?>
											</div>
                                        </div>
										<?php endif;?>
                                    </form>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                                
                                <!-- /.col-lg-6 (nested) -->
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
