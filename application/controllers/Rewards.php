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
        'index'  => 'rewards_list',
        'item'   => 'rewards_item',
        'create' => 'rewards_create',
        'edit'   => 'rewards_edit'
    );
}