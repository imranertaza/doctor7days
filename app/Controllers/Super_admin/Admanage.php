<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers\Super_admin;

use App\Controllers\BaseController;

use App\Models\Super_admin\AdmanageModel;
use App\Libraries\Permission;

class Admanage extends BaseController
{
	
    protected $admanageModel;
    protected $validation;
    protected $session;
    protected $permission;
    private $module_name = 'Admanage';
	
	public function __construct()
	{
	    $this->admanageModel = new AdmanageModel();
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
	                'controller'    	=> 'Super_admin/admanage',
	                'title'     		=> 'Ad Manage'				
				];


			$perm = $this->permission->module_permission_list($role_id, $this->module_name);
            foreach($perm as $key=>$val){
                 $data[$key] = $this->permission->have_access($role_id, $this->module_name, $key);
            }

	        echo view('Super_admin/header');
	        echo view('Super_admin/sidebar');
	        if ($data['mod_access'] == 1) {
            	echo view('Super_admin/Admanage/admanage', $data);
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
 
		$result = $this->admanageModel->select('ad_id, title, image, position, width, height, status, expire_date, price, paid_status, createdDtm, createdBy, updatedDtm, updatedBy, deleted, deletedRole')->findAll();
		
		foreach ($result as $key => $value) {
							
			$ops = '<div class="btn-group">';
			$ops .= '	<button type="button" class="btn btn-sm btn-info" onclick="edit('. $value->ad_id .')"><i class="fa fa-edit"></i></button>';
			$ops .= '	<button type="button" class="btn btn-sm btn-danger" onclick="remove('. $value->ad_id .')"><i class="fa fa-trash"></i></button>';
			$ops .= '</div>';
			
			$data['data'][$key] = array(
				$value->ad_id,
				$value->title,
				$value->image,
				$value->position,
				$value->width,
				$value->height,
				$value->status,
				$value->expire_date,
				$value->price,
				$value->paid_status,

				$ops,
			);
		} 

		return $this->response->setJSON($data);		
	}
	
	public function getOne()
	{
 		$response = array();
		
		$id = $this->request->getPost('ad_id');
		
		if ($this->validation->check($id, 'required|numeric')) {
			
			$data = $this->admanageModel->where('ad_id' ,$id)->first();
			
			return $this->response->setJSON($data);	
				
		} else {
			
			throw new \CodeIgniter\Exceptions\PageNotFoundException();

		}	
		
	}	
	
	public function add()
	{

        $response = array();

        $fields['ad_id'] = $this->request->getPost('adId');
        $fields['title'] = $this->request->getPost('title');
        $fields['image'] = $this->request->getPost('image');
        $fields['position'] = $this->request->getPost('position');
        $fields['width'] = $this->request->getPost('width');
        $fields['height'] = $this->request->getPost('height');
        $fields['status'] = $this->request->getPost('status');
        $fields['expire_date'] = $this->request->getPost('expireDate');
        $fields['price'] = $this->request->getPost('price');
        $fields['paid_status'] = $this->request->getPost('paidStatus');
        $fields['createdDtm'] = $this->request->getPost('createdDtm');
        $fields['createdBy'] = $this->request->getPost('createdBy');
        $fields['updatedDtm'] = $this->request->getPost('updatedDtm');
        $fields['updatedBy'] = $this->request->getPost('updatedBy');
        $fields['deleted'] = $this->request->getPost('deleted');
        $fields['deletedRole'] = $this->request->getPost('deletedRole');


        $this->validation->setRules([
            'title' => ['label' => 'Title', 'rules' => 'required|max_length[155]'],
            'image' => ['label' => 'Image', 'rules' => 'required|max_length[155]'],
            'position' => ['label' => 'Position', 'rules' => 'required'],
            'width' => ['label' => 'Width', 'rules' => 'required|max_length[155]'],
            'height' => ['label' => 'Height', 'rules' => 'required|max_length[155]'],
            'status' => ['label' => 'Status', 'rules' => 'required'],
            'expire_date' => ['label' => 'Expire date', 'rules' => 'required|valid_date'],
            'price' => ['label' => 'Price', 'rules' => 'required|numeric|max_length[11]'],
            'paid_status' => ['label' => 'Paid status', 'rules' => 'required'],
            'createdDtm' => ['label' => 'CreatedDtm', 'rules' => 'required'],
            'createdBy' => ['label' => 'CreatedBy', 'rules' => 'required|numeric|max_length[11]'],
            'updatedDtm' => ['label' => 'UpdatedDtm', 'rules' => 'permit_empty'],
            'updatedBy' => ['label' => 'UpdatedBy', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'deleted' => ['label' => 'Deleted', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'deletedRole' => ['label' => 'DeletedRole', 'rules' => 'permit_empty|numeric|max_length[11]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
            $response['messages'] = $this->validation->listErrors();
			
        } else {

            if ($this->admanageModel->insert($fields)) {
												
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
		
        $fields['ad_id'] = $this->request->getPost('adId');
        $fields['title'] = $this->request->getPost('title');
        $fields['image'] = $this->request->getPost('image');
        $fields['position'] = $this->request->getPost('position');
        $fields['width'] = $this->request->getPost('width');
        $fields['height'] = $this->request->getPost('height');
        $fields['status'] = $this->request->getPost('status');
        $fields['expire_date'] = $this->request->getPost('expireDate');
        $fields['price'] = $this->request->getPost('price');
        $fields['paid_status'] = $this->request->getPost('paidStatus');
        $fields['createdDtm'] = $this->request->getPost('createdDtm');
        $fields['createdBy'] = $this->request->getPost('createdBy');
        $fields['updatedDtm'] = $this->request->getPost('updatedDtm');
        $fields['updatedBy'] = $this->request->getPost('updatedBy');
        $fields['deleted'] = $this->request->getPost('deleted');
        $fields['deletedRole'] = $this->request->getPost('deletedRole');


        $this->validation->setRules([
            'title' => ['label' => 'Title', 'rules' => 'required|max_length[155]'],
            'image' => ['label' => 'Image', 'rules' => 'required|max_length[155]'],
            'position' => ['label' => 'Position', 'rules' => 'required'],
            'width' => ['label' => 'Width', 'rules' => 'required|max_length[155]'],
            'height' => ['label' => 'Height', 'rules' => 'required|max_length[155]'],
            'status' => ['label' => 'Status', 'rules' => 'required'],
            'expire_date' => ['label' => 'Expire date', 'rules' => 'required|valid_date'],
            'price' => ['label' => 'Price', 'rules' => 'required|numeric|max_length[11]'],
            'paid_status' => ['label' => 'Paid status', 'rules' => 'required'],
            'createdDtm' => ['label' => 'CreatedDtm', 'rules' => 'required'],
            'createdBy' => ['label' => 'CreatedBy', 'rules' => 'required|numeric|max_length[11]'],
            'updatedDtm' => ['label' => 'UpdatedDtm', 'rules' => 'permit_empty'],
            'updatedBy' => ['label' => 'UpdatedBy', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'deleted' => ['label' => 'Deleted', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'deletedRole' => ['label' => 'DeletedRole', 'rules' => 'permit_empty|numeric|max_length[11]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
            $response['messages'] = $this->validation->listErrors();
			
        } else {

            if ($this->admanageModel->update($fields['ad_id'], $fields)) {
				
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
		
		$id = $this->request->getPost('ad_id');
		
		if (!$this->validation->check($id, 'required|numeric')) {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
			
		} else {	
		
			if ($this->admanageModel->where('ad_id', $id)->delete()) {
								
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