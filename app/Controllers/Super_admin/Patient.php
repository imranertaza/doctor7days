<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers\Super_admin;

use App\Controllers\BaseController;
use App\Libraries\Permission;
use App\Models\Super_admin\GlobaladdressModel;
use App\Models\Super_admin\PatientModel;

class Patient extends BaseController
{

    protected $patientModel;
    protected $globaladdressModel;
    protected $validation;
    protected $session;
    protected $crop;
    protected $permission;
    private $module_name = 'Patients';

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->patientModel = new PatientModel();
        $this->validation = \Config\Services::validation();
        $this->permission = new Permission();
        $this->globaladdressModel = new GlobaladdressModel();
        $this->crop = \Config\Services::image();
    }

    public function index()
    {
        $isLoggedIAdmin = $this->session->isLoggedIAdmin;
        $role_id = $this->session->AdminRole;

        if (isset($isLoggedIAdmin)) {

            $data = [
                'controller' => 'Super_admin/patient',
                'title' => 'Patients'
            ];

            $perm = $this->permission->module_permission_list($role_id, $this->module_name);
            foreach ($perm as $key => $val) {
                $data[$key] = $this->permission->have_access($role_id, $this->module_name, $key);
            }


            echo view('Super_admin/header');
            echo view('Super_admin/sidebar');
            if ($data['mod_access'] == 1) {
                echo view('Super_admin/Patient/patient', $data);
            } else {
                echo view('Super_admin/No_permission', $data);
            }

            echo view('Super_admin/footer');
        } else {
            return redirect()->to(site_url("/super_admin/login"));
        }

    }

    public function getAll()
    {
        $response = array();

        $data['data'] = array();

        $result = $this->patientModel->select('pat_id, name, email, phone, password, global_address_id, photo, nid, age, createdDtm, createdBy, updatedDtm, updatedBy, deleted, deletedRole')->findAll();

        foreach ($result as $key => $value) {

            $ops = '<div class="btn-group">';
//            $ops .= '	<button type="button" class="btn btn-sm btn-info" onclick="edit(' . $value->pat_id . ')"><i class="fa fa-edit"></i></button>';
            $ops .= '	<a href="' . base_url('Super_admin/Patient/update/' . $value->pat_id) . '" class="btn btn-sm btn-info" ><i class="fa fa-edit"></i></a>';
            $ops .= '	<button type="button" class="btn btn-sm btn-danger" onclick="remove(' . $value->pat_id . ')"><i class="fa fa-trash"></i></button>';
            $ops .= '</div>';

            $data['data'][$key] = array(
                $value->pat_id,
                $value->name,
                $value->email,
                $value->phone,
                '<img src="' . base_url('assets/upload/patient/'.$value->pat_id.'/'. $value->photo) . '" width="80">',
                $value->nid,
                $value->age,

                $ops,
            );
        }

        return $this->response->setJSON($data);
    }

    public function update($id)
    {
        $isLoggedIAdmin = $this->session->isLoggedIAdmin;
        $role_id = $this->session->AdminRole;

        if (isset($isLoggedIAdmin)) {
            $result = $this->patientModel->where('pat_id', $id)->first();
            $data = [
                'controller' => 'Super_admin/patient',
                'title' => 'Patients',
                'patient' => $result,
            ];

            $perm = $this->permission->module_permission_list($role_id, $this->module_name);
            foreach ($perm as $key => $val) {
                $data[$key] = $this->permission->have_access($role_id, $this->module_name, $key);
            }


            echo view('Super_admin/header');
            echo view('Super_admin/sidebar');
            if ($data['update'] == 1) {
                echo view('Super_admin/Patient/update', $data);
            } else {
                echo view('Super_admin/No_permission', $data);
            }
            echo view('Super_admin/footer');
        } else {
            return redirect()->to(site_url("/super_admin/login"));
        }
    }

    public function getOne()
    {
        $response = array();

        $id = $this->request->getPost('pat_id');

        if ($this->validation->check($id, 'required|numeric')) {

            $data = $this->patientModel->where('pat_id', $id)->first();

            return $this->response->setJSON($data);

        } else {

            throw new \CodeIgniter\Exceptions\PageNotFoundException();

        }

    }

    public function add()
    {

        $response = array();


        $fields['name'] = $this->request->getPost('name');
        $fields['email'] = $this->request->getPost('email');
        $fields['phone'] = $this->request->getPost('phone');
        $fields['password'] = SHA1($this->request->getPost('password'));
        $fields['nid'] = $this->request->getPost('nid');
        $fields['age'] = $this->request->getPost('age');

//        if (!empty($_FILES['photo']['name'])) {
//
//            $photo = $this->request->getFile('photo');
//            $name = $photo->getRandomName();
//            $photo->move(FCPATH . '\assets\upload\patient', $name);
//            $fields['photo'] = $name;
//        }


        $this->validation->setRules([
            'name' => ['label' => 'Name', 'rules' => 'required|max_length[155]'],
            'email' => ['label' => 'Email', 'rules' => 'required|max_length[155]'],
            'phone' => ['label' => 'Phone', 'rules' => 'required|numeric|max_length[11]'],
            'password' => ['label' => 'Password', 'rules' => 'required'],
            'age' => ['label' => 'Age', 'rules' => 'required|numeric|max_length[11]'],
        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
            $response['messages'] = $this->validation->listErrors();

        } else {

            if ($this->patientModel->insert($fields)) {

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

        $fields['pat_id'] = $this->request->getPost('patId');
        $fields['name'] = $this->request->getPost('name');
        $fields['email'] = $this->request->getPost('email');
        $fields['phone'] = $this->request->getPost('phone');
        $fields['password'] = $this->request->getPost('password');
        $fields['global_address_id'] = $this->request->getPost('globalAddressId');
        $fields['photo'] = $this->request->getPost('photo');
        $fields['nid'] = $this->request->getPost('nid');
        $fields['age'] = $this->request->getPost('age');
        $fields['createdDtm'] = $this->request->getPost('createdDtm');
        $fields['createdBy'] = $this->request->getPost('createdBy');
        $fields['updatedDtm'] = $this->request->getPost('updatedDtm');
        $fields['updatedBy'] = $this->request->getPost('updatedBy');
        $fields['deleted'] = $this->request->getPost('deleted');
        $fields['deletedRole'] = $this->request->getPost('deletedRole');


        $this->validation->setRules([
            'name' => ['label' => 'Name', 'rules' => 'required|max_length[155]'],
            'email' => ['label' => 'Email', 'rules' => 'required|max_length[155]'],
            'phone' => ['label' => 'Phone', 'rules' => 'required|numeric|max_length[11]'],
            'password' => ['label' => 'Password', 'rules' => 'required'],
            'global_address_id' => ['label' => 'Global address id', 'rules' => 'required|numeric|max_length[11]'],
            'photo' => ['label' => 'Photo', 'rules' => 'required|max_length[155]'],
            'nid' => ['label' => 'Nid', 'rules' => 'required|max_length[155]'],
            'age' => ['label' => 'Age', 'rules' => 'required|numeric|max_length[11]'],
            'createdDtm' => ['label' => 'CreatedDtm', 'rules' => 'required'],
            'createdBy' => ['label' => 'CreatedBy', 'rules' => 'required|numeric|max_length[11]'],
            'updatedDtm' => ['label' => 'UpdatedDtm', 'rules' => 'required'],
            'updatedBy' => ['label' => 'UpdatedBy', 'rules' => 'required|numeric|max_length[11]'],
            'deleted' => ['label' => 'Deleted', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'deletedRole' => ['label' => 'DeletedRole', 'rules' => 'permit_empty|numeric|max_length[11]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
            $response['messages'] = $this->validation->listErrors();

        } else {

            if ($this->patientModel->update($fields['pat_id'], $fields)) {

                $response['success'] = true;
                $response['messages'] = 'Successfully updated';

            } else {

                $response['success'] = false;
                $response['messages'] = 'Update error!';

            }
        }

        return $this->response->setJSON($response);

    }

    public function updateReg(){
        $response = array();


        $fields['pat_id'] = $this->request->getPost('pat_id');
        $fields['name'] = $this->request->getPost('name');
        $fields['email'] = $this->request->getPost('email');
        $fields['phone'] = $this->request->getPost('phone');
        $fields['nid'] = $this->request->getPost('nid');
        $fields['age'] = $this->request->getPost('age');

        $pass = SHA1($this->request->getPost('password'));
        if (!empty($pass)){
            $fields['password'] = $pass;
        }


        $this->validation->setRules([
            'name' => ['label' => 'Name', 'rules' => 'required|max_length[155]'],
            'email' => ['label' => 'Email', 'rules' => 'required|max_length[155]'],
            'phone' => ['label' => 'Phone', 'rules' => 'required|numeric|max_length[11]'],
            'age' => ['label' => 'Age', 'rules' => 'required|numeric|max_length[11]'],
        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
            $response['messages'] = $this->validation->listErrors();

        } else {

            if ($this->patientModel->update($fields['pat_id'], $fields)) {

                $response['success'] = true;
                $response['messages'] = 'Successfully updated';

            } else {

                $response['success'] = false;
                $response['messages'] = 'Insertion error!';

            }
        }

        return $this->response->setJSON($response);


    }

    public function updateAddress(){

        $response = array();

        $fields['pat_id'] = $this->request->getPost('pat_id');
        $division = $this->request->getPost('division');
        $zila = $this->request->getPost('zila');
        $upazila = $this->request->getPost('upazila');
        $where = array(
            'division' => $division,
            'zila' => $zila,
            'upazila' => $upazila
        );
        $gloadd = $this->globaladdressModel->where($where);

        if ($gloadd->countAllResults() != 0){
            $glo = $this->globaladdressModel->where($where);
            $fields['global_address_id'] = $glo->first()->global_address_id;
            if ($this->patientModel->update($fields['pat_id'], $fields)) {
                $response['success'] = true;
                $response['messages'] = 'Data has been Update successfully';
            } else {
                $response['success'] = false;
                $response['messages'] = 'Insertion error!';
            }
        }else{
            $response['success'] = false;
            $response['messages'] = 'your address not found!';
        }


        return $this->response->setJSON($response);
    }

    public function updateImage(){
        $response = array();

        $fields['pat_id'] = $this->request->getPost('pat_id');

        if (!empty($_FILES['photo']['name'])) {
            $target_dir = FCPATH . 'assets/upload/patient/'.$fields['pat_id'].'/';
            if(!file_exists($target_dir)){
                mkdir($target_dir,0777);
            }
            $photo = $this->request->getFile('photo');

            $name = $photo->getRandomName();
            $photo->move($target_dir, $name);

            $lo_nameimg = 'pa_'.$photo->getName();
            $this->crop->withFile($target_dir.''.$name)->fit(100, 100, 'center')->save($target_dir.''.$lo_nameimg);
            unlink($target_dir.''.$name);

            $fields['photo'] = $lo_nameimg;
        }

        if ($this->patientModel->update($fields['pat_id'], $fields)) {
            $response['success'] = true;
            $response['messages'] = 'Data has been Update successfully';
        } else {
            $response['success'] = false;
            $response['messages'] = 'Insertion error!';
        }

        return $this->response->setJSON($response);
    }

    public function remove()
    {
        $response = array();

        $id = $this->request->getPost('pat_id');

        if (!$this->validation->check($id, 'required|numeric')) {

            throw new \CodeIgniter\Exceptions\PageNotFoundException();

        } else {

            if ($this->patientModel->where('pat_id', $id)->delete()) {

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