<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers\Web;

use App\Controllers\BaseController;

use App\Models\Hospital_admin\AdminModel;
use App\Libraries\Permission;
use App\Models\Mobile_app\AmbulanceModel;
use App\Models\Mobile_app\AmbulanceUserModel;
use App\Models\Mobile_app\GlobaladdressModel;

class Ambulance extends BaseController
{

    protected $adminModel;
    protected $validation;
    protected $session;
    protected $permission;
    protected $ambulanceModel;
    protected $globaladdressModel;
    protected $ambulanceUserModel;

    public function __construct()
    {
        $this->adminModel = new AdminModel();
        $this->ambulanceModel = new AmbulanceModel();
        $this->globaladdressModel = new GlobaladdressModel();
        $this->ambulanceUserModel = new AmbulanceUserModel();
        $this->validation =  \Config\Services::validation();
        $this->session = \Config\Services::session();
        $this->permission = new Permission();

    }

    public function index()
    {
        $amb = $this->ambulanceModel->paginate(10);
        $data['ambulance'] = $amb;
        $data['pager'] = $this->ambulanceModel->pager;
        $data['count'] = $this->ambulanceModel->countAll();


        echo view('Web/header');
        echo view('Web/Ambulance/index', $data);
        echo view('Web/footer');

    }
    public function ambulance_details($id){

        $data['ambulance'] = $this->ambulanceModel->where('amb_id',$id)->first();

        echo view('Web/header');
        echo view('Web/Ambulance/details', $data);
        echo view('Web/footer');
    }

    public function search_location(){
        echo view('Web/header');
        echo view('Web/Ambulance/search_location');
        echo view('Web/footer');
    }

    public function search(){
        $division = $this->request->getPost('division');
        $zila = $this->request->getPost('zila');
        $upazila = $this->request->getPost('upazila');

        $where = ['division'=>$division,'zila'=>$zila,'upazila'=>$upazila,];

        $gloadd = $this->globaladdressModel->where($where);
        if ($gloadd->countAllResults() != 0) {
            $gloadd2 = $this->globaladdressModel->where($where);
            $add = $gloadd2->first()->global_address_id;
            $ambulance = $this->ambulanceModel->where('global_address_id',$add)->findAll();
        }else{
            $ambulance = array();
            $this->session->setFlashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Ambulance not found this Address! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>');
            return redirect()->back();
        }
        $data['ambulanceData'] = $ambulance;

        echo view('Web/header');
        echo view('Web/Ambulance/result',$data);
        echo view('Web/footer');
    }

    public function login(){
        echo view('Web/header');
        echo view('Web/Ambulance/login');
        echo view('Web/footer');
    }

    public function login_action(){
        $this->validation->setRule('phone', 'Phone', 'required');
        $this->validation->setRule('password', 'Password', 'required');
        if ($this->validation->withRequest($this->request)->run() == FALSE) {
            $this->session->setFlashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert"> Input phone or password not match!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>');
            return redirect()->back();
        }else{

            $mobile = $this->request->getPost('phone');
            $password = sha1($this->request->getPost('password'));
            $query = $this->ambulanceUserModel->where('mobile',$mobile)->where('password',$password)->countAllResults();
            if (!empty($query)){
                $result = $this->ambulanceUserModel->where('mobile',$mobile)->where('password',$password)->first();
                $sessionArray = array(
                    'user_id' => $result->ambulance_user_id,
                    'name' => $result->name,
                    'phone' => $result->mobile,
                    'isAmbulanceLoginWeb' => TRUE
                );
                $this->session->set($sessionArray);

                return redirect()->to(site_url("/Web/Ambulance/dashboard"));

            }else{
                $this->session->setFlashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert"> Input phone or password not match!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>');
                return redirect()->back();
            }
        }
    }

    public function dashboard(){
        $isAmbulanceLoginWeb = $this->session->isAmbulanceLoginWeb;
        if(!isset($isAmbulanceLoginWeb) || $isAmbulanceLoginWeb != TRUE){
            return redirect()->to(site_url("/Mobile_app/Ambulance/login"));
        }
        else {
            $userId = $this->session->user_id;
            $data['ambulance'] = $this->ambulanceModel->where('ambulance_user_id',$userId)->findAll();
            $data['image'] = get_data_by_id('photo','ambulance_users','ambulance_user_id',$userId);

            $data['sidebar'] =  view('Web/ambulance_sidebar');
            echo view('Web/header');
            echo view('Web/Ambulance/dashboard',$data);
            echo view('Web/footer');
        }
    }



    public function register(){
        echo view('Web/header');
        echo view('Web/Ambulance/register');
        echo view('Web/footer');
    }

