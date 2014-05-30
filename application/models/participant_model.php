<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Participant_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    function insert_participant($_data)
    {
        $data = array(
            'DNI'           => $_data->post('DNI'),
			'Name'          => $_data->post('Name'),
			'Last_Name'     => $_data->post('Last_Name'),
			'Email'         => $_data->post('Email'),
			'Genger'        => $_data->post('Genger'),
			'Username'      => $_data->post('Username'),
			'Password'      => $_data->post('Password'),
			'Register_Date' => $_data->post('Register_Date'),
			'City_Id'       => $_data->post('City_Id')
        );
		
        if($this->db->insert('Participant',$data))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    
    function get_all_participants(){
        $query = $this->db->get('Participant');
        
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
        $query = $this->db->where('Id',$_id)->get('Participant');
        
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
    
    function update_participant($_data){
        
        $data = array(
            'DNI'           => $_data->post('DNI'),
			'Name'          => $_data->post('Name'),
			'Last_Name'     => $_data->post('Last_Name'),
			'Email'         => $_data->post('Email'),
			'Gender'        => $_data->post('Gender'),
			'Username'      => $_data->post('Username'),
			'Password'      => $_data->post('Password'),
			'Register_Date' => $_data->post('Register_Date'),
			'City_Id'       => $_data->post('City_Id')
        );
        
        if($this->db->where('Id',$_data->post('Id'))->update('Participant',$data)){
            return TRUE;
        }else{
            return FALSE;
        }
    }
	
	function check_login($username)
	{
		$query = $this->db->join('User','User.Participant_Id = Participant.Id','INNER')->where('Username',$username)->get('Participant');
        
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
    
    /**
     * TODO: Al eliminar se debe eliminar las referencias a Register, Author primero.
     */
    function delete_participant($id){
        
        if($this->db->where('Id',$id)->delete('Participant')){
            return TRUE;
        }else{
            return FALSE;
        }
    }
}