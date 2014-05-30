<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include('backend.php');

class User extends Backend {
	
	 public function __construct()
    {
    	parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('Participant_Model');
		$this->load->model('User_Model');
    }

	public function index()
	{
		$this->check_session();
		$data['title']      = "Usuarios";
		$data['controller'] = 'List';
		$data['rows']  = $this->User_Model->get_all_users_with_participant();
		$this->load_view('user/index',$data);
	}	

}