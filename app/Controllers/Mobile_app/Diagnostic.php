<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers\Mobile_app;

use App\Controllers\BaseController;
use App\Models\Mobile_app\HospitalModel;


class Diagnostic extends BaseController
{

    protected $hospitalModel;
    protected $pager;

    public function __construct(){
        $this->hospitalModel = new HospitalModel();
        $this->pager = \Config\Services::pager();
    }

    public function index()
    {
        $diag = $this->hospitalModel->paginate(10);
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



}