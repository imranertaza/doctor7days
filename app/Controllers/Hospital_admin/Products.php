<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers\Hospital_admin;

use App\Controllers\BaseController;
use App\Libraries\Permission_hospital;

use App\Models\Hospital_admin\AppointmentModel;
use App\Models\Mobile_app\DoctorModel;
use App\Models\Super_admin\ProductModel;

class Products extends BaseController
{
	
    protected $appointmentModel;
    protected $doctorModel;
    protected $validation;
    protected $session;
    protected $permission;
    protected $productModel;
    private $module_name = 'Appointment';

	public function __construct()
	{
        $this->session = \Config\Services::session();
	    $this->appointmentModel = new AppointmentModel();
	    $this->doctorModel = new DoctorModel();
       	$this->validation =  \Config\Services::validation();
       	$this->permission = new Permission_hospital();
       	$this->productModel = new ProductModel();

		
	}
	
	public function index()
	{
        $isLoggedInHospital = $this->session->isLoggedInHospital;
        $role_id = $this->session->hospitalAdminRole;

        if(!isset($isLoggedInHospital) || $isLoggedInHospital != TRUE)
        {
            echo view('Hospital_admin/Login/login');
        }
        else {

            $product = $this->productModel->findAll();
            $data = [
                'controller' => 'Hospital_admin/Products',
                'title' => 'Products',
                'products' => $product,
            ];

            $perm = $this->permission->module_permission_list($role_id, $this->module_name);
            foreach($perm as $key=>$val){
                 $data[$key] = $this->permission->have_access($role_id, $this->module_name, $key);
                 $data['mod_access'];
            }

            echo view('Hospital_admin/header');
            echo view('Hospital_admin/sidebar');
            if ($data['mod_access'] == 1) {
            	echo view('Hospital_admin/Products/index', $data);
            }else {
            	echo view('Hospital_admin/No_permission', $data);
            }
            echo view('Hospital_admin/footer');
        }


	}



}	