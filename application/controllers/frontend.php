<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Frontend extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('America/Caracas');
		$this->load->library('session');
		$this->load->library('encrypt');
		$this->load->library('form_validation');
	}
	
	public function index()
	{
		redirect('/home/','refresh');
	}
	
	public function sign_in()
	{
		
	}
	
	public function login()
	{
        $this->form_validation->set_rules('Username', 'Usuario'   , 'trim|required|xss_clean');
        $this->form_validation->set_rules('Password', 'Contraseña', 'trim|required|xss_clean|md5|callback_check_login');
        $this->form_validation->set_message('check_login', 'Usuario o Contraseña incorrecta');
		$this->form_validation->set_message('required', '%s es requerido para entrar');
        $this->form_validation->run();
		$this->index();
    }
	
	protected function check_session()
	{
		  if(!$this->session->userdata('public_ems_uptm'))
		  {
			   redirect('/home/','refresh');
		  }
	}
	
	function check_login($password)
    {
        $username = $this->input->post('Username');
		$user     =  $this->Participant_Model->check_login($username);
      
        if($user != 0)
		{
			if ($user[0]->Password == $this->encrypt->sha1($this->input->post('Password')))
			{
				$this->session->userdata('public_ems_uptm');
				$sess_array = array();

				$sess_array = array(
					'Username'        => $user[0]->Username,
					'Name'            => $user[0]->Name,
					'Last_Name'       => $user[0]->Last_Name,
					'Participant_Id'  => $user[0]->Id
				);
				$this->session->set_userdata('public_ems_uptm', $sess_array);
				redirect('/home/','refresh');	
			}
			else
			{
				return false;
			}
		}
		else
        {
			return false;
        }
    }
	
	public function logout()
    {
		$this->session->unset_userdata('public_ems_uptm');
		redirect('/home/', 'refresh');
    }
	
	protected function load_view( $view, $data = '', $script = '')
	{
		$this->load->view('frontend/base/header',$data);
		$this->load->view('frontend/'.$view);
		$this->load->view('frontend/base/footer');
		if($script != '')
		{
			$this->load->view('frontend/'.$script);
		}
	}
}