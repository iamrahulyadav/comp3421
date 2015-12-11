<?php

/**
 * comp3421
 * Created by LKHO.
 * Date: 11/12/2015 19:08
 */
class Auth_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('DBMember');
        $this->load->library('session');
    }

    /**
     * get the current user, or null if not logged in
     * @return DBMember|null
     */
    public function user()
    {
        return $this->session->userdata('user');
    }

    /**
     * @return bool
     */
    public function loggedIn()
    {
        return isset($_SESSION['user']);
    }

    /**
     * @param $email
     * @param $password
     * @return bool
     */
    public function logIn($email, $password)
    {
        $this->load->database();
        $user = $this->db->get_where('members', array('email' => $email))->row('DBMember');

        if (isset($user)) {
            // clear text password ;)
            if (strcmp($password, $user->password) !== 0) {
                return FALSE;
            }
            // remove the password
            $user->password = NULL;
            $user->is_admin = !empty($user->is_admin);
            $this->session->set_userdata('user', $user);

            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * @return void
     */
    public function logOut()
    {
        $this->session->unset_userdata('user');
    }

}