<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers\Hospital_admin;

use App\Controllers\BaseController;

use App\Models\Hospital_admin\AppointmentModel;

class Appointment extends BaseController
{
	
    protected $appointmentModel;
    protected $validation;
    protected $session;

	public function __construct()
	{
        $this->session = \Config\Services::session();
	    $this->appointmentModel = new AppointmentModel();
       	$this->validation =  \Config\Services::validation();
		
	}
	
	public function index()
	{
        $isLoggedInHospital = $this->session->isLoggedInHospital;

        if(!isset($isLoggedInHospital) || $isLoggedInHospital != TRUE)
        {
            echo view('Hospital_admin/Login/login');
        }
        else {

            $data = [
                'controller' => 'Hospital_admin/appointment',
                'title' => 'Appointment'
            ];

            echo view('hospital_admin/header');
            echo view('hospital_admin/sidebar');
            echo view('Hospital_admin/appointment/appointment', $data);
            echo view('hospital_admin/footer');
        }
			
	}

	public function getAll()
	{
 		$response = array();		
		
	    $data['data'] = array();
 
		$result = $this->appointmentModel->select('appointment_id, doc_id, pat_id, day, time, date, name, phone, serial_number, h_id, createdDtm, createdBy, updatedDtm, updatedBy, deleted, deletedRole')->findAll();
		
		foreach ($result as $key => $value) {
							
			$ops = '<div class="btn-group">';
			$ops .= '	<button type="button" class="btn btn-sm btn-info" onclick="edit('. $value->appointment_id .')"><i class="fa fa-edit"></i></button>';
			$ops .= '	<button type="button" class="btn btn-sm btn-danger" onclick="remove('. $value->appointment_id .')"><i class="fa fa-trash"></i></button>';
			$ops .= '</div>';
			
			$data['data'][$key] = array(
				$value->appointment_id,
				$value->doc_id,
				$value->pat_id,
				$value->day,
				$value->time,
				$value->date,
				$value->name,
				$value->phone,
				$value->serial_number,
				$value->h_id,
				$value->createdDtm,
				$value->createdBy,
				$value->updatedDtm,
				$value->updatedBy,
				$value->deleted,
				$value->deletedRole,

				$ops,
			);
		} 

		return $this->response->setJSON($data);		
	}
	
	public function getOne()
	{
 		$response = array();
		
		$id = $this->request->getPost('appointment_id');
		
		if ($this->validation->check($id, 'required|numeric')) {
			
			$data = $this->appointmentModel->where('appointment_id' ,$id)->first();
			
			return $this->response->setJSON($data);	
				
		} else {
			
			throw new \CodeIgniter\Exceptions\PageNotFoundException();

		}	
		
	}	
	
