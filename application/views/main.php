<?php
/**
 * comp3421
 * Created by LKHO.
 * Date: 9/12/2015 23:16
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Registration and Attendance Managing Application</title>
</head>
<body>
<h1>Registration and Attendance Managing Application</h1>

<p><?php if (isset($user)) {
        echo 'Welcome ' . $user->display_name();
        echo ' (<a href="' . site_url('/auth/logout') . '">Log out</a>)';
    }else{
        echo '<a href="' . site_url('/auth/login') . '">Log in</a>';
    } ?></p>
</body>
</html>