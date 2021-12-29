<?php

function DB()
{
    $db = \Config\Database::connect();
    return $db;
}

function Cart(){
    $ca = \Config\Services::cart();
    return $ca;
}

function priceSymbol($amount){
    $symbol = 'TK.';
    $data = $symbol.''.$amount;
    return $data;

}

function newSession()
{
    $session = \Config\Services::session();
    return $session;
}

function getShortContent($long_text = '', $show = 100)
{

    $filtered_text = strip_tags($long_text);
    if ($show < strlen($filtered_text)) {
        return substr($filtered_text, 0, $show) . '...';
    } else {
        return $filtered_text;
    }
}


function statusView($selected = '1')
{
    $status = [
        '0' => 'Inactive',
        '1' => 'Active',
    ];

    $row = '';
    foreach ($status as $key => $option) {
        $row .= ($selected == $key) ? $option : '';
    }
    return $row;
}

function globalStatus($selected = 'sel')
{
    $status = [
        'sel' => '--Select--',
        '1' => 'Active',
        '0' => 'Inactive',
    ];

    $row = '';
    foreach ($status as $key => $option) {
        $row .= '<option value="' . $key . '"';
        $row .= ($selected == $key) ? ' selected' : '';
        $row .= '>' . $option . '</option>';
    }
    return $row;
}

function getLoginUserData($key = '')
{
    //key: user_id, user_mail, role_id, name, photo
    $data = &get_instance();
    $global = json_decode(base64_decode($data->input->cookie('fm_login_data', false)));
    return isset($global->$key) ? $global->$key : null;
}

function numericDropDown($i = 0, $end = 12, $incr = 1, $selected = 0)
{
    $option = '';
    for ($i; $i <= $end; $i += $incr) {
        $option .= '<option value="' . $i . '"';
        $option .= ($selected == $i) ? ' selected' : '';
        $option .= '>' . sprintf('%02d', $i) . '</option>';
    }
    return $option;
}

function htmlRadio($name = 'input_radio', $selected = '', $array = ['Male' => 'Male', 'Female' => 'Female'])
{
    $radio = '';
    $id = 0;

    if (count($array)) {
        foreach ($array as $key => $value) {
            $id++;
            $radio .= '<label>';
            $radio .= '<input type="radio" name="' . $name . '" id="' . $name . '_' . $id . '"';
            $radio .= (trim($selected) === $key) ? ' checked ' : '';
            $radio .= 'value="' . $key . '" /> ' . $value;
            $radio .= '&nbsp;&nbsp;&nbsp;</label>';
        }
    }
    return $radio;
}


function getListInOption($selected, $tblId, $needCol, $table)
{
    $db = \Config\Database::connect();
    $tabledta = $db->table($table);
    $query = $tabledta->get();
    $options = '';
    foreach ($query->getResult() as $value) {
        $options .= '<option value="' . $value->$tblId . '" ';
        $options .= ($value->$tblId == $selected) ? ' selected="selected"' : '';
        $options .= '>' . $value->$needCol . '</option>';
    }
    return $options;
}


function getListInOptionCheckLicens($selected, $tblId, $needCol, $table)
{
    $CI =& get_instance();
    $query = $CI->db->query("SELECT * FROM `" . $table . "`");
    $options = '';
    foreach ($query->result() as $value) {
        if ($value->status != 1) {
            $options .= '<option value="' . $value->$tblId . '" ';
            $options .= ($value->$tblId == $selected) ? ' selected="selected"' : '';
            $options .= '>' . $value->$needCol . '</option>';
        }
    }
    return $options;
}


function getSectionListByClass($selected, $tblId, $table, $class)
{
    $CI =& get_instance();
    $query = $CI->db->query("SELECT * FROM `" . $table . "`");
    $options = '';
    foreach ($query->result() as $value) {
        $options .= '<option value="' . $value->$tblId . '" ';
        $options .= ($value->$tblId == $selected) ? ' selected="selected"' : '';
        $options .= '>' . $value->name . '/' . $value->nick_name . '</option>';
    }
    return $options;
}


function getAllListInOption($selected, $tblId, $needCol, $table)
{
    $CI =& get_instance();
    $query = $CI->db->query("SELECT * FROM `" . $table . "`WHERE `deleted` IS NULL AND `sch_id` = " . $_SESSION['shopId']);
    $options = '';
    foreach ($query->result() as $value) {
        $options .= '<option value="' . $value->$tblId . '" ';
        $options .= ($value->$tblId == $selected) ? ' selected="selected"' : '';
        $options .= '>' . $value->$needCol . '</option>';
    }
    return $options;
}

function getTwoValueInOption($selected, $tblId, $needCol, $needCol2, $table)
{
    $CI =& get_instance();
    $query = $CI->db->query("SELECT * FROM `" . $table . "` WHERE `deleted` IS NULL AND `sch_id` = " . $_SESSION['shopId']);
    $options = '';
    foreach ($query->result() as $value) {
        $options .= '<option value="' . $value->$tblId . '" ';
        $options .= ($value->$tblId == $selected) ? ' selected="selected"' : '';
        $options .= '>' . $value->$needCol . '--' . $value->$needCol2 . '</option>';
    }
    return $options;
}


function getCatListInOption($selected, $tblId, $needCol, $table)
{
    $CI =& get_instance();
    $query = $CI->db->get_where($table, array('parent_pro_cat' => 0, 'sch_id' => $_SESSION['shopId'], "status !=" => 1, "deleted" => null));
    $options = '';
    foreach ($query->result() as $value) {
        $options .= '<option value="' . $value->$tblId . '" ';
        $options .= ($value->$tblId == $selected) ? ' selected="selected"' : '';
        $options .= '>' . $value->$needCol . '</option>';
    }
    return $options;
}

function getCatListInOptionsuper($selected, $tblId, $needCol, $table)
{
    $db = \Config\Database::connect();
    $tabledta = $db->table($table);
    $query = $tabledta->where('parent_cat_id', 0)->get();
    $options = '';
    foreach ($query->getResult() as $value) {
        $options .= '<option value="' . $value->$tblId . '" ';
        $options .= ($value->$tblId == $selected) ? ' selected="selected"' : '';
        $options .= '>' . $value->$needCol . '</option>';
    }
    return $options;
}


function subCategoryListOption($selected)
{
    $CI =& get_instance();
    $query = $CI->db->get_where('product_category', array('parent_pro_cat' => 0, 'sch_id' => $_SESSION['shopId'], "status !=" => 1, "deleted" => null));

    $options = '';
    foreach ($query->result() as $value) {
        $options .= '<option value="' . $value->prod_cat_id . '" ';
        $options .= ($value->prod_cat_id == $selected) ? ' selected="selected"' : '';
        $options .= '>' . $value->product_category . '</option>';
    }
    return $options;
}


function subCategoryListOptionSuper($selected)
{
    $CI =& get_instance();
    $query = $CI->db->get_where('demo_category', array('parent_pro_cat' => 0));

    $options = '';
    foreach ($query->result() as $value) {
        $options .= '<option value="' . $value->cat_id . '" ';
        $options .= ($value->cat_id == $selected) ? ' selected="selected"' : '';
        $options .= '>' . $value->product_category . '</option>';
    }
    return $options;
}

function categoryListInOption($categoryId)
{
    $CI =& get_instance();
    $query = $CI->db->get_where('product_category', array('parent_pro_cat' => 0, 'sch_id' => $_SESSION['shopId'], "status !=" => 1, "deleted" => null));

    $catId = get_data_by_id('parent_pro_cat', 'product_category', 'prod_cat_id', $categoryId);

    $options = '';
    if (!empty($catId)) {
        foreach ($query->result() as $value) {
            $options .= '<option value="' . $value->prod_cat_id . '" ';
            $options .= ($value->prod_cat_id == $catId) ? ' selected="selected"' : '';
            $options .= '>' . $value->product_category . '</option>';
        }
    } else {
        foreach ($query->result() as $value) {
            $options .= '<option value="' . $value->prod_cat_id . '" ';
            $options .= ($value->prod_cat_id == $categoryId) ? ' selected="selected"' : '';
            $options .= '>' . $value->product_category . '</option>';
        }
    }

    return $options;

}

function categoryListInOptionsuper($categoryId)
{
    $CI =& get_instance();
    $query = $CI->db->get_where('demo_category', array('parent_pro_cat' => 0));

    $catId = get_data_by_id('parent_pro_cat', 'demo_category', 'cat_id', $categoryId);

    $options = '';
    if (!empty($catId)) {
        foreach ($query->result() as $value) {
            $options .= '<option value="' . $value->cat_id . '" ';
            $options .= ($value->cat_id == $catId) ? ' selected="selected"' : '';
            $options .= '>' . $value->product_category . '</option>';
        }
    } else {
        foreach ($query->result() as $value) {
            $options .= '<option value="' . $value->cat_id . '" ';
            $options .= ($value->cat_id == $categoryId) ? ' selected="selected"' : '';
            $options .= '>' . $value->product_category . '</option>';
        }
    }

    return $options;

}

function subCatListInOption($categoryId)
{
    $CI =& get_instance();
    $catId = get_data_by_id('parent_pro_cat', 'product_category', 'prod_cat_id', $categoryId);

    $query = $CI->db->get_where('product_category', array('parent_pro_cat' => $catId, 'sch_id' => $_SESSION['shopId'], "deleted" => null));


    $options = '';
    if (!empty($catId)) {

        foreach ($query->result() as $value) {
            $options .= '<option value="' . $value->prod_cat_id . '" ';
            $options .= ($value->prod_cat_id == $categoryId) ? ' selected="selected"' : '';
            $options .= '>' . $value->product_category . '</option>';
        }
    } else {

    }

    return $options;

}

function subCatListInOptionsuper($categoryId)
{
    $CI =& get_instance();
    $catId = get_data_by_id('parent_pro_cat', 'demo_category', 'cat_id', $categoryId);

    $query = $CI->db->get_where('demo_category', array('parent_pro_cat' => $catId));

    $options = '';
    if (!empty($catId)) {

        foreach ($query->result() as $value) {
            $options .= '<option value="' . $value->cat_id . '" ';
            $options .= ($value->cat_id == $categoryId) ? ' selected="selected"' : '';
            $options .= '>' . $value->product_category . '</option>';
        }
    } else {

    }

    return $options;

}

function getSubjectListByClassSection($selected, $classId, $sectionId)
{
    $CI =& get_instance();
    $query = $CI->db->query("SELECT * FROM `subject` WHERE `sch_id` = " . $_SESSION['schoolId'] . " AND `class_id` = " . $classId . " AND `section_id` = " . $sectionId);
    $options = '';
    foreach ($query->result() as $value) {
        $options .= '<option value="' . $value->subject_id . '" ';
        $options .= ($value->subject_id == $selected) ? ' selected="selected"' : '';
        $options .= '>' . $value->name . '</option>';
    }
    return $options;
}


function showDataFromArray($selected = '', $array = null)
{

    $result = '';
    if (count($array)) {
        foreach ($array as $key => $value) {
            $result .= ($key == $selected) ? $value : '';
        }
    }
    return $result;
}

/*
 * We will use it into header.php or footer.php or any view page
 * to load module wise css or js file
 */

function load_module_asset($module = null, $type = 'css', $script = null)
{

    $file = ($type == 'css') ? 'style.css.php' : 'script.js.php';
    if ($script) {
        $file = $script;
    }

    $path = APPPATH . '/modules/' . $module . '/assets/' . $file;
    if ($module && file_exists($path)) {
        include($path);
    }
}


function ageCalculator($date = null)
{
    if ($date) {
        $tz = new DateTimeZone('Europe/London');
        $age = DateTime::createFromFormat('Y-m-d', $date, $tz)
            ->diff(new DateTime('now', $tz))
            ->y;
        return $age . ' years';
    } else {
        return 'Unknown';
    }
}

function sinceCalculator($date = null)
{

    if ($date) {

        $date = date('Y-m-d', strtotime($date));
        $tz = new DateTimeZone('Europe/London');
        $age = DateTime::createFromFormat('Y-m-d', $date, $tz)
            ->diff(new DateTime('now', $tz));

        $result = '';
        $result .= ($age->y) ? $age->y . 'y ' : '';
        $result .= ($age->m) ? $age->m . 'm ' : '';
        $result .= ($age->d) ? $age->d . 'd ' : '';
        $result .= ($age->h) ? $age->h . 'h ' : '';
        return $result;
    } else {
        return 'Unknown';
    }
}

function password_encription($string = '')
{
    return password_hash($string, PASSWORD_BCRYPT);
}


function get_admin_email()
{
    return getSettingItem('IncomingEmail');
}

function getSettingItem($setting_key = null)
{
    $ci = &get_instance();
    $setting = $ci->db->get_where('gen_settings', array('label' => $setting_key, 'sch_id' => $_SESSION['shopId']))->row();
    return isset($setting->value) ? $setting->value : false;
}

function userStatus($selected = null)
{
    $status = ['Pending', 'Active', 'Inactive'];
    $options = '';
    foreach ($status as $row) {
        $options .= '<option value="' . $row . '" ';
        $options .= ($row == $selected) ? 'selected="selected"' : '';
        $options .= '>' . $row . '</option>';
    }
    return $options;
}


function bdDateFormat($data = '0000-00-00')
{
    return ($data == '0000-00-00') ? 'Unknown' : date('d/m/y', strtotime($data));
}

function isCheck($checked = 0, $match = 1)
{
    $checked = ($checked);
    return ($checked == $match) ? 'checked="checked"' : '';
}

function getCurrency($selected = '&pound')
{
    $codes = [
        '&pound' => "&pound; GBP",
        '&dollar' => "&dollar; USD",
        '&nira' => "&#x20A6; NGN"
    ];

    $row = '<select name="data[Setting][Currency]" class="form-control">';
    foreach ($codes as $key => $option) {
        $row .= '<option value="' . htmlentities($key) . '"';
        $row .= ($selected == $key) ? ' selected' : '';
        $row .= '>' . $option . '</option>';
    }
    $row .= '</select>';
    return $row;
}


function showWithCurrencySymbol($money)
{
    $ci = &get_instance();
    $currency_before_symbol = $ci->db->get_where('gen_settings', ['label' => "currency_before_symbol"])->row();
    $currency_after_symbol = $ci->db->get_where('gen_settings', ['label' => "currency_after_symbol"])->row();
    $result = $currency_before_symbol->value . " " . number_format($money, 2, '.', ',') . " " . $currency_after_symbol->value;
    return $result;
}

function showWithCurrencySymbolInvoice($money)
{
    $ci = &get_instance();
    $result = "৳ " . $money . " /=";
    return $result;
}

function showWithPhoneNummberCountryCode($number)
{
    $ci = &get_instance();
    $phoneCode = $ci->db->get_where('gen_settings', ['label' => "phone_code"])->row();
    $result = $phoneCode->value . " " . $number;
    return $result;
}


function globalDateTimeFormat($datetime = '0000-00-00 00:00:00')
{

    if ($datetime == '0000-00-00 00:00:00' or $datetime == '0000-00-00' or $datetime == '') {
        return 'Unknown';
    }
    return date('h:i A d/m/y', strtotime($datetime));
}

function invoiceDateFormat($datetime = '0000-00-00 00:00:00')
{

    if ($datetime == '0000-00-00 00:00:00' or $datetime == '0000-00-00' or $datetime == '') {
        return 'Unknown';
    }
    return date('d M Y h:i A ', strtotime($datetime));
}

function saleDate($datetime = '0000-00-00 00:00:00')
{

    if ($datetime == '0000-00-00 00:00:00' or $datetime == '0000-00-00' or $datetime == '') {
        return 'Unknown';
    }

    $date = date('d/m/y', strtotime($datetime));
    $time = date('h:i a', strtotime($datetime));

    return $date . '<br/>' . $time;
}

function monthDateFormat($datetime = '0000-00-00 00:00:00')
{

    if ($datetime == '0000-00-00 00:00:00' or $datetime == '0000-00-00' or $datetime == '') {
        return 'Unknown';
    }
    return date(' M Y ', strtotime($datetime));
}

function get_amount_by_commision($amount)
{
    $sup_comm = get_data_by_id('sup_comm', 'shops', 'sch_id', $_SESSION['shopId']);
    $commision = ($amount * $sup_comm) / 100;

    return showWithCurrencySymbol($commision);
}

function globalTimeStamp($datetime = '0000-00-00 00:00:00')
{
    return date('d-M-y - h:i A ', strtotime($datetime));
}

function globalDateFormat($datetime = '0000-00-00 00:00:00')
{

    if ($datetime == '0000-00-00 00:00:00' or $datetime == '0000-00-00' or $datetime == null) {
        return 'Unknown';
    }
    return date('d M y', strtotime($datetime));
}

function globalTimeOnly($datetime = '0000-00-00 00:00:00')
{

    if ($datetime == '0000-00-00 00:00:00' or $datetime == '0000-00-00' or $datetime == null) {
        return 'Unknown';
    }
    return date('h:i A', strtotime($datetime));
}

function returnJSON($array = [])
{
    return json_encode($array);
}

function ajaxRespond($status = 'FAIL', $msg = 'Fail! Something went wrong')
{
    return returnJSON(['Status' => strtoupper($status), 'Msg' => $msg]);
}

function ajaxAuthorized()
{
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        return true;
    } else {
        //die( ajaxRespond('Fail', 'Access Forbidden') );

        $html = '';
        $html .= '<center>';
        $html .= '<h1 style="color:red;">Access Denied !</h1>';
        $html .= '<hr>';
        $html .= '<p>It seems that you might come here via an unauthorised way</p>';
        $html .= '</center>';

        die($html);
    }
}

function globalCurrencyFormat($string = 0, $prefix = '৳ ', $sufix = '')
{

    if (is_null($string) or empty($string)) {
        return 0 . $sufix;
    } else {
        //return $prefix . number_format($string, 0 ) . $sufix;
        return number_format($string, 2) . $sufix;
    }
}

function bdContactNumber($contact = null)
{

    if ($contact && strlen($contact) == 11) {
        return substr($contact, 0, 5) . '-' . substr($contact, 5, 3) . '-' . substr($contact, 8, 3);
    } else {
        return $contact;
    }
}

function getPaginatorLimiter($selected = 100)
{
    $range = [100, 500, 1000, 2000, 5000];
    $option = '';
    foreach ($range as $limit) {
        $option .= '<option';
        $option .= ($selected == $limit) ? ' selected' : '';
        $option .= '>' . $limit . '</option>';
    }
    return $option;
}


function formatNumberToText($tk = 0, $extension = 'BDT')
{
    $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
    return $f->format($tk) . $extension;
}

function convertNumberToWord($num = false)
{
    //$price = new NumbersToWords();
    //return  $price->convert( $num );
    return convert_number($num);
}


function get_data_by_id($needCol, $table, $whereCol, $whereInfo)
{
    $db = \Config\Database::connect();
    $tabledta = $db->table($table);
    $findResult = $tabledta->select($needCol)->where($whereCol, $whereInfo)->countAllResults();
    $result = $tabledta->select($needCol)->where($whereCol, $whereInfo)->get()->getRow();
    if ($findResult > 0) {
        $col = ($result->$needCol == NULL) ? NULL : $result->$needCol;
    } else {
        $col = '';
    }
    return $col;
}

function get_total_student_count_by_parentID($parentID)
{
    $CI =& get_instance();
    $result = $CI->db->query("SELECT * FROM `student` WHERE `parent_id` = " . $parentID)->num_rows();
    return $result;

}


function profile_image()
{
    $CI =& get_instance();

    $shopId = isset($_SESSION['shopId']) ? $_SESSION['shopId'] : "0";

    if ($shopId != 0) {
        $query = $CI->db->query("SELECT `image` FROM `shops` WHERE `sch_id` = " . $shopId)->row();
        $result = $query->image;
    } else {
        $result = "#";
    }
    return $result;
}


function profile_name()
{
    $CI =& get_instance();

    $shopId = isset($_SESSION['shopId']) ? $_SESSION['shopId'] : "0";

    if ($shopId != 0) {
        $query = $CI->db->query("SELECT `name` FROM `shops` WHERE `sch_id` = " . $shopId)->row();

        $result = $query->name;

    } else {
        $result = "#";
    }
    return $result;
}


function logo_image()
{
    $CI =& get_instance();

    $shopId = isset($_SESSION['shopId']) ? $_SESSION['shopId'] : "0";

    if ($shopId != 0) {
        $query = $CI->db->query("SELECT `logo` FROM `shops` WHERE `sch_id`= " . $shopId)->row();
        if (!empty($query->logo)) {
            $result = $query->logo;
        } else {
            $result = "logo_1595506436.jpg";
        }
    } else {
        $result = "logo_1595506436.jpg";
    }
    return $result;
}

function logo_image_sup($shopId)
{
    $CI =& get_instance();

    if ($shopId != 0) {
        $query = $CI->db->query("SELECT `logo` FROM `shops` WHERE `sch_id`= " . $shopId)->row();
        $result = $query->logo;
    } else {
        $result = "#";
    }
    return $result;
}

function parents_name_by_userID($name)
{
    $CI =& get_instance();

    $result = $CI->db->query("SELECT `parent_id` FROM `parents` WHERE `name` = '" . $name . "'")->row();
    $col = $result->parent_id;
    return $col;

}

function parents_userID_by_name($parent_id)
{
    $CI =& get_instance();

    $query = $CI->db->query("SELECT `name` FROM `parents` WHERE `parent_id` = '" . $parent_id . "'");

    $result = $query->num_rows();

    if ($result == 0) {
        $data = "No parent selected";
    } else {
        $data = $query->row()->name;
    }

    return $data;

}

function admin_cash()
{
    $CI =& get_instance();
    $result = '';
    if (!empty($_SESSION['shopId'])) {
        $CI->db->select("cash");
        $query = $CI->db->get_where("shops", array("sch_id" => $_SESSION['shopId']));
        $result = $query->num_rows();
    }

    if ($result == 0) {
        $data = "No Cash Available";
    } else {
        $data = showWithCurrencySymbol($query->row()->cash);
    }
    return $data;
}


