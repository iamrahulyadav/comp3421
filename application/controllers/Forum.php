<?php
require_once dirname(__FILE__) . '/CrudController.php';

/**
 * comp3421
 * Created by LKHO.
 * Date: 14/12/2015 17:34
 */
class Forum extends CrudController
{
    public $table = 'forum';
    public $title = 'Forums';
    public $view = array(
        'index'  => 'simple_list',
        'detail' => 'forum_item',
        'create' => 'simple_form',
        'edit'   => 'simple_form',
    );
    public $fields = array(
        'id' => array('column' => 'No.'),
        'topic' => array('label'=>'Topic','type'=>'textarea','column'=>'Topic'),
        'time' => array('label' => 'Time', 'type' => 'datetime','column'=>'Time')
    );

    public $item_table = 'forum_article';
    public $item_fields = array(
        'id' => array('label' => 'id'),
        'title' => array('label'=>'Title','type'=>'textarea','column'=>'Title'),
        'content' => array('label'=>'Content','type'=>'textarea','column'=>'Content'),
        'writer' => array('label'=>'Writer','type'=>'textarea','column'=>'writer_id'),
        'time' => array('label' => 'Time', 'type' => 'datetime','column'=>'Time'),
        'reply' => array('label'=>'reply','type'=>'textarea','column'=>'reply_to'),
    );

    public function detail($id)
    {
        check_access(TRUE);

        $data = array(
            'title'      => $this->title . ' Details',
            'menu'       => $this->load->view('menu', NULL, TRUE),
            'edit_url'   => site_url(dirname(uri_string()) . '/edit/{id}'),
            'delete_url' => site_url(uri_string()),
            'fields'     => $this->processDynamicSource($this->fields, array(__FUNCTION__, $id)),
            'item' => array(
                'edit_url'   => site_url(dirname(uri_string()) . '/edit/{id}'),
                'delete_url' => site_url(uri_string()),
                'fields'     => $this->processDynamicSource($this->item_fields, array(__FUNCTION__, $id)),
            )
        );

        $r = $this->db->where('id', $id)->get($this->table);
        $r = $r->result_array();
        $r = reset($r);
        $data['data'] = $this->processItemSource($r, __FUNCTION__);
        $r = $this->db->where('forum_id', $id)->get($this->item_table);
        $r = $r->result_array();
        $r = reset($r);
        $data['data']['item'] = $this->processItemSource($r, __FUNCTION__);
        $this->load->view($this->view[__FUNCTION__], $data);
    }
}