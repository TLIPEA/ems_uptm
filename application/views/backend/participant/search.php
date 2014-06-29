<?php
if(isset($events))
{
	if($events!=0)
	{
		$options[] = 'Seleccione';
		foreach($events as $event)
		{
			$options[$event->Id] = $event->Name.' - '.date('d-m-Y',strtotime($event->Start_Date)).' al '.date('d-m-Y',strtotime($event->End_Date));
		}
	}
	else
	{
		$options[] = 'No hay Eventos disponibles';
	}
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
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Nueva Inscripción
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
									<?=form_open('registration/search/2', array('role'=>'form','autocomplet'=>'off','class'=>'form-horizontal'))?>
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
                                            <label class="col-md-2">Cédula</label>
											<div class="col-md-10">
												<input class="form-control" name="DNI" id="DNI" value="<?=set_value('DNI')?>" maxlength="50" required="">
											</div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-2">Evento</label>
											<div class="col-md-10">
												<?=form_dropdown('Scheduled_Event_Id', $options, (set_value('Scheduled_Event_Id')),' required="" class="form-control"');?>
											</div>
                                        </div>
										<div class="col-md-1 pull-right text-center">
											<button type="submit" class="btn btn-success pull-right">Buscar</button>
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