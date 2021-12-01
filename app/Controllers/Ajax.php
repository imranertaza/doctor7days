<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Mobile_app\GlobaladdressModel;
use App\Models\Super_admin\HospitalModel;
use App\Models\Super_admin\PatientModel;
use App\Models\Super_admin\ProductModel;


class Ajax extends BaseController
{

    protected $cart;
    protected $productModel;
    protected $globaladdressModel;
    protected $hospitalModel;
    protected $patientModel;
    protected $session;

    public function __construct(){
        $this->cart = \Config\Services::cart();
        $this->productModel = new ProductModel();
        $this->globaladdressModel = new GlobaladdressModel();
        $this->session = \Config\Services::session();
        $this->patientModel = new PatientModel();
        $this->hospitalModel = new HospitalModel();
    }

    public function index()
    {

    }

    public function search_district(){

        $divisionsId = $this->request->getPost('divisionsId');

        $district = districtView();
        $row = '<option value="">Please Select</option>';
        foreach ($district as $rows) {
            if ($rows['division_id'] == $divisionsId) {

                $row .= '<option value="'.$rows['id'].'">'.$rows['name'].'</option>';
            }
        }
        echo $row;
    }

    public function search_upazila(){
        $districtId = $this->request->getPost('districtId');

        $upazila = upazilasView();
        $row = '<option value="">Please Select</option>';
        foreach ($upazila as $rows) {
            if ($rows['district_id'] == $districtId) {
                $row .= '<option value="'.$rows['id'].'">'.$rows['name'].'</option>';
            }
        }
        echo $row;
    }

    public function addToCart(){
        $proId = $this->request->getPost('proId');

        $product = $this->productModel->find($proId);
        $this->cart->insert(array(
            'id'      => $product->prod_id,
            'qty'     => 1,
            'price'   => $product->price,
            'name'    => $product->name,
        ));

        return 'Add to cart success';

    }

    public function updateQty(){
        $response = array();
        $rowid = $this->request->getPost('proId');
        $qty = $this->request->getPost('val');
        $oldQty = $this->cart->getItem($rowid);
        $proOldQty = get_data_by_id('quantity','products','prod_id',$oldQty['id']);
        if ($proOldQty >= $qty){
            $this->cart->update(array(
                'rowid'   => $rowid,
                'qty'     => $qty,
            ));
            $response['success'] = true;
            $response['msg'] = 'Update to cart success';
        }else{
            $response['success'] = false;
            $response['msg'] = 'Input quantity is too large';
        }

        return $this->response->setJSON($response);
    }

    public function removeCart(){
        $rowid = $this->request->getPost('proId');
        $this->cart->remove($rowid);

        return 'Remove to cart success';
    }

    public function addressUpdate(){
        $response = array();

        $division = $this->request->getPost('division');
        $zila = $this->request->getPost('zila');
        $upazila = $this->request->getPost('upazila');

        $where = ['division' => $division, 'zila' => $zila, 'upazila' => $upazila,];
        $gloadd = $this->globaladdressModel->where($where);
        if ($gloadd->countAllResults() != 0) {
            $gloaddre = $this->globaladdressModel->where($where);
            $add = $gloaddre->first()->global_address_id;
            $userId = $this->session->Patient_user_id;
            $data['global_address_id'] = $add;
            $this->patientModel->update($userId,$data);

            $response['success'] = true;
            $response['msg'] = 'Update Address success';
        }else{
            $response['success'] = false;
            $response['msg'] = 'something went wrong please try again';
        }

        return $this->response->setJSON($response);
    }

    public function addressUpdateHospital(){
        $response = array();

        $division = $this->request->getPost('division');
        $zila = $this->request->getPost('zila');
        $upazila = $this->request->getPost('upazila');

        $where = ['division' => $division, 'zila' => $zila, 'upazila' => $upazila,];
        $gloadd = $this->globaladdressModel->where($where);
        if ($gloadd->countAllResults() != 0) {
            $gloaddre = $this->globaladdressModel->where($where);
            $add = $gloaddre->first()->global_address_id;
            $userId = $this->session->h_Id;
            $data['global_address_id'] = $add;
            $this->hospitalModel->update($userId,$data);

            $response['success'] = true;
            $response['msg'] = 'Update Address success';
        }else{
            $response['success'] = false;
            $response['msg'] = 'something went wrong please try again';
        }

        return $this->response->setJSON($response);
    }

}