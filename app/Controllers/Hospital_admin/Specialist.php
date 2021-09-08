<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\SpecialistModel;

class Specialist extends BaseController
{
	
    protected $specialistModel;
    protected $validation;
	
	public function __construct()
	{
	    $this->specialistModel = new SpecialistModel();
       	$this->validation =  \Config\Services::validation();
		
	}
	
	public function index()
	{

	    $data = [
                'controller'    	=> 'specialist',
                'title'     		=> 'Specialist'				
			];
		
		return view('specialist', $data);
			
	}

	public function getAll()
	{
 		$response = array();		
		
	    $data['data'] = array();
 
		$result = $this->specialistModel->select('specialist_id, specialist_type_name, h_id, createdDtm, createdBy, updateDtm, updatedBy, deleted, deletedRole')->findAll();
		
		foreach ($result as $key => $value) {
							
			$ops = '<div class="btn-group">';
			$ops .= '	<button type="button" class="btn btn-sm btn-info" onclick="edit('. $value->specialist_id .')"><i class="fa fa-edit"></i></button>';
			$ops .= '	<button type="button" class="btn btn-sm btn-danger" onclick="remove('. $value->specialist_id .')"><i class="fa fa-trash"></i></button>';
			$ops .= '</div>';
			
			$data['data'][$key] = array(
				$value->specialist_id,
				$value->specialist_type_name,
				$value->h_id,
				$value->createdDtm,
				$value->createdBy,
				$value->updateDtm,
				$value->updatedBy,
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

        $fields['specialist_id'] = $this->request->getPost('specialistId');
        $fields['specialist_type_name'] = $this->request->getPost('specialistTypeName');
        $fields['h_id'] = $this->request->getPost('hId');
        $fields['createdDtm'] = $this->request->getPost('createdDtm');
        $fields['createdBy'] = $this->request->getPost('createdBy');
        $fields['updateDtm'] = $this->request->getPost('updateDtm');
        $fields['updatedBy'] = $this->request->getPost('updatedBy');
        $fields['deleted'] = $this->request->getPost('deleted');
        $fields['deletedRole'] = $this->request->getPost('deletedRole');


        $this->validation->setRules([
            'specialist_type_name' => ['label' => 'Specialist type name', 'rules' => 'required|max_length[155]'],
            'h_id' => ['label' => 'H id', 'rules' => 'required|numeric|max_length[11]'],
            'createdDtm' => ['label' => 'CreatedDtm', 'rules' => 'permit_empty'],
            'createdBy' => ['label' => 'CreatedBy', 'rules' => 'required|numeric|max_length[11]'],
            'updateDtm' => ['label' => 'UpdateDtm', 'rules' => 'permit_empty'],
            'updatedBy' => ['label' => 'UpdatedBy', 'rules' => 'required|numeric|max_length[11]'],
            'deleted' => ['label' => 'Deleted', 'rules' => 'required|numeric|max_length[11]'],
            'deletedRole' => ['label' => 'DeletedRole', 'rules' => 'required|numeric|max_length[11]'],

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
        $fields['h_id'] = $this->request->getPost('hId');
        $fields['createdDtm'] = $this->request->getPost('createdDtm');
        $fields['createdBy'] = $this->request->getPost('createdBy');
        $fields['updateDtm'] = $this->request->getPost('updateDtm');
        $fields['updatedBy'] = $this->request->getPost('updatedBy');
        $fields['deleted'] = $this->request->getPost('deleted');
        $fields['deletedRole'] = $this->request->getPost('deletedRole');


        $this->validation->setRules([
            'specialist_type_name' => ['label' => 'Specialist type name', 'rules' => 'required|max_length[155]'],
            'h_id' => ['label' => 'H id', 'rules' => 'required|numeric|max_length[11]'],
            'createdDtm' => ['label' => 'CreatedDtm', 'rules' => 'permit_empty'],
            'createdBy' => ['label' => 'CreatedBy', 'rules' => 'required|numeric|max_length[11]'],
            'updateDtm' => ['label' => 'UpdateDtm', 'rules' => 'permit_empty'],
            'updatedBy' => ['label' => 'UpdatedBy', 'rules' => 'required|numeric|max_length[11]'],
            'deleted' => ['label' => 'Deleted', 'rules' => 'required|numeric|max_length[11]'],
            'deletedRole' => ['label' => 'DeletedRole', 'rules' => 'required|numeric|max_length[11]'],

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