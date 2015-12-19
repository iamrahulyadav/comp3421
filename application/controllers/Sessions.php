<?php
require_once dirname(__FILE__) . '/CrudController.php';

/**
 * comp3421
 * Created by LKHO.
 * Date: 14/12/2015 17:34
 */
class Sessions extends CrudController
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
        'topic'      => array('name' => 'Conference topic', 'type' => 'text', 'title' => 'Topic'),
        'info'       => array('name' => 'Conference Description', 'type' => 'textarea'),
        'start_time' => array('name' => 'Start time', 'type' => 'datetime-local', 'title' => 'Start'),
        'end_time'   => array('name' => 'End time', 'type' => 'datetime-local', 'title' => 'End'),
        'speaker'    => array('name' => 'Speaker', 'type' => 'text', 'title' => 'Speaker'),
        'venue'      => array('name' => 'Venue', 'type' => 'text', 'title' => 'Venue'),
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