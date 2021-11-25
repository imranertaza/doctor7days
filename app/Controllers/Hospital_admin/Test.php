<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers\Hospital_admin;

use App\Controllers\BaseController;
use App\Libraries\Permission_hospital;
use App\Models\Hospital_admin\TestModel;

class Test extends BaseController
{
    protected $session;
    protected $validation;
    protected $permission;
    protected $testModel;
    private $module_name = 'Doctor';

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->validation = \Config\Services::validation();
        $this->permission = new Permission_hospital();
        $this->testModel = new TestModel();

    }

    public function index()
    {
        $isLoggedInHospital = $this->session->isLoggedInHospital;
        $role_id = $this->session->hospitalAdminRole;

        if(!isset($isLoggedInHospital) || $isLoggedInHospital != TRUE)
        {
            echo view('Hospital_admin/Login/login');
        }
        else {

            $data = [
                'controller' => 'Hospital_admin/test',
                'title' => 'Tests'
            ];

             $perm = $this->permission->module_permission_list($role_id, $this->module_name);
            foreach($perm as $key=>$val){
                 $data[$key] = $this->permission->have_access($role_id, $this->module_name, $key);
                 
            }


            echo view('Hospital_admin/header');
            echo view('Hospital_admin/sidebar');
            if ($data['mod_access'] == 1) {
                echo view('Hospital_admin/Test/list', $data);
            }else {
                echo view('Hospital_admin/No_permission', $data);
            }
            
            echo view('Hospital_admin/footer');
        }

    }

    public function getAll()
    {
        $response = array();

        $data['data'] = array();

        $result = $this->testModel->where('h_id',$this->session->h_Id)->findAll();

        foreach ($result as $key => $value) {

            $ops = '<div class="btn-group">';
            $ops .= '<button type="button" class="btn btn-sm btn-info" onclick="edit(' . $value->test_id . ')" ><i class="fa fa-edit"></i></button>';
            $ops .= '	<button type="button" class="btn btn-sm btn-danger" onclick="remove(' . $value->test_id . ')"><i class="fa fa-trash"></i></button>';
            $ops .= '</div>';

            $data['data'][$key] = array(
                $value->test_id,
                $value->name,
                $value->description,
                $value->price,
                $ops,
            );
        }

        return $this->response->setJSON($data);
    }

    public function add()
    {
        $response = array();

        $fields['h_id'] = $this->session->h_Id;
        $fields['name'] = $this->request->getPost('name');
        $fields['description'] = $this->request->getPost('description');
        $fields['price'] = $this->request->getPost('price');

        $this->validation->setRules([
            'name' => ['label' => 'Name', 'rules' => 'required|max_length[155]'],
            'description' => ['label' => 'Description', 'rules' => 'required'],
            'price' => ['label' => 'Price', 'rules' => 'required|numeric'],


        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
            $response['messages'] = $this->validation->listErrors();

        } else {

            if ($this->testModel->insert($fields)) {

                $response['success'] = true;
                $response['messages'] = 'Data has been inserted successfully';

            } else {

                $response['success'] = false;
                $response['messages'] = 'Insertion error!';

            }
        }

        return $this->response->setJSON($response);
    }


    public function getOne()
    {
        $response = array();

        $id = $this->request->getPost('test_id');

        if ($this->validation->check($id, 'required|numeric')) {

            $data = $this->testModel->where('test_id', $id)->first();

            return $this->response->setJSON($data);

        } else {

            throw new \CodeIgniter\Exceptions\PageNotFoundException();

        }

    }



    public function edit()
    {

        $response = array();

        $fields['test_id'] = $this->request->getPost('test_id');
        $fields['name'] = $this->request->getPost('name');
        $fields['description'] = $this->request->getPost('description');
        $fields['price'] = $this->request->getPost('price');


        $this->validation->setRules([
            'name' => ['label' => 'Name', 'rules' => 'required|max_length[155]'],
            'description' => ['label' => 'Description', 'rules' => 'required'],
            'price' => ['label' => 'Price', 'rules' => 'required|numeric'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
            $response['messages'] = $this->validation->listErrors();

        } else {

            if ($this->testModel->update($fields['test_id'], $fields)) {

                $response['success'] = true;
                $response['messages'] = 'Successfully updated';

            } else {

                $response['success'] = false;
                $response['messages'] = 'Update error!';

            }
        }

        return $this->response->setJSON($response);

    }

    public function remove()
    {
        $response = array();

        $id = $this->request->getPost('test_id');

        if (!$this->validation->check($id, 'required|numeric')) {

            throw new \CodeIgniter\Exceptions\PageNotFoundException();

        } else {

            if ($this->testModel->where('test_id', $id)->delete()) {

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