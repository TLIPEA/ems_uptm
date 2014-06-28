<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include_once('home.php');

class Event extends Frontend {
	
	public function __construct()
	{
    	parent::__construct();
		$this->load->model('Scheduled_Event_Model');
		$this->load->model('Knowledge_Model');
		$this->load->model('Sale_Model');
		$this->load->model('Registration_Model');
		$this->load->model('Activity_Model');
		$this->load->model('Knowledge_Model');
		$this->load->model('Knowledge_Activity_Model');
		$this->load->model('Author_Model');
		$this->load->model('Payment_Model');
		$this->load->model('Account_Model');
	}
	
	public function index()
	{
		redirect('/home/','refresh');
	}
	
	public function view($id = '')
	{
		if($id == '')
		{
			$this->error_view('Error al Cargar Evento','Algo va mal, intentalo de nuevo, si el error persiste comunicate con soporte');
			(new Home())->index();
		}
		else
		{
			$data['event'] = $this->Scheduled_Event_Model->get_by_id($id);
			
			if($data['event']!=0)
			{
				$data['event']      = $data['event'][0];
				$data['knowledges'] = $this->Knowledge_Model->get_all_knowledges_by_scheduled_event($data['event']->Id);
				$data['costs_raw']      = $this->Sale_Model->get_all_sales_with_cost_by_scheduled_event($data['event']->Id);
				if($data['costs_raw']!=0)
				{
					foreach($data['costs_raw'] as $cost)
					{
						$cost->Type      = $this->type_event($cost->Type);
						$data['costs'][] = $cost;
					}
				}
				$data['title']      = $data['event']->Name;
				$data['type']       = $this->type_event($data['event']->Type);
				
				if($this->session->userdata('public_ems_uptm'))
				{
					$data['name'] = $this->session->userdata('public_ems_uptm')['Name']
								  .' '.$this->session->userdata('public_ems_uptm')['Last_Name'];
					$this->load_view('event/view',$data);
				}
				else
				{
					$this->load->view('frontend/base/header_publico',$data);
					$this->load->view('frontend/event/view');
					$this->load->view('frontend/base/footer');
				}
			}
			else
			{
				$this->view();
			}
		}
	}
	
