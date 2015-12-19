<?php
require_once dirname(__FILE__) . '/CrudController.php';

/**
 * comp3421
 * Created by LKHO.
 * Date: 14/12/2015 17:34
 */
class Surveys extends CrudController
{
    public $table = 'survey';
    public $title = 'Surveys';

    public $view = array(
        'index'   => 'simple_list',
        'detail'  => 'simple_list',
        'create'  => 'simple_form',
        'edit'    => 'simple_form',
    );

    public function __construct()
    {
        parent::__construct();
        $this->fields = array(
            'id'           => array('column' => 'ID'),
            'title'        => array('label' => 'Title', 'type' => 'text', 'column' => 'Title'),
            'is_published' => array('label' => 'Published?', 'type' => 'checkbox', 'column' => 'Published?'),
        );
    }

    public function detail($id)
    {
        check_access(TRUE, TRUE);

        $data = array(
            'title'      => 'Edit Survey Questions',
            'menu'       => $this->load->view('menu', NULL, TRUE),
            'create_url' => site_url(uri_string() . '/create'),
            'edit_url'   => site_url(uri_string() . '/edit/{id}'),
            'delete_url' => site_url(uri_string() . '/delete/{id}'),
            'fields'     => array(
                'order'       => array(
                    'label'  => 'Display Order',
                    'type'   => 'number',
                    'attr'   => array('min' => 0, 'required' => ''),
                    'column' => 'Display Order',
                ),
                'name'        => array(
                    'label'  => 'Key (must be unique within question)',
                    'type'   => 'text',
                    'attr'   => array('required' => ''),
                    'column' => 'Key',
                ),
                'description' => array(
                    'label' => 'Description (html supported)',
                    'type'  => 'textarea',
                ),
                'type'        => array(
                    'label'  => 'Question type',
                    'type'   => 'select',
                    'values' => array(
                        'text'           => 'Text',
                        'textarea'       => 'Paragraph',
                        'number'         => 'Number (integer only)',
                        'datetime-local' => 'Date time',
                        'checkbox'       => 'Yes No (checkbox)',
                        'select'         => 'Choices (pull-down menu)',
                        'radio'          => 'Choices (radio button)',
                    ),
                    'column' => 'Type',
                ),
                'options'     => array(
                    'label' => 'Choices (if applicable, one line per item)',
                    'type'  => 'textarea',
                ),
            ),
        );

        $r = $this->db->where('survey_id', $id)->order_by('order')->get($this->table . '_field');
        $data['data'] = $r->result_array();
        foreach ($data['data'] as &$v)
            $v['id'] = $v['order'];

        $this->load->view($this->view[__FUNCTION__], $data);
    }
}