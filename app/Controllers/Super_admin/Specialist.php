<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers\Super_admin;

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
        $isLoggedIAdmin = $this->session->isLoggedIAdmin;
        $role_id = $this->session->AdminRole;

        if (isset($isLoggedIAdmin)) {

            $data = [
                'controller' => 'Super_admin/specialist',
                'title' => 'Specialist'
            ];

           	$perm = $this->permission->module_permission_list($role_id, $this->module_name);
            foreach($perm as $key=>$val){
                 $data[$key] = $this->permission->have_access($role_id, $this->module_name, $key);
            }


            echo view('Super_admin/header');
            echo view('Super_admin/sidebar');
            if ($data['mod_access'] == 1) {
            	echo view('Super_admin/Specialist/specialist', $data);
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
 
		$result = $this->specialistModel->select('specialist_id, specialist_type_name, createdDtm, createdBy, updateDtm, updatedBy, deleted, deletedRole')->findAll();
		
		foreach ($result as $key => $value) {
							
			$ops = '<div class="btn-group">';
			$ops .= '	<button type="button" class="btn btn-sm btn-info" onclick="edit('. $value->specialist_id .')"><i class="fa fa-edit"></i></button>';
			$ops .= '	<button type="button" class="btn btn-sm btn-danger" onclick="remove('. $value->specialist_id .')"><i class="fa fa-trash"></i></button>';
			$ops .= '</div>';
			
			$data['data'][$key] = array(
				$value->specialist_id,
				$value->specialist_type_name,

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