<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include('frontend.php');

class Home extends Frontend {
	
	 public function __construct()
	 {
    	parent::__construct();
		$this->load->model('Scheduled_Event_Model');
	 }

	 public function index($type = '')
	 {
		  $data['title'] = 'EMS UPTM::Inicio';
		  $data['type']  = $type;
		  if($type == '')
		  {
			   $data['events'] = $this->Scheduled_Event_Model->get_all_scheduled_events_actives();
		  }
		  else
		  {
			   $data['events'] = $this->Scheduled_Event_Model->get_all_scheduled_events_actives_by_type($type);
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
			   $data['name'] = $this->session->userdata('public_ems_uptm')['Name']
							  .' '.$this->session->userdata('public_ems_uptm')['Last_Name'];
			   $this->load_view('base/contact',$data);
		  }
	 }
}