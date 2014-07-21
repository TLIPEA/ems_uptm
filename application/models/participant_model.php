<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Participant_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
		$this->load->library('encrypt');
    }
    
    function insert_participant($_data)
    {
        $data = array(
            'DNI'           => $_data->post('DNI'),
			'Name'          => $_data->post('Name'),
			'Last_Name'     => $_data->post('Last_Name'),
			'Email'         => $_data->post('Email'),
			'Gender'        => $_data->post('Gender'),
			'Username'      => $_data->post('Username'),
			'Password'      => $this->encrypt->sha1($_data->post('Password')),
			'City_Id'       => ($_data->post('City') == 0)? NULL : $_data->post('City')
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
	
	function insert_participant_active($_data)
    {
        $data = array(
            'DNI'           => $_data->post('DNI'),
			'Name'          => $_data->post('Name'),
			'Last_Name'     => $_data->post('Last_Name'),
			'Email'         => $_data->post('Email'),
			'Gender'        => $_data->post('Gender'),
			'Username'      => $_data->post('Username'),
			'Password'      => $this->encrypt->sha1($_data->post('Password')),
			'City_Id'       => ($_data->post('City') == 0)? NULL : $_data->post('City'),
			'Status'        => 'Active'
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
	
	function insert_participant_coauthor($_data)
	{
		$data = array(
			'DNI'           => $_data['DNI'],
			'Name'          => $_data['Name'],
			'Last_Name'     => $_data['Last_Name'],
			'Email'         => $_data['Email'],
			'Gender'        => 0,
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
    
    function get_all_participants()
	{
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

	function get_by_id_with_user($_id)
    {
        $query = $this->db
						->select('Participant.Id AS Id, Participant.DNI as DNI, Participant.Name AS Name, Last_Name, Email, Gender, Username, City_Id, City.Name AS City_Name, Type, State_Id, State.Name AS State_Name, Country_Id, User.Id AS User_Id, Country.Name AS Country_Name ')
						->join('User','User.Participant_Id = Participant.Id','LEFT')
						->join('City','City.Id = Participant.City_Id','LEFT')
						->join('State','State.Id = City.State_Id','LEFT')
						->join('Country','Country.Id = State.Country_Id','LEFT')
						->where('Participant.Id',$_id)
						->get('Participant');
        
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
	
	function get_by_dni($_dni)
    {
        $query = $this->db->where('DNI',$_dni)->get('Participant');
        
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
			'Name'          => $_data->post('Name'),
			'Last_Name'     => $_data->post('Last_Name'),
			'Email'         => $_data->post('Email'),
			'Gender'        => $_data->post('Gender'),
			'City_Id'       => $_data->post('City')
        );
        
        if($this->db->where('Id',$_data->post('Id'))->update('Participant',$data)){
            return TRUE;
        }else{
            return FALSE;
        }
    }
	
	function update_full_participant($_data){
        
        $data = array(
			'Username'      => $_data->post('Username'),
			'Name'          => $_data->post('Name'),
			'Last_Name'     => $_data->post('Last_Name'),
			'Email'         => $_data->post('Email'),
			'Gender'        => $_data->post('Gender'),
			'City_Id'       => $_data->post('City')
        );
        
        if($this->db->where('Id',$_data->post('Id'))->update('Participant',$data)){
            return TRUE;
        }else{
            return FALSE;
        }
    }
	
	function update_status($_data){
        
        $data = array(
			'Status'          => $_data['Status'],
        );
        
        if($this->db->where('Id',$_data['Id'])->update('Participant',$data))
		{
            return TRUE;
        }
		else
		{
            return FALSE;
        }
    }
	
	function update_user_password($_data)
	{
		$data = array(
			'Password'      => $this->encrypt->sha1($_data->post('Password')),
		);
		
		if($this->db->where('Id',$_data->post('Participant_Id'))->update('Participant',$data))
		{
            return TRUE;
        }
		else
		{
            return FALSE;
        }
	}
	
	function check_login($username)
	{
		$query = $this->db->select('User.Id AS User_Id,Participant.*')->join('User','User.Participant_Id = Participant.Id','INNER')->where('Username',$username)->get('Participant');
        
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
	
	function check_login_participant($username)
	{
		$query = $this->db->where('Username',$username)->where('Status','Active')
							->get('Participant');
        
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
	
	function verify($code,$username)
	{
		$query = $this->db->where('Username',$username)->where('Id',$code)->get('Participant');
        
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