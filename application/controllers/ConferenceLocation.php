<?php
require_once dirname(__FILE__) . '/CrudController.php';

/**
 * comp3421
 * Created by LKHO.
 * Date: 14/12/2015 17:34
 */
class ConferenceLocation extends CrudController
{
    public $table = 'conferenceLocation';
    public $title = 'Conference Location';
    public $view = array(
        'index'  => 'conferenceLocation_list',
        'item'   => 'conferenceLocation_item',
        'create' => 'conferenceLocation_create',
        'edit'   => 'conferenceLocation_edit'
    );
}