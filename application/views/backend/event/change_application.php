<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Eventos</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Cambio de Estado de Ponencia
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
									<?=form_open('events/change_status_application/'.$activity[0]->Id.'/2', array('role'=>'form','autocomplet'=>'off','class'=>'form-horizontal'))?>
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
                                            <label class="col-md-2">Estatus</label>
											<div class="col-md-10">
												<?php $options = array(''=>'- Seleccione -','Proposal'=>translate('Proposal'), 'Accepted'=>translate('Accepted'),'Amend'=>translate('Amend'),'Rejected'=>translate('Rejected')); ?>
												<?php $settings = 'class = "form-control" required=""'; ?>
												<?=form_dropdown('Status', $options,set_value('Status'),$settings);?>
											</div>
                                        </div>
										<input type="hidden" name="Id" value="<?=$activity[0]->Id?>" />
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