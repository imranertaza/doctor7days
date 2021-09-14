<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Models\Hospital_admin;
use CodeIgniter\Model;

class HospitalModel extends Model {
    
	protected $table = 'hospital';
	protected $primaryKey = 'h_id';
	protected $returnType = 'object';
	protected $useSoftDeletes = false;
	protected $allowedFields = ['name', 'description', 'email', 'global_address_id', 'mobile', 'comment', 'logo', 'image', 'banner', 'is_default', 'password','hospital_cat_id', 'status', 'createdDtm', 'updatedBy', 'updatedDtm', 'deleted', 'deletedRole'];
	protected $useTimestamps = false;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';
	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = true;    
	
}