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
        $data = array(
            'title'  => 'Log In',
            'button' => 'Log In',
            'fields' => array(
                'email' => array('Email', 'email'),
                'pw'    => array('Password', 'password')
            )
        );

        if ($this->input->method() == 'post') {

            $email = $this->input->post('email');
            $pw = $this->input->post('pw');

            if (isset($email, $pw)) {
                if ($this->auth->logIn($email, $pw)) {
                    $x = json_encode(site_url());
                    $this->output->append_output("<script>window.parent.location = $x;</script>");

                    return;
                } else {
                    $data['err'] = 'Wrong email or password';
                }
            } else {
                $data['err'] = 'Missing Field';
                $this->output->set_status_header(400);
            }

        }

        $this->load->view('simple_form', $data);
    }

    public function logout()
    {
        $this->auth->logOut();
        redirect('');
    }

    public function register()
    {
        check_access(TRUE, TRUE);

        $data = array(
            'title'  => 'Register',
            'button' => 'Register',
            'fields' => array(
                'email'          => array('Email', 'email'),
                'password'       => array('Password', 'password'),
                'title'          => array('Title (Dr, Prof, Mr, Ms, Mrs)', 'text'),
                'first_name'     => array('First Name', 'text'),
                'last_name'      => array('Last Name', 'text'),
                'address'        => array('Address', 'text'),
                'city'           => array('City', 'text'),
                'country'        => array('Country', 'text'),
                'attendee_type'  => array('Attendee Type<br>(Student, Participant, Sponsor, VIP, Speaker)', 'text'),
                'department'     => array('Department', 'text'),
                'company'        => array('Company', 'text'),
                'phone_number'   => array('Phone Number', 'text'),
                'fax_number'     => array('Fax Number', 'text'),
                'payment_status' => array('Payment Status<br>(Unpaid, Cash, Credit, EPS, Cheque)', 'text'),
                'remarks'        => array('Remarks', 'text'),
                'is_admin'       => array('Is administrator?', 'checkbox'),
            )
        );

        if ($this->input->method() == 'post') {

            $this->load->database();

            $fields = $this->input->post();
            foreach ($fields as &$v)
                if ($v == "")
                    $v = NULL;
            $fields['is_admin'] = empty($fields['is_admin']);

            if ($this->db
                    ->set('registration_date', 'now()', FALSE)
                    ->insert('members', $fields) === FALSE
            ) {
                $e = $this->db->error();
                $e = json_encode($e['message']);
                $this->output->append_output(
                    "<script>
                        alert('Database Error:\\n' + $e);
                    </script>"
                );
            } else {
                $x = json_encode(site_url());
                $this->output->append_output(
                    "<script>
                        if(confirm('Register Success!\\nClick OK to enter a new record or cancel to go back to Home.'))
                            window.parent.location.reload();
                        else
                            window.parent.location = $x;
                    </script>"
                );
            }

            return;
        }

        $this->load->view('simple_form', $data);
    }
}