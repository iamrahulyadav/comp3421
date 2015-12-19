<?php
require_once dirname(__FILE__) . '/CrudController.php';

/**
 * comp3421
 * Created by LKHO.
 * Date: 14/12/2015 17:34
 */
class Survey_compose extends CrudController
{
    public $table = 'survey_field';
    public $title = 'Survey Questions';
    public $survey_id;

    public $view = array(
        'index'  => 'simple_list',
        'create' => 'simple_form',
        'edit'   => 'simple_form',
    );

    public function __construct()
    {
        parent::__construct();
        $this->fields = array(
            'order'       => array(
                'label'  => 'Display Order',
                'type'   => 'number',
                'attr'   => array('min' => 0, 'required' => ''),
                'column' => 'Display Order',
            ),
            'id'          => array(
                'label'  => 'Field Key<br>
(must be unique within question)
<p style="color:red">WARNING!<br>
Changing the key after any survey response is collected<br>
will make the previous fields not being recognized</p>',
                'type'   => 'text',
                'attr'   => array('required' => ''),
                'column' => 'Field Key',
            ),
            'description' => array(
                'label' => 'Description (html supported)',
                'type'  => 'textarea',
            ),
            'type'        => array(
                'label'  => 'Question type
<p style="color:#f50">WARNING!<br>
Changing the question type after any survey response<br>
is collected may result in data not displayed<br>
properly.</p>',
                'type'   => 'select',
                'attr'   => array('required' => ''),
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
                'label' => 'Choices (if applicable, one line per item)
<p style="color:#f50">WARNING!<br>
Changing the choices after any survey response is<br>
collected may result in data not displayed properly.</p>',
                'type'  => 'textarea',
            ),
            'is_required' => array(
                'label'  => 'Required?',
                'type'   => 'checkbox',
                'column' => 'Required?',
            ),
        );
    }

    public function index($survey_id = 0)
    {
        check_access(TRUE, TRUE);
        $data = array(
            'title'      => $this->title,
            'menu'       => $this->load->view('menu', NULL, TRUE),
            'create_url' => site_url(uri_string() . '/create'),
            'edit_url'   => site_url(uri_string() . '/edit/{id}'),
            'delete_url' => site_url(uri_string() . '/delete/{id}'),
            'fields'     => $this->processDynamicSource($this->fields, array(__FUNCTION__)),
        );

        $r = $this->db->where('survey_id', $survey_id)->order_by('order')->get($this->table);
        $data['data'] = $r->result_array();

        $this->load->view($this->view[__FUNCTION__], $data);
    }

    public function create($survey_id = 0)
    {
        $order_id = $this->db->select('max(' . $this->db->protect_identifiers('order') . ')+1', FALSE)
                             ->where('survey_id', $survey_id)
                             ->get($this->table);
        var_dump($this->db->last_query());
        $order_id = $order_id->row_array();
        $order_id = reset($order_id);
        $this->fields['order']['attr']['value'] = isset($order_id) ? $order_id : 1;
        parent::create();
    }

    public function create_post($survey_id = 0)
    {
        $_POST['survey_id'] = $survey_id;
        parent::create_post();
    }
}