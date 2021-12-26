<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Models\Super_admin;
use CodeIgniter\Model;

class AdmanagementModel extends Model {
    
	protected $table = 'ad_management';
	protected $primaryKey = 'ad_id';
	protected $returnType = 'object';
	protected $useSoftDeletes = false;
	protected $allowedFields = ['ad_package_id', 'h_id', 'org_type', 'banner', 'district_id', 'status', 'ad_view_count', 'ad_com_id', 'payment_status','start_date','end_date', 'createdDtm', 'createdBy', 'updatedDtm', 'updatedBy', 'deleted', 'deletedRole'];
	protected $useTimestamps = false;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';
	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = true;    
	
}