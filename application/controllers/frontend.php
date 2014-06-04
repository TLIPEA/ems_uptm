<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include_once('home.php');

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
	
	public function sign_in($phase = 1)
	{
		$data['title'] = 'EMS UPTM::Inicio de Sesión';
		
		if($phase == 1)
		{
			$this->load->view('frontend/base/signin',$data);
		}
		else
		{
			$this->form_validation->set_rules('Name','Nombre del Participante','trim|required|xss_clean');
            $this->form_validation->set_rules('Last_Name','Apellido del Participante','trim|required|xss_clean');
            $this->form_validation->set_rules('DNI','Cédula del Participante','trim|required|is_unique[Participant.DNI]|xss_clean');
			//$this->form_validation->set_rules('City_Id','Ubicación del Participante','trim|required|xss_clean');
			$this->form_validation->set_rules('Email','Correo del Participante','trim|required|valid_email|is_unique[Participant.Email]|xss_clean');
			//$this->form_validation->set_rules('Gender','Genero del Participante','trim|required|xss_clean');
			$this->form_validation->set_rules('Username', 'Usuario'   , 'trim|required|xss_clean');
			$this->form_validation->set_rules('Password', 'Contraseña', 'trim|required|min_length[6]|matches[Password2]|xss_clean');
			
			$this->form_validation->set_message('required'     ,'%s es necesario para el Registro');
            $this->form_validation->set_message('is_unique'    ,'%s es unico, verifica este dato para Continuar');
            $this->form_validation->set_message('valid_email'  ,'El %s no posee una estructura Válida');
            $this->form_validation->set_message('matches'      ,'No coincide el campo %s');
            $this->form_validation->set_message('min_length'   ,'%s debe cumplir con una longitud minima de caracteres');
			
			if ($this->form_validation->run()==FALSE)
            {
				$this->error_view('Error en el Registro','Verificar todos los campos reportados para finiquitar el proceso');
				$this->sign_in();
			}
			else
			{
				if($this->Participant_Model->insert_participant($this->input))
				{
					$name    = $this->input->post('Name').' '.$this->input->post('Last_Name');
					$message     = "<br><br>Saludos {$name}, <br><br>";
					$message    .= "Éste es un mensaje automático para notificarte que tu registro en el Sistema de Eventos de la UPTM Kléber Ramirez<br><br>";
					$message    .= "Tu datos de acceso son:<br><br>";
					$message    .= "Usuario = {$this->input->post('Username')}<br>";
					$message    .= "Clave   = {$this->input->post('Password')}<br><br>";
					$message    .= "Debes Visitar ".site_url('frontend/verify')."/{$this->db->insert_id()}/{$this->input->post('Username')} para validar tu registro en nuestro sistema<br><br>";
					$message    .= "Para participar en cualquiera de nuestro eventos academicos debes ir a la sección de Inscripción y escoger el evento de tu agrado y realizar la serie de pasos para formalizar tu inscripción.<br><br>";
					$message    .= "Si tu no realizaste conmunicate con nosotros para solventar cualquier inconveniente.<br><br>";
					$message    .= "--<br>";
					$message    .= "Atte:<br>";
					$message    .= "UPTM Kleber Ramirez.<br>";
					
					$subject = 'Registro Exitoso en el Sistema de Eventos de la UPTM';
					if($this->send_mail($this->input->post('Email'),$name,$message,$subject))
					{
						$this->success_view('Exito en el Registro','Hemos enviado un correo con todos los datos necesarios para poder verificar tu cuenta y usar nuestro sistema');
						(new Home())->index();
					}
					else
					{
						$this->error_view('Error en el Envio de Correo','Algo va mal, al momento de realizar el envio');
						$this->sign_in();
					}
				}
				else
				{
					$this->error_view('Error en el Registro','Algo va mal, al momento de registrar los datos');
					$this->sign_in();
				}
			}
		}
	}
	
	private function log_in()
	{
		$data['title'] = 'EMS UPTM::Inicio de Sesión';
		$this->load->view('frontend/base/login',$data);
	}
	
	public function login()
	{
        $this->form_validation->set_rules('Username', 'Usuario'   , 'trim|required|xss_clean');
        $this->form_validation->set_rules('Password', 'Contraseña', 'trim|required|xss_clean|callback_check_login');
        $this->form_validation->set_message('check_login', 'Usuario o Contraseña incorrecta');
		$this->form_validation->set_message('required', '%s es requerido para entrar');
        $this->form_validation->run();
		$this->log_in();
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
		$user     =  $this->Participant_Model->check_login_participant($username);
      
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
	
	public function change_password()
	{
		$this->check_session();
	}
	
	public function update_data()
	{
		$this->check_session();
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
		$datos = array('titleError'=>$title, 'msg'=>$msg,
					   'typeError'=>$type);
        $this->load->view('backend/utility/empty',$datos);
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
	
	public function verify($code,$username)
	{
		if(!($code == 0 and $username == 0)){
            
            $data = $this->Participant_Model->check_login_participant($username);
            
            if($data == 0)
			{
				$this->error_view('Error!','Algo va mal, Estas intentando validar un registro con las credenciales erroneas');
            }
			else
			{
                if($data[0]->Status == 'Active')
				{
					$this->error_view('Proceso ya Realizado!','Algo va mal, Tu cuenta ya se encuentra activa');
                }
				else
				{
                    if($data[0]->Code == $code){
                        
                        if($this->Participant_Model->update_status(array('Id' => $data[0]->Id, 'Status' => 'Activate')))
						{
							$this->success_view('Exito!','Tu cuenta ya se encuentra activa, ahora puedes iniciar sesión');
                        }
						else
						{
							$this->error_view('Error!','Algo va mal, Estas intentando validar un registro con las credenciales erroneas');
                        }
                        
                    }
					else
					{
                        $this->error_view('Error!','Algo va mal, Estas intentando validar un registro con las credenciales erroneas');
                    }
                }
            }
            
            
        }else{
            $datos = array('titleError'=>'Error!', 'mensaje'=>'4Estas intentando validar un registro con las credenciales erroneas'.$codigo.$usuario, 'tipoError'=>1);
            
        }
        (new Home())->index();
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
	
	public function type_event($key)
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
		
		return $data[$key];
	}
}