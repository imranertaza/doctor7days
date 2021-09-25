<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers\Hospital_admin;

use App\Controllers\BaseController;

use App\Models\Hospital_admin\DoctorModel;

class Doctor extends BaseController
{

    protected $doctorModel;
    protected $validation;

    public function __construct()
    {
        $this->doctorModel = new DoctorModel();
        $this->validation = \Config\Services::validation();

    }

    public function index()
    {

        $data = [
            'controller' => 'Hospital_admin/doctor',
            'title' => 'Doctor'
        ];

        echo view('Hospital_admin/header');
        echo view('Hospital_admin/sidebar');
        echo view('Hospital_admin/Doctor/doctor', $data);
        echo view('Hospital_admin/footer');

    }

    public function getAll()
    {
        $response = array();

        $data['data'] = array();

        $result = $this->doctorModel->select('doc_id, name, email, mobile, password, pic, specialist_id, role_id, nid, h_id, description, createdDtm, createdBy, updatedDtm, updatedBy, deleted, deletedRole')->findAll();

        foreach ($result as $key => $value) {

            $ops = '<div class="btn-group">';
            $ops .= '<a href="' . base_url() . '/hospital_admin/doctor/update/' . $value->doc_id . '" class="btn btn-sm btn-info" ><i class="fa fa-edit"></i></a>';
            $ops .= '	<button type="button" class="btn btn-sm btn-danger" onclick="remove(' . $value->doc_id . ')"><i class="fa fa-trash"></i></button>';
            $ops .= '</div>';

            $data['data'][$key] = array(
                $value->doc_id,
                $value->name,
                $value->email,
                $value->mobile,
                get_data_by_id('specialist_type_name', 'specialist', 'specialist_id', $value->specialist_id),
                $ops,
            );
        }

        return $this->response->setJSON($data);
    }

    public function update($id)
    {
        $result = $this->doctorModel->where('doc_id', $id)->first();
        $data = [
            'controller' => 'Hospital_admin/doctor',
            'doctor' => $result,
        ];
        echo view('Hospital_admin/header');
        echo view('Hospital_admin/sidebar');
        echo view('Hospital_admin/Doctor/update_form', $data);
        echo view('Hospital_admin/footer');
    }

