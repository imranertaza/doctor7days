<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers\Super_admin;

use App\Controllers\BaseController;

use App\Models\Super_admin\BrandModel;
use App\Models\Super_admin\ProductCategoryModel;
use App\Models\Super_admin\ProductModel;
use App\Libraries\Permission;
use App\Models\Super_admin\StoreModel;

class Product extends BaseController
{

    protected $productModel;
    protected $validation;
    protected $session;
    protected $permission;
    protected $productCategoryModel;
    protected $brandModel;
    protected $storeModel;
    private $module_name = 'Product';

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->validation = \Config\Services::validation();
        $this->session = \Config\Services::session();
        $this->permission = new Permission();
        $this->productCategoryModel = new ProductCategoryModel();
        $this->brandModel = new BrandModel();
        $this->storeModel = new StoreModel();

    }

    public function index()
    {
        $isLoggedIAdmin = $this->session->isLoggedIAdmin;
        $role_id = $this->session->AdminRole;

        if (isset($isLoggedIAdmin)) {

            $proCat = $this->productCategoryModel->where('parent_pro_cat_id',0)->findAll();
            $brand = $this->brandModel->findAll();
            $store = $this->storeModel->findAll();
            $data = [
                'controller' => 'Super_admin/product',
                'title' => 'Products',
                'proCategory' => $proCat,
                'brand' => $brand,
                'store' => $store,
            ];

            $perm = $this->permission->module_permission_list($role_id, $this->module_name);
            foreach ($perm as $key => $val) {
                $data[$key] = $this->permission->have_access($role_id, $this->module_name, $key);
            }

            echo view('Super_admin/header');
            echo view('Super_admin/sidebar');
            if ($data['mod_access'] == 1) {
                echo view('Super_admin/Product/product', $data);
            } else {
                echo view('Super_admin/No_permission', $data);
            }

            echo view('Super_admin/footer');
        } else {
            return redirect()->to(site_url("/super_admin/login"));
        }
    }

    public function update($id){
        $isLoggedIAdmin = $this->session->isLoggedIAdmin;
        $role_id = $this->session->AdminRole;

        if (isset($isLoggedIAdmin)) {

            $proCat = $this->productCategoryModel->where('parent_pro_cat_id',0)->findAll();
            $brand = $this->brandModel->findAll();
            $store = $this->storeModel->findAll();
            $result = $this->productModel->where('prod_id', $id)->first();
            $data = [
                'controller' => 'Super_admin/product',
                'title' => 'Products',
                'proCategory' => $proCat,
                'brand' => $brand,
                'store' => $store,
                'product' => $result,
            ];

            $perm = $this->permission->module_permission_list($role_id, $this->module_name);
            foreach ($perm as $key => $val) {
                $data[$key] = $this->permission->have_access($role_id, $this->module_name, $key);
            }

            echo view('Super_admin/header');
            echo view('Super_admin/sidebar');
            if ($data['update'] == 1) {
                echo view('Super_admin/Product/update', $data);
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
        $response = array();

        $data['data'] = array();

        $result = $this->productModel->findAll();

        foreach ($result as $key => $value) {

            $ops = '<div class="btn-group">';
//            $ops .= '	<button type="button" class="btn btn-sm btn-info" onclick="edit(' . $value->prod_id . ')"><i class="fa fa-edit"></i></button>';
            $ops .= '<a href="'.base_url('Super_admin/Product/update/'.$value->prod_id).'" class="btn btn-sm btn-info" ><i class="fa fa-edit"></i></a>';
            $ops .= '	<button type="button" class="btn btn-sm btn-danger" onclick="remove(' . $value->prod_id . ')"><i class="fa fa-trash"></i></button>';
            $ops .= '</div>';

            $data['data'][$key] = array(
                $value->prod_id,
                get_data_by_id('name','store','store_id',$value->store_id),
                $value->name,
                $value->price,
                $value->quantity,
                showUnitName($value->unit),
                get_data_by_id('name','brand','brand_id',$value->brand_id),
                '<img src="'.base_url('assets/uplode/product/'.$value->picture).'" width="80">',
                get_data_by_id('product_category','product_category','prod_cat_id',$value->prod_cat_id),
                statusView($value->status),

                $ops,
            );
        }

        return $this->response->setJSON($data);
    }

    public function subcategory(){
        $id = $this->request->getPost('subId');
        $subCat = $this->productCategoryModel->where('parent_pro_cat_id',$id)->findAll();
        $view = '<option value="">Please Select</option>';
        foreach ($subCat as $item) {
            $view .= '<option value="'.$item->prod_cat_id.'">'.$item->product_category.'</option>';
        }
        return $view;

    }
    public function getOne()
    {
        $response = array();

        $id = $this->request->getPost('prod_id');

        if ($this->validation->check($id, 'required|numeric')) {

            $data = $this->productModel->where('prod_id', $id)->first();

            return $this->response->setJSON($data);

        } else {

            throw new \CodeIgniter\Exceptions\PageNotFoundException();

        }

    }

    public function add()
    {

        $response = array();

        $fields['store_id'] = $this->request->getPost('storeId');
        $fields['name'] = $this->request->getPost('name');
        $fields['price'] = $this->request->getPost('price');
        $fields['quantity'] = $this->request->getPost('quantity');
        $fields['unit'] = $this->request->getPost('unit');
        $fields['brand_id'] = $this->request->getPost('brandId');
        $fields['prod_cat_id'] = $this->request->getPost('prodCatId');
        $fields['product_type'] = $this->request->getPost('productType');
        $fields['description'] = $this->request->getPost('description');
        $fields['status'] = $this->request->getPost('status');


        if (!empty($_FILES['picture']['name'])) {
            $picture= $this->request->getFile('picture');
            $name = $picture->getRandomName();
            $picture->move(FCPATH . '\assets\uplode\product',$name);
            $fields['picture'] = $name;
        }


        $this->validation->setRules([
            'store_id' => ['label' => 'Store id', 'rules' => 'required|numeric|max_length[11]'],
            'name' => ['label' => 'Name', 'rules' => 'required|max_length[55]'],
            'quantity' => ['label' => 'Quantity', 'rules' => 'required|numeric|max_length[11]'],
            'unit' => ['label' => 'Unit', 'rules' => 'required|numeric|max_length[11]'],
            'prod_cat_id' => ['label' => 'Prod cat id', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'status' => ['label' => 'Status', 'rules' => 'required'],
        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
            $response['messages'] = $this->validation->listErrors();

        } else {

            if ($this->productModel->insert($fields)) {

                $response['success'] = true;
                $response['messages'] = 'Data has been inserted successfully';

            } else {

                $response['success'] = false;
                $response['messages'] = 'Insertion error!';

            }
        }

        return $this->response->setJSON($response);
    }

    public function updateAction(){
        $response = array();

        $fields['prod_id'] = $this->request->getPost('prodId');
        $fields['store_id'] = $this->request->getPost('storeId');
        $fields['name'] = $this->request->getPost('name');
        $fields['price'] = $this->request->getPost('price');
        $fields['quantity'] = $this->request->getPost('quantity');
        $fields['unit'] = $this->request->getPost('unit');
        $fields['brand_id'] = $this->request->getPost('brandId');
        $fields['prod_cat_id'] = $this->request->getPost('prodCatId');
        $fields['product_type'] = $this->request->getPost('productType');
        $fields['description'] = $this->request->getPost('description');
        $fields['status'] = $this->request->getPost('status');

        if (!empty($_FILES['picture']['name'])) {
            $picture= $this->request->getFile('picture');
            $name = $picture->getRandomName();
            $picture->move(FCPATH . '\assets\uplode\product',$name);
            $fields['picture'] = $name;
        }

        $this->validation->setRules([
            'store_id' => ['label' => 'Store id', 'rules' => 'required|numeric|max_length[11]'],
            'name' => ['label' => 'Name', 'rules' => 'required|max_length[55]'],
            'quantity' => ['label' => 'Quantity', 'rules' => 'required|numeric|max_length[11]'],
            'unit' => ['label' => 'Unit', 'rules' => 'required|numeric|max_length[11]'],
            'prod_cat_id' => ['label' => 'Prod cat id', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'status' => ['label' => 'Status', 'rules' => 'required'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
            $response['messages'] = $this->validation->listErrors();

        } else {

            if ($this->productModel->update($fields['prod_id'], $fields)) {

                $response['success'] = true;
                $response['messages'] = 'Successfully updated';

            } else {

                $response['success'] = false;
                $response['messages'] = 'Update error!';

            }
        }

        return $this->response->setJSON($response);
    }

    public function edit()
    {

        $response = array();

        $fields['prod_id'] = $this->request->getPost('prodId');
        $fields['store_id'] = $this->request->getPost('storeId');
        $fields['name'] = $this->request->getPost('name');
        $fields['quantity'] = $this->request->getPost('quantity');
        $fields['unit'] = $this->request->getPost('unit');
        $fields['brand_id'] = $this->request->getPost('brandId');
        $fields['picture'] = $this->request->getPost('picture');
        $fields['prod_cat_id'] = $this->request->getPost('prodCatId');
        $fields['product_type'] = $this->request->getPost('productType');
        $fields['description'] = $this->request->getPost('description');
        $fields['status'] = $this->request->getPost('status');
        $fields['createdDtm'] = $this->request->getPost('createdDtm');
        $fields['createdBy'] = $this->request->getPost('createdBy');
        $fields['updateDtm'] = $this->request->getPost('updateDtm');
        $fields['updatedBy'] = $this->request->getPost('updatedBy');
        $fields['deleted'] = $this->request->getPost('deleted');
        $fields['deletedRole'] = $this->request->getPost('deletedRole');


        $this->validation->setRules([
            'store_id' => ['label' => 'Store id', 'rules' => 'required|numeric|max_length[11]'],
            'name' => ['label' => 'Name', 'rules' => 'required|max_length[55]'],
            'quantity' => ['label' => 'Quantity', 'rules' => 'required|numeric|max_length[11]'],
            'unit' => ['label' => 'Unit', 'rules' => 'required|numeric|max_length[11]'],
            'brand_id' => ['label' => 'Brand id', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'picture' => ['label' => 'Picture', 'rules' => 'permit_empty|max_length[155]'],
            'prod_cat_id' => ['label' => 'Prod cat id', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'product_type' => ['label' => 'Product type', 'rules' => 'required'],
            'description' => ['label' => 'Description', 'rules' => 'permit_empty'],
            'status' => ['label' => 'Status', 'rules' => 'required'],
            'createdDtm' => ['label' => 'CreatedDtm', 'rules' => 'required'],
            'createdBy' => ['label' => 'CreatedBy', 'rules' => 'required|numeric|max_length[11]'],
            'updateDtm' => ['label' => 'UpdateDtm', 'rules' => 'required'],
            'updatedBy' => ['label' => 'UpdatedBy', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'deleted' => ['label' => 'Deleted', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'deletedRole' => ['label' => 'DeletedRole', 'rules' => 'permit_empty|numeric|max_length[11]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
            $response['messages'] = $this->validation->listErrors();

        } else {

            if ($this->productModel->update($fields['prod_id'], $fields)) {

                $response['success'] = true;
                $response['messages'] = 'Successfully updated';

            } else {

                $response['success'] = false;
                $response['messages'] = 'Update error!';

            }
        }

        return $this->response->setJSON($response);

    }

    public function remove()
    {
        $response = array();

        $id = $this->request->getPost('prod_id');

        if (!$this->validation->check($id, 'required|numeric')) {

            throw new \CodeIgniter\Exceptions\PageNotFoundException();

        } else {

            if ($this->productModel->where('prod_id', $id)->delete()) {

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