<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Models\Hospital_admin;
use CodeIgniter\Model;

class MessageModel extends Model {
    
	protected $table = 'message';
	protected $primaryKey = 'message_id';
	protected $returnType = 'object';
	protected $useSoftDeletes = false;
	protected $allowedFields = ['title', 'description', 'attachment', 'from', 'for_hospital', 'for_diagnostic', 'for_patient', 'createdBy', 'createdDtm', 'updatedBy', 'updatedDtm'];
	protected $useTimestamps = false;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';
	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = true;    
	
}