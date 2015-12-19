<?php
require_once dirname(__FILE__) . '/CrudController.php';

/**
 * comp3421
 * Created by LKHO.
 * Date: 14/12/2015 17:34
 */
class Announcements extends CrudController
{
    public $table = 'announcements';
    public $title = 'Announcements';
    public $view = array(
        'index'  => 'simple_list',
        'item'   => 'announcements',
        'create' => 'simple_form',
        'edit'   => 'simple_form',
    );

    public $fields = array(
        'topic'      => array('name' => 'id', 'type' => 'text'),
        'info'       => array('name' => 'Conference Description', 'type' => 'textarea'),
        'start_time' => array('name' => 'Start time', 'type' => 'datetime-local'),
        'end_time'   => array('name' => 'End time', 'type' => 'datetime-local'),
        'speaker'    => array('name' => 'Speaker', 'type' => 'text'),
        'venue'      => array('name' => 'Venue', 'type' => 'text'),
    );
}