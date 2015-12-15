<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Map extends CI_Controller
{
public function  __construct(){
    parent::__construct();
    $this->load->database();
}

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *        http://example.com/index.php/welcome
     *    - or -
     *        http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {
        $this->load->view('conference_location');
    }

    public function get_location()
    {
        $r = $this->db->select(array('lat', 'long'))->from('conference_location')->get();
        $result = $r->result_array();
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($result);
    }
}
