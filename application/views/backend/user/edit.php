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
                            Editar Usuario
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
									<?=form_open('user/edit/'.$user[0]->Id.'/2', array('role'=>'form','autocomplet'=>'off','class'=>'form-horizontal'))?>
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
												<input class="form-control" name="DNI" id="DNI" value="<?=$user[0]->DNI?>" maxlength="50" required="" disabled>
											</div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-2">Usuario</label>
											<div class="col-md-10">
												<input class="form-control" name="Username" id="Username" value="<?=$user[0]->Username?>" maxlength="50" required="" disabled>
											</div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2">Nombre</label>
											<div class="col-md-10">
												<input class="form-control" name="Name" id="Name" value="<?=set_value('Name')?set_value('Name'):$user[0]->Name?>" maxlength="50" required="">
											</div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-2">Apellido</label>
											<div class="col-md-10">
												<input class="form-control" name="Last_Name" id="Last_Name" value="<?=set_value('Last_Name')?set_value('Last_Name'):$user[0]->Last_Name?>" maxlength="60" required="">
											</div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-2">Correo Electrónico</label>
											<div class="col-md-10">
												<input class="form-control" name="Email" id="Email" value="<?=set_value('Email')?set_value('Email'):$user[0]->Email?>" maxlength="60" required="">
											</div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-2">Sexo</label>
											<div class="col-md-10">
												<?php $options = array(''=>'- Seleccione -','Female'=>'Femenino', 'Male'=>'Masculino'); ?>
												<?php $settings = 'class = "form-control"'; ?>
												<?php $selected = set_value('Gender') ? set_value('Gender') : $user[0]->Gender; ?>
												<?=form_dropdown('Gender', $options,$selected,$settings);?>
											</div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-2">País</label>
											<div class="col-md-10">
												<?php $options = array(''=>'- Seleccione -'); $selected = ''; ?>
												<?php if ($countries != 0): ?>
															<?php foreach($countries as $country) {$options[$country->Id] = $country->Name;} ?>
															<?php $selected = set_value('Country') ? set_value('Country') : $user[0]->Country_Id; ?>
												<?php endif; ?>
												<?=form_dropdown('Country', $options,$selected,'class = "form-control" id="Country"');?>
											</div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-2">Estado</label>
											<div class="col-md-10">
												<?php $options = array(''=>'- Seleccione -'); ?>
												<?php if ($states != 0): ?>
															<?php foreach($states as $state) {$options[$state->Id] = $state->Name;} ?>
															<?php $selected = set_value('State') ? set_value('State') : $user[0]->State_Id; ?>
												<?php endif; ?>
												<?=form_dropdown('State', $options,$selected,'class = "form-control" id="State"');?>
											</div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-2">Ciudad</label>
											<div class="col-md-10">
												<?php $options = array(''=>'- Seleccione -'); ?>
												<?php if ($cities != 0): ?>
															<?php foreach($cities as $city) {$options[$city->Id] = $city->Name;} ?>
															<?php $selected = set_value('City') ? set_value('City') : $user[0]->City_Id; ?>
												<?php endif; ?>
												<?=form_dropdown('City', $options,$selected,'class = "form-control" id="City"');?>
											</div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-2">Tipo</label>
											<div class="col-md-10">
												<?php $options = array(''=>'- Seleccione -','Super Admin'=>'Super Administrador','Admin'=>'Administrador','Evaluation Committee'=>'Junta Evaluadora'); ?>
												<?php if ($user[0]->Type != 'NULL')
														{$selected = set_value('Type') ? set_value('Type') : $user[0]->Type; }
												      else
													    {$selected = set_value('Type') ? set_value('Type') : '';}?> 
												<?=form_dropdown('Type', $options,$selected,'class = "form-control" id="Type"');?>
											</div>
                                        </div>
										<div class="col-md-1 pull-right text-center">
											<button type="reset" class="btn btn-info ">Limpiar</button>
										</div>
										<div class="col-md-1 pull-right text-center">
										<button type="submit" class="btn btn-success pull-right">Guardar</button>
										</div>
										<input type="hidden" name="Id" id="Id" value="<?=$user[0]->Id?>" />
										<input type="hidden" name="User_Id" id="User_Id" value="<?=$user[0]->User_Id?>" />
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