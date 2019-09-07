<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AuthController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        // $this->load->model(['Auth']);
    }

    public function LoginView()
    {
        unstable_session();
        return view('login.login', ['title' => 'Login Page']);
    }

    public function LoginProcess()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|min_length[5]|max_length[60]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[96]|max_length[96]');
        if ($this->form_validation->run() == TRUE) {
            $this->apps_library->my_login(xss_clean($this->input->post('email', TRUE)), xss_clean($this->input->post('password', TRUE)));
        } else {
            _errorURL('Invalid input !!', '');
        }
    }

    public function LogoutProcess()
    {
        $this->apps_library->my_logout();
    }

    public function RegisterUser()
    {
        return view('login.register');
    }

    public function RegisterProcess()
    {
        $this->form_validation->set_rules('fullname', 'Full Name', 'trim|required|min_length[5]|max_length[60]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|min_length[5]|max_length[60]|is_unique[users.email]', ['is_unique' => '%s has been used !!']);
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[96]|max_length[96]');
        $this->form_validation->set_rules('password_verify', 'Password Verify', 'trim|required|min_length[96]|max_length[96]|matches[password]');

        if ($this->form_validation->run() == TRUE) {
            $this->apps_library->my_register(xss_clean($this->input->post('fullname', TRUE)), xss_clean($this->input->post('email', TRUE)), xss_clean($this->input->post('password', TRUE)));
        } else {
            _errorURL(validation_errors(), 'register');
        }
    }

    public function ForgetPassword()
    {
        return view('login.lost_password');
    }

    public function ForgetPasswordProcess()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|min_length[5]|max_length[60]');
        if ($this->form_validation->run() == TRUE) {
            $this->apps_library->my_lostPasswd(xss_clean($this->input->post('email', TRUE)));
        } else {
            _errorURL(validation_errors(), 'lost_pass');
        }
    }
}

/* End of file authController.php */
/* Location: ./application/controllers/authController.php */
