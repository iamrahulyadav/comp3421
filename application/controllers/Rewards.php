<?php
require_once dirname(__FILE__) . '/CrudController.php';

/**
 * comp3421
 * Created by LKHO.
 * Date: 14/12/2015 17:34
 */
class Rewards extends CrudController
{
    public $table = 'reward';
    public $title = 'Rewards';
    public $view = array(
        'index'  => 'simple_list',
        'item'   => 'rewards_item',
        'create' => 'simple_form',
        'edit'   => 'simple_form'
    );
    public $fields = array(
        'id'      => array('column' => 'No.'),
        'title'   => array('label' => 'Title', 'type' => 'text', 'column' => 'Title'),
        'content' => array('label' => 'Content', 'type' => 'textarea', 'column' => 'Content'),
        'receive_id'   => array('label' => 'Receiver ID', 'type' => 'text', 'column' => 'Title'),
    );
    public function index()
    {
        check_access(TRUE);

        $data = array(
            'title'      => $this->title,
            'menu'       => $this->load->view('menu', NULL, TRUE),
            'item_url'   => site_url(uri_string() . '/item/{id}'),
            'create_url' => site_url(uri_string() . '/create'),
            'edit_url'   => site_url(uri_string() . '/edit/{id}'),
            'delete_url' => site_url(uri_string() . '/delete/{id}'),
            'fields'     => $this->fields,
        );

        $r = $this->db->where('receiver_id', $this->auth->user()->id)->get($this->table);
        $data['data'] = $r->result_array();

        $this->load->view($this->view[__FUNCTION__], $data);
    }
}