function getBankBalance($bankID)
{
    $CI =& get_instance();
    $CI->db->select("balance");
    $query = $CI->db->get_where("bank", array("bank_id" => $bankID, "sch_id" => $_SESSION['shopId']));
    $result = $query->num_rows();
    if ($result == 0) {
        $data = "No available balance";
    } else {
        $data = $query->row()->balance;
    }
    return $data;
}


function data_exist($data)
{
    $view = $data ? $data : '<span style="color: #999; "><i>Not Set</i></span>';

    return $view;
}


function checkBankBalance($bankID, $requiredBalance)
{
    $CI =& get_instance();
    $CI->db->select("balance");
    $query = $CI->db->get_where("bank", array("bank_id" => $bankID, "sch_id" => $_SESSION['shopId']));
    $result = $query->num_rows();
    if ($result == 0) {
        $data = false;
    } else {
        $balance = $query->row()->balance;
        if ($balance >= $requiredBalance) {
            $data = true;
        } else {
            $data = false;
        }
    }
    return $data;
}

function checkNagadBalance($requiredBalance)
{
    $CI =& get_instance();
    $CI->db->select("cash");
    $query = $CI->db->get_where("shops", array("sch_id" => $_SESSION['shopId']));
    $result = $query->num_rows();
    if ($result == 0) {
        $data = false;
    } else {
        $balance = $query->row()->cash;
        $reserveCash = $query->row()->reserve_cash;

        $lastBalance = $balance - $reserveCash;

        if ($lastBalance >= $requiredBalance) {
            $data = true;
        } else {
            $data = false;
        }
    }
    return $data;
}

function numberTowords($number)
{
    $words = array(
        '0' => '', '1' => 'one', '2' => 'two', '3' => 'three', '4' => 'four', '5' => 'five',
        '6' => 'six', '7' => 'seven', '8' => 'eight', '9' => 'nine', '10' => 'ten',
        '11' => 'eleven', '12' => 'twelve', '13' => 'thirteen', '14' => 'fouteen', '15' => 'fifteen',
        '16' => 'sixteen', '17' => 'seventeen', '18' => 'eighteen', '19' => 'nineteen', '20' => 'twenty',
        '30' => 'thirty', '40' => 'fourty', '50' => 'fifty', '60' => 'sixty', '70' => 'seventy',
        '80' => 'eighty', '90' => 'ninty');

    //First find the length of the number
    $number_length = strlen($number);
    //Initialize an empty array
    $number_array = array(0, 0, 0, 0, 0, 0, 0, 0, 0);
    $received_number_array = array();

    //Store all received numbers into an array
    for ($i = 0; $i < $number_length; $i++) {
        $received_number_array[$i] = substr($number, $i, 1);
    }

    //Populate the empty array with the numbers received - most critical operation
    for ($i = 9 - $number_length, $j = 0; $i < 9; $i++, $j++) {
        $number_array[$i] = $received_number_array[$j];
    }

    $number_to_words_string = "";

    for ($i = 0, $j = 1; $i < 9; $i++, $j++) {
        if ($i == 0 || $i == 2 || $i == 4 || $i == 7) {
            if ($number_array[$j] == 0 || $number_array[$i] == "1") {
                $number_array[$j] = intval($number_array[$i]) * 10 + $number_array[$j];
                $number_array[$i] = 0;
            }

        }
    }

    $value = "";
    for ($i = 0; $i < 9; $i++) {
        if ($i == 0 || $i == 2 || $i == 4 || $i == 7) {
            $value = $number_array[$i] * 10;
        } else {
            $value = $number_array[$i];
        }
        if ($value != 0) {
            $number_to_words_string .= $words["$value"] . " ";
        }
        if ($i == 1 && $value != 0) {
            $number_to_words_string .= "Crores ";
        }
        if ($i == 3 && $value != 0) {
            $number_to_words_string .= "Lakhs ";
        }
        if ($i == 5 && $value != 0) {
            $number_to_words_string .= "Thousand ";
        }
        if ($i == 6 && $value != 0) {
            $number_to_words_string .= "Hundred ";
        }

    }
    if ($number_length > 9) {
        $number_to_words_string = "Sorry This does not support more than 99 Crores";
    }
    return ucwords(strtolower($number_to_words_string));
}


// suppliers Total Purchase Amount
function suppliersTotalPurchaseAmount($supplierId)
{
    $CI =& get_instance();
    $CI->db->select_sum("amount");
    $query = $CI->db->get_where("ledger_suppliers", array("supplier_id" => $supplierId, "sch_id" => $_SESSION['shopId'], "trangaction_type" => 'Dr.'));
    $result = $query->num_rows();
    if ($result != 0) {
        $balance = showWithCurrencySymbol($query->row()->amount);
    } else {
        $balance = "No Pursess Available Amount";
    }
    return $balance;
}

//Customer Total Sale Amount
function CustomerTotalSaleAmount($customerId)
{
    $CI =& get_instance();
    $CI->db->select_sum("amount");
    $query = $CI->db->get_where("ledger", array("customer_id" => $customerId, "sch_id" => $_SESSION['shopId'], "trangaction_type" => 'Cr.'));
    $result = $query->num_rows();
    if ($result != 0) {
        $balance = showWithCurrencySymbol($query->row()->amount);
    } else {
        $balance = "No Pursess Available Amount";
    }
    return $balance;
}

function transaction_type_message($type)
{
    if ($type == 'Cr.') {
        $row = 'খরচ (Cr.)';
    } else {
        $row = 'জমা (Dr.)';
    }
    return $row;
}


function checkUniqueField($value, $colam, $table)
{
    $CI =& get_instance();


    $query = $CI->db->query("SELECT `" . $colam . "` FROM `" . $table . "` WHERE `" . $colam . "` =  '" . $value . "' AND `deleted` IS NULL ");

    $result = $query->num_rows();

    if ($result == 0) {
        $data = true;
    } else {
        $data = false;
    }

    return $data;
}

function getRoleIdListInOption($selected, $tblId, $needCol, $table)
{
    $CI =& get_instance();
    $shopId = $_SESSION['shopId'];

    $query = $CI->db->query("SELECT * FROM `" . $table . "` WHERE `sch_id` = " . $shopId);
    $options = '';
    foreach ($query->result() as $value) {
        if ($value->$tblId != 1) {
            $options .= '<option value="' . $value->$tblId . '" ';
            $options .= ($value->$tblId == $selected) ? ' selected="selected"' : '';
            $options .= '>' . $value->$needCol . '</option>';
        }

    }
    return $options;
}

function is_default($Id, $col, $table)
{
    $CI =& get_instance();
    $query = $CI->db->query("SELECT `is_default` FROM `" . $table . "` WHERE `" . $col . "` = " . $Id);
    return $query->row()->is_default;
}

function get_total_nogodBalance($tbl, $sumRow, $trnsType, $start_date = 0, $end_date = 0)
{
    $CI =& get_instance();
    $shopId = $_SESSION['shopId'];
    $query = $CI->db->select_sum($sumRow)->get_where($tbl, array('trangaction_type' => $trnsType, 'sch_id' => $shopId))->row()->$sumRow;
    if (($start_date == 0) && ($end_date == 0)) {
        $query = $CI->db->select_sum($sumRow)->get_where($tbl, array('trangaction_type' => $trnsType, 'sch_id' => $shopId))->row()->$sumRow;
    } else {
        $query = $CI->db->select_sum($sumRow)->get_where($tbl, array('trangaction_type' => $trnsType, 'sch_id' => $shopId, 'createdDtm >=' => $start_date . ' 00:00:00', 'createdDtm <=' => $end_date . ' 23:59:59'))->row()->$sumRow;
    }

    return $query;

}

function get_total($tbl, $sumRow, $trnsType, $wherId, $byId, $start_date = 0, $end_date = 0)
{
    $CI =& get_instance();
    //$shopId = $_SESSION['shopId'];
    if (($start_date == 0) && ($end_date == 0)) {
        $query = $CI->db->select_sum($sumRow)->get_where($tbl, array('trangaction_type' => $trnsType, $wherId => $byId))->row()->$sumRow;
    } else {
        $query = $CI->db->select_sum($sumRow)->get_where($tbl, array('trangaction_type' => $trnsType, $wherId => $byId, 'createdDtm >=' => $start_date . ' 00:00:00', 'createdDtm <=' => $end_date . ' 23:59:59'))->row()->$sumRow;
    }

    return $query;
}

//unite Function (start)
function unitArray()
{
    $status = [
        '1' => 'Piece',
         '2' => 'KG',
         '3' => 'LETTER',
         '4' => 'TON'
    ];
    return $status;
}

function unitInOptionArray($selec = '1')
{
    $status = [
        '1' => 'Piece',
        '2' => 'KG',
        '3' => 'LETTER',
        '4' => 'TON'
    ];
    $options = '';
    foreach ($status as $key => $value) {
        $options .= '<option value="' . $key . '" ';
        $options .= ($key == $selec) ? ' selected="selected"' : '';
        $options .= '>' . $value . '</option>';
    }
    return $options;
}

function productTypeInOption($selec = '0')
{
    $status = [
        '1' => 'Regular',
        '2' => 'Temporary',
    ];
    $options = '';
    foreach ($status as $key => $value) {
        $options .= '<option value="' . $key . '" ';
        $options .= ($key == $selec) ? ' selected="selected"' : '';
        $options .= '>' . $value . '</option>';
    }
    return $options;
}

function showUnitName($selected = '1')
{
    $status = unitArray();
    $row = $status[$selected];
    return $row;
}

//unite Function (end)

function selectOptions($selected = '', $array = null)
{

    $options = '';
    if (count($array)) {
        foreach ($array as $key => $value) {
            $options .= '<option value="' . $key . '" ';
            $options .= ($key == $selected) ? ' selected="selected"' : '';
            $options .= '>' . $value . '</option>';
        }
    }
    return $options;
}


function profile_image_super($Id)
{
    $CI =& get_instance();

    //$userIdSuper = $this->session->userdata(userIdSuper);

    if ($Id != 0) {
        $query = $CI->db->query("SELECT `pic` FROM `admin` WHERE `user_id` = " . $Id)->row();

        $result = $query->pic;

    } else {
        $result = "#";
    }
    return $result;
}


function subCatSaleInOption($categoryId)
{
    $CI =& get_instance();
    $catId = get_data_by_id('parent_pro_cat', 'product_category', 'prod_cat_id', $categoryId);

    $query = $CI->db->get_where('product_category', array('parent_pro_cat' => $categoryId, 'sch_id' => $_SESSION['shopId'], "deleted" => null));

    $options = '';
    foreach ($query->result() as $value) {
        $options .= '<option value="' . $value->prod_cat_id . '">' . $value->product_category . '</option>';
    }


    return $options;

}


function divisionView($selected = 0)
{
    $divisions = array(
        array('id' => '1', 'name' => 'Chattagram', 'bn_name' => 'চট্টগ্রাম', 'url' => 'www.chittagongdiv.gov.bd'),
        array('id' => '2', 'name' => 'Rajshahi', 'bn_name' => 'রাজশাহী', 'url' => 'www.rajshahidiv.gov.bd'),
        array('id' => '3', 'name' => 'Khulna', 'bn_name' => 'খুলনা', 'url' => 'www.khulnadiv.gov.bd'),
        array('id' => '4', 'name' => 'Barisal', 'bn_name' => 'বরিশাল', 'url' => 'www.barisaldiv.gov.bd'),
        array('id' => '5', 'name' => 'Sylhet', 'bn_name' => 'সিলেট', 'url' => 'www.sylhetdiv.gov.bd'),
        array('id' => '6', 'name' => 'Dhaka', 'bn_name' => 'ঢাকা', 'url' => 'www.dhakadiv.gov.bd'),
        array('id' => '7', 'name' => 'Rangpur', 'bn_name' => 'রংপুর', 'url' => 'www.rangpurdiv.gov.bd'),
        array('id' => '8', 'name' => 'Mymensingh', 'bn_name' => 'ময়মনসিংহ', 'url' => 'www.mymensinghdiv.gov.bd')
    );

    $row = '';
    foreach ($divisions as $rows) {
        $row .= '<option value="' . $rows['id'] . '"';
        $row .= ($rows['id'] == $selected) ? ' selected="selected"' : '';
        $row .= '>' . $rows['name'] . '</option>';
    }
    return $row;
}


function divisionname($id)
{
    $divisions = array(
        array('id' => '1', 'name' => 'Chattagram', 'bn_name' => 'চট্টগ্রাম', 'url' => 'www.chittagongdiv.gov.bd'),
        array('id' => '2', 'name' => 'Rajshahi', 'bn_name' => 'রাজশাহী', 'url' => 'www.rajshahidiv.gov.bd'),
        array('id' => '3', 'name' => 'Khulna', 'bn_name' => 'খুলনা', 'url' => 'www.khulnadiv.gov.bd'),
        array('id' => '4', 'name' => 'Barisal', 'bn_name' => 'বরিশাল', 'url' => 'www.barisaldiv.gov.bd'),
        array('id' => '5', 'name' => 'Sylhet', 'bn_name' => 'সিলেট', 'url' => 'www.sylhetdiv.gov.bd'),
        array('id' => '6', 'name' => 'Dhaka', 'bn_name' => 'ঢাকা', 'url' => 'www.dhakadiv.gov.bd'),
        array('id' => '7', 'name' => 'Rangpur', 'bn_name' => 'রংপুর', 'url' => 'www.rangpurdiv.gov.bd'),
        array('id' => '8', 'name' => 'Mymensingh', 'bn_name' => 'ময়মনসিংহ', 'url' => 'www.mymensinghdiv.gov.bd')
    );

    $row = '';
    foreach ($divisions as $rows) {
        if ($rows['id'] == $id) {
            $row .= $rows['name'];
        }
    }
    return $row;
}



function division()
{
    $divisions = array(
        array('id' => '1', 'name' => 'Chattagram', 'bn_name' => 'চট্টগ্রাম', 'url' => 'www.chittagongdiv.gov.bd'),
        array('id' => '2', 'name' => 'Rajshahi', 'bn_name' => 'রাজশাহী', 'url' => 'www.rajshahidiv.gov.bd'),
        array('id' => '3', 'name' => 'Khulna', 'bn_name' => 'খুলনা', 'url' => 'www.khulnadiv.gov.bd'),
        array('id' => '4', 'name' => 'Barisal', 'bn_name' => 'বরিশাল', 'url' => 'www.barisaldiv.gov.bd'),
        array('id' => '5', 'name' => 'Sylhet', 'bn_name' => 'সিলেট', 'url' => 'www.sylhetdiv.gov.bd'),
        array('id' => '6', 'name' => 'Dhaka', 'bn_name' => 'ঢাকা', 'url' => 'www.dhakadiv.gov.bd'),
        array('id' => '7', 'name' => 'Rangpur', 'bn_name' => 'রংপুর', 'url' => 'www.rangpurdiv.gov.bd'),
        array('id' => '8', 'name' => 'Mymensingh', 'bn_name' => 'ময়মনসিংহ', 'url' => 'www.mymensinghdiv.gov.bd')
    );

    return $divisions;
}

