<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers\Mobile_app;

use App\Controllers\BaseController;


class Shop extends BaseController
{



    public function __construct(){}

    public function index()
    {

        echo view('Mobile_app/header');
        echo view('Mobile_app/Shop/shop');
        echo view('Mobile_app/footer');

    }

    public function product_detail()
    {

        echo view('Mobile_app/header');
        echo view('Mobile_app/Shop/product_detail');
        echo view('Mobile_app/footer');

    }



}