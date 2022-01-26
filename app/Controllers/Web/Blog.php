<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers\Web;

use App\Controllers\BaseController;

use App\Models\Hospital_admin\AdminModel;
use App\Libraries\Permission;
use App\Models\Mobile_app\BlogpostModel;

class Blog extends BaseController
{

    protected $adminModel;
    protected $validation;
    protected $session;
    protected $permission;
    protected $blogpostModel;
    private $module_name = 'Admin';

    public function __construct()
    {
        $this->adminModel = new AdminModel();
        $this->blogpostModel = new BlogpostModel();
        $this->validation =  \Config\Services::validation();
        $this->session = \Config\Services::session();
        $this->permission = new Permission();

    }

    public function index()
    {
        $blog = $this->blogpostModel->findAll();
        $data = [
            'blog'     		=> $blog,
        ];


        echo view('Web/header');
        echo view('Web/Blog/index', $data);
        echo view('Web/footer');

    }
    public function details($id){
        $blog = $this->blogpostModel->find($id);
        $data = [
            'blog'     		=> $blog,
        ];


        echo view('Web/header');
        echo view('Web/Blog/details', $data);
        echo view('Web/footer');
    }



}