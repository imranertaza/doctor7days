<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers\Mobile_app;

use App\Controllers\BaseController;
use App\Models\Hospital_admin\SpecialistModel;
use App\Models\Hospital_admin\TestModel;
use App\Models\Mobile_app\DoctorModel;
use App\Models\Mobile_app\GlobaladdressModel;
use App\Models\Mobile_app\HospitalModel;


class Diagnostic extends BaseController
{

    protected $hospitalModel;
    protected $specialistModel;
    protected $doctorModel;
    protected $testModel;
    protected $globaladdressModel;
    protected $session;
    protected $pager;

    public function __construct(){
        $this->hospitalModel = new HospitalModel();
        $this->pager = \Config\Services::pager();
        $this->specialistModel = new SpecialistModel();
        $this->doctorModel = new DoctorModel();
        $this->globaladdressModel = new GlobaladdressModel();
        $this->session = \Config\Services::session();
        $this->testModel = new TestModel();
    }

    public function index()
    {
        $diag = $this->hospitalModel->where('hospital_cat_id !=',1)->paginate(10);
        $data['diagnostic'] = $diag;
        $data['pager'] = $this->hospitalModel->pager;
        echo view('Mobile_app/header');
        echo view('Mobile_app/Diagnostic/diagnostic',$data);
        echo view('Mobile_app/footer');

    }

    public function diagnostic_form()
    {
        echo view('Mobile_app/header');
        echo view('Mobile_app/Diagnostic/diagnostic_form');
        echo view('Mobile_app/footer');

    }
    public function diagnostic_center_list(){

        $division = empty($this->request->getPost('division')) ? '1=1' : array('global_address.division' => $this->request->getPost('division'));
        $district = empty($this->request->getPost('zila')) ? '1=1' : array('global_address.zila' => $this->request->getPost('zila'));
        $upazila = empty($this->request->getPost('upazila')) ? '1=1' : array('global_address.upazila' => $this->request->getPost('upazila'));


        $hospital = $this->globaladdressModel->join('hospital', 'hospital.global_address_id = global_address.global_address_id')->where('hospital.hospital_cat_id !=',1)->where('hospital.status','1')->where($division)->where($district)->where($upazila)->get()->getResult();

        $data['diagnostic'] = $hospital;

        $data['pager'] = '';

        echo view('Mobile_app/Diagnostic/diagnostic',$data);

    }

    public function specialist_search(){
        $specialist_id = $this->request->getPost('specialist');
        $this->doctorModel->where('specialist_id',$specialist_id)->findAll();

        $special = DB()->table('doctor');
        $special->select('*');
        $special->join('hospital', 'hospital.h_id = doctor.h_id');
        $special->where('hospital.status','1');
        $special->groupBy('hospital.h_id');
        $query = $special->where('doctor.specialist_id',$specialist_id)->get()->getResult();

        $data = [
            'specialistId' => $specialist_id,
            'hospital' => $query,
        ];

        echo view('Mobile_app/header');
        echo view('Mobile_app/Diagnostic/search_result',$data);
        echo view('Mobile_app/footer');
    }

    public function diagnostic_detail($id){
        $data['hospital'] = $this->hospitalModel->where('h_id', $id)->first();
        $data['test'] = $this->testModel->where('h_id', $id)->findAll();
        echo view('Mobile_app/header');
        echo view('Mobile_app/Diagnostic/diagnostic_detail',$data);
        echo view('Mobile_app/footer');
    }

    public function test_detail($id){
        $hid = get_data_by_id('h_id','tests','test_id',$id);
        $data['hospital'] = $this->hospitalModel->where('h_id', $hid)->first();
        $data['test'] = $this->testModel->where('test_id', $id)->first();
        echo view('Mobile_app/header');
        echo view('Mobile_app/Diagnostic/test_detail',$data);
        echo view('Mobile_app/footer');
    }



}