<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Usuarios</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Nuevo Usuario
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
									<?=form_open('user/new_user/2', array('role'=>'form','autocomplet'=>'off','class'=>'form-horizontal'))?>
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
												<input class="form-control" name="DNI" id="DNI" value="<?=$dni?>" maxlength="50" required="" disabled>
											</div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2">Nombre</label>
											<div class="col-md-10">
												<input class="form-control" name="Name" id="Name" value="<?=set_value('Name')?>" maxlength="50" required="">
											</div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-2">Apellido</label>
											<div class="col-md-10">
												<input class="form-control" name="Last_Name" id="Last_Name" value="<?=set_value('Last_Name')?>" maxlength="60" required="">
											</div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-2">Correo Electrónico</label>
											<div class="col-md-10">
												<input class="form-control" name="Email" id="Email" value="<?=set_value('Email')?>" maxlength="60" required="">
											</div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-2">Sexo</label>
											<div class="col-md-10">
												<?php $options = array(''=>'- Seleccione -','Female'=>'Femenino', 'Male'=>'Masculino'); ?>
												<?php $settings = 'class = "form-control"'; ?>
												<?=form_dropdown('Gender', $options,'',$settings);?>
											</div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-2">País</label>
											<div class="col-md-10">
												<?php $options = array(''=>'- Seleccione -'); ?>
												<?php if ($countries != 0): ?>
															<?php foreach($countries as $country) {$options[$country->Id] = $country->Name;} ?>
												<?php endif; ?>
												<?=form_dropdown('Country', $options,'','class = "form-control" id="Country"');?>
											</div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-2">Estado</label>
											<div class="col-md-10">
												<?php $options = array(''=>'- Seleccione -'); ?>
												<?=form_dropdown('State', $options,'','class = "form-control" id="State"');?>
											</div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-2">Ciudad</label>
											<div class="col-md-10">
												<?php $options = array(''=>'- Seleccione -'); ?>
												<?=form_dropdown('City', $options,'','class = "form-control" id="City"');?>
											</div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-2">Tipo</label>
											<div class="col-md-10">
												<?php $options = array(''=>'- Seleccione -','Super Admin'=>'Super Administrador','Admin'=>'Administrador','Evaluation Committee'=>'Junta Evaluadora'); ?>
												<?=form_dropdown('Type', $options,'','class = "form-control" id="Type"');?>
											</div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-2">Usuario</label>
											<div class="col-md-10">
												<input class="form-control" name="Username" id="Username" value="<?=set_value('Username')?>" maxlength="50" required="">
											</div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-2">Contraseña</label>
											<div class="col-md-10">
												<input class="form-control" name="Password" id="Password" value="<?=set_value('Password')?>" type="password" maxlength="15" required="">
												<p class="help-block">Entre 8 y 15 caracteres.</p>
											</div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-2">Reescriba la Contraseña</label>
											<div class="col-md-10">
												<input class="form-control" name="Pass" id="Pass" type="password" maxlength="15" required="">
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