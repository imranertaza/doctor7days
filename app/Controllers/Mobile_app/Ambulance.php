<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers\Mobile_app;
use App\Models\Hospital_admin\AmbulanceModel;
use App\Models\Hospital_admin\GlobaladdressModel;
use App\Controllers\BaseController;


class Ambulance extends BaseController
{

    protected $ambulanceModel;
    protected $globaladdressModel;
    protected $session;

    public function __construct(){
        $this->ambulanceModel = new AmbulanceModel();
        $this->globaladdressModel = new GlobaladdressModel();
        $this->pager = \Config\Services::pager();
        $this->session = \Config\Services::session();
    }

    public function index()
    {
        $amb = $this->ambulanceModel->paginate(10);
        $data['ambulance'] = $amb;
        $data['pager'] = $this->ambulanceModel->pager;

        echo view('Mobile_app/header');
        echo view('Mobile_app/Ambulance/ambulance',$data);
        echo view('Mobile_app/footer');

    }

    public function ambulance_select(){

        echo view('Mobile_app/header');
        echo view('Mobile_app/Ambulance/ambulance_select');
        echo view('Mobile_app/footer');
    }

    public function search(){
        $division = $this->request->getPost('division');
        $zila = $this->request->getPost('zila');
        $upazila = $this->request->getPost('upazila');

        $where = ['division'=>$division,'zila'=>$zila,'upazila'=>$upazila,];

        $gloadd = $this->globaladdressModel->where($where);
        if ($gloadd->countAllResults() != 0) {
            $add = $gloadd->first()->global_address_id;
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



}