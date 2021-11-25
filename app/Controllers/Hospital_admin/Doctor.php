<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers\Hospital_admin;

use App\Controllers\BaseController;
use App\Libraries\Permission_hospital;
use App\Models\Hospital_admin\DocavailabledayModel;
use App\Models\Hospital_admin\DoctorModel;

class Doctor extends BaseController
{
    protected $session;
    protected $doctorModel;
    protected $validation;
    protected $crop;
    protected $permission;
    protected $docavailabledayModel;
    private $module_name = 'Doctor';

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->doctorModel = new DoctorModel();
        $this->validation = \Config\Services::validation();
        $this->permission = new Permission_hospital();
        $this->docavailabledayModel = new DocavailabledayModel();
        $this->crop = \Config\Services::image();

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
                'controller' => 'Hospital_admin/doctor',
                'title' => 'Doctor'
            ];

             $perm = $this->permission->module_permission_list($role_id, $this->module_name);
            foreach($perm as $key=>$val){
                 $data[$key] = $this->permission->have_access($role_id, $this->module_name, $key);
                 
            }


            echo view('Hospital_admin/header');
            echo view('Hospital_admin/sidebar');
            if ($data['mod_access'] == 1) {
                echo view('Hospital_admin/Doctor/doctor', $data);
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

        $result = $this->doctorModel->select('doc_id, name, email, mobile, password, pic, specialist_id, role_id, nid, h_id, description, createdDtm, createdBy, updatedDtm, updatedBy, deleted, deletedRole')->where('h_id',$this->session->h_Id)->findAll();

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
        $isLoggedInHospital = $this->session->isLoggedInHospital;

        if(!isset($isLoggedInHospital) || $isLoggedInHospital != TRUE)
        {
            echo view('Hospital_admin/Login/login');
        }
        else {
            $result = $this->doctorModel->where('doc_id', $id)->first();
            $abilDoc = $this->docavailabledayModel->where('doc_id', $id)->first();
            $data = [
                'controller' => 'Hospital_admin/doctor',
                'doctor' => $result,
                'day' => $abilDoc,
            ];
            echo view('Hospital_admin/header');
            echo view('Hospital_admin/sidebar');
            echo view('Hospital_admin/Doctor/update_form', $data);
            echo view('Hospital_admin/footer');
        }
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

        $target_dir = FCPATH . '/assets/upload/doctor/'.$fields['doc_id'].'/';
        if(!file_exists($target_dir)){
            mkdir($target_dir,0655);
        }

        if (!empty($_FILES['pic']['name'])) {
            $name = $logo->getRandomName();
            $logo->move($target_dir,$name);

            $lo_nameimg = 'lo_'.$logo->getName();
            $this->crop->withFile($target_dir.''.$name)->fit(100, 100, 'center')->save($target_dir.''.$lo_nameimg);
            unlink($target_dir.''.$name);

            $fields['pic'] = $lo_nameimg;

            if ($this->doctorModel->update($fields['doc_id'],$fields)) {
                $response['success'] = true;
                $response['messages'] = 'Data has been Update successfully';
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

    public function updateApoDay()
    {
        $response = array();
        $h_Id = $this->session->h_Id;

        $fields['doc_avil_id'] = $this->request->getPost('doc_avil_id');
        $fields['saturday'] = $this->request->getPost('saturday');
        $fields['sunday'] = $this->request->getPost('sunday');
        $fields['monday'] = $this->request->getPost('monday');
        $fields['tuesday'] = $this->request->getPost('tuesday');
        $fields['wednesday'] = $this->request->getPost('wednesday');
        $fields['thursday'] = $this->request->getPost('thursday');
        $fields['friday'] = $this->request->getPost('friday');

        $fields['appointment_start_date'] = $this->request->getPost('appointment_start_date');
        $fields['appointment_end_date'] = $this->request->getPost('appointment_end_date');

        $morStartTime = $this->request->getPost('morning_start_hour').':'.$this->request->getPost('morning_start_minute');
        $fields['morning_start_time'] = $morStartTime;

        $morEndTime = $this->request->getPost('morning_end_hour').':'.$this->request->getPost('morning_end_minute');
        $fields['morning_end_time'] = $morEndTime;

        $fields['qty_in_morning'] = $this->request->getPost('qty_in_morning');


        $evStartTime = $this->request->getPost('evening_start_hour').':'.$this->request->getPost('evening_start_minute');
        $fields['evening_start_time'] = $evStartTime;

        $evEndTime = $this->request->getPost('evening_end_hour').':'.$this->request->getPost('evening_end_minute');
        $fields['evening_end_time'] = $evEndTime;

        $fields['qty_in_evening'] = $this->request->getPost('qty_in_evening');

        $holIda = $this->request->getPost('holidays[]');
        $fields['holidays'] = json_encode($holIda);

        $fields['createdBy'] = $h_Id;


        if ($this->docavailabledayModel->update($fields['doc_avil_id'], $fields)) {
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
        $fields['h_id'] = $this->session->h_Id;
        $fields['createdBy'] = $this->session->h_Id;

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
                $doc_id = $this->doctorModel->getInsertID();

                $docApp['doc_id'] = $doc_id;
                $this->docavailabledayModel->insert($docApp);

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