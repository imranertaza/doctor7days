<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers\Mobile_app;

use App\Controllers\BaseController;
use App\Models\Hospital_admin\SpecialistModel;
use App\Models\Mobile_app\GlobaladdressModel;
use App\Models\Mobile_app\HospitalModel;
use App\Models\Mobile_app\DoctorModel;

class Appionment extends BaseController
{

    protected $hospitalModel;
    protected $globaladdressModel;
    protected $doctorModel;
    protected $specialistModel;
    protected $session;

    public function __construct()
    {
        $this->hospitalModel = new HospitalModel();
        $this->globaladdressModel = new GlobaladdressModel();
        $this->doctorModel = new DoctorModel();
        $this->session = \Config\Services::session();
        $this->specialistModel = new SpecialistModel();
    }

    public function index()
    {

        echo view('Mobile_app/header');
        echo view('Mobile_app/Appionment/appionment_form');
        echo view('Mobile_app/footer');

    }

    private function diagonstic_center_with_location_and_specialist()
    {
        $division = $this->request->getPost('division');
        $zila = $this->request->getPost('zila');
        $upazila = $this->request->getPost('upazila');
        $specialist = $this->request->getPost('specialist');


        $where = ['division' => $division, 'zila' => $zila, 'upazila' => $upazila,];

        $gloadd = $this->globaladdressModel->where($where);

        if ($gloadd->countAllResults() != 0) {
            $gloaddre = $this->globaladdressModel->where($where);
            $add = $gloaddre->first()->global_address_id;

            $hosp = DB()->table('hospital');
            $hosp->select('hospital.name as hospitalname,hospital.*,doctor.*' );
            $hosp->join('doctor', 'doctor.h_id = hospital.h_id');
            $hosp->where('doctor.specialist_id', $specialist);
            $hosp->groupBy('hospital.h_id');
            $hospital = $hosp->where('hospital.global_address_id', $add)->get()->getResult();




        } else {
            $hospital = array();
            $this->session->setFlashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Hospital not found this Address! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>');
            return redirect()->back();
        }
        $data['hospitalData'] = $hospital;
        $data['specialist'] = $specialist;

        echo view('Mobile_app/header');
        echo view('Mobile_app/Appionment/diagnostic_list', $data);
        echo view('Mobile_app/footer');
    }

    private function diagonstic_center_with_location()
    {
        $division = $this->request->getPost('division');
        $zila = $this->request->getPost('zila');
        $upazila = $this->request->getPost('upazila');

        $where = ['division' => $division, 'zila' => $zila, 'upazila' => $upazila,];

        $gloadd = $this->globaladdressModel->where($where);

        if ($gloadd->countAllResults() != 0) {
            $gloaddre = $this->globaladdressModel->where($where);
            $add = $gloaddre->first()->global_address_id;

            $hospital = $this->hospitalModel->where('global_address_id', $add)->findAll();
        } else {
            $hospital = array();
            $this->session->setFlashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Hospital not found this Address! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>');
            return redirect()->back();
        }
        $data['hospitalData'] = $hospital;

        echo view('Mobile_app/header');
        echo view('Mobile_app/Appionment/diagnostic_center_list', $data);
        echo view('Mobile_app/footer');
    }

    public function diagnostic_center_list()
    {
        $specialist = $this->request->getPost('specialist');
        if (!empty($specialist)) {
            return $this->diagonstic_center_with_location_and_specialist();
        }else {
            return $this->diagonstic_center_with_location();
        }
    }

    public function doctor_specialties($id)
    {
        $spec = $this->doctorModel->where('h_id', $id)->findAll();


        $data['specialties'] = $spec;
        echo view('Mobile_app/header');
        echo view('Mobile_app/Appionment/doctor_specialties', $data);
        echo view('Mobile_app/footer');
    }

    public function doctor_specialties_appointment($id, $specialistId)
    {
        $spec = $this->doctorModel->where('h_id', $id)->where('specialist_id', $specialistId)->findAll();

        $data['specialties'] = $spec;
        echo view('Mobile_app/header');
        echo view('Mobile_app/Appionment/doctor_specialties', $data);
        echo view('Mobile_app/footer');
    }

    public function appionment_booking_form($id)
    {
        $spec = $this->doctorModel->where('doc_id', $id)->first();
        $data['specialties'] = $spec;
        echo view('Mobile_app/header');
        echo view('Mobile_app/Appionment/appionment_booking_form', $data);
        echo view('Mobile_app/footer');
    }

    public function appionment_success()
    {
        echo view('Mobile_app/header');
        echo view('Mobile_app/Appionment/appionment_success');
        echo view('Mobile_app/footer');
    }


}