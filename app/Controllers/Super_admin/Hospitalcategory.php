<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers\Super_admin;

use App\Controllers\BaseController;

use App\Models\Super_admin\HospitalcategoryModel;
use App\Libraries\Permission;

class Hospitalcategory extends BaseController
{
	
    protected $hospitalcategoryModel;
    protected $validation;
    protected $session;
    protected $permission;
    private $module_name = 'Hospitalcategory';
	
	public function __construct()
	{
	    $this->hospitalcategoryModel = new HospitalcategoryModel();
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
                'controller'    	=> 'Super_admin/hospitalcategory',
                'title'     		=> 'Hospital Category'				
			];
		$perm = $this->permission->module_permission_list($role_id, $this->module_name);
            foreach($perm as $key=>$val){
                 $data[$key] = $this->permission->have_access($role_id, $this->module_name, $key);
            }
        echo view('Super_admin/header');
        echo view('Super_admin/sidebar');
        if ($data['mod_access'] == 1) {
            	echo view('Super_admin/Hospitalcategory/hospitalcategory', $data);
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
 
		$result = $this->hospitalcategoryModel->select('hospital_cat_id, name, parent_cat_id, createdBy, createdDtm, updatedBy, updatedDtm, deleted, deletedRole')->findAll();
		
		foreach ($result as $key => $value) {
							
			$ops = '<div class="btn-group">';
			$ops .= '	<button type="button" class="btn btn-sm btn-info" onclick="edit('. $value->hospital_cat_id .')"><i class="fa fa-edit"></i></button>';
			$ops .= '	<button type="button" class="btn btn-sm btn-danger" onclick="remove('. $value->hospital_cat_id .')"><i class="fa fa-trash"></i></button>';
			$ops .= '</div>';
			
			$data['data'][$key] = array(
				$value->hospital_cat_id,
				$value->name,
//                get_data_by_id('name','hospital_category','hospital_cat_id', $value->parent_cat_id),


				$ops,
			);
		} 

		return $this->response->setJSON($data);		
	}

	public function getUpdateData(){

        $view = '';
        $id = $this->request->getPost('hospital_cat_id');

        if ($this->validation->check($id, 'required|numeric')) {

            $data = $this->hospitalcategoryModel->where('hospital_cat_id' ,$id)->first();

                  $view .='<div class="row">
                            <input type="hidden" id="hospitalCatId" name="hospitalCatId" class="form-control" placeholder="Hospital cat id" value="'.$data->hospital_cat_id.'" required>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name"> Name: <span class="text-danger">*</span> </label>
                                    <input type="text" id="name" name="name" class="form-control" placeholder="Name" value="'.$data->name.'" required>
                                </div>
                            </div>
                            
                        </div>';
            return $view;

        } else {

            throw new \CodeIgniter\Exceptions\PageNotFoundException();

        }
    }
	
	public function getOne()
	{
 		$response = array();
		
		$id = $this->request->getPost('hospital_cat_id');
		
		if ($this->validation->check($id, 'required|numeric')) {
			
			$data = $this->hospitalcategoryModel->where('hospital_cat_id' ,$id)->first();
			
			return $this->response->setJSON($data);	
				
		} else {
			
			throw new \CodeIgniter\Exceptions\PageNotFoundException();

		}	
		
	}	
	
	public function add()
	{

        $response = array();

        $fields['name'] = $this->request->getPost('name');
        $fields['createdBy'] = '1';


        $this->validation->setRules([
            'name' => ['label' => 'Name', 'rules' => 'required|max_length[255]'],
        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
            $response['messages'] = $this->validation->listErrors();
			
        } else {

            if ($this->hospitalcategoryModel->insert($fields)) {
												
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
		
        $fields['hospital_cat_id'] = $this->request->getPost('hospitalCatId');
        $fields['name'] = $this->request->getPost('name');
//        $fields['parent_cat_id'] = $this->request->getPost('parentCatId');
        $fields['updatedBy'] = '1';

        $this->validation->setRules([
            'name' => ['label' => 'Name', 'rules' => 'required|max_length[255]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
            $response['messages'] = $this->validation->listErrors();
			
        } else {

            if ($this->hospitalcategoryModel->update($fields['hospital_cat_id'], $fields)) {
				
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
		
		$id = $this->request->getPost('hospital_cat_id');
		
		if (!$this->validation->check($id, 'required|numeric')) {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
			
		} else {	
		
			if ($this->hospitalcategoryModel->where('hospital_cat_id', $id)->delete()) {
								
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