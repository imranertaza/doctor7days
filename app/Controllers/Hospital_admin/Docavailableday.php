<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers\Hospital_admin;

use App\Controllers\BaseController;
use App\Libraries\Permission_hospital;
use App\Models\Hospital_admin\DocavailabledayModel;

class Docavailableday extends BaseController
{
    protected $session;
    protected $docavailabledayModel;
    protected $validation;
    protected $permission;
    private $module_name = 'Docavailableday';
	
	public function __construct()
	{
        $this->session = \Config\Services::session();
	    $this->docavailabledayModel = new DocavailabledayModel();
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

            $data = [
                'controller' => 'Hospital_admin/docavailableday',
                'title' => 'Doctor&#39;s Available Day'
            ];


            $perm = $this->permission->module_permission_list($role_id, $this->module_name);
            foreach($perm as $key=>$val){
                 $data[$key] = $this->permission->have_access($role_id, $this->module_name, $key);    
            }

            echo view('Hospital_admin/header');
            echo view('Hospital_admin/sidebar');
            if ($data['mod_access'] == 1) {
                echo view('Hospital_admin/Docavailableday/docavailableday', $data);
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
 
		$result = $this->docavailabledayModel->select('doc_avil_id, doc_id, saturday, sunday, monday, tuesday, wednesday, thursday, friday, saturday_time, sunday_time, monday_time, tuesday_time, wednesday_time, thursday_time, friday_time, createdDtm, createdBy, updatedDtm, updatedBy, deleted, deletedRole')->findAll();
		
		foreach ($result as $key => $value) {
							
			$ops = '<div class="btn-group">';
			$ops .= '	<button type="button" class="btn btn-sm btn-info" onclick="edit('. $value->doc_avil_id .')"><i class="fa fa-edit"></i></button>';
			$ops .= '	<button type="button" class="btn btn-sm btn-danger" onclick="remove('. $value->doc_avil_id .')"><i class="fa fa-trash"></i></button>';
			$ops .= '</div>';
			
			$data['data'][$key] = array(
				$value->doc_avil_id,
				$value->doc_id,
				$value->saturday,
				$value->sunday,
				$value->monday,
				$value->tuesday,
				$value->wednesday,
				$value->thursday,
				$value->friday,
				$value->saturday_time,
				$value->sunday_time,
				$value->monday_time,
				$value->tuesday_time,
				$value->wednesday_time,
				$value->thursday_time,
				$value->friday_time,
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
		
		$id = $this->request->getPost('doc_avil_id');
		
		if ($this->validation->check($id, 'required|numeric')) {
			
			$data = $this->docavailabledayModel->where('doc_avil_id' ,$id)->first();
			
			return $this->response->setJSON($data);	
				
		} else {
			
			throw new \CodeIgniter\Exceptions\PageNotFoundException();

		}	
		
	}	
	
	public function add()
	{

        $response = array();

        $fields['doc_avil_id'] = $this->request->getPost('docAvilId');
        $fields['doc_id'] = $this->request->getPost('docId');
        $fields['saturday'] = $this->request->getPost('saturday');
        $fields['sunday'] = $this->request->getPost('sunday');
        $fields['monday'] = $this->request->getPost('monday');
        $fields['tuesday'] = $this->request->getPost('tuesday');
        $fields['wednesday'] = $this->request->getPost('wednesday');
        $fields['thursday'] = $this->request->getPost('thursday');
        $fields['friday'] = $this->request->getPost('friday');
        $fields['saturday_time'] = $this->request->getPost('saturdayTime');
        $fields['sunday_time'] = $this->request->getPost('sundayTime');
        $fields['monday_time'] = $this->request->getPost('mondayTime');
        $fields['tuesday_time'] = $this->request->getPost('tuesdayTime');
        $fields['wednesday_time'] = $this->request->getPost('wednesdayTime');
        $fields['thursday_time'] = $this->request->getPost('thursdayTime');
        $fields['friday_time'] = $this->request->getPost('fridayTime');
        $fields['createdDtm'] = $this->request->getPost('createdDtm');
        $fields['createdBy'] = $this->request->getPost('createdBy');
        $fields['updatedDtm'] = $this->request->getPost('updatedDtm');
        $fields['updatedBy'] = $this->request->getPost('updatedBy');
        $fields['deleted'] = $this->request->getPost('deleted');
        $fields['deletedRole'] = $this->request->getPost('deletedRole');


        $this->validation->setRules([
            'doc_id' => ['label' => 'Doc id', 'rules' => 'required|numeric|max_length[11]'],
            'saturday' => ['label' => 'Saturday', 'rules' => 'permit_empty'],
            'sunday' => ['label' => 'Sunday', 'rules' => 'permit_empty'],
            'monday' => ['label' => 'Monday', 'rules' => 'permit_empty'],
            'tuesday' => ['label' => 'Tuesday', 'rules' => 'permit_empty'],
            'wednesday' => ['label' => 'Wednesday', 'rules' => 'permit_empty'],
            'thursday' => ['label' => 'Thursday', 'rules' => 'permit_empty'],
            'friday' => ['label' => 'Friday', 'rules' => 'permit_empty'],
            'saturday_time' => ['label' => 'Saturday time', 'rules' => 'permit_empty'],
            'sunday_time' => ['label' => 'Sunday time', 'rules' => 'permit_empty'],
            'monday_time' => ['label' => 'Monday time', 'rules' => 'permit_empty'],
            'tuesday_time' => ['label' => 'Tuesday time', 'rules' => 'permit_empty'],
            'wednesday_time' => ['label' => 'Wednesday time', 'rules' => 'permit_empty'],
            'thursday_time' => ['label' => 'Thursday time', 'rules' => 'permit_empty'],
            'friday_time' => ['label' => 'Friday time', 'rules' => 'permit_empty'],
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

            if ($this->docavailabledayModel->insert($fields)) {
												
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
		
        $fields['doc_avil_id'] = $this->request->getPost('docAvilId');
        $fields['doc_id'] = $this->request->getPost('docId');
        $fields['saturday'] = $this->request->getPost('saturday');
        $fields['sunday'] = $this->request->getPost('sunday');
        $fields['monday'] = $this->request->getPost('monday');
        $fields['tuesday'] = $this->request->getPost('tuesday');
        $fields['wednesday'] = $this->request->getPost('wednesday');
        $fields['thursday'] = $this->request->getPost('thursday');
        $fields['friday'] = $this->request->getPost('friday');
        $fields['saturday_time'] = $this->request->getPost('saturdayTime');
        $fields['sunday_time'] = $this->request->getPost('sundayTime');
        $fields['monday_time'] = $this->request->getPost('mondayTime');
        $fields['tuesday_time'] = $this->request->getPost('tuesdayTime');
        $fields['wednesday_time'] = $this->request->getPost('wednesdayTime');
        $fields['thursday_time'] = $this->request->getPost('thursdayTime');
        $fields['friday_time'] = $this->request->getPost('fridayTime');
        $fields['createdDtm'] = $this->request->getPost('createdDtm');
        $fields['createdBy'] = $this->request->getPost('createdBy');
        $fields['updatedDtm'] = $this->request->getPost('updatedDtm');
        $fields['updatedBy'] = $this->request->getPost('updatedBy');
        $fields['deleted'] = $this->request->getPost('deleted');
        $fields['deletedRole'] = $this->request->getPost('deletedRole');


        $this->validation->setRules([
            'doc_id' => ['label' => 'Doc id', 'rules' => 'required|numeric|max_length[11]'],
            'saturday' => ['label' => 'Saturday', 'rules' => 'permit_empty'],
            'sunday' => ['label' => 'Sunday', 'rules' => 'permit_empty'],
            'monday' => ['label' => 'Monday', 'rules' => 'permit_empty'],
            'tuesday' => ['label' => 'Tuesday', 'rules' => 'permit_empty'],
            'wednesday' => ['label' => 'Wednesday', 'rules' => 'permit_empty'],
            'thursday' => ['label' => 'Thursday', 'rules' => 'permit_empty'],
            'friday' => ['label' => 'Friday', 'rules' => 'permit_empty'],
            'saturday_time' => ['label' => 'Saturday time', 'rules' => 'permit_empty'],
            'sunday_time' => ['label' => 'Sunday time', 'rules' => 'permit_empty'],
            'monday_time' => ['label' => 'Monday time', 'rules' => 'permit_empty'],
            'tuesday_time' => ['label' => 'Tuesday time', 'rules' => 'permit_empty'],
            'wednesday_time' => ['label' => 'Wednesday time', 'rules' => 'permit_empty'],
            'thursday_time' => ['label' => 'Thursday time', 'rules' => 'permit_empty'],
            'friday_time' => ['label' => 'Friday time', 'rules' => 'permit_empty'],
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

            if ($this->docavailabledayModel->update($fields['doc_avil_id'], $fields)) {
				
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
		
		$id = $this->request->getPost('doc_avil_id');
		
		if (!$this->validation->check($id, 'required|numeric')) {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
			
		} else {	
		
			if ($this->docavailabledayModel->where('doc_avil_id', $id)->delete()) {
								
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