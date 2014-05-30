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
    
    function get_all_sales(){
        $query = $this->db->get('Sale');
        
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