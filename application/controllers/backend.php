<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Backend extends CI_Controller {
	
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
		if($this->session->userdata('manager_ems_uptm'))
		{
			
			$head['controller'] = 'Home';
			
            $this->load->view('backend/base/header',$head);
			$this->load->view('backend/base/index');
			$this->load->view('backend/base/footer');
        }
		else
		{
            $this->load->library('form_validation');
            $this->load->view('backend/login/index');
        }
	}
	
	public function login()
	{
        $this->form_validation->set_rules('Username', 'Usuario', 'trim|required|xss_clean');
        $this->form_validation->set_rules('Password', 'Contraseña', 'trim|required|xss_clean|md5|callback_check_login');
        $this->form_validation->set_message('check_login', 'Usuario o Contraseña incorrecta');
		$this->form_validation->set_message('required', '%s es requerido para entrar');
        $this->form_validation->run();
		$this->index();
    }

	
	protected function check_session()
	{
		if(!$this->session->userdata('manager_ems_uptm'))
		{
            redirect('/backend/','refresh');
        }
	}
	
	function check_login($password)
    {
        $username = $this->input->post('Username');
		$user =  $this->Participant_Model->check_login($username);
      
	  
		//echo $this->encrypt->sha1($this->input->post('Password'));
        if($user != 0)
		{
			
			if ($user[0]->Password == $this->encrypt->sha1($this->input->post('Password')))
			{
				$this->session->userdata('manager_ems_uptm');
				$sess_array = array();

				$sess_array = array(
					'Username'        => $user[0]->Username,
					'Name'            => $user[0]->Name,
					'Last_Name'       => $user[0]->Last_Name,
					'Participant_Id'  => $user[0]->Id
				);
				$this->session->set_userdata('manager_ems_uptm', $sess_array);
				redirect('/backend/','refresh');	
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
		$this->session->unset_userdata('manager_ems_uptm');
		session_destroy();
		redirect('/backend/', 'refresh');
    }
	
	protected function error_view($titleError,$msg)
	{
		$this->message_view($titleError,$msg,2);
	}
	
	protected function success_view($titleSuccess,$msg)
	{
		$this->message_view($titleSuccess,$msg,1);
	}
	
	private function message_view($title,$msg,$type)
	{
		$datos = array('titleError'=>$title, 'msg'=>$msg,'typeError'=>$type);
        $this->load->view('backend/utility/empty',$datos);
	}

}