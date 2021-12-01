<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers\Super_admin;

use App\Controllers\BaseController;

use App\Models\Hospital_admin\GlobaladdressModel;
use App\Models\Mobile_app\OrderModel;
use App\Models\Super_admin\OrderItemModel;
use App\Libraries\Permission;

class Orders extends BaseController
{

    protected $orderItemModel;
    protected $globaladdressModel;
    protected $orderModel;
    protected $validation;
    protected $session;
    protected $permission;
    private $module_name = 'OrderItem';

    public function __construct()
    {
        $this->orderItemModel = new OrderItemModel();
        $this->orderModel = new OrderModel();
        $this->globaladdressModel = new GlobaladdressModel();
        $this->validation = \Config\Services::validation();
        $this->session = \Config\Services::session();
        $this->permission = new Permission();

    }

    public function index()
    {
        $isLoggedIAdmin = $this->session->isLoggedIAdmin;
        $role_id = $this->session->AdminRole;
        if (isset($isLoggedIAdmin)) {
            $data = [
                'controller' => 'Super_admin/Orders',
                'title' => 'Orders'
            ];
            $perm = $this->permission->module_permission_list($role_id, $this->module_name);
            foreach ($perm as $key => $val) {
                $data[$key] = $this->permission->have_access($role_id, $this->module_name, $key);
            }
            echo view('Super_admin/header');
            echo view('Super_admin/sidebar');
            if ($data['mod_access'] == 1) {
                echo view('Super_admin/Orders/orderList', $data);
            } else {
                echo view('Super_admin/No_permission', $data);
            }
            echo view('Super_admin/footer');
        } else {
            return redirect()->to(site_url("/super_admin/login"));
        }

    }

    public function getAll()
    {
        $data['data'] = array();
        $result = $this->orderModel->findAll();
        foreach ($result as $key => $value) {
            $ops = '<div class="btn-group">';
            $ops .= '	<a href="' . base_url('Super_admin/Orders/invoice/' . $value->order_id) . '" type="button" class="btn btn-sm btn-info" ><i class="fa fa-eye"></i></a>';
            $ops .= '</div>';
            if (!empty($value->patient_id)) {
                $customer = get_data_by_id('name', 'patient', 'pat_id', $value->patient_id);
            } else {
                $customer = get_data_by_id('name', 'hospital', 'h_id', $value->h_id);
            }

            $data['data'][$key] = array(
                $value->order_id,
                $customer,
                priceSymbol($value->final_amount),
                orderStatusView($value->status),
                $ops,
            );
        }

        return $this->response->setJSON($data);
    }

    public function invoice($id)
    {
        $isLoggedIAdmin = $this->session->isLoggedIAdmin;
        $role_id = $this->session->AdminRole;

        if (isset($isLoggedIAdmin)) {

            $inv = $this->orderModel->find($id);
            $invItem = $this->orderItemModel->where('order_id', $id)->findAll();
            $add = $this->globaladdressModel->find($inv->global_address_id);
            $data = [
                'controller' => 'Super_admin/Orders',
                'title' => 'Invoice',
                'order' => $inv,
                'orderItem' => $invItem,
                'address' => $add,
            ];
            $perm = $this->permission->module_permission_list($role_id, $this->module_name);
            foreach ($perm as $key => $val) {
                $data[$key] = $this->permission->have_access($role_id, $this->module_name, $key);
            }
            echo view('Super_admin/header');
            echo view('Super_admin/sidebar');
            if ($data['mod_access'] == 1) {
                echo view('Super_admin/Orders/invoice', $data);
            } else {
                echo view('Super_admin/No_permission', $data);
            }
            echo view('Super_admin/footer');
        } else {
            return redirect()->to(site_url("/super_admin/login"));
        }


    }

    public function orderStatusUpdate(){
        $response = array();
        $order_id = $this->request->getPost('orderId');
        $fields['status'] = $this->request->getPost('status');
        if ($this->orderModel->update($order_id, $fields)) {
            //print $this->orderModel->getLastQuery();
            $response['success'] = true;
            $response['messages'] = 'Status has been updated successfully';

        } else {

            $response['success'] = false;
            $response['messages'] = 'Insertion error!';

        }

        return $this->response->setJSON($response);
    }

}	