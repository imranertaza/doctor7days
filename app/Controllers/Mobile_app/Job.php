<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers\Mobile_app;

use App\Controllers\BaseController;


class Job extends BaseController
{



    public function __construct(){}

    public function index()
    {

        echo view('Mobile_app/header');
        echo view('Mobile_app/Job/job');
        echo view('Mobile_app/footer');

    }

    public function job_apply()
    {

        echo view('Mobile_app/header');
        echo view('Mobile_app/Job/job_apply');
        echo view('Mobile_app/footer');

    }



}