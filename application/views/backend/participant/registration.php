<?php
if($costs!=0)
{
	$options[] = 'Seleccione';
	foreach($costs as $cost)
	{
		if($cost->Type!='Ponentes')
		$options[$cost->Id] = $cost->Type.' - '.(($cost->Amount==0)?'Exonerado':$cost->Amount.'Bs');
	}
}
else
{
	$options[] = 'No hay Costos disponibles';
}
?>
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
                            Nueva Inscripcion <?=(isset($event)? ' en '.$event[0]->Name:'')?>
							<div class="pull-right"><a class="btn btn-warning btn-xs" href="<?=site_url('registration/index/'.$event[0]->Id)?>">Inscripciones en el Evento</a></div>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
									<?=form_open('registration/new_registration/'.$participant[0]->Id.'/'.$participant[0]->DNI.'/'.$event[0]->Id.'/2', array('role'=>'form','autocomplet'=>'off','class'=>'form-horizontal'))?>
									<?=validation_errors('<div class="alert-danger input-sm"><p><strong>','</strong> </div><br />')?>
									<?php if(isset($typeError)):?>
									    <div class="col-md-12">
									        <div class="alert alert-<?=($typeError == 1 )? 'success' : 'danger';?> <?=($typeError == 0 )? 'hide' : '';?> alert-dismissable">
												<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
												<strong><?=($typeError != 0 )? $titleError : '';?></strong> <?=$msg?>.
									        </div>
									    </div>
									<?php endif;?>
									<input type="hidden" name="Scheduled_Event_Id" value="<?=$event[0]->Id?>" />
									<?php echo form_error('Cost_Id','<div class="alert alert-danger alert-dismissable">
															<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><strong>Error!</strong> ','.</div>'); ?>
									<div class="form-group">
										<label class="col-md-2" for="">Categoria</label>
										<div class="col-md-10">
											<?=form_dropdown('Cost_Id', $options, (set_value('Cost_Id')),
																	   'class="form-control" required');?>
										</div>
									</div>
									<?php echo form_error('DNI','<div class="alert alert-danger alert-dismissable">
															<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><strong>Error!</strong> ','.</div>'); ?>
									<div class="form-group">
										<label class="col-md-2" for="">Cedula</label>
										<div class="col-md-10">
											<input type="text" class="form-control" name="DNI" readonly="readonly" required="" value="<?=$participant[0]->DNI?>" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-2" for="">Nombre Completo</label>
										<div class="col-md-10">
											<input type="text" class="form-control" name="Full_Name" readonly="readonly" required="" value="<?=$participant[0]->Name.' '.$participant[0]->Last_Name?>" />
										</div>
									</div>
									<input type="hidden" name="Participant_Id" value="<?=$participant[0]->Id?>" />
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