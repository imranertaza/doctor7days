<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Models\Hospital_admin;
use CodeIgniter\Model;

class SpecialistModel extends Model {
    
	protected $table = 'specialist';
	protected $primaryKey = 'specialist_id';
	protected $returnType = 'object';
	protected $useSoftDeletes = false;
	protected $allowedFields = ['specialist_type_name', 'createdDtm', 'createdBy', 'updateDtm', 'updatedBy', 'deleted', 'deletedRole'];
	protected $useTimestamps = false;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';
	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = true;    
	
}