function districtView()
{
    $districts = array(
        array('id' => '1', 'division_id' => '1', 'name' => 'Comilla', 'bn_name' => 'কুমিল্লা', 'lat' => '23.4682747', 'lon' => '91.1788135', 'url' => 'www.comilla.gov.bd'),
        array('id' => '2', 'division_id' => '1', 'name' => 'Feni', 'bn_name' => 'ফেনী', 'lat' => '23.023231', 'lon' => '91.3840844', 'url' => 'www.feni.gov.bd'),
        array('id' => '3', 'division_id' => '1', 'name' => 'Brahmanbaria', 'bn_name' => 'ব্রাহ্মণবাড়িয়া', 'lat' => '23.9570904', 'lon' => '91.1119286', 'url' => 'www.brahmanbaria.gov.bd'),
        array('id' => '4', 'division_id' => '1', 'name' => 'Rangamati', 'bn_name' => 'রাঙ্গামাটি', 'lat' => NULL, 'lon' => NULL, 'url' => 'www.rangamati.gov.bd'),
        array('id' => '5', 'division_id' => '1', 'name' => 'Noakhali', 'bn_name' => 'নোয়াখালী', 'lat' => '22.869563', 'lon' => '91.099398', 'url' => 'www.noakhali.gov.bd'),
        array('id' => '6', 'division_id' => '1', 'name' => 'Chandpur', 'bn_name' => 'চাঁদপুর', 'lat' => '23.2332585', 'lon' => '90.6712912', 'url' => 'www.chandpur.gov.bd'),
        array('id' => '7', 'division_id' => '1', 'name' => 'Lakshmipur', 'bn_name' => 'লক্ষ্মীপুর', 'lat' => '22.942477', 'lon' => '90.841184', 'url' => 'www.lakshmipur.gov.bd'),
        array('id' => '8', 'division_id' => '1', 'name' => 'Chattogram', 'bn_name' => 'চট্টগ্রাম', 'lat' => '22.335109', 'lon' => '91.834073', 'url' => 'www.chittagong.gov.bd'),
        array('id' => '9', 'division_id' => '1', 'name' => 'Coxsbazar', 'bn_name' => 'কক্সবাজার', 'lat' => NULL, 'lon' => NULL, 'url' => 'www.coxsbazar.gov.bd'),
        array('id' => '10', 'division_id' => '1', 'name' => 'Khagrachhari', 'bn_name' => 'খাগড়াছড়ি', 'lat' => '23.119285', 'lon' => '91.984663', 'url' => 'www.khagrachhari.gov.bd'),
        array('id' => '11', 'division_id' => '1', 'name' => 'Bandarban', 'bn_name' => 'বান্দরবান', 'lat' => '22.1953275', 'lon' => '92.2183773', 'url' => 'www.bandarban.gov.bd'),
        array('id' => '12', 'division_id' => '2', 'name' => 'Sirajganj', 'bn_name' => 'সিরাজগঞ্জ', 'lat' => '24.4533978', 'lon' => '89.7006815', 'url' => 'www.sirajganj.gov.bd'),
        array('id' => '13', 'division_id' => '2', 'name' => 'Pabna', 'bn_name' => 'পাবনা', 'lat' => '23.998524', 'lon' => '89.233645', 'url' => 'www.pabna.gov.bd'),
        array('id' => '14', 'division_id' => '2', 'name' => 'Bogura', 'bn_name' => 'বগুড়া', 'lat' => '24.8465228', 'lon' => '89.377755', 'url' => 'www.bogra.gov.bd'),
        array('id' => '15', 'division_id' => '2', 'name' => 'Rajshahi', 'bn_name' => 'রাজশাহী', 'lat' => NULL, 'lon' => NULL, 'url' => 'www.rajshahi.gov.bd'),
        array('id' => '16', 'division_id' => '2', 'name' => 'Natore', 'bn_name' => 'নাটোর', 'lat' => '24.420556', 'lon' => '89.000282', 'url' => 'www.natore.gov.bd'),
        array('id' => '17', 'division_id' => '2', 'name' => 'Joypurhat', 'bn_name' => 'জয়পুরহাট', 'lat' => NULL, 'lon' => NULL, 'url' => 'www.joypurhat.gov.bd'),
        array('id' => '18', 'division_id' => '2', 'name' => 'Chapainawabganj', 'bn_name' => 'চাঁপাইনবাবগঞ্জ', 'lat' => '24.5965034', 'lon' => '88.2775122', 'url' => 'www.chapainawabganj.gov.bd'),
        array('id' => '19', 'division_id' => '2', 'name' => 'Naogaon', 'bn_name' => 'নওগাঁ', 'lat' => NULL, 'lon' => NULL, 'url' => 'www.naogaon.gov.bd'),
        array('id' => '20', 'division_id' => '3', 'name' => 'Jashore', 'bn_name' => 'যশোর', 'lat' => '23.16643', 'lon' => '89.2081126', 'url' => 'www.jessore.gov.bd'),
        array('id' => '21', 'division_id' => '3', 'name' => 'Satkhira', 'bn_name' => 'সাতক্ষীরা', 'lat' => NULL, 'lon' => NULL, 'url' => 'www.satkhira.gov.bd'),
        array('id' => '22', 'division_id' => '3', 'name' => 'Meherpur', 'bn_name' => 'মেহেরপুর', 'lat' => '23.762213', 'lon' => '88.631821', 'url' => 'www.meherpur.gov.bd'),
        array('id' => '23', 'division_id' => '3', 'name' => 'Narail', 'bn_name' => 'নড়াইল', 'lat' => '23.172534', 'lon' => '89.512672', 'url' => 'www.narail.gov.bd'),
        array('id' => '24', 'division_id' => '3', 'name' => 'Chuadanga', 'bn_name' => 'চুয়াডাঙ্গা', 'lat' => '23.6401961', 'lon' => '88.841841', 'url' => 'www.chuadanga.gov.bd'),
        array('id' => '25', 'division_id' => '3', 'name' => 'Kushtia', 'bn_name' => 'কুষ্টিয়া', 'lat' => '23.901258', 'lon' => '89.120482', 'url' => 'www.kushtia.gov.bd'),
        array('id' => '26', 'division_id' => '3', 'name' => 'Magura', 'bn_name' => 'মাগুরা', 'lat' => '23.487337', 'lon' => '89.419956', 'url' => 'www.magura.gov.bd'),
        array('id' => '27', 'division_id' => '3', 'name' => 'Khulna', 'bn_name' => 'খুলনা', 'lat' => '22.815774', 'lon' => '89.568679', 'url' => 'www.khulna.gov.bd'),
        array('id' => '28', 'division_id' => '3', 'name' => 'Bagerhat', 'bn_name' => 'বাগেরহাট', 'lat' => '22.651568', 'lon' => '89.785938', 'url' => 'www.bagerhat.gov.bd'),
        array('id' => '29', 'division_id' => '3', 'name' => 'Jhenaidah', 'bn_name' => 'ঝিনাইদহ', 'lat' => '23.5448176', 'lon' => '89.1539213', 'url' => 'www.jhenaidah.gov.bd'),
        array('id' => '30', 'division_id' => '4', 'name' => 'Jhalakathi', 'bn_name' => 'ঝালকাঠি', 'lat' => NULL, 'lon' => NULL, 'url' => 'www.jhalakathi.gov.bd'),
        array('id' => '31', 'division_id' => '4', 'name' => 'Patuakhali', 'bn_name' => 'পটুয়াখালী', 'lat' => '22.3596316', 'lon' => '90.3298712', 'url' => 'www.patuakhali.gov.bd'),
        array('id' => '32', 'division_id' => '4', 'name' => 'Pirojpur', 'bn_name' => 'পিরোজপুর', 'lat' => NULL, 'lon' => NULL, 'url' => 'www.pirojpur.gov.bd'),
        array('id' => '33', 'division_id' => '4', 'name' => 'Barisal', 'bn_name' => 'বরিশাল', 'lat' => NULL, 'lon' => NULL, 'url' => 'www.barisal.gov.bd'),
        array('id' => '34', 'division_id' => '4', 'name' => 'Bhola', 'bn_name' => 'ভোলা', 'lat' => '22.685923', 'lon' => '90.648179', 'url' => 'www.bhola.gov.bd'),
        array('id' => '35', 'division_id' => '4', 'name' => 'Barguna', 'bn_name' => 'বরগুনা', 'lat' => NULL, 'lon' => NULL, 'url' => 'www.barguna.gov.bd'),
        array('id' => '36', 'division_id' => '5', 'name' => 'Sylhet', 'bn_name' => 'সিলেট', 'lat' => '24.8897956', 'lon' => '91.8697894', 'url' => 'www.sylhet.gov.bd'),
        array('id' => '37', 'division_id' => '5', 'name' => 'Moulvibazar', 'bn_name' => 'মৌলভীবাজার', 'lat' => '24.482934', 'lon' => '91.777417', 'url' => 'www.moulvibazar.gov.bd'),
        array('id' => '38', 'division_id' => '5', 'name' => 'Habiganj', 'bn_name' => 'হবিগঞ্জ', 'lat' => '24.374945', 'lon' => '91.41553', 'url' => 'www.habiganj.gov.bd'),
        array('id' => '39', 'division_id' => '5', 'name' => 'Sunamganj', 'bn_name' => 'সুনামগঞ্জ', 'lat' => '25.0658042', 'lon' => '91.3950115', 'url' => 'www.sunamganj.gov.bd'),
        array('id' => '40', 'division_id' => '6', 'name' => 'Narsingdi', 'bn_name' => 'নরসিংদী', 'lat' => '23.932233', 'lon' => '90.71541', 'url' => 'www.narsingdi.gov.bd'),
        array('id' => '41', 'division_id' => '6', 'name' => 'Gazipur', 'bn_name' => 'গাজীপুর', 'lat' => '24.0022858', 'lon' => '90.4264283', 'url' => 'www.gazipur.gov.bd'),
        array('id' => '42', 'division_id' => '6', 'name' => 'Shariatpur', 'bn_name' => 'শরীয়তপুর', 'lat' => NULL, 'lon' => NULL, 'url' => 'www.shariatpur.gov.bd'),
        array('id' => '43', 'division_id' => '6', 'name' => 'Narayanganj', 'bn_name' => 'নারায়ণগঞ্জ', 'lat' => '23.63366', 'lon' => '90.496482', 'url' => 'www.narayanganj.gov.bd'),
        array('id' => '44', 'division_id' => '6', 'name' => 'Tangail', 'bn_name' => 'টাঙ্গাইল', 'lat' => NULL, 'lon' => NULL, 'url' => 'www.tangail.gov.bd'),
        array('id' => '45', 'division_id' => '6', 'name' => 'Kishoreganj', 'bn_name' => 'কিশোরগঞ্জ', 'lat' => '24.444937', 'lon' => '90.776575', 'url' => 'www.kishoreganj.gov.bd'),
        array('id' => '46', 'division_id' => '6', 'name' => 'Manikganj', 'bn_name' => 'মানিকগঞ্জ', 'lat' => NULL, 'lon' => NULL, 'url' => 'www.manikganj.gov.bd'),
        array('id' => '47', 'division_id' => '6', 'name' => 'Dhaka', 'bn_name' => 'ঢাকা', 'lat' => '23.7115253', 'lon' => '90.4111451', 'url' => 'www.dhaka.gov.bd'),
        array('id' => '48', 'division_id' => '6', 'name' => 'Munshiganj', 'bn_name' => 'মুন্সিগঞ্জ', 'lat' => NULL, 'lon' => NULL, 'url' => 'www.munshiganj.gov.bd'),
        array('id' => '49', 'division_id' => '6', 'name' => 'Rajbari', 'bn_name' => 'রাজবাড়ী', 'lat' => '23.7574305', 'lon' => '89.6444665', 'url' => 'www.rajbari.gov.bd'),
        array('id' => '50', 'division_id' => '6', 'name' => 'Madaripur', 'bn_name' => 'মাদারীপুর', 'lat' => '23.164102', 'lon' => '90.1896805', 'url' => 'www.madaripur.gov.bd'),
        array('id' => '51', 'division_id' => '6', 'name' => 'Gopalganj', 'bn_name' => 'গোপালগঞ্জ', 'lat' => '23.0050857', 'lon' => '89.8266059', 'url' => 'www.gopalganj.gov.bd'),
        array('id' => '52', 'division_id' => '6', 'name' => 'Faridpur', 'bn_name' => 'ফরিদপুর', 'lat' => '23.6070822', 'lon' => '89.8429406', 'url' => 'www.faridpur.gov.bd'),
        array('id' => '53', 'division_id' => '7', 'name' => 'Panchagarh', 'bn_name' => 'পঞ্চগড়', 'lat' => '26.3411', 'lon' => '88.5541606', 'url' => 'www.panchagarh.gov.bd'),
        array('id' => '54', 'division_id' => '7', 'name' => 'Dinajpur', 'bn_name' => 'দিনাজপুর', 'lat' => '25.6217061', 'lon' => '88.6354504', 'url' => 'www.dinajpur.gov.bd'),
        array('id' => '55', 'division_id' => '7', 'name' => 'Lalmonirhat', 'bn_name' => 'লালমনিরহাট', 'lat' => NULL, 'lon' => NULL, 'url' => 'www.lalmonirhat.gov.bd'),
        array('id' => '56', 'division_id' => '7', 'name' => 'Nilphamari', 'bn_name' => 'নীলফামারী', 'lat' => '25.931794', 'lon' => '88.856006', 'url' => 'www.nilphamari.gov.bd'),
        array('id' => '57', 'division_id' => '7', 'name' => 'Gaibandha', 'bn_name' => 'গাইবান্ধা', 'lat' => '25.328751', 'lon' => '89.528088', 'url' => 'www.gaibandha.gov.bd'),
        array('id' => '58', 'division_id' => '7', 'name' => 'Thakurgaon', 'bn_name' => 'ঠাকুরগাঁও', 'lat' => '26.0336945', 'lon' => '88.4616834', 'url' => 'www.thakurgaon.gov.bd'),
        array('id' => '59', 'division_id' => '7', 'name' => 'Rangpur', 'bn_name' => 'রংপুর', 'lat' => '25.7558096', 'lon' => '89.244462', 'url' => 'www.rangpur.gov.bd'),
        array('id' => '60', 'division_id' => '7', 'name' => 'Kurigram', 'bn_name' => 'কুড়িগ্রাম', 'lat' => '25.805445', 'lon' => '89.636174', 'url' => 'www.kurigram.gov.bd'),
        array('id' => '61', 'division_id' => '8', 'name' => 'Sherpur', 'bn_name' => 'শেরপুর', 'lat' => '25.0204933', 'lon' => '90.0152966', 'url' => 'www.sherpur.gov.bd'),
        array('id' => '62', 'division_id' => '8', 'name' => 'Mymensingh', 'bn_name' => 'ময়মনসিংহ', 'lat' => NULL, 'lon' => NULL, 'url' => 'www.mymensingh.gov.bd'),
        array('id' => '63', 'division_id' => '8', 'name' => 'Jamalpur', 'bn_name' => 'জামালপুর', 'lat' => '24.937533', 'lon' => '89.937775', 'url' => 'www.jamalpur.gov.bd'),
        array('id' => '64', 'division_id' => '8', 'name' => 'Netrokona', 'bn_name' => 'নেত্রকোণা', 'lat' => '24.870955', 'lon' => '90.727887', 'url' => 'www.netrokona.gov.bd')
    );
    return $districts;
}

function div_by_dist($divId, $select){
    $sel = json_decode($select);
    $dis = districtView();
    $view = '';
    foreach ($dis as $key => $d){
        if ($d['division_id'] == $divId){
            if(!empty($sel)) {
                $s = (in_array($d['id'], $sel)) ? 'checked' : '';
            }else{
                $s = '';
            }

            $view .='<div class="form-check">
                <input class="form-check-input" name="district[]" '.$s.' type="checkbox" id="check_'.($key + 1).'" value="'.$d['id'].'">
                <label class="form-check-label" for="check_'.($key + 1).'">
                '.$d['name'].'
                </label>
            </div>';
        }
    }

    return $view;
}



function districtselect($selected = '1', $division = '0')
{
    $districts = districtView();

    $row = '';
    if ($selected != NULL) {
        foreach ($districts as $rows) {
            if ($rows['division_id'] == $division) {
                $row .= '<option value="' . $rows['id'] . '"';
                $row .= ($rows['id'] == $selected) ? ' selected="selected"' : '';
                $row .= '>' . $rows['name'] . '</option>';
            }
        }
    }
    return $row;
}

function districtname($id)
{
    $districts = districtView();

    $row = '';
    foreach ($districts as $rows) {
        if ($rows['id'] == $id) {
            $row .= $rows['name'];
        }
    }
    return $row;
}

