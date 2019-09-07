<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Auth extends CI_Model
{
    // find user by email and password
    function LoginAttemp($email, $password)
    {
        $this->db->limit(1);
        $proc1 = $this->db->get_where('users', ['email' => $email]);
        foreach ($proc1->result() as $pr1) {
            $pass_crypt = $pr1->password;
        }
        if (isset($pass_crypt)) {
            if (password_verify($password, $pass_crypt)) {
                return 'TRUE';
            } else {
                return 'FALSE';
            }
        } else {
            return 'NULL';
        }
    }

    // get data user by email return user_id
    function UserAttemp($email)
    {
        $this->db->limit(1);
        $this->db->select('user_id');
        $data = $this->db->get_where('users', ['email' => $email]);
        return $data->result();
    }

    // insert token login into login_temp table
    function InsertLoginToken($_token, $user_id)
    {
        $this->db->insert('login_temp', ['miss_token' => $_token, 'user_id' => $user_id]);
        return $this->db->affected_rows();
    }

    // find my token
    function FindMyToken($_token)
    {
        $this->db->limit(1);
        $data = $this->db->get_where('login_temp', ['miss_token' => $_token]);
        if ($data->num_rows() == 0) {
            return 'FALSE';
        } else {
            return 'TRUE';
        }
    }

    // get token access
    function GetMyToken($_token)
    {
        $this->db->limit(1);
        $this->db->select('user_id');
        $data1 = $this->db->get_where('login_temp', ['miss_token' => $_token]);
        if ($data1->num_rows() == 0) {
            return false;
        } else {
            foreach ($data1->result() as $dt) {
                $userID = $dt->user_id;
            }
            $this->db->limit(1);
            $this->db->select('user_id, name, email');
            $data2 = $this->db->get_where('users', ['user_id' => $userID]);
            if ($data2->num_rows() == 0) {
                return false;
            } else {
                return $data2->result();
            }
        }
    }

    // delete token access
    function DeleteMyToken($_token)
    {
        $this->db->delete('login_temp', array('miss_token' => $_token));
        return $this->db->affected_rows();
    }

    // user register
    function RegisterNewUser($fullname, $email, $password, $token)
    {
        $this->db->insert('users', ['user_id' => create_id_for_member(), 'name' => $fullname, 'email' => $email, 'password' => password_hash($password, PASSWORD_BCRYPT), 'user_stat' => 'not_active']);
        $this->db->insert('password_resets', ['email' => $email, 'token' => $token]);
        return $this->db->affected_rows();
    }

    // user lost password
    function LostPasswordRequest($email, $token)
    {
        $this->db->insert('password_resets', ['email' => $email, 'token' => $token]);
        return $this->db->affected_rows();
    }
}

/* End of file Auth.php */
