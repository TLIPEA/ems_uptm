<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include('backend.php');

class Payment extends Backend {
	
	public function __construct()
    {
    	parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('Scheduled_Event_Model');
		$this->load->model('Registration_Model');
		$this->load->model('Participant_Model');
		$this->load->model('Payment_Model');
		$this->load->model('Account_Model');
    }
	
	public function index($id = '')
	{
		$this->check_session();
		$data['title']      = "Pagos";
		$data['controller'] = 'List';
		if($id == '')
		{
			$data['rows']  = $this->Payment_Model->get_all_payments();
		}
		else
		{
			$data['event'] = $this->Scheduled_Event_Model->get_by_id($id);
			if(!($data['event']!=0))
			{
				$this->error_view('Error','Oh oh. Algo malo ha pasado con la carga de la data de los Pagos del Evento');
				$this->index();
			}
			$data['rows']  = $this->Payment_Model->get_all_payments_by_scheduled_event($id);
		}
		
		$this->load_view('participant/payments',$data);
	}
	
	public function new_pay($id = '0',$Scheduled_Event_Id = '',$phase = 1)
	{
		$this->check_session();
		$data['controller']  = 'New_Pay';
		
		if($Scheduled_Event_Id == '')
		{
			$this->error_view('Error','Debes Seleccionar un evento valido');
			$this->index();
		}
		
		$data['event'] = $this->Scheduled_Event_Model->get_by_id($Scheduled_Event_Id);
		if(!($data['event']!=0))
		{
			$this->error_view('Error','Debes Seleccionar un evento valido');
			$this->search();
		}
		
		$data['accounts'] = $this->Account_Model->get_by_scheduled_event_id($data['event'][0]->Id);
		
		if(!($data['accounts']!=0))
		{
			$this->error_view('No puedes Acceder al Área de Pago','Debido a que este evento no posee con una cuenta en la cual registrar pagos');
			$this->index($id);
		}
		
		$data['id'] = $id;
		
		if ($phase == 1)
		{
			$data['participants'] = $this->Registration_Model->get_all_registrations_with_participant_by_scheduled_event($Scheduled_Event_Id);
			$this->load_view('participant/pay',$data);
		}
		else
		{
			$this->form_validation->set_rules('Account_Id','Seleccionar Evento','trim|required|xss_clean');
			$this->form_validation->set_rules('Payment_Date','Seleccionar Evento','trim|required|xss_clean');
			$this->form_validation->set_rules('Voucher_Number','Seleccionar Evento','trim|required|xss_clean');
			$this->form_validation->set_rules('Amount','Seleccionar Evento','trim|required|xss_clean');
			
			$this->form_validation->set_message('required', '%s es necesario para realizar la Postulación');
			
			if ($this->form_validation->run()==FALSE)
			{
				$this->error_view('Error al Realizar el Pago','Algo va mal, intentalo de nuevo, si el error persiste comunicate con soporte');
				$this->new_pay($id,$Scheduled_Event_Id,1);
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
				$this->index($Scheduled_Event_Id);
			}
		}
	}
	
	public function change_state($id = '', $phase = 1)
	{
		$this->check_session();
		$data['controller'] = 'Search';
		
		if ($phase == 1)
		{
			if($id == '')
			{
				$this->error_view('Error','Debes Seleccionar un Evento');
				$this->index();
			}
			
			$data['pay'] = $this->Payment_Model->get_by_id($id);
			if(!($data['pay']!=0))
			{
				$this->error_view('Error','Oh oh. Algo malo ha pasado con la carga de la data de los Datos del Pago');
				$this->index();
			}
			$this->load_view('participant/change_pay',$data);
		}
		else
		{
			$this->form_validation->set_rules('Status'  , 'Estado', 'trim|required|xss_clean');
			
			$this->form_validation->set_message('required', '%s es requerido');
				
			if ($this->form_validation->run() == FALSE)
			{
				$this->error_view('Error','Debes Verificar los Datos');
				$this->index();
			}
			else
			{
				if($this->Payment_Model->update_status($this->input))
				{
					$this->success_view('Exito al Realizar la Actualización','El ya cambio de Estatus');
					$this->index();
				}
				else{
					$this->error_view('Error','Algo va mal, intentalo de nuevo, si el error persiste comunicate con soporte');
					$this->index();
				}
			}
		}
	}
}