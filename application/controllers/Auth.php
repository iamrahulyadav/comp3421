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
                'email' => array(
                    'name' => 'Email',
                    'type' => 'email',
                    'attr' => array('required' => '', 'autofocus' => ''),
                ),
                'pw'    => array(
                    'name' => 'Password',
                    'type' => 'password',
                ),
            ),
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

        $data['menu'] = $this->load->view('menu', NULL, TRUE);
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
                'id'             => array('name' => 'Registration ID', 'type' => 'text'),
                'email'          => array('name' => 'Email', 'type' => 'email'),
                'password'       => array('name' => 'Password', 'type' => 'password'),
                'title'          => array('name' => 'Title (Dr, Prof, Mr, Ms, Mrs)', 'type' => 'text'),
                'first_name'     => array('name' => 'First Name', 'type' => 'text'),
                'last_name'      => array('name' => 'Last Name', 'type' => 'text'),
                'address'        => array('name' => 'Address', 'type' => 'textarea'),
                'city'           => array('name' => 'City', 'type' => 'text'),
                'country'        => array('name' => 'Country', 'type' => 'text'),
                'attendee_type'  => array(
                    'name'   => 'Attendee Type',
                    'type'   => 'select',
                    'values' => array(
                        'Student'     => 'Student',
                        'Participant' => 'Participant',
                        'Sponsor'     => 'Sponsor',
                        'VIP'         => 'VIP',
                        'Speaker'     => 'Speaker',
                    ),
                ),
                'department'     => array('name' => 'Department', 'type' => 'text'),
                'company'        => array('name' => 'Company', 'type' => 'text'),
                'phone_number'   => array('name' => 'Phone Number', 'type' => 'text'),
                'fax_number'     => array('name' => 'Fax Number', 'type' => 'text'),
                'payment_status' => array(
                    'name'   => 'Payment Status',
                    'type'   => 'select',
                    'values' => array(
                        'Unpaid' => 'Unpaid',
                        'Cash'   => 'Cash',
                        'Credit' => 'Credit Card',
                        'EPS'    => 'EPS',
                        'Cheque' => 'Cheque',
                    ),
                ),
                'remarks'        => array('name' => 'Remarks', 'type' => 'textarea'),
                'is_admin'       => array('name' => 'Is administrator ? ', 'type' => 'checkbox'),
            ),
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
                        if(confirm('Register Success!\\nClick OK to enter a new record or cancel to go back to Home . '))
                            window.parent.location.reload();
                        else
                            window.parent.location = $x;
                    </script>"
                );
            }

            return;
        }

        $data['menu'] = $this->load->view('menu', NULL, TRUE);
        $this->load->view('simple_form', $data);
    }
}