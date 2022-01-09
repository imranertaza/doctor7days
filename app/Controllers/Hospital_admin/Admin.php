<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers\Hospital_admin;

use App\Controllers\BaseController;

use App\Models\Hospital_admin\AdminModel;
use App\Libraries\Permission;

class Admin extends BaseController
{
	
    protected $adminModel;
    protected $validation;
    protected $session;
    protected $permission;
    private $module_name = 'Admin';
	
	public function __construct()
	{
	    $this->adminModel = new AdminModel();
       	$this->validation =  \Config\Services::validation();
		$this->session = \Config\Services::session();
       	$this->permission = new Permission();
	}
	
	public function index()
	{
		$isLoggedIAdmin = $this->session->isLoggedIAdmin;
		$role_id = $this->session->AdminRole;

		if (isset($isLoggedIAdmin)) {
	    $data = [
                'controller'    	=> 'Hospital_admin/admin',
                'title'     		=> 'Admin'				
			];

            $perm = $this->permission->module_permission_list($role_id, $this->module_name);
            foreach ($perm as $key => $val) {
                $data[$key] = $this->permission->have_access($role_id, $this->module_name, $key);
            }

	    echo view('Hospital_admin/header');
	    echo view('Hospital_admin/sidebar');
	    if ($data['mod_access'] == 1) {
            	echo view('Hospital_admin/Admin/index', $data);
            }else {
            	echo view('Super_admin/No_permission', $data);
            }
	    
	    echo view('Hospital_admin/footer');
		//return view('hospital_admin/admin', $data);
		 }else {
    		return redirect()->to(site_url("/super_admin/login"));
    	}
			
	}

