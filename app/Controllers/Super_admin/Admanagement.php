<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers\Super_admin;

use App\Controllers\BaseController;

use App\Models\Hospital_admin\GlobaladdressModel;
use App\Models\Super_admin\AdcompanyModel;
use App\Models\Super_admin\AdcountModel;
use App\Models\Super_admin\AdmanagementModel;
use App\Models\Super_admin\AdmanageModel;
use App\Libraries\Permission;
use App\Models\Super_admin\AdpackageModel;

class Admanagement extends BaseController
{

    protected $admanageModel;
    protected $adcompanyModel;
    protected $admanagementModel;
    protected $validation;
    protected $session;
    protected $permission;
    protected $adpackageModel;
    protected $adcountModel;
    protected $globaladdressModel;
    protected $crop;
    private $module_name = 'Admanage';

    public function __construct()
    {
        $this->admanageModel = new AdmanageModel();
        $this->adcompanyModel = new AdcompanyModel();
        $this->admanagementModel = new AdmanagementModel();
        $this->adpackageModel = new AdpackageModel();
        $this->adcountModel = new AdcountModel();
        $this->validation = \Config\Services::validation();
        $this->session = \Config\Services::session();
        $this->permission = new Permission();
        $this->crop = \Config\Services::image();
        $this->globaladdressModel = new GlobaladdressModel();

    }