	public function registration($phase = 1,$id = '')
	{
		$data['title'] = 'Inscripción';
		$data['type']  = 'Menu';
		
		if($phase == 1)
		{
			if($id=='')
			{
				$this->check_session();
				$data['name']   = $this->session->userdata('public_ems_uptm')['Name']
								  .' '.$this->session->userdata('public_ems_uptm')['Last_Name'];
				$data['events'] = $this->Scheduled_Event_Model->get_all_scheduled_events_actives();
				$this->load_view('event/registration',$data,'event/script_registration');
			}
			else
			{
				$data['event'] = $this->Scheduled_Event_Model->get_by_id($id);
				if(!$data['event']!=0){
					$this->registration();
				}
				$data['event'] = $data['event'][0];
				$data['title'] .= ' en '.$data['event']->Name;
				
				$data['costs_raw'] = $this->Sale_Model->get_sale_active_with_cost_by_scheduled_event($id);
				if($data['costs_raw']!=0)
				{
					foreach($data['costs_raw'] as $cost)
					{
						$cost->Type      = $this->type_event($cost->Type);
						$data['costs'][] = $cost;
					}
				}
				
				if($this->session->userdata('public_ems_uptm'))
				{
					$data['name'] = $this->session->userdata('public_ems_uptm')['Name']
								  .' '.$this->session->userdata('public_ems_uptm')['Last_Name'];
					$this->load_view('event/registration',$data,'event/script_registration');
				}
				else
				{
					$this->load->view('frontend/base/header_publico',$data);
					$this->load->view('frontend/event/registration');
					$this->load->view('frontend/base/footer');
				}
			}
		}
		if($phase == 2)
		{
			$this->check_session();
			$this->form_validation->set_rules('Scheduled_Event_Id','Seleccionar Evento','trim|required|xss_clean');
			$this->form_validation->set_rules('Cost_Id'           ,'Seleccionar Categoria','trim|required|xss_clean');
			$this->form_validation->set_rules('Participant_Id'    ,'Seleccionar Categoria','trim|required|xss_clean');
			
			$this->form_validation->set_message('required', '%s es necesario para realizar la Inscripcion');
			
			if ($this->form_validation->run()==FALSE)
			{
				$this->error_view('Error al Realizar la Inscripción','Algo va mal, intentalo de nuevo, si el error persiste comunicate con soporte');
				$this->registration(1,$id);
			}
			else
			{
				if($this->Registration_Model->insert_registration($this->input))
				{
					$this->success_view('Exito al Realizar la Inscripción','Puedes administrar tu evento, ver detalles o realizar pagos a traves de <a href="'.site_url('event/my_list').'">Mis Eventos</a>');
					(new Home())->index();
				}
				else{
					$this->error_view('Error al Registrar la Inscripción','Algo va mal, intentalo de nuevo, si el error persiste comunicate con soporte');
					$this->registration(1,$id);
				}
			}
		}
		if($phase == 3)
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
				$this->registration(1,$id);
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
					if(!$this->send_mail($this->input->post('Email'),$name,$message,$subject))
					{
						$this->error_view('Error en el Envio de Correo','Algo va mal, al momento de realizar el envio');
					}
					else
					{
						$_POST['Participant_Id'] = $this->db->insert_id();
						if($this->Registration_Model->insert_registration($this->input))
						{
							$this->success_view('Exito al Realizar la Inscripción','Debes revisar tu correo electronico para Verificar tu cuenta y posterior podrás administrar tu evento, ver detalles o realizar pagos a traves de la sección Mis Eventos');
							(new Home())->index();
						}
						else{
							$this->error_view('Error al Registrar la Inscripción','Algo va mal, intentalo de nuevo, si el error persiste comunicate con soporte');
							$this->registration(1,$id);
						}
					}
				}
				else
				{
					$this->error_view('Error en el Registro','Algo va mal, al momento de registrar los datos');
					$this->registration(1,$id);
				}
			}
		}
	}
	
	public function my_events()
	{
		$this->check_session();
		$data['title'] = 'Mis Eventos';
		$data['type']  = 'Menu';
		$data['name']  = $this->session->userdata('public_ems_uptm')['Name']
								  .' '.$this->session->userdata('public_ems_uptm')['Last_Name'];
		
		$data['events_raw'] = $this->Registration_Model->get_all_registrations_by_participant($this->session->userdata('public_ems_uptm')['Participant_Id']);
		
			if($data['events_raw']!=0)
			{
				foreach($data['events_raw'] as $event)
				{
					$event->Status      = $this->type_event($event->Status);
					$data['events'][] = $event;
				}
			}
		
		$this->load_view('event/index',$data);
	}
	
	public function admin($id = '')
	{
		$this->check_session();
		if($id=='')
		{
			redirect('event/my_events','refresh');
		}
		else
		{
			$data['event'] = $this->Registration_Model->get_registration_with_cost_by_participant($id,$this->session->userdata('public_ems_uptm')['Participant_Id']);
			
			if($data['event']!=0)
			{
				$data['event']            = $data['event'][0];
				$data['event']->Cost_Type = $this->type_event($data['event']->Cost_Type);
				
				$data['knowledges']       = $this->Knowledge_Model->get_all_knowledges_by_scheduled_event($data['event']->Scheduled_Event_Id);
				
				$data['payments_raw']     = $this->Payment_Model->get_all_payments_by_registration($data['event']->Id);
				if($data['payments_raw']!=0)
				{
					foreach($data['payments_raw'] as $payment)
					{
						$payment->Status    = $this->type_event($payment->Status);
						$data['payments'][] = $payment;
					}
				}
				else
				{
					$data['payments'] = 0;
				}
				
				$data['title']            = $data['event']->Name;
				$data['type']             = $this->type_event($data['event']->Type);
				
				$data['name']             = $this->session->userdata('public_ems_uptm')['Name']
										.' '.$this->session->userdata('public_ems_uptm')['Last_Name'];
				$this->load_view('event/admin',$data);
			}
			else
			{
				$this->admin();
			}
		}
		
	}
	
	public function pay($phase = 1, $id)
	{
		$data['title'] = 'Registrar Pago';
		$data['type']  = 'Menu';
		$data['name']  = $this->session->userdata('public_ems_uptm')['Name']
								  .' '.$this->session->userdata('public_ems_uptm')['Last_Name'];
		$this->check_session();
		
		if($phase == 1)
		{
			
			$data['event']    = $this->Registration_Model->get_registration_with_cost_by_participant($id,$this->session->userdata('public_ems_uptm')['Participant_Id']);
			
			if(!($data['event']!=0))
			{
				$this->error_view('No puedes Acceder al Área de Pago','Debiado a que el evento no existe');
				$this->admin($id);
			}
			
			$data['accounts'] = $this->Account_Model->get_by_scheduled_event_id($data['event'][0]->Scheduled_Event_Id);
			
			if(!($data['accounts']!=0))
			{
				$this->error_view('No puedes Acceder al Área de Pago','Debiado a que este evento no cuenta con una cuenta en la cual registrar pagos');
				$this->admin($id);
			}
			
			if($data['event'][0]->Status == 'Paid' OR $data['event'][0]->Status == 'Free' OR $data['event'][0]->Status == 'Exempt')
			{
				$this->error_view('No puedes Acceder al Área de Pago','Inferimos que ya pagaste o no debes realizar ningun pago');
				$this->admin($id);
			}
			
			$this->load_view('event/pay',$data,'event/script_pay');
		}
		if($phase == 2)
		{
			$this->form_validation->set_rules('Account_Id','Seleccionar Evento','trim|required|xss_clean');
			$this->form_validation->set_rules('Payment_Date','Seleccionar Evento','trim|required|xss_clean');
			$this->form_validation->set_rules('Voucher_Number','Seleccionar Evento','trim|required|xss_clean');
			$this->form_validation->set_rules('Amount','Seleccionar Evento','trim|required|xss_clean');
			
			$this->form_validation->set_message('required', '%s es necesario para realizar la Postulación');
			
			if ($this->form_validation->run()==FALSE)
			{
				$this->error_view('Error al Realizar el Pago','Algo va mal, intentalo de nuevo, si el error persiste comunicate con soporte');
				$this->pay(1,$id);
			}
			else
			{
				if($this->Payment_Model->insert_payment($this->input))
				{
					$this->success_view('Exito al Registrar','Tu pago sera aprobado en las proximas 48 horas');
				}
				else
				{
					$this->error_view('Error al Registrar el Pago','Algo va mal, intentalo de nuevo, si el error persiste comunicate con soporte');
				}
				$this->admin($id);
			}
		}
		if($phase == 3)
		{
			$data['accounts']        = $this->Account_Model->get_by_scheduled_event_id($id);
			$data['id']              = $id;
			$data['Registration_Id'] = $this->Registration_Model->get_registration_id_by_participant($id,$this->session->userdata('public_ems_uptm')['Participant_Id'])[0]->Id;
			$this->load_view('event/pay',$data,'event/script_pay');
		}
	}
	
	public function postulate($phase = 1,$id = '',$_data = '')
	{
		$data['title'] = 'Postularse';
		$data['type']  = 'Menu';
		
		if($phase == 1)
		{
			if($id=='')
			{
				$this->check_session();
				$data['name']   = $this->session->userdata('public_ems_uptm')['Name']
								  .' '.$this->session->userdata('public_ems_uptm')['Last_Name'];
				$data['events'] = $this->Scheduled_Event_Model->get_all_scheduled_events_actives_by_type_with_applications_change();
				$this->load_view('event/postulate',$data,'event/script_postulate');
			}
			else
			{
				$data['event'] = $this->Scheduled_Event_Model->get_by_id($id);
				if(!$data['event']!=0){
					$this->registration();
				}
				$data['event'] = $data['event'][0];
				$data['title'] .= ' en '.$data['event']->Name;
				
				$data['costs_raw'] = $this->Sale_Model->get_sale_active_with_cost_by_scheduled_event($id);
				if($data['costs_raw']!=0)
				{
					foreach($data['costs_raw'] as $cost)
					{
						$cost->Type      = $this->type_event($cost->Type);
						$data['costs'][] = $cost;
					}
				}
				
				$data['knowledges'] = $this->Knowledge_Model->get_all_knowledges_by_scheduled_event($id);
				
				if($this->session->userdata('public_ems_uptm'))
				{
					$data['name'] = $this->session->userdata('public_ems_uptm')['Name']
								  .' '.$this->session->userdata('public_ems_uptm')['Last_Name'];
					$this->load_view('event/postulate',$data,'event/script_postulate');
				}
				else
				{
					$this->load->view('frontend/base/header_publico',$data);
					$this->load->view('frontend/event/postulate');
					$this->load->view('frontend/base/footer');
					$this->load->view('frontend/event/script_postulate');
				}
			}
		}
		if($phase == 2)
		{
			$this->check_session();
			$this->form_validation->set_rules('Scheduled_Event_Id','Seleccionar Evento','trim|required|xss_clean');
			$this->form_validation->set_rules('Cost_Id'           ,'Seleccionar Categoria','trim|required|xss_clean');
			$this->form_validation->set_rules('Participant_Id'    ,'Seleccionar Participante','trim|required|xss_clean');
			$this->form_validation->set_rules('Title'             ,'Titulo de la Actividad','trim|required|xss_clean');
			$this->form_validation->set_rules('Mode'              ,'Tipo de Actividad','trim|required|xss_clean');
			$this->form_validation->set_rules('Keywords'          ,'Palabras Claves','trim|required|xss_clean');
			$this->form_validation->set_rules('Summary_Words'     ,'Resumen','trim|required|xss_clean');
			$this->form_validation->set_rules('Participation_Type','Tipo de Participación','trim|required|xss_clean');
			$this->form_validation->set_rules('Institution'       ,'Institución','trim|required|xss_clean');
			
			
			$this->form_validation->set_message('required', '%s es necesario para realizar la Postulación');
			
			if ($this->form_validation->run()==FALSE)
			{
				$this->error_view('Error al Realizar la Postulación','Algo va mal, intentalo de nuevo, si el error persiste comunicate con soporte');
				$this->postulate(1,$id);
			}
			else
			{
				if($this->Registration_Model->insert_registration_facilitator($this->input))
				{
					if($this->Activity_Model->insert_activity($this->input))
					{
						$_POST['Activity_Id'] = $this->db->insert_id();
						
						if($this->Knowledge_Activity_Model->insert_knowledge_activity($this->input))
						{
							$_POST['Type']        = 'Primary';
							if($this->Author_Model->insert_author($this->input))
							{
								$this->success_view('Solo falta un paso para Completar tu Postulación','Ahora debes llenar los datos de los CoAutores');
								$this->postulate(4,'',$this->input->post());
							}
							else
							{
								$this->error_view('Error al Registrar el Autor','Algo va mal, intentalo de nuevo, si el error persiste comunicate con soporte');
								$this->postulate(1,$id);
							}
						}
						else
						{
							$this->error_view('Error al Asociar el Área del Saber','Algo va mal, intentalo de nuevo, si el error persiste comunicate con soporte');
								$this->postulate(1,$id);
						}
					}
					else
					{
						$this->error_view('Error al Registrar la Actividad','Algo va mal, intentalo de nuevo, si el error persiste comunicate con soporte');
						$this->postulate(1,$id);
					}
				}
				else
				{
					$this->error_view('Error al Registrar la Postulación','Algo va mal, intentalo de nuevo, si el error persiste comunicate con soporte');
					$this->postulate(1,$id);
				}
			}
		}
		if($phase == 3)
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
			
			$this->form_validation->set_rules('Title'             ,'Titulo de la Actividad','trim|required|xss_clean');
			$this->form_validation->set_rules('Mode'              ,'Tipo de Actividad','trim|required|xss_clean');
			$this->form_validation->set_rules('Keywords'          ,'Palabras Claves','trim|required|xss_clean');
			$this->form_validation->set_rules('Summary_Words'     ,'Resumen','trim|required|xss_clean');
			$this->form_validation->set_rules('Participation_Type','Tipo de Participación','trim|required|xss_clean');
			$this->form_validation->set_rules('Institution'       ,'Institución','trim|required|xss_clean');
			
			$this->form_validation->set_message('required'     ,'%s es necesario para el Registro');
            $this->form_validation->set_message('is_unique'    ,'%s es unico, verifica este dato para Continuar');
            $this->form_validation->set_message('valid_email'  ,'El %s no posee una estructura Válida');
            $this->form_validation->set_message('matches'      ,'No coincide el campo %s');
            $this->form_validation->set_message('min_length'   ,'%s debe cumplir con una longitud minima de caracteres');
			
			if ($this->form_validation->run()==FALSE)
			{
				$this->error_view('Error al Registrar el Participante','Algo va mal, revisa los datos señalados e intentalo de nuevo, si el error persiste comunicate con soporte');
				$this->registration(1,$id);
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
					if(!$this->send_mail($this->input->post('Email'),$name,$message,$subject))
					{
						$this->error_view('Error en el Envio de Correo','Algo va mal, al momento de realizar el envio');
					}
					else
					{
						$_POST['Participant_Id'] = $this->db->insert_id();
						if($this->Registration_Model->insert_registration_facilitator($this->input))
						{
							if($this->Activity_Model->insert_activity($this->input))
							{
								$_POST['Activity_Id'] = $this->db->insert_id();
								
								if($this->Knowledge_Activity_Model->insert_knowledge_activity($this->input))
								{
									$_POST['Type']        = 'Primary';
									if($this->Author_Model->insert_author($this->input))
									{
										$this->success_view('Solo faltan 2 Pasos para Completar tu Postulación','Debes llenar los datos de los CoAutores, ingresarlos y visitar tu correo electronico para activar la cuenta que te hemos creado en nuestro sistema');
										$this->postulate(4,'',$this->input->post());
									}
									else
									{
										$this->error_view('Error al Registrar el Autor','Algo va mal, intentalo de nuevo, si el error persiste comunicate con soporte');
										$this->postulate(1,$id);
									}
								}
								else
								{
									$this->error_view('Error al Asociar el Área del Saber','Algo va mal, intentalo de nuevo, si el error persiste comunicate con soporte');
										$this->postulate(1,$id);
								}
							}
							else
							{
								$this->error_view('Error al Registrar la Actividad','Algo va mal, intentalo de nuevo, si el error persiste comunicate con soporte');
								$this->postulate(1,$id);
							}
						}
						else
						{
							$this->error_view('Error al Registrar la Postulación','Algo va mal, intentalo de nuevo, si el error persiste comunicate con soporte');
							$this->postulate(1,$id);
						}
					}
				}
				else
				{
					$this->error_view('Error en el Registro','Algo va mal, al momento de registrar los datos');
					$this->registration(1,$id);
				}
			}
		}
		if($phase == 4)
		{
			if(@count($_data['Author']) != 0)
			{
				foreach($_data['Author'] as $author)
				{
					$data['authors'][] = $this->Participant_Model->get_by_dni($author);
				}
				
				$data['authors_backup'] = $_data['Author'];
				$data['Activity_Id']    = $_data['Activity_Id'];
				if($this->session->userdata('public_ems_uptm'))
				{
					$data['name']   = $this->session->userdata('public_ems_uptm')['Name']
									.' '.$this->session->userdata('public_ems_uptm')['Last_Name'];
					$this->load_view('event/authors',$data);
				}
				else
				{
					$this->load->view('frontend/base/header_publico',$data);
					$this->load->view('frontend/event/authors');
					$this->load->view('frontend/base/footer');
				}
				
			}
			else
			{
				$this->success_view('Exito al Postularse','Puedes visualizar tus postulaciones por <a href="'.site_url('event/applications').'">aqui</a>, ademas puedes visualizar tu inscripción y realizar pagos a traves de <a href="'.site_url('event/my_list').'">Mis Eventos</a>');
				(new Home())->index();
			}
		}
		if($phase == 5)
		{
			$this->form_validation->set_rules('DNI[]','Documento de Identificación','trim|required|xss_clean');
			$this->form_validation->set_rules('Name[]','Nombre del CoAutor','trim|required|xss_clean');
			$this->form_validation->set_rules('Last_Name[]','Apellido del CoAutor','trim|required|xss_clean');
			$this->form_validation->set_rules('Email[]','Correo del CoAutor','trim|required|xss_clean');
			$this->form_validation->set_rules('Institution[]','Institución del CoAutor','trim|required|xss_clean');
			$this->form_validation->set_rules('Activity_Id','Seleccionar la Actividad','trim|required|xss_clean');
			
			$this->form_validation->set_message('required', '%s es necesario para realizar la Postulación');
			
			if ($this->form_validation->run()==FALSE)
			{
				$this->error_view('Error al Realizar el Registro de los CoAutores','Algo va mal, intentalo de nuevo, desde la sección <a href="'.site_url('event/applications').'">Mis Postulaciones</a>');
			}
			else
			{
				$count = 0;
				foreach($this->input->post('Id') as $coauthor)
				{
					if($coauthor==0)
					{
						$data = array(
							'DNI'           => $this->input->post('DNI')[$count],
							'Name'          => $this->input->post('Name')[$count],
							'Last_Name'     => $this->input->post('Last_Name')[$count],
							'Email'         => $this->input->post('Email')[$count],
						);
						
						if(!$this->Participant_Model->insert_participant_coauthor($data))
						{
							$this->error_view('Error al Realizar el Registro de los Datos CoAutores','Algo va mal, intentalo de nuevo, desde la sección <a href="'.site_url('event/applications').'">Mis Postulaciones</a>');
						}
						else
						{
							$_POST['Id'][$count] = $this->db->insert_id();
						}
					}
					$count++;
				}
				
				$_POST['Type'] = 'Secondary';
				
				if(!$this->Author_Model->insert_coauthors($this->input))
				{
					$this->error_view('Error al Realizar el Registro de los CoAutores','Algo va mal, intentalo de nuevo, desde la sección <a href="'.site_url('event/applications').'">Mis Postulaciones</a>');
				}
				else
				{
					$this->success_view('Exito al Postularse','Puedes visualizar tus postulaciones por <a href="'.site_url('event/applications').'">aqui</a>, ademas puedes visualizar tu inscripción y realizar pagos a traves de <a href="'.site_url('event/my_list').'">Mis Eventos</a>');
				}
			}
			(new Home())->index();
		}
	}
	
	public function applications($id = '')
	{
		if($id=='')
		{
			$this->check_session();
			$data['type']  = 'Menu';
			$data['title'] = 'Mis Postulaciones';
			
			$data['activitys_raw']  = $this->Activity_Model->get_all_activities_by_author($this->session->userdata('public_ems_uptm')['Participant_Id']);
			
			if($data['activitys_raw']!=0)
			{
				foreach($data['activitys_raw'] as $activity)
				{
					$activity->Mode      = $this->type_event($activity->Mode);
					$activity->Status    = $this->type_event($activity->Status);
					$activity->Type      = $this->type_event($activity->Type);
					$data['activitys'][] = $activity;
				}
			}
			
			$data['name'] = $this->session->userdata('public_ems_uptm')['Name']
							  .' '.$this->session->userdata('public_ems_uptm')['Last_Name'];
			$this->load_view('event/applications',$data,'event/script_applications');
		}
		else
		{
			$data['event'] = $this->Scheduled_Event_Model->get_by_id($id);
			if(!$data['event']!=0){
				$this->applications();
			}
			$data['event']      = $data['event'][0];
			$data['title']      = 'Postulaciones en '.$data['event']->Name;
			$data['type']       = $this->type_event($data['event']->Type);
			$data['activitys_raw']  = $this->Activity_Model->get_all_activities_by_scheduled_event($id);
			
			if($data['activitys_raw']!=0)
			{
				foreach($data['activitys_raw'] as $activity)
				{
					$activity->Mode      = $this->type_event($activity->Mode);
					$activity->Status    = $this->type_event($activity->Status);
					$data['activitys'][] = $activity;
				}
			}
			
			if($this->session->userdata('public_ems_uptm'))
			{
				$data['name'] = $this->session->userdata('public_ems_uptm')['Name']
							  .' '.$this->session->userdata('public_ems_uptm')['Last_Name'];
				$this->load_view('event/applications',$data,'event/script_applications');
			}
			else
			{
				$this->load->view('frontend/base/header_publico',$data);
				$this->load->view('frontend/event/applications');
				$this->load->view('frontend/base/footer');
				$this->load->view('frontend/event/script_applications');
			}
		}
	}
	
	public function remove_registration($_id)
	{
		if($this->Registration_Model->delete_registration($_id))
		{
			$this->success_view('Exito al Eliminar Inscripción','Solo puedes realizar esta operación si no haz realizado ningun pago');
		}
		else
		{
			$this->error_view('Error al Eliminar Inscripción','Algo va mal, intentalo de nuevo.');
		}
		$this->my_events();
	}
	
	public function load_cost_by_scheduled_event()
	{
		if($this->input->get('Scheduled_Event_Id')!=0)
		{
			$options = array(''=>'Seleccione');
			
			$data['costs_raw'] = $this->Sale_Model->get_sale_active_with_cost_by_scheduled_event($this->input->get('Scheduled_Event_Id'));
			
			if($data['costs_raw']!=0)
			{
				foreach($data['costs_raw'] as $cost)
				{
					$cost->Type      = $this->type_event($cost->Type);
					if($cost->Type!='Ponentes')
					$options[$cost->Id] = $cost->Type.' - '.$cost->Amount;
				}
			}
			else
			{
				$options = array('' => "No hay Categoria Disponible");
			}
			
			$class    = 'class="form-control"';
			$required = ' required=""';
			
			$salida  = form_dropdown('Cost_Id', $options, (set_value('Cost_Id')), $class.$required);
			
			echo json_encode($salida);
		}
	}
	
	public function load_knowledge_and_cost_by_scheduled_event_for_falitator()
	{
		if($this->input->get('Scheduled_Event_Id')!=0)
		{
			$options = array(''=>'Seleccione');
			
			$data['costs_raw'] = $this->Sale_Model->get_sale_active_with_cost_by_scheduled_event($this->input->get('Scheduled_Event_Id'));
			
			if($data['costs_raw']!=0)
			{
				foreach($data['costs_raw'] as $cost)
				{
					$cost->Type      = $this->type_event($cost->Type);
					if($cost->Type=='Ponentes')
					$options[$cost->Id] = $cost->Type.' - '.$cost->Amount;
				}
			}
			else
			{
				$options = array('' => "No hay Categoria Disponible");
			}
			
			$class    = 'class="form-control"';
			$required = ' required=""';
			
			$salida['costs']  = form_dropdown('Cost_Id', $options, (set_value('Cost_Id')), $class.$required);
			
			$options = array(''=>'Seleccione');
			
			$data['knowledges'] = $this->Knowledge_Model->get_all_knowledges_by_scheduled_event($this->input->get('Scheduled_Event_Id'));
			
			if($data['knowledges']!=0)
			{
				foreach($data['knowledges'] as $knowledge)
				{
					$options[$knowledge->Id] = $knowledge->Content;
				}
			}
			else
			{
				$options = array('' => "No hay Areas del Saber Disponible");
			}
			
			$class    = 'class="form-control"';
			$required = ' required=""';
			
			$salida['knowledges']  = form_dropdown('Knowledge_Id', $options, (set_value('Knowledge_Id')), $class.$required);
			
			echo json_encode($salida);
		}
	}
	
	public function load_input_author()
	{
		$salida  = '';
		
		$salida .= ' <div class="form-group" id="divAuthor'.$this->input->get('num').'">';
		$salida .= ' 	<label for="Author" class="col-lg-4">CoAutor '.$this->input->get('num').' <a onclick="remove_input_author(divAuthor'.$this->input->get('num').')" href="javascript:;" class="btn btn-md btn-danger pull-right ui-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete this Author"><i class="btn-icon-only fa fa-minus"></i></a></label>';
		$salida .= ' 		<div class="col-lg-8">';
		$salida .=  			form_input(array('name'=>'Author[]','id'=>'Author'.$this->input->get('num'),
										'class'=>'form-control','required'=>'','placeholder'=>'Cedula del CoAutor '.$this->input->get('num')));
		$salida .= '		</div>';
		$salida .= '</div>';
		
		echo json_encode($salida);
	}
	
	public function load_summary_activity()
	{
		if($this->input->get('Id')!=0)
		{
			$activity = $this->Activity_Model->get_by_id($this->input->get('Id'));
			
			
			if($activity!=0)
			{
				$salida['title'] = 'Resumen - '.$activity[0]->Title;
				$salida['body']  = $activity[0]->Summary_Words;
				
				echo json_encode($salida);
			}
		}
	}
	
	public function load_knowledges_by_activity()
	{
		if($this->input->get('Id')!=0)
		{
			$salida['title'] = 'Áreas del Saber Asociadas';
			$salida['body']  = '';
			
			$knowledges = $this->Knowledge_Activity_Model->get_all_knowledge_activities_with_knowledge_by_activity($this->input->get('Id'));
			
			if($knowledges!=0)
			{
				$salida['body'] .= '<ul>';
				foreach($knowledges as $knowledge)
				{
					$salida['body'] .= '<li>'.$knowledge->Content.'</li>';
				}
				$salida['body'] .= '</ul>';
			}
			else
			{
				$salida['body'] = 'No posee Saberes Asociados';
			}
			
			echo json_encode($salida);
		}
	}
	
	public function load_authors_by_activity()
	{
		if($this->input->get('Id')!=0)
		{
			$salida['title'] = 'Autores de la Propuesta';
			$salida['body']  = '';
			
			$authors = $this->Author_Model->get_all_authors_by_activity($this->input->get('Id'));
			
			if($authors!=0)
			{
				$salida['body'] .= '<ul>';
				foreach($authors as $author)
				{
					$salida['body'] .= '<li>'.$author->Name.' '.$author->Last_Name.' - '.$author->Email.'</li>';
				}
				$salida['body'] .= '</ul>';
			}
			else
			{
				$salida['body'] = 'No posee Autores Asociados';
			}
			
			echo json_encode($salida);
		}
	}
}