<?php
require_once dirname(__FILE__) . '/CrudController.php';

/**
 * comp3421
 * Created by LKHO.
 * Date: 14/12/2015 17:34
 */
class Surveys extends CrudController
{
    public $table = 'surveys';
    public $title = 'Surveys';
    public $view = array(
        'index'  => 'surveys_list',
        'item'   => 'surveys_item',
        'create' => 'surveys_create',
        'edit'   => 'surveys_edit'
    );
}