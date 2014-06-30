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
                            Costos de la Preventa <?=$sale[0]->Description?>
							<div class="pull-right"><a class="btn btn-warning btn-xs" href="<?=site_url('sale/index/'.$event[0]->Id)?>">Preventas</a></div>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
									<?=form_open('sale/costs/'.$sale[0]->Id.'/2', array('role'=>'form','autocomplet'=>'off','class'=>'form-horizontal'))?>
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
										  <label for="Student" class="col-md-2">Estudiantes</label>
											<div class="col-md-10">
												<input type="text" class="form-control" id="Student" name="Student" required="" value="<?php if($costs!=0):foreach($costs as $cost):
														if($cost->Type=='Student'):
															if($cost->Amount==0):
																echo -2;
															else:
																echo $cost->Amount;
															endif;
														endif;
													  endforeach;endif;?>">
												<input type="hidden" name="Student_Id" value="<?php $Student=0;
													if($costs!=0):
													foreach($costs as $cost):
														if($cost->Type=='Student'):
															echo $cost->Id;
															$Student = 1;
														endif;
													  endforeach;
													  if($Student!=1):
														echo '0';
													  endif;
													endif;?>">
											</div>
										</div>
										<div class="form-group">
										  <label for="Student" class="col-md-2">Ponentes</label>
											<div class="col-md-10">
												<input type="text" class="form-control" id="Speaker" name="Speaker" required="" value="<?php if($costs!=0):foreach($costs as $cost):
														if($cost->Type=='Speaker'):
															if($cost->Amount==0):
																echo -2;
															else:
																echo $cost->Amount;
															endif;
														endif;
													  endforeach;endif;?>">
												<input type="hidden" name="Speaker_Id" value="<?php $Student=0;
													if($costs!=0):
													foreach($costs as $cost):
														if($cost->Type=='Speaker'):
															echo $cost->Id;
															$Student = 1;
														endif;
													  endforeach;
													  if($Student!=1):
														echo '0';
													  endif;
													endif;?>">
											</div>
										</div>
										<div class="form-group">
										  <label for="Student" class="col-md-2">Profesionales y Publico en General</label>
											<div class="col-md-10">
												<input type="text" class="form-control" id="General" name="General" required="" value="<?php if($costs!=0):foreach($costs as $cost):
														if($cost->Type=='Professionals & General Public'):
															if($cost->Amount==0):
																echo -2;
															else:
																echo $cost->Amount;
															endif;
														endif;
													  endforeach;endif;?>">
												<input type="hidden" name="General_Id" value="<?php $Student=0;
													if($costs!=0):
													foreach($costs as $cost):
														if($cost->Type=='Professionals & General Public'):
															echo $cost->Id;
															$Student = 1;
														endif;
													  endforeach;
													  if($Student!=1):
														echo '0';
													  endif;
													endif;?>">
											</div>
										</div>
										<input type="hidden" name="Sale_Id" value="<?=$sale[0]->Id?>" />
										<input type="hidden" name="Scheduled_Event_Id" value="<?=$event[0]->Id?>" />
										<div class="col-md-1 pull-right text-center">
											<button type="reset" class="btn btn-info ">Limpiar</button>
										</div>
										<div class="col-md-1 pull-right text-center">
										<button type="submit" class="btn btn-success pull-right">Guardar</button>
										</div>
                                    </form>
									<p>Si el evento no tiene costo coloque -2 en el Campo</p>
									<p>Si desea eliminar un costo sustituya el campo por -1</p>
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