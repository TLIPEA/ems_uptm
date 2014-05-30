
    <!-- Core Scripts - Include with every page -->
    <script src="<?=base_url('backend/js/jquery-1.10.2.js')?>"></script>
    <script src="<?=base_url('backend/js/bootstrap.min.js')?>"></script>
    <script src="<?=base_url('backend/js/plugins/metisMenu/jquery.metisMenu.js')?>"></script>

    <!-- SB Admin Scripts - Include with every page -->
		<script src="<?=base_url('backend/js/sb-admin.js')?>"></script>
	
	<?php if($controller == 'Home'): ?>
		<!-- Page-Level Plugin Scripts - Dashboard -->
		<script src="<?=base_url('backend/js/plugins/morris/raphael-2.1.0.min.js')?>"></script>
		<script src="<?=base_url('backend/js/plugins/morris/morris.js')?>"></script>
		
		<!-- Page-Level Demo Scripts - Dashboard - Use for reference -->
		<script src="<?=base_url('backend/js/demo/dashboard-demo.js')?>"></script>

	<?php elseif ($controller == 'Job' or $controller == 'Tag' or $controller == 'Category' or $controller == 'User'): ?>
		
		<script src="<?=base_url('backend/js/plugins/dataTables/jquery.dataTables.js')?>"></script>
		<script src="<?=base_url('backend/js/plugins/dataTables/dataTables.bootstrap.js')?>"></script>
    
		<script>
		$(document).ready(function() {
			$('#dataTables-example').dataTable({
				"oLanguage": {							   
					"sProcessing":     "Procesando...",
					"sLengthMenu":     "Mostrar _MENU_ registros",
					"sZeroRecords":    "No se encontraron resultados",
					"sEmptyTable":     "Ningún dato disponible en esta tabla",
					"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
					"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
					"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
					"sInfoPostFix":    "",
					"sSearch":         "Buscar:",
					"sUrl":            "",
					"sInfoThousands":  ",",
					"sLoadingRecords": "Cargando...",
					"oPaginate": {
						"sFirst":    "Primero",
						"sLast":     "Último",
						"sNext":     "Siguiente",
						"sPrevious": "Anterior"
					}
				},
				"oAria": {
					"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
					"sSortDescending": ": Activar para ordenar la columna de manera descendente"
				}
			});
		});
		</script>
	<?php elseif ($controller == 'New_Job' or $controller == 'New_Entry'): ?>
		<script src="<?=base_url('backend/js/plugins/summernote/summernote.js')?>"></script>
		<script src="<?=base_url('backend/js/plugins/summernote/summernote.min.js')?>"></script>
		<script type="text/javascript">
    $(function() {
      $('.summernote').summernote({
        height: 200
      });
	  $('form').on('submit', function (e) {
        $('#Description').val($('.summernote').code());
		$('#Content').val($('.summernote').code());
      });
    });
	
  </script>
	<?php elseif ($controller == 'New_Worker'): ?>
		<script type="text/javascript">
            $(document).ready(function(){
				$("#add_ss").click(function() {
					$("#ss").append(
                        '<br /><div class="form-group"><div class="col-md-6"><select name="icon[]" id="icon" class="form-control">'+    
                        '<option value="-1">Escoge una red social</option>'+
						'<option value="1">Twitter</option>'+
                        '<option value="2">Facebook</option>'+
						'<option value="3">Youtube</option>'+
						'<option value="4">Flickr</option>'+
						'<option value="5">Foursquare</option>'+
						'<option value="3">Github</option>'+
						'<option value="3">Google +</option>'+
						'<option value="3">Instagram</option>'+
						'<option value="3">Linked In</option>'+
						'<option value="3">Skype</option>'+
						'<option value="3">Tumblr</option>'+
						'<option value="3">Vimeo</option></select></div><div class="col-md-6">'+
						'<input type="text" class="form-control" id="url" name="url[]" placeholder="Escriba la url" /></div></div><br />');
			});
			
            });
	
        </script>   
	<?php elseif ($controller == 'Edit_User'): ?>
	<script type="text/javascript">
	
		$("#pass").click(function() {
				location.href = "<?=site_url('user/password/'.$user[0]->Id)?>";
		});
	</script>
	<?php endif;?>
	
</body>

</html>
