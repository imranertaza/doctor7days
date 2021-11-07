<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers\Hospital_admin;

use App\Controllers\BaseController;
use App\Libraries\Permission_hospital;
use App\Models\Hospital_admin\UsersModel;
use App\Models\Hospital_admin\HospitalModel;
use App\Models\Mobile_app\GlobaladdressModel;
use App\Models\Super_admin\RolesModel;

class Settings extends BaseController
{

    protected $usersModel;
    protected $validation;
    protected $session;
    protected $permission;
    protected $rolesModel;
    protected $globaladdressModel;
    protected $hospitalModel;
    private $module_name = 'Users';

    public function __construct()
    {
        $this->usersModel = new UsersModel();
        $this->validation = \Config\Services::validation();
        $this->session = \Config\Services::session();
        $this->permission = new Permission_hospital();
        $this->rolesModel = new RolesModel();
        $this->globaladdressModel = new GlobaladdressModel();
        $this->hospitalModel = new HospitalModel() ;

    }

    public function index()
    {
        $isLoggedInHospital = $this->session->isLoggedInHospital;
        $role_id = $this->session->hospitalAdminRole;

        if (!isset($isLoggedInHospital) || $isLoggedInHospital != TRUE) {
            echo view('Hospital_admin/Login/login');
        } else {
            $h_id = $this->session->h_Id;
            $result = $this->hospitalModel->where('h_id', $h_id)->first();
            $glob = $this->globaladdressModel->where('global_address_id', $result->global_address_id)->first();
            $data = [
                'controller' => 'Hospital_admin/Settings',
                'title' => 'Settings',
                'hospital' => $result,
                'globaladdr' => $glob,
            ];

            $perm = $this->permission->module_permission_list($role_id, $this->module_name);
            foreach ($perm as $key => $val) {
                $data[$key] = $this->permission->have_access($role_id, $this->module_name, $key);
            }

            echo view('Hospital_admin/header');
            echo view('Hospital_admin/sidebar');
            if ($data['mod_access'] == 1) {
                echo view('Hospital_admin/Settings/settings', $data);
            } else {
                echo view('Hospital_admin/No_permission', $data);
            }

            echo view('Hospital_admin/footer');
        }

    }



    public function updateReg()
    {

        $response = array();

        $fields['h_id'] = $this->request->getPost('h_id');
        $fields['email'] = $this->request->getPost('email');
        $fields['name'] = $this->request->getPost('name');
        $fields['mobile'] = $this->request->getPost('mobile');
        $fields['description'] = $this->request->getPost('description');
        $fields['comment'] = $this->request->getPost('comment');


        $this->validation->setRules([
            'email' => ['label' => 'Email', 'rules' => 'required|max_length[30]'],
            'name' => ['label' => 'Name', 'rules' => 'required|max_length[40]'],
        ]);

        if ($this->validation->run($fields) == FALSE) {
            $response['success'] = false;
            $response['messages'] = $this->validation->listErrors();
        } else {

            if ($this->hospitalModel->update($fields['h_id'], $fields)) {
                $response['success'] = true;
                $response['messages'] = 'Successfully updated';

            } else {
                $response['success'] = false;
                $response['messages'] = 'Update error!';

            }
        }

        return $this->response->setJSON($response);

    }

    public function updateAddress()
    {

        $response = array();

        $fields['h_id'] = $this->request->getPost('h_id');
        $division = $this->request->getPost('division');
        $zila = $this->request->getPost('zila');
        $upazila = $this->request->getPost('upazila');


        $where = ['division' => $division, 'zila' => $zila, 'upazila' => $upazila,];

        $gloadd = $this->globaladdressModel->where($where);


        if ($gloadd->countAllResults() != 0) {

            $gloadress = $this->globaladdressModel->where($where);
            $fields['global_address_id'] = $gloadress->first()->global_address_id;

            if ($this->hospitalModel->update($fields['h_id'], $fields)) {
                $response['success'] = true;
                $response['messages'] = 'Successfully updated';
            } else {
                $response['success'] = false;
                $response['messages'] = 'Update error!';
            }

        } else {
            $response['success'] = false;
            $response['messages'] = 'Global Address Not Found!';
        }


        return $this->response->setJSON($response);

    }

    public function updateImage()
    {
        $response = array();

        $fields['h_id'] = $this->request->getPost('h_id');
        $logo = $this->request->getFile('logo');
        $image = $this->request->getFile('image');
        $banner = $this->request->getFile('banner');

        if (!empty($_FILES['logo']['name'])) {
            $namelogo = $logo->getRandomName();
            $logo->move(FCPATH . '\assets\uplode\hospital',$namelogo);
            $fields['logo'] = $namelogo;
        }

        if (!empty($_FILES['image']['name'])) {
            $nameimg = $image->getRandomName();
            $image->move(FCPATH . '\assets\uplode\hospital',$nameimg);
            $fields['image'] = $nameimg;
        }

        if (!empty($_FILES['banner']['name'])) {
            $namebanner = $banner->getRandomName();
            $banner->move(FCPATH . '\assets\uplode\hospital',$namebanner);
            $fields['banner'] = $namebanner;
        }


        if ($this->hospitalModel->update($fields['h_id'], $fields)) {

            $response['success'] = true;
            $response['messages'] = 'Successfully updated';

        } else {

            $response['success'] = false;
            $response['messages'] = 'Update error!';

        }


        return $this->response->setJSON($response);
    }

}	