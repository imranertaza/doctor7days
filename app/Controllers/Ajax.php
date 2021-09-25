<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers;

use App\Controllers\BaseController;


class Ajax extends BaseController
{



    public function __construct(){}

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



}