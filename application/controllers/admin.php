<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include('backend.php');

class Admin extends Backend {
	
	public function __construct()
    {
    	parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('Account_Model');
		$this->load->model('Scheduled_Event_Model');
		$this->load->model('Scheduled_Event_Account_Model');
    }

	public function accounts_index()
	{
		$this->check_session();
		$data['title']      = "Cuentas";
		$data['controller'] = 'List';
		$data['rows']  = $this->Account_Model->get_all_accounts();
		$this->load_view('admin/index',$data);
	}
	
	public function new_account($phase = 1)
	{
		$this->check_session();
		$head['controller'] = 'New_Account';
		
		if ($phase == 1)
		{
			$this->load_view('admin/new_account',$head);
		}
		else
		{
		    $this->form_validation->set_rules('Holder', 'Titular', 'trim|required|xss_clean');
			$this->form_validation->set_rules('DNI', 'Cédula / Rif', 'trim|required|xss_clean');
			$this->form_validation->set_rules('Type', 'Tipo de Cuenta', 'trim|required|xss_clean');
			$this->form_validation->set_rules('Bank', 'Banco', 'trim|required|xss_clean');
			$this->form_validation->set_rules('Number', 'Número', 'trim|required|xss_clean');
			$this->form_validation->set_rules('Status', 'Estatus', 'trim|required|xss_clean');
			
			$this->form_validation->set_message('required', '%s es requerido');
			
			if ($this->form_validation->run() == FALSE)
			{
				$this->new_account(1);
			}
			else
			{
				if ($this->Account_Model->insert_account($this->input))
				{
					$this->success_view('Éxito','La nueva cuenta se ha guardado');
					$this->accounts_index();
				}
				else
				{
					$this->error_view('Error','Oh oh. Algo malo ha pasado con la nueva cuenta');
					$this->new_account(1);
				}
			}
		}
	}
	
	function account_edit($id,$phase = 1)
	{
		$this->check_session();
		$head['controller'] = 'Edit_Account';
		$data['account'] = $this->Account_Model->get_by_id($id);
		if ($data['account'] != 0){
		  
		  if ($phase == 1)
		  {
			  $this->load->view('backend/base/header',$head);
			  $this->load->view('backend/admin/edit_account',$data);
			  $this->load->view('backend/base/footer');	
		  }
		  else
		  {
			$this->form_validation->set_rules('Holder', 'Titular', 'trim|required|xss_clean');
			$this->form_validation->set_rules('DNI', 'Cédula / Rif', 'trim|required|xss_clean');
			$this->form_validation->set_rules('Type', 'Tipo de Cuenta', 'trim|required|xss_clean');
			$this->form_validation->set_rules('Bank', 'Banco', 'trim|required|xss_clean');
			$this->form_validation->set_rules('Number', 'Número', 'trim|required|xss_clean');
			$this->form_validation->set_rules('Status', 'Estatus', 'trim|required|xss_clean');
			
			$this->form_validation->set_message('required', '%s es requerido');	 			
			  
			   if ($this->form_validation->run() == FALSE)
			   {
					$this->account_edit($id,1);
			   }
			   else
			   {
				  if ($this->Account_Model->update_account($this->input))
				  {
					   $this->success_view('Éxito','La cuenta se ha modicado');
					   $this->accounts_index();
				  }
				  else
				  {
						$this->error_view('Error','Oh oh. Algo malo ha pasado con la modificación de la cuenta');
						$this->account_edit($id,1);
				  }
			  }
		  }
		}
		else
		{
		  redirect('/admin/accounts_index','refresh');
		}
	}
	
	function account_view($id)
	{
		$this->check_session();
		$head['controller'] = 'View_Account';
		$data['account'] = $this->Account_Model->get_by_id($id);
		$data['events'] = $this->Account_Model->get_all_events_asociated($id);
		if ($data['account'] != 0)
		{
		  $this->load->view('backend/base/header',$head);
		  $this->load->view('backend/admin/view_account',$data);
		  $this->load->view('backend/base/footer');	
		}
		else
		{
		  redirect('/admin/accounts_index','refresh');
		}
	}

	function account_event($id,$phase = 1)
	{
		$this->check_session();
		$head['controller'] = 'Account_Event';
		$data['events'] = $this->Scheduled_Event_Model->get_all_scheduled_events_actives();
		$data['account'] = $this->Account_Model->get_by_id($id);
		if ($data['account'] != 0)
		{
			if ($phase == 1)
			{
			  $this->load->view('backend/base/header',$head);
			  $this->load->view('backend/admin/account_event',$data);
			  $this->load->view('backend/base/footer');	
			}
			else
			{
				$this->form_validation->set_rules('Scheduled_Event_Id', 'Evento', 'trim|required|xss_clean');
			
				$this->form_validation->set_message('required', '%s es requerido');	 			
			  
				   if ($this->form_validation->run() == FALSE)
				   {
						$this->account_event($id,1);
				   }
				   else
				   {
					  if ($this->Scheduled_Event_Account_Model->insert_scheduled_event_account($this->input))
					  {
						   $this->success_view('Éxito','La cuenta ha sido asociada');
						   $this->account_view($id);
					  }
					  else
					  {
							$this->error_view('Error','Oh oh. Algo malo ha pasado con la modificación de la cuenta');
							$this->account_event($id,1);
					  }
				  }
			}
		}
		else
		{
		  redirect('/admin/accounts_index','refresh');
		}
	}
	
	function backup()
	{
		$this->check_session();
        $this->load->helper('file');
		$this->load->helper('download');
		$this->load->dbutil();
		
		$prefs = array(
				'ignore'      => array(),                                  // List of tables to omit from the backup
				'format'      => 'gzip',                                   // gzip, zip, txt
				'filename'    => 'mybackup_'.date('Y_m_d_H_i_s',time()).'.sql',
																 // File name - NEEDED ONLY WITH ZIP FILES
				'add_drop'    => FALSE,                          // Whether to add DROP TABLE statements to backup file
				'add_insert'  => TRUE,                                     // Whether to add INSERT data to backup file
				'newline'     => "\n"                                      // Newline character used in backup file
			  );
		$backup =& $this->dbutil->backup($prefs);
		
		if(force_download('repaldo'.date('Y_m_d_H_i_s',time()).'.gzip', $backup))
		{}
		else
		{
			$this->error_view('Error','Oh oh. Algo malo ha pasado con el respaldo');
			(new Backend)->index();
		}
        
	}

}
