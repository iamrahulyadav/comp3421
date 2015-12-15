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
        'index'  => 'announcements_list',
        'item'   => 'announcements_item',
        'create' => 'announcements_create',
        'edit'   => 'announcements_edit'
    );
}