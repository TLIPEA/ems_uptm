<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class State_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    function insert_state($_data)
    {
        $data = array(
            'Name'        => $_data->post('Name'),
			'Country_Id'  => $_data->post('Country_Id'),
        );
        
        if($this->db->insert('State',$data))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    
    function get_all_states(){
        $query = $this->db->get('State');
        
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
        $query = $this->db->where('Id',$_id)->get('State');
        
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
	
	function get_by_id_country($_id)
    {
        $query = $this->db->where('Country_Id',$_id)->get('State');
        
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
    
    function update_state($_data){
        
        $data = array(
            'Name'      => $_data->post('Name'),
			'Country_Id'  => $_data->post('Country_Id'),
        );
        
        if($this->db->where('Id',$_data->post('Id'))->update('State',$data)){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    /**
     * TODO: Al eliminar se debe eliminar las referencias a City primero.
     */
    function delete_state($id){
        
        if($this->db->where('Id',$id)->delete('State')){
            return TRUE;
        }else{
            return FALSE;
        }
    }
}