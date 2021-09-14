<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers\Mobile_app;

use App\Controllers\BaseController;


class Appionment extends BaseController
{



    public function __construct(){}

    public function index()
    {

        echo view('Mobile_app/header');
        echo view('Mobile_app/Appionment/appionment_form');
        echo view('Mobile_app/footer');

    }

    public function diagnostic_center_list(){
        echo view('Mobile_app/header');
        echo view('Mobile_app/Appionment/diagnostic_center_list');
        echo view('Mobile_app/footer');
    }

    public function doctor_specialties(){
        echo view('Mobile_app/header');
        echo view('Mobile_app/Appionment/doctor_specialties');
        echo view('Mobile_app/footer');
    }

    public function appionment_booking_form(){
        echo view('Mobile_app/header');
        echo view('Mobile_app/Appionment/appionment_booking_form');
        echo view('Mobile_app/footer');
    }

    public function appionment_success(){
        echo view('Mobile_app/header');
        echo view('Mobile_app/Appionment/appionment_success');
        echo view('Mobile_app/footer');
    }





}