	public function add()
	{

        $response = array();

        $fields['appointment_id'] = $this->request->getPost('appointmentId');
        $fields['doc_id'] = $this->request->getPost('docId');
        $fields['pat_id'] = $this->request->getPost('patId');
        $fields['day'] = $this->request->getPost('day');
        $fields['time'] = $this->request->getPost('time');
        $fields['date'] = $this->request->getPost('date');
        $fields['name'] = $this->request->getPost('name');
        $fields['phone'] = $this->request->getPost('phone');
        $fields['serial_number'] = $this->request->getPost('serialNumber');
        $fields['h_id'] = $this->request->getPost('hId');
        $fields['createdDtm'] = $this->request->getPost('createdDtm');
        $fields['createdBy'] = $this->request->getPost('createdBy');
        $fields['updatedDtm'] = $this->request->getPost('updatedDtm');
        $fields['updatedBy'] = $this->request->getPost('updatedBy');
        $fields['deleted'] = $this->request->getPost('deleted');
        $fields['deletedRole'] = $this->request->getPost('deletedRole');


        $this->validation->setRules([
            'doc_id' => ['label' => 'Doc id', 'rules' => 'required|numeric|max_length[11]'],
            'pat_id' => ['label' => 'Pat id', 'rules' => 'required|numeric|max_length[11]'],
            'day' => ['label' => 'Day', 'rules' => 'required'],
            'time' => ['label' => 'Time', 'rules' => 'required'],
            'date' => ['label' => 'Date', 'rules' => 'required|valid_date'],
            'name' => ['label' => 'Name', 'rules' => 'required|max_length[155]'],
            'phone' => ['label' => 'Phone', 'rules' => 'required|numeric|max_length[11]'],
            'serial_number' => ['label' => 'Serial number', 'rules' => 'required|numeric|max_length[11]'],
            'h_id' => ['label' => 'H id', 'rules' => 'required|numeric|max_length[11]'],
            'createdDtm' => ['label' => 'CreatedDtm', 'rules' => 'required'],
            'createdBy' => ['label' => 'CreatedBy', 'rules' => 'required|numeric|max_length[11]'],
            'updatedDtm' => ['label' => 'UpdatedDtm', 'rules' => 'required'],
            'updatedBy' => ['label' => 'UpdatedBy', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'deleted' => ['label' => 'Deleted', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'deletedRole' => ['label' => 'DeletedRole', 'rules' => 'permit_empty|numeric|max_length[11]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
            $response['messages'] = $this->validation->listErrors();
			
        } else {

            if ($this->appointmentModel->insert($fields)) {
												
                $response['success'] = true;
                $response['messages'] = 'Data has been inserted successfully';	
				
            } else {
				
                $response['success'] = false;
                $response['messages'] = 'Insertion error!';
				
            }
        }
		
        return $this->response->setJSON($response);
	}

	public function edit()
	{

        $response = array();
		
        $fields['appointment_id'] = $this->request->getPost('appointmentId');
        $fields['doc_id'] = $this->request->getPost('docId');
        $fields['pat_id'] = $this->request->getPost('patId');
        $fields['day'] = $this->request->getPost('day');
        $fields['time'] = $this->request->getPost('time');
        $fields['date'] = $this->request->getPost('date');
        $fields['name'] = $this->request->getPost('name');
        $fields['phone'] = $this->request->getPost('phone');
        $fields['serial_number'] = $this->request->getPost('serialNumber');
        $fields['h_id'] = $this->request->getPost('hId');
        $fields['createdDtm'] = $this->request->getPost('createdDtm');
        $fields['createdBy'] = $this->request->getPost('createdBy');
        $fields['updatedDtm'] = $this->request->getPost('updatedDtm');
        $fields['updatedBy'] = $this->request->getPost('updatedBy');
        $fields['deleted'] = $this->request->getPost('deleted');
        $fields['deletedRole'] = $this->request->getPost('deletedRole');


        $this->validation->setRules([
            'doc_id' => ['label' => 'Doc id', 'rules' => 'required|numeric|max_length[11]'],
            'pat_id' => ['label' => 'Pat id', 'rules' => 'required|numeric|max_length[11]'],
            'day' => ['label' => 'Day', 'rules' => 'required'],
            'time' => ['label' => 'Time', 'rules' => 'required'],
            'date' => ['label' => 'Date', 'rules' => 'required|valid_date'],
            'name' => ['label' => 'Name', 'rules' => 'required|max_length[155]'],
            'phone' => ['label' => 'Phone', 'rules' => 'required|numeric|max_length[11]'],
            'serial_number' => ['label' => 'Serial number', 'rules' => 'required|numeric|max_length[11]'],
            'h_id' => ['label' => 'H id', 'rules' => 'required|numeric|max_length[11]'],
            'createdDtm' => ['label' => 'CreatedDtm', 'rules' => 'required'],
            'createdBy' => ['label' => 'CreatedBy', 'rules' => 'required|numeric|max_length[11]'],
            'updatedDtm' => ['label' => 'UpdatedDtm', 'rules' => 'required'],
            'updatedBy' => ['label' => 'UpdatedBy', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'deleted' => ['label' => 'Deleted', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'deletedRole' => ['label' => 'DeletedRole', 'rules' => 'permit_empty|numeric|max_length[11]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
            $response['messages'] = $this->validation->listErrors();
			
        } else {

            if ($this->appointmentModel->update($fields['appointment_id'], $fields)) {
				
                $response['success'] = true;
                $response['messages'] = 'Successfully updated';	
				
            } else {
				
                $response['success'] = false;
                $response['messages'] = 'Update error!';
				
            }
        }
		
        return $this->response->setJSON($response);
		
	}
	
	public function remove()
	{
		$response = array();
		
		$id = $this->request->getPost('appointment_id');
		
		if (!$this->validation->check($id, 'required|numeric')) {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
			
		} else {	
		
			if ($this->appointmentModel->where('appointment_id', $id)->delete()) {
								
				$response['success'] = true;
				$response['messages'] = 'Deletion succeeded';	
				
			} else {
				
				$response['success'] = false;
				$response['messages'] = 'Deletion error!';
				
			}
		}	
	
        return $this->response->setJSON($response);		
	}	
		
}	