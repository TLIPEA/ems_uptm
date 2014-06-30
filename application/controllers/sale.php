<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include('events.php');

class Sale extends Backend {
	
	public function __construct()
    {
    	parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('Scheduled_Event_Model');
		$this->load->model('Sale_Model');
		$this->load->model('Cost_Model');
    }
	
	public function index($id = '')
	{
		$this->check_session();
		$data['title']      = "Preventas";
		$data['controller'] = 'List';
		
		if($id == '')
		{
			$data['rows']  = $this->Sale_Model->get_all_sales();
		}
		else
		{
			$data['event'] = $this->Scheduled_Event_Model->get_by_id($id);
			if(!($data['event']!=0))
			{
				$this->error_view('Error','Oh oh. Algo malo ha pasado con la carga de la data de los Inscritos del Evento');
				$this->index();
			}
			$data['rows']  = $this->Sale_Model->get_all_sales_by_scheduled_event($id);
		}
		
		$this->load_view('event/sales',$data);
	}
	
	public function new_sale($id = '',$phase = 1)
	{
		$this->check_session();
		$data['controller'] = 'New_Sale';
		
		if ($phase == 1)
		{
			if($id=='')
			{
				$this->error_view('Error','Oh oh. Algo malo ha pasado con la carga del evento');
				$this->index();
			}
			
			$data['event'] = $this->Scheduled_Event_Model->get_by_id($id);
		
			if($data['event']!=0)
			{
				$this->load_view('event/new_sale',$data);
			}
			else
			{
				$this->error_view('Error','Oh oh. Algo malo ha pasado con la carga de la data del evento');
				$this->index($id);
			}
		}
		else
		{
			$this->form_validation->set_rules('Description' , 'Descripción', 'trim|required|xss_clean');
			$this->form_validation->set_rules('Start_Date' , 'Fecha Inicio', 'trim|required|xss_clean');
            $this->form_validation->set_rules('End_Date' , 'Fecha Fin', 'trim|required|xss_clean');
			$this->form_validation->set_rules('Status' , 'Status', 'trim|required|xss_clean');
			
			$this->form_validation->set_message('required', '%s es requerido');
			
			if ($this->form_validation->run() == FALSE)
			{
				$this->new_sale($id,1);
			}
			else
			{
				if($this->input->post('Status')=='Active'){
					if(!$this->Sale_Model->update_sale_status_by_scheduled_event($this->input->post('Scheduled_Event_Id'),'Off'))
					{
						?>
						<script type="text/javascript">
							alert('No se pudieron desactivar las otras Preventas debes hacerlo manualmente');
						</script>
						<?php
					}
				}
				if($this->Sale_Model->insert_sale($this->input))
				{
					$this->success_view('Éxito','La preventa se ha guardado correctamente');
					$this->index($id);
				}
				else
				{
					$this->error_view('Error','Oh oh. Algo malo ha pasado con el guardado de la preventa');
					$this->new_sale($id,1);
				}
			}
		}
	}
	
	public function edit($id = '',$phase = 1)
	{
		$this->check_session();
		$data['controller'] = 'Edit_Sale';
		
		if ($phase == 1)
		{
			$data['sale'] = $this->Sale_Model->get_by_id($id);
		
			if($data['sale']!=0)
			{
				$data['event'] = $this->Scheduled_Event_Model->get_by_id($data['sale'][0]->Scheduled_Event_Id);
				$this->load_view('event/edit_sale',$data);
			}
			else
			{
				$this->error_view('Error','Oh oh. Algo malo ha pasado con la carga de la data de la preventa');
				$this->index();
			}
		}
		else
		{
			$this->form_validation->set_rules('Description' , 'Descripción', 'trim|required|xss_clean');
			$this->form_validation->set_rules('Start_Date' , 'Fecha Inicio', 'trim|required|xss_clean');
            $this->form_validation->set_rules('End_Date' , 'Fecha Fin', 'trim|required|xss_clean');
			$this->form_validation->set_rules('Status' , 'Status', 'trim|required|xss_clean');
			
			$this->form_validation->set_message('required', '%s es requerido');
			
			if ($this->form_validation->run() == FALSE)
			{
				$this->edit_sale($id,1);
			}
			else
			{
				if($this->input->post('Status')=='Active'){
					if(!$this->Sale_Model->update_sale_status_by_scheduled_event($this->input->post('Scheduled_Event_Id'),'Off'))
					{
						?>
						<script type="text/javascript">
							alert('No se pudieron desactivar las otras Preventas debes hacerlo manualmente');
						</script>
						<?php
					}
				}
				if($this->Sale_Model->update_sale($this->input))
				{
					$this->success_view('Éxito','La preventa se ha actualizado correctamente');
					$this->index($this->input->post('Scheduled_Event_Id'));
				}
				else
				{
					$this->error_view('Error','Oh oh. Algo malo ha pasado con el actualizar de la preventa');
					$this->edit_sale($id,1);
				}
			}
		}
	}
	
