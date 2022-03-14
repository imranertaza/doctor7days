<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers\Web;

use App\Controllers\BaseController;

use App\Models\Hospital_admin\AdminModel;
use App\Libraries\Permission;
use App\Models\Super_admin\JobModel;

class Jobs extends BaseController
{

    protected $adminModel;
    protected $validation;
    protected $session;
    protected $permission;
    protected $jobModel;
    private $module_name = 'Admin';

    public function __construct()
    {
        $this->adminModel = new AdminModel();
        $this->jobModel = new JobModel();
        $this->validation =  \Config\Services::validation();
        $this->session = \Config\Services::session();
        $this->permission = new Permission();

    }

    public function index()
    {
//        $jobs = $this->jobModel->findAll();
        $tabl = DB()->table('job');
        $tabl->select('*');
        $tabl->join('hospital', 'hospital.h_id = job.h_id');
        $tabl->where('hospital.status','1');
        $jobs = $tabl->get()->getResult();
        $data = [
            'jobs'     		=> $jobs,
        ];


        echo view('Web/header');
        echo view('Web/Jobs/jobs', $data);
        echo view('Web/footer');

    }
    public function job_apply($id){
        $jobs = $this->jobModel->find($id);
        $data = [
            'jobs'     		=> $jobs,
        ];


        echo view('Web/header');
        echo view('Web/Jobs/details', $data);
        echo view('Web/footer');
    }



}