function upazilasView()
{

    $upazilas = array(
        array('id' => '1', 'district_id' => '1', 'name' => 'Debidwar', 'bn_name' => 'দেবিদ্বার', 'url' => 'debidwar.comilla.gov.bd'),
        array('id' => '2', 'district_id' => '1', 'name' => 'Barura', 'bn_name' => 'বরুড়া', 'url' => 'barura.comilla.gov.bd'),
        array('id' => '3', 'district_id' => '1', 'name' => 'Brahmanpara', 'bn_name' => 'ব্রাহ্মণপাড়া', 'url' => 'brahmanpara.comilla.gov.bd'),
        array('id' => '4', 'district_id' => '1', 'name' => 'Chandina', 'bn_name' => 'চান্দিনা', 'url' => 'chandina.comilla.gov.bd'),
        array('id' => '5', 'district_id' => '1', 'name' => 'Chauddagram', 'bn_name' => 'চৌদ্দগ্রাম', 'url' => 'chauddagram.comilla.gov.bd'),
        array('id' => '6', 'district_id' => '1', 'name' => 'Daudkandi', 'bn_name' => 'দাউদকান্দি', 'url' => 'daudkandi.comilla.gov.bd'),
        array('id' => '7', 'district_id' => '1', 'name' => 'Homna', 'bn_name' => 'হোমনা', 'url' => 'homna.comilla.gov.bd'),
        array('id' => '8', 'district_id' => '1', 'name' => 'Laksam', 'bn_name' => 'লাকসাম', 'url' => 'laksam.comilla.gov.bd'),
        array('id' => '9', 'district_id' => '1', 'name' => 'Muradnagar', 'bn_name' => 'মুরাদনগর', 'url' => 'muradnagar.comilla.gov.bd'),
        array('id' => '10', 'district_id' => '1', 'name' => 'Nangalkot', 'bn_name' => 'নাঙ্গলকোট', 'url' => 'nangalkot.comilla.gov.bd'),
        array('id' => '11', 'district_id' => '1', 'name' => 'Comilla Sadar', 'bn_name' => 'কুমিল্লা সদর', 'url' => 'comillasadar.comilla.gov.bd'),
        array('id' => '12', 'district_id' => '1', 'name' => 'Meghna', 'bn_name' => 'মেঘনা', 'url' => 'meghna.comilla.gov.bd'),
        array('id' => '13', 'district_id' => '1', 'name' => 'Monohargonj', 'bn_name' => 'মনোহরগঞ্জ', 'url' => 'monohargonj.comilla.gov.bd'),
        array('id' => '14', 'district_id' => '1', 'name' => 'Sadarsouth', 'bn_name' => 'সদর দক্ষিণ', 'url' => 'sadarsouth.comilla.gov.bd'),
        array('id' => '15', 'district_id' => '1', 'name' => 'Titas', 'bn_name' => 'তিতাস', 'url' => 'titas.comilla.gov.bd'),
        array('id' => '16', 'district_id' => '1', 'name' => 'Burichang', 'bn_name' => 'বুড়িচং', 'url' => 'burichang.comilla.gov.bd'),
        array('id' => '17', 'district_id' => '1', 'name' => 'Lalmai', 'bn_name' => 'লালমাই', 'url' => 'lalmai.comilla.gov.bd'),
        array('id' => '18', 'district_id' => '2', 'name' => 'Chhagalnaiya', 'bn_name' => 'ছাগলনাইয়া', 'url' => 'chhagalnaiya.feni.gov.bd'),
        array('id' => '19', 'district_id' => '2', 'name' => 'Feni Sadar', 'bn_name' => 'ফেনী সদর', 'url' => 'sadar.feni.gov.bd'),
        array('id' => '20', 'district_id' => '2', 'name' => 'Sonagazi', 'bn_name' => 'সোনাগাজী', 'url' => 'sonagazi.feni.gov.bd'),
        array('id' => '21', 'district_id' => '2', 'name' => 'Fulgazi', 'bn_name' => 'ফুলগাজী', 'url' => 'fulgazi.feni.gov.bd'),
        array('id' => '22', 'district_id' => '2', 'name' => 'Parshuram', 'bn_name' => 'পরশুরাম', 'url' => 'parshuram.feni.gov.bd'),
        array('id' => '23', 'district_id' => '2', 'name' => 'Daganbhuiyan', 'bn_name' => 'দাগনভূঞা', 'url' => 'daganbhuiyan.feni.gov.bd'),
        array('id' => '24', 'district_id' => '3', 'name' => 'Brahmanbaria Sadar', 'bn_name' => 'ব্রাহ্মণবাড়িয়া সদর', 'url' => 'sadar.brahmanbaria.gov.bd'),
        array('id' => '25', 'district_id' => '3', 'name' => 'Kasba', 'bn_name' => 'কসবা', 'url' => 'kasba.brahmanbaria.gov.bd'),
        array('id' => '26', 'district_id' => '3', 'name' => 'Nasirnagar', 'bn_name' => 'নাসিরনগর', 'url' => 'nasirnagar.brahmanbaria.gov.bd'),
        array('id' => '27', 'district_id' => '3', 'name' => 'Sarail', 'bn_name' => 'সরাইল', 'url' => 'sarail.brahmanbaria.gov.bd'),
        array('id' => '28', 'district_id' => '3', 'name' => 'Ashuganj', 'bn_name' => 'আশুগঞ্জ', 'url' => 'ashuganj.brahmanbaria.gov.bd'),
        array('id' => '29', 'district_id' => '3', 'name' => 'Akhaura', 'bn_name' => 'আখাউড়া', 'url' => 'akhaura.brahmanbaria.gov.bd'),
        array('id' => '30', 'district_id' => '3', 'name' => 'Nabinagar', 'bn_name' => 'নবীনগর', 'url' => 'nabinagar.brahmanbaria.gov.bd'),
        array('id' => '31', 'district_id' => '3', 'name' => 'Bancharampur', 'bn_name' => 'বাঞ্ছারামপুর', 'url' => 'bancharampur.brahmanbaria.gov.bd'),
        array('id' => '32', 'district_id' => '3', 'name' => 'Bijoynagar', 'bn_name' => 'বিজয়নগর', 'url' => 'bijoynagar.brahmanbaria.gov.bd    '),
        array('id' => '33', 'district_id' => '4', 'name' => 'Rangamati Sadar', 'bn_name' => 'রাঙ্গামাটি সদর', 'url' => 'sadar.rangamati.gov.bd'),
        array('id' => '34', 'district_id' => '4', 'name' => 'Kaptai', 'bn_name' => 'কাপ্তাই', 'url' => 'kaptai.rangamati.gov.bd'),
        array('id' => '35', 'district_id' => '4', 'name' => 'Kawkhali', 'bn_name' => 'কাউখালী', 'url' => 'kawkhali.rangamati.gov.bd'),
        array('id' => '36', 'district_id' => '4', 'name' => 'Baghaichari', 'bn_name' => 'বাঘাইছড়ি', 'url' => 'baghaichari.rangamati.gov.bd'),
        array('id' => '37', 'district_id' => '4', 'name' => 'Barkal', 'bn_name' => 'বরকল', 'url' => 'barkal.rangamati.gov.bd'),
        array('id' => '38', 'district_id' => '4', 'name' => 'Langadu', 'bn_name' => 'লংগদু', 'url' => 'langadu.rangamati.gov.bd'),
        array('id' => '39', 'district_id' => '4', 'name' => 'Rajasthali', 'bn_name' => 'রাজস্থলী', 'url' => 'rajasthali.rangamati.gov.bd'),
        array('id' => '40', 'district_id' => '4', 'name' => 'Belaichari', 'bn_name' => 'বিলাইছড়ি', 'url' => 'belaichari.rangamati.gov.bd'),
        array('id' => '41', 'district_id' => '4', 'name' => 'Juraichari', 'bn_name' => 'জুরাছড়ি', 'url' => 'juraichari.rangamati.gov.bd'),
        array('id' => '42', 'district_id' => '4', 'name' => 'Naniarchar', 'bn_name' => 'নানিয়ারচর', 'url' => 'naniarchar.rangamati.gov.bd'),
        array('id' => '43', 'district_id' => '5', 'name' => 'Noakhali Sadar', 'bn_name' => 'নোয়াখালী সদর', 'url' => 'sadar.noakhali.gov.bd'),
        array('id' => '44', 'district_id' => '5', 'name' => 'Companiganj', 'bn_name' => 'কোম্পানীগঞ্জ', 'url' => 'companiganj.noakhali.gov.bd'),
        array('id' => '45', 'district_id' => '5', 'name' => 'Begumganj', 'bn_name' => 'বেগমগঞ্জ', 'url' => 'begumganj.noakhali.gov.bd'),
        array('id' => '46', 'district_id' => '5', 'name' => 'Hatia', 'bn_name' => 'হাতিয়া', 'url' => 'hatia.noakhali.gov.bd'),
        array('id' => '47', 'district_id' => '5', 'name' => 'Subarnachar', 'bn_name' => 'সুবর্ণচর', 'url' => 'subarnachar.noakhali.gov.bd'),
        array('id' => '48', 'district_id' => '5', 'name' => 'Kabirhat', 'bn_name' => 'কবিরহাট', 'url' => 'kabirhat.noakhali.gov.bd'),
        array('id' => '49', 'district_id' => '5', 'name' => 'Senbug', 'bn_name' => 'সেনবাগ', 'url' => 'senbug.noakhali.gov.bd'),
        array('id' => '50', 'district_id' => '5', 'name' => 'Chatkhil', 'bn_name' => 'চাটখিল', 'url' => 'chatkhil.noakhali.gov.bd'),
        array('id' => '51', 'district_id' => '5', 'name' => 'Sonaimori', 'bn_name' => 'সোনাইমুড়ী', 'url' => 'sonaimori.noakhali.gov.bd'),
        array('id' => '52', 'district_id' => '6', 'name' => 'Haimchar', 'bn_name' => 'হাইমচর', 'url' => 'haimchar.chandpur.gov.bd'),
        array('id' => '53', 'district_id' => '6', 'name' => 'Kachua', 'bn_name' => 'কচুয়া', 'url' => 'kachua.chandpur.gov.bd'),
        array('id' => '54', 'district_id' => '6', 'name' => 'Shahrasti', 'bn_name' => 'শাহরাস্তি ', 'url' => 'shahrasti.chandpur.gov.bd'),
        array('id' => '55', 'district_id' => '6', 'name' => 'Chandpur Sadar', 'bn_name' => 'চাঁদপুর সদর', 'url' => 'sadar.chandpur.gov.bd'),
        array('id' => '56', 'district_id' => '6', 'name' => 'Matlab South', 'bn_name' => 'মতলব দক্ষিণ', 'url' => 'matlabsouth.chandpur.gov.bd'),
        array('id' => '57', 'district_id' => '6', 'name' => 'Hajiganj', 'bn_name' => 'হাজীগঞ্জ', 'url' => 'hajiganj.chandpur.gov.bd'),
        array('id' => '58', 'district_id' => '6', 'name' => 'Matlab North', 'bn_name' => 'মতলব উত্তর', 'url' => 'matlabnorth.chandpur.gov.bd'),
        array('id' => '59', 'district_id' => '6', 'name' => 'Faridgonj', 'bn_name' => 'ফরিদগঞ্জ', 'url' => 'faridgonj.chandpur.gov.bd'),
        array('id' => '60', 'district_id' => '7', 'name' => 'Lakshmipur Sadar', 'bn_name' => 'লক্ষ্মীপুর সদর', 'url' => 'sadar.lakshmipur.gov.bd'),
        array('id' => '61', 'district_id' => '7', 'name' => 'Kamalnagar', 'bn_name' => 'কমলনগর', 'url' => 'kamalnagar.lakshmipur.gov.bd'),
        array('id' => '62', 'district_id' => '7', 'name' => 'Raipur', 'bn_name' => 'রায়পুর', 'url' => 'raipur.lakshmipur.gov.bd'),
        array('id' => '63', 'district_id' => '7', 'name' => 'Ramgati', 'bn_name' => 'রামগতি', 'url' => 'ramgati.lakshmipur.gov.bd'),
        array('id' => '64', 'district_id' => '7', 'name' => 'Ramganj', 'bn_name' => 'রামগঞ্জ', 'url' => 'ramganj.lakshmipur.gov.bd'),
        array('id' => '65', 'district_id' => '8', 'name' => 'Rangunia', 'bn_name' => 'রাঙ্গুনিয়া', 'url' => 'rangunia.chittagong.gov.bd'),
        array('id' => '66', 'district_id' => '8', 'name' => 'Sitakunda', 'bn_name' => 'সীতাকুন্ড', 'url' => 'sitakunda.chittagong.gov.bd'),
        array('id' => '67', 'district_id' => '8', 'name' => 'Mirsharai', 'bn_name' => 'মীরসরাই', 'url' => 'mirsharai.chittagong.gov.bd'),
        array('id' => '68', 'district_id' => '8', 'name' => 'Patiya', 'bn_name' => 'পটিয়া', 'url' => 'patiya.chittagong.gov.bd'),
        array('id' => '69', 'district_id' => '8', 'name' => 'Sandwip', 'bn_name' => 'সন্দ্বীপ', 'url' => 'sandwip.chittagong.gov.bd'),
        array('id' => '70', 'district_id' => '8', 'name' => 'Banshkhali', 'bn_name' => 'বাঁশখালী', 'url' => 'banshkhali.chittagong.gov.bd'),
        array('id' => '71', 'district_id' => '8', 'name' => 'Boalkhali', 'bn_name' => 'বোয়ালখালী', 'url' => 'boalkhali.chittagong.gov.bd'),
        array('id' => '72', 'district_id' => '8', 'name' => 'Anwara', 'bn_name' => 'আনোয়ারা', 'url' => 'anwara.chittagong.gov.bd'),
        array('id' => '73', 'district_id' => '8', 'name' => 'Chandanaish', 'bn_name' => 'চন্দনাইশ', 'url' => 'chandanaish.chittagong.gov.bd'),
        array('id' => '74', 'district_id' => '8', 'name' => 'Satkania', 'bn_name' => 'সাতকানিয়া', 'url' => 'satkania.chittagong.gov.bd'),
        array('id' => '75', 'district_id' => '8', 'name' => 'Lohagara', 'bn_name' => 'লোহাগাড়া', 'url' => 'lohagara.chittagong.gov.bd'),
        array('id' => '76', 'district_id' => '8', 'name' => 'Hathazari', 'bn_name' => 'হাটহাজারী', 'url' => 'hathazari.chittagong.gov.bd'),
        array('id' => '77', 'district_id' => '8', 'name' => 'Fatikchhari', 'bn_name' => 'ফটিকছড়ি', 'url' => 'fatikchhari.chittagong.gov.bd'),
        array('id' => '78', 'district_id' => '8', 'name' => 'Raozan', 'bn_name' => 'রাউজান', 'url' => 'raozan.chittagong.gov.bd'),
        array('id' => '79', 'district_id' => '8', 'name' => 'Karnafuli', 'bn_name' => 'কর্ণফুলী', 'url' => 'karnafuli.chittagong.gov.bd'),
        array('id' => '80', 'district_id' => '9', 'name' => 'Coxsbazar Sadar', 'bn_name' => 'কক্সবাজার সদর', 'url' => 'sadar.coxsbazar.gov.bd'),
        array('id' => '81', 'district_id' => '9', 'name' => 'Chakaria', 'bn_name' => 'চকরিয়া', 'url' => 'chakaria.coxsbazar.gov.bd'),
        array('id' => '82', 'district_id' => '9', 'name' => 'Kutubdia', 'bn_name' => 'কুতুবদিয়া', 'url' => 'kutubdia.coxsbazar.gov.bd'),
        array('id' => '83', 'district_id' => '9', 'name' => 'Ukhiya', 'bn_name' => 'উখিয়া', 'url' => 'ukhiya.coxsbazar.gov.bd'),
        array('id' => '84', 'district_id' => '9', 'name' => 'Moheshkhali', 'bn_name' => 'মহেশখালী', 'url' => 'moheshkhali.coxsbazar.gov.bd'),
        array('id' => '85', 'district_id' => '9', 'name' => 'Pekua', 'bn_name' => 'পেকুয়া', 'url' => 'pekua.coxsbazar.gov.bd'),
        array('id' => '86', 'district_id' => '9', 'name' => 'Ramu', 'bn_name' => 'রামু', 'url' => 'ramu.coxsbazar.gov.bd'),
        array('id' => '87', 'district_id' => '9', 'name' => 'Teknaf', 'bn_name' => 'টেকনাফ', 'url' => 'teknaf.coxsbazar.gov.bd'),
        array('id' => '88', 'district_id' => '10', 'name' => 'Khagrachhari Sadar', 'bn_name' => 'খাগড়াছড়ি সদর', 'url' => 'sadar.khagrachhari.gov.bd'),
        array('id' => '89', 'district_id' => '10', 'name' => 'Dighinala', 'bn_name' => 'দিঘীনালা', 'url' => 'dighinala.khagrachhari.gov.bd'),
        array('id' => '90', 'district_id' => '10', 'name' => 'Panchari', 'bn_name' => 'পানছড়ি', 'url' => 'panchari.khagrachhari.gov.bd'),
        array('id' => '91', 'district_id' => '10', 'name' => 'Laxmichhari', 'bn_name' => 'লক্ষীছড়ি', 'url' => 'laxmichhari.khagrachhari.gov.bd'),
        array('id' => '92', 'district_id' => '10', 'name' => 'Mohalchari', 'bn_name' => 'মহালছড়ি', 'url' => 'mohalchari.khagrachhari.gov.bd'),
        array('id' => '93', 'district_id' => '10', 'name' => 'Manikchari', 'bn_name' => 'মানিকছড়ি', 'url' => 'manikchari.khagrachhari.gov.bd'),
        array('id' => '94', 'district_id' => '10', 'name' => 'Ramgarh', 'bn_name' => 'রামগড়', 'url' => 'ramgarh.khagrachhari.gov.bd'),
        array('id' => '95', 'district_id' => '10', 'name' => 'Matiranga', 'bn_name' => 'মাটিরাঙ্গা', 'url' => 'matiranga.khagrachhari.gov.bd'),
        array('id' => '96', 'district_id' => '10', 'name' => 'Guimara', 'bn_name' => 'গুইমারা', 'url' => 'guimara.khagrachhari.gov.bd'),
        array('id' => '97', 'district_id' => '11', 'name' => 'Bandarban Sadar', 'bn_name' => 'বান্দরবান সদর', 'url' => 'sadar.bandarban.gov.bd'),
        array('id' => '98', 'district_id' => '11', 'name' => 'Alikadam', 'bn_name' => 'আলীকদম', 'url' => 'alikadam.bandarban.gov.bd'),
        array('id' => '99', 'district_id' => '11', 'name' => 'Naikhongchhari', 'bn_name' => 'নাইক্ষ্যংছড়ি', 'url' => 'naikhongchhari.bandarban.gov.bd'),
        array('id' => '100', 'district_id' => '11', 'name' => 'Rowangchhari', 'bn_name' => 'রোয়াংছড়ি', 'url' => 'rowangchhari.bandarban.gov.bd'),
        array('id' => '101', 'district_id' => '11', 'name' => 'Lama', 'bn_name' => 'লামা', 'url' => 'lama.bandarban.gov.bd'),
        array('id' => '102', 'district_id' => '11', 'name' => 'Ruma', 'bn_name' => 'রুমা', 'url' => 'ruma.bandarban.gov.bd'),
        array('id' => '103', 'district_id' => '11', 'name' => 'Thanchi', 'bn_name' => 'থানচি', 'url' => 'thanchi.bandarban.gov.bd'),
        array('id' => '104', 'district_id' => '12', 'name' => 'Belkuchi', 'bn_name' => 'বেলকুচি', 'url' => 'belkuchi.sirajganj.gov.bd'),
        array('id' => '105', 'district_id' => '12', 'name' => 'Chauhali', 'bn_name' => 'চৌহালি', 'url' => 'chauhali.sirajganj.gov.bd'),
        array('id' => '106', 'district_id' => '12', 'name' => 'Kamarkhand', 'bn_name' => 'কামারখন্দ', 'url' => 'kamarkhand.sirajganj.gov.bd'),
        array('id' => '107', 'district_id' => '12', 'name' => 'Kazipur', 'bn_name' => 'কাজীপুর', 'url' => 'kazipur.sirajganj.gov.bd'),
        array('id' => '108', 'district_id' => '12', 'name' => 'Raigonj', 'bn_name' => 'রায়গঞ্জ', 'url' => 'raigonj.sirajganj.gov.bd'),
        array('id' => '109', 'district_id' => '12', 'name' => 'Shahjadpur', 'bn_name' => 'শাহজাদপুর', 'url' => 'shahjadpur.sirajganj.gov.bd'),
        array('id' => '110', 'district_id' => '12', 'name' => 'Sirajganj Sadar', 'bn_name' => 'সিরাজগঞ্জ সদর', 'url' => 'sirajganjsadar.sirajganj.gov.bd'),
        array('id' => '111', 'district_id' => '12', 'name' => 'Tarash', 'bn_name' => 'তাড়াশ', 'url' => 'tarash.sirajganj.gov.bd'),
        array('id' => '112', 'district_id' => '12', 'name' => 'Ullapara', 'bn_name' => 'উল্লাপাড়া', 'url' => 'ullapara.sirajganj.gov.bd'),
        array('id' => '113', 'district_id' => '13', 'name' => 'Sujanagar', 'bn_name' => 'সুজানগর', 'url' => 'sujanagar.pabna.gov.bd'),
        array('id' => '114', 'district_id' => '13', 'name' => 'Ishurdi', 'bn_name' => 'ঈশ্বরদী', 'url' => 'ishurdi.pabna.gov.bd'),
        array('id' => '115', 'district_id' => '13', 'name' => 'Bhangura', 'bn_name' => 'ভাঙ্গুড়া', 'url' => 'bhangura.pabna.gov.bd'),
        array('id' => '116', 'district_id' => '13', 'name' => 'Pabna Sadar', 'bn_name' => 'পাবনা সদর', 'url' => 'pabnasadar.pabna.gov.bd'),
        array('id' => '117', 'district_id' => '13', 'name' => 'Bera', 'bn_name' => 'বেড়া', 'url' => 'bera.pabna.gov.bd'),
        array('id' => '118', 'district_id' => '13', 'name' => 'Atghoria', 'bn_name' => 'আটঘরিয়া', 'url' => 'atghoria.pabna.gov.bd'),
        array('id' => '119', 'district_id' => '13', 'name' => 'Chatmohar', 'bn_name' => 'চাটমোহর', 'url' => 'chatmohar.pabna.gov.bd'),
        array('id' => '120', 'district_id' => '13', 'name' => 'Santhia', 'bn_name' => 'সাঁথিয়া', 'url' => 'santhia.pabna.gov.bd'),
        array('id' => '121', 'district_id' => '13', 'name' => 'Faridpur', 'bn_name' => 'ফরিদপুর', 'url' => 'faridpur.pabna.gov.bd'),
        array('id' => '122', 'district_id' => '14', 'name' => 'Kahaloo', 'bn_name' => 'কাহালু', 'url' => 'kahaloo.bogra.gov.bd'),
        array('id' => '123', 'district_id' => '14', 'name' => 'Bogra Sadar', 'bn_name' => 'বগুড়া সদর', 'url' => 'sadar.bogra.gov.bd'),
        array('id' => '124', 'district_id' => '14', 'name' => 'Shariakandi', 'bn_name' => 'সারিয়াকান্দি', 'url' => 'shariakandi.bogra.gov.bd'),
        array('id' => '125', 'district_id' => '14', 'name' => 'Shajahanpur', 'bn_name' => 'শাজাহানপুর', 'url' => 'shajahanpur.bogra.gov.bd'),
        array('id' => '126', 'district_id' => '14', 'name' => 'Dupchanchia', 'bn_name' => 'দুপচাচিঁয়া', 'url' => 'dupchanchia.bogra.gov.bd'),
        array('id' => '127', 'district_id' => '14', 'name' => 'Adamdighi', 'bn_name' => 'আদমদিঘি', 'url' => 'adamdighi.bogra.gov.bd'),
        array('id' => '128', 'district_id' => '14', 'name' => 'Nondigram', 'bn_name' => 'নন্দিগ্রাম', 'url' => 'nondigram.bogra.gov.bd'),
        array('id' => '129', 'district_id' => '14', 'name' => 'Sonatala', 'bn_name' => 'সোনাতলা', 'url' => 'sonatala.bogra.gov.bd'),
        array('id' => '130', 'district_id' => '14', 'name' => 'Dhunot', 'bn_name' => 'ধুনট', 'url' => 'dhunot.bogra.gov.bd'),
        array('id' => '131', 'district_id' => '14', 'name' => 'Gabtali', 'bn_name' => 'গাবতলী', 'url' => 'gabtali.bogra.gov.bd'),
        array('id' => '132', 'district_id' => '14', 'name' => 'Sherpur', 'bn_name' => 'শেরপুর', 'url' => 'sherpur.bogra.gov.bd'),
        array('id' => '133', 'district_id' => '14', 'name' => 'Shibganj', 'bn_name' => 'শিবগঞ্জ', 'url' => 'shibganj.bogra.gov.bd'),
        array('id' => '134', 'district_id' => '15', 'name' => 'Paba', 'bn_name' => 'পবা', 'url' => 'paba.rajshahi.gov.bd'),
        array('id' => '135', 'district_id' => '15', 'name' => 'Durgapur', 'bn_name' => 'দুর্গাপুর', 'url' => 'durgapur.rajshahi.gov.bd'),
        array('id' => '136', 'district_id' => '15', 'name' => 'Mohonpur', 'bn_name' => 'মোহনপুর', 'url' => 'mohonpur.rajshahi.gov.bd'),
        array('id' => '137', 'district_id' => '15', 'name' => 'Charghat', 'bn_name' => 'চারঘাট', 'url' => 'charghat.rajshahi.gov.bd'),
        array('id' => '138', 'district_id' => '15', 'name' => 'Puthia', 'bn_name' => 'পুঠিয়া', 'url' => 'puthia.rajshahi.gov.bd'),
        array('id' => '139', 'district_id' => '15', 'name' => 'Bagha', 'bn_name' => 'বাঘা', 'url' => 'bagha.rajshahi.gov.bd'),
        array('id' => '140', 'district_id' => '15', 'name' => 'Godagari', 'bn_name' => 'গোদাগাড়ী', 'url' => 'godagari.rajshahi.gov.bd'),
        array('id' => '141', 'district_id' => '15', 'name' => 'Tanore', 'bn_name' => 'তানোর', 'url' => 'tanore.rajshahi.gov.bd'),
        array('id' => '142', 'district_id' => '15', 'name' => 'Bagmara', 'bn_name' => 'বাগমারা', 'url' => 'bagmara.rajshahi.gov.bd'),
        array('id' => '143', 'district_id' => '16', 'name' => 'Natore Sadar', 'bn_name' => 'নাটোর সদর', 'url' => 'natoresadar.natore.gov.bd'),
        array('id' => '144', 'district_id' => '16', 'name' => 'Singra', 'bn_name' => 'সিংড়া', 'url' => 'singra.natore.gov.bd'),
        array('id' => '145', 'district_id' => '16', 'name' => 'Baraigram', 'bn_name' => 'বড়াইগ্রাম', 'url' => 'baraigram.natore.gov.bd'),
        array('id' => '146', 'district_id' => '16', 'name' => 'Bagatipara', 'bn_name' => 'বাগাতিপাড়া', 'url' => 'bagatipara.natore.gov.bd'),
        array('id' => '147', 'district_id' => '16', 'name' => 'Lalpur', 'bn_name' => 'লালপুর', 'url' => 'lalpur.natore.gov.bd'),
        array('id' => '148', 'district_id' => '16', 'name' => 'Gurudaspur', 'bn_name' => 'গুরুদাসপুর', 'url' => 'gurudaspur.natore.gov.bd'),
        array('id' => '149', 'district_id' => '16', 'name' => 'Naldanga', 'bn_name' => 'নলডাঙ্গা', 'url' => 'naldanga.natore.gov.bd'),
        array('id' => '150', 'district_id' => '17', 'name' => 'Akkelpur', 'bn_name' => 'আক্কেলপুর', 'url' => 'akkelpur.joypurhat.gov.bd'),
        array('id' => '151', 'district_id' => '17', 'name' => 'Kalai', 'bn_name' => 'কালাই', 'url' => 'kalai.joypurhat.gov.bd'),
        array('id' => '152', 'district_id' => '17', 'name' => 'Khetlal', 'bn_name' => 'ক্ষেতলাল', 'url' => 'khetlal.joypurhat.gov.bd'),
        array('id' => '153', 'district_id' => '17', 'name' => 'Panchbibi', 'bn_name' => 'পাঁচবিবি', 'url' => 'panchbibi.joypurhat.gov.bd'),
        array('id' => '154', 'district_id' => '17', 'name' => 'Joypurhat Sadar', 'bn_name' => 'জয়পুরহাট সদর', 'url' => 'joypurhatsadar.joypurhat.gov.bd'),
        array('id' => '155', 'district_id' => '18', 'name' => 'Chapainawabganj Sadar', 'bn_name' => 'চাঁপাইনবাবগঞ্জ সদর', 'url' => 'chapainawabganjsadar.chapainawabganj.gov.bd'),
        array('id' => '156', 'district_id' => '18', 'name' => 'Gomostapur', 'bn_name' => 'গোমস্তাপুর', 'url' => 'gomostapur.chapainawabganj.gov.bd'),
        array('id' => '157', 'district_id' => '18', 'name' => 'Nachol', 'bn_name' => 'নাচোল', 'url' => 'nachol.chapainawabganj.gov.bd'),
        array('id' => '158', 'district_id' => '18', 'name' => 'Bholahat', 'bn_name' => 'ভোলাহাট', 'url' => 'bholahat.chapainawabganj.gov.bd'),
        array('id' => '159', 'district_id' => '18', 'name' => 'Shibganj', 'bn_name' => 'শিবগঞ্জ', 'url' => 'shibganj.chapainawabganj.gov.bd'),
        array('id' => '160', 'district_id' => '19', 'name' => 'Mohadevpur', 'bn_name' => 'মহাদেবপুর', 'url' => 'mohadevpur.naogaon.gov.bd'),
        array('id' => '161', 'district_id' => '19', 'name' => 'Badalgachi', 'bn_name' => 'বদলগাছী', 'url' => 'badalgachi.naogaon.gov.bd'),
        array('id' => '162', 'district_id' => '19', 'name' => 'Patnitala', 'bn_name' => 'পত্নিতলা', 'url' => 'patnitala.naogaon.gov.bd'),
        array('id' => '163', 'district_id' => '19', 'name' => 'Dhamoirhat', 'bn_name' => 'ধামইরহাট', 'url' => 'dhamoirhat.naogaon.gov.bd'),
        array('id' => '164', 'district_id' => '19', 'name' => 'Niamatpur', 'bn_name' => 'নিয়ামতপুর', 'url' => 'niamatpur.naogaon.gov.bd'),
        array('id' => '165', 'district_id' => '19', 'name' => 'Manda', 'bn_name' => 'মান্দা', 'url' => 'manda.naogaon.gov.bd'),
        array('id' => '166', 'district_id' => '19', 'name' => 'Atrai', 'bn_name' => 'আত্রাই', 'url' => 'atrai.naogaon.gov.bd'),
        array('id' => '167', 'district_id' => '19', 'name' => 'Raninagar', 'bn_name' => 'রাণীনগর', 'url' => 'raninagar.naogaon.gov.bd'),
        array('id' => '168', 'district_id' => '19', 'name' => 'Naogaon Sadar', 'bn_name' => 'নওগাঁ সদর', 'url' => 'naogaonsadar.naogaon.gov.bd'),
        array('id' => '169', 'district_id' => '19', 'name' => 'Porsha', 'bn_name' => 'পোরশা', 'url' => 'porsha.naogaon.gov.bd'),
        array('id' => '170', 'district_id' => '19', 'name' => 'Sapahar', 'bn_name' => 'সাপাহার', 'url' => 'sapahar.naogaon.gov.bd'),
        array('id' => '171', 'district_id' => '20', 'name' => 'Manirampur', 'bn_name' => 'মণিরামপুর', 'url' => 'manirampur.jessore.gov.bd'),
        array('id' => '172', 'district_id' => '20', 'name' => 'Abhaynagar', 'bn_name' => 'অভয়নগর', 'url' => 'abhaynagar.jessore.gov.bd'),
        array('id' => '173', 'district_id' => '20', 'name' => 'Bagherpara', 'bn_name' => 'বাঘারপাড়া', 'url' => 'bagherpara.jessore.gov.bd'),
        array('id' => '174', 'district_id' => '20', 'name' => 'Chougachha', 'bn_name' => 'চৌগাছা', 'url' => 'chougachha.jessore.gov.bd'),
        array('id' => '175', 'district_id' => '20', 'name' => 'Jhikargacha', 'bn_name' => 'ঝিকরগাছা', 'url' => 'jhikargacha.jessore.gov.bd'),
        array('id' => '176', 'district_id' => '20', 'name' => 'Keshabpur', 'bn_name' => 'কেশবপুর', 'url' => 'keshabpur.jessore.gov.bd'),
        array('id' => '177', 'district_id' => '20', 'name' => 'Jessore Sadar', 'bn_name' => 'যশোর সদর', 'url' => 'sadar.jessore.gov.bd'),
        array('id' => '178', 'district_id' => '20', 'name' => 'Sharsha', 'bn_name' => 'শার্শা', 'url' => 'sharsha.jessore.gov.bd'),
        array('id' => '179', 'district_id' => '21', 'name' => 'Assasuni', 'bn_name' => 'আশাশুনি', 'url' => 'assasuni.satkhira.gov.bd'),
        array('id' => '180', 'district_id' => '21', 'name' => 'Debhata', 'bn_name' => 'দেবহাটা', 'url' => 'debhata.satkhira.gov.bd'),
        array('id' => '181', 'district_id' => '21', 'name' => 'Kalaroa', 'bn_name' => 'কলারোয়া', 'url' => 'kalaroa.satkhira.gov.bd'),
        array('id' => '182', 'district_id' => '21', 'name' => 'Satkhira Sadar', 'bn_name' => 'সাতক্ষীরা সদর', 'url' => 'satkhirasadar.satkhira.gov.bd'),
        array('id' => '183', 'district_id' => '21', 'name' => 'Shyamnagar', 'bn_name' => 'শ্যামনগর', 'url' => 'shyamnagar.satkhira.gov.bd'),
        array('id' => '184', 'district_id' => '21', 'name' => 'Tala', 'bn_name' => 'তালা', 'url' => 'tala.satkhira.gov.bd'),
        array('id' => '185', 'district_id' => '21', 'name' => 'Kaliganj', 'bn_name' => 'কালিগঞ্জ', 'url' => 'kaliganj.satkhira.gov.bd'),
        array('id' => '186', 'district_id' => '22', 'name' => 'Mujibnagar', 'bn_name' => 'মুজিবনগর', 'url' => 'mujibnagar.meherpur.gov.bd'),
        array('id' => '187', 'district_id' => '22', 'name' => 'Meherpur Sadar', 'bn_name' => 'মেহেরপুর সদর', 'url' => 'meherpursadar.meherpur.gov.bd'),
        array('id' => '188', 'district_id' => '22', 'name' => 'Gangni', 'bn_name' => 'গাংনী', 'url' => 'gangni.meherpur.gov.bd'),
        array('id' => '189', 'district_id' => '23', 'name' => 'Narail Sadar', 'bn_name' => 'নড়াইল সদর', 'url' => 'narailsadar.narail.gov.bd'),
        array('id' => '190', 'district_id' => '23', 'name' => 'Lohagara', 'bn_name' => 'লোহাগড়া', 'url' => 'lohagara.narail.gov.bd'),
        array('id' => '191', 'district_id' => '23', 'name' => 'Kalia', 'bn_name' => 'কালিয়া', 'url' => 'kalia.narail.gov.bd'),
        array('id' => '192', 'district_id' => '24', 'name' => 'Chuadanga Sadar', 'bn_name' => 'চুয়াডাঙ্গা সদর', 'url' => 'chuadangasadar.chuadanga.gov.bd'),
        array('id' => '193', 'district_id' => '24', 'name' => 'Alamdanga', 'bn_name' => 'আলমডাঙ্গা', 'url' => 'alamdanga.chuadanga.gov.bd'),
        array('id' => '194', 'district_id' => '24', 'name' => 'Damurhuda', 'bn_name' => 'দামুড়হুদা', 'url' => 'damurhuda.chuadanga.gov.bd'),
        array('id' => '195', 'district_id' => '24', 'name' => 'Jibannagar', 'bn_name' => 'জীবননগর', 'url' => 'jibannagar.chuadanga.gov.bd'),
        array('id' => '196', 'district_id' => '25', 'name' => 'Kushtia Sadar', 'bn_name' => 'কুষ্টিয়া সদর', 'url' => 'kushtiasadar.kushtia.gov.bd'),
        array('id' => '197', 'district_id' => '25', 'name' => 'Kumarkhali', 'bn_name' => 'কুমারখালী', 'url' => 'kumarkhali.kushtia.gov.bd'),
        array('id' => '198', 'district_id' => '25', 'name' => 'Khoksa', 'bn_name' => 'খোকসা', 'url' => 'khoksa.kushtia.gov.bd'),
        array('id' => '199', 'district_id' => '25', 'name' => 'Mirpur', 'bn_name' => 'মিরপুর', 'url' => 'mirpurkushtia.kushtia.gov.bd'),
        array('id' => '200', 'district_id' => '25', 'name' => 'Daulatpur', 'bn_name' => 'দৌলতপুর', 'url' => 'daulatpur.kushtia.gov.bd'),
        array('id' => '201', 'district_id' => '25', 'name' => 'Bheramara', 'bn_name' => 'ভেড়ামারা', 'url' => 'bheramara.kushtia.gov.bd'),
        array('id' => '202', 'district_id' => '26', 'name' => 'Shalikha', 'bn_name' => 'শালিখা', 'url' => 'shalikha.magura.gov.bd'),
        array('id' => '203', 'district_id' => '26', 'name' => 'Sreepur', 'bn_name' => 'শ্রীপুর', 'url' => 'sreepur.magura.gov.bd'),
        array('id' => '204', 'district_id' => '26', 'name' => 'Magura Sadar', 'bn_name' => 'মাগুরা সদর', 'url' => 'magurasadar.magura.gov.bd'),
        array('id' => '205', 'district_id' => '26', 'name' => 'Mohammadpur', 'bn_name' => 'মহম্মদপুর', 'url' => 'mohammadpur.magura.gov.bd'),
        array('id' => '206', 'district_id' => '27', 'name' => 'Paikgasa', 'bn_name' => 'পাইকগাছা', 'url' => 'paikgasa.khulna.gov.bd'),
        array('id' => '207', 'district_id' => '27', 'name' => 'Fultola', 'bn_name' => 'ফুলতলা', 'url' => 'fultola.khulna.gov.bd'),
        array('id' => '208', 'district_id' => '27', 'name' => 'Digholia', 'bn_name' => 'দিঘলিয়া', 'url' => 'digholia.khulna.gov.bd'),
        array('id' => '209', 'district_id' => '27', 'name' => 'Rupsha', 'bn_name' => 'রূপসা', 'url' => 'rupsha.khulna.gov.bd'),
        array('id' => '210', 'district_id' => '27', 'name' => 'Terokhada', 'bn_name' => 'তেরখাদা', 'url' => 'terokhada.khulna.gov.bd'),
        array('id' => '211', 'district_id' => '27', 'name' => 'Dumuria', 'bn_name' => 'ডুমুরিয়া', 'url' => 'dumuria.khulna.gov.bd'),
        array('id' => '212', 'district_id' => '27', 'name' => 'Botiaghata', 'bn_name' => 'বটিয়াঘাটা', 'url' => 'botiaghata.khulna.gov.bd'),
        array('id' => '213', 'district_id' => '27', 'name' => 'Dakop', 'bn_name' => 'দাকোপ', 'url' => 'dakop.khulna.gov.bd'),
        array('id' => '214', 'district_id' => '27', 'name' => 'Koyra', 'bn_name' => 'কয়রা', 'url' => 'koyra.khulna.gov.bd'),
        array('id' => '215', 'district_id' => '28', 'name' => 'Fakirhat', 'bn_name' => 'ফকিরহাট', 'url' => 'fakirhat.bagerhat.gov.bd'),
        array('id' => '216', 'district_id' => '28', 'name' => 'Bagerhat Sadar', 'bn_name' => 'বাগেরহাট সদর', 'url' => 'sadar.bagerhat.gov.bd'),
        array('id' => '217', 'district_id' => '28', 'name' => 'Mollahat', 'bn_name' => 'মোল্লাহাট', 'url' => 'mollahat.bagerhat.gov.bd'),
        array('id' => '218', 'district_id' => '28', 'name' => 'Sarankhola', 'bn_name' => 'শরণখোলা', 'url' => 'sarankhola.bagerhat.gov.bd'),
        array('id' => '219', 'district_id' => '28', 'name' => 'Rampal', 'bn_name' => 'রামপাল', 'url' => 'rampal.bagerhat.gov.bd'),
        array('id' => '220', 'district_id' => '28', 'name' => 'Morrelganj', 'bn_name' => 'মোড়েলগঞ্জ', 'url' => 'morrelganj.bagerhat.gov.bd'),
        array('id' => '221', 'district_id' => '28', 'name' => 'Kachua', 'bn_name' => 'কচুয়া', 'url' => 'kachua.bagerhat.gov.bd'),
        array('id' => '222', 'district_id' => '28', 'name' => 'Mongla', 'bn_name' => 'মোংলা', 'url' => 'mongla.bagerhat.gov.bd'),
        array('id' => '223', 'district_id' => '28', 'name' => 'Chitalmari', 'bn_name' => 'চিতলমারী', 'url' => 'chitalmari.bagerhat.gov.bd'),
        array('id' => '224', 'district_id' => '29', 'name' => 'Jhenaidah Sadar', 'bn_name' => 'ঝিনাইদহ সদর', 'url' => 'sadar.jhenaidah.gov.bd'),
        array('id' => '225', 'district_id' => '29', 'name' => 'Shailkupa', 'bn_name' => 'শৈলকুপা', 'url' => 'shailkupa.jhenaidah.gov.bd'),
        array('id' => '226', 'district_id' => '29', 'name' => 'Harinakundu', 'bn_name' => 'হরিণাকুন্ডু', 'url' => 'harinakundu.jhenaidah.gov.bd'),
        array('id' => '227', 'district_id' => '29', 'name' => 'Kaliganj', 'bn_name' => 'কালীগঞ্জ', 'url' => 'kaliganj.jhenaidah.gov.bd'),
        array('id' => '228', 'district_id' => '29', 'name' => 'Kotchandpur', 'bn_name' => 'কোটচাঁদপুর', 'url' => 'kotchandpur.jhenaidah.gov.bd'),
        array('id' => '229', 'district_id' => '29', 'name' => 'Moheshpur', 'bn_name' => 'মহেশপুর', 'url' => 'moheshpur.jhenaidah.gov.bd'),
        array('id' => '230', 'district_id' => '30', 'name' => 'Jhalakathi Sadar', 'bn_name' => 'ঝালকাঠি সদর', 'url' => 'sadar.jhalakathi.gov.bd'),
        array('id' => '231', 'district_id' => '30', 'name' => 'Kathalia', 'bn_name' => 'কাঠালিয়া', 'url' => 'kathalia.jhalakathi.gov.bd'),
        array('id' => '232', 'district_id' => '30', 'name' => 'Nalchity', 'bn_name' => 'নলছিটি', 'url' => 'nalchity.jhalakathi.gov.bd'),
        array('id' => '233', 'district_id' => '30', 'name' => 'Rajapur', 'bn_name' => 'রাজাপুর', 'url' => 'rajapur.jhalakathi.gov.bd'),
        array('id' => '234', 'district_id' => '31', 'name' => 'Bauphal', 'bn_name' => 'বাউফল', 'url' => 'bauphal.patuakhali.gov.bd'),
        array('id' => '235', 'district_id' => '31', 'name' => 'Patuakhali Sadar', 'bn_name' => 'পটুয়াখালী সদর', 'url' => 'sadar.patuakhali.gov.bd'),
        array('id' => '236', 'district_id' => '31', 'name' => 'Dumki', 'bn_name' => 'দুমকি', 'url' => 'dumki.patuakhali.gov.bd'),
        array('id' => '237', 'district_id' => '31', 'name' => 'Dashmina', 'bn_name' => 'দশমিনা', 'url' => 'dashmina.patuakhali.gov.bd'),
        array('id' => '238', 'district_id' => '31', 'name' => 'Kalapara', 'bn_name' => 'কলাপাড়া', 'url' => 'kalapara.patuakhali.gov.bd'),
        array('id' => '239', 'district_id' => '31', 'name' => 'Mirzaganj', 'bn_name' => 'মির্জাগঞ্জ', 'url' => 'mirzaganj.patuakhali.gov.bd'),
        array('id' => '240', 'district_id' => '31', 'name' => 'Galachipa', 'bn_name' => 'গলাচিপা', 'url' => 'galachipa.patuakhali.gov.bd'),
        array('id' => '241', 'district_id' => '31', 'name' => 'Rangabali', 'bn_name' => 'রাঙ্গাবালী', 'url' => 'rangabali.patuakhali.gov.bd'),
        array('id' => '242', 'district_id' => '32', 'name' => 'Pirojpur Sadar', 'bn_name' => 'পিরোজপুর সদর', 'url' => 'sadar.pirojpur.gov.bd'),
        array('id' => '243', 'district_id' => '32', 'name' => 'Nazirpur', 'bn_name' => 'নাজিরপুর', 'url' => 'nazirpur.pirojpur.gov.bd'),
        array('id' => '244', 'district_id' => '32', 'name' => 'Kawkhali', 'bn_name' => 'কাউখালী', 'url' => 'kawkhali.pirojpur.gov.bd'),
        array('id' => '245', 'district_id' => '32', 'name' => 'Zianagar', 'bn_name' => 'জিয়ানগর', 'url' => 'zianagar.pirojpur.gov.bd'),
        array('id' => '246', 'district_id' => '32', 'name' => 'Bhandaria', 'bn_name' => 'ভান্ডারিয়া', 'url' => 'bhandaria.pirojpur.gov.bd'),
        array('id' => '247', 'district_id' => '32', 'name' => 'Mathbaria', 'bn_name' => 'মঠবাড়ীয়া', 'url' => 'mathbaria.pirojpur.gov.bd'),
        array('id' => '248', 'district_id' => '32', 'name' => 'Nesarabad', 'bn_name' => 'নেছারাবাদ', 'url' => 'nesarabad.pirojpur.gov.bd'),
        array('id' => '249', 'district_id' => '33', 'name' => 'Barisal Sadar', 'bn_name' => 'বরিশাল সদর', 'url' => 'barisalsadar.barisal.gov.bd'),
        array('id' => '250', 'district_id' => '33', 'name' => 'Bakerganj', 'bn_name' => 'বাকেরগঞ্জ', 'url' => 'bakerganj.barisal.gov.bd'),
        array('id' => '251', 'district_id' => '33', 'name' => 'Babuganj', 'bn_name' => 'বাবুগঞ্জ', 'url' => 'babuganj.barisal.gov.bd'),
        array('id' => '252', 'district_id' => '33', 'name' => 'Wazirpur', 'bn_name' => 'উজিরপুর', 'url' => 'wazirpur.barisal.gov.bd'),
        array('id' => '253', 'district_id' => '33', 'name' => 'Banaripara', 'bn_name' => 'বানারীপাড়া', 'url' => 'banaripara.barisal.gov.bd'),
        array('id' => '254', 'district_id' => '33', 'name' => 'Gournadi', 'bn_name' => 'গৌরনদী', 'url' => 'gournadi.barisal.gov.bd'),
        array('id' => '255', 'district_id' => '33', 'name' => 'Agailjhara', 'bn_name' => 'আগৈলঝাড়া', 'url' => 'agailjhara.barisal.gov.bd'),
        array('id' => '256', 'district_id' => '33', 'name' => 'Mehendiganj', 'bn_name' => 'মেহেন্দিগঞ্জ', 'url' => 'mehendiganj.barisal.gov.bd'),
        array('id' => '257', 'district_id' => '33', 'name' => 'Muladi', 'bn_name' => 'মুলাদী', 'url' => 'muladi.barisal.gov.bd'),
        array('id' => '258', 'district_id' => '33', 'name' => 'Hizla', 'bn_name' => 'হিজলা', 'url' => 'hizla.barisal.gov.bd'),
        array('id' => '259', 'district_id' => '34', 'name' => 'Bhola Sadar', 'bn_name' => 'ভোলা সদর', 'url' => 'sadar.bhola.gov.bd'),
        array('id' => '260', 'district_id' => '34', 'name' => 'Borhan Sddin', 'bn_name' => 'বোরহান উদ্দিন', 'url' => 'borhanuddin.bhola.gov.bd'),
        array('id' => '261', 'district_id' => '34', 'name' => 'Charfesson', 'bn_name' => 'চরফ্যাশন', 'url' => 'charfesson.bhola.gov.bd'),
        array('id' => '262', 'district_id' => '34', 'name' => 'Doulatkhan', 'bn_name' => 'দৌলতখান', 'url' => 'doulatkhan.bhola.gov.bd'),
        array('id' => '263', 'district_id' => '34', 'name' => 'Monpura', 'bn_name' => 'মনপুরা', 'url' => 'monpura.bhola.gov.bd'),
        array('id' => '264', 'district_id' => '34', 'name' => 'Tazumuddin', 'bn_name' => 'তজুমদ্দিন', 'url' => 'tazumuddin.bhola.gov.bd'),
        array('id' => '265', 'district_id' => '34', 'name' => 'Lalmohan', 'bn_name' => 'লালমোহন', 'url' => 'lalmohan.bhola.gov.bd'),
        array('id' => '266', 'district_id' => '35', 'name' => 'Amtali', 'bn_name' => 'আমতলী', 'url' => 'amtali.barguna.gov.bd'),
        array('id' => '267', 'district_id' => '35', 'name' => 'Barguna Sadar', 'bn_name' => 'বরগুনা সদর', 'url' => 'sadar.barguna.gov.bd'),
        array('id' => '268', 'district_id' => '35', 'name' => 'Betagi', 'bn_name' => 'বেতাগী', 'url' => 'betagi.barguna.gov.bd'),
        array('id' => '269', 'district_id' => '35', 'name' => 'Bamna', 'bn_name' => 'বামনা', 'url' => 'bamna.barguna.gov.bd'),
        array('id' => '270', 'district_id' => '35', 'name' => 'Pathorghata', 'bn_name' => 'পাথরঘাটা', 'url' => 'pathorghata.barguna.gov.bd'),
        array('id' => '271', 'district_id' => '35', 'name' => 'Taltali', 'bn_name' => 'তালতলি', 'url' => 'taltali.barguna.gov.bd'),
        array('id' => '272', 'district_id' => '36', 'name' => 'Balaganj', 'bn_name' => 'বালাগঞ্জ', 'url' => 'balaganj.sylhet.gov.bd'),
        array('id' => '273', 'district_id' => '36', 'name' => 'Beanibazar', 'bn_name' => 'বিয়ানীবাজার', 'url' => 'beanibazar.sylhet.gov.bd'),
        array('id' => '274', 'district_id' => '36', 'name' => 'Bishwanath', 'bn_name' => 'বিশ্বনাথ', 'url' => 'bishwanath.sylhet.gov.bd'),
        array('id' => '275', 'district_id' => '36', 'name' => 'Companiganj', 'bn_name' => 'কোম্পানীগঞ্জ', 'url' => 'companiganj.sylhet.gov.bd'),
        array('id' => '276', 'district_id' => '36', 'name' => 'Fenchuganj', 'bn_name' => 'ফেঞ্চুগঞ্জ', 'url' => 'fenchuganj.sylhet.gov.bd'),
        array('id' => '277', 'district_id' => '36', 'name' => 'Golapganj', 'bn_name' => 'গোলাপগঞ্জ', 'url' => 'golapganj.sylhet.gov.bd'),
        array('id' => '278', 'district_id' => '36', 'name' => 'Gowainghat', 'bn_name' => 'গোয়াইনঘাট', 'url' => 'gowainghat.sylhet.gov.bd'),
        array('id' => '279', 'district_id' => '36', 'name' => 'Jaintiapur', 'bn_name' => 'জৈন্তাপুর', 'url' => 'jaintiapur.sylhet.gov.bd'),
        array('id' => '280', 'district_id' => '36', 'name' => 'Kanaighat', 'bn_name' => 'কানাইঘাট', 'url' => 'kanaighat.sylhet.gov.bd'),
        array('id' => '281', 'district_id' => '36', 'name' => 'Sylhet Sadar', 'bn_name' => 'সিলেট সদর', 'url' => 'sylhetsadar.sylhet.gov.bd'),
        array('id' => '282', 'district_id' => '36', 'name' => 'Zakiganj', 'bn_name' => 'জকিগঞ্জ', 'url' => 'zakiganj.sylhet.gov.bd'),
        array('id' => '283', 'district_id' => '36', 'name' => 'Dakshinsurma', 'bn_name' => 'দক্ষিণ সুরমা', 'url' => 'dakshinsurma.sylhet.gov.bd'),
        array('id' => '284', 'district_id' => '36', 'name' => 'Osmaninagar', 'bn_name' => 'ওসমানী নগর', 'url' => 'osmaninagar.sylhet.gov.bd'),
        array('id' => '285', 'district_id' => '37', 'name' => 'Barlekha', 'bn_name' => 'বড়লেখা', 'url' => 'barlekha.moulvibazar.gov.bd'),
        array('id' => '286', 'district_id' => '37', 'name' => 'Kamolganj', 'bn_name' => 'কমলগঞ্জ', 'url' => 'kamolganj.moulvibazar.gov.bd'),
        array('id' => '287', 'district_id' => '37', 'name' => 'Kulaura', 'bn_name' => 'কুলাউড়া', 'url' => 'kulaura.moulvibazar.gov.bd'),
        array('id' => '288', 'district_id' => '37', 'name' => 'Moulvibazar Sadar', 'bn_name' => 'মৌলভীবাজার সদর', 'url' => 'moulvibazarsadar.moulvibazar.gov.bd'),
        array('id' => '289', 'district_id' => '37', 'name' => 'Rajnagar', 'bn_name' => 'রাজনগর', 'url' => 'rajnagar.moulvibazar.gov.bd'),
        array('id' => '290', 'district_id' => '37', 'name' => 'Sreemangal', 'bn_name' => 'শ্রীমঙ্গল', 'url' => 'sreemangal.moulvibazar.gov.bd'),
        array('id' => '291', 'district_id' => '37', 'name' => 'Juri', 'bn_name' => 'জুড়ী', 'url' => 'juri.moulvibazar.gov.bd'),
        array('id' => '292', 'district_id' => '38', 'name' => 'Nabiganj', 'bn_name' => 'নবীগঞ্জ', 'url' => 'nabiganj.habiganj.gov.bd'),
        array('id' => '293', 'district_id' => '38', 'name' => 'Bahubal', 'bn_name' => 'বাহুবল', 'url' => 'bahubal.habiganj.gov.bd'),
        array('id' => '294', 'district_id' => '38', 'name' => 'Ajmiriganj', 'bn_name' => 'আজমিরীগঞ্জ', 'url' => 'ajmiriganj.habiganj.gov.bd'),
        array('id' => '295', 'district_id' => '38', 'name' => 'Baniachong', 'bn_name' => 'বানিয়াচং', 'url' => 'baniachong.habiganj.gov.bd'),
        array('id' => '296', 'district_id' => '38', 'name' => 'Lakhai', 'bn_name' => 'লাখাই', 'url' => 'lakhai.habiganj.gov.bd'),
        array('id' => '297', 'district_id' => '38', 'name' => 'Chunarughat', 'bn_name' => 'চুনারুঘাট', 'url' => 'chunarughat.habiganj.gov.bd'),
        array('id' => '298', 'district_id' => '38', 'name' => 'Habiganj Sadar', 'bn_name' => 'হবিগঞ্জ সদর', 'url' => 'habiganjsadar.habiganj.gov.bd'),
        array('id' => '299', 'district_id' => '38', 'name' => 'Madhabpur', 'bn_name' => 'মাধবপুর', 'url' => 'madhabpur.habiganj.gov.bd'),
        array('id' => '300', 'district_id' => '39', 'name' => 'Sunamganj Sadar', 'bn_name' => 'সুনামগঞ্জ সদর', 'url' => 'sadar.sunamganj.gov.bd'),
        array('id' => '301', 'district_id' => '39', 'name' => 'South Sunamganj', 'bn_name' => 'দক্ষিণ সুনামগঞ্জ', 'url' => 'southsunamganj.sunamganj.gov.bd'),
        array('id' => '302', 'district_id' => '39', 'name' => 'Bishwambarpur', 'bn_name' => 'বিশ্বম্ভরপুর', 'url' => 'bishwambarpur.sunamganj.gov.bd'),
        array('id' => '303', 'district_id' => '39', 'name' => 'Chhatak', 'bn_name' => 'ছাতক', 'url' => 'chhatak.sunamganj.gov.bd'),
        array('id' => '304', 'district_id' => '39', 'name' => 'Jagannathpur', 'bn_name' => 'জগন্নাথপুর', 'url' => 'jagannathpur.sunamganj.gov.bd'),
        array('id' => '305', 'district_id' => '39', 'name' => 'Dowarabazar', 'bn_name' => 'দোয়ারাবাজার', 'url' => 'dowarabazar.sunamganj.gov.bd'),
        array('id' => '306', 'district_id' => '39', 'name' => 'Tahirpur', 'bn_name' => 'তাহিরপুর', 'url' => 'tahirpur.sunamganj.gov.bd'),
        array('id' => '307', 'district_id' => '39', 'name' => 'Dharmapasha', 'bn_name' => 'ধর্মপাশা', 'url' => 'dharmapasha.sunamganj.gov.bd'),
        array('id' => '308', 'district_id' => '39', 'name' => 'Jamalganj', 'bn_name' => 'জামালগঞ্জ', 'url' => 'jamalganj.sunamganj.gov.bd'),
        array('id' => '309', 'district_id' => '39', 'name' => 'Shalla', 'bn_name' => 'শাল্লা', 'url' => 'shalla.sunamganj.gov.bd'),
        array('id' => '310', 'district_id' => '39', 'name' => 'Derai', 'bn_name' => 'দিরাই', 'url' => 'derai.sunamganj.gov.bd'),
        array('id' => '311', 'district_id' => '40', 'name' => 'Belabo', 'bn_name' => 'বেলাবো', 'url' => 'belabo.narsingdi.gov.bd'),
        array('id' => '312', 'district_id' => '40', 'name' => 'Monohardi', 'bn_name' => 'মনোহরদী', 'url' => 'monohardi.narsingdi.gov.bd'),
        array('id' => '313', 'district_id' => '40', 'name' => 'Narsingdi Sadar', 'bn_name' => 'নরসিংদী সদর', 'url' => 'narsingdisadar.narsingdi.gov.bd'),
        array('id' => '314', 'district_id' => '40', 'name' => 'Palash', 'bn_name' => 'পলাশ', 'url' => 'palash.narsingdi.gov.bd'),
        array('id' => '315', 'district_id' => '40', 'name' => 'Raipura', 'bn_name' => 'রায়পুরা', 'url' => 'raipura.narsingdi.gov.bd'),
        array('id' => '316', 'district_id' => '40', 'name' => 'Shibpur', 'bn_name' => 'শিবপুর', 'url' => 'shibpur.narsingdi.gov.bd'),
        array('id' => '317', 'district_id' => '41', 'name' => 'Kaliganj', 'bn_name' => 'কালীগঞ্জ', 'url' => 'kaliganj.gazipur.gov.bd'),
        array('id' => '318', 'district_id' => '41', 'name' => 'Kaliakair', 'bn_name' => 'কালিয়াকৈর', 'url' => 'kaliakair.gazipur.gov.bd'),
        array('id' => '319', 'district_id' => '41', 'name' => 'Kapasia', 'bn_name' => 'কাপাসিয়া', 'url' => 'kapasia.gazipur.gov.bd'),
        array('id' => '320', 'district_id' => '41', 'name' => 'Gazipur Sadar', 'bn_name' => 'গাজীপুর সদর', 'url' => 'sadar.gazipur.gov.bd'),
        array('id' => '321', 'district_id' => '41', 'name' => 'Sreepur', 'bn_name' => 'শ্রীপুর', 'url' => 'sreepur.gazipur.gov.bd'),
        array('id' => '322', 'district_id' => '42', 'name' => 'Shariatpur Sadar', 'bn_name' => 'শরিয়তপুর সদর', 'url' => 'sadar.shariatpur.gov.bd'),
        array('id' => '323', 'district_id' => '42', 'name' => 'Naria', 'bn_name' => 'নড়িয়া', 'url' => 'naria.shariatpur.gov.bd'),
        array('id' => '324', 'district_id' => '42', 'name' => 'Zajira', 'bn_name' => 'জাজিরা', 'url' => 'zajira.shariatpur.gov.bd'),
        array('id' => '325', 'district_id' => '42', 'name' => 'Gosairhat', 'bn_name' => 'গোসাইরহাট', 'url' => 'gosairhat.shariatpur.gov.bd'),
        array('id' => '326', 'district_id' => '42', 'name' => 'Bhedarganj', 'bn_name' => 'ভেদরগঞ্জ', 'url' => 'bhedarganj.shariatpur.gov.bd'),
        array('id' => '327', 'district_id' => '42', 'name' => 'Damudya', 'bn_name' => 'ডামুড্যা', 'url' => 'damudya.shariatpur.gov.bd'),
        array('id' => '328', 'district_id' => '43', 'name' => 'Araihazar', 'bn_name' => 'আড়াইহাজার', 'url' => 'araihazar.narayanganj.gov.bd'),
        array('id' => '329', 'district_id' => '43', 'name' => 'Bandar', 'bn_name' => 'বন্দর', 'url' => 'bandar.narayanganj.gov.bd'),
        array('id' => '330', 'district_id' => '43', 'name' => 'Narayanganj Sadar', 'bn_name' => 'নারায়নগঞ্জ সদর', 'url' => 'narayanganjsadar.narayanganj.gov.bd'),
        array('id' => '331', 'district_id' => '43', 'name' => 'Rupganj', 'bn_name' => 'রূপগঞ্জ', 'url' => 'rupganj.narayanganj.gov.bd'),
        array('id' => '332', 'district_id' => '43', 'name' => 'Sonargaon', 'bn_name' => 'সোনারগাঁ', 'url' => 'sonargaon.narayanganj.gov.bd'),
        array('id' => '333', 'district_id' => '44', 'name' => 'Basail', 'bn_name' => 'বাসাইল', 'url' => 'basail.tangail.gov.bd'),
        array('id' => '334', 'district_id' => '44', 'name' => 'Bhuapur', 'bn_name' => 'ভুয়াপুর', 'url' => 'bhuapur.tangail.gov.bd'),
        array('id' => '335', 'district_id' => '44', 'name' => 'Delduar', 'bn_name' => 'দেলদুয়ার', 'url' => 'delduar.tangail.gov.bd'),
        array('id' => '336', 'district_id' => '44', 'name' => 'Ghatail', 'bn_name' => 'ঘাটাইল', 'url' => 'ghatail.tangail.gov.bd'),
        array('id' => '337', 'district_id' => '44', 'name' => 'Gopalpur', 'bn_name' => 'গোপালপুর', 'url' => 'gopalpur.tangail.gov.bd'),
        array('id' => '338', 'district_id' => '44', 'name' => 'Madhupur', 'bn_name' => 'মধুপুর', 'url' => 'madhupur.tangail.gov.bd'),
        array('id' => '339', 'district_id' => '44', 'name' => 'Mirzapur', 'bn_name' => 'মির্জাপুর', 'url' => 'mirzapur.tangail.gov.bd'),
        array('id' => '340', 'district_id' => '44', 'name' => 'Nagarpur', 'bn_name' => 'নাগরপুর', 'url' => 'nagarpur.tangail.gov.bd'),
        array('id' => '341', 'district_id' => '44', 'name' => 'Sakhipur', 'bn_name' => 'সখিপুর', 'url' => 'sakhipur.tangail.gov.bd'),
        array('id' => '342', 'district_id' => '44', 'name' => 'Tangail Sadar', 'bn_name' => 'টাঙ্গাইল সদর', 'url' => 'tangailsadar.tangail.gov.bd'),
        array('id' => '343', 'district_id' => '44', 'name' => 'Kalihati', 'bn_name' => 'কালিহাতী', 'url' => 'kalihati.tangail.gov.bd'),
        array('id' => '344', 'district_id' => '44', 'name' => 'Dhanbari', 'bn_name' => 'ধনবাড়ী', 'url' => 'dhanbari.tangail.gov.bd'),
        array('id' => '345', 'district_id' => '45', 'name' => 'Itna', 'bn_name' => 'ইটনা', 'url' => 'itna.kishoreganj.gov.bd'),
        array('id' => '346', 'district_id' => '45', 'name' => 'Katiadi', 'bn_name' => 'কটিয়াদী', 'url' => 'katiadi.kishoreganj.gov.bd'),
        array('id' => '347', 'district_id' => '45', 'name' => 'Bhairab', 'bn_name' => 'ভৈরব', 'url' => 'bhairab.kishoreganj.gov.bd'),
        array('id' => '348', 'district_id' => '45', 'name' => 'Tarail', 'bn_name' => 'তাড়াইল', 'url' => 'tarail.kishoreganj.gov.bd'),
        array('id' => '349', 'district_id' => '45', 'name' => 'Hossainpur', 'bn_name' => 'হোসেনপুর', 'url' => 'hossainpur.kishoreganj.gov.bd'),
        array('id' => '350', 'district_id' => '45', 'name' => 'Pakundia', 'bn_name' => 'পাকুন্দিয়া', 'url' => 'pakundia.kishoreganj.gov.bd'),
        array('id' => '351', 'district_id' => '45', 'name' => 'Kuliarchar', 'bn_name' => 'কুলিয়ারচর', 'url' => 'kuliarchar.kishoreganj.gov.bd'),
        array('id' => '352', 'district_id' => '45', 'name' => 'Kishoreganj Sadar', 'bn_name' => 'কিশোরগঞ্জ সদর', 'url' => 'kishoreganjsadar.kishoreganj.gov.bd'),
        array('id' => '353', 'district_id' => '45', 'name' => 'Karimgonj', 'bn_name' => 'করিমগঞ্জ', 'url' => 'karimgonj.kishoreganj.gov.bd'),
        array('id' => '354', 'district_id' => '45', 'name' => 'Bajitpur', 'bn_name' => 'বাজিতপুর', 'url' => 'bajitpur.kishoreganj.gov.bd'),
        array('id' => '355', 'district_id' => '45', 'name' => 'Austagram', 'bn_name' => 'অষ্টগ্রাম', 'url' => 'austagram.kishoreganj.gov.bd'),
        array('id' => '356', 'district_id' => '45', 'name' => 'Mithamoin', 'bn_name' => 'মিঠামইন', 'url' => 'mithamoin.kishoreganj.gov.bd'),
        array('id' => '357', 'district_id' => '45', 'name' => 'Nikli', 'bn_name' => 'নিকলী', 'url' => 'nikli.kishoreganj.gov.bd'),
        array('id' => '358', 'district_id' => '46', 'name' => 'Harirampur', 'bn_name' => 'হরিরামপুর', 'url' => 'harirampur.manikganj.gov.bd'),
        array('id' => '359', 'district_id' => '46', 'name' => 'Saturia', 'bn_name' => 'সাটুরিয়া', 'url' => 'saturia.manikganj.gov.bd'),
        array('id' => '360', 'district_id' => '46', 'name' => 'Manikganj Sadar', 'bn_name' => 'মানিকগঞ্জ সদর', 'url' => 'sadar.manikganj.gov.bd'),
        array('id' => '361', 'district_id' => '46', 'name' => 'Gior', 'bn_name' => 'ঘিওর', 'url' => 'gior.manikganj.gov.bd'),
        array('id' => '362', 'district_id' => '46', 'name' => 'Shibaloy', 'bn_name' => 'শিবালয়', 'url' => 'shibaloy.manikganj.gov.bd'),
        array('id' => '363', 'district_id' => '46', 'name' => 'Doulatpur', 'bn_name' => 'দৌলতপুর', 'url' => 'doulatpur.manikganj.gov.bd'),
        array('id' => '364', 'district_id' => '46', 'name' => 'Singiar', 'bn_name' => 'সিংগাইর', 'url' => 'singiar.manikganj.gov.bd'),
        array('id' => '365', 'district_id' => '47', 'name' => 'Savar', 'bn_name' => 'সাভার', 'url' => 'savar.dhaka.gov.bd'),
        array('id' => '366', 'district_id' => '47', 'name' => 'Dhamrai', 'bn_name' => 'ধামরাই', 'url' => 'dhamrai.dhaka.gov.bd'),
        array('id' => '367', 'district_id' => '47', 'name' => 'Keraniganj', 'bn_name' => 'কেরাণীগঞ্জ', 'url' => 'keraniganj.dhaka.gov.bd'),
        array('id' => '368', 'district_id' => '47', 'name' => 'Nawabganj', 'bn_name' => 'নবাবগঞ্জ', 'url' => 'nawabganj.dhaka.gov.bd'),
        array('id' => '369', 'district_id' => '47', 'name' => 'Dohar', 'bn_name' => 'দোহার', 'url' => 'dohar.dhaka.gov.bd'),
        array('id' => '370', 'district_id' => '48', 'name' => 'Munshiganj Sadar', 'bn_name' => 'মুন্সিগঞ্জ সদর', 'url' => 'sadar.munshiganj.gov.bd'),
        array('id' => '371', 'district_id' => '48', 'name' => 'Sreenagar', 'bn_name' => 'শ্রীনগর', 'url' => 'sreenagar.munshiganj.gov.bd'),
        array('id' => '372', 'district_id' => '48', 'name' => 'Sirajdikhan', 'bn_name' => 'সিরাজদিখান', 'url' => 'sirajdikhan.munshiganj.gov.bd'),
        array('id' => '373', 'district_id' => '48', 'name' => 'Louhajanj', 'bn_name' => 'লৌহজং', 'url' => 'louhajanj.munshiganj.gov.bd'),
        array('id' => '374', 'district_id' => '48', 'name' => 'Gajaria', 'bn_name' => 'গজারিয়া', 'url' => 'gajaria.munshiganj.gov.bd'),
        array('id' => '375', 'district_id' => '48', 'name' => 'Tongibari', 'bn_name' => 'টংগীবাড়ি', 'url' => 'tongibari.munshiganj.gov.bd'),
        array('id' => '376', 'district_id' => '49', 'name' => 'Rajbari Sadar', 'bn_name' => 'রাজবাড়ী সদর', 'url' => 'sadar.rajbari.gov.bd'),
        array('id' => '377', 'district_id' => '49', 'name' => 'Goalanda', 'bn_name' => 'গোয়ালন্দ', 'url' => 'goalanda.rajbari.gov.bd'),
        array('id' => '378', 'district_id' => '49', 'name' => 'Pangsa', 'bn_name' => 'পাংশা', 'url' => 'pangsa.rajbari.gov.bd'),
        array('id' => '379', 'district_id' => '49', 'name' => 'Baliakandi', 'bn_name' => 'বালিয়াকান্দি', 'url' => 'baliakandi.rajbari.gov.bd'),
        array('id' => '380', 'district_id' => '49', 'name' => 'Kalukhali', 'bn_name' => 'কালুখালী', 'url' => 'kalukhali.rajbari.gov.bd'),
        array('id' => '381', 'district_id' => '50', 'name' => 'Madaripur Sadar', 'bn_name' => 'মাদারীপুর সদর', 'url' => 'sadar.madaripur.gov.bd'),
        array('id' => '382', 'district_id' => '50', 'name' => 'Shibchar', 'bn_name' => 'শিবচর', 'url' => 'shibchar.madaripur.gov.bd'),
        array('id' => '383', 'district_id' => '50', 'name' => 'Kalkini', 'bn_name' => 'কালকিনি', 'url' => 'kalkini.madaripur.gov.bd'),
        array('id' => '384', 'district_id' => '50', 'name' => 'Rajoir', 'bn_name' => 'রাজৈর', 'url' => 'rajoir.madaripur.gov.bd'),
        array('id' => '385', 'district_id' => '51', 'name' => 'Gopalganj Sadar', 'bn_name' => 'গোপালগঞ্জ সদর', 'url' => 'sadar.gopalganj.gov.bd'),
        array('id' => '386', 'district_id' => '51', 'name' => 'Kashiani', 'bn_name' => 'কাশিয়ানী', 'url' => 'kashiani.gopalganj.gov.bd'),
        array('id' => '387', 'district_id' => '51', 'name' => 'Tungipara', 'bn_name' => 'টুংগীপাড়া', 'url' => 'tungipara.gopalganj.gov.bd'),
        array('id' => '388', 'district_id' => '51', 'name' => 'Kotalipara', 'bn_name' => 'কোটালীপাড়া', 'url' => 'kotalipara.gopalganj.gov.bd'),
        array('id' => '389', 'district_id' => '51', 'name' => 'Muksudpur', 'bn_name' => 'মুকসুদপুর', 'url' => 'muksudpur.gopalganj.gov.bd'),
        array('id' => '390', 'district_id' => '52', 'name' => 'Faridpur Sadar', 'bn_name' => 'ফরিদপুর সদর', 'url' => 'sadar.faridpur.gov.bd'),
        array('id' => '391', 'district_id' => '52', 'name' => 'Alfadanga', 'bn_name' => 'আলফাডাঙ্গা', 'url' => 'alfadanga.faridpur.gov.bd'),
        array('id' => '392', 'district_id' => '52', 'name' => 'Boalmari', 'bn_name' => 'বোয়ালমারী', 'url' => 'boalmari.faridpur.gov.bd'),
        array('id' => '393', 'district_id' => '52', 'name' => 'Sadarpur', 'bn_name' => 'সদরপুর', 'url' => 'sadarpur.faridpur.gov.bd'),
        array('id' => '394', 'district_id' => '52', 'name' => 'Nagarkanda', 'bn_name' => 'নগরকান্দা', 'url' => 'nagarkanda.faridpur.gov.bd'),
        array('id' => '395', 'district_id' => '52', 'name' => 'Bhanga', 'bn_name' => 'ভাঙ্গা', 'url' => 'bhanga.faridpur.gov.bd'),
        array('id' => '396', 'district_id' => '52', 'name' => 'Charbhadrasan', 'bn_name' => 'চরভদ্রাসন', 'url' => 'charbhadrasan.faridpur.gov.bd'),
        array('id' => '397', 'district_id' => '52', 'name' => 'Madhukhali', 'bn_name' => 'মধুখালী', 'url' => 'madhukhali.faridpur.gov.bd'),
        array('id' => '398', 'district_id' => '52', 'name' => 'Saltha', 'bn_name' => 'সালথা', 'url' => 'saltha.faridpur.gov.bd'),
        array('id' => '399', 'district_id' => '53', 'name' => 'Panchagarh Sadar', 'bn_name' => 'পঞ্চগড় সদর', 'url' => 'panchagarhsadar.panchagarh.gov.bd'),
        array('id' => '400', 'district_id' => '53', 'name' => 'Debiganj', 'bn_name' => 'দেবীগঞ্জ', 'url' => 'debiganj.panchagarh.gov.bd'),
        array('id' => '401', 'district_id' => '53', 'name' => 'Boda', 'bn_name' => 'বোদা', 'url' => 'boda.panchagarh.gov.bd'),
        array('id' => '402', 'district_id' => '53', 'name' => 'Atwari', 'bn_name' => 'আটোয়ারী', 'url' => 'atwari.panchagarh.gov.bd'),
        array('id' => '403', 'district_id' => '53', 'name' => 'Tetulia', 'bn_name' => 'তেতুলিয়া', 'url' => 'tetulia.panchagarh.gov.bd'),
        array('id' => '404', 'district_id' => '54', 'name' => 'Nawabganj', 'bn_name' => 'নবাবগঞ্জ', 'url' => 'nawabganj.dinajpur.gov.bd'),
        array('id' => '405', 'district_id' => '54', 'name' => 'Birganj', 'bn_name' => 'বীরগঞ্জ', 'url' => 'birganj.dinajpur.gov.bd'),
        array('id' => '406', 'district_id' => '54', 'name' => 'Ghoraghat', 'bn_name' => 'ঘোড়াঘাট', 'url' => 'ghoraghat.dinajpur.gov.bd'),
        array('id' => '407', 'district_id' => '54', 'name' => 'Birampur', 'bn_name' => 'বিরামপুর', 'url' => 'birampur.dinajpur.gov.bd'),
        array('id' => '408', 'district_id' => '54', 'name' => 'Parbatipur', 'bn_name' => 'পার্বতীপুর', 'url' => 'parbatipur.dinajpur.gov.bd'),
        array('id' => '409', 'district_id' => '54', 'name' => 'Bochaganj', 'bn_name' => 'বোচাগঞ্জ', 'url' => 'bochaganj.dinajpur.gov.bd'),
        array('id' => '410', 'district_id' => '54', 'name' => 'Kaharol', 'bn_name' => 'কাহারোল', 'url' => 'kaharol.dinajpur.gov.bd'),
        array('id' => '411', 'district_id' => '54', 'name' => 'Fulbari', 'bn_name' => 'ফুলবাড়ী', 'url' => 'fulbari.dinajpur.gov.bd'),
        array('id' => '412', 'district_id' => '54', 'name' => 'Dinajpur Sadar', 'bn_name' => 'দিনাজপুর সদর', 'url' => 'dinajpursadar.dinajpur.gov.bd'),
        array('id' => '413', 'district_id' => '54', 'name' => 'Hakimpur', 'bn_name' => 'হাকিমপুর', 'url' => 'hakimpur.dinajpur.gov.bd'),
        array('id' => '414', 'district_id' => '54', 'name' => 'Khansama', 'bn_name' => 'খানসামা', 'url' => 'khansama.dinajpur.gov.bd'),
        array('id' => '415', 'district_id' => '54', 'name' => 'Birol', 'bn_name' => 'বিরল', 'url' => 'birol.dinajpur.gov.bd'),
        array('id' => '416', 'district_id' => '54', 'name' => 'Chirirbandar', 'bn_name' => 'চিরিরবন্দর', 'url' => 'chirirbandar.dinajpur.gov.bd'),
        array('id' => '417', 'district_id' => '55', 'name' => 'Lalmonirhat Sadar', 'bn_name' => 'লালমনিরহাট সদর', 'url' => 'sadar.lalmonirhat.gov.bd'),
        array('id' => '418', 'district_id' => '55', 'name' => 'Kaliganj', 'bn_name' => 'কালীগঞ্জ', 'url' => 'kaliganj.lalmonirhat.gov.bd'),
        array('id' => '419', 'district_id' => '55', 'name' => 'Hatibandha', 'bn_name' => 'হাতীবান্ধা', 'url' => 'hatibandha.lalmonirhat.gov.bd'),
        array('id' => '420', 'district_id' => '55', 'name' => 'Patgram', 'bn_name' => 'পাটগ্রাম', 'url' => 'patgram.lalmonirhat.gov.bd'),
        array('id' => '421', 'district_id' => '55', 'name' => 'Aditmari', 'bn_name' => 'আদিতমারী', 'url' => 'aditmari.lalmonirhat.gov.bd'),
        array('id' => '422', 'district_id' => '56', 'name' => 'Syedpur', 'bn_name' => 'সৈয়দপুর', 'url' => 'syedpur.nilphamari.gov.bd'),
        array('id' => '423', 'district_id' => '56', 'name' => 'Domar', 'bn_name' => 'ডোমার', 'url' => 'domar.nilphamari.gov.bd'),
        array('id' => '424', 'district_id' => '56', 'name' => 'Dimla', 'bn_name' => 'ডিমলা', 'url' => 'dimla.nilphamari.gov.bd'),
        array('id' => '425', 'district_id' => '56', 'name' => 'Jaldhaka', 'bn_name' => 'জলঢাকা', 'url' => 'jaldhaka.nilphamari.gov.bd'),
        array('id' => '426', 'district_id' => '56', 'name' => 'Kishorganj', 'bn_name' => 'কিশোরগঞ্জ', 'url' => 'kishorganj.nilphamari.gov.bd'),
        array('id' => '427', 'district_id' => '56', 'name' => 'Nilphamari Sadar', 'bn_name' => 'নীলফামারী সদর', 'url' => 'nilphamarisadar.nilphamari.gov.bd'),
        array('id' => '428', 'district_id' => '57', 'name' => 'Sadullapur', 'bn_name' => 'সাদুল্লাপুর', 'url' => 'sadullapur.gaibandha.gov.bd'),
        array('id' => '429', 'district_id' => '57', 'name' => 'Gaibandha Sadar', 'bn_name' => 'গাইবান্ধা সদর', 'url' => 'gaibandhasadar.gaibandha.gov.bd'),
        array('id' => '430', 'district_id' => '57', 'name' => 'Palashbari', 'bn_name' => 'পলাশবাড়ী', 'url' => 'palashbari.gaibandha.gov.bd'),
        array('id' => '431', 'district_id' => '57', 'name' => 'Saghata', 'bn_name' => 'সাঘাটা', 'url' => 'saghata.gaibandha.gov.bd'),
        array('id' => '432', 'district_id' => '57', 'name' => 'Gobindaganj', 'bn_name' => 'গোবিন্দগঞ্জ', 'url' => 'gobindaganj.gaibandha.gov.bd'),
        array('id' => '433', 'district_id' => '57', 'name' => 'Sundarganj', 'bn_name' => 'সুন্দরগঞ্জ', 'url' => 'sundarganj.gaibandha.gov.bd'),
        array('id' => '434', 'district_id' => '57', 'name' => 'Phulchari', 'bn_name' => 'ফুলছড়ি', 'url' => 'phulchari.gaibandha.gov.bd'),
        array('id' => '435', 'district_id' => '58', 'name' => 'Thakurgaon Sadar', 'bn_name' => 'ঠাকুরগাঁও সদর', 'url' => 'thakurgaonsadar.thakurgaon.gov.bd'),
        array('id' => '436', 'district_id' => '58', 'name' => 'Pirganj', 'bn_name' => 'পীরগঞ্জ', 'url' => 'pirganj.thakurgaon.gov.bd'),
        array('id' => '437', 'district_id' => '58', 'name' => 'Ranisankail', 'bn_name' => 'রাণীশংকৈল', 'url' => 'ranisankail.thakurgaon.gov.bd'),
        array('id' => '438', 'district_id' => '58', 'name' => 'Haripur', 'bn_name' => 'হরিপুর', 'url' => 'haripur.thakurgaon.gov.bd'),
        array('id' => '439', 'district_id' => '58', 'name' => 'Baliadangi', 'bn_name' => 'বালিয়াডাঙ্গী', 'url' => 'baliadangi.thakurgaon.gov.bd'),
        array('id' => '440', 'district_id' => '59', 'name' => 'Rangpur Sadar', 'bn_name' => 'রংপুর সদর', 'url' => 'rangpursadar.rangpur.gov.bd'),
        array('id' => '441', 'district_id' => '59', 'name' => 'Gangachara', 'bn_name' => 'গংগাচড়া', 'url' => 'gangachara.rangpur.gov.bd'),
        array('id' => '442', 'district_id' => '59', 'name' => 'Taragonj', 'bn_name' => 'তারাগঞ্জ', 'url' => 'taragonj.rangpur.gov.bd'),
        array('id' => '443', 'district_id' => '59', 'name' => 'Badargonj', 'bn_name' => 'বদরগঞ্জ', 'url' => 'badargonj.rangpur.gov.bd'),
        array('id' => '444', 'district_id' => '59', 'name' => 'Mithapukur', 'bn_name' => 'মিঠাপুকুর', 'url' => 'mithapukur.rangpur.gov.bd'),
        array('id' => '445', 'district_id' => '59', 'name' => 'Pirgonj', 'bn_name' => 'পীরগঞ্জ', 'url' => 'pirgonj.rangpur.gov.bd'),
        array('id' => '446', 'district_id' => '59', 'name' => 'Kaunia', 'bn_name' => 'কাউনিয়া', 'url' => 'kaunia.rangpur.gov.bd'),
        array('id' => '447', 'district_id' => '59', 'name' => 'Pirgacha', 'bn_name' => 'পীরগাছা', 'url' => 'pirgacha.rangpur.gov.bd'),
        array('id' => '448', 'district_id' => '60', 'name' => 'Kurigram Sadar', 'bn_name' => 'কুড়িগ্রাম সদর', 'url' => 'kurigramsadar.kurigram.gov.bd'),
        array('id' => '449', 'district_id' => '60', 'name' => 'Nageshwari', 'bn_name' => 'নাগেশ্বরী', 'url' => 'nageshwari.kurigram.gov.bd'),
        array('id' => '450', 'district_id' => '60', 'name' => 'Bhurungamari', 'bn_name' => 'ভুরুঙ্গামারী', 'url' => 'bhurungamari.kurigram.gov.bd'),
        array('id' => '451', 'district_id' => '60', 'name' => 'Phulbari', 'bn_name' => 'ফুলবাড়ী', 'url' => 'phulbari.kurigram.gov.bd'),
        array('id' => '452', 'district_id' => '60', 'name' => 'Rajarhat', 'bn_name' => 'রাজারহাট', 'url' => 'rajarhat.kurigram.gov.bd'),
        array('id' => '453', 'district_id' => '60', 'name' => 'Ulipur', 'bn_name' => 'উলিপুর', 'url' => 'ulipur.kurigram.gov.bd'),
        array('id' => '454', 'district_id' => '60', 'name' => 'Chilmari', 'bn_name' => 'চিলমারী', 'url' => 'chilmari.kurigram.gov.bd'),
        array('id' => '455', 'district_id' => '60', 'name' => 'Rowmari', 'bn_name' => 'রৌমারী', 'url' => 'rowmari.kurigram.gov.bd'),
        array('id' => '456', 'district_id' => '60', 'name' => 'Charrajibpur', 'bn_name' => 'চর রাজিবপুর', 'url' => 'charrajibpur.kurigram.gov.bd'),
        array('id' => '457', 'district_id' => '61', 'name' => 'Sherpur Sadar', 'bn_name' => 'শেরপুর সদর', 'url' => 'sherpursadar.sherpur.gov.bd'),
        array('id' => '458', 'district_id' => '61', 'name' => 'Nalitabari', 'bn_name' => 'নালিতাবাড়ী', 'url' => 'nalitabari.sherpur.gov.bd'),
        array('id' => '459', 'district_id' => '61', 'name' => 'Sreebordi', 'bn_name' => 'শ্রীবরদী', 'url' => 'sreebordi.sherpur.gov.bd'),
        array('id' => '460', 'district_id' => '61', 'name' => 'Nokla', 'bn_name' => 'নকলা', 'url' => 'nokla.sherpur.gov.bd'),
        array('id' => '461', 'district_id' => '61', 'name' => 'Jhenaigati', 'bn_name' => 'ঝিনাইগাতী', 'url' => 'jhenaigati.sherpur.gov.bd'),
        array('id' => '462', 'district_id' => '62', 'name' => 'Fulbaria', 'bn_name' => 'ফুলবাড়ীয়া', 'url' => 'fulbaria.mymensingh.gov.bd'),
        array('id' => '463', 'district_id' => '62', 'name' => 'Trishal', 'bn_name' => 'ত্রিশাল', 'url' => 'trishal.mymensingh.gov.bd'),
        array('id' => '464', 'district_id' => '62', 'name' => 'Bhaluka', 'bn_name' => 'ভালুকা', 'url' => 'bhaluka.mymensingh.gov.bd'),
        array('id' => '465', 'district_id' => '62', 'name' => 'Muktagacha', 'bn_name' => 'মুক্তাগাছা', 'url' => 'muktagacha.mymensingh.gov.bd'),
        array('id' => '466', 'district_id' => '62', 'name' => 'Mymensingh Sadar', 'bn_name' => 'ময়মনসিংহ সদর', 'url' => 'mymensinghsadar.mymensingh.gov.bd'),
        array('id' => '467', 'district_id' => '62', 'name' => 'Dhobaura', 'bn_name' => 'ধোবাউড়া', 'url' => 'dhobaura.mymensingh.gov.bd'),
        array('id' => '468', 'district_id' => '62', 'name' => 'Phulpur', 'bn_name' => 'ফুলপুর', 'url' => 'phulpur.mymensingh.gov.bd'),
        array('id' => '469', 'district_id' => '62', 'name' => 'Haluaghat', 'bn_name' => 'হালুয়াঘাট', 'url' => 'haluaghat.mymensingh.gov.bd'),
        array('id' => '470', 'district_id' => '62', 'name' => 'Gouripur', 'bn_name' => 'গৌরীপুর', 'url' => 'gouripur.mymensingh.gov.bd'),
        array('id' => '471', 'district_id' => '62', 'name' => 'Gafargaon', 'bn_name' => 'গফরগাঁও', 'url' => 'gafargaon.mymensingh.gov.bd'),
        array('id' => '472', 'district_id' => '62', 'name' => 'Iswarganj', 'bn_name' => 'ঈশ্বরগঞ্জ', 'url' => 'iswarganj.mymensingh.gov.bd'),
        array('id' => '473', 'district_id' => '62', 'name' => 'Nandail', 'bn_name' => 'নান্দাইল', 'url' => 'nandail.mymensingh.gov.bd'),
        array('id' => '474', 'district_id' => '62', 'name' => 'Tarakanda', 'bn_name' => 'তারাকান্দা', 'url' => 'tarakanda.mymensingh.gov.bd'),
        array('id' => '475', 'district_id' => '63', 'name' => 'Jamalpur Sadar', 'bn_name' => 'জামালপুর সদর', 'url' => 'jamalpursadar.jamalpur.gov.bd'),
        array('id' => '476', 'district_id' => '63', 'name' => 'Melandah', 'bn_name' => 'মেলান্দহ', 'url' => 'melandah.jamalpur.gov.bd'),
        array('id' => '477', 'district_id' => '63', 'name' => 'Islampur', 'bn_name' => 'ইসলামপুর', 'url' => 'islampur.jamalpur.gov.bd'),
        array('id' => '478', 'district_id' => '63', 'name' => 'Dewangonj', 'bn_name' => 'দেওয়ানগঞ্জ', 'url' => 'dewangonj.jamalpur.gov.bd'),
        array('id' => '479', 'district_id' => '63', 'name' => 'Sarishabari', 'bn_name' => 'সরিষাবাড়ী', 'url' => 'sarishabari.jamalpur.gov.bd'),
        array('id' => '480', 'district_id' => '63', 'name' => 'Madarganj', 'bn_name' => 'মাদারগঞ্জ', 'url' => 'madarganj.jamalpur.gov.bd'),
        array('id' => '481', 'district_id' => '63', 'name' => 'Bokshiganj', 'bn_name' => 'বকশীগঞ্জ', 'url' => 'bokshiganj.jamalpur.gov.bd'),
        array('id' => '482', 'district_id' => '64', 'name' => 'Barhatta', 'bn_name' => 'বারহাট্টা', 'url' => 'barhatta.netrokona.gov.bd'),
        array('id' => '483', 'district_id' => '64', 'name' => 'Durgapur', 'bn_name' => 'দুর্গাপুর', 'url' => 'durgapur.netrokona.gov.bd'),
        array('id' => '484', 'district_id' => '64', 'name' => 'Kendua', 'bn_name' => 'কেন্দুয়া', 'url' => 'kendua.netrokona.gov.bd'),
        array('id' => '485', 'district_id' => '64', 'name' => 'Atpara', 'bn_name' => 'আটপাড়া', 'url' => 'atpara.netrokona.gov.bd'),
        array('id' => '486', 'district_id' => '64', 'name' => 'Madan', 'bn_name' => 'মদন', 'url' => 'madan.netrokona.gov.bd'),
        array('id' => '487', 'district_id' => '64', 'name' => 'Khaliajuri', 'bn_name' => 'খালিয়াজুরী', 'url' => 'khaliajuri.netrokona.gov.bd'),
        array('id' => '488', 'district_id' => '64', 'name' => 'Kalmakanda', 'bn_name' => 'কলমাকান্দা', 'url' => 'kalmakanda.netrokona.gov.bd'),
        array('id' => '489', 'district_id' => '64', 'name' => 'Mohongonj', 'bn_name' => 'মোহনগঞ্জ', 'url' => 'mohongonj.netrokona.gov.bd'),
        array('id' => '490', 'district_id' => '64', 'name' => 'Purbadhala', 'bn_name' => 'পূর্বধলা', 'url' => 'purbadhala.netrokona.gov.bd'),
        array('id' => '491', 'district_id' => '64', 'name' => 'Netrokona Sadar', 'bn_name' => 'নেত্রকোণা সদর', 'url' => 'netrokonasadar.netrokona.gov.bd'),

        array('id' => '492', 'district_id' => '27', 'name' => 'Khulna City Corporation', 'bn_name' => 'খুলনা সিটি কর্পোরেশন', 'city' => '1'),
        array('id' => '493', 'district_id' => '47', 'name' => 'Dhaka North City Corporation', 'bn_name' => 'ঢাকা উত্তর সিটি কর্পোরেশন', 'city' => '1'),
        array('id' => '494', 'district_id' => '47', 'name' => 'Dhaka South City Corporation', 'bn_name' => 'ঢাকা দক্ষিণ  সিটি কর্পোরেশন', 'city' => '1'),
        array('id' => '495', 'district_id' => '33', 'name' => 'Barisal City Corporation', 'bn_name' => 'বরিশাল সিটি কর্পোরেশন', 'city' => '1'),
        array('id' => '496', 'district_id' => '8', 'name' => 'Chattogram City Corporation', 'bn_name' => 'চট্টগ্রাম সিটি কর্পোরেশন', 'city' => '1'),
        array('id' => '497', 'district_id' => '15', 'name' => 'Rajshahi City Corporation', 'bn_name' => 'রাজশাহী সিটি কর্পোরেশন', 'city' => '1'),
        array('id' => '498', 'district_id' => '36', 'name' => 'Sylhet City Corporation', 'bn_name' => 'সিলেট সিটি কর্পোরেশন', 'city' => '1'),
        array('id' => '499', 'district_id' => '59', 'name' => 'Rangpur City Corporation', 'bn_name' => 'রংপুর সিটি কর্পোরেশন', 'city' => '1'),
        array('id' => '500', 'district_id' => '62', 'name' => 'Mymensingh City Corporation', 'bn_name' => 'ময়মনসিংহ সিটি কর্পোরেশন', 'city' => '1'),
    );
    return $upazilas;
}

