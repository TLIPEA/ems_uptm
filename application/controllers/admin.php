<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include('backend.php');

class Admin extends Backend {
	
	public function __construct()
    {
    	parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('Account_Model');
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
			$this->form_validation->set_rules('DNI', 'Cedula / Rif', 'trim|required|xss_clean');
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
	
	function edit_account($id,$phase = 1)
	{
		$this->check_session();
		$head['controller'] = 'Edit_User';
		$data['user'] = $this->Participant_Model->get_by_id_with_user($id);
		if ($data['user'] != 0){
		  
		  $data['countries'] = $this->Country_Model->get_all_countries();
		  $data['states']    = $this->State_Model->get_by_id_country($data['user'][0]->Country_Id);
		  $data['cities']    = $this->City_Model->get_by_id_state($data['user'][0]->State_Id);
		  
		  if ($phase == 1)
		  {
			  $this->load->view('backend/base/header',$head);
			  $this->load->view('backend/user/edit',$data);
			  $this->load->view('backend/base/footer');	
		  }
		  else
		  {
			   $this->form_validation->set_rules('Name', 'Nombre', 'trim|required|xss_clean');
			   $this->form_validation->set_rules('Last_Name', 'Apellido', 'trim|required|xss_clean');
			   $this->form_validation->set_rules('Email', 'Correo Electrónico', 'trim|required|xss_clean|valid_email');
			   $this->form_validation->set_rules('Gender', 'Sexo', 'trim|required|xss_clean');
			   $this->form_validation->set_rules('Country', 'País', 'trim|required|xss_clean');
			   $this->form_validation->set_rules('State', 'Estado', 'trim|required|xss_clean');
			   $this->form_validation->set_rules('City', 'Ciudad', 'trim|required|xss_clean');
			   $this->form_validation->set_rules('Type', 'Tipo de Usuario', 'trim|required|xss_clean');
	 			
			   $this->form_validation->set_message('required', '%s es requerido');
			   $this->form_validation->set_message('valid_email', '%s no es válido');
			   $this->form_validation->set_message('is_unique', 'El %s no se encuentra disponible');
			  
			   if ($this->form_validation->run() == FALSE)
			   {
					$this->edit($id,1);
			   }
			   else
			   {
				  if ($this->Participant_Model->update_participant($this->input))
				  {
					if ($data['user'][0]->Type == 'NULL' or $data['user'][0]->Type == '')
					{
						 $user1 = array(
								  'Type'           => $this->input->post('Type'),
								  'Participant_Id' => $id
								  );
						 if ($this->User_Model->insert_user_array($user1))
						 {
							  $this->success_view('Éxito','El usuario se ha modicado');
							  $this->index();
						 }
						 else
						 {
							  $this->error_view('Error','Oh oh. Algo malo ha pasado con la modificación del usuario');
							  $this->edit($id,1);
						 }
					}
					else
					{
						 if ($this->User_Model->update_user($this->input))
						 {
							  $this->success_view('Éxito','El usuario se ha modicado');
							  $this->index();
						 }
						 else
						 {
							  $this->error_view('Error','Oh oh. Algo malo ha pasado con la modificación del usuario');
							  $this->edit($id,1);
						 }
					}
				  }
				  else
				  {
					  $this->error_view('Error','Oh oh. Algo malo ha pasado con la nueva categoría');
					  $this->edit($id,1);
				  }
			  }
		  }
		}
		else
		{
		  redirect('/user/index','refresh');
		}
	}
	
	function view_account($id)
	{
		$this->check_session();
		$head['controller'] = 'View_User';
		$data['user'] = $this->Participant_Model->get_by_id_with_user($id);
		if ($data['user'] != 0)
		{
		  $this->load->view('backend/base/header',$head);
		  $this->load->view('backend/user/view',$data);
		  $this->load->view('backend/base/footer');	
		}
		else
		{
		  redirect('/user/index','refresh');
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