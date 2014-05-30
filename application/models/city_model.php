<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class City_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    function insert_city($_data)
    {
        $data = array(
            'Name'        => $_data->post('Name'),
			'State_Id'  => $_data->post('State_Id'),
        );
        
        if($this->db->insert('City',$data))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    
    function get_all_cities(){
        $query = $this->db->get('City');
        
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
        $query = $this->db->where('Id',$_id)->get('City');
        
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
    
    function update_city($_data){
        
        $data = array(
            'Name'      => $_data->post('Name'),
			'State_Id'  => $_data->post('State_Id'),
        );
        
        if($this->db->where('Id',$_data->post('Id'))->update('City',$data)){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    /**
     * TODO: Al eliminar se debe eliminar las referencias a Participant primero.
     */
    function delete_city($id){
        
        if($this->db->where('Id',$id)->delete('City')){
            return TRUE;
        }else{
            return FALSE;
        }
    }
}