function upazilaselect($selected = '1', $districtId = '0')
{
    $upazilas = upazilasView();

    $row = '';
    if ($selected != NULL) {
        foreach ($upazilas as $rows) {
            if ($rows['district_id'] == $districtId) {
                $row .= '<option value="' . $rows['id'] . '"';
                $row .= ($rows['id'] == $selected) ? ' selected="selected"' : '';
                $row .= '>' . $rows['name'] . '</option>';
            }
        }
    }
    return $row;
}

function upazilaname($id)
{
    $upazilas = upazilasView();

    $row = '';

    foreach ($upazilas as $rows) {
        if ($rows['id'] == $id) {
            $row .= $rows['name'];
        }
    }
    return $row;
}

function pourashavaUnion($selected = '0')
{
    $pu = [
        '1' => 'Pourashava',
        '2' => 'Union',
    ];

    $row = '';
    foreach ($pu as $key => $option) {
        $row .= '<option value="' . $key . '"';
        $row .= ($key == $selected) ? ' selected="selected"' : '';
        $row .= '>' . $option . '</option>';
    }
    return $row;
}

function pourashavaUnionName($id)
{
    $pu = [
        '1' => 'Pourashava',
        '2' => 'Union',
    ];

    $row = '';
    foreach ($pu as $key => $option) {
        if ($key == $id) {
            $row .= $option;
        }
    }
    return $row;
}

