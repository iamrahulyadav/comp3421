<?php
require_once dirname(__FILE__) . '/CrudController.php';

/**
 * comp3421
 * Created by LKHO.
 * Date: 14/12/2015 17:34
 */
class Announcements extends CrudController
{
    public $table = 'announcement';
    public $title = 'Announcements';
    public $view = array(
        'index'  => 'simple_list',
        'detail'   => 'announcements',
        'create' => 'simple_form',
        'edit'   => 'simple_form',
    );

    public $fields = array(
        'id'      => array('column' => 'No.'),
        'title'   => array('label' => 'Title', 'type' => 'text', 'column' => 'Title'),
        'content' => array('label' => 'Content', 'type' => 'textarea'),
        'time'    => array('label' => 'Time', 'type' => 'datetime-local', 'title' => 'Time'),
    );
}