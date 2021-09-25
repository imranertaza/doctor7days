<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers\Mobile_app;

use App\Controllers\BaseController;
use App\Models\Hospital_admin\JobModel;


class Job extends BaseController
{

    protected $jobModel;

    public function __construct(){
        $this->jobModel = new JobModel();
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



}