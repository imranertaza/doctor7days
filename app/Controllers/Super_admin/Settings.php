<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers\Super_admin;

use App\Controllers\BaseController;

use App\Models\Hospital_admin\AdminModel;
use App\Models\Hospital_admin\GlobaladdressModel;
use App\Models\Mobile_app\OrderModel;
use App\Models\Super_admin\OrderItemModel;
use App\Libraries\Permission;

class Settings extends BaseController
{

    protected $orderItemModel;
    protected $globaladdressModel;
    protected $orderModel;
    protected $adminModel;
    protected $validation;
    protected $crop;
    protected $session;
    protected $permission;
    private $module_name = 'OrderItem';

    public function __construct()
    {
        $this->orderItemModel = new OrderItemModel();
        $this->orderModel = new OrderModel();
        $this->adminModel = new AdminModel();
        $this->globaladdressModel = new GlobaladdressModel();
        $this->validation = \Config\Services::validation();
        $this->session = \Config\Services::session();
        $this->permission = new Permission();
        $this->crop = \Config\Services::image();

    }

    public function index()
    {
        $isLoggedIAdmin = $this->session->isLoggedIAdmin;
        $role_id = $this->session->AdminRole;
        if (isset($isLoggedIAdmin)) {
            $userId = $this->session->admin_id;
            $user = $this->adminModel->find($userId);
            $data = [
                'controller' => 'Super_admin/Settings',
                'title' => 'Settings',
                'user' => $user,
            ];
            $perm = $this->permission->module_permission_list($role_id, $this->module_name);
            foreach ($perm as $key => $val) {
                $data[$key] = $this->permission->have_access($role_id, $this->module_name, $key);
            }
            echo view('Super_admin/header');
            echo view('Super_admin/sidebar');
            if ($data['mod_access'] == 1) {
                echo view('Super_admin/Settings/setting', $data);
            } else {
                echo view('Super_admin/No_permission', $data);
            }
            echo view('Super_admin/footer');
        } else {
            return redirect()->to(site_url("/super_admin/login"));
        }

    }

    public function updateReg(){
        $response = array();

        $fields['admin_id'] = $this->request->getPost('admin_id');
        $fields['name'] = $this->request->getPost('name');
        $fields['email'] = $this->request->getPost('email');
        $fields['mobile'] = $this->request->getPost('phone');
        if (!empty($this->request->getPost('password'))) {
            $fields['password'] = SHA1($this->request->getPost('password'));
        }


        $this->validation->setRules([
            'name' => ['label' => 'Name', 'rules' => 'required|max_length[155]'],
            'email' => ['label' => 'Email', 'rules' => 'permit_empty|required|max_length[30]'],
            'mobile' => ['label' => 'Mobile', 'rules' => 'permit_empty|required|numeric|max_length[11]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
            $response['messages'] = $this->validation->listErrors();

        } else {

            if ($this->adminModel->update($fields['admin_id'], $fields)) {

                $response['success'] = true;
                $response['messages'] = 'Data has been Update successfully';

            } else {

                $response['success'] = false;
                $response['messages'] = 'Insertion error!';

            }
        }

        return $this->response->setJSON($response);
    }

    public function updateBasic(){
        $response = array();

        $fields['admin_id'] = $this->request->getPost('admin_id');
        $fields['comName'] = $this->request->getPost('comName');
        $fields['address'] = $this->request->getPost('address');


        if ($this->adminModel->update($fields['admin_id'], $fields)) {
            $response['success'] = true;
            $response['messages'] = 'Data has been Update successfully';
        } else {
            $response['success'] = false;
            $response['messages'] = 'Insertion error!';
        }

        return $this->response->setJSON($response);
    }

    public function updateImage(){
        $response = array();

        $fields['admin_id'] = $this->request->getPost('admin_id');

        $target_dir = FCPATH . '/assets/upload/superAdmin/'.$fields['admin_id'].'/';
        if(!file_exists($target_dir)){
            mkdir($target_dir,0655);
        }
        $logo = $this->request->getFile('pic');
        $namelogo = $logo->getRandomName();
        $logo->move($target_dir,$namelogo);
//        $lo_nameimg = 'lo_'.$logo->getName();
//        $this->crop->withFile($target_dir.''.$namelogo)->fit(220, 80, 'center')->save($target_dir.''.$lo_nameimg);
//        unlink($target_dir.''.$namelogo);
        $fields['pic'] = $namelogo;
//        $fields['pic'] = $lo_nameimg;

        if ($this->adminModel->update($fields['admin_id'], $fields)) {
            $response['success'] = true;
            $response['messages'] = 'Data has been Update successfully';
        } else {
            $response['success'] = false;
            $response['messages'] = 'Insertion error!';
        }

        return $this->response->setJSON($response);
    }



}	