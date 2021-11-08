<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers\Mobile_app;

use App\Controllers\BaseController;
use App\Models\Super_admin\ProductModel;
use App\Models\Super_admin\StoreModel;


class Shop extends BaseController
{

    protected $storeModel;
    protected $productModel;

    public function __construct(){
        $this->storeModel = new StoreModel();
        $this->productModel = new ProductModel();
    }

    public function index()
    {
        $store = $this->storeModel->where('is_default','1')->first();
        $pro = $this->productModel->where('store_id',$store->store_id)->findAll();
        $data = [
          'shop' => $store,
          'product' => $pro,
        ];
        echo view('Mobile_app/header');
        echo view('Mobile_app/Shop/shop',$data);
        echo view('Mobile_app/footer');

    }

    public function product_detail($id)
    {
        $pro = $this->productModel->where('prod_id',$id)->first();
        $data = [
            'product' => $pro,
        ];

        echo view('Mobile_app/header');
        echo view('Mobile_app/Shop/product_detail',$data);
        echo view('Mobile_app/footer');

    }



}