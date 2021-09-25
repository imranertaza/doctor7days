<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Models\Hospital_admin;
use CodeIgniter\Model;

class AmbulanceModel extends Model {
    
	protected $table = 'ambulance';
	protected $primaryKey = 'amb_id';
	protected $returnType = 'object';
	protected $useSoftDeletes = false;
	protected $allowedFields = ['mobile', 'password', 'contact_name', 'oxygen', 'ac', 'car_model_name', 'description', 'image', 'global_address_id', 'createdDtm', 'createdBy', 'updatedDtm', 'updatedBy', 'deleted', 'deletedRole'];
	protected $useTimestamps = false;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';
	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = true;    
	
}