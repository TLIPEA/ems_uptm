<script type="text/javascript">
	function load_cost_by_event_for_falitator()
	{
		$('#Cost_Id').empty();
		$('#Knowledge_Id').empty();
        
        if($('select[name=Scheduled_Event_Id]').val()!=''){
			
            $.ajax({
                url: '<?=site_url('event/load_knowledge_and_cost_by_scheduled_event_for_falitator')?>',
                type:'GET',
                dataType: 'json',
                data: 'Scheduled_Event_Id='+$('select[name=Scheduled_Event_Id]').val(),
                success: function(output_string){
                            $('#Cost_Id').empty();
                            $('#Cost_Id').append(output_string.costs);
							$('#Knowledge_Id').empty();
                            $('#Knowledge_Id').append(output_string.knowledges);
                        } // End of success function of ajax form
            }); // End of ajax call
        }
	}
	
	function add_input_author()
	{
		$.ajax({
            url: '<?=site_url('event/load_input_author')?>',
            type:'GET',
            dataType: 'json',
            data: 'num='+($('#authors').val()*1+1) ,
            success: function(output_string){
						$('#authors').val(($('#authors').val()*1)+1);
                        $('#divAuthors').append(output_string);
                    } // End of success function of ajax form
            }); // End of ajax call
	}
	
	function remove_input_author(id)
	{
		$('#authors').val(($('#authors').val()*1)-1);
		$(id).remove();
	}
</script>
