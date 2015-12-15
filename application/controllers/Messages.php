<?php
require_once dirname(__FILE__) . '/CrudController.php';

/**
 * comp3421
 * Created by LKHO.
 * Date: 14/12/2015 17:34
 */
class Messages extends CrudController
{
    public $table = 'messages';
    public $title = 'Messages Programs';
    public $view = array(
        'index'  => 'messages_list',
        'item'   => 'messages_item',
        'create' => 'messages_create',
        'edit'   => 'messages_edit'
    );
}