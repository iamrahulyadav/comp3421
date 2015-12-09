<?php

/**
 * comp3421
 * Created by admin.
 * Date: 9/12/2015 19:11
 */
class Main extends CI_Controller
{

    public function index()
    {
        $this->load->helper('url');
        echo site_url('test/test');
    }
}