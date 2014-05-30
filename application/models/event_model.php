<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Event_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    function insert_event($_data)
    {
        $data = array(
            'Name'    => $_data->post('Name'),
			'Purpose' => $_data->post('Purpose'),
			'Type'    => $_data->post('Type')
        );
        
        if($this->db->insert('Event',$data))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    
    function get_all_events(){
        $query = $this->db->get('Event');
        
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
        $query = $this->db->where('Id',$_id)->get('Event');
        
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
    
    function update_event($_data){
        
        $data = array(
            'Name'    => $_data->post('Name'),
			'Purpose' => $_data->post('Purpose'),
			'Type'    => $_data->post('Type')
        );
        
        if($this->db->where('Id',$_data->post('Id'))->update('Event',$data)){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    /**
     * TODO: Al eliminar se debe eliminar las referencias a Scheduled_Event primero.
     */
    function delete_event($id){
        
        if($this->db->where('Id',$id)->delete('Event')){
            return TRUE;
        }else{
            return FALSE;
        }
    }
}