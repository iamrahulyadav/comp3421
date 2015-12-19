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
        'detail' => 'exhibition_detail',
        'create' => 'simple_form',
        'edit'   => 'simple_form',
    );

    public $fields = array(
        'id'         => array('column' => 'No.'),
        'start_time' => array(
            'label'  => 'Start time',
            'type'   => 'datetime-local',
            'column' => 'Start',
            'attr'   => array('required' => ''),
        ),
        'end_time'   => array(
            'label'  => 'End time',
            'type'   => 'datetime-local',
            'column' => 'End',
            'attr'   => array('required' => ''),
        ),
        'name'       => array(
            'label' => 'Name',
            'type'  => 'text',
            'title' => 'Name',
            'attr'  => array('required' => ''),
        ),
        'venue'      => array('label' => 'Venue', 'type' => 'text', 'column' => 'Venue'),
        'company'    => array('label' => 'Company', 'type' => 'text', 'column' => 'Company'),
        'info'       => array('label' => 'Information', 'type' => 'textarea'),
        'venue_lat'  => array(
            'label' => 'Location (lat)',
            'type'  => 'text',
            'attr'  => array('required' => ''),
        ),
        'venue_lng'  => array(
            'label' => 'Location (Lng)',
            'type'  => 'text',
            'attr'  => array('required' => ''),
        ),
        'venue_map'  => array(
            'label' => 'Pick the location of the venue on the map<br>or type it in the box above',
            'type'  => 'map',
            'lat'   => 'venue_lat',
            'lng'   => 'venue_lng',
            'attr'  => array(
                'style' => 'width: 450px; height: 300px',
            ),
        ),
    );
}