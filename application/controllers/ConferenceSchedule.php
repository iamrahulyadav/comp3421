<?php
require_once dirname(__FILE__) . '/CrudController.php';

/**
 * comp3421
 * Created by LKHO.
 * Date: 14/12/2015 17:34
 */
class ConferenceSchedule extends CrudController
{
    public $table = 'conferenceSchedule';
    public $title = 'Conference Schedule';
    public $view = array(
        'index'  => 'conferenceSchedule_list',
        'detail'   => 'conferenceSchedule_item',
        'create' => 'conferenceSchedule_create',
        'edit'   => 'conferenceSchedule_edit'
    );
}