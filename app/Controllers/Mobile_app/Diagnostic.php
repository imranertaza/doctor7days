<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers\Mobile_app;

use App\Controllers\BaseController;
use App\Models\Hospital_admin\SpecialistModel;
use App\Models\Mobile_app\DoctorModel;
use App\Models\Mobile_app\GlobaladdressModel;
use App\Models\Mobile_app\HospitalModel;


class Diagnostic extends BaseController
{

    protected $hospitalModel;
    protected $specialistModel;
    protected $doctorModel;
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
        $division = $this->request->getPost('division');
        $zila = $this->request->getPost('zila');
        $upazila = $this->request->getPost('upazila');

        $where = ['division' => $division, 'zila' => $zila, 'upazila' => $upazila,];

        $gloadd = $this->globaladdressModel->where($where);

        if ($gloadd->countAllResults() != 0) {
            $gloaddre = $this->globaladdressModel->where($where);
            $add = $gloaddre->first()->global_address_id;

            $hospital = $this->hospitalModel->where('hospital_cat_id !=',1)->where('global_address_id', $add)->findAll();
        } else {
            $hospital = array();
            $this->session->setFlashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Diagnostic not found this Address! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>');
            return redirect()->back();
        }
        $data['diagnostic'] = $hospital;

        $data['pager'] = '';

        echo view('Mobile_app/header');
        echo view('Mobile_app/Diagnostic/diagnostic',$data);
        echo view('Mobile_app/footer');
    }

    public function specialist_search(){
        $specialist_id = $this->request->getPost('specialist');
        $this->doctorModel->where('specialist_id',$specialist_id)->findAll();

        $special = DB()->table('doctor');
        $special->select('*');
        $special->join('hospital', 'hospital.h_id = doctor.h_id');
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
        print $id;
    }



}