<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers\Super_admin;

use App\Controllers\BaseController;
use App\Libraries\Permission;
use App\Models\Mobile_app\HospitalModel;
use App\Models\Super_admin\LicenseModel;



class License extends BaseController
{
	
    protected $hospitalModel;
    protected $validation;
    protected $licenseModel;
   
    protected $session;
    protected $permission;
    private $module_name = 'License';
	public function __construct()
	{
        $this->session = \Config\Services::session();
	    $this->hospitalModel = new HospitalModel();
	    $this->licenseModel = new LicenseModel();
       	$this->validation =  \Config\Services::validation();
        $this->permission = new Permission;
		
	}
	
	public function index()
	{

        $isLoggedIAdmin = $this->session->isLoggedIAdmin;
        $role_id = $this->session->AdminRole;

        if (isset($isLoggedIAdmin)) {

            $hospital = $this->hospitalModel->findAll();

            $data = [
                'controller'    	=> 'Super_admin/License',
                'title'     		=> 'License',
                'hospital'     		=> $hospital,
            ];


            $perm = $this->permission->module_permission_list($role_id, $this->module_name);
            foreach($perm as $key=>$val){
                $data[$key] = $this->permission->have_access($role_id, $this->module_name, $key);
            }

            echo view('Super_admin/header');
            echo view('Super_admin/sidebar');
            if ($data['mod_access'] == 1) {
                echo view('Super_admin/License/license', $data);
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
 
		$result = $this->licenseModel->findAll();
		
		foreach ($result as $key => $value) {
							
			$ops = '<div class="btn-group">';
			$ops .= '	<button type="button" class="btn btn-sm btn-info" onclick="edit('. $value->lic_id .')"><i class="fa fa-edit"></i></button>';
			$ops .= '	<button type="button" class="btn btn-sm btn-danger" onclick="remove('. $value->lic_id .')"><i class="fa fa-trash"></i></button>';
			$ops .= '</div>';
			
			$data['data'][$key] = array(
				$value->lic_id,
                get_data_by_id('name','hospital','h_id',$value->h_id),
                $value->lic_key,
                $value->start_date,
                $value->end_date,
                statusView($value->status),
				$ops,
			);
		} 

		return $this->response->setJSON($data);		
	}

	
	public function getOne()
	{
 		$response = array();
		
		$id = $this->request->getPost('lic_id');
		
		if ($this->validation->check($id, 'required|numeric')) {
			
			$data = $this->licenseModel->where('lic_id' ,$id)->first();
			
			return $this->response->setJSON($data);	
				
		} else {
			
			throw new \CodeIgniter\Exceptions\PageNotFoundException();

		}	
		
	}	
	
	public function add()
	{

        $response = array();

        $lic_key = substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 12);
        $fields['h_id'] = $this->request->getPost('h_id');
        $fields['lic_key'] = $lic_key;
        $fields['start_date'] = $this->request->getPost('start_date');
        $fields['end_date'] = $this->request->getPost('end_date');
        $fields['createdBy'] = '1';

        $this->validation->setRules([
            'h_id' => ['label' => 'h_id', 'rules' => 'required'],
            'start_date' => ['label' => 'Start Date', 'rules' => 'required'],
            'end_date' => ['label' => 'End Date', 'rules' => 'required'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
            $response['messages'] = $this->validation->listErrors();

        } else {

            if ($this->licenseModel->insert($fields)) {
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

        $fields['lic_id'] = $this->request->getPost('lic_id');
        $fields['h_id'] = $this->request->getPost('h_id');
        $fields['start_date'] = $this->request->getPost('start_date');
        $fields['end_date'] = $this->request->getPost('end_date');


        $this->validation->setRules([
            'h_id' => ['label' => 'h_id', 'rules' => 'required'],
            'start_date' => ['label' => 'Start Date', 'rules' => 'required'],
            'end_date' => ['label' => 'End Date', 'rules' => 'required'],
        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
            $response['messages'] = $this->validation->listErrors();
			
        } else {



                if ($this->licenseModel->update($fields['lic_id'], $fields)) {

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
		
		$id = $this->request->getPost('lic_id');
		
		if (!$this->validation->check($id, 'required|numeric')) {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
			
		} else {	
		
			if ($this->licenseModel->where('lic_id', $id)->delete()) {
								
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