<link rel="stylesheet" type="text/css" media="screen" href="<?=base_url('css/bootstrap-datetimepicker.min.css');?>" />
<script type="text/javascript" src="<?=base_url('js/moment.js');?>"></script>
<script type="text/javascript" src="<?=base_url('js/bootstrap-datetimepicker.js');?>"></script>
<script type="text/javascript">
    $(function () {
        $('#Payment_Date').datetimepicker({pickTime: false,minDate:'Hoy'});
		
    });
</script>