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
                            Nuevo Evento
							<div class="pull-right"><a class="btn btn-warning btn-xs" href="<?=site_url('events')?>">Eventos</a></div>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
									<?=form_open_multipart('events/new_event/2', array('role'=>'form','autocomplet'=>'off','class'=>'form-horizontal'))?>
									<?=validation_errors('<div class="alert-danger input-sm"><p><strong>','</strong> </div><br />')?>
									<?php if(isset($typeError)):?>
									    <div class="col-md-12">
									        <div class="alert alert-<?=($typeError == 1 )? 'success' : 'danger';?> <?=($typeError == 0 )? 'hide' : '';?> alert-dismissable">
												<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
												<strong><?=($typeError != 0 )? $titleError : '';?></strong> <?=$msg?>.
									        </div>
									    </div>
									<?php endif;?>
										<?php echo form_error('Type','<div class="alert alert-danger alert-dismissable">
											<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
											<strong>Error!</strong>','.</div>'); ?>
										<div class="form-group">
                                            <label class="col-md-2">Tipo Evento</label>
											<div class="col-md-10">
												<?php $options = array(''=>'- Seleccione -','Course'=>'Curso', 'Practical Course'=>'Taller','Meeting'=>'Encuentro', 'Seminary'=>'Seminario', 'Conversational'=>'Conversatorio', 'Conference'=>'Jornada', 'Congress'=>'Congreso', 'Diplomaed'=>'Diplomado'); ?>
												<?php $settings = 'class = "form-control" required=""'; ?>
												<?=form_dropdown('Type', $options,set_value('Type'),$settings);?>
											</div>
                                        </div>
										<?php echo form_error('Name','<div class="alert alert-danger alert-dismissable">
											<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
											<strong>Error!</strong>','.</div>'); ?>
										<div class="form-group">
										  <label for="Name" class="col-md-2">Nombre</label>
											<div class="col-md-10">
												<?=form_input(array('name'=>'Name','id'=>'Name',
														'class'=>'form-control','required'=>'',
														'value'=>set_value('Name')));?>
											</div>
										</div>
										<?php echo form_error('Purpose','<div class="alert alert-danger alert-dismissable">
											<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
											<strong>Error!</strong>','.</div>'); ?>
										<div class="form-group">
										  <label for="Purpose" class="col-md-2">Propuesta</label>
											<div class="col-md-10">
												<?=form_textarea(array('name' => 'Purpose', 
												   'id'   => 'Purpose', 
												   'class'=> 'form-control',
												   'value'=> set_value('Purpose')))?>
											</div>
										</div>
										<?php echo form_error('File','<div class="alert alert-danger alert-dismissable">
											<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
											<strong>Error!</strong>','.</div>'); ?>
										<div class="form-group">
										  <label for="File" class="col-md-2">Imagen</label>
											<div class="col-md-10">
												<?=form_upload(array('name'=>'File','id'=>'File',
														'class'=>'form-control','required'=>'',
														'value'=>set_value('File')));?>
											</div>
										</div>
										<?php echo form_error('Start_Date','<div class="alert alert-danger alert-dismissable">
											<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
											<strong>Error!</strong>','.</div>'); ?>
										<div class="form-group">
										  <label for="Start_Date" class="col-md-2">Fecha/Hora Inicio</label>
											<div class="col-md-10">
												<input type="text" class="form-control" data-date-format="YYYY-MM-DD hh:mm:00 A" id="Start_Date" name="Start_Date" placeholder="Fecha y Hora de Inicio" readonly="readonly" required="" value="<?=set_value('Start_Date')?>">
											</div>
										</div>
										<?php echo form_error('End_Date','<div class="alert alert-danger alert-dismissable">
											<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
											<strong>Error!</strong>','.</div>'); ?>
										<div class="form-group">
										  <label for="End_Date" class="col-md-2">Fecha/Hora Fin</label>
											<div class="col-md-10">
												<input type="text" class="form-control" data-date-format="YYYY-MM-DD hh:mm:00 A" id="End_Date" name="End_Date" placeholder="Fecha y Hora de Fin" readonly="readonly" required="" value="<?=set_value('End_Date')?>">
											</div>
										</div>
										<?php echo form_error('Mode','<div class="alert alert-danger alert-dismissable">
											<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
											<strong>Error!</strong>','.</div>'); ?>
										<div class="form-group">
                                            <label for="Mode" class="col-md-2">Modo del Evento</label>
											<div class="col-md-10">
												<label class="radio-inline col-md-3">
												    <input type="radio" name="Mode" id="Mode1" value="Classroom" <?=set_value('Mode')=='Classroom' ? 'checked=""':''?>>Presencial
												</label>
												<label class="radio-inline col-md-3">
												    <input type="radio" name="Mode" id="Mode2" value="Online" <?=set_value('Mode')=='Online' ? 'checked=""':''?>>En Linea
												</label>
											</div>
                                        </div>
										<?php echo form_error('Quota','<div class="alert alert-danger alert-dismissable">
											<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
											<strong>Error!</strong>','.</div>'); ?>
										<div class="form-group">
										  <label for="Quota" class="col-md-2">Capacidad</label>
											<div class="col-md-10">
												<input type="number" class="form-control" name="Quota" placeholder="Capacidad Maxima del Evento" required="" value="<?=set_value('Quota')?>">
											</div>
										</div>
										<?php echo form_error('Status','<div class="alert alert-danger alert-dismissable">
											<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
											<strong>Error!</strong>','.</div>'); ?>
										<div class="form-group">
                                            <label for="Status" class="col-md-2">Estatus del Evento</label>
											<div class="col-md-10">
												<label class="radio-inline col-md-3">
												    <input type="radio" name="Status" id="Status1" value="Active" <?=set_value('Status')=='Active' ? 'checked=""':''?>>Activo
												</label>
												<label class="radio-inline col-md-3">
												    <input type="radio" name="Status" id="Status2" value="Off" <?=set_value('Status')=='Off' ? 'checked=""':''?>> Inactivo
												</label>
											</div>
                                        </div>
										<?php echo form_error('Slogan','<div class="alert alert-danger alert-dismissable">
											<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
											<strong>Error!</strong>','.</div>'); ?>
										<div class="form-group">
										  <label for="Slogan" class="col-md-2">Slogan</label>
											<div class="col-md-10">
												<?=form_textarea(array('name' => 'Slogan', 
												   'id'   => 'Slogan', 
												   'class'=> 'form-control',
												   'value'=> set_value('Slogan')))?>
											</div>
										</div>
										<?php echo form_error('Hours','<div class="alert alert-danger alert-dismissable">
											<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
											<strong>Error!</strong>','.</div>'); ?>
										<div class="form-group">
										  <label for="Hours" class="col-md-2">Horas</label>
											<div class="col-md-10">
												<input type="number" class="form-control" name="Hours" placeholder="Horas del Evento" required="" value="<?=set_value('Hours')?>">
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