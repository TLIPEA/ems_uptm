<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Author_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    function insert_author($_data)
    {
        $data = array(
            'Type'           => $_data->post('Type'),
			'Institution'    => $_data->post('Institution'),
			'Activity_Id'    => $_data->post('Activity_Id'),
			'Participant_Id' => $_data->post('Participant_Id')
        );
        
        if($this->db->insert('Author',$data))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    
    function get_all_authors(){
        $query = $this->db->get('Author');
        
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
        $query = $this->db->where('Id',$_id)->get('Author');
        
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
    
    function update_author($_data){
        
        $data = array(
            'Type'           => $_data->post('Type'),
			'Institution'    => $_data->post('Institution'),
			'Activity_Id'    => $_data->post('Activity_Id'),
			'Participant_Id' => $_data->post('Participant_Id')
        );
        
        if($this->db->where('Id',$_data->post('Id'))->update('Author',$data)){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    function delete_author($id){
        
        if($this->db->where('Id',$id)->delete('Author')){
            return TRUE;
        }else{
            return FALSE;
        }
    }
}