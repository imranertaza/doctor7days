<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers\Mobile_app;

use App\Controllers\BaseController;
use App\Models\Mobile_app\GlobaladdressModel;
use App\Models\Mobile_app\HospitalModel;
use App\Models\Mobile_app\JobModel;


class Job extends BaseController
{

    protected $jobModel;
    protected $globaladdressModel;
    protected $session;
    protected $hospitalModel;

    public function __construct(){
        $this->jobModel = new JobModel();
        $this->globaladdressModel = new GlobaladdressModel();
        $this->session = \Config\Services::session();
        $this->hospitalModel = new HospitalModel();
    }

    public function index()
    {
        $data['job'] = $this->jobModel->findAll();
        echo view('Mobile_app/header');
        echo view('Mobile_app/Job/job',$data);
        echo view('Mobile_app/footer');

    }

    public function job_apply($id)
    {
        $data['job'] = $this->jobModel->where('job_id',$id)->first();
        echo view('Mobile_app/header');
        echo view('Mobile_app/Job/job_apply',$data);
        echo view('Mobile_app/footer');

    }

    public function search_location(){

        echo view('Mobile_app/header');
        echo view('Mobile_app/Job/job_form');
        echo view('Mobile_app/footer');
    }

    public function search_action(){
        $query = array();

        $division = $this->request->getPost('division');
        $zila = $this->request->getPost('zila');
        $upazila = $this->request->getPost('upazila');

        $where = ['division'=>$division,'zila'=>$zila,'upazila'=>$upazila,];

        $gloadd = $this->globaladdressModel->where($where);
        if ($gloadd->countAllResults() != 0) {
            $gloaddre = $this->globaladdressModel->where($where);
            $add = $gloaddre->first()->global_address_id;
            $tbHospital = DB()->table('hospital');
            $tbHospital->select('job.*');
            $tbHospital->join('job', 'job.h_id = hospital.h_id');
            $tbHospital->where('hospital.global_address_id',$add);
            $query = $tbHospital->get()->getResult();

        }else{

            $this->session->setFlashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Jobs not found this Address! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>');
            return redirect()->back();
        }
        $data['job'] = $query;

        echo view('Mobile_app/header');
        echo view('Mobile_app/Job/job',$data);
        echo view('Mobile_app/footer');

    }



}