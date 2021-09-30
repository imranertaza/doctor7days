<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers\Hospital_admin;

use App\Controllers\BaseController;

use App\Models\Hospital_admin\UsersModel;

class Users extends BaseController
{
	
    protected $usersModel;
    protected $validation;
    protected $session;

	public function __construct()
	{
	    $this->usersModel = new UsersModel();
       	$this->validation =  \Config\Services::validation();
        $this->session = \Config\Services::session();
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
                'controller' => 'Hospital_admin/users',
                'title' => 'Users'
            ];

            echo view('Hospital_admin/header');
            echo view('Hospital_admin/sidebar');
            echo view('Hospital_admin/Users/users', $data);
            echo view('Hospital_admin/footer');
        }
			
	}

	public function getAll()
	{
 		$response = array();		
		
	    $data['data'] = array();
 
		$result = $this->usersModel->select('user_id, h_id, email, password, name, mobile, global_address_id, pic, role_id, status, is_default, permission, createdBy, createdDtm, updatedBy, updatedDtm, deleted, deletedRole')->findAll();
		
		foreach ($result as $key => $value) {
							
			$ops = '<div class="btn-group">';
			$ops .= '	<button type="button" class="btn btn-sm btn-info" onclick="edit('. $value->user_id .')"><i class="fa fa-edit"></i></button>';
			$ops .= '	<button type="button" class="btn btn-sm btn-danger" onclick="remove('. $value->user_id .')"><i class="fa fa-trash"></i></button>';
			$ops .= '</div>';
			
			$data['data'][$key] = array(
				$value->user_id,
				$value->h_id,
				$value->email,
				$value->password,
				$value->name,
				$value->mobile,
				$value->global_address_id,
				$value->pic,
				$value->role_id,
				$value->status,
				$value->is_default,
				$value->permission,
				$value->createdBy,
				$value->createdDtm,
				$value->updatedBy,
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
		
		$id = $this->request->getPost('user_id');
		
		if ($this->validation->check($id, 'required|numeric')) {
			
			$data = $this->usersModel->where('user_id' ,$id)->first();
			
			return $this->response->setJSON($data);	
				
		} else {
			
			throw new \CodeIgniter\Exceptions\PageNotFoundException();

		}	
		
	}	
	
	public function add()
	{

        $response = array();

        $fields['user_id'] = $this->request->getPost('userId');
        $fields['h_id'] = $this->request->getPost('hId');
        $fields['email'] = $this->request->getPost('email');
        $fields['password'] = $this->request->getPost('password');
        $fields['name'] = $this->request->getPost('name');
        $fields['mobile'] = $this->request->getPost('mobile');
        $fields['global_address_id'] = $this->request->getPost('globalAddressId');
        $fields['pic'] = $this->request->getPost('pic');
        $fields['role_id'] = $this->request->getPost('roleId');
        $fields['status'] = $this->request->getPost('status');
        $fields['is_default'] = $this->request->getPost('isDefault');
        $fields['permission'] = $this->request->getPost('permission');
        $fields['createdBy'] = $this->request->getPost('createdBy');
        $fields['createdDtm'] = $this->request->getPost('createdDtm');
        $fields['updatedBy'] = $this->request->getPost('updatedBy');
        $fields['updatedDtm'] = $this->request->getPost('updatedDtm');
        $fields['deleted'] = $this->request->getPost('deleted');
        $fields['deletedRole'] = $this->request->getPost('deletedRole');


        $this->validation->setRules([
            'h_id' => ['label' => 'H id', 'rules' => 'required|numeric|max_length[11]'],
            'email' => ['label' => 'Email', 'rules' => 'required|max_length[30]'],
            'password' => ['label' => 'Password', 'rules' => 'required|max_length[155]'],
            'name' => ['label' => 'Name', 'rules' => 'required|max_length[40]'],
            'mobile' => ['label' => 'Mobile', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'global_address_id' => ['label' => 'Global address id', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'pic' => ['label' => 'Pic', 'rules' => 'required|max_length[100]'],
            'role_id' => ['label' => 'Role id', 'rules' => 'required|numeric|max_length[11]'],
            'status' => ['label' => 'Status', 'rules' => 'required'],
            'is_default' => ['label' => 'Is default', 'rules' => 'required'],
            'permission' => ['label' => 'Permission', 'rules' => 'required'],
            'createdBy' => ['label' => 'CreatedBy', 'rules' => 'required|numeric|max_length[11]'],
            'createdDtm' => ['label' => 'CreatedDtm', 'rules' => 'required|valid_date'],
            'updatedBy' => ['label' => 'UpdatedBy', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'updatedDtm' => ['label' => 'UpdatedDtm', 'rules' => 'required|valid_date'],
            'deleted' => ['label' => 'Deleted', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'deletedRole' => ['label' => 'DeletedRole', 'rules' => 'permit_empty|numeric|max_length[11]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
            $response['messages'] = $this->validation->listErrors();
			
        } else {

            if ($this->usersModel->insert($fields)) {
												
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
		
        $fields['user_id'] = $this->request->getPost('userId');
        $fields['h_id'] = $this->request->getPost('hId');
        $fields['email'] = $this->request->getPost('email');
        $fields['password'] = $this->request->getPost('password');
        $fields['name'] = $this->request->getPost('name');
        $fields['mobile'] = $this->request->getPost('mobile');
        $fields['global_address_id'] = $this->request->getPost('globalAddressId');
        $fields['pic'] = $this->request->getPost('pic');
        $fields['role_id'] = $this->request->getPost('roleId');
        $fields['status'] = $this->request->getPost('status');
        $fields['is_default'] = $this->request->getPost('isDefault');
        $fields['permission'] = $this->request->getPost('permission');
        $fields['createdBy'] = $this->request->getPost('createdBy');
        $fields['createdDtm'] = $this->request->getPost('createdDtm');
        $fields['updatedBy'] = $this->request->getPost('updatedBy');
        $fields['updatedDtm'] = $this->request->getPost('updatedDtm');
        $fields['deleted'] = $this->request->getPost('deleted');
        $fields['deletedRole'] = $this->request->getPost('deletedRole');


        $this->validation->setRules([
            'h_id' => ['label' => 'H id', 'rules' => 'required|numeric|max_length[11]'],
            'email' => ['label' => 'Email', 'rules' => 'required|max_length[30]'],
            'password' => ['label' => 'Password', 'rules' => 'required|max_length[155]'],
            'name' => ['label' => 'Name', 'rules' => 'required|max_length[40]'],
            'mobile' => ['label' => 'Mobile', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'global_address_id' => ['label' => 'Global address id', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'pic' => ['label' => 'Pic', 'rules' => 'required|max_length[100]'],
            'role_id' => ['label' => 'Role id', 'rules' => 'required|numeric|max_length[11]'],
            'status' => ['label' => 'Status', 'rules' => 'required'],
            'is_default' => ['label' => 'Is default', 'rules' => 'required'],
            'permission' => ['label' => 'Permission', 'rules' => 'required'],
            'createdBy' => ['label' => 'CreatedBy', 'rules' => 'required|numeric|max_length[11]'],
            'createdDtm' => ['label' => 'CreatedDtm', 'rules' => 'required|valid_date'],
            'updatedBy' => ['label' => 'UpdatedBy', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'updatedDtm' => ['label' => 'UpdatedDtm', 'rules' => 'required|valid_date'],
            'deleted' => ['label' => 'Deleted', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'deletedRole' => ['label' => 'DeletedRole', 'rules' => 'permit_empty|numeric|max_length[11]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
            $response['messages'] = $this->validation->listErrors();
			
        } else {

            if ($this->usersModel->update($fields['user_id'], $fields)) {
				
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
		
		$id = $this->request->getPost('user_id');
		
		if (!$this->validation->check($id, 'required|numeric')) {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
			
		} else {	
		
			if ($this->usersModel->where('user_id', $id)->delete()) {
								
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