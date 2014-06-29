<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Planning_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    function insert_planning($_data)
    {
        $data = array(
            'Start_Date'         => $_data->post('Start_Date'),
			'End_Date'           => $_data->post('End_Date'),
			'Description'        => $_data->post('Description'),
			'Scheduled_Event_Id' => $_data->post('Scheduled_Event_Id')
        );
		
        if($this->db->insert('Planning',$data))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    
    function get_all_planning(){
        $query = $this->db->get('Planning');
        
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
	
	function get_all_planning_by_scheduled_event($id){
        $query = $this->db->where('Scheduled_Event_Id',$id)->get('Planning');
        
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
    
    function get_by_id($_id)
    {
        $query = $this->db->where('Id',$_id)->get('Planning');
        
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
    
    function update_planning($_data){
        
        $data = array(
            'Start_Date'         => $_data->post('Start_Date'),
			'End_Date'           => $_data->post('End_Date'),
			'Description'        => $_data->post('Description'),
			'Scheduled_Event_Id' => $_data->post('Scheduled_Event_Id')
        );
        
        if($this->db->where('Id',$_data->post('Id'))->update('Planning',$data)){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    function delete_planning($id){
        
        if($this->db->where('Id',$id)->delete('Planning')){
            return TRUE;
        }else{
            return FALSE;
        }
    }
}