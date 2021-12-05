<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers\Super_admin;

use App\Controllers\BaseController;

use App\Models\Super_admin\HospitalcategoryModel;
use App\Models\Super_admin\Indianappointment;
use App\Models\Super_admin\IndianHospitalBranchModel;
use App\Models\Super_admin\IndianhospitalModel;
use App\Models\Super_admin\RolesModel;
use App\Models\Super_admin\GlobaladdressModel;
use App\Models\Super_admin\UsersModel;
use App\Libraries\Permission;

class Indianhospital extends BaseController
{
	
    protected $indianhospitalModel;
    protected $globaladdressModel;
    protected $indianHospitalBranchModel;
    protected $rolesModel;
    protected $usersModel;
    protected $validation;
    protected $crop;
    protected $indianappointment;
    protected $session;
    protected $permission;
    private $module_name = 'Hospital';
	
	public function __construct()
	{
	    $this->indianhospitalModel = new IndianhospitalModel();
	    $this->indianHospitalBranchModel = new IndianHospitalBranchModel();
	    $this->indianappointment = new Indianappointment();
        $this->globaladdressModel = new GlobaladdressModel();
        $this->rolesModel = new RolesModel();
        $this->usersModel = new UsersModel();
       	$this->validation =  \Config\Services::validation();
        $this->session = \Config\Services::session();
        $this->permission = new Permission();
        $this->hospitalcategoryModel = new HospitalcategoryModel();
        $this->crop = \Config\Services::image();
	}
	
	public function index()
	{
        $isLoggedIAdmin = $this->session->isLoggedIAdmin;
        $role_id = $this->session->AdminRole;
        if (isset($isLoggedIAdmin)) {
            $catego = $this->hospitalcategoryModel->findAll();
            $data = [
                    'controller'    	=> 'Super_admin/Indianhospital',
                    'title'     		=> 'Hospital',
                    'category'     		=> $catego,
                ];
            $perm = $this->permission->module_permission_list($role_id, $this->module_name);
                foreach($perm as $key=>$val){
                     $data[$key] = $this->permission->have_access($role_id, $this->module_name, $key);
                }

            echo view('Super_admin/header');
            echo view('Super_admin/sidebar');
            if ($data['mod_access'] == 1) {
                echo view('Super_admin/Indianhospital/hospital', $data);
            } else {
                echo view('Super_admin/No_permission', $data);
            }
            echo view('Super_admin/footer');

        }else {
            return redirect()->to(site_url("/super_admin/login"));
        }
			
	}

	public function getAll()
	{
 		$response = array();

	    $data['data'] = array();

		$result = $this->indianhospitalModel->findAll();

		foreach ($result as $key => $value) {

			$ops = '<div class="btn-group">';

			$ops .= '<a href="'.base_url().'/Super_admin/Indianhospital/updateForm/'. $value->ind_h_id .'" class="btn btn-sm btn-info" ><i class="fa fa-edit"></i></a>';
			$ops .= '<a href="'.base_url().'/Super_admin/Indianhospital/branch_list/'. $value->ind_h_id .'" class="btn btn-sm btn-success" ><i class="fa fa-code-branch" ></i></a>';
			$ops .= '	<button type="button" class="btn btn-sm btn-danger" onclick="remove('. $value->ind_h_id .')"><i class="fa fa-trash"></i></button>';
//			$ops .= '	<a href="'.base_url().'/Super_admin/hospital/remove/'. $value->ind_h_id .'" class="btn btn-sm btn-danger" ><i class="fa fa-trash"></i></a>';
			$ops .= '</div>';

			$data['data'][$key] = array(
				$value->ind_h_id,
				$value->name,
				$value->email,
				$value->mobile,
                statusView($value->status),

				$ops,
			);
		}

		return $this->response->setJSON($data);
	}

	public function branch_list($id){
        $isLoggedIAdmin = $this->session->isLoggedIAdmin;
        $role_id = $this->session->AdminRole;
        if (isset($isLoggedIAdmin)) {
            $branch = $this->indianHospitalBranchModel->where('ind_h_id',$id)->findAll();
            $data = [
                'controller'    	=> 'Super_admin/Indianhospital',
                'title'     		=> 'Hospital',
                'branch'     		=> $branch,
            ];
            $perm = $this->permission->module_permission_list($role_id, $this->module_name);
            foreach($perm as $key=>$val){
                $data[$key] = $this->permission->have_access($role_id, $this->module_name, $key);
            }

            echo view('Super_admin/header');
            echo view('Super_admin/sidebar');
            if ($data['mod_access'] == 1) {
                echo view('Super_admin/Indianhospital/branch_view', $data);
            } else {
                echo view('Super_admin/No_permission', $data);
            }
            echo view('Super_admin/footer');

        }else {
            return redirect()->to(site_url("/super_admin/login"));
        }
    }

