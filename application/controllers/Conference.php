<?php
require_once dirname(__FILE__) . '/CrudController.php';

/**
 * comp3421
 * Created by LKHO.
 * Date: 14/12/2015 17:34
 */
class Conference extends CrudController
{
    public $table = 'conference';
    public $title = 'Conference Programs';
    public $view = array(
        'index_get' => 'conference_list',
        'create'    => 'conference_create',
        'edit'      => 'conference_edit'
    );
}