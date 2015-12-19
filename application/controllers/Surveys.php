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
        'index'  => 'simple_list',
        'create' => 'simple_form',
        'edit'   => 'simple_form',
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
}