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
        'index'          => 'simple_list',
        'detail'         => 'forum_detail',
        'create'         => 'simple_form',
        'create_article' => 'simple_form',
        'edit'           => 'simple_form',
    );
    public $fields = array(
        'id'    => array('column' => 'No.'),
        'topic' => array('label' => 'Topic', 'type' => 'textarea', 'column' => 'Topic'),
        'time'  => array('label' => 'Time', 'column' => 'Time'),
    );

    public $item_table = 'forum_article';
    public $item_fields = array(
        'title'     => array('label' => 'Title', 'type' => 'text', 'column' => 'title'),
        'content'   => array('label' => 'Content', 'type' => 'textarea', 'column' => 'Content'),
        'writer_id' => array('column' => 'Writer'),
        'time'      => array('label' => 'Time', 'column' => 'Time'),
        'reply_to'  => array('label' => 'reply to', 'type' => 'number', 'column' => 'Reply to'),
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
            'title'  => 'Create Article',
            'menu'   => $this->load->view('menu', NULL, TRUE),
            'button' => 'Create',
            'form'   => array(
                'action' => site_url(uri_string()),
                'method' => 'post',
            ),
            'fields' => $this->processDynamicSource($this->item_fields, array(__FUNCTION__)),
        );
        //echo site_url(uri_string());
        $this->load->view($this->view['create'], $data);

    }

    public function create_article_post($id)
    {
        $this->table = 'forum_article';
        $this->fields = $this->item_fields;
        $_POST['forum_id'] = $id;
        $_POST['writer_id'] = $this->auth->user()->id;

//        parent::create_post();
        if ($this->db->insert($this->table, $this->input->post()) !== FALSE) {
            $create = json_encode(site_url(uri_string()));
            $list = json_encode(site_url(dirname(dirname(uri_string())).'detail/'.$id));
            $this->output->append_output(
                "<script>
                if (confirm('Create Success!\\nClick OK to add more or Cancel to go back to the listing.'))
                    window.parent.location = $create;
                else
                    window.parent.location = $list;
                </script>"
            );
        } else {
            $this->dbError();
        }
    }
}