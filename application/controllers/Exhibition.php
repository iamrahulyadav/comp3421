<?php
require_once dirname(__FILE__) . '/CrudController.php';

/**
 * comp3421
 * Created by LKHO.
 * Date: 14/12/2015 20:10
 */
class Exhibition extends CrudController
{
    public $table = 'exhibition';
    public $title = 'Exhibitions';
    public $view = array(
        'index'  => 'exhibition_list',
        'item'   => 'exhibition_item',
        'create' => 'simple_form',
        'edit'   => 'simple_form'
    );
}