function wardView($selected = '1')
{
    $ward = [
        '1' => 'ward 1',
        '2' => 'ward 2',
        '3' => 'ward 3',
        '4' => 'ward 4',
        '5' => 'ward 5',
        '6' => 'ward 6',
        '7' => 'ward 7',
        '8' => 'ward 8',
        '9' => 'ward 9',
        '10' => 'ward 10',
        '11' => 'ward 11',
        '12' => 'ward 12',
        '13' => 'ward 13',
        '14' => 'ward 14',
        '15' => 'ward 15',
        '16' => 'ward 16',
        '17' => 'ward 17',
        '18' => 'ward 18',
        '19' => 'ward 19',
        '20' => 'ward 20',
        '21' => 'ward 21',
        '22' => 'ward 22',
        '23' => 'ward 23',
        '24' => 'ward 24',
        '25' => 'ward 25',
        '26' => 'ward 26',
        '27' => 'ward 27',
        '28' => 'ward 28',
        '29' => 'ward 29',
        '30' => 'ward 30',
        '31' => 'ward 31',
        '32' => 'ward 32',
        '33' => 'ward 33',
        '34' => 'ward 34',
        '35' => 'ward 35',
        '36' => 'ward 36',
        '37' => 'ward 37',
        '38' => 'ward 38',
        '39' => 'ward 39',
        '40' => 'ward 40',
        '41' => 'ward 41',
        '42' => 'ward 42',
        '43' => 'ward 43',
        '44' => 'ward 44',
        '45' => 'ward 45',
        '46' => 'ward 46',
        '47' => 'ward 47',
        '48' => 'ward 48',
        '49' => 'ward 49',
        '50' => 'ward 50',
        '51' => 'ward 51',
        '52' => 'ward 52',
        '53' => 'ward 53',
        '54' => 'ward 54',
        '55' => 'ward 55',
        '56' => 'ward 56',
        '57' => 'ward 57',
        '58' => 'ward 58',
        '59' => 'ward 59',
        '60' => 'ward 60',
        '61' => 'ward 61',
        '62' => 'ward 62',
        '63' => 'ward 63',
        '64' => 'ward 64',
        '65' => 'ward 65',
    ];

    $row = '';
    foreach ($ward as $key => $option) {
        $row .= '<option value="' . $key . '"';
        $row .= ($key == $selected) ? ' selected="selected"' : '';
        $row .= '>' . $option . '</option>';
    }
    return $row;
}

