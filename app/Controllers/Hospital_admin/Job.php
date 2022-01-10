<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers\Hospital_admin;

use App\Controllers\BaseController;

use App\Libraries\Permission_hospital;
use App\Models\Super_admin\JobModel;

class Job extends BaseController
{

    protected $jobModel;
    protected $validation;
    protected $session;
    protected $permission;
    private $module_name = 'Job';

    public function __construct()
    {
        $this->jobModel = new JobModel();
        $this->validation = \Config\Services::validation();
        $this->session = \Config\Services::session();
        $this->permission = new Permission_hospital();

    }

    public function index()
    {
        $isLoggedInHospital = $this->session->isLoggedInHospital;
        $role_id = $this->session->hospitalAdminRole;
        if (!isset($isLoggedInHospital) || $isLoggedInHospital != TRUE) {
            echo view('Hospital_admin/Login/login');
        } else {
            $data = [
                'controller' => 'Hospital_admin/Job',
                'title' => 'Jobs'
            ];
            $perm = $this->permission->module_permission_list($role_id, $this->module_name);
            foreach ($perm as $key => $val) {
                $data[$key] = $this->permission->have_access($role_id, $this->module_name, $key);
            }

            echo view('Hospital_admin/header');
            echo view('Hospital_admin/sidebar');
            if ($data['mod_access'] == 1) {
                echo view('Hospital_admin/Job/job', $data);
            } else {
                echo view('Hospital_admin/No_permission', $data);
            }

            echo view('Hospital_admin/footer');
        }

    }

    public function getAll()
    {
        $response = array();
        $hId = $this->session->h_Id;
        $data['data'] = array();

        $result = $this->jobModel->where('h_id',$hId)->findAll();

        foreach ($result as $key => $value) {

            $ops = '<div class="btn-group">';
            $ops .= '	<button type="button" class="btn btn-sm btn-info" onclick="edit(' . $value->job_id . ')"><i class="fa fa-edit"></i></button>';
            $ops .= '	<button type="button" class="btn btn-sm btn-danger" onclick="remove(' . $value->job_id . ')"><i class="fa fa-trash"></i></button>';
            $ops .= '</div>';

            $data['data'][$key] = array(
                $value->job_id,
                $value->title,
                $value->description,
                $value->salary,
                $value->daily_time . ' Hours',
                $value->total_applied,

                $ops,
            );
        }

        return $this->response->setJSON($data);
    }

    public function getOne()
    {
        $response = array();

        $id = $this->request->getPost('job_id');

        if ($this->validation->check($id, 'required|numeric')) {

            $data = $this->jobModel->where('job_id', $id)->first();

            return $this->response->setJSON($data);

        } else {

            throw new \CodeIgniter\Exceptions\PageNotFoundException();

        }

    }

    public function add()
    {

        $response = array();

        $hId = $this->session->h_Id;

        $fields['title'] = $this->request->getPost('title');
        $fields['description'] = $this->request->getPost('description');
        $fields['salary'] = $this->request->getPost('salary');
        $fields['daily_time'] = $this->request->getPost('dailyTime');
        $fields['h_id'] = $hId;
        $fields['createdBy'] = $hId;


        $this->validation->setRules([
            'title' => ['label' => 'Title', 'rules' => 'required|max_length[155]'],
            'description' => ['label' => 'Description', 'rules' => 'required'],
            'salary' => ['label' => 'Salary', 'rules' => 'required|numeric|max_length[15]'],
            'daily_time' => ['label' => 'Daily time', 'rules' => 'required|max_length[155]'],
            'createdBy' => ['label' => 'CreatedBy', 'rules' => 'required|numeric|max_length[11]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
            $response['messages'] = $this->validation->listErrors();

        } else {

            if ($this->jobModel->insert($fields)) {

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
        $hId = $this->session->h_Id;

        $fields['job_id'] = $this->request->getPost('jobId');
        $fields['title'] = $this->request->getPost('title');
        $fields['description'] = $this->request->getPost('description');
        $fields['salary'] = $this->request->getPost('salary');
        $fields['daily_time'] = $this->request->getPost('dailyTime');
        $fields['updatedBy'] = $hId;


        $this->validation->setRules([
            'title' => ['label' => 'Title', 'rules' => 'required|max_length[155]'],
            'description' => ['label' => 'Description', 'rules' => 'required'],
            'salary' => ['label' => 'Salary', 'rules' => 'required|numeric|max_length[15]'],
            'daily_time' => ['label' => 'Daily time', 'rules' => 'required|max_length[155]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
            $response['messages'] = $this->validation->listErrors();

        } else {

            if ($this->jobModel->update($fields['job_id'], $fields)) {

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

        $id = $this->request->getPost('job_id');

        if (!$this->validation->check($id, 'required|numeric')) {

            throw new \CodeIgniter\Exceptions\PageNotFoundException();

        } else {

            if ($this->jobModel->where('job_id', $id)->delete()) {

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