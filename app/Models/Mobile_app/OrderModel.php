<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Models\Mobile_app;
use CodeIgniter\Model;

class OrderModel extends Model {
    
	protected $table = 'order';
	protected $primaryKey = 'order_id';
	protected $returnType = 'object';
	protected $useSoftDeletes = false;
	protected $allowedFields = ['patient_id','h_id', 'pymnt_method_id', 'patient_name', 'amount', 'entire_sale_discount', 'vat', 'delivery_charge', 'final_amount', 'global_address_id' , 'status','timestamp','year', 'createdDtm', 'createdBy', 'updatedDtm', 'updatedBy', 'deleted', 'deletedRole'];
	protected $useTimestamps = false;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';
	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = true;    
	
}