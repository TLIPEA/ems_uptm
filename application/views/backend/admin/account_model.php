<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Account_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    function insert_account($_data)
    {
        $data = array(
            'Bank'   => $_data->post('Bank'),
			'Number' => $_data->post('Number'),
			'Holder' => $_data->post('Holder'),
			'DNI'    => $_data->post('DNI'),
			'Status' => $_data->post('Status'),
			'Type'   => $_data->post('Type')
        );
        
        if($this->db->insert('Account',$data))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    
    function get_all_accounts(){
        $query = $this->db->get('Account');
        
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
        $query = $this->db->where('Id',$_id)->get('Account');
        
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
	
	function get_by_scheduled_event_id($_id)
    {
        $query = $this->db->select('Account.*,')
						->join('Scheduled_Event_Account','Scheduled_Event_Account.Account_Id = Account.Id','INNER')
						->join('Scheduled_Event','Scheduled_Event_Account.Scheduled_Event_Id = Scheduled_Event.Id AND Scheduled_Event.Id = '.$_id,'INNER')
						->get('Account');
        
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

	function get_all_events_asociated($id)
    {
        $query = $this->db->select('Name, Scheduled_Event.Id as Id')
						->join('Scheduled_Event_Account','Scheduled_Event_Account.Account_Id = Account.Id','INNER')
						->join('Scheduled_Event','Scheduled_Event_Account.Scheduled_Event_Id = Scheduled_Event.Id','INNER')
						->join('Event','Event_Id = Event.Id','INNER')
						->where('Account.Id',$id)
						->get('Account');
        
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
    
    function update_account($_data){
        
        $data = array(
            'Bank'   => $_data->post('Bank'),
			'Number' => $_data->post('Number'),
			'Holder' => $_data->post('Holder'),
			'DNI'    => $_data->post('DNI'),
			'Status' => $_data->post('Status'),
			'Type'   => $_data->post('Type')
        );
        
        if($this->db->where('Id',$_data->post('Id'))->update('Account',$data)){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    /**
     * TODO: Al eliminar se debe eliminar las referencias a Payment, Scheduled_Event_Account primero.
     */
    function delete_account($id){
        
        if($this->db->where('Id',$id)->delete('Account')){
            return TRUE;
        }else{
            return FALSE;
        }
    }
}
