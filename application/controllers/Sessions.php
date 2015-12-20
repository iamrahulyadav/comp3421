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
        'detail' => 'conference_detail',
        'create' => 'simple_form',
        'edit'   => 'simple_form',
    );

    public function __construct()
    {
        parent::__construct();
        $this->load->model('DBMember');
        $this->fields = array(
            'id'         => array('column' => 'ID'),
            'topic'      => array(
                'label'  => 'Conference topic',
                'type'   => 'text',
                'column' => 'Topic',
                'attr'   => array('required' => ''),
            ),
            'info'       => array('label' => 'Conference Description', 'type' => 'textarea'),
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
            'speaker'    => array(
                'label'         => 'Speaker',
                'type'          => 'select',
                'column'        => 'Speaker',
                'values_source' => array($this, 'get_speakers'),
                'attr'          => array('required' => ''),
                'data_source'   => array($this, 'get_speaker'),
            ),
            'venue'      => array(
                'label'  => 'Venue',
                'type'   => 'text',
                'column' => 'Venue',
            ),
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

    public function get_speakers($action)
    {
        $data = array();
        if ($action !== 'create' || $action !== 'edit') return $data;
        foreach ($this->db->select(array('member.id', 'first_name', 'last_name', 'title'))
                          ->where('attendee_type', 'speaker')
                          ->get('member')->result('DBMember') as $user) {
            $data[$user->id] = '[' . $user->id . '] ' . $user->display_name();
        }

        return $data;
    }

    public function get_speaker($action, $id)
    {
        if ($action !== 'detail') return $id;
        $r = $this->db->get_where('member', array('id' => $id))->result('DBMember');

        return reset($r);
    }
}
