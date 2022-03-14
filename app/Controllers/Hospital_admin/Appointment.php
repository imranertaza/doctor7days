<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers\Hospital_admin;

use App\Controllers\BaseController;
use App\Libraries\Permission_hospital;

use App\Models\Hospital_admin\AppointmentModel;
use App\Models\Mobile_app\DoctorModel;

class Appointment extends BaseController
{
	
    protected $appointmentModel;
    protected $doctorModel;
    protected $validation;
    protected $session;
    protected $permission;
    private $module_name = 'Appointment';

	public function __construct()
	{
        $this->session = \Config\Services::session();
	    $this->appointmentModel = new AppointmentModel();
	    $this->doctorModel = new DoctorModel();
       	$this->validation =  \Config\Services::validation();
       	$this->permission = new Permission_hospital();
		
	}
	
	public function index()
	{
        $isLoggedInHospital = $this->session->isLoggedInHospital;
        $role_id = $this->session->hospitalAdminRole;

        if(!isset($isLoggedInHospital) || $isLoggedInHospital != TRUE)
        {
            echo view('Hospital_admin/Login/login');
        }
        else {
            $hId = $this->session->h_Id;
            $doc = $this->doctorModel->where('h_id',$hId)->findAll();

            $data = [
                'controller' => 'Hospital_admin/appointment',
                'title' => 'Appointment',
                'doctor' => $doc,
            ];


            $perm = $this->permission->module_permission_list($role_id, $this->module_name);
            foreach ($perm as $key => $val) {
                $data[$key] = $this->permission->have_access($role_id, $this->module_name, $key);
            }

            echo view('Hospital_admin/header');
            echo view('Hospital_admin/sidebar');
            if ($data['mod_access'] == 1) {
            	echo view('Hospital_admin/Appointment/appointment', $data);
            }else {
            	echo view('Hospital_admin/No_permission', $data);
            }
            echo view('Hospital_admin/footer');
        }
        
			
	}

	public function getAll()
	{
 		$response = array();		
		
	    $data['data'] = array();
        $hId = $this->session->h_Id;
		$result = $this->appointmentModel->select('appointment_id, doc_id, pat_id, day, time, date, name, phone, serial_number, status')->where('h_id',$hId)->findAll();
		
		foreach ($result as $key => $value) {


             $ch = ($value->status == 1)?'checked':'';
             $val = ($value->status == 1)?'0':'1';

			$data['data'][$key] = array(
				$value->appointment_id,
				get_data_by_id('name','doctor','doc_id',$value->doc_id),
				$value->pat_id,
				$value->day,
				$value->time,
                globalDateFormat($value->date),
				$value->name,
				$value->phone,
				$value->serial_number,
                '<label class="switch" onchange="appStatusChange('.$value->appointment_id.','.$val.')">
                  <input type="checkbox"  '.$ch.' >
                  <span class="slider round"></span>
                </label>',

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

	public function search(){
        $isLoggedInHospital = $this->session->isLoggedInHospital;
        $role_id = $this->session->hospitalAdminRole;

        if(!isset($isLoggedInHospital) || $isLoggedInHospital != TRUE)
        {
            echo view('Hospital_admin/Login/login');
        }
        else {

            $hId = $this->session->h_Id;
            $doc = $this->doctorModel->where('h_id',$hId)->findAll();
            $data['doctor'] = $doc;

            $data['controller'] = 'Hospital_admin/appointment';

            $doc_id = $this->request->getPost('doc_id');
            $time = $this->request->getPost('time');
            $date = $this->request->getPost('date');
            $where = ['doc_id' => $doc_id,'time' => $time,'date' => $date];
            $data['result'] = $this->appointmentModel->where($where)->findAll();

            $data['doc_id'] = $doc_id;
            $data['time'] = $time;
            $data['date'] = $date;

            echo view('Hospital_admin/header');
            echo view('Hospital_admin/sidebar');
            echo view('Hospital_admin/Appointment/search', $data);
            echo view('Hospital_admin/footer');
        }
    }


    public function status_update()
    {
        $response = array();

        $id = $this->request->getPost('appointment_id');
        $status = $this->request->getPost('status');

        $fields['appointment_id'] = $id;
        $fields['status'] = $status;

        if ($this->appointmentModel->update($fields['appointment_id'], $fields)) {

            $response['success'] = true;
            $response['messages'] = 'Update succeeded';

        } else {

            $response['success'] = false;
            $response['messages'] = 'Update error!';

        }


        return $this->response->setJSON($response);
    }

}	