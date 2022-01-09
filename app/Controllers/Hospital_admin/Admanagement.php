<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers\Hospital_admin;

use App\Controllers\BaseController;
use App\Libraries\Permission_hospital;
use App\Models\Hospital_admin\GlobaladdressModel;
use App\Models\Super_admin\AdmanagementModel;
use App\Models\Super_admin\AdpackageModel;

class Admanagement extends BaseController
{
    protected $session;
    protected $validation;
    protected $permission;
    protected $admanagementModel;
    protected $adpackageModel;
    protected $globaladdressModel;
    protected $crop;
    private $module_name = 'Admanage';

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->validation = \Config\Services::validation();
        $this->permission = new Permission_hospital();
        $this->admanagementModel = new AdmanagementModel();
        $this->adpackageModel = new AdpackageModel();
        $this->globaladdressModel = new GlobaladdressModel();
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

            $pak = $this->adpackageModel->findAll();

            $data = [
                'controller' => 'Hospital_admin/Admanagement',
                'title' => 'Admanagement',
                'adPack' => $pak,
            ];

            $perm = $this->permission->module_permission_list($role_id, $this->module_name);
            foreach ($perm as $key => $val) {
                $data[$key] = $this->permission->have_access($role_id, $this->module_name, $key);
            }


            echo view('Hospital_admin/header');
            echo view('Hospital_admin/sidebar');
            if ($data['mod_access'] == 1) {
                echo view('Hospital_admin/Admanagement/admanagement', $data);
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

        $result = $this->admanagementModel->where('h_id',$this->session->h_Id)->findAll();

        foreach ($result as $key => $value) {

            $ops = '<div class="btn-group">';
            $ops .= '<a href="'.base_url('Hospital_admin/Admanagement/update/'.$value->ad_id).'" class="btn btn-sm btn-info"  ><i class="fa fa-edit"></i></a>';
            if ($value->status == 'complete') {
                $ops .= '<button type="button" class="btn btn-sm btn-primary ml-2" onclick="re_active(' . $value->ad_id . ')">Re-active</button>';
            }
            $ops .= '</div>';

            $data['data'][$key] = array(
                $value->ad_id,
                get_data_by_id('name','ad_package','ad_package_id',$value->ad_package_id),
                $value->org_type,
                '<img src="'.base_url('assets/upload/adbanner/'.$this->session->h_Id.'/'.$value->banner).'" alt="adbanner" width="100">',
                $value->status,
                $ops,
            );
        }

        return $this->response->setJSON($data);
    }

