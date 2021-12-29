<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers\Super_admin;

use App\Controllers\BaseController;

use App\Models\Hospital_admin\MessageModel;
use App\Libraries\Permission;
use App\Models\Hospital_admin\MessageToModel;
use App\Models\Mobile_app\HospitalModel;
use App\Models\Super_admin\PatientModel;

class Message extends BaseController
{
	
    protected $messageModel;
    protected $messageToModel;
    protected $patientModel;
    protected $hospitalModel;
    protected $validation;
    protected $session;
    protected $permission;
    private $module_name = 'Admanage';
	
	public function __construct()
	{
	    $this->messageModel = new MessageModel();
	    $this->messageToModel = new MessageToModel();
        $this->hospitalModel = new HospitalModel();
        $this->patientModel = new PatientModel();
       	$this->validation =  \Config\Services::validation();
       	$this->session = \Config\Services::session();
       	$this->permission = new Permission();
		
	}
	
	public function index()
	{
		$isLoggedIAdmin = $this->session->isLoggedIAdmin;
		$role_id = $this->session->AdminRole;

		if (isset($isLoggedIAdmin)) {

            $hospital = $this->hospitalModel->findAll();
            $patientModel = $this->patientModel->findAll();

		    $data = [
	                'controller'    	=> 'Super_admin/Message',
	                'title'     		=> 'Message',
	                'hospital'     		=> $hospital,
	                'patientModel'     		=> $patientModel,
				];


			$perm = $this->permission->module_permission_list($role_id, $this->module_name);
            foreach($perm as $key=>$val){
                 $data[$key] = $this->permission->have_access($role_id, $this->module_name, $key);
            }

	        echo view('Super_admin/header');
	        echo view('Super_admin/sidebar');
	        if ($data['mod_access'] == 1) {
            	echo view('Super_admin/Message/message', $data);
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
 
		$result = $this->messageModel->findAll();
		
		foreach ($result as $key => $value) {
							
			$ops = '<div class="btn-group">';
			//$ops .= '	<button type="button" class="btn btn-sm btn-info" onclick="edit('. $value->message_id .')"><i class="fa fa-edit"></i></button>';
			$ops .= '	<button type="button" class="btn btn-sm btn-danger" onclick="remove('. $value->message_id .')"><i class="fa fa-trash"></i></button>';
			$ops .= '</div>';
			
			$data['data'][$key] = array(
				$value->message_id,
				$value->title,
				$value->description,

				$ops,
			);
		} 

		return $this->response->setJSON($data);		
	}

	
	public function add()
	{

        $response = array();

        $fields['from'] = $this->session->admin_id;
        $fields['title'] = $this->request->getPost('title');
        $fields['description'] = $this->request->getPost('description');

        $fields['for_hospital'] = $this->request->getPost('for_hospital');
        $fields['for_diagnostic'] = $this->request->getPost('for_diagnostic');
        $fields['for_patient'] = $this->request->getPost('for_patient');

        $hospitalId = $this->request->getPost('hospital[]');
        $diagnosticId = $this->request->getPost('diagnostic[]');
        $patientId = $this->request->getPost('patient[]');


        $this->validation->setRules([
            'description' => ['label' => 'description', 'rules' => 'required'],
            'title' => ['label' => 'title', 'rules' => 'required'],
        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
            $response['messages'] = $this->validation->listErrors();
			
        } else {

            if ($this->messageModel->insert($fields)) {

                $message_id = $this->messageModel->insertID();

                if (!empty($hospitalId)){
                    foreach ($hospitalId as $hos){
                        $hosp['message_id'] = $message_id;
                        $hosp['to_hospital_id'] = $hos;
                        $this->messageToModel->insert($hosp);
                    }
                }

                if (!empty($diagnosticId)){
                    foreach ($diagnosticId as $diag){
                        $daigon['message_id'] = $message_id;
                        $daigon['to_diagnostic_id'] = $diag;
                        $this->messageToModel->insert($daigon);
                    }
                }

                if (!empty($patientId)){
                    foreach ($patientId as $pat){
                        $patient['message_id'] = $message_id;
                        $patient['to_patient_id'] = $pat;
                        $this->messageToModel->insert($patient);
                    }
                }
												
                $response['success'] = true;
                $response['messages'] = 'Data has been inserted successfully';	
				
            } else {
				
                $response['success'] = false;
                $response['messages'] = 'Insertion error!';
				
            }
        }
		
        return $this->response->setJSON($response);
	}

	
	public function remove()
	{
		$response = array();
		
		$id = $this->request->getPost('message_id');
		
		if (!$this->validation->check($id, 'required|numeric')) {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
			
		} else {

            $this->messageToModel->where('message_id', $id)->delete();
		
			if ($this->messageModel->where('message_id', $id)->delete()) {
								
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