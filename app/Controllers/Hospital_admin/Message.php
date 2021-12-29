<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers\Hospital_admin;

use App\Controllers\BaseController;
use App\Libraries\Permission_hospital;
use App\Models\Hospital_admin\MessageModel;
use App\Models\Hospital_admin\MessageToModel;
use App\Models\Mobile_app\GlobaladdressModel;
use App\Models\Super_admin\RolesModel;

class Message extends BaseController
{

    protected $messageModel;
    protected $messageToModel;
    protected $validation;
    protected $session;
    protected $permission;
    protected $rolesModel;
    protected $crop;
    protected $globaladdressModel;
    private $module_name = 'Users';

    public function __construct()
    {
        $this->messageModel = new MessageModel();
        $this->messageToModel = new MessageToModel();
        $this->validation = \Config\Services::validation();
        $this->session = \Config\Services::session();
        $this->permission = new Permission_hospital();
        $this->rolesModel = new RolesModel();
        $this->globaladdressModel = new GlobaladdressModel();
        $this->crop = \Config\Services::image();
    }

    public function index()
    {
        $isLoggedInHospital = $this->session->isLoggedInHospital;
        $role_id = $this->session->hospitalAdminRole;

        if (!isset($isLoggedInHospital) || $isLoggedInHospital != TRUE) {
            echo view('Hospital_admin/Login/login');
        } else {
            $h_id = $this->session->h_Id;
            $data = [
                'controller' => 'Hospital_admin/Message',
                'title' => 'Message',
            ];

            $perm = $this->permission->module_permission_list($role_id, $this->module_name);
            foreach ($perm as $key => $val) {
                $data[$key] = $this->permission->have_access($role_id, $this->module_name, $key);
            }

            echo view('Hospital_admin/header');
            echo view('Hospital_admin/sidebar');
            if ($data['mod_access'] == 1) {
                echo view('Hospital_admin/Message/message', $data);
            } else {
                echo view('Hospital_admin/No_permission', $data);
            }

            echo view('Hospital_admin/footer');
        }

    }

    public function getAll()
    {

        $data['data'] = array();

        $h_id = $this->session->h_Id;

        $hospitalCat = get_data_by_id('hospital_cat_id','hospital','h_id',$h_id);

        if ($hospitalCat == 1){
            $result = $this->messageModel->where('for_hospital !=',null)->findAll();
            foreach ($result as $key => $value) {
                $ops = '<div class="btn-group">';
                $ops .= '<a href="' . base_url('Hospital_admin/Message/mass_view/' . $value->message_id) . '"  type="button" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>';
                $ops .= '</div>';
                if ($value->for_hospital == 'Specific'){
                    $table = DB()->table('message');
                    $joinData = $table->join('message_to','message_to.message_id = message.message_id')->where('message.message_id',$value->message_id)->where('message_to.to_hospital_id',$h_id)->get()->getRow();
                    if (!empty($joinData)){
                        $data['data'][$key] = array(
                            $joinData->message_id,
                            $joinData->title.'<br>'.substr($joinData->description,0,120),
                            $ops,
                        );
                    }
                }

                if ($value->for_hospital == 'All'){
                    $data['data'][$key] = array(
                        $value->message_id,
                        $value->title.'<br>'.substr($value->description,0, 120),
                        $ops,
                    );
                }
            }
        }

        if ($hospitalCat == 2){
            $result = $this->messageModel->where('for_diagnostic !=',null)->findAll();
            foreach ($result as $key => $value) {
                $ops = '<div class="btn-group">';
                $ops .= '<a href="' . base_url('Hospital_admin/Message/mass_view/' . $value->message_id) . '"  type="button" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>';
                $ops .= '</div>';
                if ($value->for_diagnostic == 'Specific'){
                    $table = DB()->table('message');
                    $joinData = $table->join('message_to','message_to.message_id = message.message_id')->where('message.message_id',$value->message_id)->where('message_to.to_diagnostic_id',$h_id)->get()->getRow();
                    if (!empty($joinData)){
                        $data['data'][$key] = array(
                            $joinData->message_id,
                            $joinData->title.'<br>'.substr($joinData->description,0,120),
                            $ops,
                        );
                    }
                }

                if ($value->for_diagnostic == 'All'){
                    $data['data'][$key] = array(
                        $value->message_id,
                        $value->title.'<br>'.substr($value->description,0,120),
                        $ops,
                    );
                }
            }
        }

        if ($hospitalCat == 3){
            $result = $this->messageModel->where('for_patient',null)->findAll();

            $i = 0;
            foreach ($result as $value) {

                $ops = '<div class="btn-group"><a href="'.base_url('Hospital_admin/Message/mass_view/'.$value->message_id).'"  type="button" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a></div>';

                if ($value->for_diagnostic == 'Specific'){
                    $table = DB()->table('message');
                    $joinData = $table->join('message_to','message_to.message_id = message.message_id')->where('message.message_id',$value->message_id)->where('message_to.to_diagnostic_id',$h_id)->get()->getRow();
                    if (!empty($joinData)){
                        $data['data'][$i++] = array(
                            $joinData->message_id,
                            $joinData->title.'<br>'.substr($joinData->description,0,120),
                            $ops,
                        );
                    }
                }

                if ($value->for_diagnostic == 'All'){
                    $data['data'][$i++] = array(
                        $value->message_id,
                        $value->title.'<br>'.substr($value->description,0,120),
                        $ops,
                    );
                }

                if ($value->for_hospital == 'Specific'){
                    $table2 = DB()->table('message');
                    $joinDatahos = $table2->join('message_to','message_to.message_id = message.message_id')->where('message.message_id',$value->message_id)->where('message_to.to_hospital_id',$h_id)->get()->getRow();
                    if (!empty($joinDatahos)){
                        $data['data'][$i++] = array(
                            $joinDatahos->message_id,
                            $joinDatahos->title.'<br>'.substr($joinDatahos->description,0,120),
                            $ops,
                        );
                    }
                }

                if ($value->for_hospital == 'All'){
                    $data['data'][$i++] = array(
                        $value->message_id,
                        $value->title.'<br>'.substr($value->description,0, 120),
                        $ops,
                    );
                }

            }
        }

        return $this->response->setJSON($data);
    }
    
