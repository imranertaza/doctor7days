<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers\Web;

use App\Controllers\BaseController;


use App\Libraries\Permission;
use App\Models\Hospital_admin\MessageModel;
use App\Models\Hospital_admin\MessageToModel;

class Inbox extends BaseController
{

    protected $adminModel;
    protected $validation;
    protected $session;
    protected $permission;
    protected $patientModel;
    protected $globaladdressModel;

    public function __construct()
    {
        $this->messageModel = new MessageModel();
        $this->messageToModel = new MessageToModel();
        $this->validation = \Config\Services::validation();
        $this->session = \Config\Services::session();
        $this->permission = new Permission();
        $this->crop = \Config\Services::image();

    }

    public function index()
    {
        if (!empty($this->session->isPatientLoginWeb) || $this->session->isPatientLoginWeb == TRUE) {
            $userId = $this->session->Patient_user_id;
            $data['inbox'] = $this->messageModel->where('for_patient !=',null)->findAll();

            $data['sidebar'] =  view('Web/sidebar');
            echo view('Web/header');
            echo view('Web/Inbox/index', $data);
            echo view('Web/footer');
        } else {
            return redirect()->to(site_url('Web/Login'));
        }

    }
    public function view($id){
        if (!empty($this->session->isPatientLoginWeb) || $this->session->isPatientLoginWeb == TRUE) {
            $pat_id = $this->session->Patient_user_id;
            $mas_to = $this->messageToModel->where('message_id',$id)->where('to_patient_id',$pat_id)->countAllResults();

            if(empty($mas_to)){
                $masData = [
                    'message_id' => $id,
                    'to_patient_id' => $pat_id,
                    'msg_read' => '1',
                ];
                $this->messageToModel->insert($masData);
            }else{
                $masSpecData = [
                    'msg_read' => '1',
                ];
                $masTo = DB()->table('message_to');
                $masTo->where('message_id',$id)->where('to_patient_id',$pat_id)->update($masSpecData);
            }

            $data['inbox'] = $this->messageModel->where('message_id',$id)->first();

            $data['sidebar'] =  view('Web/sidebar');
            echo view('Web/header');
            echo view('Web/Inbox/view', $data);
            echo view('Web/footer');
        } else {
            return redirect()->to(site_url('Web/Login'));
        }
    }



}