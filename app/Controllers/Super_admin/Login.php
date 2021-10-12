<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers\Super_admin;

use App\Controllers\BaseController;

use App\Models\Super_admin\LoginModel;

class Login extends BaseController
{
    protected $loginModel;
    protected $validation;
    protected $session;

    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        $this->loginModel = new LoginModel();
        $this->validation =  \Config\Services::validation();
        $this->session = \Config\Services::session();
    }

    /**
     * Index Page for this controller.
     */
    public function index2()
    {
        $this->isLoggedIn();
    }
    
    /**
     * This function used to check the user is logged in or not
     */
    function index()
    {
        $isLoggedIAdmin = $this->session->isLoggedIAdmin;
        
        if(!isset($isLoggedIAdmin) || $isLoggedIAdmin != TRUE)
        {
            echo view('Super_admin/Login/login');
        }
        else
        {
            return redirect()->to(site_url("/super_admin/dashboard"));
        }
        
    }
    
    
    /**
     * This function used to logged in user
     */
    public function loginMe()
    {

        $session = \Config\Services::session();
        $db = \Config\Database::connect();

        $this->validation->setRule('email', 'Email', 'required|valid_email|max_length[128]|trim');
        $this->validation->setRule('password', 'Password', 'required|max_length[32]');
        
        if($this->validation->withRequest($this->request)->run() == FALSE)
        {
            return redirect()->to(site_url("/super_admin/login"));
        }
        else
        {
            // $email = strtolower($this->security->xss_clean($this->input->post('email')));
            $email = strtolower($this->request->getPost('email'));
            $password = $this->request->getPost('password');

            $result = $this->loginModel->loginMe($email, $password);
            
            if(!empty($result))
            {

                // Remember me (Remembering the user email and password) Start
                if (!empty($this->request->getPost("remember"))) { 

                    setcookie('admin_login_email',$email,time()+ (86400 * 30), "/");
                    setcookie('admin_login_password',$password,time() + (86400 * 30), "/");
                    
                }else{
                    if (isset($_COOKIE['admin_login_email'])) {
                        setcookie('admin_login_email','', 0, "/");
                    }
                    if (isset($_COOKIE['admin_login_password'])) {
                        setcookie('admin_login_password','', 0, "/");
                    }
                }
                // Remember me (Remembering the user email and password) End


                $sessionArray = array(   
                                    'admin_id'=>$result->admin_id,
                                    'AdminName'=>$result->name,
                                    'AdminRole'=>$result->role_id,
                                    'isLoggedIAdmin' => TRUE
                            );
                
                $session->set($sessionArray);

                return redirect()->to(site_url("/super_admin/dashboard"));


            }
            else
            {
                $session->setFlashdata('error', 'Email or password mismatch');
                $this->index();
            }
        }
    }

    /**
     * This function used to load forgot password view
     */
    public function forgotPassword()
    {
        $isLoggedIn = $this->session->userdata(isLoggedIn);
        
        if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
        {
            $this->load->view('forgotPassword');
        }
        else
        {
            redirect('/dashboard');
        }
    }

    /**
     * This function used to generate reset password request link
     */

    public function reset_link()
    {
        $email = $this->input->post('email',TRUE);

        $result = $this->db->select('email')->get_where('users', array('email' => $email ))->num_rows();

        if ($result > 0) {
            $tokan =  rand(1000,9999);

            $_SESSION['tokan']= $tokan;
            $_SESSION['email'] = $email;

            $message = "Please Click On Password Reset Link <br> <a href='".base_url('login/reset?tokan=').$tokan."'>Reset Password</a>";

            //print $message;
            $this->email->from('example@gmail.com', 'example');
            $this->email->to($email);
            $this->email->subject('Reset Password Link'); 
            $this->email->message($message);
            if (!$this->email->send()) {
                show_error($this->email->print_debugger()); }
            else {
                echo 'Reset password link sent successfully!';
            }

        }else{            
            $this->session->set_flashdata('message', '<div style="margin-top: 12px" class="alert alert-danger" id="message">Your Email Address Could Not Be Found</div>');
                redirect(site_url('login/forgotPassword'));
        }

    }


    /**
     * This function used to load input forgot password view
     */

    public function reset()
    {
        $data['tokan'] = $this->input->get('tokan');
        $_SESSION['lasttokan'] = $data['tokan'];        
        if ($_SESSION['tokan'] != $data['tokan']) {
            $this->session->set_flashdata('message', '<div style="margin-top: 12px" class="alert alert-danger" id="message">Invalid Tokan</div>');
            redirect(site_url('login/forgotPassword'));
        }else{
            $this->load->view('login/resetpassword');
        }
    }


    /**
     * This function used to Update reset password 
     */ 
    public function update_password()
    {
        
        $_SESSION['lasttokan'];
        $_SESSION['tokan'];

        if ($_SESSION['tokan'] == $_SESSION['lasttokan']) {

            $password = $this->input->post('password',TRUE); 
            $cpassword = $this->input->post('cpassword',TRUE);

            if ($password == $cpassword) {
                $this->db->where('email', $_SESSION['email']);
                $this->db->update('users', array('password' => sha1($password)));
                $this->session->set_flashdata('message', '<div style="margin-top: 12px" class="alert alert-success" id="message">Your Password Update Success</div>');
                redirect(site_url('login'));
            }else{
                $this->session->set_flashdata('message', '<div style="margin-top: 12px" class="alert alert-danger" id="message">Password And Confirm Password Does Not Match</div>');
                redirect(base_url('login/reset?tokan=').$_SESSION['tokan']);
            }

        }else{
            $this->session->set_flashdata('message', '<div style="margin-top: 12px" class="alert alert-danger" id="message">Invalid Tokan</div>');
            redirect(site_url('login/forgotPassword'));
            
        }

    }
    
    
    
    /**
     * This function used to logout 
     */ 
    
    function logout()
	 {
        $session = \Config\Services::session();

        unset($_SESSION['admin_id']);
        unset($_SESSION['AdminName']);
        unset($_SESSION['isLoggedInAdmin']);
        unset($_SESSION['AdminRole']);

        $session->destroy();
        return redirect()->to('/super_admin/login');
	 }


    
}

?>