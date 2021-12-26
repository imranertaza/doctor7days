<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Models\Super_admin;
use CodeIgniter\Model;

class AdcompanyModel extends Model {
    
	protected $table = 'ad_company';
	protected $primaryKey = 'ad_com_id';
	protected $returnType = 'object';
	protected $useSoftDeletes = false;
	protected $allowedFields = ['com_name', 'com_address', 'com_email', 'contact_name', 'contact_phone', 'NID', 'TIN', 'BIN', 'trade_license','org_type', 'createdDtm', 'createdBy', 'updatedDtm', 'updatedBy', 'deleted', 'deletedRole'];
	protected $useTimestamps = false;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';
	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = true;    
	
}