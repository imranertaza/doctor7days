<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers\Web;

use App\Controllers\BaseController;

use App\Models\Hospital_admin\AdminModel;
use App\Libraries\Permission;
use App\Models\Hospital_admin\AppointmentModel;
use App\Models\Super_admin\Indianappointment;
use App\Models\Super_admin\PatientModel;

class Dashboard extends BaseController
{

    protected $adminModel;
    protected $validation;
    protected $session;
    protected $permission;
    protected $patientModel;
    protected $indianappointment;
    protected $appointmentModel;

    public function __construct()
    {
        $this->adminModel = new AdminModel();
        $this->patientModel = new PatientModel();
        $this->indianappointment = new Indianappointment();
        $this->appointmentModel = new AppointmentModel();
        $this->validation =  \Config\Services::validation();
        $this->session = \Config\Services::session();
        $this->permission = new Permission();

    }

    public function index()
    {
        if(!empty($this->session->isPatientLoginWeb) || $this->session->isPatientLoginWeb == TRUE) {

            $userId = $this->session->Patient_user_id;
            $data['patient'] = $this->patientModel->where('pat_id',$userId)->first();
            $data['indAppionment'] = $this->indianappointment->where('pat_id',$userId)->findAll();
            $data['appointment'] = $this->appointmentModel->where('status','1')->where('pat_id',$userId)->findAll();

            $data['sidebar'] =  view('Web/sidebar');
            echo view('Web/header');
            echo view('Web/Dashboard/dashboard',$data);
            echo view('Web/footer');
        }else{
            return redirect()->to(site_url('Web/Login'));
        }

    }



}