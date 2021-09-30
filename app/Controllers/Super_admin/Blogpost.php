<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers\Super_admin;

use App\Controllers\BaseController;

use App\Models\Super_admin\BlogpostModel;

class Blogpost extends BaseController
{

    protected $blogpostModel;
    protected $validation;

    public function __construct()
    {
        $this->blogpostModel = new BlogpostModel();
        $this->validation = \Config\Services::validation();

    }

    public function index()
    {

        $data = [
            'controller' => 'Super_admin/blogpost',
            'title' => 'Blog Post'
        ];

        echo view('Super_admin/header');
        echo view('Super_admin/sidebar');
        echo view('Super_admin/blogpost/blogpost', $data);
        echo view('Super_admin/footer');

    }

    public function update($id)
    {

        $blogPost = $this->blogpostModel->where('post_id', $id)->first();
        $data = [
            'controller' => 'Super_admin/blogpost',
            'title' => 'Blog Post',
            'blog' => $blogPost,
        ];

        echo view('Super_admin/header');
        echo view('Super_admin/sidebar');
        echo view('Super_admin/blogpost/update_form', $data);
        echo view('Super_admin/footer');
    }

    public function getAll()
    {
        $response = array();

        $data['data'] = array();

        $result = $this->blogpostModel->select('post_id, title, description, image, featured_image, tags, createdDtm, createdBy, updatedDtm, updatedBy, deleted, deletedRole')->findAll();

        foreach ($result as $key => $value) {
            $img = (!empty($value->image)) ? $value->image : 'noimage.jpg';
            $featuredimg = (!empty($value->featured_image)) ? $value->featured_image : 'noimage.jpg';
            $ops = '<div class="btn-group">';
            $ops .= '	<a href="' . base_url() . '/Super_admin/blogpost/update/' . $value->post_id . '" class="btn btn-sm btn-info" ><i class="fa fa-edit"></i></a>';
            $ops .= '	<button type="button" class="btn btn-sm btn-danger" onclick="remove(' . $value->post_id . ')"><i class="fa fa-trash"></i></button>';
            $ops .= '</div>';

            $data['data'][$key] = array(
                $value->post_id,
                $value->title,
                $value->description,
                '<img src="' . base_url() . '/assets/uplode/blog/' . $img . '"
                                                         width="100%">',
                '<img src="' . base_url() . '/assets/uplode/blog/' . $featuredimg . '"
                                                         width="80">',
                $value->tags,

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

            $data = $this->blogpostModel->where('post_id', $id)->first();

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
        $image = $this->request->getFile('image');
        $featured_image = $this->request->getFile('featuredImage');
        $fields['tags'] = $this->request->getPost('tags');


        $this->validation->setRules([
            'title' => ['label' => 'Title', 'rules' => 'required'],
            'description' => ['label' => 'Description', 'rules' => 'required'],
            'tags' => ['label' => 'Tags', 'rules' => 'required'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
            $response['messages'] = $this->validation->listErrors();

        } else {

            $name = $image->getRandomName();
            $image->move(FCPATH . '\assets\uplode\blog', $name);
            $fields['image'] = $name;

            $featured = $featured_image->getRandomName();
            $featured_image->move(FCPATH . '\assets\uplode\blog', $featured);
            $fields['featured_image'] = $featured;

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

    public function updateReg()
    {
        $response = array();

        $fields['post_id'] = $this->request->getPost('post_id');
        $fields['title'] = $this->request->getPost('title');
        $fields['description'] = $this->request->getPost('description');
        $fields['tags'] = $this->request->getPost('tags');


        $this->validation->setRules([
            'title' => ['label' => 'Title', 'rules' => 'required'],

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

    public function updateImage()
    {
        $response = array();

        $fields['post_id'] = $this->request->getPost('post_id');
        $image = $this->request->getFile('image');
        $featImage = $this->request->getFile('featured_image');

        if (!empty($_FILES['image']['name'])) {
            $name = $image->getRandomName();
            $image->move(FCPATH . '\assets\uplode\blog',$name);
            $fields['image'] = $name;
        }

        if (!empty($_FILES['featured_image']['name'])) {
            $fname = $featImage->getRandomName();
            $featImage->move(FCPATH . '\assets\uplode\blog',$fname);
            $fields['featured_image'] = $fname;
        }


        if ($this->blogpostModel->update($fields['post_id'], $fields)) {

            $response['success'] = true;
            $response['messages'] = 'Successfully updated';

        } else {

            $response['success'] = false;
            $response['messages'] = 'Update error!';

        }


        return $this->response->setJSON($response);
    }

    public function edit()
    {

        $response = array();

        $fields['post_id'] = $this->request->getPost('postId');
        $fields['title'] = $this->request->getPost('title');
        $fields['description'] = $this->request->getPost('description');
//        $fields['image'] = $this->request->getPost('image');
//        $fields['featured_image'] = $this->request->getPost('featuredImage');
        $fields['tags'] = $this->request->getPost('tags');


        $this->validation->setRules([
            'title' => ['label' => 'Title', 'rules' => 'required'],

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