<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Models\Hospital_admin;
use CodeIgniter\Model;

class MessageToModel extends Model {
    
	protected $table = 'message_to';
	protected $primaryKey = 'message_to_id';
	protected $returnType = 'object';
	protected $useSoftDeletes = false;
	protected $allowedFields = ['message_id', 'to_hospital_id', 'to_diagnostic_id', 'to_patient_id', 'msg_read', 'msg_deleted', 'createdBy', 'createdDtm', 'updatedBy', 'updatedDtm'];
	protected $useTimestamps = false;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';
	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = true;    
	
}