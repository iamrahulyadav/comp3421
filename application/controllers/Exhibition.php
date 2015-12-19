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
    	'id'=> array('title'=>'No.'),
    	'start_date'=> array('title'=>'Start Date'),
    	'end_date'=> array('title'=>'End Date'),
    	'start_time'=> array('title'=>'Start Time'),
    	'end_time'=> array('title'=>'End Time'),
    	'name'=> array('title'=>'Name'),
    	'venue'=> array('title'=>'Venue'),
    	'company'=> array('title'=>'Company'),
    	'info'=> array('title'=>'View Infomation')
    	);
}