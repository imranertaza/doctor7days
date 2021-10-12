<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Models\Hospital_admin;
use CodeIgniter\Model;

class LoginModel extends Model
{
    
    
    /**
     * This function used to check the login credentials of the user
     * @param string $email : This is email of the user
     * @param string $password : This is encrypted password of the user
     */
    function loginMe($email, $password)
    {

        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->select('BaseTbl.email, BaseTbl.password, BaseTbl.name, BaseTbl.h_id, BaseTbl.role_id');
        $builder->from('users as BaseTbl');
        $builder->where('BaseTbl.email', $email);
        $builder->where('BaseTbl.status', '1');
        $query = $builder->get();
        
        $user = $query->getRow();
        // print $db->getLastQuery();
        
        if(!empty($user)){
            if(SHA1($password) == $user->password){
                return $user;
            } else {
                return array();
            }
        } else {
            return array();
        }
    }

    function licenseCheck($h_Id){
        $db = \Config\Database::connect();
        $builder = $db->table('license');
        $query = $builder->select('end_date')->where('h_id',$h_Id)->get();
        
        $today = date('Y-m-d');
        if ($query->getRow()->end_date > $today) {
            $data = true;
        }else{
            $data = false;
        }
        return $data;
    }
    
    
   //  private function confirmRole($roleId){
            // if ($roleId == 2) { $usrTable = 'users'; $usrId = 'sch_id'; }
   //   if ($roleId == 4) { $usrTable = 'teacher'; $usrId = 'teacher_id'; }
   //   if ($roleId == 5) { $usrTable = 'librarian'; $usrId = 'librarian_id'; }
   //   if ($roleId == 6) { $usrTable = 'parents'; $usrId = 'parent_id'; }
   //   if ($roleId == 7) { $usrTable = 'student'; $usrId = 'student_id'; }
   //   if ($roleId == 8) { $usrTable = 'accountant'; $usrId = 'accountant_id'; }
        
   //   $tableInfo = array("usrTable"=>$usrTable, "usrId"=>$usrId);
   //   return $tableInfo;
   //  }

    /**
     * This function used to check email exists or not
     * @param {string} $email : This is users email id
     * @return {boolean} $result : TRUE/FALSE
     */
    function checkEmailExist($email)
    {
        $this->db->select('userId');
        $this->db->where('email', $email);
        $this->db->where('isDeleted', 0);
        $query = $this->db->get('tbl_users');

        if ($query->num_rows() > 0){
            return true;
        } else {
            return false;
        }
    }


    /**
     * This function used to insert reset password data
     * @param {array} $data : This is reset password data
     * @return {boolean} $result : TRUE/FALSE
     */
    function resetPasswordUser($data)
    {
        $result = $this->db->insert('tbl_reset_password', $data);

        if($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * This function is used to get customer information by email-id for forget password email
     * @param string $email : Email id of customer
     * @return object $result : Information of customer
     */
    function getCustomerInfoByEmail($email)
    {
        $this->db->select('userId, email, name');
        $this->db->from('tbl_users');
        $this->db->where('isDeleted', 0);
        $this->db->where('email', $email);
        $query = $this->db->get();

        return $query->row();
    }

    /**
     * This function used to check correct activation deatails for forget password.
     * @param string $email : Email id of user
     * @param string $activation_id : This is activation string
     */
    function checkActivationDetails($email, $activation_id)
    {
        $this->db->select('id');
        $this->db->from('tbl_reset_password');
        $this->db->where('email', $email);
        $this->db->where('activation_id', $activation_id);
        $query = $this->db->get();
        return $query->num_rows();
    }

    // This function used to create new password by reset link
    function createPasswordUser($email, $password)
    {
        $this->db->where('email', $email);
        $this->db->where('isDeleted', 0);
        $this->db->update('tbl_users', array('password'=>getHashedPassword($password)));
        $this->db->delete('tbl_reset_password', array('email'=>$email));
    }

    /**
     * This function used to save login information of user
     * @param array $loginInfo : This is users login information
     */
    function lastLogin($loginInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_last_login', $loginInfo);
        $this->db->trans_complete();
    }

    /**
     * This function is used to get last login info by user id
     * @param number $userId : This is user id
     * @return number $result : This is query result
     */
    function lastLoginInfo($userId)
    {
        $this->db->select('BaseTbl.createdDtm');
        $this->db->where('BaseTbl.user_id', $userId);
        $this->db->order_by('BaseTbl.id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('tbl_last_login as BaseTbl');

        return $query->row();
    }
}

?>