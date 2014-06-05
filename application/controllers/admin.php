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
		    $this->load->view('backend/base/header',$head);
			$this->load->view('backend/admin/new_account');
			$this->load->view('backend/base/footer');
		}
		else
		{
		    $this->form_validation->set_rules('Holder', 'Titular', 'trim|required|xss_clean');
			$this->form_validation->set_rules('DNI', 'Cedula / Rif', 'trim|required|xss_clean');
			$this->form_validation->set_rules('Type', 'Tipo de Cuenta', 'trim|required|xss_clean');
			$this->form_validation->set_rules('Bank', 'Banco', 'trim|required|xss_clean');
			$this->form_validation->set_rules('Gender', 'Sexo', 'trim|required|xss_clean');
			$this->form_validation->set_rules('Country', 'País', 'trim|required|xss_clean');
			$this->form_validation->set_rules('State', 'Estado', 'trim|required|xss_clean');
			$this->form_validation->set_rules('City', 'Ciudad', 'trim|required|xss_clean');
			$this->form_validation->set_rules('Username', 'Usuario', 'trim|required|xss_clean|is_unique[Participant.Username]');
			$this->form_validation->set_rules('Password', 'Contraseña', 'trim|required|xss_clean|min_length[8]|max_length[15]|matches[Pass]');
			$this->form_validation->set_rules('Pass', 'Confirme su Contraseña', 'trim|required|xss_clean');
			$this->form_validation->set_rules('Type', 'Tipo de Usuario', 'trim|required|xss_clean');
			
			$this->form_validation->set_message('required', '%s es requerido');
			$this->form_validation->set_message('valid_email', '%s no es válido');
			$this->form_validation->set_message('is_unique', 'El %s no se encuentra disponible');
			$this->form_validation->set_message('min_length', 'La %s debe tener al menos 8 caracteres.');
			$this->form_validation->set_message('max_length', 'La %s debe tener al como máximo 15 caracteres.');
			$this->form_validation->set_message('matches', 'La contraseñas no coincides.');
			
			if ($this->form_validation->run() == FALSE)
			{
				$this->new_user(1,$dni);
			}
			else
			{
				if ($this->Participant_Model->insert_participant($this->input))
				{
					if ($this->User_Model->insert_user_array(array('Type'=>$this->input->post('Type'),'Participant_Id' => $this->db->insert_id())))
					{
						 $this->success_view('Éxito','El nuevo usuario se ha guardado');
						 $this->index();
					}
					else
					{
						 $this->Participant_Model->delete_participant($this->db->insert_id());
						 $this->error_view('Error','Oh oh. Algo malo ha pasado con el nuevo usuario');
						 $this->new_user(1);
					}
				}
				else
				{
					$this->error_view('Error','Oh oh. Algo malo ha pasado con el nuevo usuario');
					$this->new_user(1);
				}
			}
		}
	}
	
	public function load_states()
	{
		$options = "";
        if($this->input->post('country'))
        {
            $country = $this->input->post('country');
            $states = $this->State_Model->get_by_id_country($country);
			?><option value="">- Seleccione -</option><?php
            foreach($states as $state)
            {
            ?>
                <option value="<?=$state->Id?>"><?=$state->Name?></option>
            <?php
            }
        }
	}
	
	public function load_cities()
	{
		$options = "";
        if($this->input->post('state'))
        {
            $state = $this->input->post('state');
            $cities = $this->City_Model->get_by_id_state($state);
			?><option value="">- Seleccione -</option><?php
            foreach($cities as $city)
            {
            ?>
                <option value="<?=$city->Id?>"><?=$city->Name?></option>
            <?php
            }
        }
	}
	
	function edit($id,$phase = 1)
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

	function delete($id)
	{
		$this->check_session();
		
		if ($this->User_Model->delete_user($id))
		{
			$this->success_view('Éxito','El usuario se ha eliminado');
			$this->index();
		}
		else
		{
			$this->error_view('Error','Oh oh. Algo malo ha pasado con el usuario');
			$this->index();
		}
	}
	
	function view($id)
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
	
	function password($id)
	{
		$this->check_session();
		$head['controller'] = 'Pass_User';
		$data['user'] = $this->User_Model->get_by_id($id);
		$this->load->view('backend/base/header',$head);
		$this->load->view('backend/user/pass',$data);
		$this->load->view('backend/base/footer');	
	}

}