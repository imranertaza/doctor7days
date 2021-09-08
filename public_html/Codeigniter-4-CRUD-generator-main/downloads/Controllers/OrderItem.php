<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\OrderItemModel;

class OrderItem extends BaseController
{
	
    protected $orderItemModel;
    protected $validation;
	
	public function __construct()
	{
	    $this->orderItemModel = new OrderItemModel();
       	$this->validation =  \Config\Services::validation();
		
	}
	
	public function index()
	{

	    $data = [
                'controller'    	=> 'orderItem',
                'title'     		=> 'Order Items'				
			];
		
		return view('orderItem', $data);
			
	}

	public function getAll()
	{
 		$response = array();		
		
	    $data['data'] = array();
 
		$result = $this->orderItemModel->select('order_item_id, order_id, h_id, prod_id, price, quantity, total_price, discount, final_price, createdDtm, createdBy, updatedBy, updatedDtm, deleted, deletedRole')->findAll();
		
		foreach ($result as $key => $value) {
							
			$ops = '<div class="btn-group">';
			$ops .= '	<button type="button" class="btn btn-sm btn-info" onclick="edit('. $value->order_item_id .')"><i class="fa fa-edit"></i></button>';
			$ops .= '	<button type="button" class="btn btn-sm btn-danger" onclick="remove('. $value->order_item_id .')"><i class="fa fa-trash"></i></button>';
			$ops .= '</div>';
			
			$data['data'][$key] = array(
				$value->order_item_id,
				$value->order_id,
				$value->h_id,
				$value->prod_id,
				$value->price,
				$value->quantity,
				$value->total_price,
				$value->discount,
				$value->final_price,
				$value->createdDtm,
				$value->createdBy,
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
		
		$id = $this->request->getPost('order_item_id');
		
		if ($this->validation->check($id, 'required|numeric')) {
			
			$data = $this->orderItemModel->where('order_item_id' ,$id)->first();
			
			return $this->response->setJSON($data);	
				
		} else {
			
			throw new \CodeIgniter\Exceptions\PageNotFoundException();

		}	
		
	}	
	
	public function add()
	{

        $response = array();

        $fields['order_item_id'] = $this->request->getPost('orderItemId');
        $fields['order_id'] = $this->request->getPost('orderId');
        $fields['h_id'] = $this->request->getPost('hId');
        $fields['prod_id'] = $this->request->getPost('prodId');
        $fields['price'] = $this->request->getPost('price');
        $fields['quantity'] = $this->request->getPost('quantity');
        $fields['total_price'] = $this->request->getPost('totalPrice');
        $fields['discount'] = $this->request->getPost('discount');
        $fields['final_price'] = $this->request->getPost('finalPrice');
        $fields['createdDtm'] = $this->request->getPost('createdDtm');
        $fields['createdBy'] = $this->request->getPost('createdBy');
        $fields['updatedBy'] = $this->request->getPost('updatedBy');
        $fields['updatedDtm'] = $this->request->getPost('updatedDtm');
        $fields['deleted'] = $this->request->getPost('deleted');
        $fields['deletedRole'] = $this->request->getPost('deletedRole');


        $this->validation->setRules([
            'order_id' => ['label' => 'Order id', 'rules' => 'required|numeric|max_length[11]'],
            'h_id' => ['label' => 'H id', 'rules' => 'required|numeric|max_length[11]'],
            'prod_id' => ['label' => 'Prod id', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'price' => ['label' => 'Price', 'rules' => 'required'],
            'quantity' => ['label' => 'Quantity', 'rules' => 'required|numeric|max_length[11]'],
            'total_price' => ['label' => 'Total price', 'rules' => 'required'],
            'discount' => ['label' => 'Discount', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'final_price' => ['label' => 'Final price', 'rules' => 'required'],
            'createdDtm' => ['label' => 'CreatedDtm', 'rules' => 'required|valid_date'],
            'createdBy' => ['label' => 'CreatedBy', 'rules' => 'required|numeric|max_length[11]'],
            'updatedBy' => ['label' => 'UpdatedBy', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'updatedDtm' => ['label' => 'UpdatedDtm', 'rules' => 'required|valid_date'],
            'deleted' => ['label' => 'Deleted', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'deletedRole' => ['label' => 'DeletedRole', 'rules' => 'permit_empty|numeric|max_length[11]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
            $response['messages'] = $this->validation->listErrors();
			
        } else {

            if ($this->orderItemModel->insert($fields)) {
												
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
		
        $fields['order_item_id'] = $this->request->getPost('orderItemId');
        $fields['order_id'] = $this->request->getPost('orderId');
        $fields['h_id'] = $this->request->getPost('hId');
        $fields['prod_id'] = $this->request->getPost('prodId');
        $fields['price'] = $this->request->getPost('price');
        $fields['quantity'] = $this->request->getPost('quantity');
        $fields['total_price'] = $this->request->getPost('totalPrice');
        $fields['discount'] = $this->request->getPost('discount');
        $fields['final_price'] = $this->request->getPost('finalPrice');
        $fields['createdDtm'] = $this->request->getPost('createdDtm');
        $fields['createdBy'] = $this->request->getPost('createdBy');
        $fields['updatedBy'] = $this->request->getPost('updatedBy');
        $fields['updatedDtm'] = $this->request->getPost('updatedDtm');
        $fields['deleted'] = $this->request->getPost('deleted');
        $fields['deletedRole'] = $this->request->getPost('deletedRole');


        $this->validation->setRules([
            'order_id' => ['label' => 'Order id', 'rules' => 'required|numeric|max_length[11]'],
            'h_id' => ['label' => 'H id', 'rules' => 'required|numeric|max_length[11]'],
            'prod_id' => ['label' => 'Prod id', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'price' => ['label' => 'Price', 'rules' => 'required'],
            'quantity' => ['label' => 'Quantity', 'rules' => 'required|numeric|max_length[11]'],
            'total_price' => ['label' => 'Total price', 'rules' => 'required'],
            'discount' => ['label' => 'Discount', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'final_price' => ['label' => 'Final price', 'rules' => 'required'],
            'createdDtm' => ['label' => 'CreatedDtm', 'rules' => 'required|valid_date'],
            'createdBy' => ['label' => 'CreatedBy', 'rules' => 'required|numeric|max_length[11]'],
            'updatedBy' => ['label' => 'UpdatedBy', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'updatedDtm' => ['label' => 'UpdatedDtm', 'rules' => 'required|valid_date'],
            'deleted' => ['label' => 'Deleted', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'deletedRole' => ['label' => 'DeletedRole', 'rules' => 'permit_empty|numeric|max_length[11]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
            $response['messages'] = $this->validation->listErrors();
			
        } else {

            if ($this->orderItemModel->update($fields['order_item_id'], $fields)) {
				
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
		
		$id = $this->request->getPost('order_item_id');
		
		if (!$this->validation->check($id, 'required|numeric')) {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
			
		} else {	
		
			if ($this->orderItemModel->where('order_item_id', $id)->delete()) {
								
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