function getwardname($id)
{
    $ward = [
        '1' => 'ward 1',
        '2' => 'ward 2',
        '3' => 'ward 3',
        '4' => 'ward 4',
        '5' => 'ward 5',
        '6' => 'ward 6',
        '7' => 'ward 7',
        '8' => 'ward 8',
        '9' => 'ward 9',
        '10' => 'ward 10',
        '11' => 'ward 11',
        '12' => 'ward 12',
        '13' => 'ward 13',
        '14' => 'ward 14',
        '15' => 'ward 15',
        '16' => 'ward 16',
        '17' => 'ward 17',
        '18' => 'ward 18',
        '19' => 'ward 19',
        '20' => 'ward 20',
        '21' => 'ward 21',
        '22' => 'ward 22',
        '23' => 'ward 23',
        '24' => 'ward 24',
        '25' => 'ward 25',
        '26' => 'ward 26',
        '27' => 'ward 27',
        '28' => 'ward 28',
        '29' => 'ward 29',
        '30' => 'ward 30',
        '31' => 'ward 31',
        '32' => 'ward 32',
        '33' => 'ward 33',
        '34' => 'ward 34',
        '35' => 'ward 35',
        '36' => 'ward 36',
        '37' => 'ward 37',
        '38' => 'ward 38',
        '39' => 'ward 39',
        '40' => 'ward 40',
        '41' => 'ward 41',
        '42' => 'ward 42',
        '43' => 'ward 43',
        '44' => 'ward 44',
        '45' => 'ward 45',
        '46' => 'ward 46',
        '47' => 'ward 47',
        '48' => 'ward 48',
        '49' => 'ward 49',
        '50' => 'ward 50',
        '51' => 'ward 51',
        '52' => 'ward 52',
        '53' => 'ward 53',
        '54' => 'ward 54',
        '55' => 'ward 55',
        '56' => 'ward 56',
        '57' => 'ward 57',
        '58' => 'ward 58',
        '59' => 'ward 59',
        '60' => 'ward 60',
        '61' => 'ward 61',
        '62' => 'ward 62',
        '63' => 'ward 63',
        '64' => 'ward 64',
        '65' => 'ward 65'

    ];

    $row = '';
    foreach ($ward as $key => $option) {
        if ($key == $id) {
            $row .= $option;
        }
    }
    return $row;
}

