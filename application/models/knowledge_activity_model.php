<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Knowledge_Activity_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    function insert_knowledge_activity($_data)
    {
        $data = array(
            'Knowledge_Id' => $_data->post('Knowledge_Id'),
			'Activity_Id'  => $_data->post('Activity_Id'),
        );
		
        if($this->db->insert('Knowledge_Activity',$data))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    
    function get_all_knowledge_activities(){
        $query = $this->db->get('Knowledge_Activity');
        
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
        $query = $this->db->where('Id',$_id)->get('Knowledge_Activity');
        
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
    
    function update_knowledge_activity($_data){
        
        $data = array(
            'Knowledge_Id' => $_data->post('Knowledge_Id'),
			'Activity_Id'  => $_data->post('Activity_Id'),
        );
        
        if($this->db->where('Id',$_data->post('Id'))->update('Knowledge_Activity',$data)){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    function delete_knowledge_activity($id){
        
        if($this->db->where('Id',$id)->delete('Knowledge_Activity')){
            return TRUE;
        }else{
            return FALSE;
        }
    }
}