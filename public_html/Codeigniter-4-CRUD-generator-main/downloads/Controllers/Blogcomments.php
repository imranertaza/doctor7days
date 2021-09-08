<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\BlogcommentsModel;

class Blogcomments extends BaseController
{
	
    protected $blogcommentsModel;
    protected $validation;
	
	public function __construct()
	{
	    $this->blogcommentsModel = new BlogcommentsModel();
       	$this->validation =  \Config\Services::validation();
		
	}
	
	public function index()
	{

	    $data = [
                'controller'    	=> 'blogcomments',
                'title'     		=> 'Blog Comments'				
			];
		
		return view('blogcomments', $data);
			
	}

	public function getAll()
	{
 		$response = array();		
		
	    $data['data'] = array();
 
		$result = $this->blogcommentsModel->select('blog_comment_id, post_id, comment, patient_id, createdDtm, createdBy, updatedDtm, updatedBy, deleted, deletedRole')->findAll();
		
		foreach ($result as $key => $value) {
							
			$ops = '<div class="btn-group">';
			$ops .= '	<button type="button" class="btn btn-sm btn-info" onclick="edit('. $value->blog_comment_id .')"><i class="fa fa-edit"></i></button>';
			$ops .= '	<button type="button" class="btn btn-sm btn-danger" onclick="remove('. $value->blog_comment_id .')"><i class="fa fa-trash"></i></button>';
			$ops .= '</div>';
			
			$data['data'][$key] = array(
				$value->blog_comment_id,
				$value->post_id,
				$value->comment,
				$value->patient_id,
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
		
		$id = $this->request->getPost('blog_comment_id');
		
		if ($this->validation->check($id, 'required|numeric')) {
			
			$data = $this->blogcommentsModel->where('blog_comment_id' ,$id)->first();
			
			return $this->response->setJSON($data);	
				
		} else {
			
			throw new \CodeIgniter\Exceptions\PageNotFoundException();

		}	
		
	}	
	
	public function add()
	{

        $response = array();

        $fields['blog_comment_id'] = $this->request->getPost('blogCommentId');
        $fields['post_id'] = $this->request->getPost('postId');
        $fields['comment'] = $this->request->getPost('comment');
        $fields['patient_id'] = $this->request->getPost('patientId');
        $fields['createdDtm'] = $this->request->getPost('createdDtm');
        $fields['createdBy'] = $this->request->getPost('createdBy');
        $fields['updatedDtm'] = $this->request->getPost('updatedDtm');
        $fields['updatedBy'] = $this->request->getPost('updatedBy');
        $fields['deleted'] = $this->request->getPost('deleted');
        $fields['deletedRole'] = $this->request->getPost('deletedRole');


        $this->validation->setRules([
            'post_id' => ['label' => 'Post id', 'rules' => 'required|numeric|max_length[11]'],
            'comment' => ['label' => 'Comment', 'rules' => 'required'],
            'patient_id' => ['label' => 'Patient id', 'rules' => 'required|numeric|max_length[11]'],
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

            if ($this->blogcommentsModel->insert($fields)) {
												
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
		
        $fields['blog_comment_id'] = $this->request->getPost('blogCommentId');
        $fields['post_id'] = $this->request->getPost('postId');
        $fields['comment'] = $this->request->getPost('comment');
        $fields['patient_id'] = $this->request->getPost('patientId');
        $fields['createdDtm'] = $this->request->getPost('createdDtm');
        $fields['createdBy'] = $this->request->getPost('createdBy');
        $fields['updatedDtm'] = $this->request->getPost('updatedDtm');
        $fields['updatedBy'] = $this->request->getPost('updatedBy');
        $fields['deleted'] = $this->request->getPost('deleted');
        $fields['deletedRole'] = $this->request->getPost('deletedRole');


        $this->validation->setRules([
            'post_id' => ['label' => 'Post id', 'rules' => 'required|numeric|max_length[11]'],
            'comment' => ['label' => 'Comment', 'rules' => 'required'],
            'patient_id' => ['label' => 'Patient id', 'rules' => 'required|numeric|max_length[11]'],
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

            if ($this->blogcommentsModel->update($fields['blog_comment_id'], $fields)) {
				
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
		
		$id = $this->request->getPost('blog_comment_id');
		
		if (!$this->validation->check($id, 'required|numeric')) {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
			
		} else {	
		
			if ($this->blogcommentsModel->where('blog_comment_id', $id)->delete()) {
								
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