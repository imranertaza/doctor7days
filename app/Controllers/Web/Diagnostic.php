<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers\Web;

use App\Controllers\BaseController;


use App\Libraries\Permission;
use App\Models\Hospital_admin\AppointmentModel;
use App\Models\Hospital_admin\TestModel;
use App\Models\Mobile_app\DoctorModel;
use App\Models\Mobile_app\GlobaladdressModel;
use App\Models\Mobile_app\HospitalModel;

class Diagnostic extends BaseController
{

    protected $globaladdressModel;
    protected $doctorModel;
    protected $hospitalModel;
    protected $testModel;
    protected $appointmentModel;
    protected $validation;
    protected $session;
    protected $permission;
	
	public function __construct()
	{
        $this->testModel = new TestModel();
        $this->globaladdressModel = new GlobaladdressModel();
        $this->appointmentModel = new AppointmentModel();
        $this->doctorModel = new DoctorModel();
        $this->hospitalModel = new HospitalModel();
       	$this->validation =  \Config\Services::validation();
		$this->session = \Config\Services::session();
       	$this->permission = new Permission();
	}
	
	public function index(){

        $data['diagnostic']= $this->hospitalModel->where('hospital_cat_id !=',1)->where('status','1')->findAll();

	    echo view('Web/header');
	    echo view('Web/Diagnostic/index', $data);
	    echo view('Web/footer');
	}

    public function diagnostic_list($id){
        $data['diagnostic']= $this->hospitalModel->find($id);
        $data['test'] = $this->testModel->where('h_id', $id)->findAll();
        echo view('Web/header');
        echo view('Web/Diagnostic/diagnostic_detail', $data);
        echo view('Web/footer');
    }

    public function test_detail($id){
        $hid = get_data_by_id('h_id','tests','test_id',$id);
        $data['diagnostic'] = $this->hospitalModel->where('h_id', $hid)->first();
        $data['test'] = $this->testModel->find($id);
        echo view('Web/header');
        echo view('Web/Diagnostic/test_detail', $data);
        echo view('Web/footer');
    }

    public function search_location(){

        echo view('Web/header');
        echo view('Web/Diagnostic/search');
        echo view('Web/footer');
    }

    public function search_result(){

        $division = empty($this->request->getPost('division')) ? '1=1' : array('global_address.division' => $this->request->getPost('division'));
        $district = empty($this->request->getPost('zila')) ? '1=1' : array('global_address.zila' => $this->request->getPost('zila'));
        $upazila = empty($this->request->getPost('upazila')) ? '1=1' : array('global_address.upazila' => $this->request->getPost('upazila'));


        $hospital = $this->globaladdressModel->join('hospital', 'hospital.global_address_id = global_address.global_address_id')->where('hospital.hospital_cat_id !=',1)->where('hospital.status','1')->where($division)->where($district)->where($upazila)->get()->getResult();

        $data['diagnostic'] = $hospital;

        echo view('Web/Diagnostic/index', $data);

    }

		
}	