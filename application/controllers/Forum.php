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
    public $item_fields;

    public function __construct()
    {
        parent::__construct();
        $this->item_fields = array(
            'title'     => array('label' => 'Title', 'type' => 'text', 'column' => 'title'),
            'content'   => array('label' => 'Content', 'type' => 'textarea', 'column' => 'Content'),
            'writer_id' => array(
                'column'      => 'Writer',
                'data_source' => array($this, 'get_writer'),
            ),
            'time'      => array('label' => 'Time', 'column' => 'Time'),
            //        'reply_to'  => array('label' => 'reply to', 'type' => 'number', 'column' => 'Reply to'),
        );

    }

    public function detail($id)
    {
        check_access(TRUE);

        $data = array(
            'title'              => $this->title . ' ',
            'menu'               => $this->load->view('menu', NULL, TRUE),
            'create_url'         => site_url(dirname(dirname(uri_string())) . '/create_article/' . $id),
            'reply_url'          => site_url(dirname(dirname(uri_string())) . '/reply_article/' . $id . '/{reply_id}'),
            'edit_url'           => site_url(dirname(uri_string()) . '/edit/{id}'),
            'delete_url'         => site_url(uri_string()),
            'edit_article_url'   => site_url(dirname(dirname(uri_string())) . '/edit_article/{forum_id}/{article_id}'),
            'delete_article_url' => site_url(dirname(dirname(uri_string())) . '/delete_article/{forum_id}/{article_id}'),
            'fields'             => $this->processDynamicSource($this->fields, array(__FUNCTION__, $id)),
            'item'               => array(
                'fields' => $this->processDynamicSource($this->item_fields, array(__FUNCTION__, $id)),
            ),
        );

        $r = $this->db->where('id', $id)->get($this->table);
        $r = $r->result_array();
        $data['data'] = reset($r);

//        $r = $this->db->where('forum_id', $id)->get($this->item_table);
//        $data['data']['item'] = $r->result_array();

        $data['data']['item'] = $this->queryPosts($id);

        $temp = $this->fields;
        $this->fields = $this->item_fields;
        foreach ($data['data']['item'] as &$v)
            $v = $this->processItemSource($v, __FUNCTION__);
        $this->fields = $temp;

        $this->load->view($this->view[__FUNCTION__], $data);
    }

    public function queryPosts($forum_id, $parent_post = NULL, $level = 0)
    {
        $posts = $this->db
            ->where(array('forum_id' => $forum_id, 'reply_to' => $parent_post))
            ->order_by('time', 'desc')
            ->get('forum_article');
        $posts = $posts->result_array();
        $return = array();
        foreach ($posts as &$post) {
            $post['level'] = $level;
            $return[] = $post;
            $replies = $this->queryPosts($forum_id, $post['id'], $level + 1);
            foreach ($replies as $reply)
                $return[] = $reply;
        }

        return $return;
    }

    public function create_article($id)
    {
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
        check_access(TRUE, FALSE);
        $_POST['writer_id'] = $this->auth->user()->id;

//        parent::create_post();


        //if($this->auth->user()->id==)
        if ($this->db->insert($this->table, $this->input->post()) !== FALSE) {
            $create = json_encode(site_url(uri_string()));
            $list = json_encode(site_url(dirname(dirname(uri_string())) . '/detail/' . $id));
            $this->output->append_output(
                "<script>
                    window.parent.location = $list;
                </script>"
            );
        } else {
            $this->dbError();
        }
    }

    public function reply_article($forum_id, $reply_id)
    {
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

    public function reply_article_post($forum_id, $reply_id)
    {
        $this->table = 'forum_article';
        $this->fields = $this->item_fields;
        $_POST['forum_id'] = $forum_id;
        $_POST['writer_id'] = $this->auth->user()->id;
        $_POST['reply_to'] = $reply_id;

//        parent::create_post();
        check_access(TRUE, FALSE);

        if ($this->db->insert($this->table, $this->input->post()) !== FALSE) {
            $create = json_encode(site_url(uri_string()));
            $list = json_encode(site_url(dirname(dirname(dirname(uri_string()))) . '/detail/' . $forum_id));
            $this->output->append_output(
                "<script>
                    window.parent.location = $list;
                </script>"
            );
        } else {
            $this->dbError();
        }
    }

    public function edit_article($forum_id, $article_id)
    {
        check_access(TRUE, FALSE);

        $data = array(
            'title'  => 'Edit ' . 'Article',
            'menu'   => $this->load->view('menu', NULL, TRUE),
            'button' => 'Update',
            'form'   => array(
                'action' => site_url(uri_string()),
                'method' => 'post',
            ),
            'fields' => $this->processDynamicSource($this->item_fields, array(__FUNCTION__, $forum_id)),
        );

        $r = $this->db->where('forum_id', $forum_id)->where('id', $article_id)->get($this->item_table);
        $r = $r->result_array();
        $r = reset($r);
        $data['data'] = $this->processItemSource($r, __FUNCTION__);
        $this->load->view($this->view['edit'], $data);
    }

    public function edit_article_post($forum_id, $article_id)
    {
        check_access(TRUE, FALSE);

        if ($this->db->where('forum_id', $forum_id)
                     ->where('id', $article_id)
                     ->update($this->item_table, $this->input->post()) !== FALSE
        ) {
            $list = json_encode(site_url(dirname(dirname(dirname(uri_string()))) . '/detail/' . $forum_id));

            $this->output->append_output(
                "<script>alert('Update Success!');window.parent.location = $list;</script>"
            );
        } else {
            $this->dbError();
        }
    }

    public function delete_article($forum_id, $article_id)
    {
        check_access(TRUE, FALSE);

        $list = site_url(dirname(dirname(dirname(uri_string()))) . '/detail/' . $forum_id);
        $this->load->view('confirm', array(
            'msg'        => 'Are you sure to delete the item? This cannot be undone!',
            'form'       => array('method' => 'post'),
            'cancel_url' => $list,
            'color'      => 'red',
        ));
    }

    public function delete_article_post($forum_id, $article_id)
    {
        check_access(TRUE, FALSE);

        if ($this->db->where(array('forum_id' => $forum_id, 'id' => $article_id))
                     ->delete($this->item_table) !== FALSE
        ) {
            $list = json_encode(site_url(dirname(dirname(dirname(uri_string()))) . '/detail/' . $forum_id));

            $this->output->append_output(
                "<script>alert('Delete Success!');window.parent.location = $list;</script>"
            );
        } else {
            $this->dbError();
        }
    }

    public function get_writer($action, $id)
    {
        if ($action !== 'detail') return $id;
        $r = $this->db->get_where('member', array('id' => $id))->result_array();

        return reset($r);
    }
}