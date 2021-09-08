<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\InvoiceModel;

class Invoice extends BaseController
{
	
    protected $invoiceModel;
    protected $validation;
	
	public function __construct()
	{
	    $this->invoiceModel = new InvoiceModel();
       	$this->validation =  \Config\Services::validation();
		
	}
	
	public function index()
	{

	    $data = [
                'controller'    	=> 'invoice',
                'title'     		=> 'Invoice'				
			];
		
		return view('invoice', $data);
			
	}

	public function getAll()
	{
 		$response = array();		
		
	    $data['data'] = array();
 
		$result = $this->invoiceModel->select('invoice_id, patient_id, pymnt_method_id, amount, entire_sale_discount, vat, delivery_charge, final_amount, profit, cash_paid, due, global_address_id, creation_timestamp, payment_timestamp, payment_method, payment_details, status, timestamp, year, createdDtm, createdBy, updatedBy, updatedDtm, deleted, deletedRole')->findAll();
		
		foreach ($result as $key => $value) {
							
			$ops = '<div class="btn-group">';
			$ops .= '	<button type="button" class="btn btn-sm btn-info" onclick="edit('. $value->invoice_id .')"><i class="fa fa-edit"></i></button>';
			$ops .= '	<button type="button" class="btn btn-sm btn-danger" onclick="remove('. $value->invoice_id .')"><i class="fa fa-trash"></i></button>';
			$ops .= '</div>';
			
			$data['data'][$key] = array(
				$value->invoice_id,
				$value->patient_id,
				$value->pymnt_method_id,
				$value->amount,
				$value->entire_sale_discount,
				$value->vat,
				$value->delivery_charge,
				$value->final_amount,
				$value->profit,
				$value->cash_paid,
				$value->due,
				$value->global_address_id,
				$value->creation_timestamp,
				$value->payment_timestamp,
				$value->payment_method,
				$value->payment_details,
				$value->status,
				$value->timestamp,
				$value->year,
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
		
		$id = $this->request->getPost('invoice_id');
		
		if ($this->validation->check($id, 'required|numeric')) {
			
			$data = $this->invoiceModel->where('invoice_id' ,$id)->first();
			
			return $this->response->setJSON($data);	
				
		} else {
			
			throw new \CodeIgniter\Exceptions\PageNotFoundException();

		}	
		
	}	
	
	public function add()
	{

        $response = array();

        $fields['invoice_id'] = $this->request->getPost('invoiceId');
        $fields['patient_id'] = $this->request->getPost('patientId');
        $fields['pymnt_method_id'] = $this->request->getPost('pymntMethodId');
        $fields['amount'] = $this->request->getPost('amount');
        $fields['entire_sale_discount'] = $this->request->getPost('entireSaleDiscount');
        $fields['vat'] = $this->request->getPost('vat');
        $fields['delivery_charge'] = $this->request->getPost('deliveryCharge');
        $fields['final_amount'] = $this->request->getPost('finalAmount');
        $fields['profit'] = $this->request->getPost('profit');
        $fields['cash_paid'] = $this->request->getPost('cashPaid');
        $fields['due'] = $this->request->getPost('due');
        $fields['global_address_id'] = $this->request->getPost('globalAddressId');
        $fields['creation_timestamp'] = $this->request->getPost('creationTimestamp');
        $fields['payment_timestamp'] = $this->request->getPost('paymentTimestamp');
        $fields['payment_method'] = $this->request->getPost('paymentMethod');
        $fields['payment_details'] = $this->request->getPost('paymentDetails');
        $fields['status'] = $this->request->getPost('status');
        $fields['timestamp'] = $this->request->getPost('timestamp');
        $fields['year'] = $this->request->getPost('year');
        $fields['createdDtm'] = $this->request->getPost('createdDtm');
        $fields['createdBy'] = $this->request->getPost('createdBy');
        $fields['updatedBy'] = $this->request->getPost('updatedBy');
        $fields['updatedDtm'] = $this->request->getPost('updatedDtm');
        $fields['deleted'] = $this->request->getPost('deleted');
        $fields['deletedRole'] = $this->request->getPost('deletedRole');


        $this->validation->setRules([
            'patient_id' => ['label' => 'Patient id', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'pymnt_method_id' => ['label' => 'Pymnt method id', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'amount' => ['label' => 'Amount', 'rules' => 'required'],
            'entire_sale_discount' => ['label' => 'Entire sale discount', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'vat' => ['label' => 'Vat', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'delivery_charge' => ['label' => 'Delivery charge', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'final_amount' => ['label' => 'Final amount', 'rules' => 'required'],
            'profit' => ['label' => 'Profit', 'rules' => 'required'],
            'cash_paid' => ['label' => 'Cash paid', 'rules' => 'permit_empty'],
            'due' => ['label' => 'Due', 'rules' => 'permit_empty'],
            'global_address_id' => ['label' => 'Global address id', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'creation_timestamp' => ['label' => 'Creation timestamp', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'payment_timestamp' => ['label' => 'Payment timestamp', 'rules' => 'permit_empty'],
            'payment_method' => ['label' => 'Payment method', 'rules' => 'permit_empty'],
            'payment_details' => ['label' => 'Payment details', 'rules' => 'permit_empty'],
            'status' => ['label' => 'Status', 'rules' => 'required'],
            'timestamp' => ['label' => 'Timestamp', 'rules' => 'required'],
            'year' => ['label' => 'Year', 'rules' => 'permit_empty'],
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

            if ($this->invoiceModel->insert($fields)) {
												
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
		
        $fields['invoice_id'] = $this->request->getPost('invoiceId');
        $fields['patient_id'] = $this->request->getPost('patientId');
        $fields['pymnt_method_id'] = $this->request->getPost('pymntMethodId');
        $fields['amount'] = $this->request->getPost('amount');
        $fields['entire_sale_discount'] = $this->request->getPost('entireSaleDiscount');
        $fields['vat'] = $this->request->getPost('vat');
        $fields['delivery_charge'] = $this->request->getPost('deliveryCharge');
        $fields['final_amount'] = $this->request->getPost('finalAmount');
        $fields['profit'] = $this->request->getPost('profit');
        $fields['cash_paid'] = $this->request->getPost('cashPaid');
        $fields['due'] = $this->request->getPost('due');
        $fields['global_address_id'] = $this->request->getPost('globalAddressId');
        $fields['creation_timestamp'] = $this->request->getPost('creationTimestamp');
        $fields['payment_timestamp'] = $this->request->getPost('paymentTimestamp');
        $fields['payment_method'] = $this->request->getPost('paymentMethod');
        $fields['payment_details'] = $this->request->getPost('paymentDetails');
        $fields['status'] = $this->request->getPost('status');
        $fields['timestamp'] = $this->request->getPost('timestamp');
        $fields['year'] = $this->request->getPost('year');
        $fields['createdDtm'] = $this->request->getPost('createdDtm');
        $fields['createdBy'] = $this->request->getPost('createdBy');
        $fields['updatedBy'] = $this->request->getPost('updatedBy');
        $fields['updatedDtm'] = $this->request->getPost('updatedDtm');
        $fields['deleted'] = $this->request->getPost('deleted');
        $fields['deletedRole'] = $this->request->getPost('deletedRole');


        $this->validation->setRules([
            'patient_id' => ['label' => 'Patient id', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'pymnt_method_id' => ['label' => 'Pymnt method id', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'amount' => ['label' => 'Amount', 'rules' => 'required'],
            'entire_sale_discount' => ['label' => 'Entire sale discount', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'vat' => ['label' => 'Vat', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'delivery_charge' => ['label' => 'Delivery charge', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'final_amount' => ['label' => 'Final amount', 'rules' => 'required'],
            'profit' => ['label' => 'Profit', 'rules' => 'required'],
            'cash_paid' => ['label' => 'Cash paid', 'rules' => 'permit_empty'],
            'due' => ['label' => 'Due', 'rules' => 'permit_empty'],
            'global_address_id' => ['label' => 'Global address id', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'creation_timestamp' => ['label' => 'Creation timestamp', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'payment_timestamp' => ['label' => 'Payment timestamp', 'rules' => 'permit_empty'],
            'payment_method' => ['label' => 'Payment method', 'rules' => 'permit_empty'],
            'payment_details' => ['label' => 'Payment details', 'rules' => 'permit_empty'],
            'status' => ['label' => 'Status', 'rules' => 'required'],
            'timestamp' => ['label' => 'Timestamp', 'rules' => 'required'],
            'year' => ['label' => 'Year', 'rules' => 'permit_empty'],
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

            if ($this->invoiceModel->update($fields['invoice_id'], $fields)) {
				
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
		
		$id = $this->request->getPost('invoice_id');
		
		if (!$this->validation->check($id, 'required|numeric')) {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
			
		} else {	
		
			if ($this->invoiceModel->where('invoice_id', $id)->delete()) {
								
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