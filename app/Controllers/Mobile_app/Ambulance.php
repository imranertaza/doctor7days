<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers\Mobile_app;
use App\Models\Mobile_app\AmbulanceModel;
use App\Models\Mobile_app\AmbulanceUserModel;
use App\Models\Mobile_app\GlobaladdressModel;
use App\Controllers\BaseController;


class Ambulance extends BaseController
{

    protected $ambulanceModel;
    protected $ambulanceUserModel;
    protected $globaladdressModel;
    protected $validation;
    protected $session;

    public function __construct(){
        $this->ambulanceModel = new AmbulanceModel();
        $this->ambulanceUserModel = new AmbulanceUserModel();
        $this->globaladdressModel = new GlobaladdressModel();
        $this->pager = \Config\Services::pager();
        $this->session = \Config\Services::session();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $amb = $this->ambulanceModel->paginate(10);
        $data['ambulance'] = $amb;
        $data['pager'] = $this->ambulanceModel->pager;
        $data['count'] = $this->ambulanceModel->countAll();

        echo view('Mobile_app/header');
        echo view('Mobile_app/Ambulance/ambulance',$data);
        echo view('Mobile_app/footer');

    }

    public function ambulance_select(){

        echo view('Mobile_app/header');
        echo view('Mobile_app/Ambulance/ambulance_select');
        echo view('Mobile_app/footer');
    }

    public function ambulance_details($id){
        $data['ambulance'] = $this->ambulanceModel->where('amb_id',$id)->first();

        echo view('Mobile_app/header');
        echo view('Mobile_app/Ambulance/ambulance_detail',$data);
        echo view('Mobile_app/footer');
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

        echo view('Mobile_app/header');
        echo view('Mobile_app/Ambulance/ambulance_result',$data);
        echo view('Mobile_app/footer');
    }

    public function register()
    {
        if(!empty($this->session->isAmbulanceLogin) || $this->session->isAmbulanceLogin == TRUE){
            return redirect()->to(site_url('Mobile_app/Ambulance_dashboard/'));
        }
        echo view('Mobile_app/header');
        echo view('Mobile_app/Ambulance/register');
        echo view('Mobile_app/footer');

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
                    'isAmbulanceLogin' => TRUE
                );
                $this->session->set($sessionArray);

                return redirect()->to(site_url("/Mobile_app/Ambulance_dashboard"));

            }else{
                $this->session->setFlashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert"> Input phone or password not match!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>');
                return redirect()->back();
            }
        }
    }


    public function reg_action(){

        $data['name'] = $this->request->getPost('contact_name');
        $data['mobile'] = $this->request->getPost('mobile');
        $data['password'] = sha1($this->request->getPost('password'));

        $this->validation->setRule('contact_name', 'Name', 'required');
        $this->validation->setRule('mobile', 'Phone', 'required');
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
                    'isAmbulanceLogin' => TRUE
                );
                $this->session->set($sessionArray);
                return redirect()->to(site_url("/Mobile_app/Ambulance_dashboard/register_success"));
            }else{
                $this->session->setFlashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert"> Something went wrong!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>');
                return redirect()->back();
            }

        }
    }

    public function login(){

        if(!empty($this->session->isAmbulanceLogin) || $this->session->isAmbulanceLogin == TRUE){
            return redirect()->to(site_url('Mobile_app/Ambulance_dashboard/'));
        }
        echo view('Mobile_app/header');
        echo view('Mobile_app/Ambulance/login');
        echo view('Mobile_app/footer');
    }

    function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['name']);
        unset($_SESSION['phone']);
        unset($_SESSION['isAmbulanceLogin']);

        $this->session->destroy();
        return redirect()->to('/Mobile_app');
    }



}