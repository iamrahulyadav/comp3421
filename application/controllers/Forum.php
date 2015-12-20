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
        'detail' => 'forum_detail',
        'create' => 'simple_form',
        'create_article' => 'forum_article_form',
        'edit'   => 'simple_form',
    );
    public $fields = array(
        'id'    => array('column' => 'No.'),
        'topic' => array('label' => 'Topic', 'type' => 'textarea', 'column' => 'Topic'),
        'time'  => array('label' => 'Time',  'column' => 'Time'),
    );

    public $item_table = 'forum_article';
    public $item_fields = array(
        'id'       => array('label' => 'id','type' => 'textarea', 'column' => 'Id'),
        'forum_id' => array('label' => 'forum_id','type' => 'textarea', 'column' => 'Forum id'),
        'title'    => array('label' => 'Title', 'type' => 'textarea', 'column' => 'Title'),
        'content'  => array('label' => 'Content', 'type' => 'textarea', 'column' => 'Content'),
        'writer'   => array('label' => 'Writer', 'type' => 'textarea', 'column' => 'writer_id'),
        'time'     => array('label' => 'Time',  'column' => 'Time'),
        'reply'    => array('label' => 'reply', 'type' => 'textarea', 'column' => 'reply_to'),
    );

    public function detail($id)
    {
        check_access(TRUE);

        $data = array(
            'title'      => $this->title . ' ',
            'menu'       => $this->load->view('menu', NULL, TRUE),
            'create_url' => site_url(dirname(dirname(uri_string())) . '/create_article/' . $id),
            'edit_url'   => site_url(dirname(uri_string()) . '/edit/{id}'),
            'delete_url' => site_url(uri_string()),
            'fields'     => $this->processDynamicSource($this->fields, array(__FUNCTION__, $id)),
            'item'       => array(
                'edit_url'   => site_url(dirname(uri_string()) . '/edit/{id}'),
                'delete_url' => site_url(uri_string()),
                'fields'     => $this->processDynamicSource($this->item_fields, array(__FUNCTION__, $id)),
            ),
        );

        $r = $this->db->where('id', $id)->get($this->table);
        $r = $r->result_array();
        $r = reset($r);
        $data['data'] = $this->processItemSource($r, __FUNCTION__);
        $r = $this->db->where('forum_id', $id)->get($this->item_table);
        $data['data']['item'] = $r->result_array();
        foreach ($data['data']['item'] as &$v)
            $v = $this->processItemSource($v, __FUNCTION__);
        $r = reset($r);
        //$data['data']['item'] = $this->processItemSource($r, __FUNCTION__);
        $this->load->view($this->view[__FUNCTION__], $data);
    }

    public function create_article($id)
    {
//        $order_id = $this->db->select('max(' . $this->db->protect_identifiers('order') . ')+1', FALSE)
//                             ->where('forum_id', $id)
//                             ->get($this->item_table);
//        var_dump($this->db->last_query());
//        $order_id = $order_id->row_array();
//        $order_id = reset($order_id);
//        $this->fields['order']['attr']['value'] = isset($order_id) ? $order_id : 1;
//        //parent::create();

        //check_access(TRUE, TRUE);

        $data = array(
            'title'  => 'Create ' . 'Article',
            'menu'   => $this->load->view('menu', NULL, TRUE),
            'button' => 'Create',
            'form'   => array(
                'action' => site_url(uri_string()),
                'method' => 'post',
            ),
            'fields' => $this->processDynamicSource($this->item_fields, array(__FUNCTION__)),
        );
        $this->load->view($this->view['create'], $data);

    }

//    public function create_article_post($id)
//    {
//        $_POST['id'] = $id;
//        parent::create_post();
//    }
}