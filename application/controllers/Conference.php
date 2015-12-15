<?php
require_once dirname(__FILE__) . '/CrudController.php';

/**
 * comp3421
 * Created by LKHO.
 * Date: 14/12/2015 17:34
 */
class Conference extends CrudController
{
    public $table = 'conference';
    public $title = 'Conference Programs';
    public $view = array(
        'index'  => 'simple_list',
        'item'   => 'conference_item',
        'create' => 'simple_form',
        'edit'   => 'simple_form',
    );
    public $fields = array(
        'topic'         => array('name' => 'Conference topic', 'type' => 'text'),
        'info'          => array('name' => 'Conference Description', 'type' => 'textarea'),
        'start_time'    => array('name' => 'Start time', 'type' => 'datetime'),
        'end_time'      => array('name' => 'End time', 'type' => 'datetime'),
        'speaker'       => array('name' => 'Speaker', 'type' => 'text'),
        'location_lat'  => array(
            'name' => 'Location (lat)',
            'type' => 'number',
            'attr' => array('min' => '-90', 'max' => '90'),
        ),
        'location_long' => array(
            'name' => 'Location (lng)',
            'type' => 'number',
            'attr' => array('min' => '-180', 'max' => '180'),
        ),
    );
}