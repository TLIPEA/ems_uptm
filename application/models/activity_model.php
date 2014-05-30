<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Activity_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    function insert_activity($_data)
    {
        $data = array(
            'Title'              => $_data->post('Title'),
			'Mode'               => $_data->post('Mode'),
			'Participation_Type' => $_data->post('Participation_Type'),
			'Keywords'           => $_data->post('Keywords'),
			'Summary'            => $_data->post('Summary'),
			'Summary_Words'      => $_data->post('Summary_Words'),
			'Scheduled_Event_Id' => $_data->post('Scheduled_Event_Id')
        );
		
        if($this->db->insert('Activity',$data))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    
    function get_all_activities(){
        $query = $this->db->get('Activity');
        
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
        $query = $this->db->where('Id',$_id)->get('Activity');
        
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
    
    function update_activity($_data){
        
        $data = array(
            'Title'              => $_data->post('Title'),
			'Mode'               => $_data->post('Mode'),
			'Participation_Type' => $_data->post('Participation_Type'),
			'Keywords'           => $_data->post('Keywords'),
			'Summary'            => $_data->post('Summary'),
			'Summary_Words'      => $_data->post('Summary_Words'),
			'Scheduled_Event_Id' => $_data->post('Scheduled_Event_Id')
        );
        
        if($this->db->where('Id',$_data->post('Id'))->update('Activity',$data)){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    /**
     * TODO: Al eliminar se debe eliminar las referencias a Author, Knowledge_Activity primero.
     */
    function delete_activity($id){
        
        if($this->db->where('Id',$id)->delete('Activity')){
            return TRUE;
        }else{
            return FALSE;
        }
    }
}