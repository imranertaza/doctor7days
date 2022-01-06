<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers\Super_admin;

use App\Controllers\BaseController;
use App\Libraries\Permission_hospital;
use App\Models\Hospital_admin\GlobaladdressModel;
//use App\Helpers\Global_helper;

class Globaladdress extends BaseController
{
	
    protected $globaladdressModel;
    protected $validation;
   // protected $globalHelper;
   
    protected $session;
    protected $permission;
    private $module_name = 'Globaladdress';
	public function __construct()
	{
        $this->session = \Config\Services::session();
	    $this->globaladdressModel = new GlobaladdressModel();
       	$this->validation =  \Config\Services::validation();
        $this->permission = new Permission_hospital();
		
	}
	
	public function index()
	{

        $isLoggedIAdmin = $this->session->isLoggedIAdmin;
        $role_id = $this->session->AdminRole;

        if (isset($isLoggedIAdmin)) {
            $data = [
                'controller'    	=> 'Super_admin/globaladdress',
                'title'     		=> 'Ad Company'
            ];


            $perm = $this->permission->module_permission_list($role_id, $this->module_name);
            foreach($perm as $key=>$val){
                $data[$key] = $this->permission->have_access($role_id, $this->module_name, $key);
            }

            echo view('Super_admin/header');
            echo view('Super_admin/sidebar');
            if ($data['mod_access'] == 1) {
                echo view('Super_admin/Globaladdress/globaladdress', $data);
            }else {
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
 
		$result = $this->globaladdressModel->select('global_address_id, division, zila, upazila, pourashava, ward, createdDtm, createdBy, updatedDtm, updatedBy, deleted, deletedRole')->findAll();
		
		foreach ($result as $key => $value) {
							
			$ops = '<div class="btn-group">';
			//$ops .= '	<button type="button" class="btn btn-sm btn-info" onclick="edit('. $value->global_address_id .')"><i class="fa fa-edit"></i></button>';
			$ops .= '	<button type="button" class="btn btn-sm btn-danger" onclick="remove('. $value->global_address_id .')"><i class="fa fa-trash"></i></button>';
			$ops .= '</div>';
			
			$data['data'][$key] = array(
				$value->global_address_id,
                divisionname($value->division),
                districtname($value->zila),
                upazilaname($value->upazila),
//				$value->pourashava,
//				$value->ward,
//				$value->createdDtm,
//				$value->createdBy,
//				$value->updatedDtm,
//				$value->updatedBy,
//				$value->deleted,
//				$value->deletedRole,

				$ops,
			);
		} 

		return $this->response->setJSON($data);		
	}

	public function getUpdateData(){
        //$response = array();
        $vew = '';
        $id = $this->request->getPost('global_address_id');

        if ($this->validation->check($id, 'required|numeric')) {

            $data = $this->globaladdressModel->where('global_address_id' ,$id)->first();

            $vew .='<div class="row">
                       <input type="hidden" id="globalAddressId" name="globalAddressId" class="form-control" placeholder="Global address id" value="'.$data->global_address_id.'" required>
                    </div>';
            $vew .='<div class="row" >
                        <div class="col-md-12">
                             <div class="form-group">
                                 <label for="division"> Division: </label>
                                  <select class="form-control" id="division" name="division" onchange="viewdistrict(this.value)" required >
                                      <option value="">Please Select</option>
                                      '.divisionView($data->division).'
                                  </select>
                             </div>
                        </div>
                         <div class="col-md-12">
                              <div class="form-group">
                                    <label for="zila"> District: </label>
                                    <select class="form-control" name="zila" onchange="viewupazila(this.value)" id="zila" required>
                                        <option value="">Please Select</option>
                                        '.districtselect($data->zila,$data->division).'
                                    </select>
                              </div>
                         </div>
                         <div class="col-md-12">
                              <div class="form-group">
                                    <label for="upazila"> Upazila: </label>
                                    <select class="form-control" name="upazila" id="upazila" onchange="checkCity(this.value)"  required>
                                        <option value="">Please Select</option>
                                        '.upazilaselect($data->upazila,$data->zila).'
                                    </select>
                              </div>
                         </div>
                    </div>';

            return $vew;
           // return $this->response->setJSON($data);

        } else {

            throw new \CodeIgniter\Exceptions\PageNotFoundException();

        }
    }
	
	public function getOne()
	{
 		$response = array();
		
		$id = $this->request->getPost('global_address_id');
		
		if ($this->validation->check($id, 'required|numeric')) {
			
			$data = $this->globaladdressModel->where('global_address_id' ,$id)->first();
			
			return $this->response->setJSON($data);	
				
		} else {
			
			throw new \CodeIgniter\Exceptions\PageNotFoundException();

		}	
		
	}	
	
	public function add()
	{

        $response = array();


        $fields['division'] = $this->request->getPost('division');
        $fields['zila'] = $this->request->getPost('zila');
        $fields['upazila'] = $this->request->getPost('upazila');
        $fields['createdBy'] = '1';

        $check = $this->globaladdressModel->where($fields)->countAllResults();

        $this->validation->setRules([
            'division' => ['label' => 'Division', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'zila' => ['label' => 'Zila', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'upazila' => ['label' => 'Upazila', 'rules' => 'permit_empty|numeric|max_length[11]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
            $response['messages'] = $this->validation->listErrors();

        } else {

            if (empty($check)){

                if ($this->globaladdressModel->insert($fields)) {

                    $response['success'] = true;
                    $response['messages'] = 'Data has been inserted successfully';

                } else {

                    $response['success'] = false;
                    $response['messages'] = 'Insertion error!';

                }
            }else{
                $response['success'] = false;
                $response['messages'] = 'Global address already exists!';
            }
        }

        return $this->response->setJSON($response);
	}

	public function edit()
	{

        $response = array();
		
        $fields['global_address_id'] = $this->request->getPost('globalAddressId');
        $fields['division'] = $this->request->getPost('division');
        $fields['zila'] = $this->request->getPost('zila');
        $fields['upazila'] = $this->request->getPost('upazila');


        $this->validation->setRules([
            'division' => ['label' => 'Division', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'zila' => ['label' => 'Zila', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'upazila' => ['label' => 'Upazila', 'rules' => 'permit_empty|numeric|max_length[11]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
            $response['messages'] = $this->validation->listErrors();
			
        } else {



                if ($this->globaladdressModel->update($fields['global_address_id'], $fields)) {

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
		
		$id = $this->request->getPost('global_address_id');
		
		if (!$this->validation->check($id, 'required|numeric')) {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
			
		} else {	
		
			if ($this->globaladdressModel->where('global_address_id', $id)->delete()) {
								
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