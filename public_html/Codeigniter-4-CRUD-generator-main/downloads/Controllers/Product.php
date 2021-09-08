<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\ProductModel;

class Product extends BaseController
{
	
    protected $productModel;
    protected $validation;
	
	public function __construct()
	{
	    $this->productModel = new ProductModel();
       	$this->validation =  \Config\Services::validation();
		
	}
	
	public function index()
	{

	    $data = [
                'controller'    	=> 'product',
                'title'     		=> 'Products'				
			];
		
		return view('product', $data);
			
	}

	public function getAll()
	{
 		$response = array();		
		
	    $data['data'] = array();
 
		$result = $this->productModel->select('prod_id, store_id, name, quantity, unit, brand_id, picture, prod_cat_id, product_type, description, status, createdDtm, createdBy, updateDtm, updatedBy, deleted, deletedRole')->findAll();
		
		foreach ($result as $key => $value) {
							
			$ops = '<div class="btn-group">';
			$ops .= '	<button type="button" class="btn btn-sm btn-info" onclick="edit('. $value->prod_id .')"><i class="fa fa-edit"></i></button>';
			$ops .= '	<button type="button" class="btn btn-sm btn-danger" onclick="remove('. $value->prod_id .')"><i class="fa fa-trash"></i></button>';
			$ops .= '</div>';
			
			$data['data'][$key] = array(
				$value->prod_id,
				$value->store_id,
				$value->name,
				$value->quantity,
				$value->unit,
				$value->brand_id,
				$value->picture,
				$value->prod_cat_id,
				$value->product_type,
				$value->description,
				$value->status,
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
		
		$id = $this->request->getPost('prod_id');
		
		if ($this->validation->check($id, 'required|numeric')) {
			
			$data = $this->productModel->where('prod_id' ,$id)->first();
			
			return $this->response->setJSON($data);	
				
		} else {
			
			throw new \CodeIgniter\Exceptions\PageNotFoundException();

		}	
		
	}	
	
	public function add()
	{

        $response = array();

        $fields['prod_id'] = $this->request->getPost('prodId');
        $fields['store_id'] = $this->request->getPost('storeId');
        $fields['name'] = $this->request->getPost('name');
        $fields['quantity'] = $this->request->getPost('quantity');
        $fields['unit'] = $this->request->getPost('unit');
        $fields['brand_id'] = $this->request->getPost('brandId');
        $fields['picture'] = $this->request->getPost('picture');
        $fields['prod_cat_id'] = $this->request->getPost('prodCatId');
        $fields['product_type'] = $this->request->getPost('productType');
        $fields['description'] = $this->request->getPost('description');
        $fields['status'] = $this->request->getPost('status');
        $fields['createdDtm'] = $this->request->getPost('createdDtm');
        $fields['createdBy'] = $this->request->getPost('createdBy');
        $fields['updateDtm'] = $this->request->getPost('updateDtm');
        $fields['updatedBy'] = $this->request->getPost('updatedBy');
        $fields['deleted'] = $this->request->getPost('deleted');
        $fields['deletedRole'] = $this->request->getPost('deletedRole');


        $this->validation->setRules([
            'store_id' => ['label' => 'Store id', 'rules' => 'required|numeric|max_length[11]'],
            'name' => ['label' => 'Name', 'rules' => 'required|max_length[55]'],
            'quantity' => ['label' => 'Quantity', 'rules' => 'required|numeric|max_length[11]'],
            'unit' => ['label' => 'Unit', 'rules' => 'required|numeric|max_length[11]'],
            'brand_id' => ['label' => 'Brand id', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'picture' => ['label' => 'Picture', 'rules' => 'permit_empty|max_length[155]'],
            'prod_cat_id' => ['label' => 'Prod cat id', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'product_type' => ['label' => 'Product type', 'rules' => 'required'],
            'description' => ['label' => 'Description', 'rules' => 'permit_empty'],
            'status' => ['label' => 'Status', 'rules' => 'required'],
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

            if ($this->productModel->insert($fields)) {
												
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
		
        $fields['prod_id'] = $this->request->getPost('prodId');
        $fields['store_id'] = $this->request->getPost('storeId');
        $fields['name'] = $this->request->getPost('name');
        $fields['quantity'] = $this->request->getPost('quantity');
        $fields['unit'] = $this->request->getPost('unit');
        $fields['brand_id'] = $this->request->getPost('brandId');
        $fields['picture'] = $this->request->getPost('picture');
        $fields['prod_cat_id'] = $this->request->getPost('prodCatId');
        $fields['product_type'] = $this->request->getPost('productType');
        $fields['description'] = $this->request->getPost('description');
        $fields['status'] = $this->request->getPost('status');
        $fields['createdDtm'] = $this->request->getPost('createdDtm');
        $fields['createdBy'] = $this->request->getPost('createdBy');
        $fields['updateDtm'] = $this->request->getPost('updateDtm');
        $fields['updatedBy'] = $this->request->getPost('updatedBy');
        $fields['deleted'] = $this->request->getPost('deleted');
        $fields['deletedRole'] = $this->request->getPost('deletedRole');


        $this->validation->setRules([
            'store_id' => ['label' => 'Store id', 'rules' => 'required|numeric|max_length[11]'],
            'name' => ['label' => 'Name', 'rules' => 'required|max_length[55]'],
            'quantity' => ['label' => 'Quantity', 'rules' => 'required|numeric|max_length[11]'],
            'unit' => ['label' => 'Unit', 'rules' => 'required|numeric|max_length[11]'],
            'brand_id' => ['label' => 'Brand id', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'picture' => ['label' => 'Picture', 'rules' => 'permit_empty|max_length[155]'],
            'prod_cat_id' => ['label' => 'Prod cat id', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'product_type' => ['label' => 'Product type', 'rules' => 'required'],
            'description' => ['label' => 'Description', 'rules' => 'permit_empty'],
            'status' => ['label' => 'Status', 'rules' => 'required'],
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

            if ($this->productModel->update($fields['prod_id'], $fields)) {
				
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
		
		$id = $this->request->getPost('prod_id');
		
		if (!$this->validation->check($id, 'required|numeric')) {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
			
		} else {	
		
			if ($this->productModel->where('prod_id', $id)->delete()) {
								
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