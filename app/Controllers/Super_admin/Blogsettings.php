<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers\Super_admin;

use App\Controllers\BaseController;

use App\Models\Super_admin\BlogsettingsModel;
use App\Libraries\Permission;

class Blogsettings extends BaseController
{
	
    protected $blogsettingsModel;
    protected $validation;
    protected $session;
    protected $permission;
    private $module_name = 'Blogsettings';
	
	public function __construct()
	{
	    $this->blogsettingsModel = new BlogsettingsModel();
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
                'controller'    	=> 'Super_admin/blogsettings',
                'title'     		=> 'Blog Settings'				
			];
		$perm = $this->permission->module_permission_list($role_id, $this->module_name);
            foreach($perm as $key=>$val){
                 $data[$key] = $this->permission->have_access($role_id, $this->module_name, $key);
            }

        echo view('Super_admin/header');
        echo view('Super_admin/sidebar');
        if ($data['mod_access'] == 1) {
            	echo view('Super_admin/Blogsettings/blogsettings', $data);
            }else {
            	echo view('Super_admin/No_permission', $data);
            }
		
        echo view('Super_admin/footer');
        }else {
    		return redirect()->to(site_url("/super_admin/login"));
    	}
			
	}

	public function getAll()
	{
 		$response = array();		
		
	    $data['data'] = array();
 
		$result = $this->blogsettingsModel->select('blog_settings_id, blog_title, blog_logo, createdDtm, createdBy, updatedDtm, updatedBy, deleted, deletedRole')->findAll();
		
		foreach ($result as $key => $value) {
							
			$ops = '<div class="btn-group">';
			$ops .= '	<button type="button" class="btn btn-sm btn-info" onclick="edit('. $value->blog_settings_id .')"><i class="fa fa-edit"></i></button>';
			$ops .= '	<button type="button" class="btn btn-sm btn-danger" onclick="remove('. $value->blog_settings_id .')"><i class="fa fa-trash"></i></button>';
			$ops .= '</div>';
			
			$data['data'][$key] = array(
				$value->blog_settings_id,
				$value->blog_title,
				$value->blog_logo,

				$ops,
			);
		} 

		return $this->response->setJSON($data);		
	}
	
	public function getOne()
	{
 		$response = array();
		
		$id = $this->request->getPost('blog_settings_id');
		
		if ($this->validation->check($id, 'required|numeric')) {
			
			$data = $this->blogsettingsModel->where('blog_settings_id' ,$id)->first();
			
			return $this->response->setJSON($data);	
				
		} else {
			
			throw new \CodeIgniter\Exceptions\PageNotFoundException();

		}	
		
	}	
	
	public function add()
	{

        $response = array();

        $fields['blog_settings_id'] = $this->request->getPost('blogSettingsId');
        $fields['blog_title'] = $this->request->getPost('blogTitle');
        $fields['blog_logo'] = $this->request->getPost('blogLogo');
        $fields['createdDtm'] = $this->request->getPost('createdDtm');
        $fields['createdBy'] = $this->request->getPost('createdBy');
        $fields['updatedDtm'] = $this->request->getPost('updatedDtm');
        $fields['updatedBy'] = $this->request->getPost('updatedBy');
        $fields['deleted'] = $this->request->getPost('deleted');
        $fields['deletedRole'] = $this->request->getPost('deletedRole');


        $this->validation->setRules([
            'blog_title' => ['label' => 'Blog title', 'rules' => 'required|max_length[155]'],
            'blog_logo' => ['label' => 'Blog logo', 'rules' => 'required|max_length[155]'],
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

            if ($this->blogsettingsModel->insert($fields)) {
												
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
		
        $fields['blog_settings_id'] = $this->request->getPost('blogSettingsId');
        $fields['blog_title'] = $this->request->getPost('blogTitle');
        $fields['blog_logo'] = $this->request->getPost('blogLogo');
        $fields['createdDtm'] = $this->request->getPost('createdDtm');
        $fields['createdBy'] = $this->request->getPost('createdBy');
        $fields['updatedDtm'] = $this->request->getPost('updatedDtm');
        $fields['updatedBy'] = $this->request->getPost('updatedBy');
        $fields['deleted'] = $this->request->getPost('deleted');
        $fields['deletedRole'] = $this->request->getPost('deletedRole');


        $this->validation->setRules([
            'blog_title' => ['label' => 'Blog title', 'rules' => 'required|max_length[155]'],
            'blog_logo' => ['label' => 'Blog logo', 'rules' => 'required|max_length[155]'],
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

            if ($this->blogsettingsModel->update($fields['blog_settings_id'], $fields)) {
				
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
		
		$id = $this->request->getPost('blog_settings_id');
		
		if (!$this->validation->check($id, 'required|numeric')) {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
			
		} else {	
		
			if ($this->blogsettingsModel->where('blog_settings_id', $id)->delete()) {
								
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