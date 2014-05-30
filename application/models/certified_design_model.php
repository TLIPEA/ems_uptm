<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Certified_Design_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    function insert_certified_design($_data)
    {
        $data = array(
            'Img'                => $_data->post('Img'),
			'Scheduled_Event_Id' => $_data->post('Scheduled_Event_Id'),
        );
        
        if($this->db->insert('Certified_Design',$data))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    
    function get_all_certified_designs(){
        $query = $this->db->get('Certified_Design');
        
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
        $query = $this->db->where('Id',$_id)->get('Certified_Design');
        
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
    
    function update_certified_design($_data){
        
        $data = array(
            'Img'                => $_data->post('Img'),
			'Scheduled_Event_Id' => $_data->post('Scheduled_Event_Id'),
        );
        
        if($this->db->where('Id',$_data->post('Id'))->update('Certified_Design',$data)){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    /**
     * TODO: Al eliminar se debe eliminar las referencias a Content primero.
     */
    function delete_certified_design($id){
        
        if($this->db->where('Id',$id)->delete('Certified_Design')){
            return TRUE;
        }else{
            return FALSE;
        }
    }
}