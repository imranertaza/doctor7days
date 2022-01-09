<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers\Hospital_admin;

use App\Controllers\BaseController;
use App\Libraries\Permission_hospital;

use App\Models\Hospital_admin\AppointmentModel;
use App\Models\Mobile_app\OrderModel;
use App\Models\Super_admin\GlobaladdressModel;
use App\Models\Super_admin\OrderItemModel;
use App\Models\Super_admin\ProductModel;

class Order extends BaseController
{
	
    protected $appointmentModel;
    protected $globaladdressModel;
    protected $validation;
    protected $session;
    protected $permission;
    protected $cart;
    protected $orderModel;
    protected $orderItemModel;
    protected $productModel;
    private $module_name = 'Appointment';

	public function __construct()
	{
        $this->session = \Config\Services::session();
	    $this->appointmentModel = new AppointmentModel();
	    $this->globaladdressModel = new GlobaladdressModel();
       	$this->validation =  \Config\Services::validation();
       	$this->permission = new Permission_hospital();
       	$this->productModel = new ProductModel();
        $this->cart = \Config\Services::cart();
        $this->orderModel = new OrderModel();
        $this->orderItemModel = new OrderItemModel();
		
	}
	
	public function index()
	{
        $isLoggedInHospital = $this->session->isLoggedInHospital;
        $role_id = $this->session->hospitalAdminRole;

        if(!isset($isLoggedInHospital) || $isLoggedInHospital != TRUE)
        {
            echo view('Hospital_admin/Login/login');
        }
        else {


            $data = [
                'controller' => 'Hospital_admin/Order',
                'title' => 'Order',
            ];

            $perm = $this->permission->module_permission_list($role_id, $this->module_name);
            foreach ($perm as $key => $val) {
                $data[$key] = $this->permission->have_access($role_id, $this->module_name, $key);
            }
            echo view('Hospital_admin/header');
            echo view('Hospital_admin/sidebar');
            if ($data['mod_access'] == 1) {
            	echo view('Hospital_admin/Order/order_list', $data);
            }else {
            	echo view('Hospital_admin/No_permission', $data);
            }
            echo view('Hospital_admin/footer');
        }


	}

	public function getAll(){
        $response = array();

        $data['data'] = array();

        $result = $this->orderModel->where('h_id',$this->session->h_Id)->findAll();

        foreach ($result as $key => $value) {

            $ops = '<div class="btn-group">';
            $ops .= '<a href="' . base_url() . '/Hospital_admin/Order/invoice/' . $value->order_id . '" class="btn btn-sm btn-info" ><i class="fa fa-eye"></i></a>';
            $ops .= '</div>';

            $data['data'][$key] = array(
                $value->order_id,
                get_data_by_id('name', 'hospital', 'h_id', $value->h_id),
                priceSymbol($value->final_amount),
                orderStatusView($value->status),
                //get_data_by_id('name', 'hospital', 'h_id', $value->h_id),
                $ops,
            );
        }

        return $this->response->setJSON($data);
    }

    public function invoice($id)
    {
        $isLoggedInHospital = $this->session->isLoggedInHospital;
        $role_id = $this->session->hospitalAdminRole;

        if(!isset($isLoggedInHospital) || $isLoggedInHospital != TRUE)
        {
            echo view('Hospital_admin/Login/login');
        }
        else {


            $inv = $this->orderModel->find($id);
            $invItem = $this->orderItemModel->where('order_id',$id)->findAll();
            $add = $this->globaladdressModel->find($inv->global_address_id);
            $data = [
                'controller' => 'Hospital_admin/Order',
                'title' => 'Invoice',
                'order' => $inv,
                'orderItem' => $invItem,
                'address' => $add,
            ];

            $perm = $this->permission->module_permission_list($role_id, $this->module_name);
            foreach ($perm as $key => $val) {
                $data[$key] = $this->permission->have_access($role_id, $this->module_name, $key);
            }

            echo view('Hospital_admin/header');
            echo view('Hospital_admin/sidebar');
            if ($data['mod_access'] == 1) {
                echo view('Hospital_admin/Order/invoice', $data);
            }else {
                echo view('Hospital_admin/No_permission', $data);
            }
            echo view('Hospital_admin/footer');
        }


    }





}	