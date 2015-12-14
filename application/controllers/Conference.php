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
    public $view = array('get' => '', 'post', 'put', 'delete');

    public function index_get()
    {
        check_access(TRUE);
        $data = array(
            'title' => $this->title,
            'menu'  => $this->load->view('menu', NULL, TRUE)
        );

        $this->db->get($this->table);


        $data = array(
            array('id' => 123, 'title' => "gffs"),
            array('id' => 123, 'title' => "gffs"),
            array('id' => 123, 'title' => "gffs"),
            array('id' => 123, 'title' => "gffs"),
            array('id' => 123, 'title' => "gffs"),
            array('id' => 123, 'title' => "gffs"),
            array('id' => 123, 'title' => "gffs"),
            array('id' => 123, 'title' => "gffs"),
            array('id' => 123, 'title' => "gffs"),
        );

        $this->load->view($this->view[$this->input->method()], $data);
    }
}