	public function getAll()
	{
 		$response = array();		
		
	    $data['data'] = array();
 
		$result = $this->adminModel->select('user_id, email, password, name, mobile, address, pic, country, ComName, role_id, createdBy, createdDtm, updatedBy, updatedDtm')->findAll();
		
		foreach ($result as $key => $value) {
							
			$ops = '<div class="btn-group">';
			$ops .= '	<button type="button" class="btn btn-sm btn-info" onclick="edit('. $value->user_id .')"><i class="fa fa-edit"></i></button>';
			$ops .= '	<button type="button" class="btn btn-sm btn-danger" onclick="remove('. $value->user_id .')"><i class="fa fa-trash"></i></button>';
			$ops .= '</div>';
			
			$data['data'][$key] = array(
				$value->user_id,
				$value->email,
				$value->password,
				$value->name,
				$value->mobile,
				$value->address,
				$value->pic,
				$value->country,
				$value->ComName,
				$value->role_id,
				$value->createdBy,
				$value->createdDtm,
				$value->updatedBy,
				$value->updatedDtm,

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
			
			$data = $this->adminModel->where('user_id' ,$id)->first();
			
			return $this->response->setJSON($data);	
				
		} else {
			
			throw new \CodeIgniter\Exceptions\PageNotFoundException();

		}	
		
	}	
	
	public function add()
	{

        $response = array();

        $fields['user_id'] = $this->request->getPost('userId');
        $fields['email'] = $this->request->getPost('email');
        $fields['password'] = $this->request->getPost('password');
        $fields['name'] = $this->request->getPost('name');
        $fields['mobile'] = $this->request->getPost('mobile');
        $fields['address'] = $this->request->getPost('address');
        $fields['pic'] = $this->request->getPost('pic');
        $fields['country'] = $this->request->getPost('country');
        $fields['ComName'] = $this->request->getPost('comName');
        $fields['role_id'] = $this->request->getPost('roleId');
        $fields['createdBy'] = $this->request->getPost('createdBy');
        $fields['createdDtm'] = $this->request->getPost('createdDtm');
        $fields['updatedBy'] = $this->request->getPost('updatedBy');
        $fields['updatedDtm'] = $this->request->getPost('updatedDtm');


        $this->validation->setRules([
            'email' => ['label' => 'Email', 'rules' => 'required|max_length[30]'],
            'password' => ['label' => 'Password', 'rules' => 'required|max_length[155]'],
            'name' => ['label' => 'Name', 'rules' => 'required|max_length[40]'],
            'mobile' => ['label' => 'Mobile', 'rules' => 'required|numeric|max_length[11]'],
            'address' => ['label' => 'Address', 'rules' => 'permit_empty'],
            'pic' => ['label' => 'Pic', 'rules' => 'permit_empty|max_length[100]'],
            'country' => ['label' => 'Country', 'rules' => 'permit_empty|max_length[155]'],
            'ComName' => ['label' => 'ComName', 'rules' => 'permit_empty|max_length[155]'],
            'role_id' => ['label' => 'Role id', 'rules' => 'required|numeric|max_length[11]'],
            'createdBy' => ['label' => 'CreatedBy', 'rules' => 'required|numeric|max_length[11]'],
            'createdDtm' => ['label' => 'CreatedDtm', 'rules' => 'required|valid_date'],
            'updatedBy' => ['label' => 'UpdatedBy', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'updatedDtm' => ['label' => 'UpdatedDtm', 'rules' => 'required|valid_date'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
            $response['messages'] = $this->validation->listErrors();
			
        } else {

            if ($this->adminModel->insert($fields)) {
												
                $response['success'] = true;
                $response['messages'] = 'Data has been inserted successfully';	
				
            } else {
				
                $response['success'] = false;
                $response['messages'] = 'Insertion error!';
				
            }
        }
		
        return $this->response->setJSON($response);
	}

	public function edit(){

        $response = array();
		
        $fields['user_id'] = $this->request->getPost('userId');
        $fields['email'] = $this->request->getPost('email');
        $fields['password'] = $this->request->getPost('password');
        $fields['name'] = $this->request->getPost('name');
        $fields['mobile'] = $this->request->getPost('mobile');
        $fields['address'] = $this->request->getPost('address');
        $fields['pic'] = $this->request->getPost('pic');
        $fields['country'] = $this->request->getPost('country');
        $fields['ComName'] = $this->request->getPost('comName');
        $fields['role_id'] = $this->request->getPost('roleId');
        $fields['createdBy'] = $this->request->getPost('createdBy');
        $fields['createdDtm'] = $this->request->getPost('createdDtm');
        $fields['updatedBy'] = $this->request->getPost('updatedBy');
        $fields['updatedDtm'] = $this->request->getPost('updatedDtm');


        $this->validation->setRules([
            'email' => ['label' => 'Email', 'rules' => 'required|max_length[30]'],
            'password' => ['label' => 'Password', 'rules' => 'required|max_length[155]'],
            'name' => ['label' => 'Name', 'rules' => 'required|max_length[40]'],
            'mobile' => ['label' => 'Mobile', 'rules' => 'required|numeric|max_length[11]'],
            'address' => ['label' => 'Address', 'rules' => 'permit_empty'],
            'pic' => ['label' => 'Pic', 'rules' => 'permit_empty|max_length[100]'],
            'country' => ['label' => 'Country', 'rules' => 'permit_empty|max_length[155]'],
            'ComName' => ['label' => 'ComName', 'rules' => 'permit_empty|max_length[155]'],
            'role_id' => ['label' => 'Role id', 'rules' => 'required|numeric|max_length[11]'],
            'createdBy' => ['label' => 'CreatedBy', 'rules' => 'required|numeric|max_length[11]'],
            'createdDtm' => ['label' => 'CreatedDtm', 'rules' => 'required|valid_date'],
            'updatedBy' => ['label' => 'UpdatedBy', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'updatedDtm' => ['label' => 'UpdatedDtm', 'rules' => 'required|valid_date'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
            $response['messages'] = $this->validation->listErrors();
			
        } else {

            if ($this->adminModel->update($fields['user_id'], $fields)) {
				
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
		
			if ($this->adminModel->where('user_id', $id)->delete()) {
								
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