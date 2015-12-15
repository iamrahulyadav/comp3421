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
        'index'  => 'conference_list',
        'item'   => 'conference_item',
        'create' => 'conference_create',
        'edit' => 'conference_edit',
    );

    public function get_location($id)
    {
        $this->load->database();
        $r = $this->db->select(array('location_lat', 'location_long'))->from('conference')->where('id', $id)->get();
        $result = $r->result_array();
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($result[0]);
    }
}