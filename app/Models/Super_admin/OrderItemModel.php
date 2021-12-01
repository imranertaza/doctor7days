<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Models\Super_admin;
use CodeIgniter\Model;

class OrderItemModel extends Model {
    
	protected $table = 'order_item';
	protected $primaryKey = 'order_item_id';
	protected $returnType = 'object';
	protected $useSoftDeletes = false;
	protected $allowedFields = ['order_id', 'prod_id', 'price', 'quantity', 'total_price', 'discount', 'final_price', 'createdDtm', 'createdBy', 'updatedBy', 'updatedDtm', 'deleted', 'deletedRole'];
	protected $useTimestamps = false;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';
	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = true;    
	
}