<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers\Hospital_admin;

use App\Controllers\BaseController;

use App\Models\Hospital_admin\GlobaladdressModel;
use App\Models\Hospital_admin\HospitalModel;

class Hospital extends BaseController
{
	
    protected $hospitalModel;
    protected $globaladdressModel;
    protected $validation;
	
	public function __construct()
	{
	    $this->hospitalModel = new HospitalModel();
        $this->globaladdressModel = new GlobaladdressModel();
       	$this->validation =  \Config\Services::validation();
		
	}
	
	public function index()
	{

	    $data = [
                'controller'    	=> 'Hospital_admin/hospital',
                'title'     		=> 'Hospital'				
			];

        echo view('Hospital_admin/header');
        echo view('Hospital_admin/sidebar');
		echo view('Hospital_admin/Hospital/hospital', $data);
        echo view('Hospital_admin/footer');
			
	}

	public function getAll()
	{
 		$response = array();		
		
	    $data['data'] = array();
 
		$result = $this->hospitalModel->select('h_id, name, description, email, global_address_id, mobile, comment, logo, image, banner, is_default, hospital_cat_id, status, createdDtm, updatedBy, updatedDtm, deleted, deletedRole')->findAll();
		
		foreach ($result as $key => $value) {
							
			$ops = '<div class="btn-group">';
			$ops .= '<a href="'.base_url().'/hospital_admin/hospital/updateForm/'. $value->h_id .'" class="btn btn-sm btn-info" ><i class="fa fa-edit"></i></a>';
			$ops .= '	<button type="button" class="btn btn-sm btn-danger" onclick="remove('. $value->h_id .')"><i class="fa fa-trash"></i></button>';
			$ops .= '</div>';
			
			$data['data'][$key] = array(
				$value->h_id,
				$value->name,
				$value->email,
				$value->mobile,
                statusView($value->status),

				$ops,
			);
		} 

		return $this->response->setJSON($data);		
	}

	public function updateForm($id){

        $result = $this->hospitalModel->where('h_id' ,$id)->first();
        $data = [
            'controller' => 'Hospital_admin/hospital',
            'hospital' => $result,
        ];

        echo view('Hospital_admin/header');
        echo view('Hospital_admin/sidebar');
        echo view('Hospital_admin/Hospital/update_form',$data);
        echo view('Hospital_admin/footer');


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
            $fields['global_address_id'] = $gloadd->first()->global_address_id;
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
        helper(['form', 'url']);
        $response = array();

        $fields['h_id'] = $this->request->getPost('h_id');
        $logo = $this->request->getFile('logo');
//        $image = $this->request->getFile('image');
//        $banner = $this->request->getFile('banner');


//        if (!empty($_FILES['logo']['name'])){
            $logo->move(FCPATH.'\assets\uplode\hospital');
            $fields['logo'] = $logo->getClientName();
            if ($this->hospitalModel->update($fields['h_id'], $fields)) {
                $response['success'] = true;
                $response['messages'] = 'Data has been Update successfully';
            } else {
                $response['success'] = false;
                $response['messages'] = 'Insertion error!';
            }
//        }



//        if ($this->hospitalModel->update($fields['h_id'], $fields)) {
//            $response['success'] = true;
//            $response['messages'] = 'Data has been Update successfully';
//        } else {
//            $response['success'] = false;
//            $response['messages'] = 'Insertion error!';
//        }
//
//
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

            if ($this->hospitalModel->insert($fields)) {
												
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
				$response['messages'] = 'Deletion error!';
				
			}
		}	
	
        return $this->response->setJSON($response);		
	}	
		
}	