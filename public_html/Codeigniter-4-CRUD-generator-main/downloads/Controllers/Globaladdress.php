<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\GlobaladdressModel;

class Globaladdress extends BaseController
{
	
    protected $globaladdressModel;
    protected $validation;
	
	public function __construct()
	{
	    $this->globaladdressModel = new GlobaladdressModel();
       	$this->validation =  \Config\Services::validation();
		
	}
	
	public function index()
	{

	    $data = [
                'controller'    	=> 'globaladdress',
                'title'     		=> 'Global Address'				
			];
		
		return view('globaladdress', $data);
			
	}

	public function getAll()
	{
 		$response = array();		
		
	    $data['data'] = array();
 
		$result = $this->globaladdressModel->select('global_address_id, division, zila, upazila, pourashava, ward, createdDtm, createdBy, updatedDtm, updatedBy, deleted, deletedRole')->findAll();
		
		foreach ($result as $key => $value) {
							
			$ops = '<div class="btn-group">';
			$ops .= '	<button type="button" class="btn btn-sm btn-info" onclick="edit('. $value->global_address_id .')"><i class="fa fa-edit"></i></button>';
			$ops .= '	<button type="button" class="btn btn-sm btn-danger" onclick="remove('. $value->global_address_id .')"><i class="fa fa-trash"></i></button>';
			$ops .= '</div>';
			
			$data['data'][$key] = array(
				$value->global_address_id,
				$value->division,
				$value->zila,
				$value->upazila,
				$value->pourashava,
				$value->ward,
				$value->createdDtm,
				$value->createdBy,
				$value->updatedDtm,
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
		
		$id = $this->request->getPost('global_address_id');
		
		if ($this->validation->check($id, 'required|numeric')) {
			
			$data = $this->globaladdressModel->where('global_address_id' ,$id)->first();
			
			return $this->response->setJSON($data);	
				
		} else {
			
			throw new \CodeIgniter\Exceptions\PageNotFoundException();

		}	
		
	}	
	
	public function add()
	{

        $response = array();

        $fields['global_address_id'] = $this->request->getPost('globalAddressId');
        $fields['division'] = $this->request->getPost('division');
        $fields['zila'] = $this->request->getPost('zila');
        $fields['upazila'] = $this->request->getPost('upazila');
        $fields['pourashava'] = $this->request->getPost('pourashava');
        $fields['ward'] = $this->request->getPost('ward');
        $fields['createdDtm'] = $this->request->getPost('createdDtm');
        $fields['createdBy'] = $this->request->getPost('createdBy');
        $fields['updatedDtm'] = $this->request->getPost('updatedDtm');
        $fields['updatedBy'] = $this->request->getPost('updatedBy');
        $fields['deleted'] = $this->request->getPost('deleted');
        $fields['deletedRole'] = $this->request->getPost('deletedRole');


        $this->validation->setRules([
            'division' => ['label' => 'Division', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'zila' => ['label' => 'Zila', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'upazila' => ['label' => 'Upazila', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'pourashava' => ['label' => 'Pourashava', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'ward' => ['label' => 'Ward', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'createdDtm' => ['label' => 'CreatedDtm', 'rules' => 'required|valid_date'],
            'createdBy' => ['label' => 'CreatedBy', 'rules' => 'required|numeric|max_length[11]'],
            'updatedDtm' => ['label' => 'UpdatedDtm', 'rules' => 'required|valid_date'],
            'updatedBy' => ['label' => 'UpdatedBy', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'deleted' => ['label' => 'Deleted', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'deletedRole' => ['label' => 'DeletedRole', 'rules' => 'permit_empty|numeric|max_length[11]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
            $response['messages'] = $this->validation->listErrors();
			
        } else {

            if ($this->globaladdressModel->insert($fields)) {
												
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
		
        $fields['global_address_id'] = $this->request->getPost('globalAddressId');
        $fields['division'] = $this->request->getPost('division');
        $fields['zila'] = $this->request->getPost('zila');
        $fields['upazila'] = $this->request->getPost('upazila');
        $fields['pourashava'] = $this->request->getPost('pourashava');
        $fields['ward'] = $this->request->getPost('ward');
        $fields['createdDtm'] = $this->request->getPost('createdDtm');
        $fields['createdBy'] = $this->request->getPost('createdBy');
        $fields['updatedDtm'] = $this->request->getPost('updatedDtm');
        $fields['updatedBy'] = $this->request->getPost('updatedBy');
        $fields['deleted'] = $this->request->getPost('deleted');
        $fields['deletedRole'] = $this->request->getPost('deletedRole');


        $this->validation->setRules([
            'division' => ['label' => 'Division', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'zila' => ['label' => 'Zila', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'upazila' => ['label' => 'Upazila', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'pourashava' => ['label' => 'Pourashava', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'ward' => ['label' => 'Ward', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'createdDtm' => ['label' => 'CreatedDtm', 'rules' => 'required|valid_date'],
            'createdBy' => ['label' => 'CreatedBy', 'rules' => 'required|numeric|max_length[11]'],
            'updatedDtm' => ['label' => 'UpdatedDtm', 'rules' => 'required|valid_date'],
            'updatedBy' => ['label' => 'UpdatedBy', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'deleted' => ['label' => 'Deleted', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'deletedRole' => ['label' => 'DeletedRole', 'rules' => 'permit_empty|numeric|max_length[11]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
            $response['messages'] = $this->validation->listErrors();
			
        } else {

            if ($this->globaladdressModel->update($fields['global_address_id'], $fields)) {
				
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
		
		$id = $this->request->getPost('global_address_id');
		
		if (!$this->validation->check($id, 'required|numeric')) {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
			
		} else {	
		
			if ($this->globaladdressModel->where('global_address_id', $id)->delete()) {
								
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