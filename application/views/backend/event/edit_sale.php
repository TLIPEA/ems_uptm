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
                            Editar Preventa
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
									<?=form_open('sale/edit/'.$event[0]->Id.'/2', array('role'=>'form','autocomplet'=>'off','class'=>'form-horizontal'))?>
									<?=validation_errors('<div class="alert-danger input-sm"><p><strong>','</strong> </div><br />')?>
									<?php if(isset($typeError)):?>
									    <div class="col-md-12">
									        <div class="alert alert-<?=($typeError == 1 )? 'success' : 'danger';?> <?=($typeError == 0 )? 'hide' : '';?> alert-dismissable">
												<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
												<strong><?=($typeError != 0 )? $titleError : '';?></strong> <?=$msg?>.
									        </div>
									    </div>
									<?php endif;?>
										<?php echo form_error('Description','<div class="alert alert-danger alert-dismissable">
											<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
											<strong>Error!</strong>','.</div>'); ?>
										<div class="form-group">
                                            <label class="col-md-2">Descripción</label>
											<div class="col-md-10">
												<input type="text" class="form-control" id="Description" name="Description" placeholder="Nombre de la Preventa" required="" value="<?=(set_value('Description')!=0)?set_value('Description'):$sale[0]->Description?>">
											</div>
                                        </div>
										<?php echo form_error('Start_Date','<div class="alert alert-danger alert-dismissable">
											<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
											<strong>Error!</strong>','.</div>'); ?>
										<div class="form-group">
										  <label for="Start_Date" class="col-md-2">Fecha Inicio</label>
											<div class="col-md-10">
												<input type="text" class="form-control" data-date-format="YYYY-MM-DD" id="Start_Date" name="Start_Date" placeholder="Fecha Inicio" readonly="readonly" required="" value="<?=(set_value('Start_Date')!=0)?set_value('Start_Date'):$sale[0]->Start_Date?>">
											</div>
										</div>
										<?php echo form_error('End_Date','<div class="alert alert-danger alert-dismissable">
											<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
											<strong>Error!</strong>','.</div>'); ?>
										<div class="form-group">
										  <label for="End_Date" class="col-md-2">Fecha Fin</label>
											<div class="col-md-10">
												<input type="text" class="form-control" data-date-format="YYYY-MM-DD" id="End_Date" name="End_Date" placeholder="Fecha Fin" readonly="readonly" required="" value="<?=(set_value('End_Date')!=0)?set_value('End_Date'):$sale[0]->End_Date?>">
											</div>
										</div>
										<?php echo form_error('Status','<div class="alert alert-danger alert-dismissable">
											<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
											<strong>Error!</strong>','.</div>'); ?>
										<div class="form-group">
                                            <label for="Status" class="col-md-2">Estatus</label>
											<div class="col-md-10">
												<label class="radio-inline col-md-3">
												    <input type="radio" name="Status" id="Status1" value="Active" <?=set_value('Status')=='Active' ? 'checked=""':($sale[0]->Status == 'Active')? 'checked=""' :''?>>Activa
												</label>
												<label class="radio-inline col-md-3">
												    <input type="radio" name="Status" id="Status2" value="Off" <?=set_value('Status')=='Off' ? 'checked=""':($sale[0]->Status == 'Off')? 'checked=""' :''?>> Inactiva
												</label>
											</div>
                                        </div>
										<input type="hidden" name="Scheduled_Event_Id" value="<?=$event[0]->Id?>" />
										<input type="hidden" name="Id" value="<?=$sale[0]->Id?>" />
										<div class="col-md-1 pull-right text-center">
											<a href="<?=site_url('events/planning/'.$event[0]->Id)?>" class="btn btn-info pull-right">Regresar</a>
										</div>
										<div class="col-md-1 pull-right text-center"></div>
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