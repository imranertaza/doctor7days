<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers\Mobile_app;

use App\Controllers\BaseController;


class Ambulance extends BaseController
{



    public function __construct(){}

    public function index()
    {

        echo view('Mobile_app/header');
        echo view('Mobile_app/Ambulance/ambulance');
        echo view('Mobile_app/footer');

    }

    public function ambulance_select(){
        echo view('Mobile_app/header');
        echo view('Mobile_app/Ambulance/ambulance_select');
        echo view('Mobile_app/footer');
    }



}