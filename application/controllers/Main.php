<?php

/**
 * comp3421
 * Created by LKHO.
 * Date: 9/12/2015 19:11
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller
{

    public function index()
    {
        $this->load->view('main', array('user' => $this->auth->user()));
    }
}