<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers\Mobile_app;

use App\Controllers\BaseController;


class Login extends BaseController
{



    public function __construct(){}

    public function index()
    {

        echo view('Mobile_app/header');
        echo view('Mobile_app/Login/login');
        //echo view('Mobile_app/footer');

    }



}