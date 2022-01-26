<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers\Web;

use App\Controllers\BaseController;

use App\Models\Hospital_admin\AdminModel;
use App\Libraries\Permission;
use App\Models\Mobile_app\BlogpostModel;
use App\Models\Super_admin\PatientModel;

class Profile extends BaseController
{

    protected $adminModel;
    protected $validation;
    protected $session;
    protected $permission;
    protected $patientModel;
    private $module_name = 'Admin';

    public function __construct()
    {
        $this->adminModel = new AdminModel();
        $this->patientModel = new PatientModel();
        $this->validation = \Config\Services::validation();
        $this->session = \Config\Services::session();
        $this->permission = new Permission();

    }

    public function index()
    {
        if (!empty($this->session->isPatientLoginWeb) || $this->session->isPatientLoginWeb == TRUE) {
            $userId = $this->session->Patient_user_id;
            $patient = $this->patientModel->find($userId);
            $data = [
                'patient' => $patient,
            ];

            $data['sidebar'] =  view('Web/sidebar');
            echo view('Web/header');
            echo view('Web/Profile/profile', $data);
            echo view('Web/footer');
        } else {
            return redirect()->to(site_url('Web/Login'));
        }

    }




}