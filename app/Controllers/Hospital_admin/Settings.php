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
    protected $crop;
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
        $this->crop = \Config\Services::image();

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
            if (empty($glob)){
                $glob = (object) array(
                    "division" => 0,
                    "zila" => 0,
                    "upazila" => 0,
                );
            }
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
        $target_dir = FCPATH . 'assets/upload/hospital/'.$fields['h_id'].'/';
        if(!file_exists($target_dir)){
            mkdir($target_dir,0777);
        }


        if (!empty($_FILES['logo']['name'])) {
            $namelogo = $logo->getRandomName();
            $logo->move($target_dir,$namelogo);
            $lo_nameimg = 'lo_'.$logo->getName();
            $this->crop->withFile($target_dir.''.$namelogo)->fit(220, 80, 'center')->save($target_dir.''.$lo_nameimg);
            unlink($target_dir.''.$namelogo);
            $fields['logo'] = $lo_nameimg;
        }


        if (!empty($_FILES['image']['name'])) {

            $nameimg = $image->getRandomName();
            $image->move($target_dir, $nameimg);
            $re_nameimg = 're_'.$image->getName();
            $this->crop->withFile($target_dir.''.$nameimg)->fit(360, 122,'center')->save($target_dir.''.$re_nameimg);
            unlink($target_dir.''.$nameimg);
            $fields['image'] = $re_nameimg;
        }


        if (!empty($_FILES['banner_1']['name'])) {
            $banner = $this->request->getFile('banner_1');
            $namebanner = $banner->getRandomName();
            $banner->move($target_dir,$namebanner);

            $n1img = 'bn_1_'.$banner->getName();
            $this->crop->withFile($target_dir.''.$namebanner)->fit(328, 185, 'center')->save($target_dir.''.$n1img);
            unlink($target_dir.''.$namebanner);
            $fields['banner_1'] = $n1img;
        }

        if (!empty($_FILES['banner_2']['name'])) {
            $banner2 = $this->request->getFile('banner_2');
            $namebanner1 = $banner2->getRandomName();
            $banner2->move($target_dir,$namebanner1);

            $n2img = 'bn_2_'.$banner2->getName();
            $this->crop->withFile($target_dir.''.$namebanner1)->fit(328, 185, 'center')->save($target_dir.''.$n2img);
            unlink($target_dir.''.$namebanner1);
            $fields['banner_2'] = $n2img;
        }

        if (!empty($_FILES['banner_3']['name'])) {
            $banner3 = $this->request->getFile('banner_3');
            $namebanner2 = $banner3->getRandomName();
            $banner3->move($target_dir,$namebanner2);

            $n3img = 'bn_3_'.$banner3->getName();
            $this->crop->withFile($target_dir.''.$namebanner2)->fit(328, 185, 'center')->save($target_dir.''.$n3img);
            unlink($target_dir.''.$namebanner2);
            $fields['banner_3'] = $n3img;
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