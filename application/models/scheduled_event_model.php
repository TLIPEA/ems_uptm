<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Scheduled_Event_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    function insert_scheduled_event($_data)
    {
        $data = array(
            'Start_Date'                  => $_data->post('Start_Date'),
			'End_Date'                    => $_data->post('End_Date'),
			'Mode'                        => $_data->post('Mode'),
			'Quota'                       => $_data->post('Quota'),
			'Status'                      => $_data->post('Status'),
			'Slogan'                      => $_data->post('Slogan'),
			'Hours'                       => $_data->post('Hours'),
			'Extending_summary_date'      => $_data->post('Extending_summary_date'),
			'Extending_final_report_date' => $_data->post('Extending_final_report_date'),
			'Event_Id'                    => $_data->post('Event_Id')
		);
        
        if($this->db->insert('Scheduled_Event',$data))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    
    function get_all_scheduled_events(){
        $query = $this->db->select('Event.Name,Event.Purpose,Event.Type,Scheduled_Event.*')
						->join('Event','Event.Id = Scheduled_Event.Event_Id','INNER')
						->order_by('Start_Date','DESC')->get('Scheduled_Event');
        
        if($query->num_rows() > 0){
            foreach($query->result() as $row){
                $data[] = $row;
            }
            return $data;
        }
        else{
            return 0;
        }
    }
	
	function get_all_scheduled_events_actives()
	{
        $query = $this->db->select('Event.Name,Event.Purpose,Event.Type,Scheduled_Event.*')
						->join('Event','Event.Id = Scheduled_Event.Event_Id','INNER')
						->where('Status','Active')->where('Start_Date >= CURRENT_TIMESTAMP')
						->order_by('Start_Date','ASC')->get('Scheduled_Event');
        
        if($query->num_rows() > 0){
            foreach($query->result() as $row){
                $data[] = $row;
            }
            return $data;
        }
        else{
            return 0;
        }
    }
	
	function get_all_scheduled_events_actives_by_type($type)
	{
		$query = $this->db->select('Event.Name,Event.Purpose,Event.Type,Scheduled_Event.*')
						->join('Event','Event.Id = Scheduled_Event.Event_Id','INNER')
						->where('Status','Active')->where('Type',$type)->where('Start_Date >= CURRENT_TIMESTAMP')
						->order_by('Start_Date','ASC')->get('Scheduled_Event');
        
        if($query->num_rows() > 0)
		{
            foreach($query->result() as $row)
			{
                $data[] = $row;
            }
            return $data;
        }
        else
		{
            return 0;
        }
	}
	
	function get_all_scheduled_events_actives_by_type_with_applications_change()
	{
		$query = $this->db->select('Event.Name,Event.Purpose,Event.Type,Scheduled_Event.*')
						->join('Event','Event.Id = Scheduled_Event.Event_Id','INNER')
						->where('Status','Active')->where('Event.Type = \'Meeting\' OR Event.Type = \'Conference\' OR Event.Type = \'Congress\' ')->get('Scheduled_Event');
        
        if($query->num_rows() > 0)
		{
            foreach($query->result() as $row)
			{
                $data[] = $row;
            }
            return $data;
        }
        else{
            return 0;
        }
	}
    
    function get_by_id($_id)
    {
        $query = $this->db->select('Event.Name,Event.Purpose,Event.Type,Scheduled_Event.*')
						->join('Event','Event.Id = Scheduled_Event.Event_Id','INNER')
						->where('Scheduled_Event.Id',$_id)->get('Scheduled_Event',1);
        
        if($query->num_rows() > 0){
            foreach($query->result() as $row){
                $data[] = $row;
            }
            return $data;
        }
        else{
            return 0;
        }
    }
    
    function update_scheduled_event($_data){
        
        $data = array(
            'Start_Date'                  => $_data->post('Start_Date'),
			'End_Date'                    => $_data->post('End_Date'),
			'Mode'                        => $_data->post('Mode'),
			'Quota'                       => $_data->post('Quota'),
			'Status'                      => $_data->post('Status'),
			'Slogan'                      => $_data->post('Slogan'),
			'Hours'                       => $_data->post('Hours'),
			'Event_Id'                    => $_data->post('Event_Id')
        );
        
        if($this->db->where('Id',$_data->post('Id'))->update('Scheduled_Event',$data)){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    /**
     * TODO: Al eliminar se debe eliminar las referencias a Sale, Register, Scheduled_Event_Account, Activity, Knowledge, Place, Planning, Certified_Design primero.
     */
    function delete_scheduled_event($id){
        
        if($this->db->where('Id',$id)->delete('Scheduled_Event')){
            return TRUE;
        }else{
            return FALSE;
        }
    }
}