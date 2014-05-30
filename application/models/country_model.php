<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Country_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    function insert_country($_data)
    {
        $data = array(
            'Name'     => $_data->post('Name'),
        );
        
        if($this->db->insert('Country',$data))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    
    function get_all_countries(){
        $query = $this->db->get('Country');
        
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
        $query = $this->db->where('Id',$_id)->get('Country');
        
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
    
    function update_country($_data){
        
        $data = array(
            'Name'      => $_data->post('Name')
        );
        
        if($this->db->where('Id',$_data->post('Id'))->update('Country',$data)){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    /**
     * TODO: Al eliminar se debe eliminar las referencias a State primero.
     */
    function delete_country($id){
        
        if($this->db->where('Id',$id)->delete('Country')){
            return TRUE;
        }else{
            return FALSE;
        }
    }
}