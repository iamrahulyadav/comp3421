<?php

/**
 * comp3421
 * Created by LKHO.
 * Date: 11/12/2015 21:09
 */
class DBMember extends CI_Model
{
    /**
     * @var string
     */
    public $id;
    /**
     * @var string varchar(45) Dr, Prof, Mr, Ms, Mrs
     */
    public $title;
    public $first_name;
    /**
     * @var string should be UPPERCASE
     */
    public $last_name;
    public $address;
    public $city;
    public $country;
    /**
     * @var string student, participant, sponsor, vip, speaker
     */
    public $attendee_type;
    public $department;
    public $company;
    /**
     * @var string also used as login ID
     */
    public $email;
    /**
     * @var string this field is just for authentication and db insertion, it will always be null
     * when retrieved from session
     */
    public $password;
    /**
     * @var string varchar(50)
     */
    public $phone_number;
    /**
     * @var string varchar(50)
     */
    public $fax_number;
    /**
     * @var string yyyy-mm-dd
     */
    public $registration_date;
    /**
     * @var string unpaid, cash, credit, eps, cheque
     */
    public $payment_status;
    public $remarks;
    /**
     * @var bool
     */
    public $is_admin;

    /**
     * "$title $last_name, $first_name"<br>
     * Dr NG, Vincent
     * @return string
     */
    public function display_name()
    {
        return (isset($this->title) ? ucfirst($this->title) . ' ' : '') . $this->last_name . ', ' . $this->first_name;
    }

    /**
     * change user's password
     * @param string|null $old the old password, or null to bypass the check
     * @param $new
     * @return bool|int the affected rows, or false if fail due to wrong $old password or db error
     */
    public function change_password($old = NULL, $new)
    {
        $this->load->database();

        if (isset($old)) {
            $pw = $this->db->select('password')->get_where('members', array('email' => $this->email))->row('password');
            if (!isset($pw)) {
                return FALSE;
            }
            if (strcmp($old, $pw) !== 0) {
                return FALSE;
            }
        }

        return $this->db->update('members', array('password' => $new), array('email' => $this->email));
    }

    /**
     * alias for change_password(NULL, $new)
     * @param $new
     * @return bool|int the affected rows, or false if fail due to db error
     */
    public function reset_password($new)
    {
        return $this->change_password(NULL, $new);
    }
}