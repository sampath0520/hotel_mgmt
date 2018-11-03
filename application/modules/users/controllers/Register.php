<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
Author Salman Iqbal
Created on 20/1/2017
Company Parexons
*/

class Register extends MY_Controller 
{
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->helper(array('form','html'));
        $this->load->model('Register_model');
		$this->load->model('common_model');
        $this->load->library(array('form_validation'));
        $this->load->config('ion_auth');
	}

    /*
        * Load Sign up Page
    */
	public function index()
	{
        $this->load->view('auth/Sign_Up');      
	}

    /*
        * Sign up new user
    */
	public function sign_up()
	{
        //validate form
        $this->form_validation->set_rules('first_name', 'First name','trim|required');
        $this->form_validation->set_rules('last_name', 'Last name','trim|required');
        $this->form_validation->set_rules('username','Username','trim|required|is_unique[users.username]');
        $this->form_validation->set_rules('email','Email','trim|valid_email|required|is_unique[users.email]');
        $this->form_validation->set_rules('password','Password','trim|min_length[8]|max_length[20]|required');
        $this->form_validation->set_rules('confirm_password','Confirm password','trim|matches[password]|required');
        // $this->form_validation->set_rules('g-recaptcha-response', 'Captcha','required');

        // Re-populate the values after validation failed
        // $this->form_validation->set_value('first_name');
 
        if($this->form_validation->run() === FALSE)
        {
        	$msg = "Please Fill The Form Correctly <br> User name And E-Mail Must Be unique";
			$this->session->set_flashdata('error',$msg);
            redirect('users/Register');
        }
        else
        {
            if ($_POST['g-recaptcha-response'] == TRUE) 
            {
                $first_name = $this->input->post('first_name');
                $last_name  = $this->input->post('last_name');
                $username   = $this->input->post('username');
                $email      = $this->input->post('email');
                $password   = $this->input->post('password');

                $string = mt_rand(100000, 999999);
     
                $additional_data = array(
                    'first_name'        => $first_name,
                    'last_name'         => $last_name,
                    'oauth_provider'    => 'local',
                    'date'              => date('y-m-d'),
                    'verification_code' => $string  
                );

                $register = $this->ion_auth->register($username,$password,$email,$additional_data);

                if ($register)
                {
                    $msg = "Sign Up Successfully Now you can Login";
                    $this->session->set_flashdata('error',$msg);
                    redirect('/','refresh');
                }
                else
                {
                    $msg = "There is problem in your form filling please fill the form Correctly";
                    $this->session->set_flashdata('error',$msg);
                    redirect('users/Register','refresh');
                } 
            }
            else
            {
                $msg = "Captcha Verification is required";
                $this->session->set_flashdata('error',$msg);
                redirect('users/Register','refresh');
            }
        }
    }

    /* 
        * Check Duplicate Email
    */ 
    public function check_email()
    {
        $email = $this->input->post('myemail');

        $result = $this->Register_model->check_mail('users',$email);

        if ($result) 
        {
        	echo "ok::";
        }
    }

    /*
        * Check Duplicate UserName
    */
    public function check_username()
    {
        $username = $this->input->post('u_name');

        $result = $this->Register_model->check_username('users',$username);

        if ($result) 
        {
        	echo "ok::";
        }
    }
    /*
       * Activate a User
    */
    function verifycode()
    {
        if ($this->input->post()) 
        {
            // validate form input
            $this->form_validation->set_rules('code','Code' , 'trim|required|numeric');

            if ($this->form_validation->run() === TRUE)
            {
                $code = $this->input->post('code');

                $check = $this->common_model->getAllData('users','verification_code', array('verification_code' => $code));

                if (!empty($check[0]->verification_code)) 
                {
                    $data = array('active' => 1);

                    $where = array('verification_code' => $code);

                    $status_update = $this->common_model->UpdateDB('users',$where,$data);

                    if ($status_update) 
                    {
                        $msg = "Your Code Verified Successfully, Now you can Login";
                        $this->session->set_flashdata('success',$msg);
                        redirect('users/Auth','refresh');
                    }
                }
                else
                {
                    $msg = "You have Enter wrong Code, Please Try Again";
                    $this->session->set_flashdata('error',$msg);
                    redirect('users/Register/verifycode','refresh');
                }
            }   
            else
            {
                $data['message'] = validation_errors();
                view('verify_user');
            }
        } 
        else 
        {
            view('auth/verify_user');
        }
            
        
    }

}

/* End of file Register.php */
/* Location: ./application/controllers/Register.php */