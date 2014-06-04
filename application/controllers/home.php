<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include_once('frontend.php');

class Home extends Frontend {
	
	 public function __construct()
	 {
    	parent::__construct();
		$this->load->model('Scheduled_Event_Model');
	 }

	 public function index($type = '')
	 {
		  $data['title'] = 'EMS UPTM::Inicio';
		  if($type == '')
		  {
			   $data['events_raw'] = $this->Scheduled_Event_Model->get_all_scheduled_events_actives();
		  }
		  else
		  {
			   $data['events_raw'] = $this->Scheduled_Event_Model->get_all_scheduled_events_actives_by_type($type);

		  }
		  
		  if($data['events_raw'] != 0)
		  {
			   foreach($data['events_raw'] as $event)
			   {
					$event->Type = $this->type_event($event->Type);
					$data['events'][] = $event;
			   }
		  }
		  else
		  {
			   $data['events'] = $data['events_raw'];
		  }
		  
		  if($type == '')
		  {
			   $data['type']  = $type;
		  }
		  else
		  {
			   $data['type']  = $this->type_event(urldecode($type));
		  }
		  
		  if(!$this->session->userdata('public_ems_uptm'))
		  {
			   $this->load->view('frontend/base/index',$data);
		  }
		  else
		  {
			   $data['name'] = $this->session->userdata('public_ems_uptm')['Name']
							  .' '.$this->session->userdata('public_ems_uptm')['Last_Name'];
			   $this->load_view('base/home',$data);
		  }
	 }
	
	 public function contact()
	 {
		  $data['title'] = 'EMS UPTM::Contacto';
		  
		  if(!$this->session->userdata('public_ems_uptm'))
		  {
			   $this->load->view('frontend/base/contact_public',$data);
		  }
		  else
		  {
			   $data['type'] = 'Contact';
			   $data['name'] = $this->session->userdata('public_ems_uptm')['Name']
							  .' '.$this->session->userdata('public_ems_uptm')['Last_Name'];
			   $this->load_view('base/contact',$data);
		  }
	 }
}