	public function updateForm($id){
        $isLoggedIAdmin = $this->session->isLoggedIAdmin;
        $role_id = $this->session->AdminRole;

        if (isset($isLoggedIAdmin)) {
        $catego = $this->hospitalcategoryModel->findAll();
        $result = $this->indianhospitalModel->where('ind_h_id' ,$id)->first();
        $data = [
            'controller' => 'Super_admin/Indianhospital',
            'hospital' => $result,
            'category' => $catego,
        ];

        $perm = $this->permission->module_permission_list($role_id, $this->module_name);
            foreach($perm as $key=>$val){
                 $data[$key] = $this->permission->have_access($role_id, $this->module_name, $key);
            }
        echo view('Super_admin/header');
        echo view('Super_admin/sidebar');
        if ($data['mod_access'] == 1) {
            echo view('Super_admin/Indianhospital/update_form',$data);
        }else {
            echo view('Super_admin/No_permission', $data);
        }
        echo view('Super_admin/footer');
        }else {
            return redirect()->to(site_url("/super_admin/login"));
        }

    }

    public function updateReg(){

	    $response = array();

        $fields['ind_h_id'] = $this->request->getPost('ind_h_id');
        $fields['name'] = $this->request->getPost('name');
        $fields['email'] = $this->request->getPost('email');
        $fields['mobile'] = $this->request->getPost('phone');
        $fields['status'] = $this->request->getPost('status');


        $this->validation->setRules([
            'name' => ['label' => 'Name', 'rules' => 'required|max_length[155]'],
            'email' => ['label' => 'Email', 'rules' => 'permit_empty|required|max_length[30]'],
            'mobile' => ['label' => 'Mobile', 'rules' => 'permit_empty|required|numeric|max_length[11]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
            $response['messages'] = $this->validation->listErrors();

        } else {

            if ($this->indianhospitalModel->update($fields['ind_h_id'], $fields)) {

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

        $fields['ind_h_id'] = $this->request->getPost('ind_h_id');
        $fields['hospital_cat_id'] = $this->request->getPost('cat_id');
        $fields['description'] = $this->request->getPost('description');
        $fields['is_default'] = $this->request->getPost('is_default');


        if ($this->indianhospitalModel->update($fields['ind_h_id'], $fields)) {
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

        $fields['ind_h_id'] = $this->request->getPost('ind_h_id');

        $target_dir = FCPATH . '/assets/upload/indianhospital/'.$fields['ind_h_id'].'/';
        if(!file_exists($target_dir)){
            mkdir($target_dir,0655);
        }
        $logo = $this->request->getFile('logo');
        $namelogo = $logo->getRandomName();
        $logo->move($target_dir,$namelogo);
//        $lo_nameimg = 'lo_'.$logo->getName();
//        $this->crop->withFile($target_dir.''.$namelogo)->fit(220, 80, 'center')->save($target_dir.''.$lo_nameimg);
//        unlink($target_dir.''.$namelogo);
//        $fields['logo'] = $lo_nameimg;
        $fields['logo'] = $namelogo;


            if ($this->indianhospitalModel->update($fields['ind_h_id'], $fields)) {
                $response['success'] = true;
                $response['messages'] = 'Data has been Update successfully';
            } else {
                $response['success'] = false;
                $response['messages'] = 'Insertion error!';
            }
        return $this->response->setJSON($response);
    }

	public function getOne()
	{
 		$response = array();
		
		$id = $this->request->getPost('ind_h_id');
		
		if ($this->validation->check($id, 'required|numeric')) {
			
			$data = $this->indianhospitalModel->where('ind_h_id' ,$id)->first();
			
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
        $fields['hospital_cat_id'] = $this->request->getPost('cat_id');
        $fields['status'] = $this->request->getPost('status');


        $this->validation->setRules([
            'name' => ['label' => 'Name', 'rules' => 'required|max_length[155]'],
            'email' => ['label' => 'Email', 'rules' => 'permit_empty|required|max_length[30]'],
            'mobile' => ['label' => 'Mobile', 'rules' => 'permit_empty|required|numeric|max_length[11]'],
        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
            $response['messages'] = $this->validation->listErrors();
			
        } else {

            if ($this->indianhospitalModel->insert($fields)) {

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
		
        $fields['ind_h_id'] = $this->request->getPost('hId');
        $fields['name'] = $this->request->getPost('name');
        $fields['description'] = $this->request->getPost('description');
        $fields['email'] = $this->request->getPost('email');
        $fields['global_address_id'] = $this->request->getPost('globalAddressId');
        $fields['mobile'] = $this->request->getPost('mobile');
        $fields['comment'] = $this->request->getPost('comment');
        $fields['logo'] = $this->request->getPost('logo');
        $fields['image'] = $this->request->getPost('image');
        $fields['banner'] = $this->request->getPost('banner');
        $fields['is_default'] = $this->request->getPost('isDefault');
        $fields['hospital_cat_id'] = $this->request->getPost('hospitalCatId');
        $fields['status'] = $this->request->getPost('status');
        $fields['createdDtm'] = $this->request->getPost('createdDtm');
        $fields['updatedBy'] = $this->request->getPost('updatedBy');
        $fields['updatedDtm'] = $this->request->getPost('updatedDtm');
        $fields['deleted'] = $this->request->getPost('deleted');
        $fields['deletedRole'] = $this->request->getPost('deletedRole');


        $this->validation->setRules([
            'name' => ['label' => 'Name', 'rules' => 'required|max_length[155]'],
            'description' => ['label' => 'Description', 'rules' => 'required'],
            'email' => ['label' => 'Email', 'rules' => 'permit_empty|max_length[30]'],
            'global_address_id' => ['label' => 'Global address id', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'mobile' => ['label' => 'Mobile', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'comment' => ['label' => 'Comment', 'rules' => 'permit_empty'],
            'logo' => ['label' => 'Logo', 'rules' => 'permit_empty|max_length[155]'],
            'image' => ['label' => 'Image', 'rules' => 'permit_empty|max_length[155]'],
            'banner' => ['label' => 'Banner', 'rules' => 'permit_empty|max_length[155]'],
            'is_default' => ['label' => 'Is default', 'rules' => 'required'],
            'hospital_cat_id' => ['label' => 'Hospital cat id', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'status' => ['label' => 'Status', 'rules' => 'required'],
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

            if ($this->indianhospitalModel->update($fields['ind_h_id'], $fields)) {
				
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
		
		$id = $this->request->getPost('ind_h_id');
		
		if (!$this->validation->check($id, 'required|numeric')) {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
			
		} else {

			if ($this->indianhospitalModel->where('ind_h_id', $id)->delete()) {

				$response['success'] = true;
				$response['messages'] = 'Deletion succeeded';	
				
			} else {
				$response['success'] = false;
//				$response['messages'] = print $this->indianhospitalModel->getLastQuery();
				$response['messages'] = 'Deletion error!';

			}
		}	
	
        return $this->response->setJSON($response);		
	}

	public function branch(){
        $isLoggedIAdmin = $this->session->isLoggedIAdmin;
        $role_id = $this->session->AdminRole;
        if (isset($isLoggedIAdmin)) {
            $hospital = $this->indianhospitalModel->findAll();
            $data = [
                'controller'    	=> 'Super_admin/Indianhospital',
                'title'     		=> 'Hospital',
                'hospital'     		=> $hospital,
            ];
            $perm = $this->permission->module_permission_list($role_id, $this->module_name);
            foreach($perm as $key=>$val){
                $data[$key] = $this->permission->have_access($role_id, $this->module_name, $key);
            }

            echo view('Super_admin/header');
            echo view('Super_admin/sidebar');
            if ($data['mod_access'] == 1) {
                echo view('Super_admin/Indianhospital/branch', $data);
            } else {
                echo view('Super_admin/No_permission', $data);
            }
            echo view('Super_admin/footer');

        }else {
            return redirect()->to(site_url("/super_admin/login"));
        }
    }

    public function getAllBranch()
    {
        $response = array();

        $data['data'] = array();

        $result = $this->indianHospitalBranchModel->findAll();

        foreach ($result as $key => $value) {

            $ops = '<div class="btn-group">';

            $ops .= '<button class="btn btn-sm btn-info" onclick="edit('. $value->ind_hos_bran_id .')" ><i class="fa fa-edit"></i></button>';
            $ops .= '	<button type="button" class="btn btn-sm btn-danger" onclick="remove('. $value->ind_hos_bran_id .')"><i class="fa fa-trash"></i></button>';
//			$ops .= '	<a href="'.base_url().'/Super_admin/hospital/remove/'. $value->ind_h_id .'" class="btn btn-sm btn-danger" ><i class="fa fa-trash"></i></a>';
            $ops .= '</div>';

            $data['data'][$key] = array(
                $value->ind_hos_bran_id,
                get_data_by_id('name','indian_hospital','ind_h_id',$value->ind_h_id),
                $value->branch_name,
                $value->contact_no,
                $ops,
            );
        }

        return $this->response->setJSON($data);
    }

    public function addBranch(){
        $response = array();


        $fields['branch_name'] = $this->request->getPost('name');
        $fields['contact_no'] = $this->request->getPost('mobile');
        $fields['ind_h_id'] = $this->request->getPost('ind_h_id');

        if ($this->indianHospitalBranchModel->insert($fields)) {

            $response['success'] = true;
            $response['messages'] = 'Data has been inserted successfully';

        } else {

            $response['success'] = false;
            $response['messages'] = 'Insertion error!';

        }

        return $this->response->setJSON($response);
    }

    public function getOnebranch(){
        $response = array();

        $id = $this->request->getPost('ind_hos_bran_id');

        if ($this->validation->check($id, 'required|numeric')) {

            $data = $this->indianHospitalBranchModel->where('ind_hos_bran_id' ,$id)->first();

            return $this->response->setJSON($data);

        } else {

            throw new \CodeIgniter\Exceptions\PageNotFoundException();

        }
    }

    public function editbranch(){
        $response = array();

        $fields['ind_hos_bran_id'] = $this->request->getPost('ind_hos_bran_id');
        $fields['branch_name'] = $this->request->getPost('name');
        $fields['contact_no'] = $this->request->getPost('mobile');
        $fields['ind_h_id'] = $this->request->getPost('ind_h_id');

        if ($this->indianHospitalBranchModel->update($fields['ind_hos_bran_id'],$fields)) {

            $response['success'] = true;
            $response['messages'] = 'Data has been Update successfully';

        } else {

            $response['success'] = false;
            $response['messages'] = 'Insertion error!';

        }

        return $this->response->setJSON($response);
    }

    public function removeBranch(){
        $response = array();

        $id = $this->request->getPost('ind_hos_bran_id');

        if (!$this->validation->check($id, 'required|numeric')) {

            throw new \CodeIgniter\Exceptions\PageNotFoundException();

        } else {

            if ($this->indianHospitalBranchModel->where('ind_hos_bran_id', $id)->delete()) {

                $response['success'] = true;
                $response['messages'] = 'Deletion succeeded';

            } else {
                $response['success'] = false;
                $response['messages'] = 'Deletion error!';

            }
        }

        return $this->response->setJSON($response);
    }

    public function appointment(){

        $isLoggedIAdmin = $this->session->isLoggedIAdmin;
        $role_id = $this->session->AdminRole;
        if (isset($isLoggedIAdmin)) {
            $hospital = $this->indianappointment->findAll();
            $data = [
                'controller'    	=> 'Super_admin/Indianhospital',
                'title'     		=> 'Appointment',
                'hospital'     		=> $hospital,
            ];
            $perm = $this->permission->module_permission_list($role_id, $this->module_name);
            foreach($perm as $key=>$val){
                $data[$key] = $this->permission->have_access($role_id, $this->module_name, $key);
            }

            echo view('Super_admin/header');
            echo view('Super_admin/sidebar');
            if ($data['mod_access'] == 1) {
                echo view('Super_admin/Indianhospital/appointment', $data);
            } else {
                echo view('Super_admin/No_permission', $data);
            }
            echo view('Super_admin/footer');

        }else {
            return redirect()->to(site_url("/super_admin/login"));
        }
    }

    public function getAllappointment()
    {
        $response = array();

        $data['data'] = array();

        $result = $this->indianappointment->findAll();

        foreach ($result as $key => $value) {

            $ops = '<div class="btn-group">';

            $ops .= '<button class="btn btn-sm btn-info" onclick="edit('. $value->appointment_id .')" ><i class="fa fa-edit"></i></button>';
            $ops .= '	<button type="button" class="btn btn-sm btn-danger" onclick="remove('. $value->appointment_id .')"><i class="fa fa-trash"></i></button>';
//			$ops .= '	<a href="'.base_url().'/Super_admin/hospital/remove/'. $value->ind_h_id .'" class="btn btn-sm btn-danger" ><i class="fa fa-trash"></i></a>';
            $ops .= '</div>';

            $data['data'][$key] = array(
                $value->appointment_id,
                get_data_by_id('name','patient','pat_id',$value->pat_id),
                $value->name,
                $value->phone,
                get_data_by_id('name','indian_hospital','ind_h_id',$value->ind_h_id),
                get_data_by_id('branch_name','indian_hospital_branch','ind_hos_bran_id',$value->ind_hos_bran_id),

                '<select name="status" onchange="statusChange(this.value,'.$value->appointment_id.')" style="border: 1px solid #e5e5e5;padding: 5px;" >'.in_appoin_status($value->status).'</select>',
                //$ops,
            );
        }

        return $this->response->setJSON($data);
    }

    public function statusChange(){
        $response = array();

        $data['appointment_id'] = $this->request->getPost('id');
        $data['status'] = $this->request->getPost('status');

        if ($this->indianappointment->update($data['appointment_id'],$data)) {

            $response['success'] = true;
            $response['messages'] = 'Data has been Update successfully';

        } else {
            $response['success'] = false;
            $response['messages'] = 'Insertion error!';

        }

        return $this->response->setJSON($response);
    }

}	