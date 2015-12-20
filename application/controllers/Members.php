<?php
require_once dirname(__FILE__) . '/CrudController.php';

/**
 * comp3421
 * Created by LKHO.
 * Date: 20/12/2015 4:33
 */
class Members extends CrudController
{
    public $table = 'member';
    public $title = 'Members';

    public $view = array(
        'index'  => 'simple_list',
        'edit'   => 'simple_form',
        'update' => 'simple_form',
        'detail' => FALSE,
    );

    public $fields = array(
        'id'             => array(
            'label'  => 'Registration ID',
            'type'   => 'text',
            'attr'   => array('required' => '', 'autofocus' => ''),
            'column' => 'ID',
        ),
        'email'          => array(
            'label'  => 'Email',
            'type'   => 'email',
            'attr'   => array('required' => ''),
            'column' => 'Email',
        ),
        'password'       => array(
            'label' => 'Password',
            'type'  => 'password',
        ),
        'title'          => array(
            'label'  => 'Title',
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
            'label'  => 'First Name',
            'type'   => 'text',
            'column' => 'First Name',
        ),
        'last_name'      => array(
            'label'  => 'Last Name',
            'type'   => 'text',
            'column' => 'Last Name',
        ),
        'address'        => array(
            'label' => 'Address',
            'type'  => 'textarea',
        ),
        'city'           => array(
            'label' => 'City',
            'type'  => 'text',
        ),
        'country'        => array(
            'label' => 'Country',
            'type'  => 'text',
        ),
        'attendee_type'  => array(
            'label'  => 'Attendee Type',
            'type'   => 'select',
            'values' => array(
                'student'     => 'Student',
                'participant' => 'Participant',
                'sponsor'     => 'Sponsor',
                'vip'         => 'VIP',
                'speaker'     => 'Speaker',
            ),
            'column' => 'Type',
        ),
        'department'     => array(
            'label'  => 'Department',
            'type'   => 'text',
            'column' => 'Dept',
        ),
        'company'        => array(
            'label'  => 'Company',
            'type'   => 'text',
            'column' => 'Company',
        ),
        'phone_number'   => array(
            'label'  => 'Phone Number',
            'type'   => 'tel',
            'column' => 'Tel',
        ),
        'fax_number'     => array(
            'label' => 'Fax Number',
            'type'  => 'tel',
        ),
        'payment_status' => array(
            'label'  => 'Payment Status',
            'type'   => 'select',
            'values' => array(
                'unpaid' => 'Unpaid',
                'cash'   => 'Paid by Cash',
                'credit' => 'Paid by Credit Card',
                'epa'    => 'Paid by EPS',
                'cheque' => 'Paid by Cheque',
            ),
            'column' => 'Payment Status',
        ),
        'remarks'        => array(
            'label' => 'Remarks',
            'type'  => 'textarea',
        ),
        'is_admin'       => array(
            'label'  => 'Is administrator?',
            'type'   => 'checkbox',
            'column' => 'Is Admin?',
        ),
    );

    public function index()
    {
        check_access(TRUE, TRUE);

        $data = array(
            'title'      => $this->title,
            'menu'       => $this->load->view('menu', NULL, TRUE),
            'create_url' => site_url('/auth/register'),
            'edit_url'   => !isset($this->view['edit']) || $this->view['edit'] !== FALSE ? site_url(uri_string() . '/edit/{id}') : NULL,
            'delete_url' => !isset($this->view['delete']) || $this->view['delete'] !== FALSE ? site_url(uri_string() . '/delete/{id}') : NULL,
            'fields'     => $this->processDynamicSource($this->fields, array(__FUNCTION__)),
        );

        $r = $this->db->get($this->table);
        $data['data'] = $r->result_array();
        foreach ($data['data'] as &$v)
            $v = $this->processItemSource($v, __FUNCTION__);

        $this->load->view($this->view[__FUNCTION__], $data);
    }

}