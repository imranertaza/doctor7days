<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers\Web;

use App\Controllers\BaseController;

use App\Models\Hospital_admin\AdminModel;
use App\Libraries\Permission;
use App\Models\Mobile_app\GlobaladdressModel;
use App\Models\Mobile_app\OrderModel;
use App\Models\Super_admin\OrderItemModel;
use App\Models\Super_admin\ProductModel;

class Cart extends BaseController
{

    protected $adminModel;
    protected $validation;
    protected $session;
    protected $permission;
    protected $blogpostModel;
    protected $globaladdressModel;
    protected $cart;
    protected $orderModel;
    protected $orderItem;
    protected $productModel;

    public function __construct()
    {
        $this->adminModel = new AdminModel();
        $this->orderModel = new OrderModel();
        $this->orderItem = new OrderItemModel();
        $this->productModel = new ProductModel();
        $this->globaladdressModel = new GlobaladdressModel();
        $this->validation =  \Config\Services::validation();
        $this->session = \Config\Services::session();
        $this->permission = new Permission();
        $this->cart = \Config\Services::cart();

    }

    public function index()
    {
        $data['sidebar'] =  view('Web/sidebar');
        echo view('Web/header');
        echo view('Web/Cart/list', $data);
        echo view('Web/footer');
    }

    public function payment(){
        if(!empty($this->session->isPatientLoginWeb) || $this->session->isPatientLoginWeb == TRUE) {
            if (!empty($_SESSION['redirectUrl'])) {
                unset($_SESSION['redirectUrl']);
            }

            $data['address'] = [];
            $userId = $this->session->Patient_user_id;
            $userAdd = get_data_by_id('global_address_id', 'patient', 'pat_id', $userId);
            if (!empty($userAdd)) {
                $data['address'] = $this->globaladdressModel->find($userAdd);
            }


            $data['sidebar'] =  view('Web/sidebar');
            echo view('Web/header');
            echo view('Web/Cart/payment',$data);
            echo view('Web/footer');
        }else{
            $redirectUrl = 'Web/Cart/payment';
            $this->session->set("redirectUrl", $redirectUrl);
            return redirect()->to(site_url('Web/Login'));
        }
    }

    public function checkout()
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
        $userId = $this->session->Patient_user_id;
        $cart = $this->cart->contents();
        DB()->transStart();
        //order create
        $orData = [
            'patient_id' => $userId,
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
            $this->orderItem->insert($dataOrItem);

        }

        DB()->transComplete();

        $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">Your order has been confirmed <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>');
        $this->cart->destroy();
        return redirect()->to(site_url('Web/OrderList/invoice/'.$orderId));
    }



}