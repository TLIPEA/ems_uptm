<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	
	 public function __construct()
    {
    	parent::__construct();
		date_default_timezone_set('America/Panama');
    }

	public function index()
	{
		$this->load->view('frontend/base/header');
		$this->load->view('frontend/home/index');
		$this->load->view('frontend/base/footer');
	}
}