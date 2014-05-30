<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Scheduled_Event_Account_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    function insert_scheduled_event_account($_data)
    {
        $data = array(
            'Scheduled_Event_Id' => $_data->post('Scheduled_Event_Id'),
			'Account_Id'         => $_data->post('Account_Id'),
        );
		
        if($this->db->insert('Scheduled_Event_Account',$data))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    
    function get_all_scheduled_event_accounts(){
        $query = $this->db->get('Scheduled_Event_Account');
        
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
        $query = $this->db->where('Id',$_id)->get('Scheduled_Event_Account');
        
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
    
    function update_scheduled_event_account($_data){
        
        $data = array(
            'Scheduled_Event_Id' => $_data->post('Scheduled_Event_Id'),
			'Account_Id'         => $_data->post('Account_Id'),
        );
        
        if($this->db->where('Id',$_data->post('Id'))->update('Scheduled_Event_Account',$data)){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    function delete_scheduled_event_account($id){
        
        if($this->db->where('Id',$id)->delete('Scheduled_Event_Account')){
            return TRUE;
        }else{
            return FALSE;
        }
    }
}