    public function mass_view($id){
        $isLoggedInHospital = $this->session->isLoggedInHospital;
        $role_id = $this->session->hospitalAdminRole;

        if (!isset($isLoggedInHospital) || $isLoggedInHospital != TRUE) {
            echo view('Hospital_admin/Login/login');
        } else {
            $h_id = $this->session->h_Id;

            $hCatId = get_data_by_id('hospital_cat_id','hospital','h_id',$h_id);

            $mas_to = $this->messageToModel->where('message_id',$id)->countAllResults();
            $h_id = $this->session->h_Id;

            if ($hCatId == 1) {
                if (empty($mas_to)) {
                    $masData = [
                        'message_id' => $id,
                        'to_hospital_id' => $h_id,
                        'msg_read' => '1',
                    ];
                    $this->messageToModel->insert($masData);
                } else {
                    $masSpecData = [
                        'msg_read' => '1',
                    ];
                    $masTo = DB()->table('message_to');
                    $masTo->where('message_id', $id)->where('to_hospital_id', $h_id)->update($masSpecData);
                }
            }

            if ($hCatId == 2) {
                if (empty($mas_to)) {
                    $masData = [
                        'message_id' => $id,
                        'to_diagnostic_id' => $h_id,
                        'msg_read' => '1',
                    ];
                    $this->messageToModel->insert($masData);
                } else {
                    $masSpecData = [
                        'msg_read' => '1',
                    ];
                    $masTo = DB()->table('message_to');
                    $masTo->where('message_id', $id)->where('to_diagnostic_id', $h_id)->update($masSpecData);
                }
            }

            if ($hCatId == 3) {
                if (empty($mas_to)) {
                    $masData = [
                        'message_id' => $id,
                        'to_diagnostic_id' => $h_id,
                        'msg_read' => '1',
                    ];
                    $this->messageToModel->insert($masData);
                } else {
                    $masSpecData = [
                        'msg_read' => '1',
                    ];
                    $masTo = DB()->table('message_to');
                    $masTo->where('message_id', $id)->where('to_diagnostic_id', $h_id)->update($masSpecData);
                }

                if (empty($mas_to)) {
                    $masData = [
                        'message_id' => $id,
                        'to_hospital_id' => $h_id,
                        'msg_read' => '1',
                    ];
                    $this->messageToModel->insert($masData);
                } else {
                    $masSpecData = [
                        'msg_read' => '1',
                    ];
                    $masTo = DB()->table('message_to');
                    $masTo->where('message_id', $id)->where('to_hospital_id', $h_id)->update($masSpecData);
                }
            }



            $message = $this->messageModel->find($id);
            $data = [
                'controller' => 'Hospital_admin/Message',
                'title' => 'Message',
                'message' => $message,
            ];

            $perm = $this->permission->module_permission_list($role_id, $this->module_name);
            foreach ($perm as $key => $val) {
                $data[$key] = $this->permission->have_access($role_id, $this->module_name, $key);
            }

            echo view('Hospital_admin/header');
            echo view('Hospital_admin/sidebar');
            if ($data['update'] == 1) {
                echo view('Hospital_admin/Message/view', $data);
            } else {
                echo view('Hospital_admin/No_permission', $data);
            }

            echo view('Hospital_admin/footer');
        }
    }





    public function remove()
    {
        $response = array();

        $id = $this->request->getPost('user_id');

        if (!$this->validation->check($id, 'required|numeric')) {

            throw new \CodeIgniter\Exceptions\PageNotFoundException();

        } else {

            if ($this->usersModel->where('user_id', $id)->delete()) {

                $response['success'] = true;
                $response['messages'] = 'Deletion succeeded';

            } else {

                $response['success'] = false;
                $response['messages'] = 'Deletion error!';

            }
        }

        return $this->response->setJSON($response);
    }

}	