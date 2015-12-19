<?php
require_once dirname(__FILE__) . '/CrudController.php';

/**
 * comp3421
 * Created by LKHO.
 * Date: 20/12/2015 0:56
 */
class DoSurvey extends CrudController
{
    public $table = 'survey_response';
    public $title = 'Do Survey';

    public $view = array(
        'index'  => 'simple_list',
        'create' => 'simple_form',
        'edit'   => FALSE,
        'delete' => FALSE,
    );

    public function __construct()
    {
        parent::__construct();
        $this->fields = array(
            'id'    => array('column' => 'ID'),
            'title' => array('label' => 'Title', 'type' => 'text', 'column' => 'Title'),
        );
    }

    public function index()
    {
        $this->table = 'survey';
        $data = array(
            'title'      => $this->title,
            'menu'       => $this->load->view('menu', NULL, TRUE),
            'detail_url' => site_url(uri_string() . '/{id}'),
            'fields'     => $this->processDynamicSource($this->fields, array(__FUNCTION__)),
        );

        $r = $this->db->get($this->table);
        $data['data'] = $r->result_array();
        $this->load->view($this->view[__FUNCTION__], $data);
    }

    public function create($survey_id = 0)
    {

    }
}