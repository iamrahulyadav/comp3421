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
    	'start_time' => array('name' => 'Start time', 'type' => 'datetime-local', 'title' => 'Start'),
        'end_time'   => array('name' => 'End time', 'type' => 'datetime-local', 'title' => 'End'),
    	'name'=> array('name'=>'Name','type'=>'text','title'=>'Name'),
    	'venue'      => array('name' => 'Venue', 'type' => 'text', 'title' => 'Venue'),
    	'company'=> array('name'=>'Company','type'=>'text','title'=>'Company'),
    	'info'=> array('name'=>'Infomation','type'=>'text','title'=>'View Infomation')
        'venue_lat'  => array('name' => 'Location (lat)', 'type' => 'text',),
        'venue_lng'  => array('name' => 'Location (Lng)', 'type' => 'text',),
        'venue_map'  => array(
            'name' => 'Pick the location of the venue on the map<br>or type it in the box above',
            'type' => 'map',
            'lat'  => 'venue_lat',
            'lng'  => 'venue_lng',
            'attr' => array(
                'style' => 'width: 400px; height: 300px',
            ),
        ),
    	);
}