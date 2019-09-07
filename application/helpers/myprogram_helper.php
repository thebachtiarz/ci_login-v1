<?php

function unstable_session() // initialization user, redirect to home if has session
{
    $ci = &get_instance();
    $ci->load->model('Auth');

    if ($ci->session->userdata('_CI_token')) {
        $check = $ci->Auth->FindMyToken($ci->session->userdata('_CI_token'));
        if ($check == 'TRUE') {
            set_flashdata('info', 'You has logged !!', 'home');
        } else {
            # do nothing
        }
    }
}

function stable_session() // initialization user, kick if no session
{
    $ci = &get_instance();
    $ci->load->model('Auth');

    if ($ci->session->userdata('_CI_token')) {
        $check = $ci->Auth->FindMyToken($ci->session->userdata('_CI_token'));
        if ($check == 'TRUE') {
            # can entry
        } else {
            _errorURL('Your session has timed out !!', 'signin');
        }
    } else {
        _errorURL('Please login first !!', 'signin');
    }
}

function get_my_token()
{
    $ci = &get_instance();
    return $ci->session->userdata('_CI_token');
}

function maintenance()
{
    $ci = get_instance();
    $ci->session->sess_destroy();
    redirect('website_maintenance', 'refresh');
}

function create_id_for_member()
{
    $l_i = round(microtime(true) * 10000);
    $t = substr($l_i, -4);
    $user_id = date("ymdNHis$t");
    return $user_id;
}

function set_flashdata($type = '', $message = '', $redirect = '')
{
    $ci = &get_instance();
    $ci->session->set_flashdata($type, $message);
    redirect($redirect, 'refresh');
}

function get_flashdata()
{
    $ci = &get_instance();
    if ($ci->session->flashdata('success')) {
        echo $ci->session->flashdata('success');
    }
    if ($ci->session->flashdata('error')) {
        echo $ci->session->flashdata('error');
    }
    if ($ci->session->flashdata('warning')) {
        echo $ci->session->flashdata('warning');
    }
    if ($ci->session->flashdata('info')) {
        echo $ci->session->flashdata('info');
    }
    if ($ci->session->flashdata('question')) {
        echo $ci->session->flashdata('question');
    }
}

# function below is private, only access from public function
function _signout_message()
{
    $ci = get_instance();
    $ci->session->set_flashdata('success', 'Logout Success, have a nice day..');
    redirect('', 'refresh');
}

# success url handler
function _succURL($err_message = '', $redirect = '')
{
    $ci = &get_instance();
    if ($err_message) {
        $ci->session->set_flashdata('success', $err_message);
    } else {
        $ci->session->set_flashdata('success', 'Command Successfully Executed');
    }

    redirect($redirect, 'refresh');
}

# error url handling
function _errorURL($err_message = '', $redirect = '')
{
    $ci = &get_instance();
    if ($err_message) {
        $ci->session->set_flashdata('warning', $err_message);
    } else {
        $ci->session->set_flashdata('warning', 'Canceling statement due to user request');
    }

    redirect($redirect, 'refresh');
}

# close page
function _closePage()
{
    echo "<script type='text/javascript'>window.close();</script>";
}

# asset folder
function asset_js($file)
{
    return base_url() . 'public/js/' . $file . '.js';
}
