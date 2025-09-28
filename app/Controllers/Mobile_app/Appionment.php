<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers\Mobile_app;

use App\Controllers\BaseController;
use App\Models\Hospital_admin\AppointmentModel;
use App\Models\Hospital_admin\DocavailabledayModel;
use App\Models\Hospital_admin\SpecialistModel;
use App\Models\Mobile_app\GlobaladdressModel;
use App\Models\Mobile_app\HospitalModel;
use App\Models\Mobile_app\DoctorModel;
use App\Models\Super_admin\Indianappointment;
use App\Models\Super_admin\IndianhospitalModel;
use DateTime;


class Appionment extends BaseController
{

    protected $hospitalModel;
    protected $globaladdressModel;
    protected $doctorModel;
    protected $docavailabledayModel;
    protected $specialistModel;
    protected $session;
    protected $appointmentModel;
    protected $indianhospitalModel;
    protected $indianappointment;

    public function __construct()
    {
        $this->hospitalModel = new HospitalModel();
        $this->indianhospitalModel = new IndianhospitalModel();
        $this->globaladdressModel = new GlobaladdressModel();
        $this->doctorModel = new DoctorModel();
        $this->session = \Config\Services::session();
        $this->specialistModel = new SpecialistModel();
        $this->docavailabledayModel = new DocavailabledayModel();
        $this->appointmentModel = new AppointmentModel();
        $this->indianappointment = new Indianappointment();
    }

    public function index()
    {
        $_GET['tab'] = '';
        if ($this->session->isPatientLogin != true) {
            $redirectUrl = 'Mobile_app/appionment?tab=ind';
            newSession()->set("redirectUrl", $redirectUrl);
        }

        $data['inhospital']=$this->indianhospitalModel->findAll();
        echo view('Mobile_app/header');
        echo view('Mobile_app/Appionment/appionment_form',$data);
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
            $hosp->select('hospital.name as hospitalname,hospital.*,doctor.*');
            $hosp->join('doctor', 'doctor.h_id = hospital.h_id');
            $hosp->where('doctor.specialist_id', $specialist);
            $hosp->where('hospital.hospital_cat_id !=', 2);
            $hosp->where('hospital.status','1');
            $hosp->groupBy('hospital.h_id');
            $hospital = $hosp->where('hospital.global_address_id', $add)->get()->getResult();

        } else {
            $hospital = array();
        }
        $data['hospitalData'] = $hospital;
        $data['specialist'] = $specialist;

