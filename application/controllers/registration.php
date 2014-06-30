<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include('backend.php');

class Registration extends Backend {
	
	public function __construct()
    {
    	parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('Event_Model');
		$this->load->model('Scheduled_Event_Model');
		$this->load->model('Participant_Model');
		$this->load->model('Registration_Model');
		$this->load->model('Payment_Model');
		$this->load->model('Sale_Model');
    }
	
	public function index($id = '')
	{
		$this->check_session();
		$data['title']      = "Inscritos";
		$data['controller'] = 'List';
		if($id == '')
		{
			$data['rows']  = $this->Registration_Model->get_all_registrations_with_participant();
		}
		else
		{
			$data['event'] = $this->Scheduled_Event_Model->get_by_id($id);
			if(!($data['event']!=0))
			{
				$this->error_view('Error','Oh oh. Algo malo ha pasado con la carga de la data de los Inscritos del Evento');
				$this->index();
			}
			$data['rows']  = $this->Registration_Model->get_all_registrations_with_participant_by_scheduled_event($id);
		}
		
		$this->load_view('participant/index',$data);
	}
	
	public function view($id = '')
	{
		$this->check_session();
		$data['title']      = "Inscritos";
		$data['controller'] = 'View_Registration';
		if($id == '')
		{
			$this->error_view('Error','Oh oh. No se puede acceder a esas inscripciones');
			$this->index();
		}
		else
		{
			$data['registration'] = $this->Registration_Model->get_registration_with_cost_by_id($id);
			if(!($data['registration']!=0))
			{
				$this->error_view('Error','Oh oh. Algo malo ha pasado con la carga de la data de los Inscritos del Evento');
				$this->index();
			}
			$data['payments']     = $this->Payment_Model->get_all_payments_by_registration($data['registration'][0]->Id);
			$this->load_view('participant/view',$data);
		}
	}
	
	public function search($phase = 1)
	{
		$this->check_session();
		$data['controller'] = 'Search';
		
		if ($phase == 1)
		{
			$data['events'] = $this->Scheduled_Event_Model->get_all_scheduled_events_actives();
			$this->load_view('participant/search',$data);
		}
		else
		{
			$this->form_validation->set_rules('DNI', 'Cédula', 'trim|required|xss_clean');
			$this->form_validation->set_rules('Scheduled_Event_Id', 'Evento', 'trim|required|xss_clean');
			
			$this->form_validation->set_message('required', '%s es requerido');
			
			if ($this->form_validation->run() == FALSE)
			{
				$this->error_view('Error','Debes Seleccionar un evento valido e Introducir una Cedula Valida');
				$this->search(1);
			}
			else
			{
				$data['event'] = $this->Scheduled_Event_Model->get_by_id($this->input->post('Scheduled_Event_Id'));
				if(!($data['event']!=0))
				{
					$this->error_view('Error','Debes Seleccionar un evento valido');
					$this->search();
				}
				else
				{
					$participant = $this -> Participant_Model -> get_by_dni($this->input->post('DNI'));
					if ($participant != 0)
					{
						redirect('/registration/new_registration/'.$participant[0]->Id.'/'.$this->input->post('DNI').'/'.$this->input->post('Scheduled_Event_Id').'/1','refresh');
					}
					else
					{
						redirect('/registration/new_registration/0/'.$this->input->post('DNI').'/'.$this->input->post('Scheduled_Event_Id').'/1','refresh');
					}
				}
			}
		}
	}
	