	public function costs($id = '',$phase = 1)
	{
		$this->check_session();
		$data['controller'] = 'Edit_Costs';
		
		if ($phase == 1)
		{
			$data['sale'] = $this->Sale_Model->get_by_id($id);
		
			if($data['sale']!=0)
			{
				$data['event'] = $this->Scheduled_Event_Model->get_by_id($data['sale'][0]->Scheduled_Event_Id);
				$data['costs'] = $this->Sale_Model->get_all_cost_by_sale_id($id);
				$this->load_view('event/costs',$data);
			}
			else
			{
				$this->error_view('Error','Oh oh. Algo malo ha pasado con la carga de la data de la preventa');
				$this->index();
			}
		}
		else
		{
			if($this->input->post('General')!=0 or $this->input->post('Speaker')!=0 or $this->input->post('Student')!=0)
			{
			//******************************* Insertar *******************************
			if($this->input->post('General')!=0 and $this->input->post('General_Id')==0)
			{
				$_POST['Type']   = 'Professionals & General Public';
				$_POST['Amount'] = (($this->input->post('General'))==-2)? 0 : $this->input->post('General');
				if(!$this->Cost_Model->insert_cost($this->input))
				{
					?>
					<script type="text/javascript">
						alert('No se pudo insertar el Costo para Profesionales y Publico en General');
					</script>
					<?php
				}
			}
			//******************************* Modificar *******************************
			elseif($this->input->post('General')!=0 and $this->input->post('General_Id')!=0 and $this->input->post('General')!=-1)
			{
				$_POST['Id'] = $this->input->post('General_Id');
				$_POST['Type']   = 'Professionals & General Public';
				$_POST['Amount'] = (($this->input->post('General'))==-2)? 0 : $this->input->post('General');
				if(!$this->Cost_Model->update_cost($this->input))
				{
					?>
					<script type="text/javascript">
						alert('No se pudo actualizar el Costo para Profesionales y Publico en General');
					</script>
					<?php
				}
			}
			//******************************* Eliminar *******************************
			elseif(($this->input->post('General'))==-1 and $this->input->post('General_Id')!=0)
			{
				if(!$this->Cost_Model->delete_cost($this->input->post('General_Id')))
				{
					?>
					<script type="text/javascript">
						alert('No se pudo eliminar el Costo para Profesionales y Publico en General');
					</script>
					<?php
				}
				
			}
			echo $this->db->last_query().'<br>';
			//******************************* Insertar *******************************
			if($this->input->post('Speaker')!=0 and $this->input->post('Speaker_Id')==0)
			{
				$_POST['Type']   = 'Speaker';
				$_POST['Amount'] = (($this->input->post('Speaker'))==-2)? 0 : $this->input->post('Speaker');
				if(!$this->Cost_Model->insert_cost($this->input))
				{
					?>
					<script type="text/javascript">
						alert('No se pudo insertar el Costo para Ponentes');
					</script>
					<?php
				}
			}
			//******************************* Modificar *******************************
			elseif($this->input->post('Speaker')!=0 and $this->input->post('Speaker_Id')!=0 and $this->input->post('Speaker')!=-1)
			{
				$_POST['Id'] = $this->input->post('Speaker_Id');
				$_POST['Type']   = 'Speaker';
				$_POST['Amount'] = (($this->input->post('Speaker'))==-2)? 0 : $this->input->post('Speaker');
				if(!$this->Cost_Model->update_cost($this->input))
				{
					?>
					<script type="text/javascript">
						alert('No se pudo actualizar el Costo para Ponentes');
					</script>
					<?php
				}
			}
			//******************************* Eliminar *******************************
			elseif(($this->input->post('Speaker'))==-1 and $this->input->post('Speaker_Id')!=0)
			{
				if(!$this->Cost_Model->delete_cost($this->input->post('Speaker_Id')))
				{
					?>
					<script type="text/javascript">
						alert('No se pudo eliminar el Costo para Ponentes');
					</script>
					<?php
				}
				
			}
			//******************************* Insertar *******************************
			if($this->input->post('Student')!=0 and $this->input->post('Student_Id')==0)
			{
				$_POST['Type']   = 'Student';
				$_POST['Amount'] = (($this->input->post('Student'))==-2)? 0 : $this->input->post('Student');
				if(!$this->Cost_Model->insert_cost($this->input))
				{
					?>
					<script type="text/javascript">
						alert('No se pudo insertar el Costo para Estudiantes');
					</script>
					<?php
				}
			}
			//******************************* Modificar *******************************
			elseif($this->input->post('Student')!=0 and $this->input->post('Student_Id')!=0 and $this->input->post('Student')!=-1)
			{
				$_POST['Id'] = $this->input->post('Student_Id');
				$_POST['Type']   = 'Student';
				$_POST['Amount'] = (($this->input->post('Student'))==-2)? 0 : $this->input->post('Student');
				if(!$this->Cost_Model->update_cost($this->input))
				{
					?>
					<script type="text/javascript">
						alert('No se pudo actualizar el Costo para Estudiantes');
					</script>
					<?php
				}
			}
			//******************************* Eliminar *******************************
			elseif(($this->input->post('Student'))==-1 and $this->input->post('Student_Id')!=0)
			{
				if(!$this->Cost_Model->delete_cost($this->input->post('Student_Id')))
				{
					?>
					<script type="text/javascript">
						alert('No se pudo eliminar el Costo para Estudiantes');
					</script>
					<?php
				}
				
			}
			redirect('/sale/costs/'.$id,'refresh');
			}
			else
			{
				$this->success_view('Nada que Hacer','Todo sigue igual');
				$this->index($this->input->post('Scheduled_Event_Id'));
			}
		}
	}
	
	public function delete($id = '')
	{
		$this->check_session();
		$data['sale'] = $this->Sale_Model->get_by_id($id);
		
		if($data['sale']!=0)
		{
			$data['event'] = $this->Scheduled_Event_Model->get_by_id($data['sale'][0]->Scheduled_Event_Id);
			if($this->Sale_Model->delete_sale($id))
			{
				$this->success_view('Éxito','La preventa se ha eliminado correctamente');
			}
			else
			{
				$this->error_view('Error','Oh oh. Algo malo ha pasado con la eliminación de la preventa');
			}
			$this->index($data['sale'][0]->Scheduled_Event_Id);
		}
		else
		{
			$this->error_view('Error','Oh oh. Algo malo ha pasado con la data que nos suministraste');
			$this->index();
		}
	}
}