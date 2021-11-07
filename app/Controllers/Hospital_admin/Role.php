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
                'title' => 'Role',
                'permission' => json_decode($this->permission->hospital_all_permissions),
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

	public function update($id){

        $isLoggedInHospital = $this->session->isLoggedInHospital;
        $role_id = $this->session->hospitalAdminRole;
        if(!isset($isLoggedInHospital) || $isLoggedInHospital != TRUE)
        {
            echo view('Hospital_admin/Login/login');
        }
        else {
            $result = $this->roleModel->where('role_id' ,$id)->first();

            $data = [
                'controller' => 'Hospital_admin/role',
                'title' => 'Role',
                'role' => $result,
            ];

            $perm = $this->permission->module_permission_list($role_id, $this->module_name);
            foreach($perm as $key=>$val){
                $data[$key] = $this->permission->have_access($role_id, $this->module_name, $key);
            }


            echo view('Hospital_admin/header');
            echo view('Hospital_admin/sidebar');
            if ($data['update'] == 1) {
                echo view('Hospital_admin/Role/update', $data);
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
        $h_id = $this->session->h_Id;
		$result = $this->roleModel->select('role_id, h_id, role, permission, is_default, createdBy, createdDtm, updatedby, updatedDtm, deleted, deletedRole')->where('h_id',$h_id)->findAll();
		
		foreach ($result as $key => $value) {
							
			$ops = '<div class="btn-group">';
			$ops .= '<a href="'.base_url('Hospital_admin/Role/update/'.$value->role_id).'" type="button" class="btn btn-sm btn-info" ><i class="fa fa-edit"></i></a>';
			//$ops .= '	<button type="button" class="btn btn-sm btn-info" onclick="edit('. $value->role_id .')"><i class="fa fa-edit"></i></button>';
			$ops .= '	<button type="button" class="btn btn-sm btn-danger" onclick="remove('. $value->role_id .')"><i class="fa fa-trash"></i></button>';
			$ops .= '</div>';
			
			$data['data'][$key] = array(

				$value->role,
				$value->permission,

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

        $fields['h_id'] = $this->session->h_Id;
        $fields['role'] = $this->request->getPost('role');
        $perm = $this->request->getPost('permission[][]');

        $all_permissions = json_decode($this->permission->hospital_all_permissions);

        foreach($perm as $k =>$v){
            foreach ($v as $key => $value) {
                $all_permissions->$k->$key = $value;
            }
        }

        $fields['permission'] = json_encode($all_permissions);
        $fields['createdBy'] = $this->session->h_Id;

        $this->validation->setRules([
            'role' => ['label' => 'Role', 'rules' => 'required|max_length[30]'],
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

        $fields['role'] = $this->request->getPost('role');

        $perm = $this->request->getPost('permission[][]');

        $all_permissions = json_decode($this->permission->hospital_all_permissions);

        foreach($perm as $k =>$v){
            foreach ($v as $key => $value) {
                $all_permissions->$k->$key = $value;
            }
        }

        $fields['permission'] = json_encode($all_permissions);


        $this->validation->setRules([
            'role' => ['label' => 'Role', 'rules' => 'required|max_length[30]'],

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