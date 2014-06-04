<script type="text/javascript">
	
	function load_summary(id)
	{
		if(id!='' && id!=0)
		{
			$('#myModalLabel').empty();
			$('#myModalBody').empty();
			
			$.ajax({
                url: '<?=site_url('event/load_summary_activity')?>',
                type:'GET',
                dataType: 'json',
                data: 'Id='+id,
                success: function(output_string){
							$('#myModalLabel').append(output_string.title);
							$('#myModalBody').append(output_string.body);
							$('#myModal').modal()
                        } // End of success function of ajax form
            }); // End of ajax call
		}
	}
	
	function load_knowledges(id)
	{
		if(id!='' && id!=0)
		{
			$('#myModalLabel').empty();
			$('#myModalBody').empty();
			
			$.ajax({
                url: '<?=site_url('event/load_knowledges_by_activity')?>',
                type:'GET',
                dataType: 'json',
                data: 'Id='+id,
                success: function(output_string){
                            $('#myModalLabel').append(output_string.title);
							$('#myModalBody').append(output_string.body);
							$('#myModal').modal()
                        } // End of success function of ajax form
            }); // End of ajax call
		}
	}
	
	function load_coauthors(id)
	{
		if(id!='' && id!=0)
		{
			$('#myModalLabel').empty();
			$('#myModalBody').empty();
			
			$.ajax({
                url: '<?=site_url('event/load_authors_by_activity')?>',
                type:'GET',
                dataType: 'json',
                data: 'Id='+id,
                success: function(output_string){
                            $('#myModalLabel').append(output_string.title);
							$('#myModalBody').append(output_string.body);
							$('#myModal').modal()
                        } // End of success function of ajax form
            }); // End of ajax call
		}
	}
</script>
