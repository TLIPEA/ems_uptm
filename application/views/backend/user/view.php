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
                            Ver Usuario
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
									<?=form_open('user/edit/'.$user[0]->Id.'/2', array('role'=>'form','autocomplet'=>'off','class'=>'form-horizontal'))?>
										<div class="form-group">
                                            <label class="col-md-2">Cédula</label>
											<div class="col-md-10">
												<span class="form-control-static text-primary"><?=$user[0]->DNI?></span>
											</div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-2">Usuario</label>
											<div class="col-md-10">
												<span class="form-control-static text-primary"><?=$user[0]->Username?></span>
											</div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2">Nombre</label>
											<div class="col-md-10">
												<span class="form-control-static text-primary"><?=$user[0]->Name?></span>
											</div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-2">Apellido</label>
											<div class="col-md-10">
												<span class="form-control-static text-primary"><?=$user[0]->Last_Name?></span>
											</div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-2">Correo Electrónico</label>
											<div class="col-md-10">
												<span class="form-control-static text-primary"><?=$user[0]->Email?></span>
											</div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-2">Sexo</label>
											<div class="col-md-10">
												<span class="form-control-static text-primary"><?=($user[0]->Gender == 'Male')?'Masculino':'Femenino'?></span>
											</div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-2">País</label>
											<div class="col-md-10">
												<span class="form-control-static text-primary"><?=$user[0]->Country_Name?></span>
											</div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-2">Estado</label>
											<div class="col-md-10">
												<span class="form-control-static text-primary"><?=$user[0]->State_Name?></span>
											</div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-2">Ciudad</label>
											<div class="col-md-10">
												<span class="form-control-static text-primary"><?=$user[0]->City_Name?></span>
											</div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-2">Tipo</label>
											<div class="col-md-10">
												<?php
												   switch($user[0]->Type)
												   {
												      case 'Super Admin':
															$type = 'Super Administrador';
															break;
												      case 'Admin':
															$type = 'Administrador';
															break;
												      case 'Evaluation Committee':
															$type = 'Junta Evaluadora';
															break;
												      default:
															$type = '';
															break;
												   }
												?>
												<span class="form-control-static text-primary"><?=$type?></span>
											</div>
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