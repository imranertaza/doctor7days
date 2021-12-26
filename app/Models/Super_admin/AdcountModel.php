<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Models\Super_admin;
use CodeIgniter\Model;

class AdcountModel extends Model {
    
	protected $table = 'ad_count';
	protected $primaryKey = 'ad_count_id';
	protected $returnType = 'object';
	protected $useSoftDeletes = false;
	protected $allowedFields = ['ad_id', 'total_view_count', 'unique_view_count', 'createdDtm', 'createdBy', 'updatedDtm', 'updatedBy', 'deleted', 'deletedRole'];
	protected $useTimestamps = false;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';
	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = true;    
	
}