<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers\Hospital_admin;

use App\Controllers\BaseController;
use App\Libraries\Permission_hospital;
use App\Models\Hospital_admin\UsersModel;
use App\Models\Mobile_app\GlobaladdressModel;
use App\Models\Super_admin\RolesModel;

class Users extends BaseController
{

    protected $usersModel;
    protected $validation;
    protected $session;
    protected $permission;
    protected $rolesModel;
    protected $crop;
    protected $globaladdressModel;
    private $module_name = 'Users';

    public function __construct()
    {
        $this->usersModel = new UsersModel();
        $this->validation = \Config\Services::validation();
        $this->session = \Config\Services::session();
        $this->permission = new Permission_hospital();
        $this->rolesModel = new RolesModel();
        $this->globaladdressModel = new GlobaladdressModel();
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
            $result = $this->rolesModel->where('h_id', $h_id)->findAll();
            $data = [
                'controller' => 'Hospital_admin/users',
                'title' => 'Users',
                'role' => $result,
            ];

            $perm = $this->permission->module_permission_list($role_id, $this->module_name);
            foreach ($perm as $key => $val) {
                $data[$key] = $this->permission->have_access($role_id, $this->module_name, $key);
            }

            echo view('Hospital_admin/header');
            echo view('Hospital_admin/sidebar');
            if ($data['mod_access'] == 1) {
                echo view('Hospital_admin/Users/users', $data);
            } else {
                echo view('Hospital_admin/No_permission', $data);
            }

            echo view('Hospital_admin/footer');
        }

    }

    public function getAll()
    {

        $data['data'] = array();

        $h_id = $this->session->h_Id;
        $result = $this->usersModel->where('h_id',$h_id)->findAll();
        foreach ($result as $key => $value) {

            $ops = '<div class="btn-group">';
            $ops .= '<a href="' . base_url('Hospital_admin/Users/update/' . $value->user_id) . '"  type="button" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>';
            $ops .= '<button type="button" class="btn btn-sm btn-danger" onclick="remove(' . $value->user_id . ')"><i class="fa fa-trash"></i></button>';
            $ops .= '</div>';
            $data['data'][$key] = array(
                $value->user_id,
                $value->email,
                $value->name,
                $value->mobile,
                statusView($value->status),
                $ops,
            );
        }

        return $this->response->setJSON($data);
    }

    public function update($id)
    {
        $isLoggedInHospital = $this->session->isLoggedInHospital;
        $role_id = $this->session->hospitalAdminRole;

        if (!isset($isLoggedInHospital) || $isLoggedInHospital != TRUE) {
            echo view('Hospital_admin/Login/login');
        } else {
            $h_id = $this->session->h_Id;
            $result = $this->usersModel->where('user_id', $id)->first();
            $roles = $this->rolesModel->where('h_id', $h_id)->findAll();
            $glob = $this->globaladdressModel->where('global_address_id', $result->global_address_id)->first();
            $data = [
                'controller' => 'Hospital_admin/users',
                'title' => 'Users',
                'user' => $result,
                'role' => $roles,
                'globaladdr' => $glob,
            ];

            $perm = $this->permission->module_permission_list($role_id, $this->module_name);
            foreach ($perm as $key => $val) {
                $data[$key] = $this->permission->have_access($role_id, $this->module_name, $key);
            }

            echo view('Hospital_admin/header');
            echo view('Hospital_admin/sidebar');
            if ($data['update'] == 1) {
                echo view('Hospital_admin/Users/update', $data);
            } else {
                echo view('Hospital_admin/No_permission', $data);
            }

            echo view('Hospital_admin/footer');
        }
    }

    public function getOne()
    {
        $response = array();

        $id = $this->request->getPost('user_id');

        if ($this->validation->check($id, 'required|numeric')) {

            $data = $this->usersModel->where('user_id', $id)->first();

            return $this->response->setJSON($data);

        } else {

            throw new \CodeIgniter\Exceptions\PageNotFoundException();

        }

    }

    public function add()
    {

        $response = array();

        $h_id = $this->session->h_Id;
        $fields['h_id'] = $h_id;
        $fields['email'] = $this->request->getPost('email');
        $fields['password'] = SHA1($this->request->getPost('password'));
        $fields['name'] = $this->request->getPost('name');
        $fields['mobile'] = $this->request->getPost('mobile');
        $fields['role_id'] = $this->request->getPost('roleId');
        $fields['status'] = $this->request->getPost('status');
        $fields['createdBy'] = $h_id;


        $this->validation->setRules([
            'email' => ['label' => 'Email', 'rules' => 'required|max_length[30]'],
            'password' => ['label' => 'Password', 'rules' => 'required|max_length[155]'],
            'name' => ['label' => 'Name', 'rules' => 'required|max_length[40]'],
            'mobile' => ['label' => 'Mobile', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'role_id' => ['label' => 'Role id', 'rules' => 'required|numeric|max_length[11]'],
            'status' => ['label' => 'Status', 'rules' => 'required'],

        ]);

        if ($this->validation->run($fields) == FALSE) {
            $response['success'] = false;
            $response['messages'] = $this->validation->listErrors();
        } else {

            if ($this->usersModel->insert($fields)) {
                $response['success'] = true;
                $response['messages'] = 'Data has been inserted successfully';

            } else {
                $response['success'] = false;
                $response['messages'] = 'Insertion error!';
            }
        }

        return $this->response->setJSON($response);
    }

    public function edit()
    {

        $response = array();

        $fields['user_id'] = $this->request->getPost('userId');
        $fields['h_id'] = $this->request->getPost('hId');
        $fields['email'] = $this->request->getPost('email');
        $fields['password'] = $this->request->getPost('password');
        $fields['name'] = $this->request->getPost('name');
        $fields['mobile'] = $this->request->getPost('mobile');
        $fields['global_address_id'] = $this->request->getPost('globalAddressId');
        $fields['pic'] = $this->request->getPost('pic');
        $fields['role_id'] = $this->request->getPost('roleId');
        $fields['status'] = $this->request->getPost('status');
        $fields['is_default'] = $this->request->getPost('isDefault');
        $fields['permission'] = $this->request->getPost('permission');
        $fields['createdBy'] = $this->request->getPost('createdBy');
        $fields['createdDtm'] = $this->request->getPost('createdDtm');
        $fields['updatedBy'] = $this->request->getPost('updatedBy');
        $fields['updatedDtm'] = $this->request->getPost('updatedDtm');
        $fields['deleted'] = $this->request->getPost('deleted');
        $fields['deletedRole'] = $this->request->getPost('deletedRole');


        $this->validation->setRules([
            'h_id' => ['label' => 'H id', 'rules' => 'required|numeric|max_length[11]'],
            'email' => ['label' => 'Email', 'rules' => 'required|max_length[30]'],
            'password' => ['label' => 'Password', 'rules' => 'required|max_length[155]'],
            'name' => ['label' => 'Name', 'rules' => 'required|max_length[40]'],
            'mobile' => ['label' => 'Mobile', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'global_address_id' => ['label' => 'Global address id', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'pic' => ['label' => 'Pic', 'rules' => 'required|max_length[100]'],
            'role_id' => ['label' => 'Role id', 'rules' => 'required|numeric|max_length[11]'],
            'status' => ['label' => 'Status', 'rules' => 'required'],
            'is_default' => ['label' => 'Is default', 'rules' => 'required'],
            'permission' => ['label' => 'Permission', 'rules' => 'required'],
            'createdBy' => ['label' => 'CreatedBy', 'rules' => 'required|numeric|max_length[11]'],
            'createdDtm' => ['label' => 'CreatedDtm', 'rules' => 'required|valid_date'],
            'updatedBy' => ['label' => 'UpdatedBy', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'updatedDtm' => ['label' => 'UpdatedDtm', 'rules' => 'required|valid_date'],
            'deleted' => ['label' => 'Deleted', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'deletedRole' => ['label' => 'DeletedRole', 'rules' => 'permit_empty|numeric|max_length[11]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
            $response['messages'] = $this->validation->listErrors();

        } else {

            if ($this->usersModel->update($fields['user_id'], $fields)) {

                $response['success'] = true;
                $response['messages'] = 'Successfully updated';

            } else {

                $response['success'] = false;
                $response['messages'] = 'Update error!';

            }
        }

        return $this->response->setJSON($response);

    }

    public function updateReg()
    {

        $response = array();
        $pass = $this->request->getPost('password');
        $fields['user_id'] = $this->request->getPost('user_id');
        $fields['email'] = $this->request->getPost('email');

        if (!empty($pass)) {
            $fields['password'] = SHA1($pass);
        }

        $fields['name'] = $this->request->getPost('name');
        $fields['mobile'] = $this->request->getPost('mobile');
        $fields['role_id'] = $this->request->getPost('roleId');
        $fields['status'] = $this->request->getPost('status');


        $this->validation->setRules([
            'email' => ['label' => 'Email', 'rules' => 'required|max_length[30]'],
            'name' => ['label' => 'Name', 'rules' => 'required|max_length[40]'],
        ]);

        if ($this->validation->run($fields) == FALSE) {
            $response['success'] = false;
            $response['messages'] = $this->validation->listErrors();
        } else {

            if ($this->usersModel->update($fields['user_id'], $fields)) {
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

        $fields['user_id'] = $this->request->getPost('user_id');
        $division = $this->request->getPost('division');
        $zila = $this->request->getPost('zila');
        $upazila = $this->request->getPost('upazila');


        $where = ['division' => $division, 'zila' => $zila, 'upazila' => $upazila,];

        $gloadd = $this->globaladdressModel->where($where);


        if ($gloadd->countAllResults() != 0) {

            $gloadress = $this->globaladdressModel->where($where);
            $fields['global_address_id'] = $gloadress->first()->global_address_id;

            if ($this->usersModel->update($fields['user_id'], $fields)) {
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

        $fields['user_id'] = $this->request->getPost('user_id');
        $image = $this->request->getFile('pic');

        $target_dir = FCPATH .'/assets/upload/users/'.$fields['user_id'].'/';
        if(!file_exists($target_dir)){
            mkdir($target_dir,0655);
        }

        if (!empty($_FILES['pic']['name'])) {
            $name = $image->getRandomName();
            $image->move($target_dir,$name);

            $lo_nameimg = 'us_'.$image->getName();
            $this->crop->withFile($target_dir.''.$name)->fit(100, 100, 'center')->save($target_dir.''.$lo_nameimg);
            unlink($target_dir.''.$name);

            $fields['pic'] = $lo_nameimg;
        }


        if ($this->usersModel->update($fields['user_id'], $fields)) {

            $response['success'] = true;
            $response['messages'] = 'Successfully updated';

        } else {

            $response['success'] = false;
            $response['messages'] = 'Update error!';

        }


        return $this->response->setJSON($response);
    }

    public function remove()
    {
        $response = array();

        $id = $this->request->getPost('user_id');

        if (!$this->validation->check($id, 'required|numeric')) {

            throw new \CodeIgniter\Exceptions\PageNotFoundException();

        } else {

            if ($this->usersModel->where('user_id', $id)->delete()) {

                $response['success'] = true;
                $response['messages'] = 'Deletion succeeded';

            } else {

                $response['success'] = false;
                $response['messages'] = 'Deletion error!';

            }
        }

        return $this->response->setJSON($response);
    }

}	