<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers\Super_admin;

use App\Controllers\BaseController;

use App\Models\Super_admin\BlogcommentsModel;
use App\Models\Super_admin\BlogpostModel;
use App\Libraries\Permission;

class Blogpost extends BaseController
{

    protected $blogpostModel;
    protected $blogcommentsModel;
    protected $validation;
    protected $crop;
    protected $session;
    protected $permission;
    private $module_name = 'Blogpost';

    public function __construct()
    {
        $this->blogpostModel = new BlogpostModel();
        $this->blogcommentsModel = new BlogcommentsModel();
        $this->validation = \Config\Services::validation();
        $this->session = \Config\Services::session();
        $this->permission = new Permission();
        $this->crop = \Config\Services::image();
    }

    public function index()
    {

        $isLoggedIAdmin = $this->session->isLoggedIAdmin;
        $role_id = $this->session->AdminRole;

        if (isset($isLoggedIAdmin)) {
            $data = [
                'controller' => 'Super_admin/blogpost',
                'title' => 'Blog Post'
            ];

            $perm = $this->permission->module_permission_list($role_id, $this->module_name);
            foreach ($perm as $key => $val) {
                $data[$key] = $this->permission->have_access($role_id, $this->module_name, $key);
            }
            echo view('Super_admin/header');
            echo view('Super_admin/sidebar');
            if ($data['mod_access'] == 1) {
                echo view('Super_admin/blogpost/blogpost', $data);
            } else {
                echo view('Super_admin/No_permission', $data);
            }

            echo view('Super_admin/footer');

        } else {
            return redirect()->to(site_url("/super_admin/login"));
        }

    }

    public function update($id)
    {
        $isLoggedIAdmin = $this->session->isLoggedIAdmin;
        $role_id = $this->session->AdminRole;

        if (isset($isLoggedIAdmin)) {

            $blogPost = $this->blogpostModel->where('post_id', $id)->first();
            $blogComm = $this->blogcommentsModel->where('post_id', $id)->findAll();
            $data = [
                'controller' => 'Super_admin/blogpost',
                'title' => 'Blog Post',
                'blog' => $blogPost,
                'blogcomments' => $blogComm,
            ];

            $perm = $this->permission->module_permission_list($role_id, $this->module_name);
            foreach ($perm as $key => $val) {
                $data[$key] = $this->permission->have_access($role_id, $this->module_name, $key);
            }
            echo view('Super_admin/header');
            echo view('Super_admin/sidebar');
            if ($data['mod_access'] == 1) {
                echo view('Super_admin/blogpost/update_form', $data);
            } else {
                echo view('Super_admin/No_permission', $data);
            }

            echo view('Super_admin/footer');

        } else {
            return redirect()->to(site_url("/super_admin/login"));
        }
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
                '<img src="' . base_url() . '/assets/upload/blog/'.$value->post_id.'/'.$img . '"
                                                         width="100%">',
                '<img src="' . base_url() . '/assets/upload/blog/'.$value->post_id.'/'.$featuredimg . '"
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

            if ($this->blogpostModel->insert($fields)) {

                $data['post_id'] = $this->blogpostModel->getInsertID();

                $target_dir = FCPATH . '/assets/upload/blog/'.$data['post_id'].'/';
                if(!file_exists($target_dir)){
                    mkdir($target_dir,0655);
                }

                $name = $image->getRandomName();
                $image->move($target_dir, $name);
                $lo_nameimg = 'bI_'.$image->getName();
                $this->crop->withFile($target_dir.''.$name)->fit(328, 185, 'center')->save($target_dir.''.$lo_nameimg);
                unlink($target_dir.''.$name);
                $data['image'] = $lo_nameimg;


                $featured = $featured_image->getRandomName();
                $featured_image->move($target_dir, $featured);
                $fu_nameimg = 'bI_'.$featured_image->getName();
                $this->crop->withFile($target_dir.''.$featured)->fit(150, 100, 'center')->save($target_dir.''.$fu_nameimg);
                unlink($target_dir.''.$featured);
                $data['featured_image'] = $fu_nameimg;

                $this->blogpostModel->update($data['post_id'], $data);

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
        $target_dir = FCPATH . '/assets/upload/blog/'.$fields['post_id'].'/';
        if(!file_exists($target_dir)){
            mkdir($target_dir,0655);
        }

        if (!empty($_FILES['image']['name'])) {
            $name = $image->getRandomName();
            $image->move($target_dir, $name);
            $lo_nameimg = 'bI_'.$image->getName();
            $this->crop->withFile($target_dir.''.$name)->fit(328, 185, 'center')->save($target_dir.''.$lo_nameimg);
            unlink($target_dir.''.$name);
            $fields['image'] = $lo_nameimg;
        }

        if (!empty($_FILES['featured_image']['name'])) {
            $fname = $featImage->getRandomName();
            $featImage->move($target_dir, $fname);
            $fu_nameimg = 'bI_'.$featImage->getName();
            $this->crop->withFile($target_dir.''.$fname)->fit(150, 100, 'center')->save($target_dir.''.$fu_nameimg);
            unlink($target_dir.''.$fname);
            $fields['featured_image'] = $fu_nameimg;
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

    public function updateStatus()
    {

        $response = array();
        $fields['blog_comment_id'] = $this->request->getPost('id');
        $fields['status'] = $this->request->getPost('status');

        $this->blogcommentsModel->update($fields['blog_comment_id'], $fields);


        $response['success'] = true;
        $response['messages'] = 'Successfully updated';

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