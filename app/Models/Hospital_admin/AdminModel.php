<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Models\Hospital_admin;
use CodeIgniter\Model;

class AdminModel extends Model {
    
	protected $table = 'admin';
	protected $primaryKey = 'admin_id';
	protected $returnType = 'object';
	protected $useSoftDeletes = false;
	protected $allowedFields = ['email', 'password', 'name', 'mobile', 'address', 'pic', 'comName', 'role_id', 'createdBy', 'createdDtm', 'updatedBy', 'updatedDtm'];
	protected $useTimestamps = false;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';
	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = true;    
	
}