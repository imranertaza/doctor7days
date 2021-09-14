<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers\Mobile_app;

use App\Controllers\BaseController;


class Diagnostic extends BaseController
{



    public function __construct(){}

    public function index()
    {

        echo view('Mobile_app/header');
        echo view('Mobile_app/Diagnostic/diagnostic');
        echo view('Mobile_app/footer');

    }

    public function diagnostic_form()
    {

        echo view('Mobile_app/header');
        echo view('Mobile_app/Diagnostic/diagnostic_form');
        echo view('Mobile_app/footer');

    }



}