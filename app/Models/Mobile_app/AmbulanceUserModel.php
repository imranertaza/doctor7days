<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Models\Mobile_app;
use CodeIgniter\Model;

class AmbulanceUserModel extends Model {
    
	protected $table = 'ambulance_users';
	protected $primaryKey = 'ambulance_user_id';
	protected $returnType = 'object';
	protected $useSoftDeletes = false;
	protected $allowedFields = ['mobile', 'photo', 'password', 'name', 'status', 'createdDtm', 'createdBy', 'updatedDtm', 'updatedBy', 'deleted', 'deletedRole'];
	protected $useTimestamps = false;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';
	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = true;    
	
}