    public function register_action(){
        $data['name'] = $this->request->getPost('contact_name');
        $data['mobile'] = $this->request->getPost('mobile');
        $data['password'] = sha1($this->request->getPost('password'));

        $this->validation->setRule('contact_name', 'Name', 'required');
        $this->validation->setRule('mobile', 'Phone', 'required|min_length[10]|max_length[11]');
        $this->validation->setRule('password', 'Password', 'required');

        if ($this->validation->withRequest($this->request)->run() == FALSE) {

            $this->session->setFlashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert"> Please input all required fields<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>');
            return redirect()->back();
        } else {

            if ($this->ambulanceUserModel->insert($data)){
                $mobile = $this->request->getPost('mobile');
                $result = $this->ambulanceUserModel->where('mobile',$mobile)->first();
                $sessionArray = array(
                    'user_id' => $result->ambulance_user_id,
                    'name' => $result->name,
                    'phone' => $result->mobile,
                    'isAmbulanceLoginWeb' => TRUE
                );
                $this->session->set($sessionArray);
                return redirect()->to(site_url("/Web/Ambulance/dashboard"));
            }else{
                $this->session->setFlashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert"> Something went wrong!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>');
                return redirect()->back();
            }

        }
    }

    public function logout(){
        unset($_SESSION['user_id']);
        unset($_SESSION['name']);
        unset($_SESSION['phone']);
        unset($_SESSION['isAmbulanceLoginWeb']);

        $this->session->destroy();
        return redirect()->to('/');
    }



    public function create(){
        $isAmbulanceLoginWeb = $this->session->isAmbulanceLoginWeb;
        if(!isset($isAmbulanceLoginWeb) || $isAmbulanceLoginWeb != TRUE){
            return redirect()->to(site_url("/Mobile_app/Ambulance/login"));
        }else {

            $data['sidebar'] =  view('Web/ambulance_sidebar');
            echo view('Web/header');
            echo view('Web/Ambulance/add',$data);
            echo view('Web/footer');

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
            $target_dir = FCPATH . 'assets/upload/ambulance/'.$userId.'/';
            if(!file_exists($target_dir)){
                mkdir($target_dir,0777);
            }

            $image = $this->request->getFile('image');
            $name = $image->getRandomName();
            $image->move($target_dir, $name);
            $lo_nameimg = 'am_'.$image->getName();
            $this->crop->withFile($target_dir.''.$name)->fit(150, 145, 'center')->save($target_dir.''.$lo_nameimg);
            unlink($target_dir.''.$name);

            $data['image'] = $lo_nameimg;
        }

        if ($this->ambulanceModel->insert($data)) {
            $amb_id = $this->ambulanceModel->getInsertID();

            $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">Create successful <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>');
            return redirect()->to(site_url('/Web/Ambulance/edit_ambulance/'.$amb_id));
        } else {
            $this->session->setFlashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Something went wrong! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>');
            return redirect()->back();
        }
    }

    public function edit_ambulance($id){
        $isAmbulanceLoginWeb = $this->session->isAmbulanceLoginWeb;
        if(!isset($isAmbulanceLoginWeb) || $isAmbulanceLoginWeb != TRUE){
            return redirect()->to(site_url("/Mobile_app/Ambulance/login"));
        }else {

            $userId = $this->session->user_id;
            $data['ambulance'] = $this->ambulanceModel->where('amb_id',$id)->first();

            $data['sidebar'] =  view('Web/ambulance_sidebar');
            echo view('Web/header');
            echo view('Web/Ambulance/edit',$data);
            echo view('Web/footer');

        }
    }

    public function update_action(){
        $userId = $this->session->user_id;
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

            $target_dir = FCPATH . 'assets/upload/ambulance/'.$userId.'/';
            if(!file_exists($target_dir)){
                mkdir($target_dir,0777);
            }

            $image = $this->request->getFile('image');
            $name = $image->getRandomName();
            $image->move($target_dir, $name);
            $lo_nameimg = 'am_'.$image->getName();
            $this->crop->withFile($target_dir.''.$name)->fit(150, 145, 'center')->save($target_dir.''.$lo_nameimg);
            unlink($target_dir.''.$name);

            $data['image'] = $lo_nameimg;
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

    public function delete($id){
        $this->ambulanceModel->where('amb_id', $id)->delete();
        $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"> Delete successful <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>');
        return redirect()->back();
    }

    public function profile(){
        $isAmbulanceLoginWeb = $this->session->isAmbulanceLoginWeb;
        if(!isset($isAmbulanceLoginWeb) || $isAmbulanceLoginWeb != TRUE){
            return redirect()->to(site_url("/Mobile_app/Ambulance/login"));
        }else {

            $userId = $this->session->user_id;
            $data['user'] = $this->ambulanceUserModel->find($userId);

            $data['sidebar'] =  view('Web/ambulance_sidebar');
            echo view('Web/header');
            echo view('Web/Ambulance/profile',$data);
            echo view('Web/footer');

        }
    }

    public function profile_action(){
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

                $target_dir = FCPATH . 'assets/upload/ambulance/'.$userId.'/';
                if(!file_exists($target_dir)){
                    mkdir($target_dir,0777);
                }

                $image = $this->request->getFile('photo');
                $name = $image->getRandomName();
                $image->move($target_dir, $name);
                $lo_nameimg = 'am_'.$image->getName();
                $this->crop->withFile($target_dir.''.$name)->fit(150, 145, 'center')->save($target_dir.''.$lo_nameimg);
                unlink($target_dir.''.$name);

                $data['photo'] = $lo_nameimg;
            }

            $this->ambulanceUserModel->update($data['ambulance_user_id'],$data);
            $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"> Update successful <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>');
            return redirect()->back();

        }
    }






}