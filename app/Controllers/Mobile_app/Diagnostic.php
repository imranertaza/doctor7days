<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers\Mobile_app;

use App\Controllers\BaseController;
use App\Models\Hospital_admin\SpecialistModel;
use App\Models\Mobile_app\DoctorModel;
use App\Models\Mobile_app\HospitalModel;


class Diagnostic extends BaseController
{

    protected $hospitalModel;
    protected $specialistModel;
    protected $doctorModel;
    protected $pager;

    public function __construct(){
        $this->hospitalModel = new HospitalModel();
        $this->pager = \Config\Services::pager();
        $this->specialistModel = new SpecialistModel();
        $this->doctorModel = new DoctorModel();
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



}