    public function updateReg()
    {
        $response = array();

        $fields['doc_id'] = $this->request->getPost('doc_id');
        $fields['name'] = $this->request->getPost('name');
        $fields['email'] = $this->request->getPost('email');
        $fields['mobile'] = $this->request->getPost('mobile');
        $fields['password'] = SHA1($this->request->getPost('password'));
        $fields['con_password'] = SHA1($this->request->getPost('con_password'));
        $fields['specialist_id'] = $this->request->getPost('specialistId');

        $this->validation->setRules([
            'name' => ['label' => 'Name', 'rules' => 'required|max_length[155]'],
            'email' => ['label' => 'Email', 'rules' => 'required|max_length[155]'],
            'mobile' => ['label' => 'Mobile', 'rules' => 'required|numeric|max_length[11]'],
            'password' => ['label' => 'Password', 'rules' => 'required'],
            'con_password' => ['label' => 'Confirm Password', 'rules' => 'required|matches[password]'],
            'specialist_id' => ['label' => 'Specialist', 'rules' => 'required'],


        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
            $response['messages'] = $this->validation->listErrors();

        } else {

            if ($this->doctorModel->update($fields['doc_id'], $fields)) {

                $response['success'] = true;
                $response['messages'] = 'Data has been inserted successfully';

            } else {

                $response['success'] = false;
                $response['messages'] = 'Insertion error!';

            }
        }

        return $this->response->setJSON($response);
    }

    public function updateImage()
    {
        $response = array();

        $fields['doc_id'] = $this->request->getPost('doc_id');
        $logo = $this->request->getFile('pic');


        if (!empty($_FILES['pic']['name'])) {
            $name = $logo->getRandomName();
            $logo->move(FCPATH . '\assets\uplode\doctor',$name);
            $fields['pic'] = $name;
            if ($this->doctorModel->update($fields['doc_id'],$fields)) {
                $response['success'] = true;
                $response['messages'] = 'Data has been Update successfully';
            } else {
                $response['success'] = false;
                $response['messages'] = 'Insertion error!';
            }
        }
        //return $this->response->setJSON($response);
    }

    public function updateBasic()
    {
        $response = array();

        $fields['doc_id'] = $this->request->getPost('doc_id');
        $fields['nid'] = $this->request->getPost('nid');
        $fields['description'] = $this->request->getPost('description');


        if ($this->doctorModel->update($fields['doc_id'], $fields)) {

            $response['success'] = true;
            $response['messages'] = 'Data has been inserted successfully';

        } else {

            $response['success'] = false;
            $response['messages'] = 'Insertion error!';

        }


        return $this->response->setJSON($response);
    }

    public function getOne()
    {
        $response = array();

        $id = $this->request->getPost('doc_id');

        if ($this->validation->check($id, 'required|numeric')) {

            $data = $this->doctorModel->where('doc_id', $id)->first();

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
        $fields['mobile'] = $this->request->getPost('mobile');
        $fields['password'] = SHA1($this->request->getPost('password'));
        $fields['con_password'] = SHA1($this->request->getPost('con_password'));
        $fields['specialist_id'] = $this->request->getPost('specialistId');
        $fields['role_id'] = '1';
        $fields['h_id'] = '1';

        $this->validation->setRules([
            'name' => ['label' => 'Name', 'rules' => 'required|max_length[155]'],
            'email' => ['label' => 'Email', 'rules' => 'required|max_length[155]'],
            'mobile' => ['label' => 'Mobile', 'rules' => 'required|numeric|max_length[11]'],
            'password' => ['label' => 'Password', 'rules' => 'required'],
            'con_password' => ['label' => 'Confirm Password', 'rules' => 'required|matches[password]'],
            'specialist_id' => ['label' => 'Specialist', 'rules' => 'required'],


        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
            $response['messages'] = $this->validation->listErrors();

        } else {

            if ($this->doctorModel->insert($fields)) {

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

        $fields['doc_id'] = $this->request->getPost('docId');
        $fields['name'] = $this->request->getPost('name');
        $fields['email'] = $this->request->getPost('email');
        $fields['mobile'] = $this->request->getPost('mobile');
        $fields['password'] = $this->request->getPost('password');
        $fields['pic'] = $this->request->getPost('pic');
        $fields['specialist_id'] = $this->request->getPost('specialistId');
        $fields['role_id'] = $this->request->getPost('roleId');
        $fields['nid'] = $this->request->getPost('nid');
        $fields['h_id'] = $this->request->getPost('hId');
        $fields['description'] = $this->request->getPost('description');
        $fields['createdDtm'] = $this->request->getPost('createdDtm');
        $fields['createdBy'] = $this->request->getPost('createdBy');
        $fields['updatedDtm'] = $this->request->getPost('updatedDtm');
        $fields['updatedBy'] = $this->request->getPost('updatedBy');
        $fields['deleted'] = $this->request->getPost('deleted');
        $fields['deletedRole'] = $this->request->getPost('deletedRole');


        $this->validation->setRules([
            'name' => ['label' => 'Name', 'rules' => 'required|max_length[155]'],
            'email' => ['label' => 'Email', 'rules' => 'required|max_length[155]'],
            'mobile' => ['label' => 'Mobile', 'rules' => 'required|numeric|max_length[11]'],
            'password' => ['label' => 'Password', 'rules' => 'required'],
            'pic' => ['label' => 'Pic', 'rules' => 'required|max_length[155]'],
            'specialist_id' => ['label' => 'Specialist id', 'rules' => 'required|numeric|max_length[11]'],
            'role_id' => ['label' => 'Role id', 'rules' => 'required|numeric|max_length[11]'],
            'nid' => ['label' => 'Nid', 'rules' => 'required|max_length[155]'],
            'h_id' => ['label' => 'H id', 'rules' => 'required|numeric|max_length[11]'],
            'description' => ['label' => 'Description', 'rules' => 'required'],
            'createdDtm' => ['label' => 'CreatedDtm', 'rules' => 'required'],
            'createdBy' => ['label' => 'CreatedBy', 'rules' => 'required|numeric|max_length[11]'],
            'updatedDtm' => ['label' => 'UpdatedDtm', 'rules' => 'required'],
            'updatedBy' => ['label' => 'UpdatedBy', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'deleted' => ['label' => 'Deleted', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'deletedRole' => ['label' => 'DeletedRole', 'rules' => 'permit_empty|numeric|max_length[11]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
            $response['messages'] = $this->validation->listErrors();

        } else {

            if ($this->doctorModel->update($fields['doc_id'], $fields)) {

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

        $id = $this->request->getPost('doc_id');

        if (!$this->validation->check($id, 'required|numeric')) {

            throw new \CodeIgniter\Exceptions\PageNotFoundException();

        } else {

            if ($this->doctorModel->where('doc_id', $id)->delete()) {

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