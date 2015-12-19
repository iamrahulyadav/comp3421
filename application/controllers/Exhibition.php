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
        'index'  => 'simple_list',
        'item'   => 'exhibition_item',
        'create' => 'simple_form',
        'edit'   => 'simple_form'
    );

    public $fields = array(
    	'id'=> array('name'=>'No.'),
    	'start_date'=> array('name'=>'Start Date'),
    	'end_date'=> array('name'=>'End Date'),
    	'start_time'=> array('name'=>'Start Time'),
    	'end_time'=> array('name'=>'End Time'),
    	'name'=> array('name'=>'Name'),
    	'venue'=> array('name'=>'Venue'),
    	'company'=> array('name'=>'Company'),
    	'info'=> array('name'=>'View Infomation')
    	);
}