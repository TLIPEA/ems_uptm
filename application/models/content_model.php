<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Content_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    function insert_content($_data)
    {
        $data = array(
            'X'                   => $_data->post('X'),
			'Y'                   => $_data->post('Y'),
			'WH'                  => $_data->post('WH'),
			'Name'                => $_data->post('Name'),
			'Certified_Design_Id' => $_data->post('Certified_Design_Id')
        );
		
        if($this->db->insert('Content',$data))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    
    function get_all_contents(){
        $query = $this->db->get('Content');
        
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
        $query = $this->db->where('Id',$_id)->get('Content');
        
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
    
    function update_content($_data){
        
        $data = array(
            'X'                   => $_data->post('X'),
			'Y'                   => $_data->post('Y'),
			'WH'                  => $_data->post('WH'),
			'Name'                => $_data->post('Name'),
			'Certified_Design_Id' => $_data->post('Certified_Design_Id')
        );
        
        if($this->db->where('Id',$_data->post('Id'))->update('Content',$data)){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    function delete_content($id){
        
        if($this->db->where('Id',$id)->delete('Content')){
            return TRUE;
        }else{
            return FALSE;
        }
    }
}