<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers\Web;

use App\Controllers\BaseController;

use App\Models\Hospital_admin\AdminModel;
use App\Libraries\Permission;
use App\Models\Super_admin\PatientModel;

class Login extends BaseController
{

    protected $adminModel;
    protected $validation;
    protected $session;
    protected $permission;
    protected $patientModel;

    public function __construct()
    {
        $this->adminModel = new AdminModel();
        $this->patientModel = new PatientModel();
        $this->validation =  \Config\Services::validation();
        $this->session = \Config\Services::session();
        $this->permission = new Permission();

    }

    public function index()
    {
        echo view('Web/header');
        echo view('Web/Login/login');
        echo view('Web/footer');

    }


    public function register(){
        echo view('Web/header');
        echo view('Web/Login/register');
        echo view('Web/footer');
    }



    public function login_action(){
        $this->validation->setRule('phone', 'Phone', 'required');
        $this->validation->setRule('password', 'Password', 'required');
        if ($this->validation->withRequest($this->request)->run() == FALSE) {
            $this->session->setFlashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">'.$this->validation->listErrors().'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>');
            return redirect()->back();
        }else{

            $mobile = $this->request->getPost('phone');
            $password = sha1($this->request->getPost('password'));
            $query = $this->patientModel->where('phone',$mobile)->where('password',$password)->countAllResults();
            if (!empty($query)){
                $result = $this->patientModel->where('phone',$mobile)->where('password',$password)->first();
                $sessionArray = array(
                    'Patient_user_id' => $result->pat_id,
                    'Patient_name' => $result->name,
                    'Patient_phone' => $result->phone,
                    'isPatientLoginWeb' => TRUE
                );
                $this->session->set($sessionArray);


                if (!empty($this->session->redirectUrl)){
                    return redirect()->to($this->session->redirectUrl);
                    unset($this->session->redirectUrl);
                }else{
                    return redirect()->to('/Web/Dashboard');
                }
            }else{
                $this->session->setFlashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert"> Input phone or password not match!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>');
                return redirect()->back();
            }
        }
    }


    public function register_action(){
        $data['name'] = $this->request->getPost('name');
        $data['phone'] = $this->request->getPost('phone');
        $data['password'] = sha1($this->request->getPost('password'));

        $this->validation->setRule('name', 'Name', 'required');
        $this->validation->setRule('phone', 'Phone', 'required|min_length[10]|max_length[11]');
        $this->validation->setRule('password', 'Password', 'required');

        if ($this->validation->withRequest($this->request)->run() == FALSE) {

            $this->session->setFlashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert"> '.$this->validation->listErrors().'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>');
            return redirect()->back();
        } else {


            if ($this->patientModel->insert($data)){

                $phone = $this->request->getPost('phone');
                $result = $this->patientModel->where('phone',$phone)->first();
                $sessionArray = array(
                    'Patient_user_id' => $result->pat_id,
                    'Patient_name' => $result->name,
                    'Patient_phone' => $result->phone,
                    'isPatientLoginWeb' => TRUE
                );
                $this->session->set($sessionArray);


                return redirect()->to('/Web/Dashboard');

            }else{
                $this->session->setFlashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert"> Something went wrong!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>');
                return redirect()->back();
            }

        }
    }

    public function logout()
    {
        unset($_SESSION['Patient_user_id']);
        unset($_SESSION['Patient_name']);
        unset($_SESSION['Patient_phone']);
        unset($_SESSION['isPatientLogin']);

        $this->session->destroy();
        return redirect()->to('/Web/Login');
    }



}