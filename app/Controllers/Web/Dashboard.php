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
            $data['indAppionment'] = $this->indianappointment->where('pat_id',$userId)->orderBy('appointment_id','DESC')->findAll();
            $data['appointment'] = $this->appointmentModel->where('status','1')->where('pat_id',$userId)->orderBy('appointment_id','DESC')->findAll();

            $data['sidebar'] =  view('Web/sidebar');
            echo view('Web/header');
            echo view('Web/Dashboard/dashboard',$data);
            echo view('Web/footer');
        }else{
            return redirect()->to(site_url('Web/Login'));
        }

    }

    public function appointment($id){
        if(!empty($this->session->isPatientLoginWeb) || $this->session->isPatientLoginWeb == TRUE) {

            $userId = $this->session->Patient_user_id;
            $data['appointment'] = $this->appointmentModel->where('appointment_id',$id)->first();

            $data['sidebar'] =  view('Web/sidebar');
            echo view('Web/header');
            echo view('Web/Dashboard/appointment',$data);
            echo view('Web/footer');
        }else{
            return redirect()->to(site_url('Web/Login'));
        }
    }

    public function cancel($id){
        $data['appointment_id'] = $id;
        $data['status'] = '0';

        $this->appointmentModel->update($data['appointment_id'],$data);
        $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"> Cancel successful.. <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>');
        return redirect()->back();
    }


}