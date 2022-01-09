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

class Cart extends BaseController
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

            $product = $this->productModel->findAll();
            $data = [
                'controller' => 'Hospital_admin/Cart',
                'title' => 'Cart',
                'products' => $product,
            ];

            $perm = $this->permission->module_permission_list($role_id, $this->module_name);
            foreach ($perm as $key => $val) {
                $data[$key] = $this->permission->have_access($role_id, $this->module_name, $key);
            }

            echo view('Hospital_admin/header');
            echo view('Hospital_admin/sidebar');
            if ($data['mod_access'] == 1) {
            	echo view('Hospital_admin/Cart/cart_list', $data);
            }else {
            	echo view('Hospital_admin/No_permission', $data);
            }
            echo view('Hospital_admin/footer');
        }


	}

    public function checkout()
    {
        $isLoggedInHospital = $this->session->isLoggedInHospital;
        $role_id = $this->session->hospitalAdminRole;

        if(!isset($isLoggedInHospital) || $isLoggedInHospital != TRUE)
        {
            echo view('Hospital_admin/Login/login');
        }
        else {

            $addId = get_data_by_id('global_address_id','hospital','h_id',$this->session->h_Id);
            $add = $this->globaladdressModel->find($addId);
            $data = [
                'controller' => 'Hospital_admin/Cart',
                'title' => 'Checkout',
                'address' => $add,
            ];

            $perm = $this->permission->module_permission_list($role_id, $this->module_name);
            foreach ($perm as $key => $val) {
                $data[$key] = $this->permission->have_access($role_id, $this->module_name, $key);
            }

            echo view('Hospital_admin/header');
            echo view('Hospital_admin/sidebar');
            if ($data['mod_access'] == 1) {
                echo view('Hospital_admin/Cart/checkout', $data);
            }else {
                echo view('Hospital_admin/No_permission', $data);
            }
            echo view('Hospital_admin/footer');
        }


    }

    public function checkoutAction()
    {
        $shippingAdd = $this->request->getPost('shippingAdd');
        $total = $this->request->getPost('total');
        $shipping = $this->request->getPost('shipping');
        $grandTotal = $this->request->getPost('grandTotal');

        if (empty($shippingAdd)) {
            $this->session->setFlashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Please set the shipping address! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>');
            return redirect()->back();
        }

        $userId = $this->session->h_Id;
        $cart = $this->cart->contents();
        DB()->transStart();
        //order create
        $orData = [
            'h_id' => $userId,
            'pymnt_method_id' => '1',
            'amount' => $total,
            'delivery_charge' => $shipping,
            'final_amount' => $grandTotal,
            'global_address_id' => $shippingAdd,
            'status' => '2',
            'createdBy' => $userId,
        ];

        $this->orderModel->insert($orData);
        $orderId = $this->orderModel->getInsertID();

        foreach ($cart as $item) {
            $subTotl = $item['price'] * $item['qty'];

            //product Qty update
            $oldproQty = get_data_by_id('quantity','products','prod_id',$item['id']);
            $newQty['quantity'] = $oldproQty - $item['qty'];
            $this->productModel->update($item['id'],$newQty);

            //order item insert
            $dataOrItem = [
                'order_id' => $orderId,
                'h_id' => '8',
                'prod_id' => $item['id'],
                'price' => $item['price'],
                'quantity' => $item['qty'],
                'total_price' => $subTotl,
                'final_price' => $subTotl,
                'createdBy' => $userId,
            ];
            $this->orderItemModel->insert($dataOrItem);

        }

        DB()->transComplete();

        $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">Your order has been confirmed <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>');
        $this->cart->destroy();
        return redirect()->to(site_url('Hospital_admin/Products'));
    }



}	