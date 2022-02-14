<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers\Web;

use App\Controllers\BaseController;

use App\Models\Hospital_admin\AdminModel;
use App\Libraries\Permission;
use App\Models\Mobile_app\OrderModel;
use App\Models\Super_admin\OrderItemModel;

class OrderList extends BaseController
{

    protected $adminModel;
    protected $validation;
    protected $session;
    protected $permission;
    protected $blogpostModel;

    public function __construct()
    {
        $this->adminModel = new AdminModel();
        $this->orderModel = new OrderModel();
        $this->orderItem = new OrderItemModel();
        $this->validation =  \Config\Services::validation();
        $this->session = \Config\Services::session();
        $this->permission = new Permission();

    }

    public function index()
    {
        if (!empty($this->session->isPatientLoginWeb) || $this->session->isPatientLoginWeb == TRUE) {
            $userId = $this->session->Patient_user_id;
            $order = $this->orderModel->where('patient_id',$userId)->orderBy('order_id','DESC')->findAll();
            $data = [
                'order' => $order,
            ];

            $data['sidebar'] =  view('Web/sidebar');
            echo view('Web/header');
            echo view('Web/OrderList/list', $data);
            echo view('Web/footer');
        } else {
            return redirect()->to(site_url('Web/Login'));
        }

    }

    public function invoice($id){

        if (!empty($this->session->isPatientLoginWeb) || $this->session->isPatientLoginWeb == TRUE) {
            $userId = $this->session->Patient_user_id;
            $order = $this->orderModel->find($id);
            $orderItem = $this->orderItem->where('order_id',$id)->findAll();
            $data = [
                'order' => $order,
                'orderItem' => $orderItem,
            ];

            $data['sidebar'] =  view('Web/sidebar');
            echo view('Web/header');
            echo view('Web/OrderList/invoice', $data);
            echo view('Web/footer');
        } else {
            return redirect()->to(site_url('Web/Login'));
        }

    }


}