<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Models\Super_admin;
use CodeIgniter\Model;

class LicenseModel extends Model {
    
	protected $table = 'license';
	protected $primaryKey = 'lic_id';
	protected $returnType = 'object';
	protected $useSoftDeletes = false;
	protected $allowedFields = ['h_id', 'lic_key', 'start_date','end_date','status', 'createdDtm', 'createdBy', 'updatedDtm', 'updatedBy', 'deleted', 'deletedRole'];
	protected $useTimestamps = false;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';
	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = true;    
	
}