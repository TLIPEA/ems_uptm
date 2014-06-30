<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Sale_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    function insert_sale($_data)
    {
        $data = array(
            'Start_Date'         => $_data->post('Start_Date'),
			'End_Date'           => $_data->post('End_Date'),
			'Description'        => $_data->post('Description'),
			'Status'             => $_data->post('Status'),
			'Type'               => $_data->post('Type'),
			'Scheduled_Event_Id' => $_data->post('Scheduled_Event_Id')
        );
        
        if($this->db->insert('Sale',$data))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    
    function get_all_sales()
	{
        $query = $this->db->select('Sale.*,Event.Name')
					->join('Scheduled_Event','Scheduled_Event.Id = Sale.Scheduled_Event_Id','INNER')
					->join('Event','Event.Id = Scheduled_Event.Event_Id','INNER')
					->get('Sale');
        
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
	
	function get_all_sales_by_scheduled_event($id)
	{
        $query = $this->db->where('Scheduled_Event_Id',$id)->order_by('Start_Date','ASC')
						->get('Sale');
        
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
	
	function get_all_sales_with_cost_by_scheduled_event($id)
	{
        $query = $this->db->where('Scheduled_Event_Id',$id)->order_by('Start_Date','ASC')
						->join('Cost','Cost.Sale_Id = Sale.Id','INNER')->get('Sale');
        
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
	
	function get_sale_active_with_cost_by_scheduled_event($id)
	{
        $query = $this->db->where('Scheduled_Event_Id',$id)->where('Status','Active')
						->join('Cost','Cost.Sale_Id = Sale.Id','INNER')->get('Sale');
        
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
	
	function get_all_cost_by_sale_id($id)
	{
		$query = $this->db->where('Sale.Id',$id)->join('Cost','Cost.Sale_Id = Sale.Id','INNER')->get('Sale');
        
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
        $query = $this->db->where('Id',$_id)->get('Sale');
        
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
    
    function update_sale($_data){
        
        $data = array(
            'Start_Date'         => $_data->post('Start_Date'),
			'End_Date'           => $_data->post('End_Date'),
			'Description'        => $_data->post('Description'),
			'Status'             => $_data->post('Status'),
			'Type'               => $_data->post('Type'),
			'Scheduled_Event_Id' => $_data->post('Scheduled_Event_Id')
        );
        
        if($this->db->where('Id',$_data->post('Id'))->update('Sale',$data)){
            return TRUE;
        }else{
            return FALSE;
        }
    }
	
	function update_sale_status_by_scheduled_event($Scheduled_Event_Id,$Status){
        
        $data = array(
			'Status'             => $Status,
        );
        
        if($this->db->where('Scheduled_Event_Id',$Scheduled_Event_Id)->update('Sale',$data)){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    /**
     * TODO: Al eliminar se debe eliminar las referencias a Cost, Register, primero.
     */
    function delete_sale($id){
        
        if($this->db->where('Id',$id)->delete('Sale')){
            return TRUE;
        }else{
            return FALSE;
        }
    }
}