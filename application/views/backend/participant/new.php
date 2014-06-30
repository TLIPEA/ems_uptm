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
                            Nuevo Participante
							<div class="pull-right"><a class="btn btn-warning btn-xs" href="<?=site_url('events')?>">Eventos</a></div>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
									<?=form_open('events/new_event/2', array('role'=>'form','autocomplet'=>'off','class'=>'form-horizontal'))?>
									<?=validation_errors('<div class="alert-danger input-sm"><p><strong>','</strong> </div><br />')?>
									<?php if(isset($typeError)):?>
									<div class="col-md-12">
									<div class="alert alert-<?=($typeError == 1 )? 'success' : 'danger';?> <?=($typeError == 0 )? 'hide' : '';?> alert-dismissable">
											<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
											<strong><?=($typeError != 0 )? $titleError : '';?></strong> <?=$msg?>.
												</div>
									</div>
									<?php endif;?>
									<?php echo form_error('DNI','<div class="alert alert-danger alert-dismissable">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true"> ×</button><strong>Error!</strong> ','.</div>'); ?>
									<div class="form-group">
										<label class="col-sm-2 hidden-xs" for="">Cedula</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="DNI" placeholder="Cedula: V-18964136" required="" value="<?=set_value('DNI')?>" />
											<p class="help-block">El formato de la Cedula es V-18964136 Sin Puntos.</p>
										</div>
									</div>
									<?php echo form_error('Name','<div class="alert alert-danger alert-dismissable">
															<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><strong>Error!</strong> ',
															'.</div>'); ?>
									<div class="form-group">
										<label class="col-sm-2 hidden-xs" for="">Nombre</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="Name" placeholder="Nombre" required="" value="<?=set_value('Name')?>" />
										</div>
									</div>
									<?php echo form_error('Last_Name','<div class="alert alert-danger alert-dismissable">
															<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><strong>Error!</strong> ',
															'.</div>'); ?>
									<div class="form-group">
										<label class="col-sm-2 hidden-xs" for="">Apellido</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="Last_Name" placeholder="Apellido" required="" value="<?=set_value('Last_Name')?>" />
										</div>
									</div>
									<?php echo form_error('Email','<div class="alert alert-danger alert-dismissable">
															<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><strong>Error!</strong> ',
															'.</div>'); ?>
									<div class="form-group">
										<label class="col-sm-2 hidden-xs" for="">Correo Electronico</label>
										<div class="col-sm-10">
											<input type="email" class="form-control" name="Email" placeholder="Correo Electronico" required="" value="<?=set_value('Email')?>" />
										</div>
									</div>
									<?php echo form_error('Username','<div class="alert alert-danger alert-dismissable">
															<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><strong>Error!</strong> ',
															'.</div>'); ?>
									<div class="form-group">
										<label class="col-sm-2 hidden-xs" for="">Usuario</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="Username" placeholder="Usuario" required="" value="<?=set_value('Username')?>" />
										</div>
									</div>
									<?php echo form_error('Password','<div class="alert alert-danger alert-dismissable">
															<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><strong>Error!</strong> ',
															'.</div>'); ?>
									<div class="form-group">
										<label class="col-sm-2 hidden-xs" for="">Contraseña</label>
										<div class="col-sm-10">
											<input type="password" class="form-control" name="Password" placeholder="Contraseña" required="" />
											<p class="help-block">La contraseña debe tener un minimo de 6 caracteres.</p>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 hidden-xs" for="">Repetir Contraseña</label>
										<div class="col-sm-10">
											<input type="password" class="form-control" name="Password2" placeholder="Repetir Contraseña" required="" />
											<p class="help-block">Debe incluir nuevamente la contraseña para evitar errores de tipeo.</p>
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