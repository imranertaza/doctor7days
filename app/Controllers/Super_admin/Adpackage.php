<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers\Super_admin;

use App\Controllers\BaseController;

use App\Models\Super_admin\AdcompanyModel;
use App\Models\Super_admin\AdmanageModel;
use App\Libraries\Permission;
use App\Models\Super_admin\AdpackageModel;
use App\Models\Super_admin\AdplaceModel;

class Adpackage extends BaseController
{
	
    protected $admanageModel;
    protected $adcompanyModel;
    protected $adpackageModel;
    protected $adplaceModel;
    protected $validation;
    protected $session;
    protected $permission;
    private $module_name = 'Admanage';
	
	public function __construct()
	{
	    $this->admanageModel = new AdmanageModel();
	    $this->adcompanyModel = new AdcompanyModel();
	    $this->adpackageModel = new AdpackageModel();
	    $this->adplaceModel = new AdplaceModel();
       	$this->validation =  \Config\Services::validation();
       	$this->session = \Config\Services::session();
       	$this->permission = new Permission();
		
	}
	
	public function index()
	{
		$isLoggedIAdmin = $this->session->isLoggedIAdmin;
		$role_id = $this->session->AdminRole;

		if (isset($isLoggedIAdmin)) {

		    $place = $this->adplaceModel->findAll();

		    $data = [
	                'controller'    	=> 'Super_admin/Adpackage',
	                'title'     		=> 'Ad Company',
	                'adplace'     		=> $place,
				];


			$perm = $this->permission->module_permission_list($role_id, $this->module_name);
            foreach($perm as $key=>$val){
                 $data[$key] = $this->permission->have_access($role_id, $this->module_name, $key);
            }

	        echo view('Super_admin/header');
	        echo view('Super_admin/sidebar');
	        if ($data['mod_access'] == 1) {
            	echo view('Super_admin/Adpackage/adpackage', $data);
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
 
		$result = $this->adpackageModel->findAll();
		
		foreach ($result as $key => $value) {
							
			$ops = '<div class="btn-group">';
			$ops .= '	<button type="button" class="btn btn-sm btn-info" onclick="edit('. $value->ad_package_id .')"><i class="fa fa-edit"></i></button>';
			$ops .= '	<button type="button" class="btn btn-sm btn-danger" onclick="remove('. $value->ad_package_id .')"><i class="fa fa-trash"></i></button>';
			$ops .= '</div>';
			
			$data['data'][$key] = array(
				$value->ad_package_id,
				$value->name,
				$value->org_type,
				$value->total_views,
				$value->size_width,
				$value->size_hight,
				$value->weight,
				$value->price,
				$value->price_recurring,

				$ops,
			);
		} 

		return $this->response->setJSON($data);		
	}
	
	public function getOne()
	{
 		$response = array();
		
		$id = $this->request->getPost('ad_package_id');
		
		if ($this->validation->check($id, 'required|numeric')) {
			
			$data = $this->adpackageModel->where('ad_package_id' ,$id)->first();
			
			return $this->response->setJSON($data);	
				
		} else {
			
			throw new \CodeIgniter\Exceptions\PageNotFoundException();

		}	
		
	}	
	
	public function add()
	{

        $response = array();

        $fields['org_type'] = $this->request->getPost('org_type');
        $fields['total_views'] = $this->request->getPost('total_views');
        $fields['size_width'] = $this->request->getPost('size_width');
        $fields['size_hight'] = $this->request->getPost('size_hight');
        $fields['name'] = $this->request->getPost('name');
        $fields['weight'] = $this->request->getPost('weight');
        $fields['price'] = $this->request->getPost('price');
        $fields['price_recurring'] = $this->request->getPost('price_recurring');


        $this->validation->setRules([
            'org_type' => ['label' => 'org_type', 'rules' => 'required'],
            'total_views' => ['label' => 'total_views', 'rules' => 'required'],
            'size_width' => ['label' => 'size_width', 'rules' => 'required'],
            'size_hight' => ['label' => 'size_hight', 'rules' => 'required'],
            'name' => ['label' => 'name', 'rules' => 'required'],
            'weight' => ['label' => 'weight', 'rules' => 'required'],
            'price' => ['label' => 'price', 'rules' => 'required'],
            'price_recurring' => ['label' => 'price_recurring', 'rules' => 'required'],
        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
            $response['messages'] = $this->validation->listErrors();
			
        } else {

            if ($this->adpackageModel->insert($fields)) {
												
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
		
        $fields['ad_package_id'] = $this->request->getPost('ad_package_id');
        $fields['org_type'] = $this->request->getPost('org_type');
        $fields['total_views'] = $this->request->getPost('total_views');
        $fields['size_width'] = $this->request->getPost('size_width');
        $fields['size_hight'] = $this->request->getPost('size_hight');
        $fields['name'] = $this->request->getPost('name');
        $fields['weight'] = $this->request->getPost('weight');
        $fields['price'] = $this->request->getPost('price');
        $fields['price_recurring'] = $this->request->getPost('price_recurring');

        $this->validation->setRules([
            'org_type' => ['label' => 'org_type', 'rules' => 'required'],
            'total_views' => ['label' => 'total_views', 'rules' => 'required'],
            'size_width' => ['label' => 'size_width', 'rules' => 'required'],
            'size_hight' => ['label' => 'size_hight', 'rules' => 'required'],
            'name' => ['label' => 'name', 'rules' => 'required'],
            'weight' => ['label' => 'weight', 'rules' => 'required'],
            'price' => ['label' => 'price', 'rules' => 'required'],
            'price_recurring' => ['label' => 'price_recurring', 'rules' => 'required'],
        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
            $response['messages'] = $this->validation->listErrors();
			
        } else {
            if ($this->adpackageModel->update($fields['ad_package_id'], $fields)) {
				
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
		
		$id = $this->request->getPost('ad_package_id');
		
		if (!$this->validation->check($id, 'required|numeric')) {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
			
		} else {	
		
			if ($this->adpackageModel->where('ad_package_id', $id)->delete()) {
								
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