<?php
/**
 * comp3421
 * Created by LKHO.
 * Date: 13/12/2015 23:27
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter URL Helpers
 *
 * @package    CodeIgniter
 * @subpackage Helpers
 * @category   Helpers
 * @author     LKHO
 */

// ------------------------------------------------------------------------

/**
 * @param bool $loggedIn
 * @param bool $admin
 */
function check_access($loggedIn, $admin = FALSE)
{
    $loggedIn = $loggedIn || $admin;
    if ($loggedIn) {
        /** @var CI_Controller $ci */
        $ci = get_instance();
        if (!$ci->auth->isLoggedIn()) {
            redirect('auth/login');
        }
        if ($admin && !$ci->auth->user()->is_admin) {
            header('HTTP/1.1 401 Unauthorized');
            echo
            '<html>
            <body>
                <h2>You do not have permission to access this page</h2>
                <a href="javascript:history.back()">Back</a>
            </body>
            </html>';
            exit;
        }
    }

}