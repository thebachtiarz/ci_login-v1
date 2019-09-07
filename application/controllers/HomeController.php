<?php
defined('BASEPATH') or exit('No direct script access allowed');

class HomeController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        stable_session();
    }

    public function HomeApps()
    {
        $myData = $this->apps_library->present_current_token();
        if ($myData != NULL) {
            foreach ($myData as $key) {
                $catchData = ['user_id' => $key->user_id, 'name' => $key->name, 'email' => $key->email, 'token' => get_my_token()];
            }
        } else {
            return _errorURL('Something went wrong!!', 'OAuth/signout');
        }

        return view('body.home.home_body', compact(['catchData']));
    }
}

/* End of file HomeController.php */
