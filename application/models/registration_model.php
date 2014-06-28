<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Registration_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    function insert_registration($_data)
    {
        $data = array(
			'Cost_Id'            => $_data->post('Cost_Id'),
			'Participant_Id'     => $_data->post('Participant_Id'),
			'Scheduled_Event_Id' => $_data->post('Scheduled_Event_Id')
        );
		
        if($this->db->insert('Registration',$data))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
	
	function insert_registration_facilitator($_data)
    {
        $data = array(
			'Cost_Id'            => $_data->post('Cost_Id'),
			'Participant_Id'     => $_data->post('Participant_Id'),
			'Scheduled_Event_Id' => $_data->post('Scheduled_Event_Id'),
			'Status'             => 'Facilitator',
        );
		
        if($this->db->insert('Registration',$data))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    
    function get_all_registrations()
	{
        $query = $this->db->get('Registration');
        
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
	
	function get_all_registrations_by_participant($id)
	{
        $query = $this->db->select('Event.Name,Scheduled_Event.Start_Date, Scheduled_Event.End_Date,Registration.*')
					->join('Scheduled_Event','Scheduled_Event.Id = Registration.Scheduled_Event_Id','INNER')
					->join('Event','Event.Id = Scheduled_Event.Event_Id','INNER')
					->where('Registration.Status <>','Facilitator')->where('Registration.Status <>','Organizer')
					->where('Registration.Status <>','Collaborator')->where('Registration.Status <>','Cancel')
					->where('Participant_Id',$id)->get('Registration');
        
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
	
	function get_registration_with_cost_by_participant($Scheduled_Event_Id,$Participant_Id)
	{
        $query = $this->db->select('Event.Name,Event.Type,Event.Purpose,Scheduled_Event.*,Registration.*,Cost.Amount, Cost.Type AS Cost_Type,Sale.Start_Date AS Sale_Start_Date, Sale.End_Date AS Sale_End_Date, (SELECT COUNT(*) FROM Payment WHERE Registration_Id = Registration.Id AND Status = \'Validated\') AS Payment_Validated, (SELECT COUNT(*) FROM Payment WHERE Registration_Id = Registration.Id AND Status = \'No Validated\') AS Payment_No_Validated, (SELECT COUNT(*) FROM Payment WHERE Registration_Id = Registration.Id AND Status = \'Invalid\') AS Payment_Invalid, (SELECT SUM(Amount) FROM Payment WHERE Registration_Id = Registration.Id AND Status = \'Validated\') AS Total_Pay')
					->join('Scheduled_Event','Scheduled_Event.Id = Registration.Scheduled_Event_Id','INNER')
					->join('Event','Event.Id = Scheduled_Event.Event_Id','INNER')
					->join('Cost','Cost.Id = Registration.Cost_Id','INNER')
					->join('Sale','Sale.Id = Cost.Sale_Id','INNER')
					->where('Cost.Type <>','Speaker')
					->where('Registration.Status <>','Facilitator')->where('Registration.Status <>','Organizer')
					->where('Registration.Status <>','Collaborator')->where('Registration.Status <>','Cancel')
					->where('Registration.Scheduled_Event_Id',$Scheduled_Event_Id)->where('Participant_Id',$Participant_Id)->get('Registration');
        
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
	
	function get_registration_id_by_participant($Scheduled_Event_Id,$Participant_Id)
	{
		$query = $this->db->select('Id')->where('Participant_Id',$Participant_Id)
				->where('Scheduled_Event_Id',$Scheduled_Event_Id)->get('Registration');
				
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
        $query = $this->db->where('Id',$_id)->get('Registration');
        
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
    
    function update_registration($_data){
        
        $data = array(
            'Status'             => $_data->post('Status'),
			'Registration_Date'  => $_data->post('Registration_Date'),
			'Sale_Id'            => $_data->post('Sale_Id'),
			'Participant_Id'     => $_data->post('Participant_Id'),
			'Scheduled_Event_Id' => $_data->post('Scheduled_Event_Id')
        );
        
        if($this->db->where('Id',$_data->post('Id'))->update('Registration',$data)){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    /**
     * TODO: Al eliminar se debe eliminar las referencias a Payment primero.
     */
    function delete_registration($id){
        
        if($this->db->where('Id',$id)->delete('Registration')){
            return TRUE;
        }else{
            return FALSE;
        }
    }
}