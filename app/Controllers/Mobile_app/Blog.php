<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers\Mobile_app;

use App\Controllers\BaseController;


class Blog extends BaseController
{



    public function __construct(){}

    public function index()
    {

        echo view('Mobile_app/header');
        echo view('Mobile_app/Blog/blog');
        echo view('Mobile_app/footer');

    }

    public function blog_detail()
    {

        echo view('Mobile_app/header');
        echo view('Mobile_app/Blog/blog_detail');
        echo view('Mobile_app/footer');

    }



}