<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers\Mobile_app;

use App\Controllers\BaseController;


class Cart extends BaseController
{



    public function __construct(){}

    public function index()
    {

        echo view('Mobile_app/header');
        echo view('Mobile_app/Cart/cart');
        echo view('Mobile_app/footer');

    }

    public function payment(){
        echo view('Mobile_app/header');
        echo view('Mobile_app/Cart/payment');
        echo view('Mobile_app/footer');
    }



}