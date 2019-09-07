<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Illuminate\Support\Str;

class Apps_library
{
    protected $ci;

    public function __construct()
    {
        $this->ci = &get_instance();
        $this->ci->load->model(['Auth']);
    }

    // Login proccess
    public function my_login($email, $password)
    {
        $data = $this->ci->Auth->LoginAttemp($email, $password);
        if ($data == 'TRUE') {
            $getUser = $this->ci->Auth->UserAttemp($email);
            foreach ($getUser as $key) {
                $user_id = $key->user_id;
            }
            $_token = $this->ci->encryption->encrypt($email);
            $this->_createLoginTemp($_token, $user_id);
        } else {
            _errorURL('Account not found!', '');
        }
    }
    # insert into login_temp
    function _createLoginTemp($_token, $user_id)
    {
        $attemp = $this->ci->Auth->InsertLoginToken($_token, $user_id);
        if ($attemp > 0) {
            $this->ci->session->set_userdata(['_CI_token' => $_token]);
            set_flashdata('success', 'Welcome ' . $_token, 'home');
        } else {
            // _errorURL('error', 'Something went wrong!');
            _errorURL('Something went wrong!!', '');
        }
    }

    // Logout process
    public function my_logout()
    {
        if ($this->ci->session->userdata('_CI_token')) {
            $destroy_token = $this->ci->Auth->DeleteMyToken($this->ci->session->userdata('_CI_token'));
            if ($destroy_token > 0) {
                $this->ci->session->unset_userdata(['_CI_token']);
                set_flashdata('success', 'Logout successful, have a nice day', '');
            } else {
                _errorURL('Something went wrong!!', '');
            }
        } else {
            $this->ci->session->sess_destroy();
            _errorURL('Something went wrong!!', '');
        }
    }

    // Read _CI_token
    public function present_current_token()
    {
        $_token = $this->ci->session->userdata('_CI_token');
        $data = $this->ci->Auth->GetMyToken($_token);
        return $data;
    }

    // Register Process
    public function my_register($fullname, $email, $password)
    {
        $token = Str::random(70);
        $register = $this->ci->Auth->RegisterNewUser($fullname, $email, $password, $token);
        if ($register > 0) {
            $this->sendEmail($email, $token, 'user_activation');
            set_flashdata('success', 'Welcome, please activate your email first!', '');
        } else {
            _errorURL('Something went wrong!!', 'register');
        }
    }

    // Lost Password Process
    public function my_lostPasswd($email)
    {
        $token = Str::random(70);
        $lostPasswd = $this->ci->Auth->LostPasswordRequest($email, $token);
        if ($lostPasswd > 0) {
            $this->sendEmail($email, $token, 'user_forpasswd');
            set_flashdata('success', 'Request has been sent, please check your email', '');
        } else {
            _errorURL('Something went wrong!!', '');
        }
    }

    // Send Email To User
    public function sendEmail($email, $token, $purpose)
    {
        if ($purpose) {
            $config = array(
                'protocol' => 'smtp',
                'smtp_host' => '', // smtp host
                'smtp_port' => '', // smtp port (integer)
                'smtp_user' => '', // smtp email user
                'smtp_pass' => '', // smtp password user
                'mailtype' => 'html',
                'charset' => 'iso-8859-1',
                'newline' => "\r\n"
            );
            $this->ci->load->library('email', $config);
            $this->ci->email->initialize($config);
            $this->ci->email->from($config['smtp_user'], 'Your Header');
            $this->ci->email->to($email);

            if ($purpose == 'user_activation') {
                $this->ci->email->subject('User Activation');
                $this->ci->email->message('Click this link for verify your account : <a href="' . base_url() . 'verification?access_key=' . $token . '">Activate</a>');
            } elseif ($purpose == 'user_forpasswd') {
                $this->ci->email->subject('Forgot Password');
                $this->ci->email->message('Click this link for renew your password : <a href="' . base_url() . 'password_renew?access_key=' . $token . '">Renew Password<a>');
            }

            $this->ci->email->send();
        }
    }
}

/* End of file Apps_library.php */
