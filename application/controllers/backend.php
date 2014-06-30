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
		redirect('/backend/', 'refresh');
    }
	
	public function send_mail($email,$name,$message,$subject)
	{
        $this->load->library('email');
		
		$configGmail = array(
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.gmail.com',
			'smtp_port' => 465,
			'smtp_user' => 'info@sanchezsolutions.com.ve',
			'smtp_pass' => '',
			'mailtype' => 'html',
			'charset' => 'utf-8',
			'newline' => "\r\n",
		);
		
		$this->email->initialize($configGmail);
		
		$this->email->from($email, 'Contacto: '.$name);
		$this->email->to($email);
		$this->email->subject($subject);               
		$this->email->message($message);
		
		return $this->email->send();
	}
	
	protected function load_view( $view, $data = '', $script = '')
	{
		$this->load->view('backend/base/header',$data);
		$this->load->view('backend/'.$view);
		$this->load->view('backend/base/footer');
		if($script != '')
		{
			$this->load->view('backend/'.$script);
		}
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

function typeEvent($type)
{
	switch($type)
	{
		case 'Course':
			return 'Curso';
			break;
		case 'Practical Course':
			return 'Taller';
			break;
		case 'Meeting':
			return 'Encuentro';
			break;
		case 'Seminary':
			return 'Seminario';
			break;
		case 'Conversational':
			return 'Conversatorio';
			break;
		case 'Conference':
			return 'Jornada';
			break;
		case 'Congress':
			return 'Congreso';
			break;
		case 'Diplomaed':
			return 'Diplomado';
			break;
		default:
			return '';
	}
}

function translate($key)
{
	$data['Course']                          = 'Curso';
	$data['Practical Course']                = 'Taller';
	$data['Meeting']                         = 'Encuentro';
	$data['Seminary']                        = 'Seminario';
	$data['Conversational']                  = 'Conversatorio';
	$data['Conference']                      = 'Jornada';
	$data['Congress']                        = 'Congreso';
	$data['Diplomaed']                       = 'Diplomado';
	$data['Student']                         = 'Estudiantes';
	$data['Speaker']                         = 'Ponentes';
	$data['Professionals & General Public']  = 'Profesionales y Publico en General';
	$data['Proposal']                        = 'Propuesta';
	$data['Accepted']                        = 'Aceptada';
	$data['Amend']                           = 'Con Correcciones';
	$data['Rejected']                        = 'No Aceptada';
	$data['Oral Speech']                     = 'Ponencia';
	$data['Cartel']                          = 'Cartel';
	$data['Primary']                         = 'Autor';
	$data['Secondary']                       = 'CoAuthor';
	$data['Paid']                            = 'Pagado';
	$data['Cancel']                          = 'Cancelado';
	$data['Free']                            = 'Gratis';
	$data['Without Payment']                 = 'En Proceso';
	$data['Exempt']                          = 'Exonerado';
	$data['Collaborator']                    = 'Colaborador';
	$data['Organizer']                       = 'Organizador';
	$data['Facilitator']                     = 'Facilitador';
	$data['Validated']                       = 'Validado';
	$data['No Validated']                    = 'Sin Validar';
	$data['Invalid']                         = 'Invalido';
	$data['Off']                             = 'Desactivado';
	
	return $data[$key];
}