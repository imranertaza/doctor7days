<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers\Super_admin;

use App\Controllers\BaseController;

use App\Libraries\Permission_hospital;
use App\Models\Super_admin\HospitalcategoryModel;
use App\Models\Super_admin\RolesModel;
use App\Models\Super_admin\GlobaladdressModel;
use App\Models\Super_admin\HospitalModel;
use App\Models\Super_admin\UsersModel;
use App\Libraries\Permission;

class Hospital extends BaseController
{
	
    protected $hospitalModel;
    protected $globaladdressModel;
    protected $rolesModel;
    protected $usersModel;
    protected $validation;
    protected $crop;
    protected $session;
    protected $permission;
    protected $permission_hospital;
    private $module_name = 'Hospital';
	
	public function __construct()
	{
	    $this->hospitalModel = new HospitalModel();
        $this->globaladdressModel = new GlobaladdressModel();
        $this->permission_hospital = new Permission_hospital();
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
                    'controller'    	=> 'Super_admin/Hospital',
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
                echo view('Super_admin/Hospital/hospital', $data);
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

		$result = $this->hospitalModel->select('h_id, name, description, email, global_address_id, mobile, comment, logo, image, banner_1, is_default, hospital_cat_id, status, createdDtm, updatedBy, updatedDtm, deleted, deletedRole')->findAll();

		foreach ($result as $key => $value) {

			$ops = '<div class="btn-group">';
			$ops .= '<a href="'.base_url().'/Super_admin/hospital/updateForm/'. $value->h_id .'" class="btn btn-sm btn-info" ><i class="fa fa-edit"></i></a>';
			$ops .= '	<button type="button" class="btn btn-sm btn-danger" onclick="remove('. $value->h_id .')"><i class="fa fa-trash"></i></button>';
//			$ops .= '	<a href="'.base_url().'/Super_admin/hospital/remove/'. $value->h_id .'" class="btn btn-sm btn-danger" ><i class="fa fa-trash"></i></a>';
			$ops .= '</div>';

			$data['data'][$key] = array(
				$value->h_id,
				$value->name,
				$value->email,
				$value->mobile,
                statusView($value->status).'<br>'.hospital_license_check_by_h_id($value->h_id),

				$ops,
			);
		}

		return $this->response->setJSON($data);
	}