    public function add()
    {
        $response = array();

        $fields['h_id'] = $this->session->h_Id;
        $ad_id = $this->request->getPost('ad_id');

        if (!empty($ad_id)){
            $banner1 = get_data_by_id('banner','ad_management','ad_id',$ad_id);
        }

        $fields['ad_package_id'] = $this->request->getPost('ad_package_id');
        $fields['org_type'] = $this->request->getPost('org_type');
        $banner = $this->request->getFile('banner');

        $target_dir = FCPATH . 'assets/upload/adbanner/'.$fields['h_id'].'/';
        if(!file_exists($target_dir)){
            mkdir($target_dir,0777);
        }
        if (!empty($_FILES['banner']['name'])) {
            $name = $banner->getRandomName();
            $banner->move($target_dir, $name);

            $lo_nameimg = 'ban_' . $banner->getName();
            $this->crop->withFile($target_dir . '' . $name)->fit(330, 185, 'center')->save($target_dir . '' . $lo_nameimg);
            unlink($target_dir . '' . $name);

            $fields['banner'] = $lo_nameimg;
        }



        $this->validation->setRules([
            'ad_package_id' => ['label' => 'ad_package_id', 'rules' => 'required|max_length[155]'],
            'org_type' => ['label' => 'org_type', 'rules' => 'required'],
        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
            $response['messages'] = $this->validation->listErrors();

        } else {

            if ($this->admanagementModel->insert($fields)) {

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

        $id = $this->request->getPost('ad_id');

        if ($this->validation->check($id, 'required|numeric')) {

            $data = $this->admanagementModel->where('ad_id', $id)->first();

            return $this->response->setJSON($data);

        } else {

            throw new \CodeIgniter\Exceptions\PageNotFoundException();

        }

    }

    public function update($id){
        $isLoggedInHospital = $this->session->isLoggedInHospital;
        $role_id = $this->session->hospitalAdminRole;

        if(!isset($isLoggedInHospital) || $isLoggedInHospital != TRUE)
        {
            echo view('Hospital_admin/Login/login');
        }
        else {

            $admanage = $this->admanagementModel->find($id);
            $pak = $this->adpackageModel->findAll();
            $add = $this->globaladdressModel->find();
            $data = [
                'controller' => 'Hospital_admin/Admanagement',
                'title' => 'Admanagement',
                'adPack' => $pak,
                'admanage' => $admanage,
                'address' => $add,
            ];

            $perm = $this->permission->module_permission_list($role_id, $this->module_name);
            foreach ($perm as $key => $val) {
                $data[$key] = $this->permission->have_access($role_id, $this->module_name, $key);
            }


            echo view('Hospital_admin/header');
            echo view('Hospital_admin/sidebar');
            if ($data['mod_access'] == 1) {
                echo view('Hospital_admin/Admanagement/update', $data);
            }else {
                echo view('Hospital_admin/No_permission', $data);
            }

            echo view('Hospital_admin/footer');
        }
    }

    public function update_action(){
        $response = array();

        $fields['h_id'] = $this->session->h_Id;
        $fields['ad_id'] = $this->request->getPost('ad_id');
        $fields['ad_package_id'] = $this->request->getPost('ad_package_id');
        $fields['org_type'] = $this->request->getPost('org_type');
        $banner = $this->request->getFile('banner');

        $target_dir = FCPATH . 'assets/upload/adbanner/'.$fields['h_id'].'/';

        if (!empty($_FILES['banner']['name'])) {
            $oldFile = get_data_by_id('banner','ad_management','ad_id',$fields['ad_id']);
            $name = $banner->getRandomName();
            $banner->move($target_dir, $name);

            if (!empty($oldFile)) {
                unlink($target_dir . '' . $oldFile);
            }

            $lo_nameimg = 'ban_' . $banner->getName();
            $this->crop->withFile($target_dir . '' . $name)->fit(330, 185, 'center')->save($target_dir . '' . $lo_nameimg);
            unlink($target_dir . '' . $name);

            $fields['banner'] = $lo_nameimg;
        }



        $this->validation->setRules([
            'ad_package_id' => ['label' => 'ad_package_id', 'rules' => 'required|max_length[155]'],
            'org_type' => ['label' => 'org_type', 'rules' => 'required'],
        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
            $response['messages'] = $this->validation->listErrors();

        } else {

            if ($this->admanagementModel->update($fields['ad_id'],$fields)) {

                $response['success'] = true;
                $response['messages'] = 'Data has been Update successfully';

            } else {

                $response['success'] = false;
                $response['messages'] = 'Insertion error!';

            }
        }

        return $this->response->setJSON($response);


    }

    public function update_add_action(){
        $response = array();

        $fields['ad_id'] = $this->request->getPost('ad_id');

        $address = $this->request->getPost('district[]');

        $fields['district_id'] = json_encode($address);


        if ($this->admanagementModel->update($fields['ad_id'],$fields)) {
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

        $id = $this->request->getPost('ad_id');

        if (!$this->validation->check($id, 'required|numeric')) {

            throw new \CodeIgniter\Exceptions\PageNotFoundException();

        } else {

            if ($this->admanagementModel->where('ad_id', $id)->delete()) {

                $response['success'] = true;
                $response['messages'] = 'Deletion succeeded';

            } else {

                $response['success'] = false;
                $response['messages'] = 'Deletion error!';

            }
        }

        return $this->response->setJSON($response);
    }

    public function package(){
        $isLoggedInHospital = $this->session->isLoggedInHospital;
        $role_id = $this->session->hospitalAdminRole;

        if(!isset($isLoggedInHospital) || $isLoggedInHospital != TRUE)
        {
            echo view('Hospital_admin/Login/login');
        }
        else {

            $data = [
                'controller' => 'Hospital_admin/Admanagement',
                'title' => 'Package',
            ];

            $perm = $this->permission->module_permission_list($role_id, $this->module_name);
            foreach ($perm as $key => $val) {
                $data[$key] = $this->permission->have_access($role_id, $this->module_name, $key);
            }


            echo view('Hospital_admin/header');
            echo view('Hospital_admin/sidebar');
            if ($data['mod_access'] == 1) {
                echo view('Hospital_admin/Admanagement/package', $data);
            }else {
                echo view('Hospital_admin/No_permission', $data);
            }

            echo view('Hospital_admin/footer');
        }
    }

    public function getAllPackage(){
        $response = array();

        $data['data'] = array();

        $result = $this->adpackageModel->findAll();

        foreach ($result as $key => $value) {

            $data['data'][$key] = array(
                $value->ad_package_id,
                $value->name,
                $value->org_type,
                $value->total_views,
                $value->price,
                $value->price_recurring,
                $value->size_width,
                $value->size_hight,
                $value->weight,
            );
        }

        return $this->response->setJSON($data);
    }

}	