<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Models\Super_admin;
use CodeIgniter\Model;

class AdplaceModel extends Model {
    
	protected $table = 'ad_place';
	protected $primaryKey = 'ad_place_id';
	protected $returnType = 'object';
	protected $useSoftDeletes = false;
	protected $allowedFields = ['page_identity', 'page_position', 'createdDtm', 'createdBy', 'updatedDtm', 'updatedBy', 'deleted', 'deletedRole'];
	protected $useTimestamps = false;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';
	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = true;    
	
}