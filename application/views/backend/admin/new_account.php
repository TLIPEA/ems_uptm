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
                            Nuevo Cuenta Bancaria
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
									<?=form_open('admin/new_account/2', array('role'=>'form','autocomplet'=>'off','class'=>'form-horizontal'))?>
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
												<input class="form-control" name="Holder" id="Holder" value="<?=set_value('Holder')?>" maxlength="50" required="">
											</div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2">Cédula / Rif</label>
											<div class="col-md-10">
												<input class="form-control" name="DNI" id="DNI" value="<?=set_value('DNI')?>" maxlength="50" required="">
											</div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-2">Tipo</label>
											<div class="col-md-10">
												<?php $options = array(''=>'- Seleccione -','Savings Account'=>'Cuenta de Ahorros', 'Checking Account'=>'Cuenta Corriente'); ?>
												<?php $settings = 'class = "form-control"'; ?>
												<?=form_dropdown('Type', $options,'',$settings);?>
											</div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-2">Banco</label>
											<div class="col-md-10">
												<?php $options = array(
																		''=>'- Seleccione -',
																		'100% Banco' => '100% Banco',
																		'ABN AMRO Bank' => 'ABN AMRO Bank',
																		'Bancamiga Banco Microfinanciero' => 'Bancamiga Banco Microfinanciero',
																		'Banco Activo Banco Comercial' => 'Banco Activo Banco Comercial',
																		'Banco Agrícola' => 'Banco Agrícola',
																		'Banco Bicentenario' => 'Banco Bicentenario',
																		'Banco Caroní' => 'Banco Caroní',
																		'Banco de Desarollo del Microempresario' => 'Banco de Desarollo del Microempresario',
																		'Banco de Venezuela' => 'Banco de Venezuela',
																		'Banco del Caribe' => 'Banco del Caribe',
																		'Banco del Pueblo Soberano' => 'Banco del Pueblo Soberano',
																		'Banco del Tesoro' => 'Banco del Tesoro',
																		'Banco Espíritu Santo' => 'Banco Espíritu Santo',
																		'Banco Exterior' => 'Banco Exterior',
																		'Banco Industrial de Venezuela' => 'Banco Industrial de Venezuela',
																		'Banco Internacional de Desarrollo' => 'Banco Internacional de Desarrollo',
																		'Banco Mercantil' => 'Banco Mercantil',
																		'Banco Nacional de Crédito' => 'Banco Nacional de Crédito',
																		'Banco Occidental de Descuento' => 'Banco Occidental de Descuento',
																		'Banco Plaza' => 'Banco Plaza',
																		'Banco Provincial BBVA' => 'Banco Provincial BBVA',
																		'Banco Venezolano de Crédito' => 'Banco Venezolano de Crédito',
																		'Bancrecer' => 'Bancrecer',
																		'Banesco' => 'Banesco',
																		'Banfanb' => 'Banfanb',
																		'Bangente' => 'Bangente',
																		'Banplus Banco Comercial' => 'Banplus Banco Comercial',
																		'Citibank' => 'Citibank',
																		'Corp Banca' => 'Corp Banca',
																		'Del Sur Banco Universal' => 'Del Sur Banco Universal',
																		'Fondo Común' => 'Fondo Común',
																		'Instituto Municipal de Crédito Popular' => 'Instituto Municipal de Crédito Popular',
																		'Mibanco Banco de Desarrollo' => 'Mibanco Banco de Desarrollo',
																		'Sofitasa' => 'Sofitasa'
																	   );?>
												<?php $settings = 'class = "form-control"'; ?>
												<?=form_dropdown('Bank', $options,'',$settings);?>
											</div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-2">Número</label>
											<div class="col-md-10">
												<input class="form-control" name="Number" id="Number" value="<?=set_value('Number')?>" maxlength="20" required="">
											</div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-2">Estatus</label>
											<div class="col-md-10">
												<?php $options = array(''=>'- Seleccione -','Active'=>'Cuenta Activa', 'Off'=>'Cuenta Desactiva'); ?>
												<?php $settings = 'class = "form-control"'; ?>
												<?=form_dropdown('Status', $options,'',$settings);?>
											</div>
                                        </div>
										<div class="col-md-1 pull-right text-center">
											<button type="reset" class="btn btn-info ">Limpiar</button>
										</div>
										<div class="col-md-1 pull-right text-center">
										<button type="submit" class="btn btn-success pull-right">Guardar</button>
										</div>
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