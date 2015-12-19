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
        'index'    => 'simple_list',
        'create'   => 'simple_form',
        'edit'     => 'simple_form',
        'response' => 'simple_list',
    );

    public function __construct()
    {
        parent::__construct();
        $this->fields = array(
            'id'           => array('column' => 'ID'),
            'title'        => array('label' => 'Title', 'type' => 'text', 'column' => 'Title'),
            'is_published' => array('label' => 'Published?', 'type' => 'checkbox', 'column' => 'Published?'),
            'response'     => array('column' => 'View Response'),
        );
    }

    public function index()
    {
        $url = site_url(uri_string() . '/response') . '/';
        $this->db->select(array('*', "concat('<a href=\"$url',id,'\"><button>View</button></a>') as response"));
        parent::index();
    }

    public function response($id)
    {
        $this->table = 'survey_response';
        
    }
}