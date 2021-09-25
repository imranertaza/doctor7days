<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers\Hospital_admin;

use App\Controllers\BaseController;

use App\Models\Hospital_admin\StoreModel;

class Store extends BaseController
{
	
    protected $storeModel;
    protected $validation;
	
	public function __construct()
	{
	    $this->storeModel = new StoreModel();
       	$this->validation =  \Config\Services::validation();
		
	}
	
	public function index()
	{

	    $data = [
                'controller'    	=> 'Hospital_admin/store',
                'title'     		=> 'Store'				
			];

        echo view('Hospital_admin/header');
        echo view('Hospital_admin/sidebar');
		echo view('Hospital_admin/Store/store', $data);
        echo view('Hospital_admin/footer');
			
	}

	public function getAll()
	{
 		$response = array();		
		
	    $data['data'] = array();
 
		$result = $this->storeModel->select('store_id, prod_id, quantity, unit, purchase_date, createdDtm, createdBy, updateDtm, updatedBy, deleted, deletedRole')->findAll();
		
		foreach ($result as $key => $value) {
							
			$ops = '<div class="btn-group">';
			$ops .= '	<button type="button" class="btn btn-sm btn-info" onclick="edit('. $value->store_id .')"><i class="fa fa-edit"></i></button>';
			$ops .= '	<button type="button" class="btn btn-sm btn-danger" onclick="remove('. $value->store_id .')"><i class="fa fa-trash"></i></button>';
			$ops .= '</div>';
			
			$data['data'][$key] = array(
				$value->store_id,
				$value->prod_id,
				$value->quantity,
				$value->unit,
				$value->purchase_date,
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
		
		$id = $this->request->getPost('store_id');
		
		if ($this->validation->check($id, 'required|numeric')) {
			
			$data = $this->storeModel->where('store_id' ,$id)->first();
			
			return $this->response->setJSON($data);	
				
		} else {
			
			throw new \CodeIgniter\Exceptions\PageNotFoundException();

		}	
		
	}	
	
	public function add()
	{

        $response = array();

        $fields['store_id'] = $this->request->getPost('storeId');
        $fields['prod_id'] = $this->request->getPost('prodId');
        $fields['quantity'] = $this->request->getPost('quantity');
        $fields['unit'] = $this->request->getPost('unit');
        $fields['purchase_date'] = $this->request->getPost('purchaseDate');
        $fields['createdDtm'] = $this->request->getPost('createdDtm');
        $fields['createdBy'] = $this->request->getPost('createdBy');
        $fields['updateDtm'] = $this->request->getPost('updateDtm');
        $fields['updatedBy'] = $this->request->getPost('updatedBy');
        $fields['deleted'] = $this->request->getPost('deleted');
        $fields['deletedRole'] = $this->request->getPost('deletedRole');


        $this->validation->setRules([
            'prod_id' => ['label' => 'Prod id', 'rules' => 'required|numeric|max_length[11]'],
            'quantity' => ['label' => 'Quantity', 'rules' => 'required|numeric|max_length[11]'],
            'unit' => ['label' => 'Unit', 'rules' => 'required|numeric|max_length[11]'],
            'purchase_date' => ['label' => 'Purchase date', 'rules' => 'required|valid_date'],
            'createdDtm' => ['label' => 'CreatedDtm', 'rules' => 'required'],
            'createdBy' => ['label' => 'CreatedBy', 'rules' => 'required|numeric|max_length[11]'],
            'updateDtm' => ['label' => 'UpdateDtm', 'rules' => 'required'],
            'updatedBy' => ['label' => 'UpdatedBy', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'deleted' => ['label' => 'Deleted', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'deletedRole' => ['label' => 'DeletedRole', 'rules' => 'permit_empty|numeric|max_length[11]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
            $response['messages'] = $this->validation->listErrors();
			
        } else {

            if ($this->storeModel->insert($fields)) {
												
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
		
        $fields['store_id'] = $this->request->getPost('storeId');
        $fields['prod_id'] = $this->request->getPost('prodId');
        $fields['quantity'] = $this->request->getPost('quantity');
        $fields['unit'] = $this->request->getPost('unit');
        $fields['purchase_date'] = $this->request->getPost('purchaseDate');
        $fields['createdDtm'] = $this->request->getPost('createdDtm');
        $fields['createdBy'] = $this->request->getPost('createdBy');
        $fields['updateDtm'] = $this->request->getPost('updateDtm');
        $fields['updatedBy'] = $this->request->getPost('updatedBy');
        $fields['deleted'] = $this->request->getPost('deleted');
        $fields['deletedRole'] = $this->request->getPost('deletedRole');


        $this->validation->setRules([
            'prod_id' => ['label' => 'Prod id', 'rules' => 'required|numeric|max_length[11]'],
            'quantity' => ['label' => 'Quantity', 'rules' => 'required|numeric|max_length[11]'],
            'unit' => ['label' => 'Unit', 'rules' => 'required|numeric|max_length[11]'],
            'purchase_date' => ['label' => 'Purchase date', 'rules' => 'required|valid_date'],
            'createdDtm' => ['label' => 'CreatedDtm', 'rules' => 'required'],
            'createdBy' => ['label' => 'CreatedBy', 'rules' => 'required|numeric|max_length[11]'],
            'updateDtm' => ['label' => 'UpdateDtm', 'rules' => 'required'],
            'updatedBy' => ['label' => 'UpdatedBy', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'deleted' => ['label' => 'Deleted', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'deletedRole' => ['label' => 'DeletedRole', 'rules' => 'permit_empty|numeric|max_length[11]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
            $response['messages'] = $this->validation->listErrors();
			
        } else {

            if ($this->storeModel->update($fields['store_id'], $fields)) {
				
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
		
		$id = $this->request->getPost('store_id');
		
		if (!$this->validation->check($id, 'required|numeric')) {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
			
		} else {	
		
			if ($this->storeModel->where('store_id', $id)->delete()) {
								
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