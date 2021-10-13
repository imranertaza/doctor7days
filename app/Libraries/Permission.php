<?php

namespace App\Libraries;

class Permission {

	protected $db;
  
    public function __construct(){
    	
       $this->db = db_connect();
    }


/*

public function have_access($user_id, $module_name, $sub_permission)
{
$CI =& get_instance();

$result = $CI->db->query("SELECT `roles`.`permission` FROM `users`,`roles` WHERE `users`.`role_id` = `roles`.`role_id` AND `users`.`user_id` = ".$user_id)->row();
//print_r($result->permission);
$obj = json_decode($result->permission, true);
return $obj[$module_name][$sub_permission];
}

*/

// public $admin_permissions = '{"Dashboard":{"mod_access":"1","create":"1","read":"1","update":"1","delete":"1"},"Pages":{"mod_access":"1","create":"1","read":"1","update":"1","delete":"1"},"Bank":{"mod_access":"1","create":"1","read":"1","update":"1","delete":"1"},"Customers":{"mod_access":"1","create":"1","read":"1","update":"1","delete":"1"},"Purchase":{"mod_access":"1","create":"1","read":"1","update":"1","delete":"1"},"Purchase_item":{"mod_access":"1","create":"1","read":"1","update":"1","delete":"1"},"Product_category":{"mod_access":"1","create":"1","read":"1","update":"1","delete":"1"},"Bank_deposit":{"mod_access":"1","create":"1","read":"1","update":"1","delete":"1"},"Settings":{"mod_access":"1","create":"1","read":"1","update":"1","delete":"1"},"Bank_withdraw":{"mod_access":"1","create":"1","read":"1","update":"1","delete":"1"},"Warranty_manage":{"mod_access":"1","create":"1","read":"1","update":"1","delete":"1"},"Suppliers":{"mod_access":"1","create":"1","read":"1","update":"1","delete":"1"},"Sales":{"mod_access":"1","create":"1","read":"1","update":"1","delete":"1","discount":"1","warranty":"1"},"Role":{"mod_access":"1","create":"1","read":"1","update":"1","delete":"1"},"Money_receipt":{"mod_access":"1","create":"1","read":"1","update":"1","delete":"1"},"Loan_provider":{"mod_access":"1","create":"1","read":"1","update":"1","delete":"1"},"Ledger_suppliers":{"mod_access":"1","create":"1","read":"1","update":"1","delete":"1"},"Ledger_nagodan":{"mod_access":"1","create":"1","read":"1","update":"1","delete":"1"},"Ledger_loan":{"mod_access":"1","create":"1","read":"1","update":"1","delete":"1"},"User":{"mod_access":"1","create":"1","read":"1","update":"1","delete":"1"},"Stores":{"mod_access":"1","create":"1","read":"1","update":"1","delete":"1"},"Ledger_lc":{"mod_access":"1","create":"1","read":"1","update":"1","delete":"1"},"Ledger_bank":{"mod_access":"1","create":"1","read":"1","update":"1","delete":"1"},"Invoice":{"mod_access":"1","create":"1","read":"1","update":"1","delete":"1","discount":"1","warranty":"1"},"Expense_category":{"mod_access":"1","create":"1","read":"1","update":"1","delete":"1"},"Balance_report":{"mod_access":"1","create":"1","read":"1","update":"1","delete":"1"},"Ledger":{"mod_access":"1","create":"1","read":"1","update":"1","delete":"1"},"Lc_installment":{"mod_access":"1","create":"1","read":"1","update":"1","delete":"1"},"Lc":{"mod_access":"1","create":"1","read":"1","update":"1","delete":"1"},"Customer_type":{"mod_access":"1","create":"1","read":"1","update":"1","delete":"1"},"Products":{"mod_access":"1","create":"1","read":"1","update":"1","delete":"1"},"Transaction":{"mod_access":"1","create":"1","read":"1","update":"1","delete":"1"},"Chaque":{"mod_access":"1","create":"1","read":"1","update":"1","delete":"1"},"Stock_report":{"mod_access":"1","create":"1","read":"1","update":"1","delete":"1"},"Sales_report":{"mod_access":"1","create":"1","read":"1","update":"1","delete":"1"},"Purchase_report":{"mod_access":"1","create":"1","read":"1","update":"1","delete":"1"},"Daily_book":{"mod_access":"1","create":"1","read":"1","update":"1","delete":"1"},"Brand":{"mod_access":"1","create":"1","read":"1","update":"1","delete":"1"},"Employee":{"mod_access":"1","create":"1","read":"1","update":"1","delete":"1"},"Ledger_employee":{"mod_access":"1","create":"1","read":"1","update":"1","delete":"1"},"Return_sale":{"mod_access":"1","create":"1","read":"1","update":"1","delete":"1"},"Return_purchase":{"mod_access":"1","create":"1","read":"1","update":"1","delete":"1"},"Vat_register":{"mod_access":"1","create":"1","read":"1","update":"1","delete":"1"},"Ledger_vat":{"mod_access":"1","create":"1","read":"1","update":"1","delete":"1"},"Buy":{"mod_access":"1","create":"1","read":"1","update":"1","delete":"1"},"Message":{"mod_access":"1","create":"1","read":"1","update":"1","delete":"1"},"Profile":{"mod_access":"1","create":"1","read":"1","update":"1","delete":"1"},"Referral_customer":{"mod_access":"1","create":"1","read":"1","update":"1","delete":"1"}}';

protected $admin_permissions ='{"Dashboard":{"mod_access":"1","create":"1","read":"1","update":"1","delete":"1"},"Admanage":{"mod_access":"1","create":"1","read":"1","update":"1","delete":"1"},"Ambulance":{"mod_access":"1","create":"1","read":"1","update":"1","delete":"1"},"Blogcomments":{"mod_access":"1","create":"1","read":"1","update":"1","delete":"1"},"Blogpost":{"mod_access":"1","create":"1","read":"1","update":"1","delete":"1"},"Blogsettings":{"mod_access":"1","create":"1","read":"1","update":"1","delete":"1"},"Hospital":{"mod_access":"1","create":"1","read":"1","update":"1","delete":"1"},"Hospitalcategory":{"mod_access":"1","create":"1","read":"1","update":"1","delete":"1"},"Job":{"mod_access":"1","create":"1","read":"1","update":"1","delete":"1"},"OrderItem":{"mod_access":"1","create":"1","read":"1","update":"1","delete":"1"},"PaymentMethod":{"mod_access":"1","create":"1","read":"1","update":"1","delete":"1"},"Product":{"mod_access":"1","create":"1","read":"1","update":"1","delete":"1"},"ProductCategory":{"mod_access":"1","create":"1","read":"1","update":"1","delete":"1"},"Role":{"mod_access":"1","create":"1","read":"1","update":"1","delete":"1"},"Store":{"mod_access":"1","create":"1","read":"1","update":"1","delete":"1"},"Invoice":{"mod_access":"1","create":"1","read":"1","update":"1","delete":"1"},"Profile":{"mod_access":"1","create":"1","read":"1","update":"1","delete":"1"}}';



protected $all_permissions = '{"Dashboard":{"mod_access":"0","create":"0","read":"0","update":"0","delete":"0"},"Admanage":{"mod_access":"0","create":"0","read":"0","update":"0","delete":"0"},"Ambulance":{"mod_access":"0","create":"0","read":"0","update":"0","delete":"0"},"Blogcomments":{"mod_access":"0","create":"0","read":"0","update":"0","delete":"0"},"Blogpost":{"mod_access":"0","create":"0","read":"0","update":"0","delete":"0"},"Blogsettings":{"mod_access":"0","create":"0","read":"0","update":"0","delete":"0"},"Hospital":{"mod_access":"0","create":"0","read":"0","update":"0","delete":"0"},"Hospitalcategory":{"mod_access":"0","create":"0","read":"0","update":"0","delete":"0"},"Job":{"mod_access":"0","create":"0","read":"0","update":"0","delete":"0"},"OrderItem":{"mod_access":"0","create":"0","read":"0","update":"0","delete":"0"},"PaymentMethod":{"mod_access":"0","create":"0","read":"0","update":"0","delete":"0"},"Product":{"mod_access":"0","create":"0","read":"0","update":"0","delete":"0"},"ProductCategory":{"mod_access":"0","create":"0","read":"0","update":"0","delete":"0"},"Role":{"mod_access":"0","create":"0","read":"0","update":"0","delete":"0"},"Store":{"mod_access":"0","create":"0","read":"0","update":"0","delete":"0"},"Invoice":{"mod_access":"0","create":"0","read":"0","update":"0","delete":"0"},"Profile":{"mod_access":"0","create":"0","read":"0","update":"0","delete":"0"}}';





public function have_access($roleId, $module_name, $sub_permission)
{
$result = $this->db->query("SELECT `admin_roles`.`permission` FROM `admin_roles` WHERE `admin_roles`.`admin_role_id` = ".$roleId)->getRow();
//print_r($result->permission);
$obj = json_decode($result->permission, true);
return $obj[$module_name][$sub_permission];
}


public function module_permission_list($role_id, $module_name)
{

$result = $this->db->query("SELECT `permission` FROM `admin_roles` WHERE `admin_role_id` = ".$role_id)->getRow();
$obj = json_decode($result->permission, true);
return $obj[$module_name];
}


}