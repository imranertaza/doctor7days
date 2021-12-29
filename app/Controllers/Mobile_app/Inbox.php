<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers\Mobile_app;

use App\Controllers\BaseController;
use App\Models\Hospital_admin\MessageModel;
use App\Models\Hospital_admin\MessageToModel;


class Inbox extends BaseController
{

    protected $messageModel;
    protected $messageToModel;

    public function __construct(){
        $this->messageModel = new MessageModel();
        $this->messageToModel = new MessageToModel();
    }

    public function index()
    {
        $data['inbox'] = $this->messageModel->where('for_patient !=',null)->findAll();

        echo view('Mobile_app/header');
        echo view('Mobile_app/Inbox/inbox',$data);
        echo view('Mobile_app/footer');

    }

    public function view($id)
    {
        $mas_to = $this->messageToModel->where('message_id',$id)->countAllResults();
        $pat_id = newSession()->Patient_user_id;
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
        echo view('Mobile_app/header');
        echo view('Mobile_app/Inbox/view',$data);
        echo view('Mobile_app/footer');

    }



}