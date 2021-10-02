<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers\Super_admin;

use App\Controllers\BaseController;

use App\Models\Super_admin\AmbulanceModel;
use App\Models\Super_admin\GlobaladdressModel;

class Ambulance extends BaseController
{

    protected $ambulanceModel;
    protected $validation;
    protected $globaladdressModel;

    public function __construct()
    {
        $this->ambulanceModel = new AmbulanceModel();
        $this->globaladdressModel = new GlobaladdressModel();
        $this->validation = \Config\Services::validation();

    }

    public function index()
    {

        $data = [
            'controller' => 'Super_admin/ambulance',
            'title' => 'Ambulance'
        ];

        echo view('Super_admin/header');
        echo view('Super_admin/sidebar');
        echo view('Super_admin/Ambulance/ambulance', $data);
        echo view('Super_admin/footer');

    }

    public function getAll()
    {
        $response = array();

        $data['data'] = array();

        $result = $this->ambulanceModel->select('amb_id, mobile, password, contact_name, oxygen, ac, car_model_name, description, createdDtm, createdBy, updatedDtm, updatedBy, deleted, deletedRole')->findAll();

        foreach ($result as $key => $value) {

            $ops = '<div class="btn-group">';
            $ops .= '	<a href="' . base_url() . '/Super_admin/ambulance/update/' . $value->amb_id . '" class="btn btn-sm btn-info" ><i class="fa fa-edit"></i></a>';
            $ops .= '	<button type="button" class="btn btn-sm btn-danger" onclick="remove(' . $value->amb_id . ')"><i class="fa fa-trash"></i></button>';
            $ops .= '</div>';

            $data['data'][$key] = array(
                $value->amb_id,
                $value->mobile,
                $value->contact_name,
                $value->oxygen,
                $value->ac,
                $value->car_model_name,

                $ops,
            );
        }

        return $this->response->setJSON($data);
    }

    public function update($id)
    {
        $amb = $this->ambulanceModel->where('amb_id', $id)->first();


        $data['controller'] = 'Super_admin/ambulance';
        $data['ambulance'] = $amb;

        echo view('Super_admin/header');
        echo view('Super_admin/sidebar');
        echo view('Super_admin/Ambulance/update_form', $data);
        echo view('Super_admin/footer');
    }

