<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Mobile_app\GlobaladdressModel;
use App\Models\Super_admin\HospitalModel;
use App\Models\Super_admin\IndianHospitalBranchModel;
use App\Models\Super_admin\IndianhospitalModel;
use App\Models\Super_admin\PatientModel;
use App\Models\Super_admin\ProductModel;


class Ajax extends BaseController
{

    protected $cart;
    protected $productModel;
    protected $globaladdressModel;
    protected $hospitalModel;
    protected $patientModel;
    protected $indianHospitalBranchModel;
    protected $indianhospitalModel;
    protected $session;

    public function __construct(){
        $this->cart = \Config\Services::cart();
        $this->productModel = new ProductModel();
        $this->globaladdressModel = new GlobaladdressModel();
        $this->session = \Config\Services::session();
        $this->patientModel = new PatientModel();
        $this->hospitalModel = new HospitalModel();
        $this->indianhospitalModel = new IndianhospitalModel();
        $this->indianHospitalBranchModel = new IndianHospitalBranchModel();
    }

    public function getInHosBranch() {
        $id = $this->request->getPost('ind_h_id');

        $branch = $this->indianHospitalBranchModel->where('ind_h_id',$id)->findAll();
        $row = '<option value="">Please Select</option>';
        foreach ($branch as $rows) {
            $row .= '<option value="'.$rows->ind_hos_bran_id.'">'.$rows->branch_name.'</option>';
        }
        echo $row;
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

    public function nationalAd(){
        $table = DB()->table('ad_management');

        $data['hospitaladd'] = $table->select('*')->join('ad_count', 'ad_count.ad_id = ad_management.ad_id')->where('ad_management.org_type','national')->where('ad_management.start_date <=' ,date("Y-m-d"))->where('ad_management.status','active')->where('ad_management.end_date >',date("Y-m-d"))->orderBy('ad_count.total_view_count', 'ASC')->get(5)->getResult();

        if(!empty($data['hospitaladd'])) {
            echo view('Mobile_app/Adview/national', $data);
        }else{ return false;}
    }

    public function hospitalAd(){

        $table = DB()->table('ad_management');
        $data['hospitaladd'] = array();
        if ($this->session->isPatientLogin == true) {
            $patintId = $this->session->Patient_user_id;
            $glAddId = get_data_by_id('global_address_id','patient','pat_id',$patintId);
            $cusdistricID = get_data_by_id('zila','global_address','global_address_id',$glAddId);

            $hospitaladd = $table->get()->getResult();

            $i = 1;
            $limit = 5;
            foreach ($hospitaladd as $key=>$value){
                if ($i <= $limit) {
                    $district_array = json_decode($value->district_id);
                    if (!empty($district_array)) {
                        if (in_array($cusdistricID, $district_array)) {
                            $table2 = DB()->table('ad_management');
                            $newArray = $table2->select('*')->join('ad_count', 'ad_count.ad_id = ad_management.ad_id')->where('ad_management.org_type', 'hospital')->where('ad_management.start_date <=', date("Y-m-d"))->where('ad_management.status', 'active')->where('ad_management.end_date >', date("Y-m-d"))->where('ad_management.ad_id', $value->ad_id)->orderBy('ad_count.total_view_count', 'ASC')->get()->getRow();
                            if (!empty($newArray)) {
                                array_push($data['hospitaladd'], $newArray);
                                $i++;
                            }
                        }
                    }
                }
            }
        }
        if(!empty($data['hospitaladd'])) {
            echo view('Mobile_app/Adview/hospital', $data);
        }else{ return false; }
    }

    public function adViewCount(){
        $adId = $this->request->getPost('adId');
        $oldView = get_data_by_id('total_view_count','ad_count','ad_id',$adId);


        $newView = $oldView + 1;

        $data = [
            'total_view_count' => $newView,
        ];

        $tab = DB()->table('ad_count');
        $tab->where('ad_id',$adId)->update($data);
        print $adId;
    }


}