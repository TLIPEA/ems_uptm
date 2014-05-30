<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Place_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    function insert_place($_data)
    {
        $data = array(
            'Name'               => $_data->post('Name'),
			'Description'        => $_data->post('Description'),
			'Scheduled_Event_Id' => $_data->post('Scheduled_Event_Id')
        );
        
        if($this->db->insert('Place',$data))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    
    function get_all_places(){
        $query = $this->db->get('Place');
        
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
        $query = $this->db->where('Id',$_id)->get('Place');
        
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
    
    function update_place($_data){
        
        $data = array(
            'Name'               => $_data->post('Name'),
			'Description'        => $_data->post('Description'),
			'Scheduled_Event_Id' => $_data->post('Scheduled_Event_Id')
        );
        
        if($this->db->where('Id',$_data->post('Id'))->update('Place',$data)){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    function delete_place($id){
        
        if($this->db->where('Id',$id)->delete('Place')){
            return TRUE;
        }else{
            return FALSE;
        }
    }
}