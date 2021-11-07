<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers\Mobile_app;
use App\Models\Mobile_app\AmbulanceModel;
use App\Models\Mobile_app\AmbulanceUserModel;
use App\Models\Mobile_app\GlobaladdressModel;
use App\Controllers\BaseController;


class Ambulance_dashboard extends BaseController
{

    protected $ambulanceModel;
    protected $globaladdressModel;
    protected $ambulanceUserModel;
    protected $validation;
    protected $session;

    public function __construct(){
        $this->ambulanceModel = new AmbulanceModel();
        $this->globaladdressModel = new GlobaladdressModel();
        $this->ambulanceUserModel = new AmbulanceUserModel();
        $this->pager = \Config\Services::pager();
        $this->session = \Config\Services::session();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $isAmbulanceLogin = $this->session->isAmbulanceLogin;
        if(!isset($isAmbulanceLogin) || $isAmbulanceLogin != TRUE){
            return redirect()->to(site_url("/Mobile_app/Ambulance/login"));
        }
        else {
            $userId = $this->session->user_id;
            $data['ambulance'] = $this->ambulanceModel->where('ambulance_user_id',$userId)->findAll();
            $data['image'] = get_data_by_id('photo','ambulance_users','ambulance_user_id',$userId);
            echo view('Mobile_app/header');
            echo view('Mobile_app/Ambulance/dashboard', $data);
            echo view('Mobile_app/footer');
        }

    }

    public function register_success()
    {
        $isAmbulanceLogin = $this->session->isAmbulanceLogin;
        if(!isset($isAmbulanceLogin) || $isAmbulanceLogin != TRUE){
            return redirect()->to(site_url("/Mobile_app/Ambulance/login"));
        }
        else {
            $userId = $this->session->user_id;
            $data['image'] = get_data_by_id('photo','ambulance_users','ambulance_user_id',$userId);
            echo view('Mobile_app/header');
            echo view('Mobile_app/Ambulance/after_register',$data);
            echo view('Mobile_app/footer');
        }

    }

    public function add_ambulance(){
        $isAmbulanceLogin = $this->session->isAmbulanceLogin;
        if(!isset($isAmbulanceLogin) || $isAmbulanceLogin != TRUE){
            return redirect()->to(site_url("/Mobile_app/Ambulance/login"));
        }
        else {
            $userId = $this->session->user_id;
            $data['image'] = get_data_by_id('photo','ambulance_users','ambulance_user_id',$userId);
            echo view('Mobile_app/header');
            echo view('Mobile_app/Ambulance/ambulance_add',$data);
            echo view('Mobile_app/footer');
        }
    }

    public function edit_ambulance($id){
        $isAmbulanceLogin = $this->session->isAmbulanceLogin;
        if(!isset($isAmbulanceLogin) || $isAmbulanceLogin != TRUE){
            return redirect()->to(site_url("/Mobile_app/Ambulance/login"));
        }
        else {
            $userId = $this->session->user_id;
            $data['ambulance'] = $this->ambulanceModel->where('amb_id',$id)->first();
            echo view('Mobile_app/header');
            echo view('Mobile_app/Ambulance/ambulance_edit',$data);
            echo view('Mobile_app/footer');
        }
    }

    public  function update_action(){
        $data['amb_id'] = $this->request->getPost('amb_id');
        $data['car_model_name'] = $this->request->getPost('car_model_name');
        $data['oxygen'] = $this->request->getPost('oxygen');
        $data['ac'] = $this->request->getPost('ac');
        $data['description'] = $this->request->getPost('description');


        //address update
        $division = $this->request->getPost('division');
        $zila = $this->request->getPost('zila');
        $upazila = $this->request->getPost('upazila');
        $where = ['division'=>$division,'zila'=>$zila,'upazila'=>$upazila,];
        $gloadd = $this->globaladdressModel->where($where);
        if ($gloadd->countAllResults() != 0) {
            $gloadd2 = $this->globaladdressModel->where($where);
            $add = $gloadd2->first()->global_address_id;
            $data['global_address_id'] = $add;
        }else{
            $this->session->setFlashdata('messageAddress', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Global address not found! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>');
        }


        //image upload
        if (!empty($_FILES['image']['name'])) {
            $image = $this->request->getFile('image');
            $name = $image->getRandomName();
            $image->move(FCPATH . '\assets\uplode\ambulance', $name);
            $data['image'] = $name;
        }



        if ($this->ambulanceModel->update($data['amb_id'],$data)) {
            $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">Update successful <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>');
            return redirect()->back();
        } else {
            $this->session->setFlashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Something went wrong! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>');
            return redirect()->back();
        }
    }


    public function create_action(){

        $userId = $this->session->user_id;
        $data['ambulance_user_id'] = $userId;
        $data['car_model_name'] = $this->request->getPost('car_model_name');
        $data['oxygen'] = $this->request->getPost('oxygen');
        $data['ac'] = $this->request->getPost('ac');
        $data['description'] = $this->request->getPost('description');

        //image upload
        if (!empty($_FILES['image']['name'])) {
            $image = $this->request->getFile('image');
            $name = $image->getRandomName();
            $image->move(FCPATH . '\assets\uplode\ambulance', $name);
            $data['image'] = $name;
        }

        if ($this->ambulanceModel->insert($data)) {
            $amb_id = $this->ambulanceModel->getInsertID();

            $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">Create successful <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>');
            return redirect()->to(site_url('/Mobile_app/Ambulance_dashboard/edit_ambulance/'.$amb_id));
        } else {
            $this->session->setFlashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Something went wrong! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>');
            return redirect()->back();
        }

    }

    public function profile(){
        $isAmbulanceLogin = $this->session->isAmbulanceLogin;
        if(!isset($isAmbulanceLogin) || $isAmbulanceLogin != TRUE){
            return redirect()->to(site_url("/Mobile_app/Ambulance/login"));
        }
        else {
            $userId = $this->session->user_id;
            $data['user'] = $this->ambulanceUserModel->where('ambulance_user_id',$userId)->first();
            echo view('Mobile_app/header');
            echo view('Mobile_app/Ambulance/profile',$data);
            echo view('Mobile_app/footer');
        }
    }

    public function profile_update_action(){
        $userId = $this->session->user_id;

        $data['ambulance_user_id'] = $userId;
        $data['name'] = $this->request->getPost('name');
        $data['mobile'] = $this->request->getPost('mobile');

        $this->validation->setRule('mobile', 'Phone', 'required');
        $this->validation->setRule('name', 'Name', 'required');
        if ($this->validation->withRequest($this->request)->run() == FALSE) {
            $this->session->setFlashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert"> Phone, Name input fields required!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>');
            return redirect()->back();
        }else {

            //image upload
            if (!empty($_FILES['photo']['name'])) {
                $image = $this->request->getFile('photo');
                $name = $image->getRandomName();
                $image->move(FCPATH . '\assets\uplode\ambulance_user', $name);
                $data['photo'] = $name;
            }

            $this->ambulanceUserModel->update($data['ambulance_user_id'],$data);
            $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"> Update successful <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>');
            return redirect()->back();

        }
    }

    public function delete($id){
        $this->ambulanceModel->where('amb_id', $id)->delete();
        $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"> Delete successful <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>');
        return redirect()->back();
    }





}