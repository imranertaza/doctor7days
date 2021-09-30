<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers\Super_admin;

use App\Controllers\BaseController;

use App\Models\Super_admin\JobModel;

class Job extends BaseController
{
	
    protected $jobModel;
    protected $validation;
	
	public function __construct()
	{
	    $this->jobModel = new JobModel();
       	$this->validation =  \Config\Services::validation();
		
	}
	
	public function index()
	{

	    $data = [
                'controller'    	=> 'Super_admin/job',
                'title'     		=> 'Jobs'				
			];

        echo view('Super_admin/header');
        echo view('Super_admin/sidebar');
		echo view('Super_admin/Job/job', $data);
        echo view('Super_admin/footer');
			
	}

	public function getAll()
	{
 		$response = array();		
		
	    $data['data'] = array();
 
		$result = $this->jobModel->select('job_id, title, description, salary, location, daily_time, total_applied, h_id, createdDtm, createdBy, updatedDtm, updatedBy, deleted, deletedRole')->findAll();
		
		foreach ($result as $key => $value) {
							
			$ops = '<div class="btn-group">';
			$ops .= '	<button type="button" class="btn btn-sm btn-info" onclick="edit('. $value->job_id .')"><i class="fa fa-edit"></i></button>';
			$ops .= '	<button type="button" class="btn btn-sm btn-danger" onclick="remove('. $value->job_id .')"><i class="fa fa-trash"></i></button>';
			$ops .= '</div>';
			
			$data['data'][$key] = array(
				$value->job_id,
				$value->title,
				$value->description,
				$value->salary,
                divisionname($value->location),
				$value->daily_time .' Hours',
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
			
			$data = $this->jobModel->where('job_id' ,$id)->first();
			
			return $this->response->setJSON($data);	
				
		} else {
			
			throw new \CodeIgniter\Exceptions\PageNotFoundException();

		}	
		
	}	
	
	public function add()
	{

        $response = array();


        $fields['title'] = $this->request->getPost('title');
        $fields['description'] = $this->request->getPost('description');
        $fields['salary'] = $this->request->getPost('salary');
        $fields['location'] = $this->request->getPost('location');
        $fields['daily_time'] = $this->request->getPost('dailyTime');
        $fields['h_id'] = '1';
        $fields['createdBy'] = '1';


        $this->validation->setRules([
            'title' => ['label' => 'Title', 'rules' => 'required|max_length[155]'],
            'description' => ['label' => 'Description', 'rules' => 'required'],
            'salary' => ['label' => 'Salary', 'rules' => 'required|numeric|max_length[15]'],
            'location' => ['label' => 'Location', 'rules' => 'required|max_length[155]'],
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
		
        $fields['job_id'] = $this->request->getPost('jobId');
        $fields['title'] = $this->request->getPost('title');
        $fields['description'] = $this->request->getPost('description');
        $fields['salary'] = $this->request->getPost('salary');
        $fields['location'] = $this->request->getPost('location');
        $fields['daily_time'] = $this->request->getPost('dailyTime');
        $fields['updatedBy'] = '1';


        $this->validation->setRules([
            'title' => ['label' => 'Title', 'rules' => 'required|max_length[155]'],
            'description' => ['label' => 'Description', 'rules' => 'required'],
            'salary' => ['label' => 'Salary', 'rules' => 'required|numeric|max_length[15]'],
            'location' => ['label' => 'Location', 'rules' => 'required|max_length[155]'],
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