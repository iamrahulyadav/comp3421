<?php
require_once dirname(__FILE__) . '/CrudController.php';

/**
 * comp3421
 * Created by LKHO.
 * Date: 14/12/2015 17:34
 */
class Conference extends CrudController
{
    public $table = 'session';
    public $title = 'Conference Sessions';
    public $view = array(
        'index'  => 'conference_list',
        'item'   => 'conference_item',
        'create' => 'simple_form',
        'edit'   => 'simple_form',
    );
    public $fields = array(
        'topic'      => array('name' => 'Conference topic', 'type' => 'text'),
        'info'       => array('name' => 'Conference Description', 'type' => 'textarea'),
        'start_time' => array('name' => 'Start time', 'type' => 'datetime-local'),
        'end_time'   => array('name' => 'End time', 'type' => 'datetime-local'),
        'speaker'    => array('name' => 'Speaker', 'type' => 'text'),
        'venue'      => array('name' => 'Venue', 'type' => 'text'),
        'venue_lat'  => array(
            'type' => 'hidden',
        ),
        'venue_lng'  => array(
            'type' => 'hidden',
        ),
        'venue_map'  => array(
            'name' => 'Pick the location of the venue on the map',
            'type' => 'map',
            'lat'  => 'venue_lat',
            'lng'  => 'venue_lng',
        ),
    );
}