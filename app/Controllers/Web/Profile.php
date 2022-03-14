<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers\Web;

use App\Controllers\BaseController;

use App\Models\Hospital_admin\AdminModel;
use App\Libraries\Permission;
use App\Models\Mobile_app\GlobaladdressModel;
use App\Models\Super_admin\PatientModel;

class Profile extends BaseController
{

    protected $adminModel;
    protected $validation;
    protected $session;
    protected $permission;
    protected $patientModel;
    protected $globaladdressModel;

    public function __construct()
    {
        $this->adminModel = new AdminModel();
        $this->patientModel = new PatientModel();
        $this->globaladdressModel = new GlobaladdressModel();
        $this->validation = \Config\Services::validation();
        $this->session = \Config\Services::session();
        $this->permission = new Permission();
        $this->crop = \Config\Services::image();

    }

    public function index()
    {
        if (!empty($this->session->isPatientLoginWeb) || $this->session->isPatientLoginWeb == TRUE) {
            $userId = $this->session->Patient_user_id;
            $patient = $this->patientModel->find($userId);
            $data = [
                'patient' => $patient,
            ];

            $data['sidebar'] = view('Web/sidebar');
            echo view('Web/header');
            echo view('Web/Profile/profile', $data);
            echo view('Web/footer');
        } else {
            return redirect()->to(site_url('Web/Login'));
        }

    }

    public function update_action()
    {
        $userId = $this->session->Patient_user_id;

        $pass = $this->request->getPost('password');
        $data['pat_id'] = $userId;
        $data['name'] = $this->request->getPost('name');
        $data['phone'] = $this->request->getPost('phone');
        $data['email'] = $this->request->getPost('email');
        $data['nid'] = $this->request->getPost('nid');
        $data['age'] = $this->request->getPost('age');

        if (!empty($pass)) {
            $data['password'] = sha1($pass);
        }

        if (!empty($_FILES['photo']['name'])) {
            $target_dir = FCPATH . 'assets/upload/patient/' . $userId . '/';
            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0777);
            }

            $photo = $this->request->getFile('photo');
            $name = $photo->getRandomName();
            $photo->move($target_dir, $name);

            $lo_nameimg = 'pa_' . $photo->getName();
            $this->crop->withFile($target_dir . '' . $name)->fit(100, 100, 'center')->save($target_dir . '' . $lo_nameimg);
            unlink($target_dir . '' . $name);

            $data['photo'] = $lo_nameimg;
        }


        $division = $this->request->getPost('division');
        $zila = $this->request->getPost('zila');
        $upazila = $this->request->getPost('upazila');
        $where = ['division' => $division, 'zila' => $zila, 'upazila' => $upazila];
        $gloadd = $this->globaladdressModel->where($where);
        if ($gloadd->countAllResults() != 0) {
            $glo = $this->globaladdressModel->where($where);
            $data['global_address_id'] = $glo->first()->global_address_id;
        }

        if ($this->patientModel->update($data['pat_id'], $data)) {
            $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"> update successful.. <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>');
            return redirect()->back();
        } else {
            $this->session->setFlashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert"> Something went wrong!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>');
            return redirect()->back();
        }


    }
}




