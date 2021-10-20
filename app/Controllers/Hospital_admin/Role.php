<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers\Hospital_admin;

use App\Controllers\BaseController;
use App\Libraries\Permission_hospital;
use App\Models\Hospital_admin\RoleModel;

class Role extends BaseController
{
	
    protected $roleModel;
    protected $validation;
    protected $session;
    protected $permission;
    private $module_name = 'Role';
	
	public function __construct()
	{
	    $this->roleModel = new RoleModel();
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
                'controller' => 'Hospital_admin/role',
                'title' => 'Role'
            ];

            $perm = $this->permission->module_permission_list($role_id, $this->module_name);
            foreach($perm as $key=>$val){
                 $data[$key] = $this->permission->have_access($role_id, $this->module_name, $key);
            }


            echo view('Hospital_admin/header');
            echo view('Hospital_admin/sidebar');
            if ($data['mod_access'] == 1) {
            	echo view('Hospital_admin/Role/role', $data);
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
 
		$result = $this->roleModel->select('role_id, h_id, role, permission, is_default, createdBy, createdDtm, updatedby, updatedDtm, deleted, deletedRole')->findAll();
		
		foreach ($result as $key => $value) {
							
			$ops = '<div class="btn-group">';
			$ops .= '	<button type="button" class="btn btn-sm btn-info" onclick="edit('. $value->role_id .')"><i class="fa fa-edit"></i></button>';
			$ops .= '	<button type="button" class="btn btn-sm btn-danger" onclick="remove('. $value->role_id .')"><i class="fa fa-trash"></i></button>';
			$ops .= '</div>';
			
			$data['data'][$key] = array(
				$value->role_id,
				$value->h_id,
				$value->role,
				$value->permission,
				$value->is_default,
				$value->createdBy,
				$value->createdDtm,
				$value->updatedby,
				$value->updatedDtm,
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
		
		$id = $this->request->getPost('role_id');
		
		if ($this->validation->check($id, 'required|numeric')) {
			
			$data = $this->roleModel->where('role_id' ,$id)->first();
			
			return $this->response->setJSON($data);	
				
		} else {
			
			throw new \CodeIgniter\Exceptions\PageNotFoundException();

		}	
		
	}	
	
	public function add()
	{

        $response = array();

        $fields['role_id'] = $this->request->getPost('roleId');
        $fields['h_id'] = $this->request->getPost('hId');
        $fields['role'] = $this->request->getPost('role');
        $fields['permission'] = $this->request->getPost('permission');
        $fields['is_default'] = $this->request->getPost('isDefault');
        $fields['createdBy'] = $this->request->getPost('createdBy');
        $fields['createdDtm'] = $this->request->getPost('createdDtm');
        $fields['updatedby'] = $this->request->getPost('updatedby');
        $fields['updatedDtm'] = $this->request->getPost('updatedDtm');
        $fields['deleted'] = $this->request->getPost('deleted');
        $fields['deletedRole'] = $this->request->getPost('deletedRole');


        $this->validation->setRules([
            'h_id' => ['label' => 'H id', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'role' => ['label' => 'Role', 'rules' => 'required|max_length[30]'],
            'permission' => ['label' => 'Permission', 'rules' => 'required'],
            'is_default' => ['label' => 'Is default', 'rules' => 'required'],
            'createdBy' => ['label' => 'CreatedBy', 'rules' => 'required|numeric|max_length[11]'],
            'createdDtm' => ['label' => 'CreatedDtm', 'rules' => 'required|valid_date'],
            'updatedby' => ['label' => 'Updatedby', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'updatedDtm' => ['label' => 'UpdatedDtm', 'rules' => 'required|valid_date'],
            'deleted' => ['label' => 'Deleted', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'deletedRole' => ['label' => 'DeletedRole', 'rules' => 'permit_empty|numeric|max_length[11]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
            $response['messages'] = $this->validation->listErrors();
			
        } else {

            if ($this->roleModel->insert($fields)) {
												
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
		
        $fields['role_id'] = $this->request->getPost('roleId');
        $fields['h_id'] = $this->request->getPost('hId');
        $fields['role'] = $this->request->getPost('role');
        $fields['permission'] = $this->request->getPost('permission');
        $fields['is_default'] = $this->request->getPost('isDefault');
        $fields['createdBy'] = $this->request->getPost('createdBy');
        $fields['createdDtm'] = $this->request->getPost('createdDtm');
        $fields['updatedby'] = $this->request->getPost('updatedby');
        $fields['updatedDtm'] = $this->request->getPost('updatedDtm');
        $fields['deleted'] = $this->request->getPost('deleted');
        $fields['deletedRole'] = $this->request->getPost('deletedRole');


        $this->validation->setRules([
            'h_id' => ['label' => 'H id', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'role' => ['label' => 'Role', 'rules' => 'required|max_length[30]'],
            'permission' => ['label' => 'Permission', 'rules' => 'required'],
            'is_default' => ['label' => 'Is default', 'rules' => 'required'],
            'createdBy' => ['label' => 'CreatedBy', 'rules' => 'required|numeric|max_length[11]'],
            'createdDtm' => ['label' => 'CreatedDtm', 'rules' => 'required|valid_date'],
            'updatedby' => ['label' => 'Updatedby', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'updatedDtm' => ['label' => 'UpdatedDtm', 'rules' => 'required|valid_date'],
            'deleted' => ['label' => 'Deleted', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'deletedRole' => ['label' => 'DeletedRole', 'rules' => 'permit_empty|numeric|max_length[11]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
            $response['messages'] = $this->validation->listErrors();
			
        } else {

            if ($this->roleModel->update($fields['role_id'], $fields)) {
				
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
		
		$id = $this->request->getPost('role_id');
		
		if (!$this->validation->check($id, 'required|numeric')) {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
			
		} else {	
		
			if ($this->roleModel->where('role_id', $id)->delete()) {
								
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