        echo view('Mobile_app/Appionment/diagnostic_list', $data);
    }

    private function diagonstic_center_with_location()
    {
        $division = empty($this->request->getPost('division')) ? '1=1' : array('global_address.division' => $this->request->getPost('division'));
        $district = empty($this->request->getPost('zila')) ? '1=1' : array('global_address.zila' => $this->request->getPost('zila'));
        $upazila = empty($this->request->getPost('upazila')) ? '1=1' : array('global_address.upazila' => $this->request->getPost('upazila'));


        $hospital = $this->globaladdressModel->join('hospital', 'hospital.global_address_id = global_address.global_address_id')->where('hospital.hospital_cat_id !=',2)->where('hospital.status','1')->where($division)->where($district)->where($upazila)->get()->getResult();

        $data['hospitalData'] = $hospital;

        echo view('Mobile_app/Appionment/diagnostic_center_list', $data);
    }

    public function diagnostic_center_list()
    {
        $specialist = $this->request->getPost('specialist');
        if (!empty($specialist)) {
            return $this->diagonstic_center_with_location_and_specialist();
        } else {
            return $this->diagonstic_center_with_location();
        }
    }

    public function doctor_specialties($id)
    {
        $spec = $this->doctorModel->where('h_id', $id)->findAll();
        $data['specialties'] = $spec;

        $data['hospital'] = $this->hospitalModel->where('h_id', $id)->first();

        echo view('Mobile_app/header');
        echo view('Mobile_app/Appionment/doctor_specialties', $data);
        echo view('Mobile_app/footer');
    }

    public function doctor_specialties_appointment($id, $specialistId)
    {
        $spec = $this->doctorModel->where('h_id', $id)->where('specialist_id', $specialistId)->findAll();
        $data['hospital'] = $this->hospitalModel->where('h_id', $id)->first();
        $data['specialties'] = $spec;
        echo view('Mobile_app/header');
        echo view('Mobile_app/Appionment/doctor_specialties', $data);
        echo view('Mobile_app/footer');
    }

    public function appionment_booking_form($id)
    {
        if ($this->session->isPatientLogin == true) {
            if (!empty($_SESSION['redirectUrl'])) { unset($_SESSION['redirectUrl']); }
            $spec = $this->doctorModel->where('doc_id', $id)->first();
            $data['specialties'] = $spec;

            $data['avilDay'] = $this->docavailabledayModel->where('doc_id', $id)->first();

            $h_id = get_data_by_id('h_id','doctor','doc_id',$id);

            $data['hospital'] = $this->hospitalModel->where('h_id', $h_id)->first();

            echo view('Mobile_app/header');
            echo view('Mobile_app/Appionment/appionment_booking_form', $data);
            echo view('Mobile_app/footer');
        } else {
            $redirectUrl = 'Mobile_app/appionment/appionment_booking_form/'.$id;
            $this->session->set("redirectUrl", $redirectUrl);
            return redirect()->to('/Mobile_app/Patient/login');
        }
    }

    public function appi_time()
    {
        $date = $this->request->getPost('day');
        $tim = strtotime($date);
        $day = strtolower(date('l', $tim));

        $docAvID = $this->request->getPost('docAvID');
        $avilDay = $this->docavailabledayModel->where('doc_avil_id', $docAvID)->first();

        $countMorning = appionment_count($avilDay->doc_id, $date, 'morning');
        $countEvening = appionment_count($avilDay->doc_id, $date, 'evening');

        $morApp = $avilDay->qty_in_morning - $countMorning;
        $eveApp = $avilDay->qty_in_evening - $countEvening;

        $view = '';
        if ($avilDay->$day == 'both') {
            if ($morApp != 0) {
                $view .= '<div class="form-group col-6">
                        <div class="custom-control custom-radio my-1 mr-sm-2">
                            <input type="radio" class="custom-control-input" name="time" id="morning" value="morning" >
                            <label class="custom-control-label" for="morning">Morning</label>
                        </div>
                        <span>Available (' . $morApp . ')</span><br>
                        <span><b>Time:</b> ' . $avilDay->morning_start_time . ' - ' . $avilDay->morning_end_time . '</span>
                    </div>';
            } else {
                $view .= '<div class="form-group col-6">Already booked!</div>';
            }
            if ($eveApp != 0) {
                $view .= '<div class="form-group col-6">
                        <div class="custom-control custom-radio my-1 mr-sm-2">
                            <input type="radio" class="custom-control-input" name="time" id="evening" value="evening">
                            <label class="custom-control-label" for="evening">Evening</label>
                        </div>
                        <span>Available (' . $eveApp . ')</span><br>
                        <span><b>Time:</b> ' . $avilDay->evening_start_time . ' - ' . $avilDay->evening_end_time . '</span>
                    </div>';
            } else {
                $view .= '<div class="form-group col-6">Already booked!</div>';
            }
        }

        if ($avilDay->$day == 'morning') {
            if ($morApp != 0) {
                $view .= '<div class="form-group col-6">
                        <div class="custom-control custom-radio my-1 mr-sm-2">
                            <input type="radio" class="custom-control-input" name="time" id="morning" value="morning" required>
                            <label class="custom-control-label" for="morning">Morning</label>
                        </div>
                        <span>Available (' . $morApp . ')</span><br>
                        <span><b>Time:</b> ' . $avilDay->morning_start_time . ' - ' . $avilDay->morning_end_time . '</span>
                    </div>';
            } else {
                $view .= '<div class="form-group col-6">Already booked!</div>';
            }
        }

        if ($avilDay->$day == 'evening') {
            if ($eveApp != 0) {
                $view .= '<div class="form-group col-6">
                        <div class="custom-control custom-radio my-1 mr-sm-2">
                            <input type="radio" class="custom-control-input" name="time" id="evening" value="evening" required>
                            <label class="custom-control-label" for="evening">Evening</label>
                        </div>
                        <span>Available (' . $eveApp . ')</span><br>
                        <span><b>Time:</b> ' . $avilDay->evening_start_time . ' - ' . $avilDay->evening_end_time . '</span>
                    </div>';
            } else {
                $view .= '<div class="form-group col-6">Already booked!</div>';
            }
        }

        print $view;

    }

    public function appi_date()
    {

        $m = $this->request->getPost('month');
        $y = $this->request->getPost('year');
        $docAvID = $this->request->getPost('docAvID');
        $avilDay = $this->docavailabledayModel->where('doc_avil_id', $docAvID)->first();
        $availablDayArray = array('Sat' => $avilDay->saturday, 'Sun' => $avilDay->sunday, 'Mon' => $avilDay->monday, 'Tue' => $avilDay->tuesday, 'Wed' => $avilDay->wednesday, 'Thu' => $avilDay->thursday, 'Fri' => $avilDay->friday);
        if (date('Y-m') >= $y . '-' . $m) {
            $today = date('Y-m-d');
        } else {
            $today = $y . '-' . $m . '-01';
        }
        $view = '<option value="">Date select</option>';
        $last = date("Y-m-t", strtotime($today));
        $date1 = new DateTime($today);
        $date2 = new DateTime($last);
        $totalDay = $date2->diff($date1)->format('%a');
        for ($i = 0; $i < $totalDay; $i++) {
            $date = date('Y-m-d', strtotime($today . ' +' . $i . ' day'));
            $tim = strtotime($date);
            $day = date('D', $tim);
            if ($availablDayArray[$day] != NULL) {
                $view .= '<option value="' . $date . '" >' . $date . '(' . $day . ')</option>';
            }
        }

        print $view;
    }


    public function appinoment_action()
    {
        $tim = strtotime($this->request->getPost('date'));
        $day = strtolower(date('l', $tim));
        $hId = get_data_by_id('h_id', 'doctor', 'doc_id', $this->request->getPost('doc_id'));

        $countapp = appionment_count_insert($this->request->getPost('doc_id'), $this->request->getPost('date'), $this->request->getPost('time'));


        $serial = $countapp + 1;

        $data['doc_id'] = $this->request->getPost('doc_id');
        $data['pat_id'] = $this->session->Patient_user_id;
        $data['day'] = $day;
        $data['time'] = $this->request->getPost('time');
        $data['date'] = $this->request->getPost('date');
        $data['name'] = $this->request->getPost('name');
        $data['phone'] = $this->request->getPost('phone');
        $data['serial_number'] = $serial;
        $data['h_id'] = $hId;


        if ($this->appointmentModel->insert($data)) {
            $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"> Your appionment is successfully booked.<br>Your Serial No: <b>'. $serial .'</b> at <b>'.$this->request->getPost('time').' </b> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>');
        }else{
            $this->session->setFlashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert"> Something went wrong!  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>');
        }
        return redirect()->back();
    }


    public function appionment_success()
    {
        echo view('Mobile_app/header');
        echo view('Mobile_app/Appionment/appionment_success');
        echo view('Mobile_app/footer');
    }

    public function indian(){
        echo view('Mobile_app/header');
        echo view('Mobile_app/Appionment/indian_form');
        echo view('Mobile_app/footer');
    }

    public function indian_appionment_action(){

        $data['pat_id'] = $this->session->Patient_user_id;
        $data['name'] = $this->request->getPost('name');
        $data['phone'] = $this->request->getPost('phone');
        $data['ind_h_id'] = $this->request->getPost('inHospital');
        $data['ind_hos_bran_id'] = $this->request->getPost('hos_branch');

        if ($this->indianappointment->insert($data)){

            return redirect()->to(site_url('/mobile_app/appionment/success'));

        }else{
            $this->session->setFlashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert"> Something went wrong!  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>');
            return redirect()->back();
        }

    }

    public function success(){
        echo view('Mobile_app/header');
        echo view('Mobile_app/Appionment/ind_success');
        echo view('Mobile_app/footer');
    }



}