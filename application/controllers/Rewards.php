<?php
require_once dirname(__FILE__) . '/CrudController.php';

/**
 * comp3421
 * Created by LKHO.
 * Date: 14/12/2015 17:34
 */
class Rewards extends CrudController
{
    public $table = 'rewards';
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
        'time'    => array('label' => 'Time', 'type' => 'datetime-local', 'title' => 'Time'),
    );
}