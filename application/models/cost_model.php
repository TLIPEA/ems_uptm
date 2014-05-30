<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cost_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    function insert_cost($_data)
    {
        $data = array(
            'Amount'  => $_data->post('Amount'),
			'Type'    => $_data->post('Type'),
			'Sale_Id' => $_data->post('Sale_Id')
        );
        
        if($this->db->insert('Cost',$data))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    
    function get_all_costs(){
        $query = $this->db->get('Cost');
        
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
        $query = $this->db->where('Id',$_id)->get('Cost');
        
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
    
    function update_cost($_data){
        
        $data = array(
            'Amount'  => $_data->post('Amount'),
			'Type'    => $_data->post('Type'),
			'Sale_Id' => $_data->post('Sale_Id')
        );
        
        if($this->db->where('Id',$_data->post('Id'))->update('Cost',$data)){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    function delete_cost($id){
        
        if($this->db->where('Id',$id)->delete('Cost')){
            return TRUE;
        }else{
            return FALSE;
        }
    }
}