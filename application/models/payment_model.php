<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Payment_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    function insert_payment($_data)
    {
        $data = array(
            'Payment_Date'    => $_data->post('Payment_Date'),
			'Amount'          => $_data->post('Amount'),
			'Voucher_Number'  => $_data->post('Voucher_Number'),
			'Registration_Id' => $_data->post('Registration_Id'),
			'Account_Id'      => $_data->post('Account_Id')
        );
		
        if($this->db->insert('Payment',$data))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    
    function get_all_payments()
	{
        $query = $this->db->select('Event.Name,Account.Bank,Payment.*,Participant.DNI')
						->join('Registration','Registration.Id = Payment.Registration_Id','INNER')
						->join('Scheduled_Event','Scheduled_Event.Id = Registration.Scheduled_Event_Id','INNER')
						->join('Event','Event.Id = Scheduled_Event.Event_Id','INNER')
						->join('Participant','Participant.Id = Registration.Participant_Id','INNER')
						->join('Account','Account.Id = Payment.Account_Id','INNER')
						->get('Payment');
        
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
	
	function get_all_payments_by_registration($id)
	{
        $query = $this->db->select('Account.Bank,Payment.*')
						->join('Account','Account.Id = Payment.Account_Id','INNER')
						->where('Registration_Id',$id)->get('Payment');
        
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
	
	function get_all_payments_by_scheduled_event($id)
	{
        $query = $this->db->select('Account.Bank,Payment.*,Participant.DNI')
						->join('Registration','Registration.Id = Payment.Registration_Id','INNER')
						->join('Participant','Participant.Id = Registration.Participant_Id','INNER')
						->join('Account','Account.Id = Payment.Account_Id','INNER')
						->where('Scheduled_Event_Id',$id)->get('Payment');
        
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
        $query = $this->db->where('Id',$_id)->get('Payment');
        
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
    
    function update_payment($_data){
        
        $data = array(
            'Payment_Date'    => $_data->post('Payment_Date'),
			'Amount'          => $_data->post('Amount'),
			'Voucher_Number'  => $_data->post('Voucher_Number'),
			'Register_Date'   => $_data->post('Register_Date'),
			'Status'          => $_data->post('Status'),
			'Registration_Id' => $_data->post('Registration_Id'),
			'Account_Id'      => $_data->post('Account_Id')
        );
        
        if($this->db->where('Id',$_data->post('Id'))->update('Payment',$data)){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    function delete_payment($id){
        
        if($this->db->where('Id',$id)->delete('Payment')){
            return TRUE;
        }else{
            return FALSE;
        }
    }
}