<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\JobModel;

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
                'controller'    	=> 'job',
                'title'     		=> 'Jobs'				
			];
		
		return view('job', $data);
			
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
				$value->location,
				$value->daily_time,
				$value->total_applied,
				$value->h_id,
				$value->createdDtm,
				$value->createdBy,
				$value->updatedDtm,
				$value->updatedBy,
				$value->deleted,
				$value->deletedRole,

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

        $fields['job_id'] = $this->request->getPost('jobId');
        $fields['title'] = $this->request->getPost('title');
        $fields['description'] = $this->request->getPost('description');
        $fields['salary'] = $this->request->getPost('salary');
        $fields['location'] = $this->request->getPost('location');
        $fields['daily_time'] = $this->request->getPost('dailyTime');
        $fields['total_applied'] = $this->request->getPost('totalApplied');
        $fields['h_id'] = $this->request->getPost('hId');
        $fields['createdDtm'] = $this->request->getPost('createdDtm');
        $fields['createdBy'] = $this->request->getPost('createdBy');
        $fields['updatedDtm'] = $this->request->getPost('updatedDtm');
        $fields['updatedBy'] = $this->request->getPost('updatedBy');
        $fields['deleted'] = $this->request->getPost('deleted');
        $fields['deletedRole'] = $this->request->getPost('deletedRole');


        $this->validation->setRules([
            'title' => ['label' => 'Title', 'rules' => 'required|max_length[155]'],
            'description' => ['label' => 'Description', 'rules' => 'required'],
            'salary' => ['label' => 'Salary', 'rules' => 'required|numeric|max_length[15]'],
            'location' => ['label' => 'Location', 'rules' => 'required|max_length[155]'],
            'daily_time' => ['label' => 'Daily time', 'rules' => 'required|max_length[155]'],
            'total_applied' => ['label' => 'Total applied', 'rules' => 'required|max_length[155]'],
            'h_id' => ['label' => 'H id', 'rules' => 'required|numeric|max_length[11]'],
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
        $fields['total_applied'] = $this->request->getPost('totalApplied');
        $fields['h_id'] = $this->request->getPost('hId');
        $fields['createdDtm'] = $this->request->getPost('createdDtm');
        $fields['createdBy'] = $this->request->getPost('createdBy');
        $fields['updatedDtm'] = $this->request->getPost('updatedDtm');
        $fields['updatedBy'] = $this->request->getPost('updatedBy');
        $fields['deleted'] = $this->request->getPost('deleted');
        $fields['deletedRole'] = $this->request->getPost('deletedRole');


        $this->validation->setRules([
            'title' => ['label' => 'Title', 'rules' => 'required|max_length[155]'],
            'description' => ['label' => 'Description', 'rules' => 'required'],
            'salary' => ['label' => 'Salary', 'rules' => 'required|numeric|max_length[15]'],
            'location' => ['label' => 'Location', 'rules' => 'required|max_length[155]'],
            'daily_time' => ['label' => 'Daily time', 'rules' => 'required|max_length[155]'],
            'total_applied' => ['label' => 'Total applied', 'rules' => 'required|max_length[155]'],
            'h_id' => ['label' => 'H id', 'rules' => 'required|numeric|max_length[11]'],
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