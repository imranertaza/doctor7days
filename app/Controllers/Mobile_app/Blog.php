<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers\Mobile_app;

use App\Controllers\BaseController;
use App\Models\Mobile_app\BlogpostModel;


class Blog extends BaseController
{

    protected $blogpostModel;

    public function __construct(){
        $this->blogpostModel = new BlogpostModel();
    }

    public function index()
    {
        $data['post'] = $this->blogpostModel->findAll();

        echo view('Mobile_app/header');
        echo view('Mobile_app/Blog/blog',$data);
        echo view('Mobile_app/footer');

    }

    public function blog_detail($id)
    {
        $data['post'] = $this->blogpostModel->where('post_id',$id)->first();
        echo view('Mobile_app/header');
        echo view('Mobile_app/Blog/blog_detail',$data);
        echo view('Mobile_app/footer');

    }



}