function massageType($typeId)
{
    if ($typeId == 1) {
        $type = 'Admin';
    } elseif ($typeId == 2) {
        $type = 'Users';
    } elseif ($typeId == 3) {
        $type = 'Customer';
    } elseif ($typeId == 4) {
        $type = 'Suppliers';
    } elseif ($typeId == 5) {
        $type = 'employee';
    } elseif ($typeId == 6) {
        $type = 'Account Holder';
    }

    return $type;
}

function massageName($typeId, $userId)
{
    if ($typeId == 1) {
        $name = 'Admin';
    } elseif ($typeId == 2) {
        $name = get_data_by_id('name', 'users', 'user_id', $userId);
    } elseif ($typeId == 3) {
        $name = get_data_by_id('customer_name', 'customers', 'customer_id', $userId);
    } elseif ($typeId == 4) {
        $name = get_data_by_id('name', 'suppliers', 'supplier_id', $userId);
    } elseif ($typeId == 5) {
        $name = get_data_by_id('name', 'employee', 'employee_id', $userId);
    } elseif ($typeId == 6) {
        $name = get_data_by_id('name', 'loan_provider', 'loan_pro_id', $userId);
    }

    return $name;
}

function massagePhone($typeId, $userId)
{
    if ($typeId == 1) {
        $phone = '';
    } elseif ($typeId == 2) {
        $phone = get_data_by_id('mobile', 'users', 'user_id', $userId);
    } elseif ($typeId == 3) {
        $phone = get_data_by_id('mobile', 'customers', 'customer_id', $userId);
    } elseif ($typeId == 4) {
        $phone = get_data_by_id('phone', 'suppliers', 'supplier_id', $userId);
    } elseif ($typeId == 5) {
        $phone = '';//get_data_by_id('name','employee','employee_id',$userId);
    } elseif ($typeId == 6) {
        $phone = get_data_by_id('phone', 'loan_provider', 'loan_pro_id', $userId);
    }

    return $phone;
}

function getUnredAllMessage()
{
    $CI =& get_instance();

    $shopId = isset($_SESSION['shopId']) ? $_SESSION['shopId'] : "0";

    $result = '';
    if ($shopId != 0) {
        $query = $CI->db->get_where('message', array('sch_id' => $shopId, 'red_status' => '0'))->result();

        foreach ($query as $row) {

            $result .= '<li><a href="' . site_url('message/read/' . $row->message_id) . '"><div class="pull-left">
                    <i class="fa fa-envelope-o"></i>
                  </div>
                <h4>Message <small><i class="fa fa-clock-o"></i> ' . invoiceDateFormat($row->createdDtm) . '</small></h4>
                  <p>' . $row->massage . '</p>
                </a></li>';
        }
    } else {
        $result = "0";
    }
    return $result;
}

function getUnredAllMessageCount()
{
    $CI =& get_instance();

    $shopId = isset($_SESSION['shopId']) ? $_SESSION['shopId'] : "0";

    $result = '';
    if ($shopId != 0) {
        $query = $CI->db->get_where('message', array('sch_id' => $shopId, 'red_status' => '0'))->num_rows();
        $result = $query;
    } else {
        $result = "0";
    }
    return $result;
}


function checkParentCategory($categoryId)
{
    $CI =& get_instance();

    $query = $CI->db->select('parent_pro_cat')->where('prod_cat_id', $categoryId)->get('product_category');
    $row = $query->num_rows();
    if (!empty($row)) {
        $view = $query->row()->parent_pro_cat;

    } else {
        $view = "";
    }

    return $view;
}

function get_supplier_product($id)
{
    $CI =& get_instance();
    $query = $CI->db->get_where('purchase_item', array('purchase_id' => $id))->result();
    return $query;
}

function checkSellerInvoice($invoiceId)
{
    $CI =& get_instance();
    $CI->db->select("seller_id");
    $query = $CI->db->get_where("invoice", array("invoice_id" => $invoiceId))->row();

    if ($query->seller_id == NULL) {
        $data = false;
    } else {
        $data = true;
    }

    return $data;
}

function checkDeliveryBoyInvoice($invoiceId)
{
    $CI =& get_instance();
    $query = $CI->db->get_where("delivery", array("invoice_id" => $invoiceId));

    if ($query->num_rows() == 0) {
        $data = false;
    } else {
        $data = true;
    }

    return $data;
}


function purchaseTypeCheck($productId)
{
    $CI =& get_instance();
    $CI->db->select("purchase_type");
    $query = $CI->db->get_where("products", array("prod_id" => $productId))->row();

    if ($query->purchase_type == 1) {
        $data = true;
    } else {
        $data = false;
    }

    return $data;
}


function id_by_global_address($id)
{
    $table = DB()->table('global_address');
    $row = $table->where('global_address_id',$id)->countAllResults();

    if (!empty($row)) {
        $glo = DB()->table('global_address');
        $query = $glo->where('global_address_id',$id)->get()->getRow();
        $view = $query;
    } else {
        $view = "0";
    }

    return $view;
}


function get_due_commision_seller($sch_id, $userId)
{
    $CI =& get_instance();
    //$userId = $_SESSION['shopId'];

    $duecom = $CI->db->select_sum('commission')->from('commission')->join('invoice', 'commission.invoice_id = invoice.invoice_id')->where('invoice.sch_id =' . $sch_id)->where('commission.seller_id = ' . $userId)->where('commission.com_status', '0')->get()->row()->commission;
    return $duecom;
}

function get_received_commision_seller($sch_id, $userId)
{
    $CI =& get_instance();

    $reccom = $CI->db->select_sum('commission')->from('commission')->join('invoice', 'commission.invoice_id = invoice.invoice_id')->where('invoice.sch_id =' . $sch_id)->where('commission.seller_id = ' . $userId)->where('commission.com_status', '1')->get()->row()->commission;
    return $reccom;
}

function get_due_commision_delivery_boy($sch_id, $deliveryBoyId)
{
    $CI =& get_instance();
    $userId = $deliveryBoyId;

    $duecom = $CI->db->select_sum('commission')->from('commission')->join('invoice', 'commission.invoice_id = invoice.invoice_id')->where('invoice.sch_id =' . $sch_id)->where('commission.delivery_boy_id = ' . $userId)->where('commission.com_status', '0')->get()->row()->commission;
    return $duecom;
}

function get_received_commision_delivery_boy($sch_id, $deliveryBoyId)
{
    $CI =& get_instance();
    $userId = $deliveryBoyId;

    $reccom = $CI->db->select_sum('commission')->from('commission')->join('invoice', 'commission.invoice_id = invoice.invoice_id')->where('invoice.sch_id =' . $sch_id)->where('commission.delivery_boy_id = ' . $userId)->where('commission.com_status', '1')->get()->row()->commission;
    return $reccom;
}


function getCustomerByShopListInOption()
{
    $CI =& get_instance();

    $globalAddId = $CI->db->get_where('shops', array('sch_id' => $_SESSION['shopId']))->row()->global_address_id;

    $customer = $CI->db->get_where('customers', array('global_address_id' => $globalAddId))->result();

    $options = '';
    foreach ($customer as $value) {
        $options .= '<option value="' . $value->customer_id . '" ';
        $options .= '>' . $value->mobile . ' (' . $value->customer_name . ')</option>';
    }
    return $options;
}

function deliverystatus($invoiceId)
{
    $CI =& get_instance();
    $query = $CI->db->get_where('delivery', array('invoice_id' => $invoiceId));

    if ($query->num_rows() != 0) {
        $data = $query->row()->status;
        $deliId = $query->row()->delivery_boy_id;

        $name = get_data_by_id('name', 'delivery_boy', 'delivery_boy_id', $deliId);
        $phone = get_data_by_id('mobile', 'delivery_boy', 'delivery_boy_id', $deliId);
        if ($query->row()->status == 0) {
            $data = '<span class="label label-info">Accepted</span><br>' . $name . '<br>' . showWithPhoneNummberCountryCode($phone);
        }
        if ($query->row()->status == 1) {
            $data = '<span class="label label-success">Complete</span><br>' . $name . '<br>' . showWithPhoneNummberCountryCode($phone);
        }
    } else {
        $data = '<span class="label label-warning">Not Accepted</span>';

    }
    return $data;
}


function subCatDemoOption($categoryId)
{
    $CI =& get_instance();

    $query = $CI->db->get_where('demo_category', array('parent_pro_cat' => $categoryId));

    $options = '';
    foreach ($query->result() as $value) {
        $options .= '<option value="' . $value->cat_id . '">' . $value->product_category . '</option>';
    }


    return $options;

}

function checkDemoParentCategory($categoryId)
{
    $CI =& get_instance();

    $query = $CI->db->select('parent_pro_cat')->where('cat_id', $categoryId)->get('demo_category');
    $row = $query->num_rows();
    if (!empty($row)) {
        $view = $query->row()->parent_pro_cat;

    } else {
        $view = "0";
    }

    return $view;
}

function shopSubCatListOption($selected)
{

    $CI =& get_instance();
    $query = $CI->db->get_where('shop_category', array('parent_cat_id' => 0));
    $options = '';
    foreach ($query->result() as $value) {
        $options .= '<option value="' . $value->shop_cat_id . '" ';
        $options .= ($value->shop_cat_id == $selected) ? ' selected="selected"' : '';
        $options .= '>' . $value->name . '</option>';
    }
    return $options;
}


function shopCateListInOption($categoryId)
{

    $CI =& get_instance();
    $query = $CI->db->get_where('shop_category', array('parent_cat_id' => 0));

    $catId = get_data_by_id('parent_cat_id', 'shop_category', 'shop_cat_id', $categoryId);

    $options = '';
    if (!empty($catId)) {
        foreach ($query->result() as $value) {
            $options .= '<option value="' . $value->shop_cat_id . '" ';
            $options .= ($value->shop_cat_id == $catId) ? ' selected="selected"' : '';
            $options .= '>' . $value->name . '</option>';
        }
    } else {
        foreach ($query->result() as $value) {
            $options .= '<option value="' . $value->shop_cat_id . '" ';
            $options .= ($value->shop_cat_id == $categoryId) ? ' selected="selected"' : '';
            $options .= '>' . $value->name . '</option>';
        }
    }

    return $options;

}

function shopSubCatListInOption($categoryId)
{

    $CI =& get_instance();
    $catId = get_data_by_id('parent_cat_id', 'shop_category', 'shop_cat_id', $categoryId);

    $query = $CI->db->get_where('shop_category', array('parent_cat_id' => $catId));

    $options = '';
    if (!empty($catId)) {

        foreach ($query->result() as $value) {
            $options .= '<option value="' . $value->shop_cat_id . '" ';
            $options .= ($value->shop_cat_id == $categoryId) ? ' selected="selected"' : '';
            $options .= '>' . $value->name . '</option>';
        }
    } else {

    }
    return $options;

}


function shopType($select)
{
    $status = [
        'Both' => 'Both',
        'Man' => 'Man',
        'Women' => 'Women',
    ];

    $options = '';
    foreach ($status as $key => $value) {
        $options .= '<option value="' . $key . '" ';
        $options .= ($value == $select) ? ' selected="selected"' : '';
        $options .= '>' . $value . '</option>';


    }
    return $options;
}


function checkParentCategorydemo($categoryId)
{
    $CI =& get_instance();

    $query = $CI->db->select('parent_pro_cat')->where('cat_id', $categoryId)->get('demo_category');
    $row = $query->num_rows();
    if (!empty($row)) {
        $view = $query->row()->parent_pro_cat;

    } else {
        $view = "";
    }

    return $view;
}

function hospitalProfilePic()
{
    $session = newSession();
    $table = DB()->table('hospital');
    $query = $table->where('h_id', $session->h_Id);
    $row = $query->countAllResults();
    if (!empty($row)) {
        $table2 = DB()->table('hospital');
        $query2 = $table2->where('h_id', $session->h_Id);
        $view = $query2->get()->getRow()->image;
    } else {
        $view = "noimage.jpg";
    }
    return $view;
}

function hospitalLogo()
{
    $session = newSession();
    $table = DB()->table('hospital');
    $query = $table->where('h_id', $session->h_Id);
    $row = $query->countAllResults();
    if (!empty($row)) {
        $table2 = DB()->table('hospital');
        $query2 = $table2->where('h_id', $session->h_Id);
        $view = $query2->get()->getRow()->logo;
    } else {
        $view = "noimage.jpg";
    }
    return $view;
}

function hospitalName()
{
    $session = newSession();
    $table = DB()->table('hospital');
    $query = $table->where('h_id', $session->h_Id);
    $row = $query->countAllResults();
    if (!empty($row)) {
        $view = $query->get()->getRow()->name;
    } else {
        $view = "admin";
    }
    return $view;
}

function pro_parent_category_by_category_id($id)
{
    $session = newSession();
    $table = DB()->table('product_category');
    $query = $table->where('parent_pro_cat_id', $id);
    $row = $query->countAllResults();
    if (!empty($row)) {
        $prId = get_data_by_id('parent_pro_cat_id', 'product_category', 'parent_pro_cat_id', $id);
        $table2 = DB()->table('product_category');
        $query2 = $table2->where('prod_cat_id', $prId);
        $catName = $query2->get()->getRow()->product_category;
        $view = (!empty($catName)) ? $catName : 'No parent';
    } else {
        $view = "No parent";
    }
    return $view;
}
function  proSubCatListInOption($categoryId,$selected){
    $table = DB()->table('product_category');
    $query = $table->where('prod_cat_id', $categoryId);
    $row = $query->countAllResults();
    $view = '<option value="" >Please Select</option>';
    if (!empty($row)) {
        $table2 = DB()->table('product_category');
        $query2 = $table2->where('parent_pro_cat_id', $categoryId)->get()->getResult();
        foreach ($query2 as $item) {
            $sel = ($item->prod_cat_id == $selected)?'selected':'';
            $view .= '<option value="'.$item->prod_cat_id.'" '.$sel.'>'.$item->product_category.'</option>';
        }
    }
    return $view;
}

function superAdminName()
{
    $session = newSession();
    $id = $session->isLoggedIAdmin->admin_id;
    $table = DB()->table('admin');
    $query = $table->where('admin_id', 3);
    $row = $query->countAllResults();
    if (!empty($row)) {
        $query = $table->where('admin_id', 3);
        $view = $query->get()->getRow()->name;
    } else {
        $view = "admin";
    }
    return $view;
}

function count_doctor_by_hospitalId_or_specialistId($hospitalId,$specialistId){
    $table = DB()->table('doctor');
    $result = $table->where('h_id',$hospitalId)->where('specialist_id',$specialistId)->countAllResults();
    return $result;
}

function appionment_count($docId,$date,$time){
    $where = ['doc_id' => $docId,'date' => $date,'time' => $time,'status' => '1'];
    $table = DB()->table('appointment');
    $query = $table->where($where);
    $row = $query->countAllResults();
    return $row;
}

function appionment_count_insert($docId,$date,$time){
    $where = ['doc_id' => $docId,'date' => $date,'time' => $time];
    $table = DB()->table('appointment');
    $query = $table->where($where);
    $row = $query->countAllResults();
    return $row;
}

function price($tk = 0, $extension = 'Tk.')
{
//    $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
//    return $f->format($tk) . $extension;
    return $extension.''.$tk;
}

function orderStatusView($sel = '0')
{
    $status = [
        0 => 'unpaid',
        1 => 'paid',
        2 =>'pandding',
        3 => 'cancel'
    ];
    $row = '';
    foreach ($status as $key => $option) {
        $row .= ($sel == $key) ? $option : '';
    }
    return $row;
}

function orderStatusInOption($sel = '0')
{
    $status = [
        0 => 'unpaid',
        1 => 'paid',
        2 =>'pandding',
        3 => 'cancel'
    ];
    $row = '<option value="">Please select</option>';
    foreach ($status as $key => $option) {
        $s = ($key == $sel)?'selected':'';
        $row .= '<option value="'.$key.'" '.$s.'>'.$option.'</option>';
    }
    return $row;
}

function superLogo(){
    $table = DB()->table('admin');
    $data = $table->where('admin_id',3)->get()->getRow();

    $img = base_url('assets/upload/superAdmin/3/'.$data->pic);
    return $img;
}

function superData(){
    $table = DB()->table('admin');
    $data = $table->where('admin_id',3)->get()->getRow();

    return $data;
}

function in_appoin_status($selected = 'sel')
{
    $status = [
        'sel' => '--Select--',
        '0' => 'Pending',
        '1' => 'Processing',
        '2' => 'Complete',
        '3' => 'Fail',
    ];

    $row = '';
    foreach ($status as $key => $option) {
        $row .= '<option value="' . $key . '"';
        $row .= ($selected == $key) ? ' selected' : '';
        $row .= '>' . $option . '</option>';
    }
    return $row;
}

function in_appoin_status_view($selected = 'sel')
{
    $status = [
        'sel' => '--Select--',
        '0' => 'Pending',
        '1' => 'Processing',
        '2' => 'Complete',
        '3' => 'Fail',
    ];

    $row = '';
    foreach ($status as $key => $option) {
        $row .= ($selected == $key) ? $option : '';
    }
    return $row;
}

function hospitalBanner(){
    $table = DB()->table('ad_management');
    $data = $table->where('org_type','hospital')->where('start_date <=' ,date("Y-m-d"))->where('status','active')->where('end_date >',date("Y-m-d"))->get(3)->getResult();

    return $data;

}

function count_patient_notification($pat_id){
    $allMess = DB()->table('message');
    $allmData = $allMess->where('for_patient','All')->get()->getResult();

    $allMesCount = 0;

    foreach ($allmData as $ms){
        $mes_to = DB()->table('message_to');
        $countMsTo = $mes_to->where('message_id',$ms->message_id)->where('to_patient_id',$pat_id)->countAllResults();
        if (empty($countMsTo)){
            $allMesCount+=1;
        }
    }

    $speciMess = DB()->table('message');
    $specData = $speciMess->where('for_patient','Specific')->get()->getResult();
    foreach ($specData as $sp){
        $table = DB()->table('message');
        $spCount = $table->join('message_to','message_to.message_id = message.message_id')->where('message.message_id',$sp->message_id)->where('message_to.to_patient_id',$pat_id)->where('message_to.msg_read','0')->countAllResults();
        if (!empty($spCount)){
            $allMesCount+=1;
        }
    }

    return $allMesCount;
}


function count_both_notification($h_id){
    $hos = count_hospital_notification($h_id);
    $dig = count_diagnostics_notification($h_id);

    return $hos+$dig;
}

function count_hospital_notification($h_id){
    $allMess = DB()->table('message');
    $allmesData = $allMess->where('for_hospital','All')->get()->getResult();
    $result = 0;
    foreach ($allmesData as $al) {
        $mess_al_to = DB()->table('message_to');
        $allm = $mess_al_to->where('message_id',$al->message_id)->where('to_hospital_id',$h_id)->countAllResults();
        if (empty($allm)){
            $result+=1;
        }
    }

    $specMess = DB()->table('message');
    $spMsData = $specMess->where('for_hospital','Specific')->get()->getResult();
    foreach ($spMsData as $sp) {
        $mess_sp_to = DB()->table('message_to');
        $spMs = $mess_sp_to->where('message_id',$sp->message_id)->where('to_hospital_id',$h_id)->where('msg_read','0')->countAllResults();
        if (!empty($spMs)){
            $result+=1;
        }
    }
    return $result;
}

function count_diagnostics_notification($h_id){
    $allMess = DB()->table('message');
    $allmesData = $allMess->where('for_diagnostic','All')->get()->getResult();
    $result = 0;
    foreach ($allmesData as $al) {
        $mess_al_to = DB()->table('message_to');
        $allm = $mess_al_to->where('message_id',$al->message_id)->where('to_diagnostic_id',$h_id)->countAllResults();
        if (empty($allm)){
            $result+=1;
        }
    }

    $specMess = DB()->table('message');
    $spMsData = $specMess->where('for_diagnostic','Specific')->get()->getResult();
    foreach ($spMsData as $sp) {
        $mess_sp_to = DB()->table('message_to');
        $spMs = $mess_sp_to->where('message_id',$sp->message_id)->where('to_diagnostic_id',$h_id)->where('msg_read','0')->countAllResults();
        if (!empty($spMs)){
            $result+=1;
        }
    }
    return $result;
}

