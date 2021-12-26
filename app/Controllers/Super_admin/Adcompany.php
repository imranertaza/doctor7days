<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers\Super_admin;

use App\Controllers\BaseController;

use App\Models\Super_admin\AdcompanyModel;
use App\Models\Super_admin\AdmanageModel;
use App\Libraries\Permission;

class Adcompany extends BaseController
{
	
    protected $admanageModel;
    protected $adcompanyModel;
    protected $validation;
    protected $session;
    protected $permission;
    private $module_name = 'Admanage';
	
	public function __construct()
	{
	    $this->admanageModel = new AdmanageModel();
	    $this->adcompanyModel = new AdcompanyModel();
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
	                'controller'    	=> 'Super_admin/Adcompany',
	                'title'     		=> 'Ad Company'
				];


			$perm = $this->permission->module_permission_list($role_id, $this->module_name);
            foreach($perm as $key=>$val){
                 $data[$key] = $this->permission->have_access($role_id, $this->module_name, $key);
            }

	        echo view('Super_admin/header');
	        echo view('Super_admin/sidebar');
	        if ($data['mod_access'] == 1) {
            	echo view('Super_admin/Adcompany/adcompany', $data);
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
 
		$result = $this->adcompanyModel->findAll();
		
		foreach ($result as $key => $value) {
							
			$ops = '<div class="btn-group">';
			$ops .= '	<button type="button" class="btn btn-sm btn-info" onclick="edit('. $value->ad_com_id .')"><i class="fa fa-edit"></i></button>';
			$ops .= '	<button type="button" class="btn btn-sm btn-danger" onclick="remove('. $value->ad_com_id .')"><i class="fa fa-trash"></i></button>';
			$ops .= '</div>';
			
			$data['data'][$key] = array(
				$value->ad_com_id,
				$value->com_name,
				$value->com_email,
				$value->contact_phone,
				$value->contact_name,
				$value->NID,
				$value->TIN,
				$value->BIN,
				$value->trade_license,
				$value->org_type,

				$ops,
			);
		} 

		return $this->response->setJSON($data);		
	}
	
	public function getOne()
	{
 		$response = array();
		
		$id = $this->request->getPost('ad_com_id');
		
		if ($this->validation->check($id, 'required|numeric')) {
			
			$data = $this->adcompanyModel->where('ad_com_id' ,$id)->first();
			
			return $this->response->setJSON($data);	
				
		} else {
			
			throw new \CodeIgniter\Exceptions\PageNotFoundException();

		}	
		
	}	
	
	public function add()
	{

        $response = array();

        $fields['com_name'] = $this->request->getPost('com_name');
        $fields['com_address'] = $this->request->getPost('com_address');
        $fields['com_email'] = $this->request->getPost('com_email');
        $fields['contact_name'] = $this->request->getPost('contact_name');
        $fields['contact_phone'] = $this->request->getPost('contact_phone');
        $fields['NID'] = $this->request->getPost('NID');
        $fields['TIN'] = $this->request->getPost('TIN');
        $fields['BIN'] = $this->request->getPost('BIN');
        $fields['trade_license'] = $this->request->getPost('trade_license');
        $fields['org_type'] = $this->request->getPost('org_type');


        $this->validation->setRules([
            'com_name' => ['label' => 'com_name', 'rules' => 'required'],
            'com_address' => ['label' => 'com_address', 'rules' => 'required'],
            'com_email' => ['label' => 'com_email', 'rules' => 'required'],
            'contact_name' => ['label' => 'contact_name', 'rules' => 'required'],
            'contact_phone' => ['label' => 'contact_phone', 'rules' => 'required'],
            'NID' => ['label' => 'NID', 'rules' => 'required'],
            'TIN' => ['label' => 'TIN', 'rules' => 'required'],
            'BIN' => ['label' => 'BIN', 'rules' => 'required'],
            'trade_license' => ['label' => 'trade_license', 'rules' => 'required'],
            'org_type' => ['label' => 'org_type', 'rules' => 'required'],
        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
            $response['messages'] = $this->validation->listErrors();
			
        } else {

            if ($this->adcompanyModel->insert($fields)) {
												
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
		
        $fields['ad_com_id'] = $this->request->getPost('ad_com_id');
        $fields['com_name'] = $this->request->getPost('com_name');
        $fields['com_address'] = $this->request->getPost('com_address');
        $fields['com_email'] = $this->request->getPost('com_email');
        $fields['contact_name'] = $this->request->getPost('contact_name');
        $fields['contact_phone'] = $this->request->getPost('contact_phone');
        $fields['NID'] = $this->request->getPost('NID');
        $fields['TIN'] = $this->request->getPost('TIN');
        $fields['BIN'] = $this->request->getPost('BIN');
        $fields['trade_license'] = $this->request->getPost('trade_license');
        $fields['org_type'] = $this->request->getPost('org_type');


        $this->validation->setRules([
            'com_name' => ['label' => 'com_name', 'rules' => 'required'],
            'com_address' => ['label' => 'com_address', 'rules' => 'required'],
            'com_email' => ['label' => 'com_email', 'rules' => 'required'],
            'contact_name' => ['label' => 'contact_name', 'rules' => 'required'],
            'contact_phone' => ['label' => 'contact_phone', 'rules' => 'required'],
            'NID' => ['label' => 'NID', 'rules' => 'required'],
            'TIN' => ['label' => 'TIN', 'rules' => 'required'],
            'BIN' => ['label' => 'BIN', 'rules' => 'required'],
            'trade_license' => ['label' => 'trade_license', 'rules' => 'required'],
            'org_type' => ['label' => 'org_type', 'rules' => 'required'],
        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
            $response['messages'] = $this->validation->listErrors();
			
        } else {

            if ($this->adcompanyModel->update($fields['ad_com_id'], $fields)) {
				
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
		
		$id = $this->request->getPost('ad_com_id');
		
		if (!$this->validation->check($id, 'required|numeric')) {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
			
		} else {	
		
			if ($this->adcompanyModel->where('ad_com_id', $id)->delete()) {
								
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