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
        'edit'   => 'simple_form',
    );

    public $fields = array(
        'id'         => array('column' => 'No.'),
        'start_time' => array('label' => 'Start time', 'type' => 'datetime-local', 'column' => 'Start'),
        'end_time'   => array('label' => 'End time', 'type' => 'datetime-local', 'column' => 'End'),
        'name'       => array('label' => 'Name', 'type' => 'text', 'title' => 'Name'),
        'venue'      => array('label' => 'Venue', 'type' => 'text', 'column' => 'Venue'),
        'company'    => array('label' => 'Company', 'type' => 'text', 'column' => 'Company'),
        'info'       => array('label' => 'Infomation', 'type' => 'text', 'column' => 'View Infomation'),
        'venue_lat'  => array('label' => 'Location (lat)', 'type' => 'text'),
        'venue_lng'  => array('label' => 'Location (Lng)', 'type' => 'text'),
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