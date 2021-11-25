<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Models\Mobile_app;
use CodeIgniter\Model;

class HospitalModel extends Model {
    
	protected $table = 'hospital';
	protected $primaryKey = 'h_id';
	protected $returnType = 'object';
	protected $useSoftDeletes = false;
	protected $allowedFields = ['name', 'description', 'email', 'global_address_id', 'mobile', 'comment', 'logo', 'image', 'banner_1', 'banner_2', 'banner_3', 'is_default','hospital_cat_id', 'status', 'createdDtm', 'updatedBy', 'updatedDtm', 'deleted', 'deletedRole'];
	protected $useTimestamps = false;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';
	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = true;    
	
}