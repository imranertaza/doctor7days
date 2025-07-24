<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers\Super_admin;

use App\Controllers\BaseController;

use App\Models\Hospital_admin\AppointmentModel;
use App\Libraries\Permission;
use App\Models\Super_admin\GlobaladdressModel;

class Appointment extends BaseController
{
	
    protected $appointmentModel;
    protected $globaladdressModel;

    protected $validation;
    protected $crop;
    protected $session;
    protected $permission;
    protected $permission_hospital;
    private $module_name = 'Hospital';
	
	public function __construct()
	{
	    $this->appointmentModel = new AppointmentModel();
	    $this->globaladdressModel = new GlobaladdressModel();
       	$this->validation =  \Config\Services::validation();
        $this->session = \Config\Services::session();
        $this->permission = new Permission();
        $this->crop = \Config\Services::image();
	}
	
	public function index()
	{
        $isLoggedIAdmin = $this->session->isLoggedIAdmin;
        $role_id = $this->session->AdminRole;
        if (isset($isLoggedIAdmin)) {

            $data = [
                    'controller'    	=> 'Super_admin/Appointment',
                    'title'     		=> 'Appointment',
            ];

            $perm = $this->permission->module_permission_list($role_id, $this->module_name);
            foreach($perm as $key=>$val){
                 $data[$key] = $this->permission->have_access($role_id, $this->module_name, $key);
            }

            echo view('Super_admin/header');
            echo view('Super_admin/sidebar');
            if ($data['mod_access'] == 1) {
                echo view('Super_admin/Appointment/index', $data);
            } else {
                echo view('Super_admin/No_permission', $data);
            }
            echo view('Super_admin/footer');

        }else {
            return redirect()->to(site_url("/super_admin/login"));
        }
			
	}

	public function getAll()
	{
        $response = array();

        $data['data'] = array();
        $result = $this->appointmentModel->select('appointment_id, doc_id, pat_id, day, time, date, name, phone, serial_number, status')->findAll();

        foreach ($result as $key => $value) {


            $ch = ($value->status == 1)?'checked':'';
            $val = ($value->status == 1)?'0':'1';

            $data['data'][$key] = array(
                $value->appointment_id,
                get_data_by_id('name','doctor','doc_id',$value->doc_id),
                $value->pat_id,
                $value->day,
                $value->time,
                globalDateFormat($value->date),
                $value->name,
                $value->phone,
                $value->serial_number,
            );
        }

        return $this->response->setJSON($data);
    }

    public function appointment_search(){
        $isLoggedIAdmin = $this->session->isLoggedIAdmin;
        $role_id = $this->session->AdminRole;
        if (isset($isLoggedIAdmin)) {
            $division = empty($this->request->getPost('division')) ? '1=1' : array('global_address.division' => $this->request->getPost('division'));
            $district = empty($this->request->getPost('zila')) ? '1=1' : array('global_address.zila' => $this->request->getPost('zila'));
            $upazila = empty($this->request->getPost('upazila')) ? '1=1' : array('global_address.upazila' => $this->request->getPost('upazila'));


            $appointment = $this->globaladdressModel->join('hospital', 'hospital.global_address_id = global_address.global_address_id')->join('appointment', 'appointment.h_id = hospital.h_id')->where('hospital.hospital_cat_id !=',2)->where('hospital.status','1')->where($division)->where($district)->where($upazila)->get()->getResult();


            $data['appointment'] = $appointment;

            echo view('Super_admin/header');
            echo view('Super_admin/sidebar');
            echo view('Super_admin/Appointment/search', $data);
            echo view('Super_admin/footer');
        }else {
            return redirect()->to(site_url("/super_admin/login"));
        }
    }


}	