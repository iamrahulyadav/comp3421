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
        'index'  => 'simple_list',
        'detail'   => 'conference_item',
        'create' => 'simple_form',
        'edit'   => 'simple_form',
    );
    public $fields = array(
        'id'         => array('column' => 'ID'),
        'topic'      => array('label' => 'Conference topic', 'type' => 'text', 'column' => 'Topic'),
        'info'       => array('label' => 'Conference Description', 'type' => 'textarea'),
        'start_time' => array('label' => 'Start time', 'type' => 'datetime-local', 'column' => 'Start'),
        'end_time'   => array('label' => 'End time', 'type' => 'datetime-local', 'column' => 'End'),
        'speaker'    => array('label' => 'Speaker', 'type' => 'text', 'column' => 'Speaker'),
        'venue'      => array('label' => 'Venue', 'type' => 'text', 'column' => 'Venue'),
        'venue_lat'  => array('label' => 'Location (lat)', 'type' => 'text',),
        'venue_lng'  => array('label' => 'Location (Lng)', 'type' => 'text',),
        'venue_map'  => array(
            'label' => 'Pick the location of the venue on the map<br>or type it in the box above',
            'type' => 'map',
            'lat'  => 'venue_lat',
            'lng'  => 'venue_lng',
            'attr' => array(
                'style' => 'width: 450px; height: 300px',
            ),
        ),
    );
}