	public function updateForm($id){
        $isLoggedIAdmin = $this->session->isLoggedIAdmin;
        $role_id = $this->session->AdminRole;

        if (isset($isLoggedIAdmin)) {
        $catego = $this->hospitalcategoryModel->findAll();
        $result = $this->hospitalModel->where('h_id' ,$id)->first();
        $data = [
            'controller' => 'Super_admin/Hospital',
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
                echo view('Super_admin/Hospital/update_form',$data);
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

        $fields['h_id'] = $this->request->getPost('h_id');
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

            if ($this->hospitalModel->update($fields['h_id'], $fields)) {

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

        $fields['h_id'] = $this->request->getPost('h_id');
        $fields['hospital_cat_id'] = $this->request->getPost('cat_id');
        $fields['description'] = $this->request->getPost('description');
        $fields['comment'] = $this->request->getPost('comment');
        $fields['is_default'] = $this->request->getPost('is_default');


        if ($this->hospitalModel->update($fields['h_id'], $fields)) {
            $response['success'] = true;
            $response['messages'] = 'Data has been Update successfully';
        } else {
            $response['success'] = false;
            $response['messages'] = 'Insertion error!';
        }

        return $this->response->setJSON($response);
    }

    public function updateAddress(){

        $response = array();

        $fields['h_id'] = $this->request->getPost('h_id');
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
            $gloaddnew = $this->globaladdressModel->where($where);
            $fields['global_address_id'] = $gloaddnew->first()->global_address_id;
            if ($this->hospitalModel->update($fields['h_id'], $fields)) {
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

        $fields['h_id'] = $this->request->getPost('h_id');

        $target_dir = FCPATH . 'assets/upload/hospital/'.$fields['h_id'].'/';
        if(!file_exists($target_dir)){
            mkdir($target_dir,0777);
        }
        $logo = $this->request->getFile('logo');
        $namelogo = $logo->getRandomName();
        $logo->move($target_dir,$namelogo);
        $lo_nameimg = 'lo_'.$logo->getName();
        $this->crop->withFile($target_dir.''.$namelogo)->fit(220, 80, 'center')->save($target_dir.''.$lo_nameimg);
        unlink($target_dir.''.$namelogo);
        $fields['logo'] = $lo_nameimg;


            if ($this->hospitalModel->update($fields['h_id'], $fields)) {
                $response['success'] = true;
                $response['messages'] = 'Data has been Update successfully';
            } else {
                $response['success'] = false;
                $response['messages'] = 'Insertion error!';
            }
        return $this->response->setJSON($response);
    }

    public function updateBanner_1(){
        $response = array();

        $fields['h_id'] = $this->request->getPost('h_id');

        $target_dir = FCPATH . 'assets/upload/hospital/'.$fields['h_id'].'/';
        if(!file_exists($target_dir)){
            mkdir($target_dir,0777);
        }

        $banner = $this->request->getFile('banner_1');
        $namebanner = $banner->getRandomName();
        $banner->move($target_dir,$namebanner);

        $n1img = 'bn_1_'.$banner->getName();
        $this->crop->withFile($target_dir.''.$namebanner)->fit(328, 185, 'center')->save($target_dir.''.$n1img);
        unlink($target_dir.''.$namebanner);
        $fields['banner_1'] = $n1img;


            if ($this->hospitalModel->update($fields['h_id'], $fields)) {
                $response['success'] = true;
                $response['messages'] = 'Data has been Update successfully';
            } else {
                $response['success'] = false;
                $response['messages'] = 'Insertion error!';
            }
        return $this->response->setJSON($response);
    }

    public function updateBanner_2(){
        $response = array();

        $fields['h_id'] = $this->request->getPost('h_id');
        $target_dir = FCPATH . 'assets/upload/hospital/'.$fields['h_id'].'/';
        if(!file_exists($target_dir)){
            mkdir($target_dir,0777);
        }

        $banner2 = $this->request->getFile('banner_2');
        $namebanner1 = $banner2->getRandomName();
        $banner2->move($target_dir,$namebanner1);

        $n2img = 'bn_2_'.$banner2->getName();
        $this->crop->withFile($target_dir.''.$namebanner1)->fit(328, 185, 'center')->save($target_dir.''.$n2img);
        unlink($target_dir.''.$namebanner1);
        $fields['banner_2'] = $n2img;


            if ($this->hospitalModel->update($fields['h_id'], $fields)) {
                $response['success'] = true;
                $response['messages'] = 'Data has been Update successfully';
            } else {
                $response['success'] = false;
                $response['messages'] = 'Insertion error!';
            }
        return $this->response->setJSON($response);
    }

    public function updateBanner_3(){
        $response = array();

        $fields['h_id'] = $this->request->getPost('h_id');
        $target_dir = FCPATH . 'assets/upload/hospital/'.$fields['h_id'].'/';
        if(!file_exists($target_dir)){
            mkdir($target_dir,0777);
        }

        $banner3 = $this->request->getFile('banner_3');
        $namebanner2 = $banner3->getRandomName();
        $banner3->move($target_dir,$namebanner2);

        $n3img = 'bn_3_'.$banner3->getName();
        $this->crop->withFile($target_dir.''.$namebanner2)->fit(328, 185, 'center')->save($target_dir.''.$n3img);
        unlink($target_dir.''.$namebanner2);
        $fields['banner_3'] = $n3img;


            if ($this->hospitalModel->update($fields['h_id'], $fields)) {
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
		
		$id = $this->request->getPost('h_id');
		
		if ($this->validation->check($id, 'required|numeric')) {
			
			$data = $this->hospitalModel->where('h_id' ,$id)->first();
			
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
        $fields['password'] = SHA1($this->request->getPost('password'));
        $fields['con_password'] = SHA1($this->request->getPost('con_password'));


        $this->validation->setRules([
            'name' => ['label' => 'Name', 'rules' => 'required|max_length[155]'],
            'email' => ['label' => 'Email', 'rules' => 'permit_empty|required|max_length[30]'],
            'mobile' => ['label' => 'Mobile', 'rules' => 'permit_empty|required|numeric|max_length[11]'],
            'password' => ['label' => 'Password', 'rules' => 'required'],
            'con_password' => ['label' => 'Confirm Password', 'rules' => 'required|matches[password]'],
        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
            $response['messages'] = $this->validation->listErrors();
			
        } else {

            if ($this->hospitalModel->insert($fields)) {
                $h_id = $this->hospitalModel->getInsertID();

                //Roles add
                $roles['h_id'] = $h_id;
                $roles['role'] = 'hospital_admin';
                $roles['permission'] = $this->permission_hospital->hospital_admin_permissions;
                $roles['is_default'] = '1';
                $roles['createdBy'] = '1';
                $this->rolesModel->insert($roles);
                $role_id = $this->rolesModel->getInsertID();

                //user create
                $users['h_id'] = $h_id;
                $users['email'] = $this->request->getPost('email');
                $users['name'] = $this->request->getPost('name');
                $users['mobile'] = $this->request->getPost('mobile');
                $users['password'] = SHA1($this->request->getPost('password'));
                $users['role_id'] = $role_id;
                $users['status'] = '1';
                $users['is_default'] = '1';
                $this->usersModel->insert($users);

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
		
        $fields['h_id'] = $this->request->getPost('hId');
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

            if ($this->hospitalModel->update($fields['h_id'], $fields)) {
				
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
		
		$id = $this->request->getPost('h_id');
		
		if (!$this->validation->check($id, 'required|numeric')) {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
			
		} else {

			if ($this->hospitalModel->where('h_id', $id)->delete()) {

				$response['success'] = true;
				$response['messages'] = 'Deletion succeeded';	
				
			} else {
				$response['success'] = false;
//				$response['messages'] = print $this->hospitalModel->getLastQuery();
				$response['messages'] = 'Deletion error!';

			}
		}	
	
        return $this->response->setJSON($response);		
	}	
		
}	