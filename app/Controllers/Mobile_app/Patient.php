<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers\Mobile_app;

use App\Models\Hospital_admin\AppointmentModel;
use App\Models\Mobile_app\GlobaladdressModel;
use App\Controllers\BaseController;
use App\Models\Super_admin\PatientModel;


class Patient extends BaseController
{

    protected $patientModel;
    protected $globaladdressModel;
    protected $appointmentModel;
    protected $validation;
    protected $crop;
    protected $session;

    public function __construct(){
        $this->patientModel = new PatientModel();
        $this->appointmentModel = new AppointmentModel();
        $this->globaladdressModel = new GlobaladdressModel();
        $this->session = \Config\Services::session();
        $this->validation = \Config\Services::validation();
        $this->crop = \Config\Services::image();
    }

    public function index(){
//        $this->login();
    }

    public function dashboard(){
        if(!empty($this->session->isPatientLogin) || $this->session->isPatientLogin == TRUE){

            $userId = $this->session->Patient_user_id;
            $data['patient'] = $this->patientModel->where('pat_id',$userId)->first();

            $data['appointment'] = $this->appointmentModel->where('status','1')->where('pat_id',$userId)->findAll();

            echo view('Mobile_app/header');
            echo view('Mobile_app/Patient/dashboard',$data);
            echo view('Mobile_app/footer');
        }else{
            return redirect()->to(site_url('Mobile_app/Patient/login'));
        }
    }

    public function profile(){
        if(!empty($this->session->isPatientLogin) || $this->session->isPatientLogin == TRUE){

            $userId = $this->session->Patient_user_id;
            $data['patient'] = $this->patientModel->where('pat_id',$userId)->first();

            echo view('Mobile_app/header');
            echo view('Mobile_app/Patient/profile',$data);
            echo view('Mobile_app/footer');
        }else{
            return redirect()->to(site_url('Mobile_app/Patient/login'));
        }
    }

    public function view($id){
        if(!empty($this->session->isPatientLogin) || $this->session->isPatientLogin == TRUE){

            $userId = $this->session->Patient_user_id;
            $data['appointment'] = $this->appointmentModel->where('appointment_id',$id)->first();

            echo view('Mobile_app/header');
            echo view('Mobile_app/Patient/view',$data);
            echo view('Mobile_app/footer');
        }else{
            return redirect()->to(site_url('Mobile_app/Patient/login'));
        }
    }

    public function cancel($id){
        $data['appointment_id'] = $id;
        $data['status'] = '0';

        $this->appointmentModel->update($data['appointment_id'],$data);
        $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"> Cancel successful.. <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>');
        return redirect()->back();
    }

    public function update_action(){
        $userId = $this->session->Patient_user_id;

        $pass = $this->request->getPost('password');
        $data['pat_id'] = $userId;
        $data['name'] = $this->request->getPost('name');
        $data['phone'] = $this->request->getPost('phone');
        $data['email'] = $this->request->getPost('email');
        $data['nid'] = $this->request->getPost('nid');
        $data['age'] = $this->request->getPost('age');

        if (!empty($pass)) {
            $data['password'] = sha1($pass);
        }

        if (!empty($_FILES['photo']['name'])) {
            $target_dir = FCPATH . '/assets/upload/patient/'.$userId.'/';
            if(!file_exists($target_dir)){
                mkdir($target_dir,0655);
            }

            $photo = $this->request->getFile('photo');
            $name = $photo->getRandomName();
            $photo->move($target_dir, $name);

            $lo_nameimg = 'pa_'.$photo->getName();
            $this->crop->withFile($target_dir.''.$name)->fit(100, 100, 'center')->save($target_dir.''.$lo_nameimg);
            unlink($target_dir.''.$name);

            $data['photo'] = $lo_nameimg;
        }


        $division = $this->request->getPost('division');
        $zila = $this->request->getPost('zila');
        $upazila = $this->request->getPost('upazila');
        $where = [ 'division' => $division, 'zila' => $zila, 'upazila' => $upazila ];
        $gloadd = $this->globaladdressModel->where($where);
        if ($gloadd->countAllResults() != 0){
            $glo = $this->globaladdressModel->where($where);
            $data['global_address_id'] = $glo->first()->global_address_id;
        }



        if ($this->patientModel->update($data['pat_id'],$data)){
            $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"> update successful.. <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>');
            return redirect()->back();
        }else{
            $this->session->setFlashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert"> Something went wrong!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>');
            return redirect()->back();
        }


    }

    public function register()
    {
        if(!empty($this->session->isPatientLogin) || $this->session->isPatientLogin == TRUE){
            return redirect()->to(site_url('login'));
        }
        echo view('Mobile_app/header');
        echo view('Mobile_app/Register/register');
        echo view('Mobile_app/footer');

    }

    public function reg_action(){

        $data['name'] = $this->request->getPost('name');
        $data['phone'] = $this->request->getPost('phone');
        $data['password'] = sha1($this->request->getPost('password'));

        $this->validation->setRule('name', 'Name', 'required');
        $this->validation->setRule('phone', 'Phone', 'required');
        $this->validation->setRule('password', 'Password', 'required');

        if ($this->validation->withRequest($this->request)->run() == FALSE) {

            $this->session->setFlashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert"> Please input all required fields<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
//                    'Patient_image' => $result->phone,
                    'isPatientLogin' => TRUE
                );
                $this->session->set($sessionArray);
                return redirect()->to('/Mobile_app');

            }else{
                $this->session->setFlashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert"> Something went wrong!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>');
                return redirect()->back();
            }

        }
    }

    public function login(){

        if(!empty($this->session->isPatientLogin) || $this->session->isPatientLogin == TRUE){
            return redirect()->to(site_url('Mobile_app'));
        }
        echo view('Mobile_app/header');
        echo view('Mobile_app/Login/login');
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
            $query = $this->patientModel->where('phone',$mobile)->where('password',$password)->countAllResults();
            if (!empty($query)){
                $result = $this->patientModel->where('phone',$mobile)->where('password',$password)->first();
                $sessionArray = array(
                    'Patient_user_id' => $result->pat_id,
                    'Patient_name' => $result->name,
                    'Patient_phone' => $result->phone,
                    'isPatientLogin' => TRUE
                );
                $this->session->set($sessionArray);

                if (!empty($this->session->redirectUrl)){
                    return redirect()->to($this->session->redirectUrl);
                    unset($this->session->redirectUrl);
                }else {
                    return redirect()->to('/Mobile_app');
                }
            }else{
                $this->session->setFlashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert"> Input phone or password not match!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>');
                return redirect()->back();
            }
        }
    }

    function logout()
    {
        unset($_SESSION['Patient_user_id']);
        unset($_SESSION['Patient_name']);
        unset($_SESSION['Patient_phone']);
        unset($_SESSION['isPatientLogin']);

        $this->session->destroy();
        return redirect()->to('/Mobile_app');
    }



}