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
                    'label' => 'Email',
                    'type' => 'email',
                    'attr' => array('required' => '', 'autofocus' => ''),
                ),
                'pw'    => array(
                    'label' => 'Password',
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
                'id'             => array(
                    'label' => 'Registration ID',
                    'type' => 'text',
                    'attr' => array('required' => '', 'autofocus' => ''),
                ),
                'email'          => array(
                    'label' => 'Email',
                    'type' => 'email',
                    'attr' => array('required' => ''),
                ),
                'password'       => array(
                    'label' => 'Password',
                    'type' => 'password',
                ),
                'title'          => array(
                    'label'   => 'Title',
                    'type'   => 'select',
                    'values' => array(
                        'Mr'   => 'Mr',
                        'Ms'   => 'Ms',
                        'Mrs'  => 'Mrs',
                        'Dr'   => 'Dr',
                        'Prof' => 'Prof',
                    ),
                ),
                'first_name'     => array(
                    'label' => 'First Name',
                    'type' => 'text',
                ),
                'last_name'      => array(
                    'label' => 'Last Name',
                    'type' => 'text',
                ),
                'address'        => array(
                    'label' => 'Address',
                    'type' => 'textarea',
                ),
                'city'           => array(
                    'label' => 'City',
                    'type' => 'text',
                ),
                'country'        => array(
                    'label' => 'Country',
                    'type' => 'text',
                ),
                'attendee_type'  => array(
                    'label'   => 'Attendee Type',
                    'type'   => 'select',
                    'values' => array(
                        'student'     => 'Student',
                        'participant' => 'Participant',
                        'sponsor'     => 'Sponsor',
                        'vip'         => 'VIP',
                        'speaker'     => 'Speaker',
                    ),
                ),
                'department'     => array(
                    'label' => 'Department',
                    'type' => 'text',
                ),
                'company'        => array(
                    'label' => 'Company',
                    'type' => 'text',
                ),
                'phone_number'   => array(
                    'label' => 'Phone Number',
                    'type' => 'tel',
                ),
                'fax_number'     => array(
                    'label' => 'Fax Number',
                    'type' => 'tel',
                ),
                'payment_status' => array(
                    'label'   => 'Payment Status',
                    'type'   => 'select',
                    'values' => array(
                        'unpaid' => 'Unpaid',
                        'cash'   => 'Paid by Cash',
                        'credit' => 'Paid by Credit Card',
                        'epa'    => 'Paid by EPS',
                        'cheque' => 'Paid by Cheque',
                    ),
                ),
                'remarks'        => array(
                    'label' => 'Remarks',
                    'type' => 'textarea',
                ),
                'is_admin'       => array(
                    'label' => 'Is administrator?',
                    'type' => 'checkbox',
                ),
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
                    ->insert('member', $fields) === FALSE
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