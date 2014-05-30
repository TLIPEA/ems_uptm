<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    function insert_user($_data)
    {
        $data = array(
            'Type'           => $_data->post('Type'),
			'Participant_Id' => $_data->post('Participant_Id'),
        );
		
        if($this->db->insert('User',$data))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    
    function get_all_users()
	{
        $query = $this->db->get('User');
        
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
	
	function get_all_users_with_participant()
	{
        $query = $this->db->join('Participant','Participant.Id = User.Participant_Id','INNER')->get('User');
        
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
    
    function get_by_id($_id)
    {
        $query = $this->db->where('Id',$_id)->get('User');
        
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
    
    function update_user($_data){
        
        $data = array(
            'Type'           => $_data->post('Type'),
			'Participant_Id' => $_data->post('Participant_Id'),
        );
        
        if($this->db->where('Id',$_data->post('Id'))->update('User',$data)){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    function delete_user($id){
        
        if($this->db->where('Id',$id)->delete('User')){
            return TRUE;
        }else{
            return FALSE;
        }
    }
}