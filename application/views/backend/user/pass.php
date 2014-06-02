<div id="page-wrapper">
		    <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Usuarios</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Cambiar contraseña
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
									<?=form_open('user/pass/'.$user[0]->Id.'/2', array('role'=>'form','autocomplet'=>'off'))?>
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
                                            <label>Usuario</label>
                                            <p class="form-control-static"><?=$user[0]->Username?></p>

                                        </div>
									
                                        <div class="form-group">
                                            <label>Contraseña Actual</label>
                                            <input class="form-control" type="password" name="Actual" id="Actual" maxlength="15">
                                        </div>
										<div class="form-group">
                                            <label>Contraseña</label>
                                            <input class="form-control" name="Password" id="Password" type="password" maxlength="15">
											<p class="help-block">Entre 8 y 15 caracteres.</p>
                                        </div>
										<div class="form-group">
                                            <label>Reescriba la Contraseña</label>
                                            <input class="form-control" name="Pass" id="Pass" type="password" maxlength="15">
                                        </div>
										<button type="submit" class="btn btn-danger" id="pass">Cambiar Contraseña</button>
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