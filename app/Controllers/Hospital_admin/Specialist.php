<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers\Hospital_admin;

use App\Controllers\BaseController;
use App\Libraries\Permission_hospital;
use App\Models\Hospital_admin\SpecialistModel;

class Specialist extends BaseController
{
	
    protected $specialistModel;
    protected $validation;
    protected $session;
    protected $permission;
    private $module_name = 'Specialist';
	
	public function __construct()
	{
	    $this->specialistModel = new SpecialistModel();
       	$this->validation =  \Config\Services::validation();
        $this->session = \Config\Services::session();
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
                'controller' => 'Hospital_admin/specialist',
                'title' => 'Specialist'
            ];

            $perm = $this->permission->module_permission_list($role_id, $this->module_name);
            foreach($perm as $key=>$val){
                 //print $key." ,";
                 $data[$key] = $this->permission->have_access($role_id, $this->module_name, $key);
                 print $data['mod_access'];
            }

            echo view('Hospital_admin/header');
            echo view('Hospital_admin/sidebar');
            if ($data['mod_access'] == 1) {
            	echo view('Hospital_admin/Specialist/specialist', $data);
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
 
		$result = $this->specialistModel->select('specialist_id, specialist_type_name, h_id, createdDtm, createdBy, updateDtm, updatedBy, deleted, deletedRole')->findAll();
		
		foreach ($result as $key => $value) {
							
			$ops = '<div class="btn-group">';
			$ops .= '	<button type="button" class="btn btn-sm btn-info" onclick="edit('. $value->specialist_id .')"><i class="fa fa-edit"></i></button>';
			$ops .= '	<button type="button" class="btn btn-sm btn-danger" onclick="remove('. $value->specialist_id .')"><i class="fa fa-trash"></i></button>';
			$ops .= '</div>';
			
			$data['data'][$key] = array(
				$value->specialist_id,
				$value->specialist_type_name,
//				$value->h_id,
//				$value->createdDtm,
//				$value->createdBy,
//				$value->updateDtm,
//				$value->updatedBy,
//				$value->deleted,
//				$value->deletedRole,

				$ops,
			);
		} 

		return $this->response->setJSON($data);		
	}
	
	public function getOne()
	{
 		$response = array();
		
		$id = $this->request->getPost('specialist_id');
		
		if ($this->validation->check($id, 'required|numeric')) {
			
			$data = $this->specialistModel->where('specialist_id' ,$id)->first();
			
			return $this->response->setJSON($data);	
				
		} else {
			
			throw new \CodeIgniter\Exceptions\PageNotFoundException();

		}	
		
	}	
	
	public function add()
	{

        $response = array();


        $fields['specialist_type_name'] = $this->request->getPost('specialistTypeName');
        $fields['h_id'] = '1';


        $this->validation->setRules([
            'specialist_type_name' => ['label' => 'Specialist type name', 'rules' => 'required|max_length[155]'],
        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
            $response['messages'] = $this->validation->listErrors();
			
        } else {

            if ($this->specialistModel->insert($fields)) {
												
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
		
        $fields['specialist_id'] = $this->request->getPost('specialistId');
        $fields['specialist_type_name'] = $this->request->getPost('specialistTypeName');


        $this->validation->setRules([
            'specialist_type_name' => ['label' => 'Specialist type name', 'rules' => 'required|max_length[155]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
            $response['messages'] = $this->validation->listErrors();
			
        } else {

            if ($this->specialistModel->update($fields['specialist_id'], $fields)) {
				
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
		
		$id = $this->request->getPost('specialist_id');
		
		if (!$this->validation->check($id, 'required|numeric')) {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
			
		} else {	
		
			if ($this->specialistModel->where('specialist_id', $id)->delete()) {
								
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