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
        $data = array('user' => $this->auth->user(), 'urls' => array());
        $urls = array();
        if ($this->auth->loggedIn()) {
            $urls['View Conferences'] = 'conference';
            $urls['View Exhibitions'] = 'exhibition';
            $urls['View Forum'] = 'forum';
            $urls['View Announcements'] = 'announcement';
            $urls['View Surveys'] = 'survey';
            $urls['View Rewards'] = 'reward';
            $urls['View Messages'] = 'message';
            $urls['View Conference Location'] = 'map';
            $urls['View Conference Schedule'] = 'schedule';
            if ($this->auth->user()->is_admin) {
                $urls['View Attendance Info'] = 'attendance';
                $urls['Register Member'] = 'auth/register';
            }
        } else {
        }
        foreach ($urls as $title => $url) {
            $data['urls'][htmlspecialchars($title)] = site_url($url);
        }
        $this->load->view('main', $data);
    }
}