	public function new_registration($id = '0', $dni = '',$Scheduled_Event_Id = '',$phase = 1)
	{
		$this->check_session();
		$data['controller']  = 'New_Registration';
		$data['participant'] = $this->Participant_Model->get_by_dni($dni);
		
		if($Scheduled_Event_Id == '')
		{
			$this->error_view('Error','Debes Seleccionar un evento valido');
			$this->search();
		}
		
		$data['event'] = $this->Scheduled_Event_Model->get_by_id($Scheduled_Event_Id);
		if(!($data['event']!=0))
		{
			$this->error_view('Error','Debes Seleccionar un evento valido');
			$this->search();
		}
		
		$data['costs'] = $this->Sale_Model->get_sale_active_with_cost_by_scheduled_event($Scheduled_Event_Id);
		
		if ($phase == 1)
		{
			if($id == 0)
			{
				$data['dni'] = $dni;
				$this->load_view('participant/new',$data);
			}
			else
			{
				$this->load_view('participant/registration',$data);
			}
		}
		else
		{
			if($id == 0)
			{
				$this->form_validation->set_rules('Name','Nombre del Participante','trim|required|xss_clean');
				$this->form_validation->set_rules('Last_Name','Apellido del Participante','trim|required|xss_clean');
				$this->form_validation->set_rules('DNI','Cédula del Participante','trim|required|is_unique[Participant.DNI]|xss_clean');
				//$this->form_validation->set_rules('City_Id','Ubicación del Participante','trim|required|xss_clean');
				$this->form_validation->set_rules('Email','Correo del Participante','trim|required|valid_email|is_unique[Participant.Email]|xss_clean');
				//$this->form_validation->set_rules('Gender','Genero del Participante','trim|required|xss_clean');
				$this->form_validation->set_rules('Username', 'Usuario'   , 'trim|required|xss_clean');
				$this->form_validation->set_rules('Password', 'Contraseña', 'trim|required|min_length[6]|matches[Password2]|xss_clean');
				$this->form_validation->set_rules('Scheduled_Event_Id','Seleccionar Evento','trim|required|xss_clean');
				$this->form_validation->set_rules('Cost_Id'           ,'Seleccionar Categoria','trim|required|xss_clean');
				
				$this->form_validation->set_message('required'     ,'%s es necesario para el Registro');
				$this->form_validation->set_message('is_unique'    ,'%s es unico, verifica este dato para Continuar');
				$this->form_validation->set_message('valid_email'  ,'El %s no posee una estructura Válida');
				$this->form_validation->set_message('matches'      ,'No coincide el campo %s');
				$this->form_validation->set_message('min_length'   ,'%s debe cumplir con una longitud minima de caracteres');
				
				if ($this->form_validation->run()==FALSE)
				{
					$this->error_view('Error al Registrar el Participante','Algo va mal, revisa los datos señalados e intentalo de nuevo, si el error persiste comunicate con soporte');
					$this->new_registration($id,$dni,$Scheduled_Event_Id,1);
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
						//if(!$this->send_mail($this->input->post('Email'),$name,$message,$subject))
						//{
						//	$this->error_view('Error en el Envio de Correo','Algo va mal, al momento de realizar el envio, pero el usuario si se registro pero no se completo la inscripción');
						//	$this->index($this->input->post('Scheduled_Event_Id'));
						//}
						//else
						//{
							$_POST['Participant_Id'] = $this->db->insert_id();
							if($this->Registration_Model->insert_registration($this->input))
							{
								$this->success_view('Exito al Realizar la Inscripción','Debes revisar tu correo electronico para Verificar tu cuenta y posterior podrás administrar tu evento, ver detalles o realizar pagos a traves de la sección Mis Eventos');
								$this->index($this->input->post('Scheduled_Event_Id'));
							}
							else{
								$this->error_view('Error al Registrar la Inscripción','Algo va mal, intentalo de nuevo, si el error persiste comunicate con soporte');
								$this->new_registration($id,$dni,$Scheduled_Event_Id,1);
							}
						//}
					}
					else
					{
						$this->error_view('Error en el Registro','Algo va mal, al momento de registrar los datos');
						$this->new_registration($id,$dni,$Scheduled_Event_Id,1);
					}
				}
			}
			else
			{
				$this->form_validation->set_rules('Scheduled_Event_Id'  , 'Evento', 'trim|required|xss_clean');
				$this->form_validation->set_rules('Cost_Id', 'Categoria'          , 'trim|required|xss_clean');
				$this->form_validation->set_rules('Participant_Id', 'Participante', 'trim|required|xss_clean');
				
				$this->form_validation->set_message('required', '%s es requerido');
				
				if ($this->form_validation->run() == FALSE)
				{
					$this->error_view('Error','Debes Verificar los Datos');
					$this->new_registration($id,$dni,$Scheduled_Event_Id,1);
				}
				else
				{
					if($this->input->post('Cost_Id')!=0)
					{
						if($this->Registration_Model->insert_registration($this->input))
						{
							$this->success_view('Exito al Realizar la Inscripción','El usuario ya puede administrar su evento');
							$this->index();
						}
						else{
							$this->error_view('Error al Registrar la Inscripción','Algo va mal, intentalo de nuevo, si el error persiste comunicate con soporte');
							$this->new_registration($id,$dni,$Scheduled_Event_Id,1);
						}
					}
					else
					{
						$this->error_view('Error','Debes Verificar los Datos');
						$this->new_registration($id,$dni,$Scheduled_Event_Id,1);
					}
					
				}
			}
		}
	}
	
	public function delete($id)
	{
		$this->check_session();
		if($this->Registration_Model->delete_registration($id))
		{
			$this->success_view('Éxito','La Inscripción se ha eliminado correctamente');
		}
		else
		{
			$this->error_view('Error','Oh oh. Algo malo ha pasado con la eliminación de la Inscripción');
		}
		$this->index();
	}
}