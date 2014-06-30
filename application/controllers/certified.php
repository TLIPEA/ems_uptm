<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include('backend.php');

class Certified extends Backend {
	
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
	
	public function index()
	{
		redirect('/backend/','refresh');
	}
	
	public function design()
	{
		?>
		<script type="text/javascript">
			alert('Funcionalidad en Construcción');
		</script>
		<?php
		$this->index();
	}
	
	public function prints()
	{
		?>
		<script type="text/javascript">
			alert('Funcionalidad en Construcción');
		</script>
		<?php
		$this->index();
	}
}
	
	
	