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

    public $list = array(
    	'column1'=> array('title'=>'No.','db_column_name'=>'id'),
    	'column2'=> array('title'=>'Start Date','db_column_name'=>'start_date'),
    	'column3'=> array('title'=>'End Date','db_column_name'=>'end_date'),
    	'column4'=> array('title'=>'Start Time','db_column_name'=>'start_time'),
    	'column5'=> array('title'=>'End Time','db_column_name'=>'end_time'),
    	'column6'=> array('title'=>'Name','db_column_name'=>'name'),
    	'column7'=> array('title'=>'Venue','db_column_name'=>'venue'),
    	'column8'=> array('title'=>'Company','db_column_name'=>'company'),
    	'column9'=> array('title'=>'View Infomation','db_column_name'=>'info'),
    	);
}