    public function index()
    {
        $isLoggedIAdmin = $this->session->isLoggedIAdmin;
        $role_id = $this->session->AdminRole;

        if (isset($isLoggedIAdmin)) {

            $pak = $this->adpackageModel->findAll();
            $companey = $this->adcompanyModel->findAll();
            $data = [
                'controller' => 'Super_admin/Admanagement',
                'title' => 'Ad Management',
                'adPack' => $pak,
                'companey' => $companey,
            ];


            $perm = $this->permission->module_permission_list($role_id, $this->module_name);
            foreach ($perm as $key => $val) {
                $data[$key] = $this->permission->have_access($role_id, $this->module_name, $key);
            }

            echo view('Super_admin/header');
            echo view('Super_admin/sidebar');
            if ($data['mod_access'] == 1) {
                echo view('Super_admin/Admanagement/admanagement', $data);
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

        $result = $this->admanagementModel->findAll();

        foreach ($result as $key => $value) {
            $h = get_data_by_id('name', 'hospital', 'h_id', $value->h_id);
            $c = get_data_by_id('com_name', 'ad_company', 'ad_com_id', $value->ad_com_id);
            $comName =(!empty($value->h_id))?$h:$c;
            $ops = '<div class="btn-group">';
            $ops .= '<a href="' . base_url('Super_admin/Admanagement/view/' . $value->ad_id) . '" class="btn btn-sm btn-info" ><i class="fa fa-eye"></i></a>';
            $ops .= '	<a href="' .base_url('Super_admin/Admanagement/edit/' . $value->ad_id) . '" type="button" class="btn btn-sm btn-primary" "><i class="fa fa-edit"></i></a>';
            $ops .= '</div>';
            $a = ($value->status == 'active')?'selected':'';
            $p = ($value->status == 'panding')?'selected':'';
            $co = ($value->status == 'complete')?'selected':'';
            $ca = ($value->status == 'cancle')?'selected':'';
            $data['data'][$key] = array(
                $value->ad_id,
                $comName,
                get_data_by_id('name', 'ad_package', 'ad_package_id', $value->ad_package_id),
                $value->org_type,
                '<select name="status" onchange="addStatusChange(this.value,'.$value->ad_id.')" style="border: 1px solid #e3e3e3;padding: 7px;">
                    <option value="active" '.$a.'>Active</option>
                    <option value="panding"  '.$p.'>Panding</option>
                    <option value="complete" '.$co.'>Complete</option>
                    <option value="cancle" '.$ca.'>Cancle</option>
                </select>',

                $ops,
            );
        }

        return $this->response->setJSON($data);
    }

    public function view($id)
    {
        $isLoggedIAdmin = $this->session->isLoggedIAdmin;
        $role_id = $this->session->AdminRole;

        if (isset($isLoggedIAdmin)) {
            $countad = 0;
            $result = $this->admanagementModel->find($id);
            $datacount  = $this->adcountModel->where('ad_id',$id)->first();

            if (!empty($datacount)){
                $countad = $datacount->total_view_count;
            }
            $data = [
                'controller' => 'Super_admin/Admanagement',
                'title' => 'Ad Management',
                'add' => $result,
                'adCount' => $countad,
            ];


            $perm = $this->permission->module_permission_list($role_id, $this->module_name);
            foreach ($perm as $key => $val) {
                $data[$key] = $this->permission->have_access($role_id, $this->module_name, $key);
            }

            echo view('Super_admin/header');
            echo view('Super_admin/sidebar');
            if ($data['mod_access'] == 1) {
                echo view('Super_admin/Admanagement/view', $data);
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

        $id = $this->request->getPost('id');

        if ($this->validation->check($id, 'required|numeric')) {

            $data = $this->admanagementModel->where('ad_id', $id)->first();

            return $this->response->setJSON($data);

        } else {

            throw new \CodeIgniter\Exceptions\PageNotFoundException();

        }

    }

    public function add()
    {

        $response = array();

        $fields['ad_com_id'] = $this->request->getPost('ad_com_id');
        $fields['ad_package_id'] = $this->request->getPost('ad_package_id');
        $fields['org_type'] = $this->request->getPost('org_type');
        $banner = $this->request->getFile('banner');

        $target_dir = FCPATH . 'assets/upload/adbanner/'.$fields['ad_com_id'].'/';
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
                //print $this->admanagementModel->getLastQuery();
                $response['success'] = true;
                $response['messages'] = 'Data has been inserted successfully';
            } else {
                $response['success'] = false;
                $response['messages'] = 'Insertion error!';
            }
        }

        return $this->response->setJSON($response);
    }

    public function edit($id)
    {

        $isLoggedIAdmin = $this->session->isLoggedIAdmin;
        $role_id = $this->session->AdminRole;

        if (isset($isLoggedIAdmin)) {

            $pak = $this->adpackageModel->findAll();
            $companey = $this->adcompanyModel->findAll();
            $admanagement = $this->admanagementModel->find($id);
            $add = $this->globaladdressModel->find();
            $data = [
                'controller' => 'Super_admin/Admanagement',
                'title' => 'Ad Management',
                'adPack' => $pak,
                'companey' => $companey,
                'admanage' => $admanagement,
                'address' => $add,
            ];


            $perm = $this->permission->module_permission_list($role_id, $this->module_name);
            foreach ($perm as $key => $val) {
                $data[$key] = $this->permission->have_access($role_id, $this->module_name, $key);
            }

            echo view('Super_admin/header');
            echo view('Super_admin/sidebar');
            if ($data['mod_access'] == 1) {
                echo view('Super_admin/Admanagement/edit', $data);
            } else {
                echo view('Super_admin/No_permission', $data);
            }
            echo view('Super_admin/footer');

        } else {
            return redirect()->to(site_url("/super_admin/login"));
        }

    }

    public function remove()
    {
        $response = array();

        $id = $this->request->getPost('ad_com_id');

        if (!$this->validation->check($id, 'required|numeric')) {

            throw new \CodeIgniter\Exceptions\PageNotFoundException();

        } else {

            if ($this->adcompanyModel->where('ad_com_id', $id)->delete()) {

                $response['success'] = true;
                $response['messages'] = 'Deletion succeeded';

            } else {

                $response['success'] = false;
                $response['messages'] = 'Deletion error!';

            }
        }

        return $this->response->setJSON($response);
    }

    public function statusChange()
    {
        $response = array();
        $today = date('Y-m-d');
        $date = date('Y-m-d', strtotime($today . ' +30 day'));



        $data['status'] = $this->request->getPost('status');
        $data['ad_id'] = $this->request->getPost('id');
        $data['start_date'] = $this->request->getPost('start_date');
        $data['end_date'] = $this->request->getPost('end_date');


        $check = $this->adcountModel->where('ad_id',$data['ad_id'])->countAllResults();

        if (empty($check)) {
            $adcount = [
                'ad_id' => $data['ad_id'],
                'total_view_coun' => 0,
            ];
            $this->adcountModel->insert($adcount);
        }


        if ($this->admanagementModel->update($data['ad_id'],$data)) {
            $response['success'] = true;
            $response['messages'] = 'Successfully updated';
        } else {
            $response['success'] = false;
            $response['messages'] = 'Update error!';
        }
        return $this->response->setJSON($response);
    }

    public function paumentstatusChange()
    {
        $response = array();
        $data['payment_status'] = $this->request->getPost('status');
        $data['ad_id'] = $this->request->getPost('id');

        if ($this->admanagementModel->update($data['ad_id'],$data)) {
            $response['success'] = true;
            $response['messages'] = 'Successfully updated';
        } else {
            $response['success'] = false;
            $response['messages'] = 'Update error!';
        }
        return $this->response->setJSON($response);
    }

    public function update_action(){
        $response = array();

        $fields['ad_id'] = $this->request->getPost('ad_id');
        $fields['ad_package_id'] = $this->request->getPost('ad_package_id');
        $fields['org_type'] = $this->request->getPost('org_type');
        $banner = $this->request->getFile('banner');


        $h_id = get_data_by_id('h_id','ad_management','ad_id',$fields['ad_id']);
        $ad_com_id = get_data_by_id('ad_com_id','ad_management','ad_id',$fields['ad_id']);
        $id = (!empty($h_id))?$h_id:$ad_com_id;

        $target_dir = FCPATH . 'assets/upload/adbanner/'.$id.'/';

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

}	