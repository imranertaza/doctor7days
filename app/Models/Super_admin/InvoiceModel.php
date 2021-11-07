<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Models\Super_admin;
use CodeIgniter\Model;

class InvoiceModel extends Model {
    
	protected $table = 'invoice';
	protected $primaryKey = 'invoice_id';
	protected $returnType = 'object';
	protected $useSoftDeletes = false;
	protected $allowedFields = ['patient_id', 'pymnt_method_id', 'amount', 'entire_sale_discount', 'vat', 'delivery_charge', 'final_amount', 'profit', 'cash_paid', 'due', 'global_address_id', 'creation_timestamp', 'payment_timestamp', 'payment_method', 'payment_details', 'status', 'timestamp', 'year', 'createdDtm', 'createdBy', 'updatedBy', 'updatedDtm', 'deleted', 'deletedRole'];
	protected $useTimestamps = false;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';
	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = true;    
	
}