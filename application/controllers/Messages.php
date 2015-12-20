<?php
require_once dirname(__FILE__) . '/CrudController.php';

/**
 * comp3421
 * Created by LKHO.
 * Date: 14/12/2015 17:34
 */
class Messages extends CrudController
{
    public $table = 'message';
    public $title = 'Messages Programs';
    public $view = array(
        'index'  => 'simple_list',
        'detail'   => 'messages_detail',
        'create' => 'simple_form',
        'edit'   => 'simple_form',
    );

    public $fields = array(
        'id'          => array('column' => 'No.'),
        'sender_id'   => array('label' => 'Sender ID', 'type' => 'text', 'column' => 'Sender ID'),
        'receiver_id' => array('label' => 'Receiver ID', 'type' => 'text', 'column' => 'Receiver ID'),
        'title'       => array('label' => 'Title', 'type' => 'text', 'column' => 'Title'),
        'content'     => array('label' => 'Content', 'type' => 'textarea'),
        'time'        => array('label' => 'Time', 'type' => 'datetime'),
    );
}