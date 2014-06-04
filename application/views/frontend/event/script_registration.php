<script type="text/javascript">
	function load_cost_by_event()
	{
		$('#Cost_Id').empty();
        
        if($('select[name=Scheduled_Event_Id]').val()!=''){
 
            $.ajax({
                url: '<?=site_url('event/load_cost_by_scheduled_event')?>',
                type:'GET',
                dataType: 'json',
                data: 'Scheduled_Event_Id='+$('select[name=Scheduled_Event_Id]').val(),
                success: function(output_string){
                            $('#Cost_Id').empty();
                            $('#Cost_Id').append(output_string);
                        } // End of success function of ajax form
            }); // End of ajax call
            
        }
	}
</script>
