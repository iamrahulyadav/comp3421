<?php
/**
 * comp3421
 * Created by LKHO.
 * Date: 11/12/2015 23:57
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function login()
    {
        $data = array();

        if ($this->input->method() == 'post') {

            $email = $this->input->post('email');
            $pw = $this->input->post('pw');

            if (isset($email, $pw)) {
                if ($this->auth->logIn($email, $pw)) {
                    redirect('', 'location', 303);
                } else {
                    $data['err'] = 'Wrong email or password';
                }
            } else {
                $data['err'] = 'Missing Field';
                $this->output->set_status_header(400);
            }

        }

        $this->load->view('login.php', $data);
    }

    public function logout()
    {
        $this->auth->logOut();
        redirect('');
    }
}