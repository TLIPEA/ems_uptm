<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Knowledge_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    function insert_knowledge($_data)
    {
        $data = array(
            'Order'              => $_data->post('Order'),
			'Content'            => $_data->post('Content'),
			'Scheduled_Event_Id' => $_data->post('Scheduled_Event_Id')
        );
        
        if($this->db->insert('Knowledge',$data))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    
    function get_all_knowledges()
	{
        $query = $this->db->get('Knowledge');
        
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
	
	function get_all_knowledges_by_scheduled_event($id)
	{
        $query = $this->db->where('Scheduled_Event_Id',$id)->order_by('Order','ASC')
						->get('Knowledge');
        
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
        $query = $this->db->where('Id',$_id)->get('Knowledge');
        
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
	
	function get_count_by_scheduled_event($id)
    {
        $query = $this->db->select('COUNT(*) AS Orden')->where('Scheduled_Event_Id',$id)->get('Knowledge');
        
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
    
    function update_knowledge($_data){
        
        $data = array(
            'Order'              => $_data->post('Order'),
			'Content'            => $_data->post('Content'),
			'Scheduled_Event_Id' => $_data->post('Scheduled_Event_Id')
        );
        
        if($this->db->where('Id',$_data->post('Id'))->update('Knowledge',$data)){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    /**
     * TODO: Al eliminar se debe eliminar las referencias a Knowledge_Activity primero.
     */
    function delete_knowledge($id){
        
        if($this->db->where('Id',$id)->delete('Knowledge')){
            return TRUE;
        }else{
            return FALSE;
        }
    }
}