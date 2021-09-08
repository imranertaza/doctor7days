<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\HospitalcategoryModel;

class Hospitalcategory extends BaseController
{
	
    protected $hospitalcategoryModel;
    protected $validation;
	
	public function __construct()
	{
	    $this->hospitalcategoryModel = new HospitalcategoryModel();
       	$this->validation =  \Config\Services::validation();
		
	}
	
	public function index()
	{

	    $data = [
                'controller'    	=> 'hospitalcategory',
                'title'     		=> 'Hospital Category'				
			];
		
		return view('hospitalcategory', $data);
			
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
				$value->parent_cat_id,
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

        $fields['hospital_cat_id'] = $this->request->getPost('hospitalCatId');
        $fields['name'] = $this->request->getPost('name');
        $fields['parent_cat_id'] = $this->request->getPost('parentCatId');
        $fields['createdBy'] = $this->request->getPost('createdBy');
        $fields['createdDtm'] = $this->request->getPost('createdDtm');
        $fields['updatedBy'] = $this->request->getPost('updatedBy');
        $fields['updatedDtm'] = $this->request->getPost('updatedDtm');
        $fields['deleted'] = $this->request->getPost('deleted');
        $fields['deletedRole'] = $this->request->getPost('deletedRole');


        $this->validation->setRules([
            'name' => ['label' => 'Name', 'rules' => 'required|max_length[255]'],
            'parent_cat_id' => ['label' => 'Parent cat id', 'rules' => 'permit_empty|numeric|max_length[11]'],
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
        $fields['parent_cat_id'] = $this->request->getPost('parentCatId');
        $fields['createdBy'] = $this->request->getPost('createdBy');
        $fields['createdDtm'] = $this->request->getPost('createdDtm');
        $fields['updatedBy'] = $this->request->getPost('updatedBy');
        $fields['updatedDtm'] = $this->request->getPost('updatedDtm');
        $fields['deleted'] = $this->request->getPost('deleted');
        $fields['deletedRole'] = $this->request->getPost('deletedRole');


        $this->validation->setRules([
            'name' => ['label' => 'Name', 'rules' => 'required|max_length[255]'],
            'parent_cat_id' => ['label' => 'Parent cat id', 'rules' => 'permit_empty|numeric|max_length[11]'],
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