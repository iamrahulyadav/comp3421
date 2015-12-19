<?php
require_once dirname(__FILE__) . '/CrudController.php';

/**
 * comp3421
 * Created by LKHO.
 * Date: 14/12/2015 17:34
 */
class Surveys extends CrudController
{
    public $table = 'survey';
    public $title = 'Surveys';
    public $view = array(
        'index'  => 'simple_list',
        'detail'   => 'surveys_item',
        'create' => 'simple_form',
        'edit'   => 'simple_form',
    );

    public $fields = array(
        'id'               => array('column' => 'No.'),
        'writer_id'        => array('label' => 'Writer ID', 'type' => 'text', 'column' => 'Writer ID'),
        'topic'            => array('label' => 'Topic', 'type' => 'text', 'column' => 'Topic'),
        'content'          => array('label' => 'Content', 'type' => 'textarea', 'column' => 'Content'),
        'google_form_link' => array('label' => 'Link', 'type' => 'text', 'column' => 'Link'),
        'deadline'         => array('label' => 'Deadline', 'type' => 'text', 'column' => 'Deadline'),
    );
}