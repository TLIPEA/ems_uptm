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
                            Editar Actividad
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
									<?=form_open('events/edit_plan/'.$event[0]->Id.'/2', array('role'=>'form','autocomplet'=>'off','class'=>'form-horizontal'))?>
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
												<?=form_textarea(array('name' => 'Description', 
												   'id'   => 'Description', 
												   'class'=> 'form-control',
												   'required' => '',
												   'value'=> (set_value('Description')!=0)?set_value('Description'):$plan[0]->Description))?>
											</div>
                                        </div>
										<?php echo form_error('Start_Date','<div class="alert alert-danger alert-dismissable">
											<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
											<strong>Error!</strong>','.</div>'); ?>
										<div class="form-group">
										  <label for="Start_Date" class="col-md-2">Fecha Inicio</label>
											<div class="col-md-10">
												<input type="text" class="form-control" data-date-format="YYYY-MM-DD" id="Start_Date" name="Start_Date" placeholder="Fecha Inicio" readonly="readonly" required="" value="<?=(set_value('Start_Date')!=0)?set_value('Start_Date'):$plan[0]->Start_Date?>">
											</div>
										</div>
										<?php echo form_error('End_Date','<div class="alert alert-danger alert-dismissable">
											<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
											<strong>Error!</strong>','.</div>'); ?>
										<div class="form-group">
										  <label for="End_Date" class="col-md-2">Fecha Fin</label>
											<div class="col-md-10">
												<input type="text" class="form-control" data-date-format="YYYY-MM-DD" id="End_Date" name="End_Date" placeholder="Fecha Fin" readonly="readonly" required="" value="<?=(set_value('End_Date')!=0)?set_value('End_Date'):$plan[0]->End_Date?>">
											</div>
										</div>
										<input type="hidden" name="Scheduled_Event_Id" value="<?=$event[0]->Id?>" />
										<input type="hidden" name="Id" value="<?=$plan[0]->Id?>" />
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