    public function updateReg()
    {
        $response = array();

        $fields['amb_id'] = $this->request->getPost('ambId');
        $fields['mobile'] = $this->request->getPost('mobile');
        $fields['password'] = SHA1($this->request->getPost('password'));
        $fields['con_password'] = SHA1($this->request->getPost('con_password'));
        $fields['contact_name'] = $this->request->getPost('contactName');


        $this->validation->setRules([
            'mobile' => ['label' => 'Mobile', 'rules' => 'required|numeric|max_length[11]'],
            'contact_name' => ['label' => 'Contact name', 'rules' => 'required|max_length[155]'],
            'password' => ['label' => 'Password', 'rules' => 'required|min_length[6]'],
            'con_password' => ['label' => 'ConfirmPassword', 'rules' => 'required|matches[password]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
            $response['messages'] = $this->validation->listErrors();

        } else {

            if ($this->ambulanceModel->update($fields['amb_id'], $fields)) {

                $response['success'] = true;
                $response['messages'] = 'Data has been updated successfully';

            } else {

                $response['success'] = false;
                $response['messages'] = 'Insertion error!';

            }
        }

        return $this->response->setJSON($response);
    }

    public function updateBasic()
    {
        $response = array();

        $fields['amb_id'] = $this->request->getPost('ambId');
        $fields['oxygen'] = $this->request->getPost('oxygen');
        $fields['ac'] = $this->request->getPost('ac');
        $fields['car_model_name'] = $this->request->getPost('car_model_name');
        $fields['description'] = $this->request->getPost('description');


        if ($this->ambulanceModel->update($fields['amb_id'], $fields)) {

            $response['success'] = true;
            $response['messages'] = 'Data has been updated successfully';

        } else {

            $response['success'] = false;
            $response['messages'] = 'Insertion error!';

        }


        return $this->response->setJSON($response);
    }

    public function updateImage(){
        $response = array();

        $fields['amb_id'] = $this->request->getPost('amb_id');
        $image = $this->request->getFile('image');


        if (!empty($_FILES['image']['name'])) {
            $name = $image->getRandomName();
            $image->move(FCPATH . '\assets\uplode\ambulance',$name);
            $fields['image'] = $name;
            if ($this->ambulanceModel->update($fields['amb_id'], $fields)) {
                $response['success'] = true;
                $response['messages'] = 'Image has been Update successfully';
            } else {
                $response['success'] = false;
                $response['messages'] = 'Insertion error!';
            }
        }
        return $this->response->setJSON($response);
    }

    public function updateAddress(){
        $response = array();

        $fields['amb_id'] = $this->request->getPost('amb_id');
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
            $fields['global_address_id'] = $gloadd->first()->global_address_id;
            if ($this->ambulanceModel->update($fields['amb_id'], $fields)) {
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

    public function getOne()
    {
        $response = array();

        $id = $this->request->getPost('amb_id');

        if ($this->validation->check($id, 'required|numeric')) {

            $data = $this->ambulanceModel->where('amb_id', $id)->first();

            return $this->response->setJSON($data);

        } else {

            throw new \CodeIgniter\Exceptions\PageNotFoundException();

        }

    }

    public function add()
    {

        $response = array();


        $fields['mobile'] = $this->request->getPost('mobile');
        $fields['password'] = SHA1($this->request->getPost('password'));
        $fields['con_password'] = SHA1($this->request->getPost('con_password'));
        $fields['contact_name'] = $this->request->getPost('contactName');


        $this->validation->setRules([
            'mobile' => ['label' => 'Mobile', 'rules' => 'required|numeric|max_length[11]'],
            'contact_name' => ['label' => 'Contact name', 'rules' => 'required|max_length[155]'],
            'password' => ['label' => 'Password', 'rules' => 'required|min_length[6]'],
            'con_password' => ['label' => 'ConfirmPassword', 'rules' => 'required|matches[password]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
            $response['messages'] = $this->validation->listErrors();

        } else {

            if ($this->ambulanceModel->insert($fields)) {

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

        $fields['amb_id'] = $this->request->getPost('ambId');
        $fields['mobile'] = $this->request->getPost('mobile');
        $fields['password'] = $this->request->getPost('password');
        $fields['contact_name'] = $this->request->getPost('contactName');
        $fields['oxygen'] = $this->request->getPost('oxygen');
        $fields['ac'] = $this->request->getPost('ac');
        $fields['car_model_name'] = $this->request->getPost('carModelName');
        $fields['description'] = $this->request->getPost('description');
        $fields['createdDtm'] = $this->request->getPost('createdDtm');
        $fields['createdBy'] = $this->request->getPost('createdBy');
        $fields['updatedDtm'] = $this->request->getPost('updatedDtm');
        $fields['updatedBy'] = $this->request->getPost('updatedBy');
        $fields['deleted'] = $this->request->getPost('deleted');
        $fields['deletedRole'] = $this->request->getPost('deletedRole');


        $this->validation->setRules([
            'mobile' => ['label' => 'Mobile', 'rules' => 'required|numeric|max_length[11]'],
            'password' => ['label' => 'Password', 'rules' => 'required'],
            'contact_name' => ['label' => 'Contact name', 'rules' => 'required|max_length[155]'],
            'oxygen' => ['label' => 'Oxygen', 'rules' => 'permit_empty'],
            'ac' => ['label' => 'Ac', 'rules' => 'permit_empty'],
            'car_model_name' => ['label' => 'Car model name', 'rules' => 'required|max_length[155]'],
            'description' => ['label' => 'Description', 'rules' => 'required'],
            'createdDtm' => ['label' => 'CreatedDtm', 'rules' => 'required'],
            'createdBy' => ['label' => 'CreatedBy', 'rules' => 'required|numeric|max_length[11]'],
            'updatedDtm' => ['label' => 'UpdatedDtm', 'rules' => 'required'],
            'updatedBy' => ['label' => 'UpdatedBy', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'deleted' => ['label' => 'Deleted', 'rules' => 'required|numeric|max_length[11]'],
            'deletedRole' => ['label' => 'DeletedRole', 'rules' => 'required|numeric|max_length[11]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
            $response['messages'] = $this->validation->listErrors();

        } else {

            if ($this->ambulanceModel->update($fields['amb_id'], $fields)) {

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

        $id = $this->request->getPost('amb_id');

        if (!$this->validation->check($id, 'required|numeric')) {

            throw new \CodeIgniter\Exceptions\PageNotFoundException();

        } else {

            if ($this->ambulanceModel->where('amb_id', $id)->delete()) {

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