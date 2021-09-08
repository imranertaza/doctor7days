<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\PaymentMethodModel;

class PaymentMethod extends BaseController
{
	
    protected $paymentMethodModel;
    protected $validation;
	
	public function __construct()
	{
	    $this->paymentMethodModel = new PaymentMethodModel();
       	$this->validation =  \Config\Services::validation();
		
	}
	
	public function index()
	{

	    $data = [
                'controller'    	=> 'paymentMethod',
                'title'     		=> 'Payment Methods'				
			];
		
		return view('paymentMethod', $data);
			
	}

	public function getAll()
	{
 		$response = array();		
		
	    $data['data'] = array();
 
		$result = $this->paymentMethodModel->select('pymnt_method_id, h_id, type_name, createdBy, createdDtm, updatedBy, updatedDtm, deleted, deletedRole')->findAll();
		
		foreach ($result as $key => $value) {
							
			$ops = '<div class="btn-group">';
			$ops .= '	<button type="button" class="btn btn-sm btn-info" onclick="edit('. $value->pymnt_method_id .')"><i class="fa fa-edit"></i></button>';
			$ops .= '	<button type="button" class="btn btn-sm btn-danger" onclick="remove('. $value->pymnt_method_id .')"><i class="fa fa-trash"></i></button>';
			$ops .= '</div>';
			
			$data['data'][$key] = array(
				$value->pymnt_method_id,
				$value->h_id,
				$value->type_name,
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
		
		$id = $this->request->getPost('pymnt_method_id');
		
		if ($this->validation->check($id, 'required|numeric')) {
			
			$data = $this->paymentMethodModel->where('pymnt_method_id' ,$id)->first();
			
			return $this->response->setJSON($data);	
				
		} else {
			
			throw new \CodeIgniter\Exceptions\PageNotFoundException();

		}	
		
	}	
	
	public function add()
	{

        $response = array();

        $fields['pymnt_method_id'] = $this->request->getPost('pymntMethodId');
        $fields['h_id'] = $this->request->getPost('hId');
        $fields['type_name'] = $this->request->getPost('typeName');
        $fields['createdBy'] = $this->request->getPost('createdBy');
        $fields['createdDtm'] = $this->request->getPost('createdDtm');
        $fields['updatedBy'] = $this->request->getPost('updatedBy');
        $fields['updatedDtm'] = $this->request->getPost('updatedDtm');
        $fields['deleted'] = $this->request->getPost('deleted');
        $fields['deletedRole'] = $this->request->getPost('deletedRole');


        $this->validation->setRules([
            'h_id' => ['label' => 'H id', 'rules' => 'required|numeric|max_length[11]'],
            'type_name' => ['label' => 'Type name', 'rules' => 'required|max_length[155]'],
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

            if ($this->paymentMethodModel->insert($fields)) {
												
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
		
        $fields['pymnt_method_id'] = $this->request->getPost('pymntMethodId');
        $fields['h_id'] = $this->request->getPost('hId');
        $fields['type_name'] = $this->request->getPost('typeName');
        $fields['createdBy'] = $this->request->getPost('createdBy');
        $fields['createdDtm'] = $this->request->getPost('createdDtm');
        $fields['updatedBy'] = $this->request->getPost('updatedBy');
        $fields['updatedDtm'] = $this->request->getPost('updatedDtm');
        $fields['deleted'] = $this->request->getPost('deleted');
        $fields['deletedRole'] = $this->request->getPost('deletedRole');


        $this->validation->setRules([
            'h_id' => ['label' => 'H id', 'rules' => 'required|numeric|max_length[11]'],
            'type_name' => ['label' => 'Type name', 'rules' => 'required|max_length[155]'],
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

            if ($this->paymentMethodModel->update($fields['pymnt_method_id'], $fields)) {
				
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
		
		$id = $this->request->getPost('pymnt_method_id');
		
		if (!$this->validation->check($id, 'required|numeric')) {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
			
		} else {	
		
			if ($this->paymentMethodModel->where('pymnt_method_id', $id)->delete()) {
								
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