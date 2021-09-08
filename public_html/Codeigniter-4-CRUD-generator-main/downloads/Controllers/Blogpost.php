<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\BlogpostModel;

class Blogpost extends BaseController
{
	
    protected $blogpostModel;
    protected $validation;
	
	public function __construct()
	{
	    $this->blogpostModel = new BlogpostModel();
       	$this->validation =  \Config\Services::validation();
		
	}
	
	public function index()
	{

	    $data = [
                'controller'    	=> 'blogpost',
                'title'     		=> 'Blog Post'				
			];
		
		return view('blogpost', $data);
			
	}

	public function getAll()
	{
 		$response = array();		
		
	    $data['data'] = array();
 
		$result = $this->blogpostModel->select('post_id, title, description, image, featured_image, tags, createdDtm, createdBy, updatedDtm, updatedBy, deleted, deletedRole')->findAll();
		
		foreach ($result as $key => $value) {
							
			$ops = '<div class="btn-group">';
			$ops .= '	<button type="button" class="btn btn-sm btn-info" onclick="edit('. $value->post_id .')"><i class="fa fa-edit"></i></button>';
			$ops .= '	<button type="button" class="btn btn-sm btn-danger" onclick="remove('. $value->post_id .')"><i class="fa fa-trash"></i></button>';
			$ops .= '</div>';
			
			$data['data'][$key] = array(
				$value->post_id,
				$value->title,
				$value->description,
				$value->image,
				$value->featured_image,
				$value->tags,
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
		
		$id = $this->request->getPost('post_id');
		
		if ($this->validation->check($id, 'required|numeric')) {
			
			$data = $this->blogpostModel->where('post_id' ,$id)->first();
			
			return $this->response->setJSON($data);	
				
		} else {
			
			throw new \CodeIgniter\Exceptions\PageNotFoundException();

		}	
		
	}	
	
	public function add()
	{

        $response = array();

        $fields['post_id'] = $this->request->getPost('postId');
        $fields['title'] = $this->request->getPost('title');
        $fields['description'] = $this->request->getPost('description');
        $fields['image'] = $this->request->getPost('image');
        $fields['featured_image'] = $this->request->getPost('featuredImage');
        $fields['tags'] = $this->request->getPost('tags');
        $fields['createdDtm'] = $this->request->getPost('createdDtm');
        $fields['createdBy'] = $this->request->getPost('createdBy');
        $fields['updatedDtm'] = $this->request->getPost('updatedDtm');
        $fields['updatedBy'] = $this->request->getPost('updatedBy');
        $fields['deleted'] = $this->request->getPost('deleted');
        $fields['deletedRole'] = $this->request->getPost('deletedRole');


        $this->validation->setRules([
            'title' => ['label' => 'Title', 'rules' => 'required'],
            'description' => ['label' => 'Description', 'rules' => 'required'],
            'image' => ['label' => 'Image', 'rules' => 'required|max_length[155]'],
            'featured_image' => ['label' => 'Featured image', 'rules' => 'required|max_length[155]'],
            'tags' => ['label' => 'Tags', 'rules' => 'required'],
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

            if ($this->blogpostModel->insert($fields)) {
												
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
		
        $fields['post_id'] = $this->request->getPost('postId');
        $fields['title'] = $this->request->getPost('title');
        $fields['description'] = $this->request->getPost('description');
        $fields['image'] = $this->request->getPost('image');
        $fields['featured_image'] = $this->request->getPost('featuredImage');
        $fields['tags'] = $this->request->getPost('tags');
        $fields['createdDtm'] = $this->request->getPost('createdDtm');
        $fields['createdBy'] = $this->request->getPost('createdBy');
        $fields['updatedDtm'] = $this->request->getPost('updatedDtm');
        $fields['updatedBy'] = $this->request->getPost('updatedBy');
        $fields['deleted'] = $this->request->getPost('deleted');
        $fields['deletedRole'] = $this->request->getPost('deletedRole');


        $this->validation->setRules([
            'title' => ['label' => 'Title', 'rules' => 'required'],
            'description' => ['label' => 'Description', 'rules' => 'required'],
            'image' => ['label' => 'Image', 'rules' => 'required|max_length[155]'],
            'featured_image' => ['label' => 'Featured image', 'rules' => 'required|max_length[155]'],
            'tags' => ['label' => 'Tags', 'rules' => 'required'],
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

            if ($this->blogpostModel->update($fields['post_id'], $fields)) {
				
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
		
		$id = $this->request->getPost('post_id');
		
		if (!$this->validation->check($id, 'required|numeric')) {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
			
		} else {	
		
			if ($this->blogpostModel->where('post_id', $id)->delete()) {
								
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