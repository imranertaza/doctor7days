<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers\Web;

use App\Controllers\BaseController;

use App\Models\Hospital_admin\AdminModel;
use App\Libraries\Permission;

class Home extends BaseController
{
	
    protected $adminModel;
    protected $validation;
    protected $session;
    protected $permission;
    private $module_name = 'Admin';
	
	public function __construct()
	{
	    $this->adminModel = new AdminModel();
       	$this->validation =  \Config\Services::validation();
		$this->session = \Config\Services::session();
       	$this->permission = new Permission();
	}
	
	public function index()
	{
	    $data = [
                'controller'    	=> 'Hospital_admin/admin',
                'title'     		=> 'Admin'				
			];


	    echo view('Web/header');
	    echo view('Web/Home/index', $data);
	    echo view('Web/footer');
			
	}


		
}	