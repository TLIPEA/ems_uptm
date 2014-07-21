<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include('backend.php');

class Participant extends Backend {
	
	public function __construct()
    {
    	parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('Participant_Model');
    }
	
	public function index()
	{
		$this->check_session();
		$data['title']      = "Registrados";
		$data['controller'] = 'List';
		
		$data['rows']  = $this->Participant_Model->get_all_participants();
		
		$this->load_view('participant/list',$data);
	}
	
	public function verify($code,$username)
	{
		if(!($code == 0 and $username == 0)){
            
            $data = $this->Participant_Model->verify($code,$username);
			
            if($data == 0)
			{
				$this->error_view('Error!','Algo va mal, Estas intentando validar un registro con las credenciales erroneas');
            }
			else
			{
                if($data[0]->Status == 'Active')
				{
					$this->success_view('Proceso ya Realizado!','Todo Ok, La cuenta ya se encuentra activa');
                }
				else
				{
                    if($data[0]->Id == $code){
                        
                        if($this->Participant_Model->update_status(array('Id' => $data[0]->Id, 'Status' => 'Active')))
						{
							$this->success_view('Éxito!','La cuenta ya se encuentra activa, ahora puedes iniciar sesión');
                        }
						else
						{
							$this->error_view('Error!','Algo va mal, Estas intentando validar un registro con las credenciales erroneas');
                        }
                        
                    }
					else
					{
                        $this->error_view('Error!','Algo va mal, Estas intentando validar un registro con las credenciales erroneas');
                    }
                }
            }
            
            
        }else{
            $this->error_view('Error!','Algo va mal, Estas intentando validar un registro con las credenciales erroneas');
            
        }
        $this->index();
	}
	
	public function block($code,$username)
	{
		if(!($code == 0 and $username == 0)){
            
            $data = $this->Participant_Model->verify($code,$username);
			
            if($data == 0)
			{
				$this->error_view('Error!','Algo va mal, Estas intentando bloquear un registro con las credenciales erroneas');
            }
			else
			{
                if($data[0]->Status == 'Block')
				{
					$this->success_view('Proceso ya Realizado!','Todo Ok, La cuenta ya se encuentra bloqueada');
                }
				else
				{
                    if($data[0]->Id == $code){
                        
                        if($this->Participant_Model->update_status(array('Id' => $data[0]->Id, 'Status' => 'Block')))
						{
							$this->success_view('Éxito!','La cuenta ya se encuentra bloqueado, ahora no puede iniciar sesión');
                        }
						else
						{
							$this->error_view('Error!','Algo va mal, Estas intentando bloquear un registro con las credenciales erroneas');
                        }
                        
                    }
					else
					{
                        $this->error_view('Error!','Algo va mal, Estas intentando bloquear un registro con las credenciales erroneas');
                    }
                }
            }
            
            
        }else{
            $this->error_view('Error!','Algo va mal, Estas intentando bloquear un registro con las credenciales erroneas');
            
        }
        $this->index();
	}
	
}