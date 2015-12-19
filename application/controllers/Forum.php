<?php
require_once dirname(__FILE__) . '/CrudController.php';

/**
 * comp3421
 * Created by LKHO.
 * Date: 14/12/2015 17:34
 */
class Forum extends CrudController
{
    public $table = 'forum';
    public $title = 'Forums';
    public $view = array(
        'index'  => 'simple_list',
        'item'   => 'forum_item',
        'create' => 'simple_form',
        'edit'   => 'simple_form',
    );
    public $fields = array(
        
    );
}