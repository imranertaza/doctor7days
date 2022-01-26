<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers\Web;

use App\Controllers\BaseController;

use App\Models\Hospital_admin\AdminModel;
use App\Libraries\Permission;
use App\Models\Super_admin\ProductModel;

class Shops extends BaseController
{

    protected $adminModel;
    protected $validation;
    protected $session;
    protected $permission;
    protected $productModel;
    private $module_name = 'Admin';

    public function __construct()
    {
        $this->adminModel = new AdminModel();
        $this->productModel = new ProductModel();
        $this->validation =  \Config\Services::validation();
        $this->session = \Config\Services::session();
        $this->permission = new Permission();

    }

    public function index()
    {
        $product = $this->productModel->findAll();
        $data = [
            'product'     		=> $product,
        ];


        echo view('Web/header');
        echo view('Web/Shops/shops', $data);
        echo view('Web/footer');

    }
    public function details($id){
        $product = $this->productModel->find($id);
        $data = [
            'product'     		=> $product,
        ];


        echo view('Web/header');
        echo view('Web/Shops/details', $data);
        echo view('Web/footer');
    }



}